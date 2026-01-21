---
title: "generatePage"
description: "generatePage hook"
tags: ["hook-page"]
aliases:
    - /reference/hooks/generatePage/
    - /reference/hooks/generatepage/
---


The `generatePage` hook is triggered before the main layout (fe_page) is compiled. 
It passes the page object, the layout object and a self-reference as arguments 
and does not expect a return value.


## Parameters

1. *\Contao\PageModel* `$pageModel`

    The current page object.

2. *\Contao\LayoutModel* `$layout`

    The active page layout applied for rendering the page.

3.	*\Contao\PageRegular* `$pageRegular`

    The current page type object.


## Example

```php
// src/EventListener/GeneratePageListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\PageRegular;
use Contao\LayoutModel;
use Contao\PageModel;

#[AsHook('generatePage')]
class GeneratePageListener
{
    public function __invoke(PageModel $pageModel, LayoutModel $layout, PageRegular $pageRegular): void
    {
        // Do something …
    }
}
```

* [\Contao\CalendarBundle\EventListener\GeneratePageListener#L36-L69](https://github.com/contao/contao/blob/4.7.6/calendar-bundle/src/EventListener/GeneratePageListener.php#L36-L69)
* [\Contao\NewsBundle\EventListener\GeneratePageListener#L36-L69](https://github.com/contao/contao/blob/4.7.6/news-bundle/src/EventListener/GeneratePageListener.php#L36-L69)


## References

* [\Contao\PageRegular#L193-L201](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/pages/PageRegular.php#L193-L201)
