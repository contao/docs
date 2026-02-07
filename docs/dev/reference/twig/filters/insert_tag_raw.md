---
title: insert_tag_raw - Twig Filter
linkTitle: insert_tag_raw
description: Replace insert tags for usage in HTML.
tags: [Twig]
---

This Twig filter replaces insert tags and is meant for usage in HTML contexts.

```twig
{# Outputs "1970" #}
{{ '{{date::Y}}'|insert_tag_raw }}

{# Outputs "<esi:include ...></esi:include>" #}
{{ '{{fragment::{{date::Y}}}}'|insert_tag_raw }}
```

## Escaping

By default, the output of the insert tag is not escaped but the text outside of insert tags gets escaped. You can find 
more information about that in the [escape]({{% relref "escape" %}}) article.

```twig
{# Outputs "&lt;span&gt; foo <br> bar &lt;/span&gt;" #}
{{ '<span> foo {{br}} bar </span>'|insert_tag_raw }}
```
