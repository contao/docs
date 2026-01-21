---
title: "Adding Back End Assets"
description: "How to add custom CSS or JavaScript to the back end."
aliases:
  - /guides/adding-back-end-assets/
---


In some cases you might want to adjust the default back end stylesheets or add additional
stylesheets or JavaScript for your back end modules. As outlined in the [asset management][AssetManagement]
framework article, you can inject additional assets for the back end via the following 
global arrays:

| Array | Description |
| --- | --- |
| `$GLOBALS['TL_CSS']` | Additional stylesheets for the `<head>`. |
| `$GLOBALS['TL_JAVASCRIPT']` | Additional JavaScript files for the `<head>`. |
| `$GLOBALS['TL_MOOTOOLS']` | Additional HTML code at the end of the `<body>`. |

Adding additional entries to these arrays can be done in many ways. This guide will
outline two general use cases, in order to give an idea what is possible.

{{% notice info %}}
Global assets can be added via the `config/config.yaml`:
[Additional back end settings](https://docs.contao.org/manual/en/system/settings/#additional-back-end-settings)
{{% /notice %}}

## Adding Assets Globally

If you need assets globally in the back end, e.g. when customizing the back end
theme, then one way to ensure that your assets are inserted on every back end page 
is to use a [Symfony kernel event][SymfonyEvents] and then check for the Contao 
back end scope there. The following example implements an event listener
for this purpose using the `kernel.request` event.

```php
// src/EventListener/AddBackendAssetsListener.php
namespace App\EventListener;

use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpKernel\Event\RequestEvent;

#[AsEventListener]
class AddBackendAssetsListener
{
    public function __construct(private readonly ScopeMatcher $scopeMatcher)
    {
    }

    public function __invoke(RequestEvent $event): void
    {
        if (!$this->scopeMatcher->isBackendMainRequest($event)) {
            return;
        }

        $GLOBALS['TL_CSS'][] = /* add your CSS asset here */;
        $GLOBALS['TL_JAVASCRIPT'][] = /* add your JS asset here */;
    }
}
```


## Adding Assets for a DCA

In other cases it might be sufficient to add additional assets only for a specific
[DataContainer][DataContainer] view, e.g. when you created a custom [content element][ContentElement]
and want to style its appearance in the back end. In that case you can also use
the `onload` [DCA callback][DcaCallbacks] for the specific DCA.

```php
// src/EventListener/DataContainer/ContentOnLoadCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;

#[AsCallback(table: 'tl_content', target: 'config.onload')]
class ContentOnLoadCallbackListener
{
    public function __invoke(): void
    {
        $GLOBALS['TL_CSS'][] = 'files/path/to/my.css';
    }
}
```


[AssetManagement]: /framework/asset-management/
[SymfonyEvents]: https://symfony.com/doc/current/reference/events.html
[DataContainer]: /framework/dca/
[ContentElement]: /framework/content-elements/
[DcaCallbacks]: /reference/dca/callbacks/
