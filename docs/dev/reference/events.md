---
title: "Events"
description: Events dispatched by Contao.
aliases:
    - /reference/events/
---


Contao implements a variety of events using the [Symfony Event Dispatcher][SymfonyEventDispatcher].
These events are often used internally but also provide you with ways to customise 
specific flows of the application, in addition to [Hooks][ContaoHooks].


## `contao.backend_menu_build`

{{< version "4.5" >}}

This event is dispatched, when the Contao back end menu is built. The event contains
references to the menu factory as well as the menu tree object of the 
[KnpMenuBundle][KnpMenuBundle]. This can be used to alter the back end menu to your 
needs. An example of this can also be found in the [Back End Routes][BackEndRoutes] 
guide.

<table>
<tr><th>Name</th><td><code>contao.backend_menu_build</code></td></tr>
<tr><th>Constant</th><td><code>\Contao\CoreBundle\Event\ContaoCoreEvents::BACKEND_MENU_BUILD</code></td></tr>
<tr><th>Event</th><td><code>\Contao\CoreBundle\Event\MenuEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/BackendMenuBuildListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\MenuEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::BACKEND_MENU_BUILD)]
class BackendMenuBuildListener
{
    public function __invoke(MenuEvent $event): void
    {
        $factory = $event->getFactory();
        $tree = $event->getTree();

        if ('mainMenu' !== $tree->getName()) {
            return;
        }

        $contentNode = $tree->getChild('content');

        $node = $factory
            ->createItem('my-module')
                ->setUri(/* … */)
                ->setLabel('My Modules')
                ->setLinkAttribute('title', 'Title')
                ->setLinkAttribute('class', 'my-module')
                ->setCurrent(/* … */)
        ;

        $contentNode->addChild($node);
    }
}
```
{{% /expand %}}


## `contao.generate_symlinks`

{{< version "4.7" >}}

This event is dispatched after Contao generated all its necessary symlinks (e.g.
from `web/files/` to all the public folders in `files/`). The event object returns
a list of custom symlinks to be built and offers the possibility to add your own 
custom symlink to the list.

<table>
<tr><th>Name</th><td><code>contao.generate_symlinks</code></td></tr>
<tr><th>Constant</th><td><code>\Contao\CoreBundle\Event\ContaoCoreEvents::GENERATE_SYMLINKS</code></td></tr>
<tr><th>Event</th><td><code>\Contao\CoreBundle\Event\GenerateSymlinksEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/GenerateSymlinksListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\GenerateSymlinksEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::GENERATE_SYMLINKS)]
class GenerateSymlinksListener
{
    public function __invoke(GenerateSymlinksEvent $event): void
    {
        $event->addSymlink('_foo/file.txt', 'web/_foo/file.txt');
    }
}
```
{{% /expand %}}


## `contao.image_sizes_all`

This event is dispatched when all the available image sizes for selection in the
back end are collected. The event allows to return all the currently set image sizes
and lets you define a new set of image sizes. It also returns back end user, for
which these image sizes are collected. This allows you to customize the list of
offered image sizes.

<table>
<tr><th>Name</th><td><code>contao.image_sizes_all</code></td></tr>
<tr><th>Constant</th><td><code>\Contao\CoreBundle\Event\ContaoCoreEvents::IMAGE_SIZES_ALL</code></td></tr>
<tr><th>Event</th><td><code>\Contao\CoreBundle\Event\ImageSizesEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/ImageSizesAllListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\ImageSizesEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::IMAGE_SIZES_ALL)]
class ImageSizesAllListener
{
    public function __invoke(ImageSizesEvent $event): void
    {
        // …
    }
}
```
{{% /expand %}}


## `contao.image_sizes_user`

This event is similar to [`contao.image_sizes_all`](#contao-image-sizes-all), except
that the list of image sizes is already filtered according to the current back end
user.

<table>
<tr><th>Name</th><td><code>contao.image_sizes_user</code></td></tr>
<tr><th>Constant</th><td><code>\Contao\CoreBundle\Event\ContaoCoreEvents::IMAGE_SIZES_USER</code></td></tr>
<tr><th>Event</th><td><code>\Contao\CoreBundle\Event\ImageSizesEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/ImageSizesUserListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\ImageSizesEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::IMAGE_SIZES_USER)]
class ImageSizesUserListener
{
    public function __invoke(ImageSizesEvent $event): void
    {
        // …
    }
}
```
{{% /expand %}}


