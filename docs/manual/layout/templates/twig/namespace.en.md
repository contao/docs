---
title: 'Namespaces'
description: 'Namespaces for Twig templates'
aliases:
    - /en/layout/templates/twig/namespace/
weight: 80
---


Twig templates live in namespaces like `@Foo/my_template.html.twig` (*Foo*) or `@ContaoCore/Image/Studio/figure.html.twig` (*ContaoCore*). 
We are automatically registering templates from the various Contao template directories in their respective namespaces

| Folder | Namespace | | Prio.<sup>*</sup>
|-|-|-|-|
| `/vendor/…/templates`<br>`/vendor/foo/bar/contao/templates` | `@Contao_<bundle>`<br>`@Contao_FooBarBundle` | Any bundle template/views directory. | 1 |
| `/contao/templates`<br>`/src/Resources/contao/templates`<br>`/app/Resources/contao/templates` | `@Contao_App` | Template directory of the application. | 2 |
| `/templates` | `@Contao_Global` | Global template directory. | 3 |
| `/templates/<theme>`<br>`/templates/foo/theme` | `@Contao_Theme_<theme>`<br>`@Contao_Theme_foo_theme` | Any theme directory. The path (`foo/theme`) will be transformed into a slug (`foo_theme`) and appended as a suffix. | 4 |

<sup>* Higher priority values mean "considered as template candidate first".</sup>


### Namespace @Contao

On top, we're also providing a **managed** `@Contao` namespace which you should use whenever you do not know the exact namespace beforehand. 
In each situation we're choosing the **next available** template that has a **lower priority** than the current one.

{{% notice tip %}}
You can run `contao-console debug:contao-twig` on the console to get a list of all registered namespaces. 
If you also want to list theme templates, add the `-t` option with the theme name. With the `--tree` option, the existing templates are 
additionally sorted and displayed in a prefix tree.
{{% /notice %}}


## Hierarchy example

In this example, we're dealing with four manifestations of the same
`card.html.twig` template: two in bundles, two more in the application.  

{{< tabs groupId="template-hierarchy-example">}}
{{% tab name="a) card-bundle" %}}
The original template of the `card-bundle`:

```twig
{# /vendor/foo/card-bundle/contao/templates/card.html.twig #}

{% import '@ContaoCore/Image/Studio/_macros.html.twig' as studio %}

<section class="card">
  {% block card %}
    <header class="title">
      {% block title %}{{ title }}{% endblock %}
    </header>     
    <main>
      {% block content %}
        {{ studio.figure(figure) }}
        {{ description|raw }}
      {% endblock %}
    </main>
    <footer>
      {% block footer %}<p class="author">by {{ author }}</p>{% endblock %}
    </footer
  {% endblock %}
</section>
```
{{% /tab %}}

{{% tab name="b) card-time-bundle" %}} 
A `card-time-bundle` extending the original bundle and adding information to
the footer - this bundle was loaded *after* the `card-bundle`, therefore it is
further up in our template hierarchy:

```twig
{# /vendor/bar/card-time-bundle/contao/templates/card.html.twig #}

{% extends '@Contao/card' %}

{% block footer %}
  {{ parent() }}
  <p class="last-modified">edited at {{ modified_at|ago }}</p>
{% endblock %}
```
{{% /tab %}}

{{% tab name="c) global template" %}}
The `card` template of the global template folder adding some wrappers, 
because, you know, you can't have enough *divs*.

```twig
{# /templates/card.html.twig #}

{% extends '@Contao/card' %}

{% block title %}<div class="inner">{{ parent() }}</div>{% endblock %}
{% block card %}<div class="inner">{{ parent() }}</div>{% endblock %}
```
{{% /tab %}}

{{% tab name="d) emoji theme" %}}
And finally the application's `emoji` theme adding, well, …

```twig
{# /templates/emoji/card.html.twig #}
   
{% extends '@Contao/card' %}

{% block title %}🤩 {{ parent() }} 🤯{% endblock %}
```
{{% /tab %}}
{{< /tabs >}}

Resolving all *extends* in the right order would effectively yield the
following template - note how each stage can adjust/contribute to blocks
without the need to know about the others because every *extend* uses the
managed `@Contao` namespace:

```twig
{% import '@ContaoCore/Image/Studio/_macros.html.twig' as studio %}

<section class="card">
  <div class="inner">
    <header class="title">
      🤩 <div class="inner">{{ title }}</div> 🤯
    </header>     
    <main>
      {{ studio.figure(figure) }}
      {{ description|raw }}
    </main>
    <footer>
     <p class="author">by {{ author }}</p>
     <p class="last-modified">edited at {{ modified_at|ago }}</p>
    </footer
  </div>>
</section>
```

{{% notice note %}}
When expanding, inserting or embedding templates from the `@Contao` namespace, the file extension is not taken into account. 
This means that `@Contao/card.html.twig` points to the same template as `@Contao/card.html5`. For this reason you can remove the 
file extension completely in this case.
{{% /notice %}}

