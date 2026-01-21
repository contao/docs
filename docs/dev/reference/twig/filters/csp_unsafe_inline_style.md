---
title: csp_unsafe_inline_style - Twig Filter
linkTitle: csp_unsafe_inline_style
description: Adds a CSP hash for a given inline style.
tags: [Twig]
---

{{< version "5.3.2" >}}

Adds a CSP hash for a given inline style or attributes object and also adds the 'unsafe-hashes' source to the directive
automatically.

{{% notice "warning" %}}
Only pass trusted styles to this filter!
{{% /notice %}}

Usage with a simple inline CSS style string:

```twig
<div style="{{ 'color: red'|csp_unsafe_inline_style }}">
```

Usage with an `HtmlAttributes` object:

```twig
<div{{ attrs().addStyle({ color: 'red' })|csp_unsafe_inline_style }}>
```
```twig
{% set attributes = attrs()
    .addStyle({ color: 'red' })
%}
<div{{ attributes|csp_unsafe_inline_style  }}>
```