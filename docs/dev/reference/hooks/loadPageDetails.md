---
title: "loadPageDetails"
description: "loadPageDetails hook"
tags: ["hook-page"]
---


{{% version "4.8" %}}


This hook is executed whenever the details of a page are loaded via
`\Contao\PageModel::loadDetails`. This hook allows you to add additional details
to the `\Contao\PageModel` instance.


## Parameters

1. *array* $parentModels

    An array containing all the parent pages of the processed page.

2. *\Contao\PageModel* `$page`

    The processed page for which the details are added.


```php
// src/App/EventListener/LoadPageDetailsListener.php
namespace App\EventListener;

class LoadPageDetailsListener
{
    public function onLoadPageDetails(array $parentModels, \Contao\PageModel $page): void
    {
        // Add some additional date from the root page to the processed page
        if (count($parentModels) > 0) {
            $rootPage = end($parentModels);
            $page->myCustomVariable = $rootPage->myCustomRootVariable;
        }
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\LoadPageDetailsListener:
    public: true
    tags:
      - { name: contao.hook, hook: loadPageDetails, method: onLoadPageDetails }
```


## References

* [\Contao\PageModel#L1021-L1035](https://github.com/contao/contao/blob/4.8.0-RC1/core-bundle/src/Resources/contao/models/PageModel.php#L1021-L1035)
