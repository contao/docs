---
title: "loadPageDetails"
description: "loadPageDetails hook"
tags: ["hook-page"]
aliases:
    - /reference/hooks/loadPageDetails/
    - /reference/hooks/loadpagedetails/
---


{{< version "4.8" >}}

This hook is executed whenever the details of a page are loaded via `\Contao\PageModel::loadDetails`. This hook allows 
you to add additional details to the `\Contao\PageModel` instance. This in turn allows you to inherit custom variables, 
or make settings of the root page available through a custom variable (see example below).


## Parameters

1. *array* `$parentModels`

    An array containing all the parent pages of the processed page.

2. *\Contao\PageModel* `$page`

    The processed page for which the details are added.


```php
// src/EventListener/LoadPageDetailsListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\PageModel;

#[AsHook('loadPageDetails')]
class LoadPageDetailsListener
{
    public function __invoke(array $parentModels, PageModel $page): void
    {
        // Add additional data from the root page to the processed page
        if (count($parentModels) > 0) {
            $rootPage = end($parentModels);
            $page->myCustomVariable = $rootPage->rootMyCustomVariable;
        }
    }
}
```


## References

* [\Contao\PageModel#L1021-L1035](https://github.com/contao/contao/blob/4.8.0-RC1/core-bundle/src/Resources/contao/models/PageModel.php#L1021-L1035)
