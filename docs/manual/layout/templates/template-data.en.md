---
title: 'Display template data'
description: 'Display all template data.'
aliases:
    - /en/layout/templates/template-data/
weight: 50
---


The available template context varies depending on the template source. 


{{< tabs groupId="templateGroup">}}
{{% tab name="PHP" %}}


Usually, the complete data can be accessed via `$this->…`. You can dump all available template data to see what's there:

```php
<?php $this->dumpTemplateVars() ?>
```

This statement uses the [Symfony VarDumper component](https://symfony.com/doc/current/components/var_dumper.html) to 
display the data. In debug mode, the output will therefore be redirected to the Symfony Debug Toolbar.

{{% notice info %}}
If you use [template inheritance]({{< ref "template-inheritance.en.md" >}}), the template data is only displayed in
debug mode or if the statement is enclosed between `$this->block(…)` and `$this->endblock()` statements.
{{% /notice %}}


{{% /tab %}}
{{% tab name="Twig" %}}


{{< version "4.12" >}}

Within Twig templates you can display all available or specific template data.
This only works while the debug mode is enabled.

```twig
{{ dump() }}
{{ dump(varA) }}
{{ dump(varA, varB) }}
```


{{% /tab %}}
{{< /tabs >}}