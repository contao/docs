---
title: "Caching"
description: "HTTP caching in Contao"
alias:
  - /framework/caching/
---


Contao heavily relies on HTTP caching and tries its very best to comply to the HTTP standards to provide the best
performance possible.

It's thus essential that you understand the basics of HTTP caching. Before we get into details of Contao too much, let's
talk HTTP basics first.


## Private and Shared Caches

A `Private Cache` is a cache that is intended for a single user only and must not be stored by a shared cache.
A `Shared Cache` is a cache that can be shared amongst many users. It's also known as `Public Cache` or `Reverse Proxy Cache`.

Whether your response can only be cached by a single user only or also by a `Shared Cache` that sits between Contao
and the client can be controlled very easily using the `Cache-Control` header:

```php
use Symfony\Component\HttpFoundation\Response;

/** @var Response $response */
$response->headers->set('Cache-Control', 'private'); // private
$response->headers->set('Cache-Control', 'public'); // public
```


## Caching methods

The three caching methods involve:

1. Cache Expiration
2. Cache Validation
3. Cache Invalidation

All of them cover a different use case and `Cache Invalidation` only works for `Shared Caches`.
Let's dive a bit more into them.


### Cache Expiration

Using `Cache Expiration` you can control how long a cache entry will be kept in the cache until it expires.
Essentially you have two different headers here: `Expires` and `Cache-Control`.
We've already seen `Cache-Control` before where we wanted to control whether a cache entry is targeted at a single
user only or if it can be cached by a `Shared Cache`. But `Cache-Control` can combine multiple directives which is
why Symfony provides an abstraction to it so you don't have to write the `Cache-Control` header yourself:

```php
use Symfony\Component\HttpFoundation\Response;

/** @var Response $response */
$response->headers->addCacheControlDirective('private'); // private
$response->headers->addCacheControlDirective('max-age', 60); // can be stored for 60 seconds
```

```php
use Symfony\Component\HttpFoundation\Response;

/** @var Response $response */
$response->headers->addCacheControlDirective('public'); // public
$response->headers->addCacheControlDirective('s-maxage', 60); // can be stored for 60 seconds on the shared cache
$response->headers->addCacheControlDirective('max-age', 600); // can be stored for 600 seconds in the private cache
```

You can read more on the different headers for example on [MDN web docs][2] which is an excellent resource.


### Cache Validation

Sometimes it's not possible to define how long a cache entry can be cached. A request then has to be made to the server
but yet still, if the content still is the same, it does not need to be sent over the wire again.
That's when `Cache Validation` comes into place. Whether or not a cache entry is still valid can be determined by two
different methods:

* Date based
* Key based

You can either send a `Last-Modified` header that contains a date or an `ETag` header that associates your response
with a certain unique key. When the client then requests the server again, it can send along the `If-Not-Modified-Since`
or `If-None-Match` headers to ask the server to only redeliver the content if it wasn't modified since the last
modified date or if it does not match the last provided `ETag`. If the response is unmodified, the server can reply
with a `304 Not Modified` HTTP response without any content, otherwise the regular response with an updated `Last-Modified`
or `ETag` header is sent.

