---
title: 'Display template data'
description: 'Display all template data.'
aliases:
    - /en/layout/templates/template-data/
weight: 50
---

The available template context varies depending on the template source. 


## PHP Template

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


## Twig Template

{{< version "4.13" >}}

Within Twig Templates you can display all available or specific template data.
The output is only done when debug mode is enabled.

```twig
{{ dump() }}
{{ dump(varA) }}
{{ dump(varA, varB) }}

```