## `contao.preview_url_create`

This event is triggered when a preview URL for the front end within the back end
is created. The event provides the set ID, key and query and allows you to set or 
override the query parameter.

<table>
<tr><th>Name</th><td><code>contao.preview_url_create</code></td></tr>
<tr><th>Constant</th><td><code>\Contao\CoreBundle\Event\ContaoCoreEvents::PREVIEW_URL_CREATE</code></td></tr>
<tr><th>Event</th><td><code>\Contao\CoreBundle\Event\PreviewUrlCreateEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/PreviewUrlCreateListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\PreviewUrlCreateEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::PREVIEW_URL_CREATE)]
class PreviewUrlCreateListener
{
    public function __invoke(PreviewUrlCreateEvent $event): void
    {
        // …
    }
}
```
{{% /expand %}}


## `contao.preview_url_convert`

When a request to the preview controller is made, this event can be used to redirect
the user to a specific front end URL within the preview mode. Otherwise a redirect
to the root page is made. Contao uses this to translate a request to the the preview
controller into a front end request URL.

<table>
<tr><th>Name</th><td><code>contao.preview_url_convert</code></td></tr>
<tr><th>Constant</th><td><code>\Contao\CoreBundle\Event\ContaoCoreEvents::PREVIEW_URL_CONVERT</code></td></tr>
<tr><th>Event</th><td><code>\Contao\CoreBundle\Event\PreviewUrlConvertEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/PreviewUrlConvertListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\PreviewUrlConvertEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::PREVIEW_URL_CONVERT)]
class PreviewUrlConvertListener
{
    public function __invoke(PreviewUrlConvertEvent $event): void
    {
        // …
    }
}
```
{{% /expand %}}


## `contao.robots_txt`

{{< version "4.9" >}}

This event is triggered when the `/robots.txt` route is called. The event allows you
to retrieve the `webignition\RobotsTxt\File\File` object of the dynamically generated
`robots.txt`, which allows you to add your own custom records programatically. See
the [README of webignition/robots-txt-file][webignition/robots-txt-file] for more
details.

<table>
<tr><th>Name</th><td><code>contao.robots_txt</code></td></tr>
<tr><th>Constant</th><td><code>\Contao\CoreBundle\Event\ContaoCoreEvents::ROBOTS_TXT</code></td></tr>
<tr><th>Event</th><td><code>\Contao\CoreBundle\Event\RobotsTxtEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/RobotsTxtListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\RobotsTxtEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

use webignition\RobotsTxt\Directive\Directive;
use webignition\RobotsTxt\Directive\UserAgentDirective;
use webignition\RobotsTxt\Inspector\Inspector;
use webignition\RobotsTxt\Record\Record;

