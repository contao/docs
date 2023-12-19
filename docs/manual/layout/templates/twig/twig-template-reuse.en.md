---
title: "Reuse templates"
description: "Reuse templates"
url: "layout/templates/twig/reuse"
weight: 40
---

With Twig, Contao consistently focuses on the reuse of parts of a template. Twig supports many
possibilities to reuse parts of a template. These include:

* [Extend](#extend)
* [Horizontal reuse](#horizontal-reuse)

For more complex customizations there are many more options available. You can find the description in the
developer documentation:

* [Include](https://docs.contao.org/dev/framework/templates/creating-templates/#includes)
* [Embed](https://docs.contao.org/dev/framework/templates/creating-templates/#embeds)
* [Macros](https://docs.contao.org/dev/framework/templates/creating-templates/#macros)
* [Components](https://docs.contao.org/dev/framework/templates/creating-templates/#contao-components)
* [Template features](https://docs.contao.org/dev/framework/templates/creating-templates/#template-features)


## Template hierarchy

For template reuse, you should familiarize yourself with the template hierarchy in Contao make yourself familiar with
it.

* Templates from Core
* Templates from an extension
* Templates from an application
* Global templates
* Global variant templates

Templates from the core can be modified by extension and application. For your
[global templates](../manage/#global-templates) from the `/templates` folder they are parent
templates that you can customize.   
The parent templates (base templates) of the core, from extensions or the application can be replaced by a
[global-template](../manage/#global-templates) within the `/templates` folder for all elements.
Global [variant templates](../manage/#global-variants-templates) can also be provided. A variant template adjusts a template from the core, an extension or the application - or another global template from the `/templates` folder.

In addition, [theme specific templates](../manage/#theme-specific-templates) are available, but they do not
belong to the template hierarchy because they are created at runtime.

The template hierarchy can be displayed from the command line with the
[`debug:contao-twig` command](https://docs.contao.org/dev/framework/templates/debugging/#debug-contao-twig-command).   
Also note the [corresponding section in the manual](/en/cli) when using the command.


## Extend

The `{% extend %}` tag is available for extending a template.   
When extending a template, it is not completely overwritten, but only individual subareas (blocks) of a parent template
(base template) are adapted.  
To do this, the base template must be specified with `{% extends "@Contao/('path-of-template')/('name-of-template') %}`.

Contao supports you in extending templates and [customizing blocks](#customize-blocks) and
[customize HTML attributes](#customize-html-attributes).  
If you select one of the new Twig templates for customization, the new template will be prepared for inheritance in
such a way that the base template is already specified. In the comments you will find the blocks and HTML attributes
that can be customized.


### Customize blocks

Customizable areas in Twig templates are located in blocks. Blocks start with a `{% block('name-of-block') %}` tag and
end with a `{% endblock %}` tag.

All adjustments must be made within the available blocks.

With `{{ parent() }}` the original content of the block can be output.

All non-customized blocks are automatically taken from the parent template.

{{% example "Extension for the text element" %}}
We create a new template for the content element text via the back end and insert an additional text into the `{% block text %}` block with an additional text.

```twig
{# /templates/content_element/text.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
{% block text %}
    <p>Introductory text for all text elements</p>
    {{ parent() }}
{% endblock %}
```

In all text elements, before the text we entered in Tiny-MCE, the text `Introductory text for all text elements`.

We now create two additional variants for the text element. The variants get in the block `{% block text %}` each with
its own closing text.

```twig
{# /templates/content_element/text/tip.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
{% block text %}
    {{ parent() }}
    <p>Here is an additional closing text for the "Tip" variant</p>
{% endblock %}
```

```twig
{# /templates/content_element/text/notice.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
{% block text %}
    {{ parent() }}
    <p>Here is an additional closing text for the "Notice" variant</p>
{% endblock %}
```

If we now select the template `content_element/text/tip`, then the parent template is the template  
`/templates/content_element/text.html.twig`.  
At the beginning the text `Introductory text for all text elements` is output and additionally at the end the
text `Here is an additional closing text for the variant "Tip"`. Between these the text that we entered in TinyMCE is output.  
When using the template `content_element/text/notice`, the text `Here is an additional closing text for the
text for the "Notice" variant` is output at the end.
{{% /example %}}


### Customize HTML attributes

For most Contao components, you can assign an additional CSS ID or CSS class in the back end.  
These are set for the corresponding components. Sometimes this is not desired and you want to assign the class
only for a specific HTML tag.  
For this purpose Contao provides you with the `{{ attrs() }}` function. This function allows you to modify any HTML attributes that have been defined in the parent template.

{{% example "Customize class for text area" %}}

We want to add the `description` class for the div tag that is around the text area. For this we adjust the
variable `text_attributes` accordingly. With `set` we fill the variable with new content. The function
`attrs(text_attributes|default)` provides us with the existing attributes. With `addClass` we add the desired class to
the attributes.

```twig
{# /templates/content_element/text.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
{% set text_attributes = attrs(text_attributes|default).addClass('description') %}
```
{{% /example %}}

Further examples and more detailed explanations can be found in the corresponding section of the
[developer documentation](https://docs.contao.org/dev/framework/templates/creating-templates/#html-attributes).


## Horizontal reuse

A very powerful way to reuse parts of a template is offered by the `{{ block }}` function.
With this it is possible to output blocks within a template one or more times.

For this, the block must be available in the template. A block is available if

* the block is defined directly in the template
* the block comes from a parent template
* the block is imported via the `{% use %}` tag.

If you have a look at
the [new Contao core templates on GitHub](https://github.com/contao/contao/tree/5.x/core-bundle/contao/templates/twig)
you will notice that the `{% use %}` tag is most commonly used alongside the `{% extends %}` tag.  
While the `{% extends %}` tag prints all blocks of the parent template to the front end, the `{% use %}` tag only makes
the blocks available to the template. The output of a block is only done with the `{{ block }}` function.  
Additional template parameters can be passed here.

More information and examples on horizontal reuse can be found in the
[Developer Documentation](https://docs.contao.org/dev/framework/templates/creating-templates/#horizontal-reuse).

Here in the manual we mention this complex possibility of template reuse only because you can use
for more complex template customizations especially the `{% use %}` tag and the use of
[Contao components](https://docs.contao.org/dev/framework/templates/creating-templates/#contao-components)
should be looked at.

{{% notice tip %}}
Take a look at the structure of the new core templates. Then you can see what code is in the individual blocks of the  
templates. You can find them on [GitHub](https://github.com/contao/contao/tree/5.x/core-bundle/contao/templates/twig).
{{% /notice %}}
