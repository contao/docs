---
title: "Search Indexing"
description: How to work with Contao's built-in search indexer abstraction.
---

Contao ships with a built-in site search. It's good enough for many use cases. In fact, it's actually pretty smart and
deals properly with word splitting across all languages (so it also recognizes e.g. Japanese Katakana or Kanji), supports
highlighting and provides some basic relevance sorting.

However, searching is such a complex topic that you will likely never find a search engine that does exactly what
you would like to achieve out of the box. There's always at least some tweaking required to achieve what you really
need.
Here's an non-exhaustive list of features you might be looking for but are not supported out of the box:

* Autocompletion with recommended search terms
* Filtering on additional attributes (aka "faceted search", e.g. limiting for a product price range)
* Additional search term analysis (e.g. word stemming or fuzzy searching based on the Levenshtein distance)

Some of these features require special software such as tools providing linguistic analysis and thus Contao will
never be able to provide these features as long as a basic MySQL server is all that's required for a simple search
engine.

That's why Contao ships with a search indexer abstraction, giving you the freedom to disable the core features and
connect it with your favourite search engine such as [Algolia](https://www.algolia.com) or [Elasticsearch](https://www.elastic.co).

{{< version "4.9" >}}

## Triggering the search index

Indexing in Contao happens in two different ways which may or may not be combined:

* You can trigger the built-in website crawler (which is based on [Escargot](https://github.com/terminal42/escargot)) by
  either rebuilding the search index manually in the back end or having a cron job that triggers
  
  ```bash
  $ vendor/bin/contao-console contao:crawl
  ```
  
    There are numerous options to this command so be sure to run it using `--help` to learn about them.
  
* By visiting the pages one after the other, the `SearchIndexListener` will listen to the Symfony `kernel.terminate`
  event and index the generated response content on every request.
  
Indexing using the `SearchIndexListener` has the advantage that it happens behind the scenes without you having to worry
about it. It doesn't require any cron job and it makes sure the search index is always updated so that when your editors
edit a page, it's indexed as soon as the first visitor visits the modified page. Moreover, if a request is not successful
(meaning the HTTP status code is not in the `2xx` range), it will also delete that URI from the search index.
However, it also comes with the disadvantage that it happens on every single page request which may affect the
performance of your website.
Although the `kernel.terminate` event is triggered **after** the response has been sent to the browser, this only works
if you are running PHP using `php-fpm`. In case of `mod_php` or `fcgi` this will happen **before** the response is sent
to the browser, which may extend the time needed to finish the response.

This is why you can configure the behaviour of the `SearchIndexListener` as follows:

```yaml
# config/config.yml
contao:
    search:
        listener:
            index: true # Configure whether you want to update the index entry on every request
            delete: false # Configure whether you want to delete an entry if a request is not successful
```

As you can see, by setting both values to `false` you can disable the listener completely and rely on e.g. your regular
crawl cron job to do the work and cleaning up orphan indexed entries yourself.

## The search indexers

So far, we've only looked at what triggers the search indexing process but not the indexers themselves.
The search indexers are responsible to index a given `Contao\CoreBundle\Search\Document`.
As mentioned in the intro section of this page, Contao ships with a default search indexer which indexes the data
within the MySQL database that holds all the other content.
If you build your own search indexer, you might want to disable the core search indexer:

```yaml
# config/config.yml
contao:
    search:
        default_indexer:
            enable: false
```

Registering your own search indexer can be done by implementing the `Contao\CoreBundle\Search\Indexer\IndexerInterface`
and registering your service using the `contao.search_indexer` service tag:

```yml
# config/services.yaml
services:
    App\Search\ExampleSearchIndexer:
        tags:
            - { name: 'contao.search_indexer' }
```

The `IndexerInterface` itself consists of three methods you have to implement:

* `index(Document $document)` - called when a document should be indexed. It's your responsibility to check if it even
  needs an update.
  
* `delete(Document $document)` - called when a document should be deleted from the index.
  
* `clear()` - called when the whole search index shall be cleared.

The `Document` gives you access to everything you might need from an HTTP response, most notably:

* The HTTP status code
* All the HTTP headers
* The response body

In addition to this, it provides helpers to work with [JSON-LD](https://json-ld.org/). The JSON Linked Data format is 
very suitable to enhance your HTML responses with additional meta data such as [schema.org](https://schema.org/) information
that is also interpreted by popular search engines such as Google, Bing, DuckDuckGo etc.

So let's say you would like to provide a search module that is able to filter for product prices. First of all, we 
need to enhance our product detail page with JSON LD. You may invent your own schema but why not reusing what's already
standardized by schema.org and thus also supported by other search engines?

```html
<h1>My product</h1>

<p class="description">My product is super nice!</p>

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "description": "My product is super nice!",
    "name": "My product",
    "offers": {
        "@type": "Offer",
        "availability": "http://schema.org/InStock",
        "price": "55.00",
        "priceCurrency": "USD"
    }
}
</script>
```

The great thing about this is, not only do other search engines now know that our product costs USD 55.00 but as this
is now part of our response body, our custom `IndexerInterface` implementation has access to it.
You can extract it from `$document->getBody()` but Contao wouldn't be Contao if it wasn't already prepared for that
use case:

```php
$jsonLdScriptsData =  $document->extractJsonLdScripts('https://schema.org', 'Product');
```

The variable `$jsonLdScriptsData` now contains an already decoded array of all JSON LD scripts with `@context` equal to
`https://schema.org` and `@type` equal to `Product`. You can conveniently extract the product price and index it along
with all the other data you need.
