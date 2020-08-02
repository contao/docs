---
title: 'Display template data'
description: 'Display all template data.'
aliases:
    - /en/layout/templates/template-data/
weight: 50
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

The available template data varies depending on the source of the template. Usually the complete data set is available in the template. The individual data records correspond to the respective database entries and are `$this->…`accessible in the template by specifying

You can display all available template data of a template. Either with

```php
<?php $this->dumpTemplateVars() ?>
```

or via

```php
<?php dump($this) ?>
```

Both statements use the [Symfony VarDumper component to](https://symfony.com/doc/current/components/var_dumper.html) display the template data.

{{% notice info %}}
If you use [template inheritance]({{< ref "template-inheritance.en.md" >}}), the template data is only displayed in debug mode or if the statement is between `$this->block(…)`and `$this->endblock()`
{{% /notice %}}