#[AsEventListener(ContaoCoreEvents::ROBOTS_TXT)]
class RobotsTxtListener
{
    public function __invoke(RobotsTxtEvent $event): void
    {
        $file = $event->getFile();
        $inspector = new Inspector($file);

        // Check if a "User-Agent: *" directive is not already present
        if (0 === $inspector->getDirectives()->getLength()) {
            $record = new Record();

            $userAgentDirectiveList = $record->getUserAgentDirectiveList();
            $userAgentDirectiveList->add(new UserAgentDirective('*'));

            $file->addRecord($record);
        }

        foreach ($file->getRecords() as $record) {
            $directiveList = $record->getDirectiveList();
            $directiveList->add(new Directive('Disallow', '/foo/'));
        }
    }
}
```
{{% /expand %}}


## `contao.slug_valid_characters`

{{< version "4.5" >}}

This event event is triggered when the valid slug characters options in the back
end are generated. The event allows you to set custom options.

<table>
<tr><th>Name</th><td><code>contao.slug_valid_characters</code></td></tr>
<tr><th>Constant</th><td><code>\Contao\CoreBundle\Event\ContaoCoreEvents::SLUG_VALID_CHARACTERS</code></td></tr>
<tr><th>Event</th><td><code>\Contao\CoreBundle\Event\SlugValidCharactersEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/SlugValidCharactersListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\SlugValidCharactersEvent;
use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTag;

#[AsEventListener(ContaoCoreEvents::SLUG_VALID_CHARACTERS)]
class SlugValidCharactersListener
{
    public function __invoke(SlugValidCharactersEvent $event): void
    {
        // …
    }
}
```
{{% /expand %}}


## `FilterPageTypeEvent`

{{< version "4.10" >}}

This event event is triggered when the available page types are collected in the
`PageTypeOptionsListener` for the `type` select of `tl_page`. The event allows you
to add or remove options.

<table>
<tr><th>Name</th><td><code>\Contao\CoreBundle\Event\FilterPageTypeEvent::class</code></td></tr>
<tr><th>Constant</th><td>N/A</td></tr>
<tr><th>Event</th><td><code>\Contao\CoreBundle\Event\FilterPageTypeEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/FilterPageTypeListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\FilterPageTypeEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class FilterPageTypeListener
{
    public function __invoke(FilterPageTypeEvent $event): void
    {
        // Removes the "redirect" page type from the available page types
        $event->removeOption('redirect');
    }
}
```
{{% /expand %}}


## `contao.sitemap`

{{< version "4.11" >}}

This event is triggered in Contao's `SitemapController` when the sitemap is built. The event allows you to modify the XML DOM of the 
sitemap. The event also stores for which website roots this sitemap was created.

<table>
<tr><th>Name</th><td><code>contao.sitemap</code></td></tr>
<tr><th>Constant</th><td><code>\Contao\CoreBundle\Event\ContaoCoreEvents::SITEMAP</code></td></tr>
<tr><th>Event</th><td><code>\Contao\CoreBundle\Event\SitemapEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/SitemapListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\SitemapEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::SITEMAP)]
class SitemapListener
{
    public function __invoke(SitemapEvent $event): void
    {
        $sitemap = $event->getDocument();
        $urlSet = $sitemap->childNodes->item(0);

        $loc = $sitemap->createElement('loc');
        $loc->appendChild($sitemap->createTextNode('https://example.com/foobar'));

        $urlEl = $sitemap->createElement('url');
        $urlEl->appendChild($loc);
        $urlSet->appendChild($urlEl);
    }
}
```

Since Contao **5.0** you can use the `addUrlToDefaultUrlSet` method of the event:

```php
// src/EventListener/SitemapListener.php
namespace App\EventListener;

use Contao\CoreBundle\Event\ContaoCoreEvents;
use Contao\CoreBundle\Event\SitemapEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(ContaoCoreEvents::SITEMAP)]
class SitemapListener
{
    public function __invoke(SitemapEvent $event): void
    {
        $event->addUrlToDefaultUrlSet('https://example.com/foobar');
    }
}
```
{{% /expand %}}


## `SendNewsletterEvent`

{{< version "4.13" >}}

This event is triggered for each newsletter mail and allows  you to customize
the newsletter text and HTML content, prevent the submission or perform other
related actions to the newsletter (e.g. logging).

The event is triggered when sending a newsletter preview as well as when sending
a newsletter to real recipients.

