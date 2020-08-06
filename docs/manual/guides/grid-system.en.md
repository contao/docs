---
title: "Grid System Introduction"
description: "Understanding and using a grid system."
aliases:
    - /en/guides/grid-system/
weight: 54
tags:
    - "Theme"
---

A popular stylistic device is the division of content into columns. Here the use of "grid systems" has become established. 
The available area is divided into a fixed number of columns. A fixed, outer distance, is defined once for the total width 
and then between the individual columns of the grid itself.

For example, if you want to display two columns in a "12-column system", you must assign six grids to each of 
your two areas. This assignment is done via CSS classes.

![Grid Demo](/de/guides/images/en/grid/grid-structure.jpg?classes=shadow)

Among others, there are "12-column" or "16-column" realizations. Some are "pixel-based", others "percentage-based", 
and the spacing width can also vary with different systems. Ultimately, it is CSS information to display a 
defined HTML structure accordingly.

The first solutions were implemented via [CSS-float](https://developer.mozilla.org/en/docs/Web/CSS/float). 
The advantage is the support of older browser versions. Realizations via 
[CSS-flexbox](https://developer.mozilla.org/en-US/docs/Web/CSS/flex) followed and meanwhile the 
[CSS-grid](https://developer.mozilla.org/en/docs/Web/CSS/grid) property itself exists. The support is available 
in the current browser versions.

Often you will find the term "responsive" grid. This is not only the variable width adjustment of the individual 
columns depending on the total width. You can control the number of columns yourself. For example, 
the content can be displayed on a desktop "4-column", on a tablet "2-column" and on a smartphone "1-column".


## The Contao grid

The Contao grid was already introduced with [Contao version 3.0](https://contao.org/de/news/contao_3-0-RC1.html) and 
is based on the [960.gs](https://github.com/nathansmith/960-grid-system/). The implementation (via CSS-float) 
is "pixel-based" with 12 columns and 10 pixels [CSS margin](https://developer.mozilla.org/en/docs/Web/CSS/margin).

The total width of 960 pixels with two "breakpoints" at `< 980 Pixel` and `< 768 Pixel` is fixed. 
The CSS classes available are "grid1 to grid12" and "offset1 to offset12".

The CSS file can be found in the directory `assets/contao/css/grid.min.css` or `grid.css`. 
There you can also see under which conditions the spacing is set:

- Float and margin for all elements whose class contains the name "grid
- Margin for all elements within "mod_article" if they contain a class starting with "ce_" or "mod_".
- No margin for "mod_article" with additional "grid" designation.

The Contao grid can be integrated via your [page layout](/en/layout/theme-manager/manage-page-layouts/) in 
the section "CSS framework &gt; 12-column grid".

For "2-column" display of two content elements of type "text" you can enter the CSS class "grid6" in the 
area "Expert Settings &gt; CSS ID/Class". Above 768 pixels the content elements are always displayed in "2 columns" 
and below 768 pixels in "1 column".

{{% notice note %}}
The old Contao grid works with the above restrictions. However, it is recommended to use a current grid solution. 
Alternatively, there are [numerous extensions](https://extensions.contao.org/?q=grid) available for 
simple [installation](/en/installation/install-extensions/).
{{% /notice %}}
