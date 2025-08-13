---
title: csp_source - Twig Function
linkTitle: csp_source
description: Adds a source for a CSP directive.
tags: [Twig]
---

{{< version "5.3" >}}

This function allows you to add a [source](https://content-security-policy.com/#source_list) for a CSP directive. This
is helpful if you have e.g. a content element that adds certain internal or external media files or iframes that can be
inherently trusted.

```twig
{# Add source for a iframe #}
{% set source = 'https://example.com/foobar' %}
{% do csp_source('frame-src', source) %}
<iframe src="{{ source }}">

{# Add source for a video #}
{% set source = 'https://example.com/foobar.mp4' %}
{% do csp_source('media-src', source) %}
<video controls>
    <source src="{{ source }}">
</video>
```

## Arguments

* `directive`: The CSP directive the source will be added to. Can also be an array of multiple directives.
* `source`: The source to be added.
