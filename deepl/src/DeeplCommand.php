<?php

declare(strict_types=1);

/*
 * Contao Docs DeepL Translator
 *
 * @author     Fritz Michael Gschwantner <fmg@inspiredminds.at>
 * @license    MIT
 */

namespace Contao\Docs\DeeplTranslator;

use Gt\Dom\Element;
use Gt\Dom\HTMLDocument;
use League\HTMLToMarkdown\HtmlConverter;
use Parsedown;
use Scn\DeeplApiConnector\DeeplClient;
use Scn\DeeplApiConnector\DeeplClientInterface;
use Scn\DeeplApiConnector\Enum\TextHandlingEnum;
use Scn\DeeplApiConnector\Model\Translation;
use Scn\DeeplApiConnector\Model\TranslationConfig;
use Scn\DeeplApiConnector\Model\Usage;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use Webmozart\PathUtil\Path;

class DeeplCommand extends Command
{
    private const MACHINE_TRANSLATED_WARNING = "{{% notice warning %}}\nThis article is machine translated.\n{{% /notice %}}";

    /**
     * @var array
     */
    private static $supportedLangs = ['en', 'de'];

    /**
     * @var string
     */
    private static $manualPath = __DIR__.'/../../docs/manual/';

    /**
     * @var DeeplClientInterface
     */
    private $deepl;

    /**
     * @var Parsedown
     */
    private $parsedown;

    /**
     * @var HtmlConverter
     */
    private $htmlConverter;

    public function __construct()
    {
        parent::__construct();
    }

    public function configure()
    {
        $this
            ->setName('translate')
            ->setDescription('Automatically translates pages from the manual.')
            ->addArgument('source_lang', InputArgument::OPTIONAL, 'The language to be translated from.', 'de')
            ->addArgument('target_lang', InputArgument::OPTIONAL, 'The language to be translated to.', 'en')
            ->addOption('file', null, InputOption::VALUE_REQUIRED, 'A single file to translate. Path must be relative to the docs/manual/ directory.')
            ->addOption('force', null, InputOption::VALUE_NONE, 'Forces a file to be translated, even if the translated file already exists.')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $sourceLang = $input->getArgument('source_lang');
        $targetLang = $input->getArgument('target_lang');

        if ($sourceLang === $targetLang) {
            throw new InvalidArgumentException('Source and target language cannot be the same.');
        }

        if (!\in_array($sourceLang, self::$supportedLangs, true) || !\in_array($targetLang, self::$supportedLangs, true)) {
            throw new InvalidArgumentException('Unsupported language. Only the following languages are supported: '.implode(', ', self::$supportedLangs));
        }

        if (empty($_SERVER['DEEPL_API_KEY'])) {
            throw new \RuntimeException('DeepL API key must be set via the DEEPL_API_KEY environment variable.');
        }

        $force = $input->getOption('force');

        $this->deepl = DeeplClient::create($_SERVER['DEEPL_API_KEY']);
        $this->parsedown = new Parsedown();
        $this->htmlConverter = new HtmlConverter();
        $this->htmlConverter->getEnvironment()->addConverter(new TableConverter());
        $this->htmlConverter->getConfig()->setOption('header_style', 'atx');

        if (null !== ($singleFile = $input->getOption('file'))) {
            $filePath = Path::join(self::$manualPath, $singleFile);

            if (!file_exists($filePath)) {
                throw new InvalidArgumentException('Invalid file "'.$singleFile.'"');
            }

            $this->translateFile($output, $filePath, $sourceLang, $targetLang, $force);
        } else {
            $sourceFiles = new Finder();
            $sourceFiles->files()->name('*.'.$sourceLang.'.md')->in(self::$manualPath);

            if (!$sourceFiles->hasResults()) {
                $output->writeln('No documents in the manual found for the source language.');

                return 0;
            }

            foreach ($sourceFiles as $file) {
                $this->translateFile($output, $file->getRealPath(), $sourceLang, $targetLang, $force);
            }
        }

        /** @var Usage $usage */
        $usage = $this->deepl->getUsage();

        $output->writeln('Used '.$usage->getCharacterCount().' characters out of '.$usage->getCharacterLimit().'.');

        return 0;
    }

