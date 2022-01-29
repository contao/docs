---
title: 'Display template data'
description: 'Display all template data.'
aliases:
    - /en/layout/templates/php/template-data/
weight: 60
---

The available template context varies depending on the template source. Usually, the complete data can be accessed via
`$this->…`.

You can dump all available template data to see what's there:

```php
<?php $this->dumpTemplateVars() ?>
```

This statement uses the [Symfony VarDumper component](https://symfony.com/doc/current/components/var_dumper.html) to 
display the data. In debug mode, the output will therefore be redirected to the Symfony Debug Toolbar.

{{% notice info %}}
If you use [template inheritance]({{< ref "template-inheritance.en.md" >}}), the template data is only displayed in
debug mode or if the statement is enclosed between `$this->block(…)` and `$this->endblock()` statements.
{{% /notice %}}
