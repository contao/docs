---
title: 'Manage templates'
description: 'The management of the template files.'
aliases:
    - /en/layout/templates/twig/manage-template/
weight: 20
---


Twig templates are marked differently compared to the previous PHP templates: (`.html.twig` instead of `.html5`).

{{% notice tip %}}
Contao 5 includes ready-made Twig templates and these are favored. However, you can also activate and use the corresponding PHP-templates. 
More information can be found [here](https://github.com/contao/contao/blob/5.x/UPGRADE.md#content-elements).
{{% /notice %}}

## Create Template

{{< tabs groupId="creation" >}}

{{% tab name="Ab Contao 4.13" %}}

Ready-made Twig Temlates are not available in this version and cannot be created via the backend. You have to create a file manually 
in the `templates` directory, e.g. `ce_text.html.twig`. This Twig template will then be displayed in the backend 
(could be copied and renamed here) and is then available for selection in the respective content element.

It is possible to extend existing PHP-template from within Twig templates. For example, create a `fe_page.html.twig` in your 
template directory. In this example, a heading is added above the main section and everything else stays the same:

```twig
{# /templates/fe_page.html.twig #}

{% extends '@Contao/fe_page' %}

{% block main %}
  <h1>Hello from Twig!</h1>
  {{ parent() }}
{% endblock %}
```

{{% notice info %}}
There can be either **one** Twig **or** a PHP variant of the same template in the same place. You cannot extend Twig templates 
from PHP templates, only vice versa.
{{% /notice %}}

{{% /tab %}}

{{% tab name="Contao 5.0" %}}

This version includes ready-made Twig templates and these can be selected and created via the backend for customization. 
The corresponding templates are expanded by default and the respective sections can then be overwritten. 
You can also add your own code here. 

An example for the content element "Text":

```twig
{% extends "@Contao/content_element/text.html.twig" %}

{#
  ** Add changes to the base template here. **

  Hint: Try adjusting blocks and attributes instead of
  overwriting the whole template. This way your version
  can remain compatible with future changes to the base
  template as well as adjustments made by extensions.

  Currently available blocks:
    "picture_component", "image", "sources", "source",
    "schema_org", "figure_component", "media",
    "media_link", "caption", "caption_inner",
    "content", "text_media", "text",
    "text_attributes", "headline_component",
    "headline_attributes", "headline_inner",
    "wrapper", "wrapper_tag", "attributes", "inner"

  Example:
    {% block picture_component %}
       {{ parent() }}
       My additional content for 'picture_component'…
    {% endblock %}
#}
```

{{% notice note %}}
A Twig template may not yet be available for each module/content element. In these cases the previous previous (PHP/legacy) templates will be used.
{{% /notice %}}

{{% /tab %}}

{{< /tabs >}}


## Template Variant

{{< tabs groupId="variant" >}}

{{% tab name="Ab Contao 4.13" %}}

The template files are prefixed for recognition. For example, `ce_` indicates a content element (**c**ontent **e**lement). For example, 
if you want to change the output of the content element of type "text", you can use the template `ce_text.html.twig` for this purpose. 
In this case the template changes will affect all content elements of type "Text". 

This is not always desired. For specific use, the template can be named individually. Here the 
template name must be kept and only extended: 

You can rename e.g. `ce_text.html.twig` to `ce_text_individual.html.twig`. This template can then be used specifically for the output 
for one (or more) content element(s) of type "Text".

{{% /tab %}}

{{% tab name="Contao 5.0" %}}

If you want to offer one or more variants of a template, which can be selected in the backend, then create a subfolder analogous to 
to the file name of the template and place the customized file in it. 

Example: You can put a text variant `highlight` under `content_element/text/highlight.html.twig`. 
This is then available as an individual template `content_element/text/highlight` for selection in the content element. 

{{% /tab %}}

{{< /tabs >}}