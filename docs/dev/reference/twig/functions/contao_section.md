---
title: contao_section - Twig Function
linkTitle: contao_section
description: Renders a layout section.
tags: [Twig]
---

This makes the `FrontendTemplate::section()` method available in Twig templates in order to render a section of a layout
within Contao. This is useful when you are implementing your `fe_page` template in Twig.

```twig
{# Render the main layout section #}
{{ contao_section('main')}}
```

## Arguments

* `key`: The layout section to be rendered.
* `template`: An optional template to render the section with (default is `block_section`).
