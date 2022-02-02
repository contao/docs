---
title: 'Mix templates'
description: 'Mix a template.'
aliases:
    - /en/layout/templates/twig/template-insertion/
weight: 50
---


A template can be inserted into another template. We create a template `image_copyright.html.twig` with the following content:

```twig
{# /templates/image_copyright.html.twig #}

<small>Photographed by {{ name }}, licensed as {{ license }}.</small>
```

This template can now be reused anywhere. Here, for example, we add our copyright notice (`image_copyright.html.twig`) 
to the content block of the `ce_image.html.twig` template:

```twig
{# templates/ce_image.html.twig #}

{% extends '@Contao/ce_image' %}

{% block content %}
    {{ parent() }}
    
    {% include 'image_copyright.html.twig' with {name: 'Dona Evans A', license: 'Creative Commons B'} only %}

{% endblock %}
```


### Output

When rendered, the template now shows:

```html
Photographed by Donna Evans, licensed as Creative Commons.
```