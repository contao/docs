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
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\ChunkInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Terminal42\Escargot\CrawlUri;
use Terminal42\Escargot\EscargotAwareInterface;
use Terminal42\Escargot\EscargotAwareTrait;
use Terminal42\Escargot\Subscriber\SubscriberInterface;
use Terminal42\Escargot\Subscriber\Util;

class RefreshSubscriber implements SubscriberInterface, EscargotAwareInterface
{
    use EscargotAwareTrait;

    public function shouldRequest(CrawlUri $crawlUri): string
    {
        return SubscriberInterface::DECISION_ABSTAIN;
    }

    public function needsContent(CrawlUri $crawlUri, ResponseInterface $response, ChunkInterface $chunk): string
    {
        return SubscriberInterface::DECISION_ABSTAIN;
    }

    public function onLastChunk(CrawlUri $crawlUri, ResponseInterface $response, ChunkInterface $chunk): void
    {
        if (!Util::isOfContentType($response, 'text/html')) {
            return;
        }

        $crawler = new Crawler($response->getContent(), (string) $crawlUri->getUri());
        $refreshCrawler = $crawler->filterXPath("//meta[@http-equiv='refresh']");

        if (0 === $refreshCrawler->count()) {
            return;
        }

        if (!$contentNode = $refreshCrawler->getNode(0)->attributes->getNamedItem('content')) {
            return;
        }

        preg_match('@^0; url=(https?://.*)$@', $contentNode->textContent, $matches);

        if (isset($matches[1])) {
            $uri = CrawlUri::normalizeUri(new Uri($matches[1]));
            $this->escargot->addUriToQueue($uri, $crawlUri);
        }
    }
}