    private function translateFile(OutputInterface $output, string $sourceFilePath, string $sourceLang, string $targetLang, bool $force = false): void
    {
        $targetFilePath = preg_replace('/(.+)\.'.$sourceLang.'.md$/', '$1.'.$targetLang.'.md', $sourceFilePath);

        if (!$force && file_exists($targetFilePath)) {
            return;
        }

        $output->write('Translating '.Path::makeRelative($sourceFilePath, self::$manualPath));

        // Get file contents
        $source = file_get_contents($sourceFilePath);

        // Extract body and meta
        $metaPos = strpos($source, '---', strpos($source, '---') + 1) + 3;
        $meta = substr($source, 0, $metaPos);
        $body = substr($source, $metaPos);

        // Process the meta data
        $meta = $this->processMeta($meta, $sourceLang, $targetLang, $targetFilePath);

        // Temporarily replace refs
        $body = preg_replace('/{{< ref "(.+)" >}}/', 'REF::$1::REF', $body);

        // Parse markdown body to HTML
        $html = $this->parsedown->parse($body);

        // Translate HTML nodes
        $doc = new HTMLDocument($html);

        foreach ($doc->children as $child) {
            $this->translateNode($child, $sourceLang, $targetLang);
        }

        // Translate alt attributes
        foreach ($doc->querySelectorAll('img[alt]') as $img) {
            $alt = $img->getAttribute('alt');

            if (empty($alt)) {
                continue;
            }

            $translationConfig = new TranslationConfig(
                $alt,
                strtoupper($targetLang),
                strtoupper($sourceLang),
                [], [], [],
                TextHandlingEnum::SPLITSENTENCES_NONEWLINES,
            );

            /** @var Translation $translationResult */
            $translationResult = $this->deepl->getTranslation($translationConfig);

            $img->setAttribute('alt', $translationResult->getText());
        }

        $html = $doc->saveHTML();

        // Convert back to markdown
        $markdown = $this->htmlConverter->convert($html);

        // Fix some things
        $markdown = preg_replace('/{{&lt;(.+)&gt;}}/m', '{{<$1>}}', $markdown);
        $markdown = str_replace(['{{{% ', '{{{< '], ['{{% ', '{{< '], $markdown);
        $markdown = preg_replace('/({{% .+ %}}) ([^\s])/', "$1\n$2", $markdown);
        $markdown = preg_replace('@([^\s]) ({{% /.+ %}})@', "$1\n$2", $markdown);

        // Restore and transform refs
        $markdown = preg_replace('/REF::(.+)\.'.$sourceLang.'\.md::REF/', '{{< ref "$1.'.$targetLang.'.md" >}}', $markdown);

        // Add warning
        $markdown = self::MACHINE_TRANSLATED_WARNING."\n\n".$markdown;

        // Prepend processed meta data
        $markdown = $meta."\n".$markdown."\n";

        // Save to file
        file_put_contents($targetFilePath, $markdown);

        $output->writeln(' » '.Path::makeRelative($targetFilePath, self::$manualPath));
    }

    private function translateNode(\DOMNode $node, string $sourceLang, string $targetLang): void
    {
        // Do not translate code blocks
        if (\in_array($node->nodeName, ['pre', 'code'], true)) {
            return;
        }

        // Recursively process child nodes, but not for certain elements like paragraphs or table cells
        if ($node->hasChildNodes() && !\in_array($node->nodeName, ['p', 'td', 'th', 'li'], true)) {
            foreach ($node->childNodes as $child) {
                $this->translateNode($child, $sourceLang, $targetLang);
            }

            return;
        }

        // Retrieve the inner HTML content of the node
        $inner = '';

        if ($node instanceof Element) {
            $inner = $node->innerHTML;
        } else {
            $inner = $node->textContent;
        }

        // Remove superfluous whitespace, as this interferes with the translation output
        $inner = str_replace(["\r", "\n"], ['', ' '], $inner);
        $inner = str_replace('  ', ' ', $inner);
        $inner = trim($inner);

        if (empty($inner)) {
            return;
        }

        // Translate the content of the node
        $translationConfig = new TranslationConfig(
            $inner,
            strtoupper($targetLang),
            strtoupper($sourceLang),
            ['xml'], [], [],
            TextHandlingEnum::SPLITSENTENCES_NONEWLINES,
        );

        /** @var Translation $translationResult */
        $translationResult = $this->deepl->getTranslation($translationConfig);
        $translatedText = $translationResult->getText();

        // Write the translated content back into the node
        if ($node instanceof Element) {
            $node->innerHTML = $translatedText;
        } else {
            $node->textContent = $translatedText;
        }
    }

    private function processMeta(string $meta, string $sourceLang, string $targetLang, string $targetFilePath): string
    {
        $inner = trim(substr($meta, 3, -3));

        // Parse YAML data
        $data = Yaml::parse($inner);

        // Remove url
        unset($data['url']);

        // Set alias
        $aliasPath = Path::makeRelative($targetFilePath, self::$manualPath);
        $aliasPath = str_replace('.'.$targetLang.'.md', '', $aliasPath);
        $aliasPath = Path::join($targetLang, $aliasPath);
        $data['aliases'] = ['/'.$aliasPath.'/'];

        // Translate title, menuTitle and description
        foreach (['title', 'menuTitle', 'description'] as $key) {
            if (!isset($data[$key])) {
                continue;
            }

            $translationConfig = new TranslationConfig(
                $data[$key],
                strtoupper($targetLang),
                strtoupper($sourceLang),
                [], [], [],
                TextHandlingEnum::SPLITSENTENCES_NONEWLINES,
            );

            /** @var Translation $translationResult */
            $translationResult = $this->deepl->getTranslation($translationConfig);

            $data[$key] = $translationResult->getText();
        }

        // Convert to YAML
        $yaml = Yaml::dump($data);

        return "---\n".$yaml."---\n";
    }
}
