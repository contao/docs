---
title: frontend_module - Twig Function
linkTitle: frontend_module
description: Renders a front end module either by a reference - or on-the-fly.
tags: [Twig]
---

{{< version "5.2" >}}

The [`frontend_module` function]({{% relref"creating-templates#render-front-end-modules" %}}) renders a front end module.

To render a front end module that already exists in the database (similar to the `{{insert_module::*}}` insert tag) you
can pass its ID:

```twig
{# Renders the front end module ID 1701 #}
{{ frontend_module(1701) }}
```

You can also override the data for an existing front end module:

```twig
{# Renders the front end module ID 1864 and overrides its `hardLimit` setting #}
{{ 
    frontend_module(1864, {
        hardLimit: 0
    })
}}
```

You can also render a front end module on the fly by passing the type of the front end module and the configuration:

```twig
{# Renders a `newslist` front end module with the passed data #}
{{
    frontend_module('newslist', {
        news_archives: [1, 2],
        news_template: 'news_latest',
        news_order: 'order_date_desc',
        numberOfItems: 10,
        imgSize: [0, 0, '_news_list'],
    })
}}
```

You can also pass an existing fragment reference, if one was provided by a controller.

```twig
{# Renders the front end module according to the passed `FragmentReference` #}
{{ frontend_module(fragment_reference) }}
```

## Arguments

* `typeOrId`: Either the type of a front end module, the database ID of an existing front end module or a fragment
  reference.
* `data`: The data for the front end module to be rendered. You can also use this to overwrite the configuration of an 
  existing front end module.
