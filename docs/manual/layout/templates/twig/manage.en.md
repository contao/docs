---
title: 'Manage templates'
description: 'The management of the template files.'
aliases:
    - /en/layout/templates/twig/manage-template/
weight: 20
---

## Directory structure

You can put templates in the `/templates` directory. 

{{< version-tag "4.13" >}} These can be selected in the backend, for example when configuring a content element.

* Templates that reside in the **main directory** will be marked as `global`.
* Using the [theme manager](/en/layout/theme-manager/manage-themes/), you can link an existing **subdirectory** to a
  theme. The template files in this directory will then be marked with the appropriate `Theme-Name`.

{{% notice note %}}
There can either be **one** Twig **or** a PHP variant of the same template in the same location.
{{% /notice %}}


## File names

Template file names contain a prefix that let you identify their type: `ce_`, for example, stands for **c**ontent
**e**lement.

If you want to adjust the output of the "Text" content element, you would use the `ce_text.html.twig` template. In this case, 
changes to the template will affect all content elements of type "Text". 

{{< version-tag "4.13" >}} If this isn't what you're after, you can also provide a specific variant template by appending an individual suffix to 
the existing name: `ce_text.html.twig` would then become `ce_text_specific.html.twig` for instance. This template will then be specifically 
selectable in any of the "Text" content elements.