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


## Adding Assets Globally

If you need assets globally in the back end, e.g. when customizing the back end
theme, then one way to ensure that your assets are inserted on every back end page 
is to use a [Symfony kernel event][SymfonyEvents] and then check for the Contao 
back end scope there. The following example implements an [event subscriber][SymfonyEventSubscriber]
for this purpose using the `kernel.request` event in order to add a Font-Awesome
kit to the back end.

```php
// src/EventSubscriber/KernelRequestSubscriber.php
namespace App\EventSubscriber;

use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class KernelRequestSubscriber implements EventSubscriberInterface
{
    protected $scopeMatcher;

    public function __construct(ScopeMatcher $scopeMatcher)
    {
        $this->scopeMatcher = $scopeMatcher;
    }

    public static function getSubscribedEvents()
    {
        return [KernelEvents::REQUEST => 'onKernelRequest'];
    }

    public function onKernelRequest(RequestEvent $e): void
    {
        $request = $e->getRequest();

        if ($this->scopeMatcher->isBackendRequest($request)) {
            $GLOBALS['TL_JAVASCRIPT'][] = 'https://kit.fontawesome.com/xhcf1h83c6.js';
        }
    }
}
```


## Adding Assets for a DCA

In other cases it might be sufficient to add additional assets only for a specific
[DataContainer][DataContainer] view, e.g. when you created a custom [content element][ContentElement]
and want to style its appearance in the back end. In that case you can also use
the `onload` [DCA callback][DcaCallbacks] for the specific DCA.

```php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;

/**
 * @Callback(target="config.onload", table="tl_content")
 */
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
[SymfonyEventSubscriber]: https://symfony.com/doc/current/components/event_dispatcher.html#using-event-subscribers
[DataContainer]: /framework/dca/
[ContentElement]: /framework/content-elements/
[DcaCallbacks]: /reference/dca/callbacks/
