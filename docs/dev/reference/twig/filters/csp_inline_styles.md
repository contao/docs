---
title: csp_inline_styles - Twig Filter
linkTitle: csp_inline_styles
description: Extracts all inline CSS style attributes of a given HTML string and automatically adds CSP hashes.
tags: [Twig]
---

{{< version "5.3" >}}

This filter extracts all inline CSS style attributes of a given HTML string or attributes object and automatically adds
CSP hashes for those to the current response context. The list of allowed styles can be configured in 
`contao.csp.allowed_inline_styles`.

This is useful for rich text editor fields for example, if your editor configuration allows setting some inline styles
(like colours for example).

```twig
{{ some_html|csp_inline_styles|raw }}
```

Within Contao this is used by default for the TinyMCE output in the `_rich_text` template component.
