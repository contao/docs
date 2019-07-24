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
// src/App/EventListener/GetArticleListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class GetArticleListener
{
    /**
     * @Hook("getArticle")
     */
    public function onGetArticle(\Contao\ArticleModel $article): void
    {
        // Modify $article here …
    }
}
```


## References

* [\Contao\Controller#L404-L411](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L404-L411)
