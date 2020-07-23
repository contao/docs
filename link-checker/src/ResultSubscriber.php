<?php

declare(strict_types=1);

/*
 * Contao Docs Link Checker
 *
 * @author     Yanick Witschi <yanick.witschi@terminal42.ch>
 * @license    MIT
 */

namespace Contao\Docs\LinkChecker;

use Symfony\Contracts\HttpClient\ChunkInterface;
use Symfony\Contracts\HttpClient\Exception\HttpExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Terminal42\Escargot\CrawlUri;
use Terminal42\Escargot\EscargotAwareInterface;
use Terminal42\Escargot\EscargotAwareTrait;
use Terminal42\Escargot\Subscriber\ExceptionSubscriberInterface;
use Terminal42\Escargot\Subscriber\FinishedCrawlingSubscriberInterface;
use Terminal42\Escargot\Subscriber\SubscriberInterface;

class ResultSubscriber implements SubscriberInterface, EscargotAwareInterface, ExceptionSubscriberInterface, FinishedCrawlingSubscriberInterface
{
    use EscargotAwareTrait;

    private const IGNORE_URIS = [
        'https://github.com/contao/docs/edit',
        'http(s?)://(www\.)?example\.',
        'http(s?)://.+\.local(/|$)',
        'http(s?)://localhost(/|$)',
    ];

    private string $outputPath;
    private int $numberOfErrors = 0;

    /**
     * @var resource
     */
    private $fileHandle;

    public function __construct(string $outputPath)
    {
        $this->outputPath = $outputPath;
    }

    public function getNumberOfErrors(): int
    {
        return $this->numberOfErrors;
    }

    public function shouldRequest(CrawlUri $crawlUri): string
    {
        // Ignore some URIs
        foreach (self::IGNORE_URIS as $pattern) {
            if (preg_match('@'.$pattern.'@i', (string) $crawlUri->getUri())) {
                return SubscriberInterface::DECISION_NEGATIVE;
            }
        }

        if (!$this->escargot->getBaseUris()->containsHost($crawlUri->getUri()->getHost())) {
            $crawlUri->addTag('external');
        }

        $crawlUriToCheck = $crawlUri;

        if (null !== $crawlUri->getFoundOn() && ($originalCrawlUri = $this->escargot->getCrawlUri($crawlUri->getFoundOn()))) {
            $crawlUriToCheck = $originalCrawlUri;
        }

        return $this->isAllowedUri($crawlUriToCheck) ? SubscriberInterface::DECISION_POSITIVE : SubscriberInterface::DECISION_NEGATIVE;
    }

    public function needsContent(CrawlUri $crawlUri, ResponseInterface $response, ChunkInterface $chunk): string
    {
        if ($crawlUri->hasTag('external')) {
            return SubscriberInterface::DECISION_NEGATIVE;
        }

        return SubscriberInterface::DECISION_POSITIVE;
    }

    public function onLastChunk(CrawlUri $crawlUri, ResponseInterface $response, ChunkInterface $chunk): void
    {
        // noop
    }

    public function onTransportException(CrawlUri $crawlUri, TransportExceptionInterface $exception, ResponseInterface $response): void
    {
        // Do not report timeout issues, they happen from time to time and are most likely not broken
        if (false !== stripos($exception->getMessage(), 'timeout')) {
            return;
        }

        $this->writeCrawlUri($crawlUri, $exception->getMessage());
    }

    public function onHttpException(CrawlUri $crawlUri, HttpExceptionInterface $exception, ResponseInterface $response, ChunkInterface $chunk): void
    {
        $this->writeCrawlUri($crawlUri, 'HTTP status code '.$response->getStatusCode());
    }

    public function finishedCrawling(): void
    {
        if (null !== $this->fileHandle) {
            fclose($this->fileHandle);
        }
    }

    private function isAllowedUri(CrawlUri $crawlUri): bool
    {
        // We only have one anyway
        $baseUri = $this->escargot->getBaseUris()->all()[0];

        return $baseUri->getHost() === $crawlUri->getUri()->getHost()
            && preg_match('@^'.preg_quote($baseUri->getPath(), '@').'@', $crawlUri->getUri()->getPath());
    }

    private function writeCrawlUri(CrawlUri $crawlUri, string $msg)
    {
        ++$this->numberOfErrors;

        $this->writeLine(sprintf('- [ ] URL "%s" seems broken (%s). Found on: %s',
            (string) $crawlUri->getUri(),
            $msg,
            (string) $crawlUri->getFoundOn()
        ));
    }

    private function writeStart(): void
    {
        $this->writeLine('# Link Checker Report');
        $this->writeLine('');
        $this->writeLine('The Link Checker found the following issues:');
        $this->writeLine('');
    }

    private function writeLine(string $string): void
    {
        if (null === $this->fileHandle) {
            $this->fileHandle = fopen($this->outputPath, 'w');
            $this->writeStart();
        }

        fwrite($this->fileHandle, $string."\n");
    }
}
