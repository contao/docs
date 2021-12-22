---
title: 'Mix templates'
description: 'Mix a template.'
aliases:
    - /en/layout/templates/template-insertion/
weight: 40
---


A template can be inserted into another template.


### PHP Example

The `insert()` function allows inserting a template into another one. You can pass variables as an optional second
argument.

```php
<?php $this->insert('template_name', array('key'=>'value')); ?>

// Passes all variables of the current template
<?php $this->insert('template_name', $this->getData()); ?>
```

We create an `image_copyright.html5` template with the following content:

```php
// image_copyright.html5
<small>Photographed by <?php echo $this->name; ?>, licensed as <?php echo $this->license; ?></small>
```

This template can now be reused at any place. Here, we're for instance adding our copyright note 
(`image_copyright.html5`) to the `content` block of the `ce_image.html5` template:

```php
// ce_image_copyright.html5
<?php $this->extend('ce_image'); ?>

<?php $this->block('content'); ?>
  <?php $this->parent(); ?>
  
  <?php $this->insert('image_copyright', array('name'=>'Donna Evans', 'license'=>'Creative Commons')); ?>

<?php $this->endblock(); ?>
```


### Twig Example

{{< version "4.13" >}}

We create a template `image_copyright.html.twig` with the following content:

```twig
{# /templates/image_copyright.html.twig #}

<small>Photographed by {{ name }}, licensed as {{ license }}.</small>
```

This template can now be reused anywhere. Here, for example, we add our copyright notice (`image_copyright.html.twig`) 
to the content block of the `ce_image.html.twig` template:

```twig
{# templates/ce_image.html.twig #}

{% extends '@Contao/ce_image' %}

{% block content %}
    {{ parent() }}
    
    {{ include('image_copyright.html.twig', {name: "Dona Evans A", license: "Creative Commons B"}) }}

{% endblock %}
```


### Output

When rendered, the template now shows:

```html
Photographed by Donna Evans, licensed as Creative Commons.
```
