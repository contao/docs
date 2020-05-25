<?php

declare(strict_types=1);

/*
 * Contao Docs Link Checker
 *
 * @author     Yanick Witschi <yanick.witschi@terminal42.ch>
 * @license    MIT
 */

namespace Contao\Docs\LinkChecker;

use Nyholm\Psr7\Uri;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Terminal42\Escargot\BaseUriCollection;
use Terminal42\Escargot\Escargot;
use Terminal42\Escargot\Queue\InMemoryQueue;
use Terminal42\Escargot\Subscriber\HtmlCrawlerSubscriber;
use Terminal42\Escargot\Subscriber\RobotsSubscriber;

class CheckCommand extends Command
{
    private const BOOKS = [
        'manual',
        'dev',
    ];

    public function configure()
    {
        $this
            ->setName('check')
            ->setDescription('Checks https://docs.contao.org for broken links.')
            ->addArgument('book', InputArgument::REQUIRED, 'Book. Must be one of '.implode(', ', self::BOOKS))
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $book = $input->getArgument('book');
        $io = new SymfonyStyle($input, $output);

        if (!\in_array($book, self::BOOKS, true)) {
            $io->error('Wrong book.');

            return 1;
        }

        $outputPath = __DIR__.'/../'.$book.'-result.md';

        if (file_exists($outputPath)) {
            unlink($outputPath);
        }

        $baseUriCollection = new BaseUriCollection([
            new Uri(sprintf('https://docs.contao.org/%s/', $book)),
        ]);

        $resultSubscriber = new ResultSubscriber($outputPath);

        $escargot = Escargot::create($baseUriCollection, new InMemoryQueue())
                    ->withConcurrency(5)
                    ->withRequestDelay(500000) // 0.5s
        ;

        $escargot->addSubscriber($resultSubscriber);
        $escargot->addSubscriber(new RobotsSubscriber());
        $escargot->addSubscriber(new HtmlCrawlerSubscriber());
        $escargot->addSubscriber(new RefreshSubscriber());

        $escargot->crawl();

        if ($errors = $resultSubscriber->getNumberOfErrors()) {
            $io->error(sprintf('Finished crawling. Found %d errors.', $errors));

            return 1;
        }

        $io->success('Finished crawling. No errors found.');

        return 0;
    }
}
