---
title: content_element - Twig Function
linkTitle: content_element
description: Renders a content element either by a reference - or on-the-fly.
tags: [Twig]
---

{{< version "5.2" >}}

The [`content_element` function]({{% relref"creating-templates#render-content-elements" %}}) renders a content element.

To render a content element that already exists in the database (similar to the `{{insert_content::*}}` insert tag) you
can pass its ID:

```twig
{# Renders the content element ID 8472 #}
{{ content_element(8472) }}
```

You can also override the data for an existing content element:

```twig
{# Renders the content element ID 5618 and overrides its `perRow` setting #}
{{ 
    content_element(5618, {
        perRow: 4
    })
}}
```

You can also render a content element on the fly by passing the type of the content element and the configuration:

```twig
{# Renders a `text` content element with the passed data #}
{{
    content_element('text', {
        text: '<p>Hello World!</p>'
    })
}}
```

You can also pass an existing fragment reference. This is used in the `element_group` content element for example.

```twig
{# Renders the content element according to the passed `FragmentReference` #}
{{ content_element(fragment_reference) }}
```

## Arguments

* `typeOrId`: Either the type of a content element, the database ID of an existing content element or a fragment
  reference.
* `data`: The data for the content element to be rendered. You can also use this to overwrite the configuration of an 
  existing content element.
