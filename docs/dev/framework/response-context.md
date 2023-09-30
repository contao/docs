---
title: "Response Context"
description: "The Response Context is a concept special to Contao."
alias:
  - /framework/response-context/
---

{{< version "4.12" >}}

This section describes the "Response Context" concept. A concept that is special
to Contao and thus deserves its own section in the documentation.

## Motivation

Content Management Systems do not share all the same properties as static site generators, or your
good old Symfony based website.
In a traditional Symfony application, you as the developer control 100% of the output of
a particular HTML website. Speaking in Symfony terms, your controller 
controls the full `Response` instance, from its HTTP headers to its content, everything from
the opening `<html>` to the closing `</html>`, all the scripts, the stylesheets, the page title and
the description.

In Contao, however, most of the content is dynamically created. That's why it's a Content Management
System after all. Let's take e.g. a news reader front end module as an example. It displays the 
detail of a certain news entry and thus also would like to adjust the `<title>` tag in the `<head>`
section of the HTML document. The controller, however, does not know if that news reader front end module
was placed on that page and the front end module on the other hand does not even know if there is a `<title>`
element it can update.
The news reader element is a fragment only so it can be used in a completely different context other than a
regular HTML web page. E.g. it could be rendered as an ESI fragment, a partial loaded via Ajax or rendered into
an e-mail. In all cases there is no `<title>` element to update.

The "Response Context" is here to solve this problem.

## Process overview

1. Contao determines the responsible [Page Controller](/framework/page-controllers/) based on the URL that
was requested by the visitor.
2. The Controller knows in which context it is used. It has access to the `Request` and produces the `Response`.
It now defines the `ResponseContext` and its capabilities. It then renders the different fragments into its content.
3. The different fragments can access the current `ResponseContext` (could also be that there's none!) and can
check for its capabilities. Depending on what they can do, they can decide what they want to do (e.g. update the
page title).
4. The Page Controller applies the changes of the `ResponseContext` in the way it thinks is correct, produces the `Response`
and finishes the current `ResponseContext`.
   
## Creating a Response Context

The `ResponseContext` class is a container for capabilities. Basically, a capability is just a "service" that can
be accessed by its class name or in case it implements interfaces, by their respective interfaces.
Setting and accessing the current `ResponseContext` is simplified by the `ResponseContextAccessor`:

```php
// src/Controller/Page/ExamplePageController.php
namespace App\Controller\Page;

use Contao\CoreBundle\DependencyInjection\Attribute\AsPage;
use Contao\PageModel;
use Contao\CoreBundle\Routing\ResponseContext\HtmlHeadBag\HtmlHeadBag;
use Contao\CoreBundle\Routing\ResponseContext\ResponseContext;
use Contao\CoreBundle\Routing\ResponseContext\ResponseContextAccessor;
use Symfony\Component\HttpFoundation\Response;

#[AsPage]
class ExamplePageController
{
    private ResponseContextAccessor $responseContextAccessor;
    
    public function __construct(ResponseContextAccessor $responseContextAccessor)
    {
        $this->responseContextAccessor = $responseContextAccessor;
    }
    
    public function __invoke(Request $request, PageModel $pageModel): Response
    {
        $responseContext = new ResponseContext();
        $responseContext->add(new HtmlHeadBag());
        $this->responseContextAccessor->setResponseContext($responseContext);
        
        // Render elements, front end modules, everything can access the current context
        // by checking e.g. $responseContext->has(HtmlHeadBag::class) and do something with it.
        
        // Setting e.g. the <title>
        $myHtmlContent = '<html><head><title>%s</title></head><body>Content</body></html>';
        $myHtmlContent = sprintf($myHtmlContent, $responseContext->get(HtmlHeadBag::class)->getTitle());
        
        $response = new Response($myHtmlContent);
        $this->responseContextAccessor->finalizeCurrentContext($response);
        return $response;
    }
}
```


{{% notice tip %}}
The `ResponseContext` also contains an `addLazy()` method which you should always prefer over `add()` if you can.
Just because your controller provides a capability in the context does not mean there's even any module or element
going to use it. We can save some resources by making them lazy.
{{% /notice %}}


## The core capabilities/services

The Contao `core-bundle` ships with currently two core services which you can reuse.

{{% notice tip %}}
Have a look at the `CoreResponseFactory` in case you want to reuse the default Contao `ResponseContext`.
{{% /notice %}}

### The `HtmlHeadBag`

The class name of the `HtmlHeadBag` service already implies, that this will have more capabilities in the future.
The goal should be to be able to manage everything within `<head>` dynamically.
Right now, it's a very basic service that allows you to override `<title>` by calling `setTitle()`. Same goes for
`setMetaDescription()` and `setMetaRobots()`.

{{< version "4.13" >}}

As of Contao 4.13 and if enabled in the root page settings, Contao will also generate a `rel="canoncial"` link pointing to
itself while removing all the query parameters from the current URL. Alternatively, the user can provide a custom other URL and
configure the query parameters which should be kept (e.g. if `?foobar=42` is relevant, they add `foobar` in which case
it would not get removed). You can also dynamically adjust the behaviour to your needs using the `HtmlHeadBag` and for
example automatically mark a certain query parameter to always be kept to have the users not even require to add it
in their page settings:

* `setKeepParamsForCanonical()` - overrides the query parameters to keep
* `addKeepParamsForCanonical()` - adds a query parameter name to the (possibly) already existing array of parameters to keep
* `setCanonicalUri()` - completely set the URL yourself


### The `JsonLdManager`

The `JsonLdManager` is a central place to manage JSON-LD data collected within all the elements. 
It is capable of managing multiple schemas, but the most likely use case will be `schema.org` data
which is why this is used as an example here:

```php
<?php

use Contao\CoreBundle\Routing\ResponseContext\JsonLd\JsonLdManager;
use Contao\CoreBundle\Routing\ResponseContext\ResponseContext;
use Spatie\SchemaOrg\ImageObject;

// This is how the JsonLdManager is created
$schemaManager = new JsonLdManager(new ResponseContext());

// This is how you would access it from the current context (in case it exists)
$schemaManager = $this->responseContextAccessor->getResponseContext()->get(JsonLdManager::class);

// Get the graph for schema.org
$graph = $schemaManager->getGraphForSchema(JsonLdManager::SCHEMA_ORG);

// Add a new ImageObject
$graph->add((new ImageObject())->name('Name')->caption('Caption'));

/**
 * This will generate the following now:
 * 
 * <script type="application/ld+json">
 * [
 *     {
 *         "@context": "https:\/\/schema.org",
 *         "@graph": [
 *             {
 *                 "@type": "ImageObject",
 *                 "name": "Name",
 *                 "caption": "Caption"
 *             }
 *         ]
 *     }
 * ]
 * </script>
 */
$schemaManager->collectFinalScriptFromGraphs()
```

## Future

The Response Context will likely be the place where additional possibilities will be introduced such as

- Adding/managing `<script>` tags
- Adding/managing `<link>` tags
- Adding/managing `<meta>` tags
- ...