Read more on `Cache Validation` on [MDN web docs][2] and in the [Symfony documentation](https://symfony.com/doc/current/http_cache/validation.html).


### Cache Invalidation

The best way to cache would be "forever until I tell you that the cache entry is now invalid". `Cache Invalidation` does
exactly that except for the fact that in the world of HTTP "forever" means "1 year". It's impossible to have cache entries
that last longer than a year.
Now to be able to tell a cache that it shall invalidate a previously sent response, you need access to it. In other words
this method only applies to `Shared Caches` where we have access to and know how certain cache entries can be invalidated.

Sounds pretty advanced, why do we need that?

Every Contao Managed Edition ships with the Symfony Reverse Proxy (`HttpCache`). That means, every Contao setup provides
a reverse proxy aka `Shared Cache` that is able to cache our generated responses. It's thus very important you get your
caching headers right, otherwise you'll suddenly end up having responses of e.g. your content elements being cached even
if they were not meant to.

The whole caching framework around Contao is built on top of the awesome [FOSHttpCacheBundle][3] which allows different
reverse proxies to be configured. As outlined before, Contao comes pre-configured using Symfony's `HttpCache` as proxy but
uses the alternative storage back end [toflar/psr6-symfony-http-cache-store][1] which is a bit more advanced and in
contrast to the one provided by Symfony itself also supports cache invalidation by tags.

So when you generate a response, you can tag it by any number of tags and later on, purge them.
Let's say you had a news entry with ID 42 and you want to make sure that whenever a back end user modifies e.g. the news
title, all pages that may list this news entry somewhere must be invalidated.
You'll certainly have a detail page of that news but potentially there are also pages that may show the title of this news
such as a news archive module or maybe a sidebar that lists the latest news entries.
You'll end up having multiple pages that need to be invalidated:

* https://www.example.com/news/my-super-news-item.html (detail page)
* https://www.example.com/news.html (news list)
* https://www.example.com (latest news in the sidebar)
* https://www.example.com/archive/news.html (news archive)

Now what you can do is whenever your news ID 42 is used somewhere, you'll just tag that response with a tag `news-42`
which will associate all of these four URLs with the tag `news-42`.
You can then ask the reverse proxy to purge all responses associated with the tag `news-42` when the back end user
edits that news entry.

Contao provides a nice framework for that so you don't have to re-invent the wheel over and over again.
Make sure you inject the service `fos_http_cache.http.symfony_response_tagger` and add your desired tags to this
service. It will collect all the tags during the current request and add them to the response using a `kernel.response`
event listener (if you've never heard of those, please head over to [the Symfony docs][4]).

This might look something like this:

```php
// src/Controller/MySuperController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use FOS\HttpCache\ResponseTagger;

class MySuperController
{
    /**
     * @var ResponseTagger
     */
    private $responseTagger;
    
    public function __construct(ResponseTagger $responseTagger)
    {
        $this->responseTagger = $responseTagger;
    }
    
    public function __invoke(): Response
    {
        $this->responseTagger->addTags(['news-42']);
        
        return new Response();
    }
}
```

If you are working with Contao fragments such as content elements, front end modules etc. note that you may want to
extend the `Contao\CoreBundle\Controller\AbstractFragmentController` and use its `tagResponse()` method for
convenience:

```php
// src/Controller/ContentElement/MyContentElementController.php
namespace App\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\ServiceAnnotation\ContentElement;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @ContentElement(category="texts")
 */
class MyContentElementController extends AbstractContentElementController
{
    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
        // Do your stuff
        
        $this->tagResponse(['news-42']);
        
        return $template->getResponse();
    }
}
```

To invalidate a given set of tags, inject the service `fos_http_cache.cache_manager` which might look like so:

```php
// src/EventListener/UserChangedSomethingListener.php
namespace App\EventListener;

use FOS\HttpCacheBundle\CacheManager;

class UserChangedSomethingListener
{
    /**
     * @var CacheManager
     */
    private $cacheManager;
    
    public function __construct(CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }
    
    public function onUserChangedSomething()
    {
        $this->cacheManager->invalidateTags(['news-42']);
    }
}
```

Invalidation requests will be collected during the same request too and only be executed during the `kernel.terminate`
event.


#### Cache tag invalidation within the Contao back end

When working with DCAs in the Contao back end you don't have to register callbacks at various places to make sure certain
tags are being invalidated. This is because Contao invalidates a certain set of tags whenever a back end entry is created,
updated or deleted. The tags are as follows:

* `contao.db.<table-name>`
* `contao.db.<table-name>.<id>`
* `contao.db.<parent-table-name>` (only if there is a parent table defined)
* `contao.db.<parent-table-name>.<pid>` (only if there is a parent record)

So let's say you had a DCA table named `tl_news`. When you edit ID `42`, Contao would automatically send an invalidation
request to the reverse proxy to invalidate all responses associated with the tags `contao.db.tl_news` and `contao.db.tl_news.42`.
If you follow this convention and tag your responses accordingly in the front end, you don't have to do any work in the
back end at all!

Moreover, you don't have to register to all the different callbacks such as `onsubmit_callback` or `ondelete_callback`.
You can register to the [`oninvalidate_cache_tags` callback][5] and add your own tags.


## Caching Fragments

In Contao, content elements and front end modules can be implemented as so called
_fragment controllers_. These fragments are then rendered with their defined renderer
and merged into the main content. Each fragment returns a response and thus can
tell whether it can be cached or not.


There are two fundamentally different ways to render fragments:
 1. **Inline:** Inside the main page request and merged with the content before caching. In Symfony, this is handled
    by the `inline` renderer, but Contao provides its own default `forward` renderer, which copies the original
    request (whereas Symfony does not) to e.g. pass POST data to the subrequest.
 2. **Subrequest:** By generating an (internal) URL for the fragment, the fragment content is merged **after** caching
    the page, which allows a fragment to have a different cache time than the main page. The `esi` renderer tells
    the reverse proxy (cache) to fetch multiple URLs on a request and merge fragments before delivering to the client.
    There's also an `hinclude` renderer, which merges fragments in the browser using JavaScript, but there's hardly
    any use case for this anymore today.


### Inline Fragments

{{% notice note %}}
Before **Contao 4.9**, inline fragments cannot affect the cache time of the page response.
{{% /notice %}}

By default, fragments like frontend modules and content elements are rendered directly inside the main request.
This means the content of an inline fragment will be cached for as long as the page is cached, per definition
in the page setting. If a fragment returns caching information in its response, the page's cache time and the fragment
will be merged to the lowest common denominator. For example, if the page is cacheable for a day, but the fragment
only for one hour, the whole page will only be cached for one hour.

A more common use case would be something like a `{{date::Y}}` insert tag, which renders the current year. This
fragment is cacheable until the end of 31st of December. If the page is cached on the 10th of December for one day,
the page cache time will not be affected. However, if the page is cached at 12pm on the 31st of December, the cache
time will be lowered to 12 instead of 24 hours. The page cache will expire at the end of the year and regenerated
on the 1st of January.


{{%expand "How this works under the hood" %}}
A `Response` object in Symfony is `Cache-Control: private` by default. This means we cannot *always* merge an
inline fragment, otherwise all pages would be uncacheable by default. To work around this, we've added a little
trick: the response must have a specific header to be merged.

```php
use Symfony\Component\HttpFoundation\Response;

/** @var Response $response */
$response->headers->set('Contao-Merge-Cache-Control', true);
```

This *trick* is automatically applied if a response is generated from a Contao template. A fragment controller
can affect the cache lifetime by setting it on the template response:

```php
// src/Controller/MySuperController.php
namespace App\Controller;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\ModuleModel;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MySuperController extends AbstractFrontendModuleController
{
    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {
        $response = $template->getResponse();
        
        $response->setPublic();
        $response->setMaxAge(3600);
        
        return $response;
    }
}
```
{{% /expand%}}


### Edge Side Includes (ESI)

By setting the fragment renderer to `esi`, the fragment will be cached **separately** from the main content.
The page can be cached for 24 hours, but the frament can be cached for one week. On every request to the page,
the reverse proxy will merge the two pieces, rebuilding each if its cache has expired.

A common use case for this is a fragment that can certainly be cached longer than the current page, but is
expensive to generate. Something like a weather preview, which requires an API request, but only updates once a day.
Do not use ESI if your fragment is inexpensive to generate (like the `{{date::Y}}` insert tag). For inexpensive
cases, it is most likely better to cache the whole page and **re-generate more often** than having to merge multiple
fragments **on each request**.

Symfony automatically detects if it is talking to  a gateway cache that supports ESI
(like Symfony's built in reverse proxy, that the Contao Managed Edition uses). ESI is also supported by
reverse proxies like Varnish and several major CDNs. If ESI is not supported by the
reverse proxy, the fragments will be rendered *inline* automatically.

See also [Symfony's documentation][esi] on _Edge Side Includes_.



[1]: https://github.com/Toflar/psr6-symfony-http-cache-store
[2]: https://developer.mozilla.org/en-US/docs/Web/HTTP/Caching
[3]: https://foshttpcachebundle.readthedocs.io/en/latest/
[4]: https://symfony.com/doc/current/components/http_kernel.html
[5]: /reference/dca/callbacks/#config-oninvalidate-cache-tags
[esi]: https://symfony.com/doc/current/http_cache/esi.html
