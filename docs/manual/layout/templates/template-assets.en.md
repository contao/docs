---
title: 'CSS and JavaScript assets'
description: 'Use CSS and JavaScript assets in templates.'
aliases:
    - /en/layout/templates/template-assets/
weight: 20
---

Oftentimes, templates require additional assets, such as CSS or JavaScript files. You *can* integrate them via your
theme's page layout, but this also means they will always be loaded, no matter if they are needed or not. Luckily,
you can also tie assets to specific templates.

#### Adding assets

The easiest way is to put the needed files into a public directory inside `/files` and then reference them in the
template:

```php
<link href="files/myfolder/custom.css" rel="stylesheet">
<script src="files/myfolder/custom.js"></script>
```

If the assets should be included in the HTML header instead, you can use the following PHP code in your template:

```php
<?php 
// will be output inside <head>
$GLOBALS['TL_CSS'][] = 'files/myfolder/custom.css|static';
$GLOBALS['TL_JAVASCRIPT'][] = 'files/myfolder/custom.js|static';
?>
```

Doing it this way, there are more options: By adding `|static`, for example, the files will be appended to or combined 
with existing assets from page layouts. A detailed description of all options and output locations can be found in the
developer documentation under [Adding CSS &amp; JavaScript Assets](https://docs.contao.org/dev/framework/asset-management/).
