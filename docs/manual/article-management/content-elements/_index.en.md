---
title: 'Content elements'
description: 'To make the creation of content as intuitive as possible, Contao provides a content element for each content type that is tailored to its requirements.'
aliases:
    - /en/article-management/content-elements/
weight: 20
---


To make the creation of content as intuitive as possible, Contao provides a content element for each content type 
that is tailored to its requirements. You can create an unlimited number of content elements per article and restrict 
access to individual elements as needed.

## 

{{% children %}}


## Access protection

![Restrict access to a content element]({{% asset "images/manual/article-management/en/restrict-access-to-a-module.png" %}}?classes=shadow)

| Info                                   |                                                            |
|----------------------------------------|------------------------------------------------------------|
| **Protect element:**                   | Show the content element to certain member groups only.    |
| **Allowed&nbsp;member&nbsp;groups:**   | These groups will be able to see the content element.      |


## Nested content element

{{< version "5.3" >}}

If you select one of these element types, you create a nested content element. In the past, you had to create a
wrapper start and a wrapper stop and the content was then placed inside.

![The time before the nested elements]({{% asset "images/manual/article-management/en/the-time-before-the-nested-elements.png" %}}?classes=shadow)

This could very quickly become confusing and if, for example, you accidentally hid or deleted just one of the elements,
it could have an impact on the front end display. But with the introduction of nested content elements is a thing of
the past.

![The nested content elements are here]({{% asset "images/manual/article-management/en/the-nested-content-elements-are-here.png" %}}?classes=shadow)

With the new nested content elements, you create an element in which you can then place child elements. You can
recognize nested content elements by the icon ![Child element]({{% asset "icons/children.svg" %}}?classes=icon).

The following nested content elements are available: 
[Accordion](/en/article-management/content-elements/miscellaneous/#accordion),
[Element group](/en/article-management/content-elements/miscellaneous/#element-group) and
[Content slider](/en/article-management/content-elements/miscellaneous/#content-slider).