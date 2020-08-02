---
title: 'Manage stylesheets'
description: 'Contao provides a convenient backend module for stylesheet management which allows you to enter all format definitions in a single input mask.'
aliases:
    - /en/layout/theme-manager/manage-stylesheets/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

As already mentioned in the section, [Contao in Quick](../../../einleitung/contao-im-schnelldurchlauf/) Look, cascading stylesheets, CSS for short, are the formatting tool of choice for web pages. If you don't have at least some basic knowledge of CSS, you should learn it now, because creating or adapting a theme is not possible without CSS knowledge. A very good introduction to the topic can be found in the book series "[Little Boxes](https://www.little-boxes.de/little-boxes-teil1-online.html)" by Peter Müller.

Contao provides a convenient backend module for stylesheet management that allows you to enter all format definitions in a single input mask. The actual CSS file is created automatically in the background.

{{% notice info %}}
The internal CSS editor is deprecated and will be removed  
 in one of the next Contao versions! please [export your existing stylesheets](#stylesheets-exportieren) and add them as external stylesheets to the page layout.
{{% /notice %}}

## Set media types

The media type of a style sheet determines the type of end device for which it is valid. For example, if you create a stylesheet with a *handheld* media type, it will only be included if you access the page from a handheld PC. If you access the page with your browser, it will be automatically skipped. The following media types are available:

| Media type | Explanation |
| ---------- | ----------- |
| aural | The stylesheet applies to computer-controlled voice output. |
| braille | The stylesheet applies to output devices with a Braille display for blind users. |
| embossed | The stylesheet applies to Braille printers. |
| handheld | The stylesheet applies to handheld PCs and smartphones. However, not all devices request this media type; iPhone, for example, always uses *screen* style sheets. |
| print | The stylesheet applies to the print output of the web page. |
| projection | The stylesheet is valid for the presentation with beamers and similar devices. |
| screen | The stylesheet is valid for screen output (standard for web pages). |
| tty | The stylesheet applies to non-graphical output media with fixed character width. |
| tv | The stylesheet applies to TV-like output media with coarse resolution. |
| all | The stylesheet applies to all media types mentioned. |

You define the media type of a style sheet in the stylesheet settings.

The media types relevant for websites are *screen* and *print*.

## Conditional Comments

Conditional Comments are proprietary instructions that are only understood by Internet Explorer and allow, among other things, the inclusion of specific stylesheets and other scripts. In such a stylesheet, you can, for example, fix display errors separately, which are unfortunately abundant, especially in older versions of Internet Explorer.

The condition of a Conditional Comment can be read as follows:

| Condition | Explanation |
| --------- | ----------- |
| `if IE` | Applies to all versions of Internet Explorer. |
| `if IE 6` | Only applies to version 6. |
| `if lt IE 6` | Applies to all versions smaller than 6  **(**less than). |
| `if lte IE 6` | Applies to all versions less than or equal to 6  **(**less than or equals). |
| `if gt IE 6` | Applies to all versions greater than 6 **.** |
| `if gte IE 6` | Applies to all versions greater than or equal to 6  **(**greater than or equals). |

Now that fixing Internet Explorer errors has become part of a web designer's everyday work, the integration of stylesheets using conditional comments has been integrated into stylesheet management.

## Create format definitions

To create format definitions, you need to know two things: What are the class names of the Contao elements (the so-called selectors) and in which order are the format definitions stored?

### Class names of the Contao elements

The CSS class names of the Contao elements are logical throughout. Content elements begin with the prefix`ce_` (for content element), followed by the type of the content element. For example, a text element has the class`ce_text`, a picture element has the class `ce_image`.

The same applies to modules, except that they start with the prefix (for `mod_`modules). For example, the module "Navigation menu" has the class`mod_navigation`, the module "Message list" has the class`mod_newslist`. If you are not sure about the class of an element, just look at the source code of the web page.

In your stylesheet, you can then use the class name of an element to assign a format to it. For example, the followingCSS statement sets the outer spacing of a Contao text element to 24 pixels:

```css
.ce_text {
    margin: 24px;
}
```

In Contao, however, you cannot use this notation because you can specify all formats in the input mask. Only the part in front of the curly brackets, the selector, has to be entered manually in the field provided.

![Set the outer distance in the stylesheet editor](/de/layout/theme-manager/images/de/den-aussenabstand-im-stylesheet-editor-festlegen.png?classes=shadow)

### Order of format definitions

The order of the format definitions plays an important role in Cascading Stylesheets, because each statement in a subsequent format definition can be overwritten. This feature is especially useful for compensating browser-specific peculiarities, for example:

```css
/* Außenabstand für alle Browser */
mod_search {
    margin: 24px;
}

/* Korrektur im Internet Explorer 6 */
html .mod_search {
    margin: 18px;
}
```

If the order of format definitions were reversed, the specific format for Internet Explorer would be loaded first and then overwritten by the general format for all browsers. So the specific statement would never be applied, and the outer distance would always be 24 pixels.

You can change the order of the records in Contao using the navigation icons![Move format definition](/de/icons/drag.svg?classes=icon) **Drag&amp;Drop** or![Move format definition](/de/icons/cut.svg?classes=icon) **Move and**![Insert after format definition](/de/icons/pasteafter.svg?classes=icon) **then Insert**.

You can also assign a category to format definitions so that you can later filter the records by that category and more easily identify related definitions. These categories are only used for a better overview in the backend and are not used for sorting in the stylesheet itself.

## Export stylesheets

You can export individual stylesheets by clicking on the navigation![Export style sheet](/de/icons/theme_export.svg?classes=icon) icon **Export stylesheet** behind the stylesheet.

## Importing stylesheets

To be able to edit existing stylesheets with the internal stylesheet editor, the stylesheets module offers you the possibility to import CSS files. First transfer your CSS file to the Contao upload directory, and then click on the CSS Import button. A page with a file browser will open, from which you can select the stylesheets to import.
