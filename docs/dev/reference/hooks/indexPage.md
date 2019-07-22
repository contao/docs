---
title: "indexPage"
description: "indexPage hook"
tags: ["hook-page"]
---


The `indexPage` hook is triggered when a page's content is added to the search index.
It passes the content, the data and the data collected for indexing so far as arguments 
and does not expect a return value.


## Parameters

1. *string* `$content`

	The content of the page.

2. *array* `$pageData`

	The data array containing information about the page.

3. *array* `$indexData`

	An array containing the data collected so far.


## Example

```php
// src/App/EventListener/IndexPageListener.php
namespace App\EventListener;

class IndexPageListener
{
    public function onIndexPage(string $content, array $pageData, array &$indexData): void
    {
        // Modify $indexData which will eventually be stored in tl_search
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\IndexPageListener:
    public: true
    tags:
      - { name: contao.hook, hook: indexPage, method: onIndexPage }
```


## References

* [\Contao\Search#L128-L135](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Search.php#L128-L135)
