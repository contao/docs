---
title: "Manage templates"
description: "The management of template files."
url: "layout/templates/twig/manage"
weight: 30
---

## Folder structure

You can store your own templates in the folder `/templates`, so that they are offered for selection in the back end,
e.g. during the configuration of a content element. Within the template folder Contao distinguishes between:

* [Global templates](#global-templates) and [Theme specific templates](#theme-specific-templates)

When creating, moving, or renaming Twig templates, we recommend that you use the
[debug mode](/en/system/debug-mode/#contao-4-8-and-up) to ensure that the newly created templates are used.  
After completion, the application cache must be rebuilt using the Contao manager or the console.

{{% notice info %}}
Even in debug mode, it may be necessary to clear the application cache in some cases to make your customized template
take effect.
{{% /notice %}}


## Global templates

Custom global Twig templates are stored inside `/templates` in a special folder structure. The subfolder
`content_element` is for content elements for example.
Contao supports you in structuring the templates. If you want to customize one of the new Twig templates, then the
template is automatically created in the correct subfolder.

{{% example "Global template for the text element" %}}
You want to customize the template for the text element. Select the template `text [content_element/text.html.twig]`
from the original templates. The necessary structure is given in square brackets after the template name. The template
is automatically created in the folder `/templates/content_element`.
{{% /example %}}

These template changes apply to all elements of the respective type. This is not always desired. If you want to
template changes only for certain elements, different variants of the template are required, which can then be
selected in the back end of the corresponding element.


### Global variants templates

If you want to provide several variants of your own template, the templates for the variants must be stored in a
subfolder of the new structure. The name of the variant template has to be defined in compliance with the
[naming conventions](https://docs.contao.org/dev/framework/templates/creating-templates/#naming-convention).
but for reasons of clarity it should give an indication of the purpose of the template adaptation.

{{% example "Variant templates for the text element" %}}
You want to provide multiple variants of the text element.   
To do this, create a folder called `text` inside `/templates/content_element`. Inside the new folder
`/templates/content_element/text` you can now create one or more variants of the text element template, e.g.
`tip.html.twig` and `highlight.html.twig`. In the back end there are now next to the core template
`text.html.twig` also your two variant templates to choose from.
{{% /example %}}


{{% notice tip %}}
You can also globally customize a core template and additionally create variant templates. This makes the possibilities
for template customization very flexible.
{{% /notice %}}


## Theme specific templates

In the [Theme Manager](../../../theme-manager/manage-themes/) you can link an existing subfolder to a theme.
with a theme. This is the **theme folder**.

{{% notice warning %}}
The name of the theme folder must not be changed for technical reasons
([managed namespace](https://docs.contao.org/dev/framework/templates/architecture/#managed-namespace)), the name of the
underscores.
{{% /notice %}}

Templates in the theme folder are **theme specific templates**. They are special in terms of their handling, because
although they are the most specific, they are not part of the [template hierarchy](../reuse/#template-hierarchy).
Only at runtime it is decided whether a theme-specific template is used.

{{% notice note %}}
You can only use theme specific templates to customize templates that are defined as global templates in the
templates [template hierarchy](../reuse/#template-hierarchy).
{{% /notice %}}

For the new Twig templates, the same folder structure for the templates must be followed within the theme folder as is
done for the global templates.

{{% example "Theme specific template for the text element" %}}
You have a theme called theme A. The theme folder for this theme is `/templates/themeA/`. You want to provide a theme
specific template for the text element. The path to this template is `/templates/themeA/content_element/text.html.twig`.

For a theme B, the theme folder is `/templates/themeB/`. In this folder you can use
`/templates/themeB/content_element/text.html.twig` to store a customization for the text element in theme B.
{{% /example %}}


### Theme specific variant templates

Theme specific variant templates require a global variant template with the same name.

{{% example "Theme specific variant template for the text element" %}}
If there is a theme specific template`/templates/content_element/text/highlight.html.twig`, you can additionally use
theme specific variant templates. For theme A with the template folder `/templates/themeA/` this would be
`/templates/themeA/content_element/text/highlight.html.twig`.
{{% /example %}}

{{% notice warning %}}
Theme specific variant templates cannot be used without a global variant template of the same name.
Such a template is not available for selection in the back end.
{{% /notice %}}
