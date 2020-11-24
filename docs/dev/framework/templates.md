---
title: "Templates"
description: Contao's template engine.
aliases:
    - /framework/templates/
---


A template is mainly composed of HTML and PHP code. It is used to structure a
piece of content of a module or a content element, etc. For example, the template
`news_full.html5` displays the full content of a news item whereas the template
`news_short.html5` displays only a portion of this content.

The templates are located in their own modules. For example, `news_full.html5` is
located under `vendor/contao/news-bundle/src/Resources/contao/templates/news`.

A template can be a part of the structure of a module, a content element, a form,
etc. and that is why they are prefixed. They can be easily grouped, ordered and
recognized. For example: the prefix `ce_` means "Content Element" and `mod_` means "Module".


## Template Inheritance

The inheritance allow you to create a template based on a second template. This
means that a template (*child*) inherits the content of a second template (*parent*).

In order that the content of a parent template may be modified or completed in
the child template, it must be surrounded by an element named block.

A block is built as follows:


```html
<?php $this->block('name_of_the_block'); ?>

  // Block content

<?php $this->endblock(); ?>
```

The example below shows a parent template with a block surrounding the content
of the head tag.

Template `fe_page.html5`:

```html
<!DOCTYPE html>
<html>
<head>
    <?php $this->block('head'); ?>
        <title><?= $this->title; ?></title>
        <link rel="stylesheet" href="style.css">
    <?php $this->endblock(); ?>
</head>
<body>
    […]
</body>
</html>
```

In the child template `fe_custom.html5`, a style sheet is added in the head tag in
addition to the inherited content of the parent template `fe_page.html5`.

Template `fe_custom.html5`:

```html
<?php $this->extend('fe_page'); ?>

<?php $this->block('head'); ?>
    <?php $this->parent(); ?>
  
    <link rel="stylesheet" href="style_2.css">
<?php $this->endblock(); ?>
```

* The `extend()` function specifies the template name whose it inherits the content.
* The `parent()` function allows to complete a block without replacing the inherited content.

The output of the `fe_custom.html5` template will be:

```html
<!DOCTYPE html>
<html>
<head>
    <title>A title</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_2.css">
</head>
<body>
    […]
</body>
</html>
```

Contao also provides default base templates for content elements and modules, called
`block_searchable` and `block_unsearchable`. These templates provide a basic wrapper
for your element or module, including attributes for CSS classes and IDs as well
as other attributes, if defined. It also automatically displays a headline and provides
an inheritance block for the headline section and the content section. This is the
content of the `block_searchable` template for example:

```html
<div class="<?= $this->class ?> block"<?= $this->cssID ?><?php if ($this->style): ?> style="<?= $this->style ?>"<?php endif; ?>>

  <?php $this->block('headline'); ?>
    <?php if ($this->headline): ?>
      <<?= $this->hl ?>><?= $this->headline ?></<?= $this->hl ?>>
    <?php endif; ?>
  <?php $this->endblock(); ?>

  <?php $this->block('content'); ?>
  <?php $this->endblock(); ?>

</div>
```

The content of the `block_unsearchable` template is the same, but it is additionally
wrapped with `<!-- indexer::stop -->` and `<!-- indexer::continue -->`, meaning
its contents will not be indexed by Contao's [search indexer][ContaoSearch].

Most of the templates for Contao's content elements and front end modules extend
from these templates. This is the content of the newslist module's template
`mod_newslist` for example:

```html
<?php $this->extend('block_unsearchable'); ?>

<?php $this->block('content'); ?>

  <?php if (empty($this->articles)): ?>
    <p class="empty"><?= $this->empty ?></p>
  <?php else: ?>
    <?= implode('', $this->articles) ?>
    <?= $this->pagination ?>
  <?php endif; ?>

<?php $this->endblock(); ?>
```

It extends from `block_unsearchable`, as the news article teasers should not be
indexed by Contao's search indexer by default (only the detail pages) and only overrides
the parent's `content` block, where the news articles (and pagination) will be shown.

It is also possible to override parent blocks with empty content. For example, if
you want to show a text content element's headline not in its default location, 
but somewhere else entirely, you could extend that template, override the `headline`
block with empty content and instead show the headline in a custom location within
the `content` block.

```php
<?php $this->extends('ce_text'); ?>

<?php $this->block('headline'); ?>
<?php $this->endblock(); ?>

<?php $this->block('content'); ?>

  <?php if ($this->addImage): ?>
    <?php $this->insert('image', $this->arrData); ?>
  <?php endif; ?>

  <div class="my-text-wrapper">
    <?php if ($this->headline): ?>
      <<?= $this->hl ?>><?= $this->headline ?></<?= $this->hl ?>>
    <?php endif; ?>
    <?= $this->text ?>
  </div>

<?php $this->endblock(); ?>
```


## Template Insertion

A template can be inserted into another template thanks to the `insert()` function.

```php
<?php $this->insert('template_name'); ?>
```

The `insert()` function also accepts the assignment of variables as second parameter.

```php
<?php $this->insert('template_name', ['key' => 'value']); ?>

// This passes all variables from the current template
<?php $this->insert('template_name', $this->getData()); ?>
```

In the example below, we would like to insert the template `image-copyright.html5`
in the template `image.html5`.

The template `image.html5` contains an img tag and the `insert()` function.

Template `image.html5`:

```html
<img src="<?= $this->src; ?>" alt="<?= $this->alt; ?>" />
<?php $this->insert('image-copyright', ['name' => 'Donna Evans', 'license' => 'Creative Commons']); ?>
```

The template `image-copyright.html5` contains a small tag that will be inserted
below the img tag in the template `image.html5`. The variables name and license
will be replaced with the values determined in the `insert()` function.

Template `image-copyright.html5`:

```html
<small>Photograph by <?= $this->name; ?>, licensed under <?= $this->license; ?></small>
```

The output of the `image.html5` template will be:

```html
<img src="files/images/house.jpg" alt="A small house in England" />
<small>Photograph by Donna Evans, licensed under Creative Commons</small>
```


## Template Data

The available template data varies depending on the source of the template. Typically,
content element templates or element templates of modules will have their complete
data record available in the template. For example, in any content element template,
the complete data set of the database record of the element will be available in 
the template via `$this->…`. The content of some fields might have been changed 
by the content element or module controller though.

You can inspect the available template data by using either

```php
<?php $this->dumpTemplateVars() ?>
```

or

```php
<?php dump($this) ?>
```

within the template. Both of these statements will use the [Symfony VarDumper component][SymfonyVarDumper]
to display the template's data.

{{% notice info %}}
If your template uses template inheritance, the template variable dump will only
be visible either in debug mode or if the dump is in between the `$this->block(…)`
and `$this->endblock()` statements.
{{% /notice %}}


[SymfonyVarDumper]: https://symfony.com/doc/current/components/var_dumper.html
[ContaoSearch]: https://docs.contao.org/manual/en/layout/module-management/website-search/
