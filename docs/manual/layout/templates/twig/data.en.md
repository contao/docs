---
title: 'Display template data'
description: 'Display all template data.'
aliases:
    - /en/layout/templates/twig/template-data/
weight: 60
---


The available template context varies depending on the template source. Within Twig templates you can display all available 
or specific template data.

```twig
{{ dump() }}
{{ dump(varA) }}
{{ dump(varA, varB) }}
```

{{% notice warning %}}
This only works while the [debug mode](/en/system/debug-mode/) is enabled.
{{% /notice %}}