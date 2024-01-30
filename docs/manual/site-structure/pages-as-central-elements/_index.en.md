---
title: 'Pages as central elements'
description: 'Contao belongs to the group of page-based content management systems, which means that the page structure is the central element of your website.'
aliases:
    - /en/site-structure/pages-as-central-elements/
    - /en/layout/site-structure/pages-as-central-elements/
weight: 10
---

Contao belongs to the group of page-based content management systems, which means that the page structure is the central
element of your website. You can access the pages it contains via their alias in the front end and thus view the content 
that is on that page.

Think of a website as a TV show for which editors create different content and at the end of the show, an editor-in-chief
decides which of these contents will be broadcast. The other contributions were created, but never find their way into
your living room. It works just the same in Contao: You can create as much content as you want in the back end but it will 
never appear on your website unless it is linked to a page (show).

## Hierarchical arrangement

The page structure is organized hierarchically. You can nest the pages and create as many subpages as you want. Contao will
automatically create the corresponding navigation menus with all main pages and subpages in the front end. Use the gray
icons with the ![Open area]({{% asset "icons/folPlus.svg" %}}?classes=icon) plus or ![Close area]({{% asset "icons/folMinus.svg" %}}?classes=icon) minus
sign to the left of the page names to expand or collapse sub pages.

![Toggle subpages]({{% asset "images/manual/layout/site-structure/en/toggle-subpages.png" %}}?classes=shadow)

Thanks to the hierarchical page structure, it is possible to inherit properties of a parent page to its subpages.
For your, this means that you only have to define a certain page layout or access permission once and these properties
are then inherited to their respective subpages automatically.

## Components of a page

A page as a central element not only needs to know which articles are linked to it. For example, it must also know which
page layout it should use for display in the front end, whether it can be cached, or which users are allowed to access it.

As you can see, each page is linked to a page layout, which defines its structure and divides it into different layout
areas. Within these layout areas you can place any number of front end modules, which are executed one after the other
when the page is requested and generate the HTML code of the web page. The HTML code is formatted using
Cascading Stylesheets, CSS for short, which are also integrated into the page layout. You can find more information
about this on the [Theme Manager](/en/layout/theme-manager/) page.

Every page consists of multiple articles which can be placed in different places depending on the assigned page layout.
Each article in turn consists of content elements that provide the corresponding functionality for each content type,
such as texts, images or tables. Any number of articles can be created per page and any number of content elements can be
assigned to an article. You can find more information on this on the [Article Management page](/en/article-management/).

In their central role, pages have much more to do than just merging design and content; back end users' access rights
to pages and articles are also defined in the page structure. Let's take a closer look at the different page types and
how they work.

## Page types

Not all pages of a website are intended exclusively for the output of content. For example, if URLs change after a
relaunch, you need a way to redirect visitors to the new pages. Especially if the old URLs are already listed in 
Google's search index, you should make sure that the redirects are correct and have the appropriate HTTP headers
so that the page rank of your website is not jeopardized.

There are different page types with different features in Contao, each of which is designed for a specific purpose.

{{% children showhidden="true" description="true" %}}
