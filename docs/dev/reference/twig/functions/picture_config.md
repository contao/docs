---
title: picture_config - Twig Function
linkTitle: picture_config
description: Creates a picture configuration on-the-fly.
tags: [Twig]
---

The `picture_config` Twig function allows you to create a complex picture configuration on-the-fly, instead of
pre-defining it via `contao.image.sizes` in your `config/config.yaml` or via the image sizes in the back end. This
picture configuration can the be passed to the [`figure` function]({{% ref "twig/functions/figure" %}}).

```twig
{% use "@Contao/component/_figure.html.twig" %}

{% set special_size = picture_config({
    width: 400,
    height: 400,
    resizeMode: 'proportional',
    sizes: '0.75,1,1.5,2',
    items: [{
        width: 200,
        height: 100,
        media: '(max-width: 140px)',
    }]
}) %}

{% set image = figure('files/foo/bar.jpg', special_size) %}

{% with {figure: image} %}{{ block('figure_component') }}{% endwith %}
```

The function takes one argument - the picture configuration as an array. Internally, the function will create a
`Contao\Image\PictureConfiguration` instance based on the array.

The array keys are similar to the `contao.image.sizes` bundle configuration.

## Arguments

* `config`: The picture configuration as an array.
