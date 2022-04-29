---
title: "Display your Contao website in an <iframe> on another domain."
description: "Customize the nelmio/NelmioSecurityBundle."
url: "display-your-website-in-iframe"
aliases:
    - /en/display-your-website-in-iframe/
    - /en/display-your-website-in-iframe/
weight: 100
---

You want to display the content of your Contao website on another domain using an <iframe> tag?
Then you can add the following settings in config.yml.

{{% notice note %}}
If the file /config/config.yml does not exist yet, you can simply create it.
{{% /notice %}}

## Allow a specific domain

```
nelmio_cors:
    defaults:
        origin_regex: true
        allow_origin: ['theme-preview.org']
        allow_methods: ['GET', 'OPTIONS', 'POST', 'PUT', 'PATCH', 'DELETE']
        allow_headers: ['Content-Type', 'Authorization']
        max_age: 3600
```

With `allow_methods` you can define with which methods a call is possible.
`allow_origin` and allow_headers`can be set to `*` to accept any value, the allowed methods however have 
to be explicitly listed.

## Allow multiple domains

```
nelmio_cors:
    defaults:
        origin_regex: true
        allow_origin: ['^http://localhost:[0-9]+','contao-themes.net','theme-preview.org']
```

## Allow a specific page for a domain

```
nelmio_cors:
    paths:
        ``/my-iframe-page.html'':
            allow_origin: ['theme-preview.org']
```

`paths` must contain at least one item.

## Allow a specific page for all domains

```
nelmio_cors:
    paths:
        ``/my-iframe-page.html'':
            allow_origin: ['*']
```

More information about the configuration of the [Nelmio Cors Bundle][.1] can be found at

[1]: https://github.com/nelmio/NelmioCorsBundle#configuration 