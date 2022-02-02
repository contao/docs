---
title: 'CSS and JavaScript assets'
description: 'Use CSS and JavaScript assets in templates.'
aliases:
    - /en/layout/templates/twig/template-assets/
weight: 30
---


Oftentimes, templates require additional assets, such as CSS or JavaScript files. You *can* integrate them via your
theme's page layout, but this also means they will always be loaded, no matter if they are needed or not. Luckily,
you can also tie assets to specific templates.


#### Adding assets

The easiest way is to put the needed files into a public directory inside `/files` and then reference them in the
template:

```twig
<link href="files/myfolder/custom.css" rel="stylesheet">
<script src="files/myfolder/custom.js"></script>
```