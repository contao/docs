---
title: "getPageLayout"
description: "getPageLayout hook"
tags: ["hook-page"]
aliases:
    - /reference/hooks/getPageLayout/
    - /reference/hooks/getpagelayout/
---


The `getPageLayout` hook is triggered when a regular page is generated.
It can be used to modify the page or layout object. It passes the page 
object, the layout object and the page type instance as arguments
and does not expect a return value.


## Parameters

1. *\Contao\PageModel* `$page`

	The page model instance.

2. *\Contao\LayoutModel* `$layout`

	The layout of the page.

3. *\Contao\PageRegular* `$pageRegular`

	 The page type instance.


## Example

```php
// src/EventListener/GetPageLayoutListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\PageRegular;
use Contao\LayoutModel;
use Contao\PageModel;

#[AsHook('getPageLayout')]
class GetPageLayoutListener
{
    public function __invoke(PageModel $page, LayoutModel $layout, PageRegular $pageRegular): void
    {
        // Modify the page or layout object
    }
}
```


## References

* [\Contao\PageRegular#L244-L252](https://github.com/contao/contao/blob/5.x/core-bundle/contao/pages/PageRegular.php#L244-L252)
* https://github.com/contao/core/issues/4736
