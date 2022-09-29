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

You can now use Twig templates to overwrite or extend PHP templates. Keep the file name like before, but adjust the file extension. 
For example, create a `fe_page.html.twig` in your `template` directory and add another heading above the main section:

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

Beginning in Contao 5.0, we started replacing our core templates with Twig templates. Besides having new features, these new templates 
are also making use of the new directory structure that you need to follow when overwriting/extending - e.g. 
`content_element/gallery.html.twig` means a `gallery.html.twig` file inside the `content_element` directory.

You can now also derive from existing Twig templates in the "Layout > Templates" section in the back end. Then we'll automatically 
add an `extends` statement for the base template along with some explaining comments into the newly created file. You should favor 
extending, i.e. adjusting only the needed parts, over overwriting in nearly all cases. This way you'll stay compatible with future 
changes and features that are introduced by extensions.

An example for the content element "Text":

```twig
{% extends "@Contao/content_element/text.html.twig" %}

{% block content %}
  {{ parent() }}
  <p>My additional content.</p>
{% endblock %}
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

If you want to offer one or more variants of a template, which can be selected in the back end, then create a sub directory analogous to 
the file name of the template and place the customized file in it.  

Example: You can put a text variant `highlight` under `content_element/text/highlight.html.twig`. 
You can then select `content_element/text/highlight` as "Individual template" in the content element of type "Text". 

{{% /tab %}}

{{< /tabs >}}