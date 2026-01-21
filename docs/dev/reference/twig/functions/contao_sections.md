---
title: contao_sections - Twig Function
linkTitle: contao_sections
description: Renders custom layout sections of a specific type.
tags: [Twig]
---

This makes the `FrontendTemplate::sections()` method available in Twig templates in order to render custom sections of a
layout within Contao. This is useful when you are implementing your `fe_page` template in Twig.

```twig
{# Render the sections at the top position #}
{{ contao_sections('top')}}
```

## Arguments

* `key`: The position of the custom layout section.
* `template`: An optional template to render the sections with (default is `block_sections`).
