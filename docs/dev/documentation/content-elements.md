---
title: "Content Elements"
weight: 4
---

## Content Elements

In 

```php
<?php

declare(strict_types=1);

namespace AppBundle\ContentElement;

use Contao\FrontendTemplate;
use Symfony\Component\HttpFoundation\Response;

class MySimpleElement
{
    public function __invoke(): Response
    {
        $template = new FrontendTemplate('ce_element_simple');

        return new Response($template->parse());
    }
}
```

```php
<?php

declare(strict_types=1);

namespace AppBundle\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Fragment\FragmentConfig;
use Contao\CoreBundle\Fragment\FragmentPreHandlerInterface;
use Contao\CoreBundle\Fragment\Reference\FragmentReference;
use Contao\FrontendTemplate;
use Contao\PageModel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class MyExtendedElement implements FragmentPreHandlerInterface
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function render(
        ContentModel $contentModel,
        string $language = null,
        PageModel $pageModel = null): Response
    {
        $template = new FrontendTemplate('ce_element_extended');
        $template->contentModel = $contentModel;
        $template->pageModel = $pageModel;
        $template->language = $language;

        return new Response($template->parse());
    }

    public function preHandleFragment(FragmentReference $uri, FragmentConfig $config): void
    {
        global $objPage;

        $uri->attributes['language'] = $objPage->language;
    }
}
```
