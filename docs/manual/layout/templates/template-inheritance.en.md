---
title: 'Inherit template'
description: 'The template inheritance.'
aliases:
    - /en/layout/templates/template-inheritance/
weight: 30
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

The structure of a template can vary from simple to complex content. Most templates will be renamed block functions (`block()` and `endblock()`) and divided into areas. These areas can be accessed via template inheritance. This makes individual template changes more transparent.

The template `fe_page.html`is divided into several blocks (including `head`, `meta`, `body`, , , `footer`etc.). We only want to add an additional meta specification.

For this we create a new template `fe_page_meta.html5`with the following content:

```php
<?php $this->extend('fe_page'); ?>

<?php $this->block('meta'); ?>
  <?php $this->parent(); ?>

  <meta name="author" content="John Doe">
<?php $this->endblock(); ?>
```

The function `extend()`defines the parent template and the function `parent()`takes the original (block) content. If we use this template, all pages will be delivered with the additional meta information.
