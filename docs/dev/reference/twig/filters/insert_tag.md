---
title: insert_tag - Twig Filter
linkTitle: insert_tag
description: Replace insert tags for usage in text (non-HTML) output.
tags: [Twig]
---

This Twig filter replaces insert tags and is meant for text usages that do not allow HTML tags, e.g. in HTML attributes.

```twig
{# Outputs "1970" #}
{{ '{{date::Y}}'|insert_tag }}

{# Outputs "1970" and does not use an <esi> tag #}
{{ '{{fragment::{{date::Y}}}}'|insert_tag }}
```
