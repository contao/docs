---
title: 'Accordion'
description: 'Content elements in the area accordion.'
aliases:
    - /en/article-management/content-elements/accordion/
hidden: true
type: redirect
target: "/en/article-management/content-elements/legacy-elements/"
---


The accordion effect allows you to create several sections, of which only one is open at a time. If one section is selected, the first one closes automatically.

**Operating mode:** Here you select the operating mode of the accordion element.

| Operating mode | Declaration |
| -------------- | ----------- |
| Single element | In this mode the element creates a single accordion section with a text element and an optional image. |
| Start envelope | In this mode the element opens a new accordion section into which any other content elements can be inserted. |
| Envelope end | In this mode, the element closes an accordion section previously opened using "Envelope Beginning". |

**Section Heading:** Each accordion section has an always visible heading, which can be used to open it. HTML input is allowed here.

**CSS-Format:** If you want to format the section headline with CSS code, you can enter a format definition here.

**Class names:** Leave this field empty to use the default class names or enter your own toggler and accordion classes.

**Text:** Here you can enter the text of the accordion section. The input is done in the same way as for the text element using the Rich Text Editor.

**Add an image:** Here you can add an image to the element.

**Individual Template**: Here you can overwrite `ce_accordionStart` the standard `ce_accordionSingle` template.

**HTML Output**  
The element generates the following HTML code for a Single Element:

```html
<section class="ce_accordionSingle first ce_accordion ce_text block">

    <div class="toggler">…</div>

    <div class="accordion">
        <div>
            <p>…</p>
        </div>
    </div>

</section>
```

Otherwise the generated HTML code looks like this:

```html
<section class="ce_accordionStart first ce_accordion block">

    <div class="toggler">…</div>

    <div class="accordion">
        <div>
            <div class="ce_text block">
                <p>…</p> 
            </div>
        </div>
    </div>

</section>
```

Note that the contents of each accordion section is enclosed by two (!) `<div>` elements. This is necessary for the effect to work and be formatted across browsers.