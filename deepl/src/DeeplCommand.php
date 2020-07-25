<?php

declare(strict_types=1);

/*
 * Contao Docs DeepL Translator
 *
 * @author     Fritz Michael Gschwantner <fmg@inspiredminds.at>
 * @license    MIT
 */

namespace Contao\Docs\DeeplTranslator;

use Scn\DeeplApiConnector\DeeplClient;
use Scn\DeeplApiConnector\DeeplClientInterface;
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
use Webmozart\PathUtil\Path;

class DeeplCommand extends Command
{
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

    public function configure()
    {
        $this
            ->setName('deepl')
            ->setDescription('Automatically translates pages from the manual.')
            ->addArgument('source_lang', InputArgument::OPTIONAL, 'The language to be translated from.', 'de')
            ->addArgument('target_lang', InputArgument::OPTIONAL, 'The language to be translated to.', 'en')
            ->addOption('file', 'f', InputOption::VALUE_REQUIRED, 'A single file to translate.')
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

        $this->deepl = DeeplClient::create($_SERVER['DEEPL_API_KEY']);

        if (null !== ($singleFile = $input->getOption('file'))) {
            $filePath = Path::join(self::$manualPath, $singleFile);

            if (!file_exists($filePath)) {
                throw new InvalidArgumentException('Invalid file "'.$singleFile.'"');
            }

            $this->translateFile($output, $filePath, $sourceLang, $targetLang);
        } else {
            $sourceFiles = new Finder();
            $sourceFiles->files()->name('*.'.$sourceLang.'.md')->in(self::$manualPath);

            if (!$sourceFiles->hasResults()) {
                $output->writeln('No documents in the manual found for the source language.');

                return 0;
            }

            foreach ($sourceFiles as $file) {
                $this->translateFile($output, $file->getRealPath(), $sourceLang, $targetLang);
            }
        }

        /** @var Usage $usage */
        $usage = $this->deepl->getUsage();

        $output->writeln('Used '.$usage->getCharacterCount().' characters out of '.$usage->getCharacterLimit().'.');

        return 0;
    }

    private function translateFile(OutputInterface $output, string $sourceFilePath, string $sourceLang, string $targetLang): void
    {
        $targetFilePath = preg_replace('/(.+)\.'.$sourceLang.'.md$/', '$1.'.$targetLang.'.md', $sourceFilePath);

        if (file_exists($targetFilePath)) {
            return;
        }

        $output->write('Translating '.Path::makeRelative($sourceFilePath, self::$manualPath));

        $translationConfig = new TranslationConfig(
            file_get_contents($sourceFilePath),
            strtoupper($targetLang),
            strtoupper($sourceLang)
        );

        /** @var Translation $translationResult */
        $translationResult = $this->deepl->getTranslation($translationConfig);

        file_put_contents($targetFilePath, $translationResult->getText());

        $output->writeln(' » '.Path::makeRelative($targetFilePath, self::$manualPath));
    }
}
