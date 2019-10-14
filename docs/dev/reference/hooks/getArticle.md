---
title: "getArticle"
description: "getArticle hook"
tags: ["hook-controller", "hook-article"]
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

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\ArticleModel;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class GetArticleListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("getArticle")
     */
    public function onGetArticle(ArticleModel $article): void
    {
        // Modify $article here …
    }
}
```


## References

* [\Contao\Controller#L404-L411](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L404-L411)
