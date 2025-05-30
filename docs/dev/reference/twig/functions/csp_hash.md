---
title: csp_hash - Twig Function
linkTitle: csp_hash
description: Adds CSP hashes for inline styles and scripts.
tags: [Twig]
---

This allows you to add [CSP hashes](https://content-security-policy.com/hash/) for inline styles and scripts.

```twig
{# Generate the hash for some inline JavaScript #}
{% set script %}
    alert('foo');
{% endset %}
<script>{{ script }}</script>
{% do csp_hash('script-src', script) %}

{# Generate the hash for some inline styles #}
{% set style %}
    body {
        background-color: magenta;
    }
{% endset %}
<style>{{ style }}</style>
{% do csp_hash('style-src', style) %}
```

## Arguments

* `directive`: The CSP directive the hash will be generated for.
* `source`: The content for whith the hash will be generated for.
* `algorithm`: You can optionally define the hashing algorithm (default is `sha256`).
