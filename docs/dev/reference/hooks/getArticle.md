---
title: "getArticle"
description: "getArticle hook"
tags: ["hook-controller", "hook-article"]
aliases:
    - /reference/hooks/getArticle/
    - /reference/hooks/getarticle/
---


The `getArticle` hook allows you to override the configuration of an article 
prior to rendering. It does not expect a return value.


## Parameters

1. *\Contao\ArticleModel* `$article`

    The database result from table `tl_article`.


## Example

```php
// src/EventListener/GetArticleListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\ArticleModel;

#[AsHook('getArticle')]
class GetArticleListener
{
    public function __invoke(ArticleModel $article): void
    {
        // Modify $article here …
    }
}
```


## References

* [\Contao\Controller#L404-L411](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L404-L411)
