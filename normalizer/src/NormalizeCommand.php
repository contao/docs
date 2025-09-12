<?php

declare(strict_types=1);

/*
 * Contao Docs Normalizer
 *
 * @author     Fritz Michael Gschwantner <fmg@inspiredminds.at>
 * @license    MIT
 */

namespace Contao\Docs\Normalizer;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Finder\Finder;

#[AsCommand('normalize', 'Normalizes the unicode characters of the docs.')]
class NormalizeCommand extends Command
{
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $style = new SymfonyStyle($input, $output);
        $docs = Path::canonicalize(Path::join(__DIR__, '../../docs'));
        $finder = (new Finder())
            ->in($docs)
            ->files()
            ->name('*.md')
        ;

        $processed = [];

        foreach ($finder as $file) {
            $path = $file->getPathname();
            $content = file_get_contents($path);
            $normalized = \Normalizer::normalize($content);

            if ($normalized !== $content) {
                file_put_contents($path, \Normalizer::normalize(file_get_contents($file->getPathname())));
                $processed[] = Path::makeRelative($path, $docs);
            }
        }

        if ($processed) {
            $style->warning('Some files were normalized.');
            $style->listing($processed);
        } else {
            $style->success('No files needed normalization.');
        }

        return 0;
    }
}
