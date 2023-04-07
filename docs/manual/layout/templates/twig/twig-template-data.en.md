---
title: "Show template data"
description: "Show all template data."
url: "layout/templates/twig/data"
weight: 50
---


To display the data in a template, you can use the `dump()` function.  
If you only need the data of certain variables, you can pass this as an argument:

```twig
{{ dump() }} {# output all available data #}
{{ dump(a) }} {# output the data of variable "a" #}
{{ dump(a, b) }} {# output the data of variable "a" and "b" #}
```

{{% example "Output of the heading of the text element" %}}
```twig
{# /templates/content_element/text.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
{% block text %}
    {{ dump(headline) }}
{% endblock %}
```
{{% /example %}}

{{% notice info %}}
Note that in extended templates the `dump()` function must be used inside a block.
{{% /notice %}}

{{% notice warning %}}
Since the evaluated data may contain safety-critical information about the system, this is only possible if 
[Debug mode](/en/system/debug-mode/) is enabled.
{{% /notice %}}
