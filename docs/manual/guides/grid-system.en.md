---
title: 'Grid System Introduction'
description: 'Understanding and using a grid system.'
aliases:
    - /en/guides/grid-system/
weight: 54
tags:
    - Theme
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

A popular stylistic device is the division of content into columns. Here the use of "grid systems" has become established. The available area is divided into a fixed number of columns. A fixed, outer distance is defined once for the total width and then between the individual columns of the grid itself.

For example, if you want to display two columns in a "12-column system", you must assign six grids to each of your two areas. This assignment is done via CSS classes.

![Grid Demo](/de/guides/images/de/grid/grid-structure.jpg?classes=shadow)

Among others, there are "12-column" or "16-column" conversions. Some are "pixel-based", others "percentage-based". Also the spacing width can vary with different systems. Ultimately, these are CSS specifications that represent a defined HTML structure accordingly.

The first solutions were implemented via [CSS-float](https://developer.mozilla.org/de/docs/Web/CSS/float) . The advantage is the support of older browser versions. Realizations via [CSS-flexbox](https://developer.mozilla.org/de/docs/Web/CSS/flex) followed and meanwhile the [CSS-grid](https://developer.mozilla.org/de/docs/Web/CSS/grid) property itself exists. The support is available in the current browser versions.

Often you will find the term "responsive" Grid. This does not only mean the variable width adjustment of the individual columns depending on the total width. You can control the number of columns yourself. For example, the content can be displayed on a desktop "4-column", on a tablet "2-column" and on a smartphone "1-column".

## The Contao Grid

The Contao grid was already introduced with [Contao version 3.0](https://contao.org/de/news/contao_3-0-RC1.html) and is based on [960.gs](https://github.com/nathansmith/960-grid-system/) . The implementation (via [CSS-float](https://developer.mozilla.org/de/docs/Web/CSS/float) ) is "pixel-based" with 12 columns and a [CSS margin](https://developer.mozilla.org/de/docs/Web/CSS/margin) of 10 pixels.

The total width of 960 pixels with two "breakpoints" at `kleiner 980 Pixel`and `kleiner 768 Pixel`is fixed. The CSS classes available are "grid1 to grid12" and "offset1 to offset12".

The CSS file can be found in the directory `assets/contao/css/grid.min.css`or `grid.css`. There you can also see under which conditions the spacing is set:

- Float and margin for all elements whose class contains the term "grid
- Margin for all elements within "mod\_article" if they contain a class starting with "ce\_" or "mod\_".
- No margin for "mod\_article" with additional "grid" designation.

The Contao grid can be integrated via your [page layout]({{< ref "manage-page-layouts.en.md" >}}) in the section "CSS framework &gt; 12-column grid".

For a "2-column" display of two content elements of type "text" you can enter the CSS class "grid6" in the area "Expert Settings &gt; CSS ID/Class". Above 768 pixels, the content elements are always displayed "2-column" and below 768 pixels they are always displayed "1-column".

{{% notice note %}}
 The aging Contao grid works with the above limitations. However, it is recommended to use a current grid solution. Alternatively, there are [numerous extensions](https://extensions.contao.org/?q=grid) available for easy [installation]({{< ref "install-extensions.en.md" >}}). 
{{% /notice %}}
