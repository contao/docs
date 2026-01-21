---
title: "Legacy Parameters"
description: "Legacy routing parameters in Contao"
alias:
  - /framework/routing/legacy-parameters/
---


A common requirement when building a site is the ability to pass various parameters via the URL of a page in order to
display specific or different content, e.g. via a front end module. The most basic form of parameter is the query
parameter which can easily be retrieved from Symfony's request object. However, you will often want to include such
parameters in the URL's path in order to make them easily readable for example.

When building a Symfony controller or a Contao [page controller][PageController], these path parameters can be defined 
in the route's configuration.

However, it is also possible to pass such path parameters for legacy page types - like Contao's `regular` page. If we
inspect Symfony's routing table for such a page we might see the following (abbreviated):

```none
$ vendor/bin/contao-console debug:router tl_page.2
+--------------+------------------------------------------------------------------+
| Property     | Value                                                            |
+--------------+------------------------------------------------------------------+
| Route Name   | tl_page.2                                                        |
| Path         | /news{!parameters}                                               |
| Requirements | parameters: (/.+?)?                                              |
+--------------+------------------------------------------------------------------+
```

In this case it is a page with the alias `news` - but after its alias there is an optional parameter called 
`{parameters}`. So Contao by default allows all these routes to have arbitrary parameters after the page's alias (and
before the URL suffix).

Internally, Contao will then check if these parameters have a certain structure - and if they are retrieved through the
legacy `Input::get()` method. Otherwise a `PageNotFoundException` will be thrown and the front end will thus render the
404 page.

Generally Contao will analyze the URL fragments (i.e. the parts of the URL separated by a forward slash) coming after 
the page's alias. The following describes what kind of parameters we can pass to such regular pages and how to retrieve 
them.


## The "Auto Item"

If the number of fragments after the page alias is odd, then the first of these fragments will be regarded as the so
called "auto item" (`auto_item`). Let's look at an example:

* Assume you have a regular page with an alias called `news/detail`.
* The full URL to this page will be `https://example.com/news/detail`.
* If we however pass an additional parameter after the alias, let's say `https://example.com/news/detail/some-news`, then
`some-news` will become the value of the `auto_item` parameter (assuming no actual page with the alias 
`news/detail/some-news` exists and has a higher routing priority).

As mentioned before, this `auto_item` parameter can be retrieved via the legacy `Input` class of Contao:

```php
use Contao\Input;

// Will contain 'some-news'
$autoItem = Input::get('auto_item');
```

Executing this code somewhere (e.g. in a news reader module) will thus mark the `auto_item` as _used_ and no 404 page
will be generated.

{{% notice "warning" %}}
Careful: do _not_ use `Input::get('auto_item')` in any part of your code that is executed on every request, e.g. in a
module that is included in the layout of a page, or a hook that is executed on every page. This will cause _all_ URLs
with such "auto items" to not show a 404 page, even though they ought to, depending on each instance. You can instead
enable the `$blnKeepUnusedRouteParameter` parameter for such cases:

```php
$autoItem = Input::get('auto_item', false, true);
```
{{% /notice %}}


## Key Value Parameters

If the number of fragments after the page alias is even, then the fragments will be considered key & value pairs.
If the number of fragments after the page alias is odd - but equal or greater than 3, then the first fragment is
considered the `auto_item` (see above) while the rest are again key & value pairs. Let's look at an example:

* Assume you have a regular page with an alias called `foo/bar`.
* The full URL to this page will be `https://example.com/foo/bar`.
* We can pass additional key/value pairs as path fragments to this URL, for example: 
`https://example.com/foo/bar/lorem/ipsum/dolor/sit`.
* This URL will then consist of the key & value pairs `lorem=ipsum`, `dolor=sit`.

As mentioned before, these parameters can then be retrieved via the legacy `Input` class of Contao:

```php
use Contao\Input;

// Will contain 'ipsum'
$lorem = Input::get('lorem');

// Will contain 'sit'
$dolor = Input::get('dolor');
```

* Assume you have a regular page with an alias called `foo/bar`.
* The full URL to this page will be `https://example.com/foo/bar`.
* We can pass an "auto item" and additional key/value pairs as path fragments to this URL, for example: 
`https://example.com/foo/bar/some-news/lorem/ipsum/dolor/sit`.
* This URL will then consist of an `auto_item` and the key & value pairs `lorem=ipsum`, `dolor=sit`.

```php
use Contao\Input;

// Will contain 'some-news'
$lorem = Input::get('auto_item');

// Will contain 'ipsum'
$lorem = Input::get('lorem');

// Will contain 'sit'
$dolor = Input::get('dolor');
```


[PageController]: /framework/page-controllers/
