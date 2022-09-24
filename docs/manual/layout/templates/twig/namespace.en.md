---
title: 'Namespaces'
description: 'Namespaces for Twig templates'
aliases:
    - /en/layout/templates/twig/namespace/
weight: 80
---


Twig templates live in namespaces like `@Foo/my_template.html.twig` (*Foo*) or `@ContaoCore/Image/Studio/figure.html.twig` (*ContaoCore*). 
We are automatically registering templates from the various Contao template directories in their respective namespaces

On top, we're also providing a **managed** `@Contao` namespace which you should use whenever you do not know the exact namespace beforehand. 
Detailed information about this can be found in the [Developer Documentation](https://docs.contao.org/dev/framework/templates/twig/#namespace-magic).

When expanding, inserting or embedding templates from the `@Contao` namespace, the file extension is not taken into account. 
This means that `@Contao/card.html.twig` points to the same template as `@Contao/card.html5`. For this reason you can remove the 
file extension completely in this case.

{{% notice note %}}
You can run `contao-console debug:contao-twig` on the console to get a list of all registered namespaces. 
If you also want to list theme templates, add the `-t` option with the theme name. With the `--tree` option, the existing templates are 
additionally sorted and displayed in a prefix tree.
{{% /notice %}}