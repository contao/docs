---
title: 'Inherit templates'
description: 'The template inheritance.'
aliases:
    - /en/layout/templates/twig/template-inheritance/
weight: 40
---

Contao template inheritance (instead of completely replacing it) allows overwriting certain sections of a template (blocks).


### Adjust blocks

Many templates already structure their contents. Only contents wrapped in such blocks can be adjusted.
First, the base template must be declared. Then you can provide new block content.

{{< version "4.12" >}}

To extend an existing template (instead of completely replacing it) use the `extends` keyword. Then you can provide new block 
content by wrapping it in `{% block name-of-the-block %}` and  `{% endblock %}` statements like in the original
template.

The original block content is available via `{{ parent() }}`.

```twig
{# /templates/fe_page.html.twig #}

{% extends '@Contao/fe_page' %}

{% block main %}
  <h1>Hello from Twig!</h1>
  {{ parent() }}
{% endblock %}
```

{{% notice note %}}
It’s possible to extend Contao PHP templates from within your Twig templates. You cannot extend Twig templates from within 
PHP templates only the other way round.
{{% /notice %}}

{{% notice tip %}}
Contao provides special namespaces for Twig templates. You can find detailed information [here](/en/layout/templates/twig/namespace/).
{{% /notice %}}