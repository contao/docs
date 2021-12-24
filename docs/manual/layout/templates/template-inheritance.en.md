---
title: 'Inherit templates'
description: 'The template inheritance.'
aliases:
    - /en/layout/templates/template-inheritance/
weight: 30
---

Contao template inheritance allows overwriting only certain sections of a template (blocks).


### Adjust blocks

Many templates already structure their contents. Only contents wrapped in such blocks can be adjusted.
First, the base template must be declared. Then you can provide new block content.


{{< tabs groupId="templateGroup">}}
{{% tab name="PHP" %}}


Many templates already structure their contents by wrapping it with `$this->block('name-of-the-block')` and
`$this->endblock()` statements. Only contents wrapped in such blocks can be adjusted.

First, the base template must be declared with `$this->extend('name-of-the-template')`. Then you can provide new block 
content by wrapping it in `$this->block('name-of-the-block')` and  `$this->endblock()` statements like in the original
template.

The original block content is available via `$this->parent()`.


```html
<!-- templates/fe_page.html5 -->
<?php $this->extend('fe_page'); ?>

<?php $this->block('meta'); ?>
  <?php $this->parent(); ?>

  <meta name="author" content="John Doe">
<?php $this->endblock(); ?>
```


{{% /tab %}}
{{% tab name="Twig" %}}


{{< version "4.13" >}}

First, the base template must be declared with `{% extends 'name-of-the-template' %}`. Then you can provide new block 
content by wrapping it in `{% block name-of-the-block %}` and  `{% endblock %}` statements like in the original
template.

The original block content is available via `{{ parent() }}`.


```twig
{# /templates/fe_page.html.twig #}

{% extends '@Contao/fe_page' %}

{% block meta %}
  {{ parent() }}

  <meta name="author" content="Max Muster">
{% endblock %}
```

{{% notice info %}}
Twig templates live in namespaces like "@Contao_Global/ce_text.html.twig (/templates folder)". More Information about 
available namespaces can be found [here](https://docs.contao.org/dev/framework/templates/twig/#namespace-magic).
{{% /notice %}}

{{% /tab %}}
{{< /tabs >}}