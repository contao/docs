---
title: "Twig templates"
description: "Overview Twig templates."
aliases:
    - /en/layout/templates/twig/
weight: 10
---


{{< version "4.12" >}}

{{% notice warning %}}
Twig support is currently *experimental* and therefore not covered by Contao's BC promise. Classes marked with `@experimental` should be 
considered internal for now. Although not likely, there could also be some behavioral changes, so be prepared. 
{{% /notice %}}

Twig is Symfony’s default way to write templates. It’s fast, safe and easily extensible. Contrary to PHP templates, Twig templates won’t 
contain business logic which allows to share them more easily between designers and programmers. This fact also helps you maintain 
a clean separation between your presentation and data/logic layer.

Twig also features a lot of powerful methods to structure your templates like including, embedding, inheriting, reusing blocks or macros, 
eases accessing objects with “property access”, has whitespace control, string interpolation features and a ton more… Give it a try!

{{% notice info %}}
A selection of existing Twig templates, e.g. via a content element, is currently not yet possible. The documentation of Twig usage in Contao is constantly being extended. Until then you can find more detailed information [here](https://docs.contao.org/dev/framework/templates/).
{{% /notice %}}


## Getting started

You can use Twig templates at any place you would use a Contao PHP template, just with a different file extension 
(`.html.twig` instead of `.html5`). It’s even possible to extend Contao PHP templates from within your Twig templates.

Go ahead and place a `fe_page.html.twig` in your template directory - this example will add a friendly headline above the main section 
and keep everything else the same:

```twig
{# /templates/fe_page.html.twig #}

{% extends '@Contao/fe_page' %}

{% block main %}
  <h1>Hello from Twig!</h1>
  {{ parent() }}
{% endblock %}
```

1. Name your Twig templates like your Contao counterpart (except for the file extension) and put them in a regular Contao template directory. 
There can **either** be a Twig **or** a PHP variant of the same template in the same location.

2. To extend an existing template (instead of completely replacing it) use the `extends` keyword and the special `@Contao` 
[namespace](https://docs.contao.org/dev/framework/templates/architecture/#naming-and-structure).

3. Use the same block names as in the original template.

{{% notice note %}}
You cannot extend Twig templates from within PHP templates only the other way round.
{{% /notice %}}
