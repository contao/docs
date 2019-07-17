---
title: "getPageLayout"
description: "getPageLayout hook"
tags: ["hook-page"]
---

The `getPageLayout` hook is triggered when a regular page is generated.
It can be used to modify the page or layout object. It passes the page 
object, the layout object and the page type instance as arguments
and does not expect a return value.


## Parameters

1. *\Contao\PageModel* `$pageModel`

	The page model instance.

2. *\Contao\LayoutModel* `$layout`

	The layout of the page.

3. *\Contao\PageRegular* `$pageRegular`

	 The page type instance.


## Example

```php
// src/App/EventListener/GetPageLayoutListener.php
namespace App\EventListener;

class GetPageLayoutListener
{
    public function onGetPageLayout(\Contao\PageModel $pageModel, \Contao\LayoutModel $layout, \Contao\PageRegular $pageRegular): void
    {
        // Modify the page or layout object
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GetPageLayoutHook:
    public: true
    tags:
      - { name: contao.hook, hook: getPageLayout, method: onGetPageLayout }
```


## References

- [\Contao\PageRegular#L244-L252](https://github.com/contao/contao/blob/master/core-bundle/src/Resources/contao/pages/PageRegular.php#L244-L252)
