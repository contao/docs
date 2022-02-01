---
title: 'HTTP Caching'
description: 'HTTP Caching with Contao.'
aliases:
    - /en/performance/http-caching/
---

The greatest performance gain in any application can be achieved by not having to start it at all.
In other words: We want the output that Contao generates to be saved and delivered the next time it is called without
having to even boot Contao at all.

To do so, Contao relies on the Hypertext Transfer Protocol (HTTP) - the backbone of the Internet.

Why should Contao reinvent the wheel when [smart people thought about caching
HTTP responses already when HTTP/1.1 was introduced back in 1999](https://tools.ietf.org/html/rfc2616)?

## HTTP

Back to the basics, then. To understand how HTTP caching can be configured in Contao, let's take a quick look at how HTTP,
and therefore the entire Internet and the communication of many other devices, works:

{{<mermaid align="left">}}
sequenceDiagram
    participant Client
    participant Server
    Client->>Server: Request
    Server->>Client: Response
{{< /mermaid >}}

In principle, any other intermediaries (so-called "proxies") can be connected in between, which is not only
conceivable but also very common:

{{<mermaid align="left">}}
sequenceDiagram
    participant Client
    participant Proxy 1
    participant Proxy 2
    participant Server
    Client->>Proxy 1: Request
    Proxy 1->>Proxy 2: Request
    Proxy 2->>Server: Request
    Server->>Proxy 2: Response
    Proxy 2->>Proxy 1: Response
    Proxy 1->>Client:  Response
{{< /mermaid >}}

These proxies can perform any tasks, including but not limited to

- Load Balancing (distribute high load on different servers)
- CDN tasks (lower latency due to geographically shorter distances to the client)
- Authentication/Authorization
- Encryption (SSL/TLS)
- Applying optimizations (e.g. compression)
- and of course: **Caching!**

To allow the client (in our case mostly the browser), the server and intermediaries to communicate with each other,
every HTTP request and every HTTP response can be enhanced with metadata. These so called "HTTP headers" are
standardized but it is up to every developer to invent and use additional headers.
E.g. a typical request could look like this:

```http
GET /about-us.html HTTP/1.1

Accept-Language: de,en
Host: www.contao.org
```

In this case the client would like to request the resource that is at `/about-us.html` and it tells the server that it
understands the languages `en` and `de` (German) whereas it prefers `de` over `en`. It also requests the response from
the host `www.contao.org`.
Remember, the communication between client and server uses TCP/IP and one server can serve any number of domains so
it is important to tell the server which one you'd like.

A response to this could look like this:

```http
HTTP/1.1 200 OK

Content-Type: text/html; charset=utf-8
Content-Length: 42
Cache-Control: max-age=3600

<html>
...
</html>
```

Here, the server tells us that everything was fine (`200 OK`). The response contains `UTF-8` encoded `HTML` and is `42`
bytes long. In addition, this response may be cached for `3600` seconds, i.e. one hour.

## The HTTP Caching Headers

There are a number of HTTP headers that are relevant for HTTP caching. To explain them all would go beyond the
scope of this documentation. The topic is also already [extremely well documented on MDN](https://developer.mozilla.org/en-US/docs/Web/HTTP/Caching),
so you can learn more there if you are interested.

The regular user of Contao is mainly interested in the `Cache-Control` header and the three most important attributes:

- `private` or `public`
  
  Tells a client whether the response is private or public. The browser, for example, may cache both private and public
  responses, since it does not pass on the response. A proxy, on the other hand, may not cache private responses, because
  it passes the response on. They cannot be combined. Something that can be cached publicly can also be cached privately,
  so a public (`public`) response implicitly means that multiple clients share the same cache entry. This is why we also
  speak of a "shared cache" in this case.

- `max-age`
  
  Contains the number of seconds any client may cache this response.

- `s-maxage`
  
  Contains the number of seconds a public client is allowed to cache this response. This attribute is only used if
  the cache duration should be different for public and private clients.

For better understanding, let's look at a few examples:

| HTTP header | Interpretation |
| ----------- | -------------- |
| `Cache-Control: max-age=3600` | Only private clients may cache this response for one hour. |
| `Cache-Control: max-age=3600, private` | Only private clients may cache this response for one hour. |
| `Cache-Control: max-age=3600, public` | Both public and private clients may cache this response for one hour. |
| `Cache-Control: max-age=3600, s-maxage=7200, public` | Both public and private clients may cache this response. Private ones for one hour, public ones for two hours. |

And that is why you can find exactly these cache duration settings in the Contao page settings.
The following configuration translates to `Cache-Control: max-age=1800, s-maxage=3600, public`:

![Caching settings in the Contao back end](/de/performance/images/en/cache-settings.png?classes=shadow)

## Advantages of using standards

The Contao Managed Edition is shipped with a cache proxy that is written in PHP too and sits directly in front of Contao.
This means that every response that Contao generates is sent through our caching proxy before it is delivered to the client
and is cached (or not) according to the HTTP headers.

{{% notice tip %}}
It is important to understand that the included proxy knows absolutely **nothing** about Contao.
Although it is also written in PHP, it is completely independent. Everything it does is based on the headers of the HTTP
requests and responses it receives from the client and Contao.
{{% /notice %}}

The big advantage we gain by using HTTP standards is the free choice of the caching proxy.
Let's say the number of visitors gets higher and higher and PHP slowly starts reaching its limits.
Maybe you will want to try out a more powerful caching proxy which was explicitly designed for caching such
as [Varnish](https://varnish-cache.org/)?

However, this would go too far at this point.

{{% notice note %}}
Good to know for you: Whatever settings you have configured in Contao, it follows the HTTP standards and just works
out-of-the-box for you. And if one day, the requirements become more complex, Contao will not let you down! 
{{% /notice %}}

## Does the Cache Proxy cache?

This section is about what can be stored in the shared cache. We don't talk about the private cache anymore,
i.e. your personal browser cache, because we want to make sure that as many of our visitors as possible don't have to
wait for Contao to generate the response but can benefit from the shared cache instead.

We already know the most important criterion: The `Cache-Control: public` response header. If this header is missing,
the shared cache can never cache this response. But there are other criteria as well:

* The HTTP status code must either be `200 OK` , `301 Permanent Redirect`or `404 Not Found`
  (there are a number of other statuses, but they are not really relevant for us here).

* `Cache-Control` must not contain `no-store`. This value prevents any caching.

* You need to specify the cache duration, i.e `max-age` and optionally `s-maxage` in the `Cache-Control`header
  (there are additional headers here as well, but they are not relevant for us either)

In case of the included Contao cache proxy, you can easily check if caching works. All responses 
will have a `Contao-Cache` header that can take on three values:

- `miss`

  The Contao cache could not find a cache entry. Contao is started, generates the response but it
  cannot be stored in the cache.

- `miss/store`
  
  The Contao cache could not find a cache entry. Contao is started, generates the response and it is stored accordingly.
  
- `fresh`
  
  The Contao cache has found the cache entry and the response is served directly from the cache. Ideally, you should
  have already noticed the speed. In case of `Contao-Cache: fresh` there is also the HTTP `Age` header. It tells you how
  many seconds the cache entry already exists. An `Age: 120` means that this entry was created two minutes ago.

{{% notice info %}}
If the Contao Managed Edition runs in debug mode, the cache proxy is disabled entirely. 
{{% /notice %}}

## When shared caching cannot work

As we have seen, there are some basic requirements for HTTP caching to work: In addition to the requirements mentioned
above, there are other special reasons for Contao to enforce `Cache-Control: private` and thus exclude a response
from the shared cache:

- If the request contains an `Authorization` HTTP header
  
  The `Authorization` header contains standard authentication details. For Contao this means that a module or content
  element may listen to this header and potentially deliver user-specific data. To ensure that private data is not stored
  in the shared cache and potentially delivered to a different visitor, Contao forces `Cache-Control: private`. Contao will
  also tell you about this: The `Contao-Response-Private-Reason` header contains `authorization` in this case.
  
  {{% notice warning %}}
  It is very popular to protect installations using Basic Authentication during development. This means that the
  request contains an `Authorization` header and therefore the cache is always disabled. Keep this in mind when
  testing cache settings. 
  {{% /notice %}}

- If the request contains a PHP session cookie or the response sets it
  
  The most obvious case here is of course the PHP session, i.e. when a user logs into the back end or a member logs into
  the front end. In this case all responses are always `private` and the `Contao-Response-Private-Reason` header
  contains `session-cookie`.
  
- If the response contains a cookie
  
  If the response contains a cookie, it means that the developer wanted to personalize the response. The current response
  therefore potentially already contains personal data. The `Contao-Response-Private-Reason` header in this case 
  contains `response-cookies` and includes a list of the affected cookie names.
  
- If the request contains a cookie
  
  This is by far the most likely, but also the most complex case. All request cookies **can**, but do not **have to**,
  disable the cache.
  
  The rule is quite straightforward: Every cookie can potentially identify a visitor and therefore the application
  (i.e. Contao) could deliver personalized content (shopping carts, personal recommendations, logins etc.).
  Remember: The proxy is completely separate from the application, may even be located on another server in another part
  of the world and therefore has no way of knowing which cookies are relevant for the application. We have to tell it.
  
  Thus, a cache proxy is not allowed to deliver anything from the cache if the request contains a cookie.
  Let's repeat: **Every** single cookie implicitly means that the reverse proxy is bypassed.
  If we want to have a response generated from the cache, we have to make sure that **not a single cookie** finds
  its way to the cache proxy.
  
  However, there is a large number of cookies. Here are a few examples:
  
  - `_ga_*` cookies by Google Analytics
  - `_pk_*` cookies by Matomo
  - Cloudflare's `__cfduid` cookie
  - Your `cookiebar_accepted` cookie, to know if the cookie policy has been accepted
  - the list goes on…
  
  The list is quite long and the attentive reader has already discovered a fundamental difference between the
  PHP session cookie and the `_ga_*` cookie: One of them is really relevant for the application (i.e. the PHP session)
  and the other one is responsible for client-side tracking (i.e. within the browser) of the user and is
  completely irrelevant for Contao.
  
  In other words, if a request contains only a `_ga_*` cookie, we can still deliver the response from the cache,
  because this cookie does not generate any personal content. A smart cache proxy could therefore only consider
  relevant cookies and throw away all the others before deciding whether a response can be delivered from the cache.
  
  To get the highest possible hit rate when caching out-of-the-box, Contao maintains a list of irrelevant cookies
  within the Contao cache proxy. These cookies are removed from the request before cache lookup and therefore do not
  reach the cache proxy or (in case of a cache miss) Contao itself.
  
  More advanced users can override this list, see the section about configuring the Contao Cache Proxy.
  
  In the case of request cookies, the `Contao-Private-Response-Reason` header contains `request-cookies` plus a list of
  all the cookies that have not been removed.

## Configuration of the Contao Cache Proxy

The Contao Cache Proxy can be customized to a certain degree, just like Contao itself. Since Contao provides internal
lists of irrelevant cookies, it has good default settings, but you can optimize it further by adjusting
environment variables and tune it for performance.

{{% notice idea %}}
Are you wondering why Contao is configured by editing the `config.yaml` and the Contao Cache Proxy using environment variables?
The `config.yaml` for Contao itself is application configuration. The included Contao Cache Proxy, however, needs to know its
settings **before Contao** is even booted. Booting is exactly what we want to prevent.
Thus, environment variables are the best choice for configuring our proxy.
{{% /notice %}}

The following environment variables allow you to further optimize the cache proxy:


### `COOKIE_ALLOW_LIST`

{{% notice info %}}
In Contao **4.9** this environment variable is called `COOKIE_WHITELIST`.
{{% /notice %}}

This is a special environment variable related to the default caching proxy which is shipped with the Contao Managed
Edition by default.
Contao disables any HTTP caching as soon as there is either a `Cookie` or an `Authorization` header present in the
request. That is because these headers can potentially authenticate a user and thus cause personalized content to
be generated in which case, we never want to serve any content from the cache.
However, unfortunately, the web consists of tons of different cookies. Most of which are completely irrelevant to
the application itself and are only used in JavaScript (although there are better alternatives such as LocalStorage,
SessionStorage or IndexedDB). You will find that e.g. Google Analytics, Matomo, Facebook etc. all set cookies your
application (Contao in this case) is not interested in at all. However, because the HTTP cache has to decide whether to
serve a response from the cache or not before the application is even started, there's no way it can know which cookies
are relevant and which ones are not.
So, we have to tell it.
The Contao Managed Edition ships with a list of irrelevant cookies that are ignored by default to increase the hit rate
but if you want to optimize it even more, you can disable the default list by providing an explicit list of cookies
you need.
These are the cookies you know are **relevant** to the application and in this case, the cache must be **omitted**.
By default, Contao only uses the PHP session ID cookie to authenticate users and members, the CSRF cookie to
protect visitors from CSRF attacks when submitting forms, the trusted devices cookie for two-factor authentication and
the remember me cookie to automatically log in users if desired.
So in most cases, the following configuration will score the maximum cache hits but you may have to allow additional
cookies of extensions you installed:

```
COOKIE_ALLOW_LIST=PHPSESSID,csrf_https-contao_csrf_token,csrf_contao_csrf_token,trusted_device,REMEMBERME
```
    
{{% notice note %}}
The name of the PHP session cookie is configurable through the `php.ini` so you might want to check if it's `PHPSESSID`
for you too. Moreover, the CSRF cookie is different for `http` and `https` for security reasons. If you serve your
website over `http`, note that the cookie name will be `csrf_http-contao_csrf_token`.
However, protecting your users from CSRF attacks but let them submit the form via unsecured `http` connections is
not really a valid use case. 
{{% /notice %}}

### `COOKIE_REMOVE_FROM_DENY_LIST`

{{< version "4.10" >}}

In case you don't want to manage the whole `COOKIE_ALLOW_LIST` because you are unsure what your application needs but
you want to disable one or more of the existing entries on the deny list that is managed by Contao, you can specify this
using:

```
COOKIE_REMOVE_FROM_DENY_LIST=__utm.+,AMP_TOKEN
```

### `QUERY_PARAMS_ALLOW_LIST`

{{< version "4.10" >}}

For the very same reason we strip irrelevant cookies, we also strip irrelevant query parameters. E.g. you might be
familiar with the typical `?utm_*>=<randomtoken>` query parameters that are added to links of your website. Because they
change the URL every single time, they also generate new cache entries every single time, eventually maybe even flooding
your cache.

As with the irrelevant cookies, Contao also manages a list of irrelevant query parameters which again, you may completely
override by providing a list of allowed query parameters if you know all the query parameters your application ever
needs. This is highly unlikely which is why there is also `QUERY_PARAMS_REMOVE_FROM_DENY_LIST`.

### `QUERY_PARAMS_REMOVE_FROM_DENY_LIST`

{{< version "4.10" >}}

As with `COOKIE_REMOVE_FROM_DENY_LIST`, you can use `QUERY_PARAMS_REMOVE_FROM_DENY_LIST` to remove an entry from the
default deny list shipped with Contao. If you e.g. need the Facebook click identifier (`fbclid`) in your server side
code, you may update your list like so:

```
QUERY_PARAMS_REMOVE_FROM_DENY_LIST=fbclid
```

{{% notice warning %}}
If you do so, make sure to disable caching by e.g. setting `Cache-Control: no-store` on this response if `fbclid` is
present as otherwise you are back to having thousands of cache entries in your cache proxy.
{{% /notice %}}

## Shared cache maintenance and cache tagging

At this point we need to explain yet another concept. As a user of Contao, you won't even notice this, but it is an
important part of the excellent caching framework of Contao and therefore a great sales argument.

A key difference between the shared cache and private cache is that the location of the shared cache is known
and can be accessed. So we can actively manage the shared cache and invalidate single cache entries or the whole cache.
We cannot do this for the private cache.

So if you make changes to the content, you want to always make sure that the shared cache is emptied and visitors will
receive the latest version of your website. To do so, use the **"Purge the shared cache"** option in the **"Maintenance"**
menu.

But Contao would not be Contao if you had to do it yourself every time you applied a change, right?

Contao is equipped with a framework that allows developers to work with "cache tagging". When the response is generated,
it is tagged so that the cache proxy can store those tags as metadata alongside the cache entry. Based on this information,
entries related to certain cache tags can then be invalidated.

Every response generated by Contao contains a lot of cache tags. A response could thus look like this:

```http
HTTP/1.1 200 OK

Content-Type: text/html; charset=utf-8
Content-Length: 42
Cache-Control: max-age=3600
X-Cache-Tags: contao.db.tl_page.18, contao.db.tl_layout.16, contao.db.tl_content.42, contao.db.tl_content.10

<html>
...
</html>
```

The number of tags can grow to as many as you require. In this example, Contao has tagged the response with three
cache tags and as you might have noticed, these tags contain the information that the response relates to the page with
ID `18`, using the page layout ID `16` and the content elements with ID `42` and `10` are used on it.

And here's the kicker: When you edit one of these elements in the Contao back end, Contao automatically invalidates
all cache entries that are related to this element! For example, if the content element `42` was used in a news item,
all cache entries of the detail page and potential list views would be deleted automatically. If you change the page
layout `18` and select an additional CSS file to be loaded, all responses generated with this page layout will be
invalidated automatically without any further action required.

Pretty smart, isn't it?

Basically, this means that we can set the cache duration for the shared cache relatively high, since the invalidation
always takes place when we change anything. You should still be careful and test actively, because there may still be
cases where the automatic invalidation of entries does not work as desired. For example, the developer of an extension
or the Contao core itself might have failed to add the correct cache tags.
However, such cases can certainly be improved, just contact the person responsible.

{{% notice idea %}}
You will never see the `X-Cache-Tags` header in your browser because the Contao Cache Proxy removes it.
It contains no relevant information for the client and would only cause unnecessary data traffic.
{{% /notice %}}

{{% notice info %}}
By the way: Invalidating cache entries also works via HTTP requests because the cache proxy does not necessarily
have to be on the same server as Contao. Most cache proxies support receiving requests `PURGE` (yes, you are allowed
to invent your own HTTP methods in addition to the usual ones such as `GET`, `POST` etc.) and the invalidation logic
is completely abstracted in Contao so that you can connect any cache proxy programmatically if needed.
This way, any cache proxy can be tought to support the cache tag based invalidation logic of Contao!
{{% /notice %}}

## FAQ

{{% expand "What cache settings are the \"right ones\" for me?" %}}
It is not really possible to answer this question in general, because as it is so often the case in our industry, the answer
is "it depends". However, there are a few basic principles that you can use as a guide:

For example, it will rarely make sense to set the private cache duration higher than the one of the shared cache.
If a page is only supposed to be in the shared cache for one hour, you seem to generally think that the visitor should
see the new content after one hour at the latest. Therefore it makes no sense to configure the cache duration of the
private cache to two hours. A rule of thumb could thus be: The duration of the shared cache should be equal
or higher to the one of the private cache.

The choice of cache duration depends on how often content is changed on the page. A page with the imprint on it, for example,
will almost certainly change very rarely. So we could generally leave the content in the cache longer. But maybe it is
important to us that the visitor - if changes have been made - sees the new data quite quickly. Then we would accept
that the client sends a request more often (= lower, private cache time) and leave our shared cache time relatively high.
Thanks to Contao's cache tagging framework, which has already been explained, the cache would be emptied automatically
when the content is changed or we could also have it emptied via maintenance mode.
{{% /expand %}}

{{% expand "Does that mean, the RememberMe functionality deactivates caching completely?" %}}
Yes. The purpose of RememberMe is to automatically log a visitor in at the call of any URL, if this is not yet the case.
It is therefore impossible to deliver the response from the cache, otherwise a visitor would never be logged in. 
{{% /expand %}}

{{% expand "But my extension stores if some cookie bar information has been accepted in a cookie as well. So the cache would be always disabled?" %}}
Correct. This would be a perfect use case for `localStorage`. The server does not need to know this, because the contents 
of the cookie bar can also be dynamically inserted into the DOM using JavaScript, if the corresponding key doesn not
exist in `localStorage` yet. Make sure you inform the developer of the extension about this issue and have them 
solve the issue without using a cookie. 
{{% /expand %}}
