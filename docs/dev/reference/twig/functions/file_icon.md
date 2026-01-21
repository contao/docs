---
title: file_icon - Twig Function
linkTitle: file_icon
description: Helper function render an icon based on a file's type in the back end.
tags: [Twig]
---

{{< version "5.7" >}}

With this function you can generate a back end icon based on a file's type. This is used for the back end in the
template of the download(s) content element for example.

The function takes a `FilesystemItem` as its mandatory argument and also an `alt` attribute as well as an
`HtmlAttribute` instance as optional arguments.

```twig
{{ file_icon(download.file, 'Download', attrs().addClass('file-icon')) }}
```

## Arguments

* `item`: The `FilesystemItem` to generate the file icon for.
* `alt`: The string for the `alt` attribute of the `<img>`.
* `attributes`: An `HtmlAttributes` instance for additional HTML attributes on the `<img>`.
