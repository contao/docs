---
title: "generatePage"
description: "generatePage hook"
tags: ["hook-page"]
---

The `generatePage` hook is triggered before the main layout (fe_page) is compiled. 
It passes the page object, the layout object and a self-reference as arguments 
and does not expect a return value.

## Example

```php
// src/App/EventListener/GeneratePageListener.php
namespace App\EventListener;

class GeneratePageListener
{
    public function onGeneratePage(\Contao\PageModel $pageModel, \Contao\LayoutModel $layout, \Contao\PageRegular $pageRegular): string
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GeneratePageHook:
    public: true
    tags:
      - { name: contao.hook, hook: generatePage, method: onGeneratePage }
```

* [\Contao\CalendarBundle\EventListener\GeneratePageListener#L36-L69](https://github.com/contao/contao/blob/4.7.6/calendar-bundle/src/EventListener/GeneratePageListener.php#L36-L69)
* [\Contao\NewsBundle\EventListener\GeneratePageListener#L36-L69](https://github.com/contao/contao/blob/4.7.6/news-bundle/src/EventListener/GeneratePageListener.php#L36-L69)

## References

* [\Contao\PageRegular#L193-L201](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/pages/PageRegular.php#L193-L201)
