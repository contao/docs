---
title: "Page Controllers"
description: "Implementing Contao page types as controllers."
---

{{< version "4.10" >}}

Starting with Contao **4.10** you can implement so called _Page Controllers_. These
are special page types implemented as controllers in order to handle the request
to the route of a specific page type within the Contao site structure. Page controllers 
combine the ability to define a page in Contao's site structure while still having 
full control over the routing and route attributes like with [regular controllers][RoutingInContao].

For example, imagine you need to provide an RSS feed or other structured feed for
entries of your own DCA. This RSS feed could be implemented as controller with its
own route. By implementing it as a page controller, you might allow the administrator
or editor of a site to freely define the route (i.e. alias) of the page, plus additional
configuration settings from within the back end of Contao. Even the suffix can be
freely defined, so you might have a list of your database records under `https://example.com/foobar/records.html`,
while the RSS feed is defined to have a route like `https://example.com/foobar/records.xml`.


## Registering Page Controllers

As with content elements, front end modules, hooks and DCA callbacks, Page controllers
can be registered via annotations. The following shows the most basic example:

```php
// src/Controller/Page/ExamplePageController.php
namespace App\Controller\Page;

use Contao\CoreBundle\ServiceAnnotation\Page;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Page
 */
class ExamplePageController
{
    public function __invoke(): Response
    {
        return new Response('Hello World!');
    }
}
```

The same can be achieved without annotations by tagging the respective service with 
`contao.page`.

Without any parameters, the type of the page is inferred from the class name. In
this case the type of the page will be `example`, since suffixes like `Page` and
`Controller` (or both together) are automatically ignored.

Next a palette for the back end should be defined for this page type:

```php
// contao/dca/tl_page.php
$GLOBALS['TL_DCA']['tl_page']['palettes']['example'] =
    '{title_legend},title,alias,type;{publish_legend},published,start,stop';
;
```

A translation for the back end label should be defined to:

```php
// contao/languages/en/default.php
$GLOBALS['TL_LANG']['PTY']['example'] = ['Example', 'Example page type.'];
```

Now we are all set and can add this new page in the site structure of the Contao
back end:

![Custom page type in the Contao back end](/framework/images/custom-page-type-back-end.png?classes=shadow)

The alias will be the "route" of this controller. When accessing
`https://example.com/route/to/example/page/controller` in the front end, you should
see the `Hello World!` response.

{{% notice tip %}}
You might want to implement pages that should only exist once within a website (see
Contao's 401, 403 and 404 error pages for example). Use the [`FilterPageTypeEvent`](/reference/events/#filterpagetypeevent)
to dynamically limit which pages are available for selection in the back end.
{{% /notice %}}


## Parameters

In principle, the `@Page` annotation allows you to set parameters that you would
normally be able to define with regular controllers, like `requirements`, `options`,
`methods` and `defaults` for request attributes. See the [Symfony routing documentation][SymfonyRouting]
for these possibilities.

There are however a few differences and additional options.

{{% expand "All specific parameters using annotations" %}}
```php
/**
 * @Page(
 *   type="example",
 *   path="/foo/bar",
 *   urlSuffix="html",
 *   contentComposition=true
 * )
 */
```
{{% /expand %}}

{{% expand "All specific parameters using the service tag" %}}
```yaml
# config/services.yaml
services:
    App\Controller\Page\ExamplePageController:
        tags:
            -
                name: contao.page
                type: example
                path: /foo/bar
                urlSuffix: html
                contentComposition: true
```
{{% /expand %}}


### `type`

As mentioned previously, the type is automatically inferred from the page controller's
class name, if not specified. If you want to specifically set the type string yourself,
you can pass it as the first parameter of the annotation (or use `type="custom_type"`).

```php
/**
 * @Page("custom_type")
 */
```

Note that this one of the differences between the `@Page` and Symfony's `@Route`
annotation where in the latter case, the first parameter is the _path_ of the route.


### `path`

For regular Symfony routes the URL of the route is only defined via the `path` parameter.
In case of page controllers the URL of the page will either be defined via its alias,
which is defined in the back end, or its configured `path` - or even a combination
of both!

For instance, with the following annotation and the default `.html` URL suffix:

```php
/**
 * @Page(path="/foo/bar")
 */
```

the URL of the page will _always_ be `https://example.com/foo/bar.html`, no matter
what is defined in the back end. This means that you should not add the `alias`
field to the palette of this page in the `tl_page` DCA.

However, if the defined path of the page configuration is a relative path rather
than an absolute one, then the URL of the page will be a combination of both the
configured path and the defined alias of the page, where the configured path of
the page will be appended to the alias of the page.

So for example, with the following annotation:

```php
/**
 * @Page(path="foo/bar")
 */
```

and an alias like `example/alias` defined in the back end, the final front end URL
of the page will be `https://example.com/example/alias/foo/bar.html`.


### `urlSuffix`

Since Contao **4.10** you can define the URL suffix of a site in the settings of
the respective website root. However, with page controllers you can also override
that URL suffix in the page controller's configuration:

```php
/**
 * @Page(urlSuffix=".csv")
 */
```

So if the page in the site structure has the alias `foo/bar` then the final front
end URL will be `https://example.com/foo/bar.csv` even though the root page's url 
suffix might be `.html`.


### `contentComposition`

This is a boolean property defining whether this page type is used for 
_content composition_. By default, custom page types implemented via page controllers
do not have content composition enabled, meaning you are not able to manage the
content and layout of this page via the back end. For example an RSS feed page controller
would not use content composition, since its content is not supposed to be editable
via the back end.

If your page handles the rendering of page articles which are managed via the back
end, then you need to enable this property on your page controller:

```php
/**
 * @Page(contentComposition=true)
 */
```

In Contao **4.10** there is no abstraction yet in place for you to render such content
easily. You _can_ use the `PageRegular` class of the legacy framework of Contao
to render the page layout as defined in the page structure (in addition to processing 
your own logic):

```php
// src/Controller/Page/ExamplePageController.php
namespace App\Controller\Page;

use Contao\CoreBundle\ServiceAnnotation\Page;
use Contao\PageModel;
use Contao\PageRegular;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Page(contentComposition=true)
 */
class ExamplePageController
{
    public function __invoke(PageModel $pageModel): Response
    {
        // The legacy framework relies on the global $objPage variable
        global $objPage;
        $objPage = $pageModel;

        // Render the page using the PageRegular handler from the legacy framework
        return (new PageRegular())->getResponse($pageModel, true);
    }
}
```

However, upcoming feature versions of Contao will likely provide better abstraction
for this task.



[SymfonyRouting]: https://symfony.com/doc/current/routing.html
[RoutingInContao]: /framework/routing/
[FilterPageTypeEvent]: /reference/events/#filterpagetypeevent
