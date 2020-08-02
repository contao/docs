---
title: 'HTTP caching'
description: 'HTTP caching with Contao.'
aliases:
    - /en/performance/http-caching/
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

{{% notice info %}}
This whole article refers to Contao **4.9** and higher. Previous versions also have caching mechanisms, but they are not nearly as efficient, so we have not documented how the caching works for the older versions. 
{{% /notice %}}

The greatest performance gain in any application can be achieved by not having to start it at all, in other words: We want the output that Contao generates to be saved and delivered the next time it is called without having to start Contao.

Contao relies on the Hypertext Transfer Protocol (HTTP) - the backbone of the Internet.

Why should Contao reinvent the wheel when [smart people](https://tools.ietf.org/html/rfc2616) thought about caching HTTP replies [when HTTP/1.1 was introduced in 1999](https://tools.ietf.org/html/rfc2616)?

## HTTP

Back to the basics, then. To understand how HTTP caching can be configured in Contao, let's take a quick look at how HTTP, and therefore the entire Internet and the communication of many other devices, works:

{{<mermaid align="left">}}sequenceDiagramParticipant ClientParticipant ServerClient-&gt;&gt;Server: Request (Request)Server-&gt;&gt;Client: Answer (Response){{< /mermaid >}}

In principle, any other intermediaries (so-called "proxies") can be connected in between, which is not only conceivable but also very common:

{{<mermaid align="left">}}sequenceDiagramParticipant ClientParticipant Proxy 1participant Proxy 2participant ServerClient-&gt;&gt;Proxy 1: RequestProxy 1-&gt;&gt;Proxy 2: RequestProxy 2-&gt;&gt;Server: RequestServer-&gt;&gt;Proxy 2: ResponseProxy 2-&gt;&gt;Proxy 1: ResponseProxy 1-&gt;&gt;Client: Response%%362%

These proxies can perform any tasks, including

- Load Balancing (Distribute high load on different servers)
- CDN tasks (lower latency due to geographically shorter distances to the client)
- Authentication/Authorization
- Encryption (SSL/TLS)
- Applying optimizations (e.g. compression)
- and even: **Caching!**

To allow the client (in our case mostly the browser) and the server or proxies/servers to communicate with each other, every HTTP request and every HTTP response can be provided with metadata. These so called "HTTP headers" are standardized but it is up to each developer\* to invent and use additional headers, e.g. a typical request could look like this:

```http
GET /about-us.html HTTP/1.1

Accept-Language: de,en
Host: www.contao.org
```

In this case the client would like to have the resource that is below `/about-us.html`and he tells the server that he `de`understands the languages `en`and he `de`prefers to do so. He also wants the answer from the host`www.contao.org`. The communication between client and server takes place via IP and one server can serve any number of domains.

An answer to this could look like this:

```http
HTTP/1.1 200 OK

Content-Type: text/html; charset=utf-8
Content-Length: 42
Cache-Control: max-age=3600

<html>
...
</html>
```

The server tells us here that everything was fine (`200 OK`). The response contains `UTF-8`encoded `HTML`and is `42`bytes long. In addition, this response may be cached for `3600`seconds, i.e. one hour.

## The HTTP Caching Headers

There are a number of HTTP headers that are relevant for HTTP caching. To explain them all would go beyond the scope of this documentation. The topic is also already [well documented on MDN](https://developer.mozilla.org/en-US/docs/Web/HTTP/Caching), so you can learn more there if you are interested.

The regular user of Contao is mainly interested in the `Cache-Control`header and the three most important attributes:

- `private` or `public`
  
  Tells a client whether the response is private or public. The browser, for example, may cache both private and public answers, since it no longer passes the answer on. A proxy, on the other hand, may not cache private answers, because it passes the answer on. They cannot be combined. Something that can be cached publicly can also be cached privately, so a public (`public`) response implicitly means that multiple clients share the same cache entry. This is why we also speak of a shared cache, the "shared cache".
- `max-age`
  
  Contains the number of seconds a client may cache this response.
- `s-maxage`
  
  Contains the number of seconds a public client is allowed to cache this response. This attribute is only used if the cache duration should be different for public and private clients.

For better understanding a few examples:

| HTTP header | Interpretation |
| ----------- | -------------- |
| `Cache-Control: max-age=3600` | Only private clients may cache this answer for one hour. |
| `Cache-Control: max-age=3600, private` | Only private clients may cache this answer for one hour. |
| `Cache-Control: max-age=3600, public` | Both public and private clients may cache this response for one hour. |
| `Cache-Control: max-age=3600, s-maxage=7200, public` | Both public and private clients may cache this response. Private for one hour, public for two hours. |

And that is why you can find exactly these cache duration settings in the Contao page settings. The following selection translates to `Cache-Control: max-age=1800, s-maxage=3600, public`:

![Caching settings in the Contao back end](/de/performance/images/de/cache-einstellungen.png?classes=shadow)

## Advantages of using standards

The Contao Managed Edition comes with a caching proxy that is also written in PHP and sits directly in front of Contao. This means that every response that Contao generates is sent through our caching proxy before it is delivered to the client and is cached according to the HTTP headers or not.

{{% notice tip %}}
It is important to understand that the included proxy knows absolutely **nothing** about Contao. Although it is also written inPHP, it is completely independent and knows absolutely no Contao features. Everything it does is based on the headers of the HTTP requests and responses it receives from the client and Contao.

The big advantage we gain by using HTTP standards is the free choice of the caching proxy, because if the number of visitors is really high, PHP will eventually reach its limits. Maybe you will come to the conclusion to use more powerful proxies - explicitly designed for caching - like [Varnish](https://varnish-cache.org/) before Contao.

However, this would go too far at this point.

{{% notice note %}}Good to know for you: Whatever settings you have made in the pages, Contao follows the HTTP standards and just works out-of-the-box for you. If the requirements become more complex, Contao will not let you down! 
{{% /notice %}}
%

## Cached the shared proxy?

This section is about what can be stored in the shared cache. We don't talk about the private cache anymore, i.e. your personal browser cache, because we want to make sure that as many of our visitors as possible don't have to start Contao but can benefit from the shared cache.

We already know the most important criterion: The -Response `Cache-Control: public`header. If this header is missing, then the shared cache can never cache this response. But there are other criteria as well:

- The HTTP status code must always `200 OK`be , `301 Permanent Redirect`or `404 Not Found`be (there are a number of other statuses, but they are not so relevant for us here)
- `Cache-Control` must not `no-store`contain. This value prevents any caching.
- You need to specify the cache duration, i.e`max-age`. or in `s-maxage`the `Cache-Control`header (there are additional headers here as well, but they are not relevant for us)

In case of the included Contao cache proxy, you can easily check this. All responses from Contao will have a `Contao-Cache`header that can take three values:

- `miss`
  
  The Contao cache could not find a cache entry. Contao is started, generates the response and this response cannot be stored in the cache.
- `miss/store`
  
  The Contao cache could not find a cache entry. Contao is started, generates the response and this response can be cached and is stored accordingly.
- `fresh`
  
  The Contao cache has found the cache entry and the answer comes directly from the cache. Ideally, you should already have noticed the speed of the cache. In case of `Contao-Cache: fresh`there is also the HTTP`Age` header. It tells you how many seconds the cache entry already exists. A `Age: 60`means that this entry was created one minute ago.

{{% notice info %}}
If the Contao Managed Edition runs in debug mode, the entire cache proxy is also disabled. 
{{% /notice %}}

## When Shared Caching cannot work

As we have seen, there are some basic requirements for HTTP caching to work: In addition to the requirements mentioned above, there are other special reasons for Contao `private`to exclude a response from the shared cache:

- If the request contains an `Authorization`HTTP header
  
  The `Authorization`header contains standard authentication details. For Contao this means that a module or content element may listen to this header and potentially deliver user-specific data. To ensure that non-private data is stored in the shared cache and potentially delivered to another visitor, Contao forces `Cache-Control: private`. Contao will also tell you about this: The `Contao-Response-Private-Reason`-header in this case contains `authorization`.
  
  {{% notice warning %}}
It is very popular to protect installations during development with Basic Authentication. This means that the request contains a `Authorization`-header and therefore the cache is always disabled. Keep this in mind when testing cache settings. 
{{% /notice %}}
- If the request contains a PHP session cookie or the response sets it
  
  The most obvious case here is of course the PHP session, i.e. when a user logs into the backend or a member logs into the frontend. In this case all answers are always `private`and the `Contao-Response-Private-Reason`-header contains `session-cookie`.
- If the answer contains a cookie
  
  If the answer contains a cookie, it means that the developer\* wants to personalize the answer. The current answer therefore potentially already contains personal data. The `Contao-Response-Private-Reason`-header in this case `response-cookies`includes a list of the affected cookie names.
- If the request contains a cookie
  
  This is by far the most likely, but also the most complex case. All request cookies **can**, but do not **have to**, disable the cache.
  
  The rule is quite simple: Each cookie can potentially identify a visitor and therefore the application (i.e. Contao) could deliver personalized content (shopping carts, personal recommendations, logins etc.). Remember: The proxy is completely separate from the application, may even be located on another server in another part of the world and therefore has no way of knowing which cookies are relevant for the application. We have to tell it.
  
  Thus, a cache proxy is not allowed to deliver anything from the cache if the request contains a cookie. Let's repeat: **Every** single cookie implicitly means that the reverse proxy is bypassed. If we want to have a response generated from the cache, we have to make sure that **not a single cookie** finds its way to the cache proxy.
  
  However, there is a large number of cookies. Here are a few examples:
  
  
  - `_ga_*` Cookies from Google Analytics
  - `_pk_*` Cookies from Matomo
  - Cloudflare's `__cfduid`Cookie
  - Your `cookiebar_accepted`cookie, to know if the cookie policy has been accepted
  - and much more.
  
  The list is quite long and the attentive reader has already discovered a fundamental difference between the PHP session cookie and the `_ga_*`cookie: One of them is really relevant for the server (i.e. the PHP session) and the other one is responsible for the client-side tracking (i.e. within the browser) of the user and is completely irrelevant for Contao.
  
  In other words, if a request contains only one `_ga_*`cookie, we can still get the response from the cache, because this cookie does not generate any personal content. A smart cache proxy could therefore only consider session-relevant cookies and throw away all others before deciding whether a response can be delivered from the cache.
  
  To get the highest possible hit rate when caching out-of-the-box, Contao maintains a list of anirrelevant cookies within the Contao cache proxy. These cookies are removed from the request before the cache lookup and therefore do not reach the cache proxy or (in case of a cache miss) Contao itself.
  
  More advanced users can override this list, see the section about configuring the Contao Cache Proxy.
  
  In the case of cookies, the `Contao-Private-Response-Reason`header `request-cookies`contains a list of all the cookies that have been used to ensure that the response `private`was successful.

## Configuration of the Contao Cache Proxy

The Contao cache can be customized to a certain degree, just like Contao itself. Since Contao provides internal lists of irrelevant cookies, it has good default settings, but you can optimize it further by adjusting environment variables and tune it for performance.

{{% notice idea %}}
You wonder why Contao is `config.yaml`controlled by them and the Contao Cache Proxy with environment variables? The one `config.yaml`for Contao itself is application configuration. The included Contao Cache Proxy needs to know its settings **before Contao** is started. This is exactly what we want to prevent. Environment variables are the best choice for this. %
{{% /notice %}}

The following environment variables allow you to further optimize the cache proxy:

#### `COOKIE_ALLOW_LIST`

{{% notice info %}}
In Contao **4.9**, this variable is still called `COOKIE_WHITELIST`.
{{% /notice %}}

This environment variable allows you to configure which cookies are passed to the application and therefore disable caching. By default, Contao uses only **four cookies** in its core distribution without any extensions which are all DSGVO-safe because it is technically necessary:

1. The ID of the PHP session, which by default `PHPSESSID`is
2. The CSRF cookie to prevent [CSRF attacks](https://owasp.org/www-community/attacks/csrf)
3. The Trusted Device Cookie for trusted devices with two-factor authentication enabled.
4. The Remember-Me cookie when the Remember-Me function is enabled.

The highest number of cache hits and therefore optimum performance can therefore be achieved with the following environment variable:

```
COOKIE_ALLOW_LIST=PHPSESSID,csrf_https-contao_csrf_token,trusted_device,REMEMBERME
```

{{% notice note %}}
The name of the PHP session cookie is configurable via `php.ini`, so you should check if it is `PHPSESSID`the same for you. Also, the name of the CSRF cookie is `https`different for `http`security reasons. If you `http`are using a CSRF cookie name, the cookie name is `csrf_http-contao_csrf_token`.protecting your visitors from CSRF attacks, but using an unsecured connection is not a good configuration. Your web pages should only run over `https`.
{{% /notice %}}

#### `COOKIE_REMOVE_FROM_DENY_LIST`

{{< version "4.10" >}}

If you don't know exactly which cookies your application needs and therefore are not able to maintain them`COOKIE_ALLOW_LIST`, you can remove certain cookies from the provided deny list if you need one or more of them:

```
COOKIE_REMOVE_FROM_DENY_LIST=__utm.+,AMP_TOKEN
```

#### `QUERY_PARAMS_ALLOW_LIST`

{{< version "4.10" >}}

For the exact same reason we remove irrelevant cookies, we can also remove irrelevant query parameters. You may know the typical `?utm_*=<zufälliges Token>`query parameters that can be attached to links to your site. They are used to perform user tracking. However, they are also completely irrelevant for the application and Contao does not use them internally. A random token in the URL also causes new cache entries to be added all the time even though the content is always the same, which can cause the cache to become full.

As with the irrelevant cookies, Contao internally maintains a list of irrelevant query parameters which you can override by maintaining the entire list of relevant query parameters that are used somewhere with the environment `QUERY_PARAMS_ALLOW_LIST`variable.

In contrast to cookies, you usually have a much, much higher number of relevant query parameters, from `page`pagination to `token`registration confirmation. Maintaining this list manually is therefore a rather unlikely case, so if you need a certain query parameter in your application, you will probably `QUERY_PARAMS_REMOVE_FROM_DENY_LIST`use it anyway.

#### `QUERY_PARAMS_REMOVE_FROM_DENY_LIST`

{{< version "4.10" >}}

Similarly`COOKIE_REMOVE_FROM_DENY_LIST`, you can remove from the internal deny list by using `QUERY_PARAMS_REMOVE_FROM_DENY_LIST`certain entries. If you or an installed extension need, for example, the Facebook Click Identifier ( )`fbclid`to perform server-side analysis, you can allow it as follows:

```
QUERY_PARAMS_REMOVE_FROM_DENY_LIST=fbclid
```

{{% notice warning %}}Remember that if this parameter is present, you should disable caching on the response or notify your developer(s)\* about it. This can be easily done via`Cache-Control: no-store`, otherwise we run into the problem that too many cache entries are generated. 
{{% /notice %}}
%

## Shared cache maintenance and cache tagging

At this point we need to explain another concept. As a user of Contao, you won't even notice this, but it is an important part of the excellent caching framework of Contao and therefore a great selling point.

A key difference between shared cache and private cache is that the location of the shared cache is known and can be accessed. So we can actively manage the shared cache and delete single cache entries or the whole cache. We cannot do this for the private cache.

So if you make changes to the content, you can always make sure that the shared cache is emptied and visitors can see the latest version of your website. To do this, use the **"Empty Shared Cache"** option in the **"System Maintenance"** menu.

Contao would not be Contao if you had to do it yourself every time you made a change.

Contao has a framework that allows developers to work with "cache tagging". When the response is generated, it is tagged so that the cache proxy can store it as metadata for the cache entry. Based on this information, entries with certain cache tags can then be invalidated (this is what the caching process is called).

Every response generated by Contao contains a lot of cache tags. An answer could look like this:

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

The number of tags can grow as many as you want. In this example, Contao has tagged the answer with three cache tags and as you might have noticed, these tags contain the information that the answer is the page with ID `18`with page layout ID `16`and the content elements with ID `42`and on `10`it.

And here's the kicker: When you edit one of these elements in the Contao back end, Contao automatically invalidates all cache entries that are related to this element! For example, if the content `42`element was used in a news item, all cache entries of the detail page and potential list views would be deleted automatically. If you change the page layout `18`and select an additional CSS file to be loaded, all responses generated with this page layout will be invalidated automatically without your intervention.

Pretty clever, isn't it?

Basically, this means that we can set the cache duration for the shared cache relatively high, since the invalidation always takes place when we change something. You should still be careful and test actively, because there may still be cases where the automatic invalidation of entries does not work as desired. For example, the developer(s)\* of an extension or the Contao core itself might have failed to add the correct cache tags. However, such cases can certainly be improved, just contact the person responsible.

{{% notice idea %}}
 `X-Cache-Tags`You will never see the header in your browser because the Contao Cache Proxy removes it. It contains no relevant information for the client and would only cause unnecessary data transfer.

{{% notice info %}}
By the way: Invalidating cache entries also works via HTTP requests because the cache proxy does not necessarily have to be on the same server as Contao. Most cache proxies support receiving requests`PURGE` (yes, you are allowed to invent your own HTTP methods in addition to the usual `GET`ones, `POST`etc.) and the invalidation logic is completely abstracted in Contao so that you can connect any cache proxy programmatically if needed. This way, any cache proxy can be made to support the cache-tag based invalidation logic of Contao!

## FAQ

{{% expand "Welche Cache-Einstellungen sind für mich die »richtigen«?" %}}
%It is not possible to answer this question in general, because as is so often the case in our industry, the answer is "it depends". However, there are a few basic principles that you can use as a guide:

For example, it will rarely make sense to set the private cache duration higher than the shared cache duration, and if a page is only supposed to be in the shared cache for one hour, you seem to generally think that the visitor should see the new content after one hour at the latest. Therefore it makes no sense to configure the cache duration of the private cache to two hours. A rule of thumb could be: The duration of the shared cache should be equal or higher than the private cache.

The choice of cache duration depends on how often content is changed on the page. A page with the imprint, for example, will almost certainly change very rarely. So we could generally leave the content in the cache longer. But maybe it is important to us that the visitor - if changes have been made - sees the new data quite quickly. Then we would accept that the client sends a request more often (= lower, private cache time) and leave our shared cache time relatively high. Thanks to Contao's cache tagging framework, which has already been explained, the cache would be emptied automatically when the content is changed or we could also have it emptied via maintenance mode. So we would generally choose lower cache times.
{{% /expand %}}

{{% expand "Heisst das, die Remember-Me-Funktion deaktiviert den Cache für einen Besucher komplett?" %}}
%Yes. The function of Remember-Me is to automatically log a visitor in at the call of any URL, if this is not yet the case. It is therefore impossible to deliver the answer from the cache, otherwise a visitor would never be logged in. 
{{% /expand %}}

{{% expand "Meine Erweiterung speichert aber in einem Cookie ob die Cookie-Bar noch angezeigt werden soll, dann ist der Cache ja auch immer deaktiviert?" %}}
Correct. This would be a perfect example of `localStorage`. The server doesn't need to know this, because the contents of the cookie bar can also be dynamically inserted into the DOM with JavaScript, if the corresponding key doesn't `localStorage`exist yet. Inform the developer(s)\* in the extension to solve this without a cookie if possible. 
{{% /expand %}}

</body></html>
