---
title: 'Manage stylesheets'
description: 'Contao provides a convenient back end module for stylesheet management which allows you to enter all 
format definitions in a single input mask.'
aliases:
    - /en/layout/theme-manager/manage-stylesheets/
weight: 20
---

As already mentioned in the section, [Contao quickstart](/en/introduction/contao-quickstart/), cascading stylesheets, 
CSS for short, are the formatting tool of choice for formatting web pages. If you don't have at least some basic 
knowledge of CSS, you should learn it now, because creating or adapting a theme is not possible without CSS knowledge. 
A very good introduction to the topic can be found in the book series 
[Little Boxes](https://www.little-boxes.de/little-boxes-teil1-online.html) by Peter Müller.

Contao provides a convenient back end module for stylesheet management that allows you to enter all format definitions 
in a single input mask. The creation of the actual CSS file is done automatically in the background.

{{% notice info %}}
The internal CSS editor is deprecated and will be removed in one of the next Contao versions!  
Please [export your existing stylesheets](#export-stylesheets) and add them as external stylesheets to the page 
layout.
{{% /notice %}}


## Set media types

The media type of a style sheet determines the type of end device for which it is valid. For example, if you create a 
stylesheet with a *handheld* media type, it will only be included if you access the page from a handheld PC. If you 
access the page with your browser, it will be automatically skipped. The following media types are available:

| Media type | Explanation |
| ---------- | ----------- |
| all | The stylesheet applies to all media types mentioned. |
| aural | The stylesheet applies to computer generated speech. |
| braille | The stylesheet applies to output devices with a Braille line for blind users. |
| embossed | The stylesheet applies to Braille printers. |
| handheld | The stylesheet applies to handheld PCs and smartphones. However, not all end devices request this media type; the iPhone, for example, always uses *screen* style sheets. |
| print | The stylesheet is valid for the print version of the website. |
| projection | The stylesheet is valid for presentation with beamers and similar devices. |
| screen | The stylesheet is valid for screen output (standard for web pages). |
| tty | The stylesheet applies to non-graphical output media with fixed character width. |
| tv | The stylesheet applies to TV-like output media with coarse resolution. |

You define the media type of a style sheet in the stylesheet settings.

The media types relevant for web pages are *screen* and *print*.


## Conditional Comments

Conditional Comments are proprietary instructions that are only understood by Internet Explorer and allow, among other 
things, the inclusion of specific stylesheets and other scripts. In such a stylesheet you can, for example, fix display 
errors separately, which are unfortunately abundant in older versions of Internet Explorer.

The condition of a conditional comment can be read as follows:

| Condition | Declaration |
| --------- | ----------- |
| `if IE` | Applies to all versions of Internet Explorer. |
| `if IE 6` | Applies only to version 6. |
| `if lt IE 6` | Applies to all versions smaller than 6  **(**less than). |
| `if lte IE 6` | Applies to all versions smaller or equal to 6  **(**less than or equals). |
| `if gt IE 6` | Applies to all versions greater than 6 **.** |
| `if gte IE 6` | Applies to all versions greater than or equal to 6  **(**greater than or equals). |

Now that fixing Internet Explorer errors has become part of a web designer's everyday work, the integration of 
stylesheets using conditional comments has been integrated into stylesheet management.


## Create format definitions

To create format definitions, you need to know two things: What are the class names of the Contao elements 
(the so-called selectors) and in which order are the format definitions stored?


### Class names of the Contao elements

The CSS class names of the Contao elements are logical throughout. Content elements begin with the prefix `ce_` (for 
*c*ontent *e*lement), followed by the type of the content element. For example, a text element has the class `ce_text`, 
a picture element has the class `ce_image`.

The same applies to modules, except that they start with the prefix `mod_` (for *mod*ules). For example, the 
"Navigation menu" module has the class `mod_navigation`, the "News list" module the class `mod_newslist`. If you are 
not sure about the class of an element, just look in the source code of the web page.

In your stylesheet, you can then use the class name of an element to assign a format to it. For example, the following 
CSS statement sets the outer spacing of a Contao text element to 24 pixels:

```css
.ce_text {
    margin: 24px;
}
```

In Contao, however, you cannot touch this style sheet at all because you can specify all formats in the input mask. 
Only the part in front of the curly brackets, the so-called selector, has to be entered manually in the field provided.

![Set the outer distance in the stylesheet editor]({{% asset "images/manual/layout/theme-manager/en/set-the-outer-distance-in-the-stylesheet-editor.png" %}}?classes=shadow)


### Sequence of the format definitions

The order of the format definitions plays an important role in Cascading Stylesheets, because each statement in a 
subsequent format definition can be overwritten. This feature is especially useful for compensating browser-specific 
peculiarities, for example:

```css
/* Outer distance for all browsers */
.mod_search {
    margin: 24px;
}

/* Fix for Internet Explorer 6 */
html .mod_search {
    margin: 18px;
}
```

If the order of the format definitions were reversed, the specific format for Internet Explorer would be loaded first 
and then overwritten by the generally valid format for all browsers. The specific statement would therefore never be 
applied, and the outer distance would always be 24 pixels.

You can change the order of the records in Contao using the navigation icons 
![Move format definition]({{% asset "icons/drag.svg" %}}?classes=icon) **Drag&amp;Drop** or
![Move format definition]({{% asset "icons/cut.svg" %}}?classes=icon) **Move and** 
![Insert after format definition]({{% asset "icons/pasteafter.svg" %}}?classes=icon) **then Insert**.

You can also assign a category to format definitions so that you can later filter records by that category and more 
easily identify related definitions. These categories are only used for a better overview in the back end and are not 
used for sorting in the stylesheet itself.


## Export stylesheets

You can export individual stylesheets by clicking on the navigation icon 
![Export style sheet]({{% asset "icons/theme" %}}_export.svg?classes=icon) **Export Stylesheet** behind the stylesheet.


## Import stylesheets

To enable you to edit existing stylesheets with the internal stylesheet editor, the stylesheets module offers you the 
possibility to import CSS files. To do this, first transfer your CSS file to the Contao upload directory, and then 
click on the CSS Import button. A page with a file browser will open, from which you can select the stylesheets to 
import.
