---
title: "contao:maintenance-mode"
description: "Put back- and front end into maintenance mode."
aliases:
    - /en/cli/maintenance-mode/
---


{{< version "4.13" >}}

The maintenance mode has been rewritten for this Contao version. Via the command line, the complete Contao installation 
(back- and front end) can be put into maintenance mode. This feature is very useful if you want to update your system.

Furthermore you have the possibility to set the front end for each 
[website root](../../layout/site-structure/configure-pages/#website-settings) into maintenance mode.


```bash
php vendor/bin/contao-console contao:maintenance-mode [options] [<state>]
```

| Option                          | Description                                                                                                                                       |
|---------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------|
| `--template=TEMPLATE`           | Allows the use of a different Twig template name when maintenance mode is enabled. Default is `@ContaoCore/Error/service_unavailable.html.twig`   |
| `--templateVars[=TEMPLATEVARS]` | Add custom template variables to the Twig template when maintenance mode is enabled (deploy as JSON). Default is `{}`                             |
| `--format=FORMAT`               | You can choose between the output formats `txt` and `json`. Default is `txt`.                                                                     |

&nbsp;

| State              | Description                                                |
|--------------------|------------------------------------------------------------|
| `enable` or `on`   | Enables the Contao installation into maintenance mode.     |
| `disable` or `off` | Disables the maintenance mode for the Contao installation. |

{{% notice info %}}
You can learn how to customize the maintenance template in our [tutorial](../../guides/maintenance-template/).
{{% /notice %}}