---
title: contao_figure - Twig Function
linkTitle: contao_figure
description: Renders a figure for image processing.
tags: [Twig]
---

This function renders a figure directly and takes 4 arguments: the source image, the size configuration, additional
options and which template to use to render the figure.

## Arguments

* `from`: Can be a `FilesModel`, a `FilesystemItem`, an `ImageInterface`, a `tl_files` UUID/ID/path or a file system path.
* `size`: A picture size configuration or reference or [size array]({{% relref "image-sizes#size-array" %}}).
* `configuration`: Additional configuration for the [`FigureBuilder`]({{% relref "image-studio#using-the-figurebuilder" %}}).
* `template`: Optional figure template (default is `@ContaoCore/Image/Studio/figure.html.twig`)
