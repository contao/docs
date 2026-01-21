---
title: 'Inherit templates'
description: 'The template inheritance.'
aliases:
    - /en/layout/templates/php/template-inheritance/
weight: 40
---

Contao template inheritance allows overwriting only certain sections of a template (blocks).

### Adjust blocks
Many templates already structure their contents by wrapping it with `$this->block('name-of-the-block')` and
`$this->endblock()` statements. Only contents wrapped in such blocks can be adjusted.

First, the base template must be declared with `$this->extend('name-of-the-template')`. Then you can provide new block 
content by wrapping it in `$this->block('name-of-the-block')` and  `$this->endblock()` statements like in the original
template.

The original block content is available via `$this->parent()`.

#### Example
The `fe_page.html` template contains multiple blocks (such as `head`, `meta`, `body`, `footer`). If we only want to add
another meta tag, we could write the following:

```php
<?php $this->extend('fe_page'); ?>

<?php $this->block('meta'); ?>
  <?php $this->parent(); ?>
  <meta name="author" content="John Doe">
<?php $this->endblock(); ?>
```
