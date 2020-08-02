<?php

declare(strict_types=1);

/*
 * Contao Docs DeepL Translator
 *
 * @author     Fritz Michael Gschwantner <fmg@inspiredminds.at>
 * @license    MIT
 */

namespace Contao\Docs\DeeplTranslator;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use Webmozart\PathUtil\Path;

class FixupCommand extends Command
{
    /**
     * @var string
     */
    private static $manualPath = __DIR__.'/../../docs/manual/';

    public function configure()
    {
        $this
            ->setName('fixup')
            ->setDescription('Tries to fix some issues that appear after translating a file via DeepL.')
            ->addArgument('lang', InputArgument::OPTIONAL, 'The language to be fixed.', 'en')
            ->addOption('file', 'f', InputOption::VALUE_REQUIRED, 'A single file to fix.')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $lang = $input->getArgument('lang');

        if (null !== ($singleFile = $input->getOption('file'))) {
            $filePath = Path::join(self::$manualPath, $singleFile);

            if (!file_exists($filePath)) {
                throw new InvalidArgumentException('Invalid file "'.$singleFile.'"');
            }

            $this->fixFile($output, $filePath);
        } else {
            $sourceFiles = new Finder();
            $sourceFiles->files()->name('*.'.$lang.'.md')->in(self::$manualPath);

            if (!$sourceFiles->hasResults()) {
                $output->writeln('No documents in the manual found for the defined language.');

                return 0;
            }

            foreach ($sourceFiles as $file) {
                $this->fixFile($output, $file->getRealPath());
            }
        }

        return 0;
    }

    private function fixFile(OutputInterface $output, string $filePath): void
    {
        $output->writeln('Fixing file '.Path::makeRelative($filePath, self::$manualPath));

        $content = file_get_contents($filePath);

        // Replace `foo' with `foo`
        $content = preg_replace('/`([^`\'\s]+)\'/', '`$1`', $content);

        // Replace {{{% with {{%
        $content = str_replace('{{{% ', '{{% ', $content);

        // Replace {{{< with {{<
        $content = str_replace('{{{< ', '{{< ', $content);

        // Replace ``php with ```php
        $content = preg_replace('/^([\t ]*``[^`\n]*)$/m', '`$1', $content);

        file_put_contents($filePath, $content);
    }
}
