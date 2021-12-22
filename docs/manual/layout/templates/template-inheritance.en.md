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


#### PHP Example
The `fe_page.html` template contains multiple blocks (such as `head`, `meta`, `body`, `footer`). If we only want to add
another meta tag, we could write the following:

```php
<?php $this->extend('fe_page'); ?>

<?php $this->block('meta'); ?>
  <?php $this->parent(); ?>
  <meta name="author" content="John Doe">
<?php $this->endblock(); ?>
```


#### Twig Example

{{< version "4.13" >}}

```twig
{# /templates/fe_page.html.twig #}

{% extends '@Contao/fe_page' %}

{% block meta %}
  {{ parent() }}
  <meta name="author" content="Max Muster">
{% endblock %}
```