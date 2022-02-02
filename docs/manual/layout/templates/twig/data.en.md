---
title: 'Display template data'
description: 'Display all template data.'
aliases:
    - /en/layout/templates/twig/template-data/
weight: 60
---


The available template context varies depending on the template source. 

Within Twig templates you can display all available or specific template data.
This only works while the debug mode is enabled.

```twig
{{ dump() }}
{{ dump(varA) }}
{{ dump(varA, varB) }}
```