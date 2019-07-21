---
title: "getArticle"
description: "getArticle hook"
tags: ["hook-controller", "hook-article"]
---

The `getArticle` hook allows you to override the configuration of an article 
prior to rendering. It does not expect a return value.

## Example

```php
// src/App/EventListener/GetArticleListener.php
namespace App\EventListener;

class GetArticleListener
{
    public function onGetArticle(\Contao\ArticleModel $article): void
    {
        // Modify $article here …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GetArticleListener:
    public: true
    tags:
      - { name: contao.hook, hook: getArticle, method: onGetArticle }
```

## References

* [\Contao\Controller#L404-L411](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L404-L411)
