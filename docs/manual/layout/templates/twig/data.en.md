---
title: 'Display template data'
description: 'Display all template data.'
aliases:
    - /en/layout/templates/twig/template-data/
weight: 60
---


The available template context varies depending on the template source. Within Twig templates you can display all available 
or specific template data.

```twig
{{ dump() }}
{{ dump(varA) }}
{{ dump(varA, varB) }}
```

{{% notice warning %}}
This only works while the [debug mode](/en/system/debug-mode/) is enabled.
{{% /notice %}}


## Command Line

On the command line, you can use the command `vendor/bin/contao-console list debug` to find two useful commands.

{{% notice note %}}
The options may differ between Contao versions. Therefore, for each command you can get details about the available options by 
specifying `--help`. For example, you can find out that the `--tree` option in `debug:contao-twig`, is only supported in Contao 
version 5.0.2 and later.
{{% /notice %}}


### debug:twig

The command shows you, among other things, a list of available Twig functions and filters.

```bash
php vendor/bin/contao-console debug:twig --help
```


### debug:contao-twig

The command shows you details and more information about the hierarchy of your templates.

```bash
php vendor/bin/contao-console debug:contao-twig --help
```

{{% notice tip %}}
Both commands support the `--env` option to take the environment into account : `prod` (default setting) or `dev`.
{{% /notice %}}