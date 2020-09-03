---
title: "Page Controllers"
description: "Implementing Contao page types as controllers."
---

{{< version "4.10" >}}

Starting with Contao **4.10** you can implement so called _Page Controllers_. These
are special page types implemented as controllers in order to handle the request
to the route of a specific page type within the Contao site structure.


## Registering Page Controllers

As with content elements, front end modules, hooks and DCA callbacks, Page controllers
can also be registered via annotations. The following shows the most basic example:

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
`contao.tag`.

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

Now we are all set and can add this new page type in the site structure of the Contao
back end:

![Custom page type in the Contao back end](/framework/images/custom-page-type-back-end.png?classes=shadow)

The alias will be the "route" of this controller. When accessing
`https://example.com/route/to/example/page/controller` in the front end, you should
see the `Hello World!` response.


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

For instance, with the following annotation:

```php
/**
 * @Page(path="/foo/bar")
 */
```

the URL of the page will _always_ be `https://example.com/foo/bar`, no matter what
is defined in the back end.

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
of the page will be `https://example.com/example/alias/foo/bar`.


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
end URL will be `https://example.com/foo/bar.csv`.


### `contentComposition`

This is a boolean property defining whether this page type is used for 
_content composition_. By default, custom page types implemented via page controllers
do not have content composition enabled, meaning you are not able to add page articles
to that page in the back end. If your page handles the rendering of page articles
then you need to enable this property on your page controller:

```php
/**
 * @Page(contentComposition=true)
 */
```


[SymfonyRouting]: https://symfony.com/doc/current/routing.html
