---
title: 'Namespaces'
description: 'Namespaces for Twig templates'
aliases:
    - /en/layout/templates/twig/namespace/
weight: 80
---


The full template name inside Twig contains a "namespace". And a namespace looks like `@ContaoCore/Image/Studio/figure.html.twig`.

Our Contao templates are all inside the `@Contao` namespace, so that's why for instance the text content element's 
"fully qualified template name" is `@Contao/content_element/text.html.twig` and why you would extend from it with 
`{% extends "@Contao/content_element/text.html.twig" %}`.

The `@Contao` namespace is a "managed namespace" and has a special feature in contrast to standard Twig: The same template can be 
extended from various sources. This way an extension can, for instance, add a new feature to a core template while you can still adjust it 
in your application.

{{% notice tip %}}
You can run `contao-console debug:contao-twig` on the console to get a list of all registered namespaces. 
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

