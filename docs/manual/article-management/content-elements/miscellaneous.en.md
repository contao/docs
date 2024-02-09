---
title: "Miscellaneous"
description: "Content elements in the area miscellaneous."
aliases:
    - /en/article-management/content-elements/miscellaneous/
weight: 28
---


{{< version "5.3" >}}

If you select one of these element types, you create a nested content element. In the past, you had to create a
wrapper start and a wrapper end and the content was then placed inside.

![The time before the nested elements]({{% asset "images/manual/article-management/en/the-time-before-the-nested-elements.png" %}}?classes=shadow)

This could very quickly become confusing and if, for example, you accidentally hid or deleted just one of the elements, 
it could have an impact on the front end display. But with the introduction of nested content elements is a thing of 
the past.

![The nested content elements are here]({{% asset "images/manual/article-management/en/the-nested-content-elements-are-here.png" %}}?classes=shadow)

With the new nested content elements, you create an element in which you can then place child elements. You can 
recognize nested content elements by the icon ![Child element]({{% asset "icons/children.svg" %}}?classes=icon).


## Accordion

The accordion effect allows you to create several sections, of which only one is open at a time. If one section is 
selected, the first one closes automatically. The model for the implementation in Contao is the package 
[Handorgel](https://github.com/oncode/handorgel).

![Accordion]({{% asset "images/manual/article-management/en/accordion.png" %}}?classes=shadow)



### Accordion settings

**Close all sections:** Do not open the first section by default.


### Template settings

**Content element template:** Here you can overwrite the content element `content_element/accordion` template.

**HTML Output**
The element generates the following HTML code:

```html
<div class="content-accordion" id="handorgel1">
    <h2 class="handorgel__header" id="handorgel1-fold1-header">
        <button class="handorgel__header__button" aria-controls="handorgel1-fold1-content" aria-expanded="false" aria-disabled="false">…</button>
    </h2>
    <div class="handorgel__content" id="handorgel1-fold1-content" role="region" aria-labelledby="handorgel1-fold1-header" style="height: 0px;">
        <div class="handorgel__content__inner">
            <div class="content-text">
                <div class="rte">
                    …
                </div>
            </div>
        </div>
    </div>
    <h2 class="handorgel__header" id="handorgel1-fold2-header">
        <button class="handorgel__header__button" aria-controls="handorgel1-fold2-content" aria-expanded="false" aria-disabled="false">…</button>
    </h2>
    <div class="handorgel__content" id="handorgel1-fold2-content" role="region" aria-labelledby="handorgel1-fold2-header" style="height: 0px;">
        <div class="handorgel__content__inner">
            <div class="content-text">
                <div class="rte">
                    …
                </div>
            </div>
        </div>
    </div>
</div>
```


## Element group

You can use element groups to group content and thus increase the overview in the back end.


### Template settings

**Content element template:** Here you can overwrite the content element `content_element/element_group` template.

**HTML Output**
The element generates the following HTML code:

```html
<div class="content-element-group">
    <div class="content-text">
        <h2>…</h2>
        <div class="rte">
            …
        </div>
    </div>
    <div class="content-text">
        <h2>…</h2>
        <div class="rte">
            …
        </div>
    </div>
</div>
```


## Content slider

The content element "Content slider" is used to create a slider from various content elements. The model for the 
implementation in Contao is the package [Swiper](https://swiperjs.com/).

![Content slider]({{% asset "images/manual/article-management/en/content-slider.png" %}}?classes=shadow)


### Slider settings

**Sliding interval:** Here you can specify the period in milliseconds between slides (1000 = 1s). 0 deactivates the 
automatic change.

**Transition speed:** Here you can determine the transition speed in milliseconds (1000 = 1s).

**Slide offset:** Here you can start the slider with a specific slide (the count starts at 0).

**Continuous:** Create a continuous slider (start from the beginning when the end is reached).


### Template settings

**Content element template:** Here you can overwrite the content element `content_element/swiper` template.

**HTML Output**
The element generates the following HTML code:

```html
<div class="content-swiper">
    <div class="swiper" data-delay="0" data-speed="300" data-offset="0" data-loop>
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="content-text">
                    <h2>…</h2>
                    <div class="rte">
                        …
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="content-text">
                    <h2>…</h2>
                    <div class="rte">
                        …
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="swiper-button-prev"></button>
        <button type="button" class="swiper-button-next"></button>
        <div class="swiper-pagination"></div>
    </div>
</div>
```