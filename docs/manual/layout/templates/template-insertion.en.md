---
title: 'Mix Template'
description: 'Mix a template.'
aliases:
    - /en/layout/templates/template-insertion/
weight: 40
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

This `insert()`function can be used to insert a template into another template. The function also accepts additional variables as second parameters.

```php
<?php $this->insert('template_name', array('key'=>'value')); ?>

// Übergibt alle Variablen aus dem aktuellen Template
<?php $this->insert('template_name', $this->getData()); ?>
```

We create a template `image_copyright.html5`with the following content:

```php
// image_copyright.html5
<small>Fotografiert von <?php echo $this->name; ?>, lizenziert als <?php echo $this->license; ?></small>
```

The template `ce_image.html5`contains the block `content`. Through inheritance, we overwrite this block content and mix or add the content from our own copyright template (`image_copyright.html5`):

```php
// ce_image_copyright.html5
<?php $this->extend('ce_image'); ?>

<?php $this->block('content'); ?>
  <?php $this->parent(); ?>

  <?php $this->insert('image_copyright', array('name'=>'Donna Evans', 'license'=>'Creative Commons')); ?>

<?php $this->endblock(); ?>
```

If the template is used in a content element of the type "image", our copyright information is output in addition to the actual image output:

- Photographed by Donna Evans, licensed as Creative Commons
