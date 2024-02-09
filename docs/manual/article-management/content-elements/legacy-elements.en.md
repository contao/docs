---
title: 'Legacy elements'
description: 'Content elements in the area legacy elements.'
aliases:
    - /en/article-management/content-elements/legacy-elements/
weight: 30
---


## Accordion

The accordion effect allows you to create several sections, of which only one is open at a time. If one section is 
selected, the first one closes automatically.

For the accordion to work, the *js_accordion* template must be integrated in the page layout.

**Operating mode:** Here you select the operating mode of the accordion element.

| Operating mode      | Declaration                                                                                                     |
|---------------------|-----------------------------------------------------------------------------------------------------------------|
| Single&nbsp;element | In this mode the element creates a single accordion section with a text element and an optional image.          |
| Wrapper&nbsp;start  | In this mode the element opens a new accordion section into which any other content elements can be inserted.   |
| Wrapper&nbsp;stop   | In this mode, the element closes an accordion section previously opened using "Envelope Beginning".             |


### Accordion settings

**Section headline:** Each accordion section has an always visible headline, which can be used to open it. HTML input 
is allowed here.

**CSS-Format:** If you want to format the section headline with CSS code, you can enter a format definition here.

**Element classes:** Leave this field empty to use the default class names or enter your own toggler and accordion 
classes.


### Text/HTML/Code

**Text:** Here you can enter the text of the accordion section. The input is done in the same way as for the text element using the Rich Text Editor.


### Image settings

**Add an image:** Here you can add an image to the element.

**Source file:** Here you select the image to be inserted. If you have not yet transferred the image to the server,
you can upload it here without leaving the input mask.

**Full-size view/new window:** If this option is selected, the image will be opened in its original size when clicked.
This option is not available for linked images.

**Image size:** Here you can specify the desired image size. You can choose between the following scaling modes:

| Custom dimensions               |                                                                                                                     |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| Crop&nbsp;(important&nbsp;part) | Preserves the important part of an image as specified in the file manager. If necessary, the image will be cropped. |
| Proportional                    | The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.           |
| Fit&nbsp;the&nbsp;box           | The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.          |

**Image alignment:** Here you can set the alignment of the image. If it is inserted
![above]({{% asset "icons/above.svg" %}}?classes=icon) **above**,
![under]({{% asset "icons/below.svg" %}}?classes=icon) **below**,
![left-justified]({{% asset "icons/left.svg" %}}?classes=icon) **left-aligned** or
![right-justified]({{% asset "icons/right.svg" %}}?classes=icon) **right-aligned**. When **left-** or **right-aligned**,
the text **flows around** the image (as symbolized by the icon).

**Overwrite metadata:**  Here you can overwrite the metadata from the file manager.

**Alternate text:** Here you can enter an alternative text for the image *(alt attribute)*. Accessible web pages should
contain a short description for each object, which is displayed if the object itself cannot be displayed. Alternative
texts are also evaluated by search engines and are therefore an important tool for onpage optimization.

**Image title:** Here you can enter the title of the image *(title attribute)*.

**Image link target:** When you click on a linked image, you will be redirected to the specified destination page
(corresponds to an image link). Please note that a lightbox large view is no longer possible for a linked image.

**Image caption:** Here you can enter a caption.


### Template settings

**Content element template:** Here you can overwrite `ce_accordionStart` the content element `ce_accordionSingle` 
template.

**HTML Output**  
The element generates the following HTML code for a Single Element:

```html
<section class="ce_accordionSingle ce_accordion ce_text block">
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
<section class="ce_accordionStart ce_accordion block">
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

Note that the contents of each accordion section is enclosed by two (!) `<div>` elements. This is necessary for the 
effect to work and be formatted across browsers.


## Slider

With the content element "Slider" a slider is created from different content elements.

For the slider to work, the `js_slider` template must be included in the page layout.

**Operation mode:** Here you select the operation mode of the slider element.

| Operating mode     | Declaration                                                                                                  |
|--------------------|--------------------------------------------------------------------------------------------------------------|
| Wrapper&nbsp;start | In this mode the element opens a new slider section into which any other content elements can be inserted.   |
| Wrapper&nbsp;stop  | In this mode, the element closes a slider section previously opened using "Envelope Start".                  |


### Slider settings

**Slide Interval:** Here you can define the time interval between slides in milliseconds (1000 = 1s). 0 disables the automatic change.

**Transition Speed:** Here you can set the transition speed in milliseconds (1000 = 1s).

**Slide offset:** Here you can start the slider with a specific slide (counting starts at 0).

**Continuous:** Create a continuous slider (start over when the end is reached).


### Template settings

**Content element template:** Here you can overwrite the content element `ce_sliderStart` template.

**HTML Output**  
The element generates the following HTML code:

```html
<div class="ce_sliderStart block">
    <div class="content-slider slider-start" data-config="0,300,0," style="visibility: visible;">
        <div class="slider-wrapper" style="width: 0px;">
            <div class="ce_text block">
                …
            </div>
            <div class="ce_text block">
                …
            </div>
        </div>
    </div>
    <nav class="slider-control slider-start">
        <a href="#" class="slider-prev">Previous</a>
        <span class="slider-menu"></span>
        <a href="#" class="slider-next">Next</a>
    </nav>
</div>
```