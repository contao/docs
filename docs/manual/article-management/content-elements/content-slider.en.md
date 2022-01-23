---
title: 'Content slider'
description: 'Content elements in the area content slider.'
aliases:
    - /en/article-management/content-elements/content-slider/
weight: 23
---


With the content element "Content Slider" a slider is created from different content elements. For the slider to work, 
the `js_slider` template must be included in the page layout.

| Operating mode | Here you select the operation mode of the slider element |
| -------------- | --- |
| Envelope&nbsp;beginning | In this mode the element opens a new slider section into which any other content elements can be inserted. |
| End envelope            | In this mode, the element closes a slider section previously opened using "Envelope Start". |

</br>

| Settings | 
| --- | --- |
| **Slide Interval:** | Here you can define the time interval between slides in milliseconds (1000 = 1s). 0 disables the automatic change. |
| **Transition Speed:** | Here you can set the transition speed in milliseconds (1000 = 1s). |
| **Slide offset:** | Here you can start the slider with a specific slide (counting starts at 0). |
| **Continuous:** | Create a continuous slider (start over when the end is reached). |
| **Individual&nbsp;template:** | Here you can overwrite the default `ce_sliderStart` template. |

**HTML Output**  
The element generates the following HTML code:

```html
<div class="ce_sliderStart first block">

    <div class="content-slider" data-config="5000,300,0,1">
        <div class="slider-wrapper">    
            <div class="ce_text block">
                <figure class="image_container float_above">
                <img src="…" alt="…" itemprop="image">
                </figure>
                <p>…</p> 
            </div>
            <div class="ce_text block">
                <figure class="image_container float_above">
                <img src="…" alt="…" itemprop="image">
                </figure>
                <p>…</p> 
            </div>
        </div>
    </div>

    <nav class="slider-control">
        <a href="#" class="slider-prev">Zurück</a>
        <span class="slider-menu"></span>
        <a href="#" class="slider-next">Vorwärts</a>
    </nav>

</div>
```
