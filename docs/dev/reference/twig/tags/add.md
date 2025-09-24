---
title: add - Twig Tag
linkTitle: add
description: Adds output to different sections of the document.
tags: [Twig]
---

{{< version "5.0" >}}

The `add` tag allows you to create output in different predetermined sections of the document, for example in order to
add `<script>` or `<style>` tags to the `<head>` or `<body>`. Currently supported document locations are as follows: 

* `head`
* `stylesheets`
* `body`

The `head` location adds the output to the end of the `<head>` with the default `fe_page`
template of Contao, while the `stylesheets` location groups the output together with the other stylesheets that are
output by Contao. The `body` location refers to the end of the `<body>`.

You can also define a name for the node which enables you to overwrite the output elsewhere.

```twig
{% use "@Contao/component/_stylesheet.html.twig" %}

{# Adds a stylesheet #}
{% add "my_css" to stylesheets %}
    {% with {file: asset('styles.css')} %}
        {{ block('stylesheet_component') }}
    {% endwith %}
{% endadd %}

{# Adds JavaScript to the end of the body #}
{% block script %}
    {% add "my_js" to body %}
        <script src="{{ asset('scripts.js') }}"></script>
    {% endadd %}
{% endblock %}

{# Adds JavaScript to the end of the body #}
{% block script %}
    {% add "my_inline_js" to body %}
        {% set script_attributes = attrs()
            .setIfExists('nonce', csp_nonce('script-src'))
            .mergeWith(script_attributes|default)
        %}
        <script{{ script_attributes }}>
            alert('foobar');
        </script>
    {% endadd %}
{% endblock %}

{# Adds a meta tag to the head #}
{% block script %}
    {% add "my_meta" to head %}
        <meta property="og:description" content="Lorem ipsum dolor.">
    {% endadd %}
{% endblock %}
```
