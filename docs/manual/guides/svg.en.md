---
title: 'Use of SVG files'
description: 'Practical information on how to include SVG files.'
aliases:
    - /en/guides/svg/
weight: 60
tags:
    - Theme
    - Template
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

## The "SVG file"

Using files in [SVG format](https://developer.mozilla.org/en-US/docs/Web/SVG) offers many advantages. As a pure vector format, they are scaled lossless, unlike other formats. SVG files are therefore often used to display a logo or symbols.

You want to use your SVG file in Contao?   
 For our example we use the Contao logo in SVG format ( )`contao.svg`:

```html
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
<path d="M45.4 305c14.4 67.1 26.4 129 68.2 175H34c-18.7 0-34-15.2-34-34V66c0-18.7 15.2-34 34-34h57.7C77.9 44.6 65.6 59.2 54.8 75.6c-45.4 70-27 146.8-9.4 229.4zM478 32h-90.2c21.4 21.4 39.2 49.5 52.7 84.1l-137.1 29.3c-14.9-29-37.8-53.3-82.6-43.9-24.6 5.3-41 19.3-48.3 34.6-8.8 18.7-13.2 39.8 8.2 140.3 21.1 100.2 33.7 117.7 49.5 131.2 12.9 11.1 33.4 17 58.3 11.7 44.5-9.4 55.7-40.7 57.4-73.2l137.4-29.6c3.2 71.5-18.7 125.2-57.4 163.6H478c18.7 0 34-15.2 34-34V66c0-18.8-15.2-34-34-34z"/>
</svg>
```

Copy the SVG file into a directory marked as "Public" below "files". As with other image formats, you will be shown a preview within the [file manager](/de/dateiverwaltung/).

Then you can select the SVG file in the [content element](/de/artikelverwaltung/inhaltselemente/) of type "Picture", among others. Optionally, the settings for the " [picture size](/de/artikelverwaltung/inhaltselemente/#bild) " can also be defined here, similar to other picture formats. Contao creates the following source code:

```html
<div class="ce_image first last block">
  <figure class="image_container">
    <img src="files/myfolder/myfile.svg" alt="" itemprop="image">
  </figure>
</div>
```

With different settings of the " [image size](/de/artikelverwaltung/inhaltselemente/#bild) " we get the following representation(s) via the " `img`" HTML element:

![SVG Contao Brand 40px](/de/guides/images/de/svg/contao-gray.svg?width=40px) ![SVG Contao Brand 60px](/de/guides/images/de/svg/contao-gray.svg?width=60px) ![SVG Contao Brand 80px](/de/guides/images/de/svg/contao-gray.svg?width=80px) ![SVG Contao Brand 100px](/de/guides/images/de/svg/contao-gray.svg?width=100px)

## The "inline" alternative

The integration of SVG files via the HTML element " `img`" is a variant. Further possibilities arise if you use the SVG file " `inline`". The content of the SVG file " `<svg>...</svg>`" is stored directly in the HTML source code. In this form you can then influence the display with CSS information.

For the implementation we use a [template](/de/layout/templates) together with the [insert-tag](/de/artikelverwaltung/insert-tags/#include-elemente)`{{file::*}}` . Create a new template "mysvgicon.html5" in the directory "mysvgfolder" below the directory "Templates" and copy the complete SVG code into the template file.

Then you can `{{file::/mysvgfolder/mysvgicon.html5}}`embed the file in a [content element](/de/artikelverwaltung/inhaltselemente/) using the insert tag and control it with CSS information. The output when used within the content element is of type "Text" (shortened):

```html
<div class="ce_text first block">
  <p>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> . . . </svg>
  </p>
</div>
```

{{% notice tip %}}
 Unlike Contao's own template files, you can place these files in arbitrarily nested directories below "Templates". You define the relative paths in the insert tag. 
{{% /notice %}}

## Colorize SVG via CSS

You could color our example with the CSS specification "svg { fill: #ff0000; }". However, we prefer to use the CSS property`color`. To do this, we add the property `fill`and the value `currentColor`:

```html
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
<path fill="currentColor" d="M45.4 305c14.4 67.1 26.4 129 68.2 175H34c-18.7 0-34-15.2-34-34V66c0-18.7 15.2-34 34-34h57.7C77.9 44.6 65.6 59.2 54.8 75.6c-45.4 70-27 146.8-9.4 229.4zM478 32h-90.2c21.4 21.4 39.2 49.5 52.7 84.1l-137.1 29.3c-14.9-29-37.8-53.3-82.6-43.9-24.6 5.3-41 19.3-48.3 34.6-8.8 18.7-13.2 39.8 8.2 140.3 21.1 100.2 33.7 117.7 49.5 131.2 12.9 11.1 33.4 17 58.3 11.7 44.5-9.4 55.7-40.7 57.4-73.2l137.4-29.6c3.2 71.5-18.7 125.2-57.4 163.6H478c18.7 0 34-15.2 34-34V66c0-18.8-15.2-34-34-34z"/>
</svg>
```

In your CSS specifications you can now use the following:

```css
.ce_text {
  color: #000000;
}
```

The keyword [currentColor](https://developer.mozilla.org/de/docs/Web/CSS/Farben#currentColor_Schl%C3%BCsselwort) follows the CSS cascade. Therefore our SVG symbol takes the color value of the parent "div" block with the CSS class "ce\_text". If you specifically want to change the SVG symbol

```css
.ce_text {
  color: #000000;
}

.ce_text svg {
  color: #f47c00;
}
```

![SVG Contao Brand Color Orange 100px](/de/guides/images/de/svg/contao-orange.svg?width=100px)

## The "{{file::*}}" insert tag with argument

With CSS you can color your "inline" used SVG files. Do you want to change a specific SVG file via the [content element](/de/artikelverwaltung/inhaltselemente/) without further CSS adjustments?

The [insert tag](/de/artikelverwaltung/insert-tags/#include-elemente)`{{file::*}}` supports the transfer of arguments. You can use it to define the color value, for example:

`{{file::/mysvgfolder/mysvgicon.html5?color=#ff0000}}`

In the template file we replace the value of the property `fill`with a PHP query. If a passed argument is found, it is entered, otherwise it remains with the keyword `currentColor`. Your CSS information will be overwritten in the corresponding content element.

```php
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
<path fill="<?= (is_null(\Contao\Input::get('color')) ? 'currentColor' : \Contao\Input::get('color')) ?>" 
d="M45.4 305c14.4 67.1 26.4 129 68.2 175H34c-18.7 0-34-15.2-34-34V66c0-18.7 15.2-34 34-34h57.7C77.9 44.6 65.6 59.2 54.8 75.6c-45.4 70-27 146.8-9.4 229.4zM478 32h-90.2c21.4 21.4 39.2 49.5 52.7 84.1l-137.1 29.3c-14.9-29-37.8-53.3-82.6-43.9-24.6 5.3-41 19.3-48.3 34.6-8.8 18.7-13.2 39.8 8.2 140.3 21.1 100.2 33.7 117.7 49.5 131.2 12.9 11.1 33.4 17 58.3 11.7 44.5-9.4 55.7-40.7 57.4-73.2l137.4-29.6c3.2 71.5-18.7 125.2-57.4 163.6H478c18.7 0 34-15.2 34-34V66c0-18.8-15.2-34-34-34z"/>
</svg>
```

![SVG Contao Brand Color red 100px](/de/guides/images/de/svg/contao-red.svg?width=100px)
