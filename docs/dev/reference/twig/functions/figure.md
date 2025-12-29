---
title: figure - Twig Function
linkTitle: figure
description: Creates a figure object for image processing.
tags: [Twig]
---

This function allows you to create a processed (resized and/or cropped) image directly in your Twig template via 
Contao's [Image Studio]({{% relref "image-studio" %}}). It will return a `Figure` instance which you can then render in
your template - or pass to a pre-existing block of a component, or a pre-existing template. If the resource is not found, 
it will return `null` instead.

The function takes [3 arguments](#arguments): the source image, the size configuration and additional options. The
following example creates a `Figure` object from a hardcoded path and size and then renders it using the `_figure`
component:

```twig
{% use "@Contao/component/_figure.html.twig" %}

{% set image = figure('files/foo/bar.jpg', [1280, 720, 'crop']) %}

{% if image %}
    {% with {figure: image} %}{{ block('figure_component') }}{% endwith %}
{% endif %}
```

You can also set more options for the `FigureBuilder`, like setting additional meta data, a lightbox identifier, an
image size for the full size image, etc.:

```twig
{% set figure = figure(id, [200, 200, 'proportional'], { 
    metadata: { alt: 'Some image', caption: 'Look at this image!' },
    enableLightbox: true,
    lightboxGroupIdentifier: 'my-gallery',
    lightboxSize: '_big_size',
    linkHref: 'https://contao.org',
    options: { attr: { class: 'foobar-container' } }
}) %}
```

See the [dedicated templates section]({{% relref "creating-templates#images" %}}) for more examples.

You can also extract the resized image by accessing the `src` of the resulting `<img>`:

```twig
{% set resizedImagePath = figure(id, '_my_size').image.img.src %}
```

If required you can also access the path to the original file. However, keep in mind that this path will not be encoded.

```twig
{% set originalPath = figure(id, '_my_size').image.filePath %}
```

## Arguments

* `from`: Can be a `FilesModel`, a `FilesystemItem`, an `ImageInterface`, a `tl_files` UUID/ID/path or a file system path.
* `size`: A picture size configuration or reference or [size array]({{% relref "image-sizes#size-array" %}}).
* `configuration`: Additional configuration for the [`FigureBuilder`]({{% relref "image-studio#using-the-figurebuilder" %}}).