<table>
<tr><th>Name</th><td><code>\Contao\NewsletterBundle\Event\SendNewsletterEvent::class</code></td></tr>
<tr><th>Constant</th><td>N/A</td></tr>
<tr><th>Event</th><td><code>\Contao\NewsletterBundle\Event\SendNewsletterEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/SendNewsletterListener.php
namespace App\EventListener;

use Contao\NewsletterBundle\Event\SendNewsletterEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class SendNewsletterListener
{
    public function __invoke(SendNewsletterEvent $event): void
    {
        // Skip sending under certain conditions
        if (!preg_match('/@contao\.org/i', $event->getRecipientAddress())) {
            $event->setSkipSending(true);
        }

        if ($event->isHtmlAllowed()) {
            // Get the parsed HTML content of the newsletter
            $html = $event->getHtml();

            // Use the original, unparsed HTML content of the newsletter
            $html = $event->getNewsletterValue('content') ;

            // Get any data from the newsletter
            $id = $event->getNewsletterValue('id');

            // Get any data from the recipient
            $greeting = $event->getRecipientValue('greeting');

            // Overwrite the HTML with custom content
            $event->setHtml($html);
        }
    }
}
```
{{% /expand %}}


## `FetchArticlesForFeedEvent`

{{< version "5.0" >}}

This event is dispatched when a news feed is created and is used to collect the news articles before adding them to the
feed. The event holds references to the feed, the page and the request and allows news articles to be added to it. This
event is also used by the news bundle itself, so if you want to alter the collection of news articles (before they are
added to the feed) make sure that your event listener has a lower priority.

This event also allows you to alter the feed directly.

<table>
<tr><th>Name</th><td><code>\Contao\NewsBundle\Event\FetchArticlesForFeedEvent::class</code></td></tr>
<tr><th>Constant</th><td>N/A</td></tr>
<tr><th>Event</th><td><code>\Contao\NewsBundle\Event\FetchArticlesForFeedEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/FetchArticlesForFeedEventListener.php
namespace App\EventListener;

use Contao\NewsBundle\Event\FetchArticlesForFeedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener]
class FetchArticlesForFeedEventListener
{
    public function __invoke(FetchArticlesForFeedEvent $event): void
    {
        // Add additional news articles to the feed
        $articles = NewsModel::findBy(…);
        $event->addArticles($articles->getModels());

        // Set a logo for the feed
        $event->getFeed()->setLogo(…);
    }
}
```
{{% /expand %}}


## `TransformArticleForFeedEvent`

{{< version "5.0" >}}

This event is dispatched when a news article is transformed to a news feed item node. The event holds a reference to the
news archive, feed, page, request and the base URL. The news bundle uses this event to create a feed item based on a
news record and sets this item in the event. You can use this event to further alter the feed item (if your event
listener has a lower priority).

<table>
<tr><th>Name</th><td><code>\Contao\NewsBundle\Event\TransformArticleForFeedEvent::class</code></td></tr>
<tr><th>Constant</th><td>N/A</td></tr>
<tr><th>Event</th><td><code>\Contao\NewsBundle\Event\TransformArticleForFeedEvent</code></td></tr>
</table>

{{% expand "Example" %}}
```php
// src/EventListener/TransformArticleForFeedEventListener.php
namespace App\EventListener;

use Contao\NewsBundle\Event\TransformArticleForFeedEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(priority: -100)]
class TransformArticleForFeedEventListener
{
    public function __invoke(TransformArticleForFeedEvent $event): void
    {
        if (!($item = $event->getItem())) {
            return;
        }

        // Set a summary
        $item->setSummary(…);
    }
}
```
{{% /expand %}}

[SymfonyEventDispatcher]: https://symfony.com/doc/current/event_dispatcher.html
[ContaoHooks]: /framework/hooks
[BackEndRoutes]: /guides/back-end-routes
[webignition/robots-txt-file]: https://github.com/webignition/robots-txt-file
[KnpMenuBundle]: https://symfony.com/doc/current/bundles/KnpMenuBundle/index.html
