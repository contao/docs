---
title: "getArticles"
description: "getArticles hook"
tags: ["hook-controller", "hook-article"]
---

The `getArticles` hook allows you to override the configuration of an article 
prior to rendering. It passes the page ID and the requested column (e.g. `'main'`)
as arguments. It expects a `string` as return value or `null`. If a string is
returned, no further hooks of the same type are executed and that content will
be shown in the front end.


## Parameters

1. *int* `$pageId`

    The articles' parent page ID.

2. *string* `$column`

    The column for which the articles are rendered.


## Example

```php
// src/App/EventListener/GetArticlesListener.php
namespace App\EventListener;

class GetArticlesListener
{
    public function onGetArticles(int $pageId, string $column): ?string
    {
        if (10 === (int) $pageId && 'main' === $column) {
            // Generate your custom articles content here
            return $customArticlesContent;
        }

        return null;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GetArticlesListener:
    public: true
    tags:
      - { name: contao.hook, hook: getArticles, method: onGetArticles }
```


## References

* [\Contao\Controller#L223-L235](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L223-L235)
