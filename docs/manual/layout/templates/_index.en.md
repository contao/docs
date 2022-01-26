---
title: "Templates"
description: "The Templates navigation area."
aliases:
    - /en/layout/templates/
weight: 40
---

A template is used to output a module, content element, form or other component. In the navigation area "Layout" 
under "Templates" the files can be created, stored in folders and edited. These adjustments are update proof.

{{% children %}}

{{% notice info %}}
Template changes are not necessary if you only need an additional CSS ID or CSS class. For most Contao components, 
you can enter them in the "Expert settings" section. The corresponding names are taken from the templates and 
displayed in the source code.
{{% /notice %}}

{{% notice note %}}
In [debug mode](/en/system/debug-mode/), the template names in the HTML source code are displayed as comments, 
so you can see which template is being used.
{{% /notice %}}


## Twig support

{{< version "4.13" >}}

In addition to PHP templates the output can also be generated via Twig Templates. Detailed information about this 
is provided in the "[Developer Documentation](https://docs.contao.org/dev/framework/templates/twig/)".

{{% taxonomylist context="tags" filter="Template" title="Guides" description=true %}}
