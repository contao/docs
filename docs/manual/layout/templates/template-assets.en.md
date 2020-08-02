---
title: 'CSS and JavaScript assets'
description: 'Use CSS and JavaScript assets in templates.'
aliases:
    - /en/layout/templates/template-assets/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Often additional assets such as CSS or JavaScript files are required for an individual template. These files can always be integrated via the page layout of a theme. However, the assets are always loaded, even if they are not needed on different pages. It is therefore useful to specify these files in the template itself. There are several options available.

The easiest way is to `files`create the files in a public directory below and then reference them in the template:

```php
<link href="files/myfolder/custom.css" rel="stylesheet">
<script src="files/myfolder/custom.js"></script>
```

Alternatively, you can also store the assets in the template so that they are displayed in the HTML header or footer of the page, for example:

```php
$GLOBALS['TL_CSS'][] = 'files/myfolder/custom.css|static';
$GLOBALS['TL_JAVASCRIPT'][] = 'files/myfolder/custom.js|static';
```

This implementation offers further options. For example, by specifying , the files `static`are added to or merged with the existing asset page layouts. A detailed description of all options can be found in the developer documentation under [Adding CSS &amp; JavaScript Assets](https://docs.contao.org/dev/framework/asset-management/).
