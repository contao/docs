---
title: 'Manage templates'
description: 'The management of the template files.'
aliases:
    - /en/layout/templates/php/manage-template/
weight: 20
---

## Directory structure

You can put templates in the `/templates` directory to make them available in the back end (e.g. in the settings of a
content element).

* Templates that reside in the **main directory** will be marked as `global`.
* Using the [theme manager](/en/layout/theme-manager/manage-themes/), you can link an existing **subdirectory** to a
  theme. The template files in this directory will then be marked with the appropriate `Theme-Name`.

{{% notice note %}}
Template files in other (non-linked) subdirectories won't be considered.
{{% /notice %}}


## File names

Template file names contain a prefix that let you identify their type: `ce_`, for example, stands for **c**ontent
**e**lement. If you want to adjust the output of the "Text" content element, you would use the `ce_text.html5` template.

In this case, changes to the template will affect all content elements of type "Text". If this isn't what you're after,
you can also provide a specific variant template by appending an individual suffix to the existing name: `ce_text.html5`
would then become `ce_text_specific.html5` for instance. This template will then be specifically selectable in any of
the "Text" content elements.
