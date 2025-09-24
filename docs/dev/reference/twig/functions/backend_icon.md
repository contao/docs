---
title: backend_icon - Twig Function
linkTitle: backend_icon
description: Helper function include an icon in the back end.
tags: [Twig]
---

{{< version "5.5" >}}

With this function you can reference an icon of Contao's back end theme and directly output HTML with an `<img>` tag in
order to display that icon.

```twig
{# Generates an icon with the given alt attribute #}
{{ backend_icon('edit.svg', 'Edit the record') }}
```

## Arguments

* `alt`: The string for the `alt` attribute of the `<img>`.
* `attributes`: An `HtmlAttributes` instance for additional HTML attributes on the `<img>`.
