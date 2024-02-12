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

{{% notice info %}}
For Page Controllers to work the [_Legacy Routing Mode_](https://docs.contao.org/manual/en/site-structure/website-root/#legacy-routing-mode)
must be disabled in your application configuration:

```yaml
contao:
    legacy_routing: false
```
{{% /notice %}}


## Registering Page Controllers

As with content elements, front end modules, hooks and DCA callbacks, Page controllers
can be registered via attributes, annotations or YAML. The following shows the most basic example:

{{< tabs groupId="attribute-annotation-yaml" >}}
{{< version-tag "4.13" >}}

{{% tab name="Attribute" %}}
```php
// src/Controller/Page/ExamplePageController.php
namespace App\Controller\Page;

use Contao\CoreBundle\DependencyInjection\Attribute\AsPage;
use Symfony\Component\HttpFoundation\Response;

#[AsPage]
class ExamplePageController
{
    public function __invoke(): Response
    {
        return new Response('Hello World!');
    }
}
```
{{% /tab %}}

{{% tab name="Annotation" %}}
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
{{% /tab %}}

{{% tab name="YAML" %}}
```yaml
# config/services.yaml
services:
    App\Controller\Page\ExamplePageController:
        tags: [contao.page]
```
```php
// src/Controller/Page/ExamplePageController.php
namespace App\Controller\Page;

use Symfony\Component\HttpFoundation\Response;

class ExamplePageController
{
    public function __invoke(): Response
    {
        return new Response('Hello World!');
    }
}
```
{{% /tab %}}
{{< /tabs >}}

Without any additional parameters, the type of the page is inferred from the class name. In
this case the type of the page will be `example`, since suffixes like `Page` and
`Controller` (or both together) are automatically ignored.

Next a palette for the back end should be defined for this page type:

```php
// contao/dca/tl_page.php
$GLOBALS['TL_DCA']['tl_page']['palettes']['example'] =
    '{title_legend},title,alias,type;{publish_legend},published,start,stop';
```

A translation for the back end label should be defined to:

```php
// contao/languages/en/default.php
$GLOBALS['TL_LANG']['PTY']['example'] = ['Example', 'Example page type.'];
```

Now we are all set and can add this new page in the site structure of the Contao
back end:

![Custom page type in the Contao back end]({{% asset "images/dev/framework/custom-page-type-back-end.png" %}}?classes=shadow)

The alias will be the "route" of this controller. When accessing
`https://example.com/route/to/example/page/controller` in the front end, you should
see the `Hello World!` response.

{{% notice tip %}}
You might want to implement pages that should only exist once within a website (see
Contao's 401, 403 and 404 error pages for example). Use the [`FilterPageTypeEvent`](/reference/events/#filterpagetypeevent)
to dynamically limit which pages are available for selection in the back end.
{{% /notice %}}


## Parameters

In principle, the `AsPage` attribute and `@Page` annotation allows you to set parameters that you would
normally be able to define with regular controllers, like `requirements`, `options`,
`methods` and `defaults` for request attributes. See the [Symfony routing documentation][SymfonyRouting]
for these possibilities.

There are however a few differences and additional options.

{{< tabs groupId="attribute-annotation-yaml" >}}
{{< version-tag "4.13" >}}

{{% tab name="Attribute" %}}
```php
#[AsPage(
    type: 'example',
    path: '/foo/bar',
    urlSuffix: '.html',
    contentComposition: true
)]
```
{{% /tab %}}
{{% tab name="Annotation" %}}
```php
/**
 * @Page(
 *   type="example",
 *   path="/foo/bar",
 *   urlSuffix=".html",
 *   contentComposition=true
 * )
 */
```
{{% /tab %}}
{{% tab name="YAML" %}}
```yaml
# config/services.yaml
services:
    App\Controller\Page\ExamplePageController:
        tags:
            -
                name: contao.page
                type: example
                path: /foo/bar
                urlSuffix: .html
                contentComposition: true
```
{{% /tab %}}
{{< /tabs >}}


### `type`

As mentioned previously, the type is automatically inferred from the page controller's
class name, if not specified. If you want to specifically set the type string yourself,
you can pass it as the first parameter of the annotation (or use `type="custom_type"`).

```php
#[AsPage(type: 'custom_type')]
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
#[AsPage(path: '/foo/bar')]
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
#[AsPage(path: 'foo/bar')]
```

and an alias like `example/alias` defined in the back end, the final front end URL
of the page will be `https://example.com/example/alias/foo/bar.html`.

Also, just like with routes for regular controllers in Symfony, the path of your page controller can also contain
parameters. The following page route for example only consists of a single `foobar` parameter:

```php
#[AsPage(path: '{foobar}')]
```

Since it is defined as a relative path the final URL will consist of the page's alias, plus any mandatory parameter.
This particular setup would be useful for reader pages for example. And, as with regular Symfony routes, parameters can
also be optional through its `defaults`:

```php
#[AsPage(path: '{lorem}/{ipsum}', defaults: ['ipsum' => ''])]
```


### `urlSuffix`

Since Contao **4.10** you can define the URL suffix of a site in the settings of
the respective website root. However, with page controllers you can also override
that URL suffix in the page controller's configuration:

```php
#[AsPage(urlSuffix: '.csv')]
```

So if the page in the site structure has the alias `foo/bar` then the final front
end URL will be `https://example.com/foo/bar.csv` even though the root page's url 
suffix might be `.html`.


### `contentComposition`

This is a boolean property defining whether this page type is used for 
_content composition_. Pages with content composition manage their content and
layout via the back end. For example an RSS feed page controller
would not use content composition, since its content is not supposed to be editable
via the back end. By default, content composition is enabled.

If you do not want to use content composition for your page controller, thus
you do not want that articles can be assigned to those pages, disable the property:

```php
#[AsPage(contentComposition: false)]
```

There is no abstraction yet in place for you to render such content
easily. You _can_ use the `FrontendIndex` class of the legacy framework of Contao
to render the page layout as defined in the page structure (in addition to processing 
your own logic):

```php
// src/Controller/Page/ExamplePageController.php
namespace App\Controller\Page;

use Contao\CoreBundle\DependencyInjection\Attribute\AsPage;
use Contao\FrontendIndex;
use Contao\PageModel;
use Symfony\Component\HttpFoundation\Response;

#[AsPage]
class ExamplePageController
{
    public function __invoke(PageModel $pageModel): Response
    {
        // Render the page using the FrontendIndex handler from the legacy framework
        return (new FrontendIndex())->renderPage($pageModel);
    }
}
```

However, upcoming feature versions of Contao will likely provide better abstraction
for this task.


## Page Model

In Symfony you can require the current `Request` object to be passed into your invokable
controller or action method as an argument (see the [Controller documentation][SymfonyRequestArgument]).
Contao also extends [Symfony's argument value resolver][SymfonyArgumentValueResolver] 
and thus allows you to automatically pass the `PageModel` of the page controller's
page as an argument as well:

```php
// src/Controller/Page/ExamplePageController.php
namespace App\Controller\Page;

use Contao\CoreBundle\DependencyInjection\Attribute\AsPage;
use Contao\PageModel;
use Symfony\Component\HttpFoundation\Response;

#[AsPage]
class ExamplePageController
{
    public function __invoke(Request $request, PageModel $pageModel): Response
    {
        return new Response('Hello page: '.$pageModel->title);
    }
}
```


## URL Generation

Within the database all pages are stored in the `tl_page` table. An entry for a page will be created there when you 
create a new page for any page type (including your page controllers). Instances of pages in Contao are generally 
represented by the `Contao\PageModel`. This class allows you to generate URLs to pages via its `getFrontendUrl` and
`getAbsoluteUrl` method. The former will generate URLs relative to the `<base>` - unless the page is on a different
domain than the current one. The latter will always produce absolute URLs (including `http://` or `https://`).

{{% notice "note" %}}
{{< version-tag "5.0" >}} `getFrontendUrl` will now generate _path absolute_ URLs, not relative to the `<base>`.
{{% /notice %}}

Both methods allow you to specify optional parameters as one string. These are _path_ parameters and are used when you
want to generate a URL with an `auto_item` or other path parameters. For example

```php
$page->getAbsoluteUrl();
```

might generate a URL like `https://example.com/alias-of-the-page.html` while

```php
$page->getAbsoluteUrl('/foobar');
```

might generate a URL like `https://example.com/alias-of-the-page/foobar.html` (in these examples a `.html` suffix would 
be configured).

This works fine for any legacy page type. However, with modern page controllers there is a caveat: your `Route` might
have specific, mandatory parameters in them that need to be known when generating the URL. So for example if you have a 
page controller like this

```php
#[AsPage(path: '{foo}/{bar}')]
```

and you then try to execute `$page->getFrontendUrl()` for a `PageModel` of such page it will result in an error, since
the parameters `foo` and `bar` are missing for URL generation.

But for modern page controllers you can generate the URL for such pages in your code via Symfony's 
`UrlGeneratorInterface` services:

```php
use Contao\PageModel;
use Contao\CoreBundle\Routing\Page\PageRoute;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class MyService
{
    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
    }

    private function getUrlForPage(PageModel $page): string
    {
        return $this->urlGenerator->generate(
            PageRoute::PAGE_BASED_ROUTE_NAME,
            [
                RouteObjectInterface::CONTENT_OBJECT => $page, 
                'foo' => 'lorem',
                'bar' => 'ipsum',
            ]
        );
    }
}
```

The important thing to note here is that the name of the route we are generating is not the name or type of the
page controller, but a general `page_routing_object` route - and then we pass the model instance of the page as a
`_content` parameter, alongside our actual route parameters (`foo` and `bar`).

{{< version-tag "5.3" >}} Starting with Contao **5.3** you are able to use `getFrontendUrl` and `getAbsoluteUrl` of
the `PageModel` as well though. Instead of a string representing path parameters you can instead pass an array with the
parameters to the methods:

```php
$page->getFrontendUrl([
    'foo' => 'lorem',
    'bar' => 'ipsum',
]);
```


[SymfonyRouting]: https://symfony.com/doc/current/routing.html
[RoutingInContao]: /framework/routing/
[FilterPageTypeEvent]: /reference/events/#filterpagetypeevent
[SymfonyRequestArgument]: https://symfony.com/doc/4.4/controller.html#the-request-object-as-a-controller-argument
[PageModelRequestAttribute]: /framework/routing/#page-model
[SymfonyArgumentValueResolver]: https://symfony.com/doc/4.4/controller/argument_value_resolver.html
