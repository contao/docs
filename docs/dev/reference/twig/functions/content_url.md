---
title: content_url - Twig Function
linkTitle: content_url
description: Generates the URL for a given model object.
tags: [Twig]
---

This function is similar to Symfony's [`path`](https://symfony.com/doc/current/reference/twig_reference.html#path).
It will generate an URL for the given model using Contao's
[Content URL Generation]({{% ref "content-routing#content-url-generation" %}}). This is useful for controllers that list
your items - and the items are passed as an iterable collection of [Models]({{% ref "models" %}}).

```twig
{# templates/frontend_module/foobar_list.html.twig #}
{% extends "@Contao/frontend_module/_base.html.twig" %}

{% block content %}
    {% for item in items %}
        <div class="item">
            <a href="{{ content_url(item) }}">{{ item.title }}</a>
        </div>
    {% endfor %}
{% endblock %}
```

## Arguments

* `content`: The Contao model to generate the URL for.
* `parameters`: Optional array of parameters. This can be useful for page models in order to set URL parameters.
* `relative`: By default the function always creates an absolute URL. By passing `true` it will be an absolute path instead.
