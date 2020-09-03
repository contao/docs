---
title: "Request Attributes"
description: A list of useful request attributes that can either be set or accessed for a request.
aliases:
    - /reference/request-attributes/
---


This is a list of request attributes that can either be set as defaults for your
controller's route, or that are dynamically set when a request is processed. Some
of these attributes are not exclusive to Contao, but a rather used by the Symfony
framework itself.

| Attribute | Value | Description |
| --- | --- | --- |
| `_contao_referer_id` | `string` | Available in the Contao `backend` request scope. Contains the current referer ID for back end request URLs. |
| `_locale` | `string` | Contains the locale of the current request. This can be set in the defaults of the route, or it will be set by Contao when using the `frontend` or `backend` request scope. Otherwise it will be `null`. |
| `_scope` | `string` (`frontend`/`backend`) | The Contao request scope, either `frontend` or `backend`. See [Framework: Routing][RequestScope]. |
| `_token_check` | `bool` | This enables or disabled the CSRF protection for POST requests to this route. The request token check is enabled by default for routes with a Contao request scope and thus can be disabled with this request attribute. Otherwise it can be enabled. See [Framwork: Routing][RoutingCsrf] and [Framework: Request Tokens][FrameworkCsrf] for more information on request tokens. |
| `pageModel` | `\Contao\PageModel`/`int` | Contains a `PageModel` instance in Contao requests. _Note:_ contains only the page ID in the request attributes of fragments. See [Framework: Routing][RoutingPageModel]. |


[RequestScope]: /framework/routing/#request-scope
[RoutingCsrf]: /framework/routing/#csrf-protection
[FrameworkCsrf]: /framework/request-tokens/
[RoutingPageModel]: /framework/routing/#page-model
