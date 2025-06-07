---
title: prefix_url - Twig Function
linkTitle: prefix_url
description: Prefixes relative URLs with the base path.
tags: [Twig]
---

Historically, Contao made use of the `<base href="…">` HTML tag so that all relative URLs are always relative to this
base. In Contao 5 however, we are moving away from that and instead always output path absolute URLs. In order to make
sure though that any relative link that might have been input in the back end somewhere will continue to work even
without the base tag, the `prefix_url` helper function exists, which will automatically prepend the base path of the
request for any relative URL.

```twig
{# Make sure the "userGeneratedUrl" is always path absolute #}
<a href="{{ prefix_url(userGeneratedUrl|insert_tag) }}">
```

## Arguments

* `url`: The relative URL to be prefixed with the requests's base path, if applicable.
