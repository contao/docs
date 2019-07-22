---
title: "getSearchablePages"
description: "getSearchablePages hook"
tags: ["hook-automator"]
---

The `getSearchablePages` hook is triggered when the the search index is rebuilt.
It passes the array of pages and the ID of the root page as arguments and
expects an array of _absolute_ URLs as return value.


## Parameters

1. *array* `$pages`

    List of absolute URLs that should be indexed.

2. *int* `$root`

    ID of the current root page. This parameter is not always available.

3. *bool* `$isSitemap`

    `true` if the hook is triggered when updating XML sitemap. This parameter is
    not always available.

4. *string* `$language`

    Language of the generated root page. This parameter is not always available.


## Return Values

Return the list of pages that should be indexed. Be aware that this simply means
these URLs will be requested, and each page is responsible for its indexing. By
checking `$isSitemap`, you can decide wether to include your pages in the XML
sitemap or only for the search index.


## Example

```php
// src/App/EventListener/GetSearchablePagesListener.php
namespace App\EventListener;

class GetSearchablePagesListener
{
    public function onGetSearchablePages(array $pages, int $root = null, bool $isSitemap = false, string $language = null): array
    {
        // Modify the $pages array …

        return $pages;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GetSearchablePagesListener:
    public: true
    tags:
      - { name: contao.hook, hook: getSearchablePages, method: onGetSearchablePages }
```

* [\Contao\Calendar#L287-L380](https://github.com/contao/contao/blob/4.7.6/calendar-bundle/src/Resources/contao/classes/Calendar.php#L287-L380)
* [\Contao\ModuleFaq#L21-L114](https://github.com/contao/contao/blob/4.7.6/faq-bundle/src/Resources/contao/modules/ModuleFaq.php#L21-L114)
* [\Contao\News#L252-L345](https://github.com/contao/contao/blob/4.7.6/news-bundle/src/Resources/contao/classes/News.php#L252-L345)
* [\Contao\Newsletter#L955-L1047](https://github.com/contao/contao/blob/4.7.6/newsletter-bundle/src/Resources/contao/classes/Newsletter.php#L955-L1047)


## References

* [\Contao\RebuildIndex#L95-L103](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/RebuildIndex.php#L95-L103)
* [\Contao\Automator#L363-L371](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Automator.php#L363-L371)
