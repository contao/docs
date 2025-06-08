---
title: contao_figure - Twig Function
linkTitle: contao_figure
description: Renders a figure for image processing.
tags: [Twig]
---

This function takes the same arguments as the [`figure`]({{% relref "figure" %}}) function, but renders the image directly.
There is an additional argument where you can define which template to use to render the figure.

{{% notice note %}}
Using the `contao_figure` function has been deprecated and will no longer work in Contao 6. Use the 
[figure]({{% relref "figure" %}}) function together with the "component/_figure.html.twig" component instead.
{{% /notice %}}

## Arguments

* `from`: Can be a `FilesModel`, a `FilesystemItem`, an `ImageInterface`, a `tl_files` UUID/ID/path or a file system path.
* `size`: A picture size configuration or reference or [size array]({{% relref "image-sizes#size-array" %}}).
* `configuration`: Additional configuration for the [`FigureBuilder`]({{% relref "image-studio#using-the-figurebuilder" %}}).
* `template`: Optional figure template (default is `@ContaoCore/Image/Studio/figure.html.twig`)
