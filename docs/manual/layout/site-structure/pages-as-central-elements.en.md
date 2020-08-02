---
title: 'Pages as central elements'
description: 'Contao belongs to the group of page-based content management systems, which means that the page structure is the central element of your website.'
aliases:
    - /en/layout/site-structure/pages-as-central-elements/
weight: 10
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Contao belongs to the group of page-based content management systems, which means that the page structure is the central element of your website. You can access the pages it contains via their ID or name (alias) in the frontend and view the content that is on that page.

Think of a site as a TV show, with editors creating different content for each of them, and an editor-in-chief who decides which of the content will actually be broadcast during the show. The remaining contributions were created, but never find their way into your living room. It works just as well in Contao. You can create as much content as you want in the back end, but it will never appear on your website unless it is linked to a page (show).

## Hierarchical arrangement

The page structure is organized hierarchically. You can nest the pages and create subpages that can be branched as much as you like. Contao will automatically create the appropriate navigation menu with all main and subpages in the front end. Use the gray icons with the![Open area](/de/icons/folPlus.svg?classes=icon) plus or![Close area](/de/icons/folMinus.svg?classes=icon) minus sign to the left of the page names to expand or collapse sub pages.

![Fold out and in undersides](/de/layout/site-structure/images/de/unterseiten-aus-und-einklappen.png?classes=shadow)

Thanks to the hierarchical page structure, it is possible to inherit properties of a parent page to its sub-pages. For your work, this means that you have to define a certain page layout or access permissions once and these properties are passed on automatically.

## Components of a page

A page as a central element not only needs to know which articles are linked to it. For example, it must also know which page layout it should use for display in the frontend, whether it can be stored temporarily in the cache, or which users are allowed to access it.

As you can see, each page is linked to a page layout that defines its structure and divides it into different layout areas. Within these layout areas you can place any number of frontend modules, which are executed one after the other when the page is called and generate the HTML code of the web page. The HTML code is formatted using Cascading Stylesheets, CSS for short, which are also integrated into the page layout. You can find more information about this on the [Theme Manager](../../theme-manager/) page.

In the page structure, the design-relevant elements, which are separated from the content by definition in a content management system, also come together with the actual content from the article management. Each article in turn consists of content elements that provide a corresponding input and output function for each content type, such as texts, images or tables. Any number of articles can be created per page. You can find more information on this on the page [Article Management](../../../artikelverwaltung).

In their central role, pages have much more to do than just merging design and content; access rights for backend users to pages and articles are also defined in the page structure, for example. Let's take a closer look at the different page types and how they work.

## Page types

Not all pages of a website are intended exclusively for the output of content. For example, if URLs change after a relaunch, you need a way to redirect visitors to the new pages. Especially if the old URLs are already listed in the Google index, you should make sure that the redirection is correct and has the appropriate header so that the page rank of your website is not compromised.

There are eight different page types in Contao with different functions, each designed for a specific purpose.

| Page type | Declaration |
| --------- | ----------- |
| Regular page | Regular pages are pages on which content is displayed. A regular page is similar to a static HTML file that you upload to your server and call up in your browser. |
| Internal redirection | This page type redirects visitors to another page in the page structure. The target page must be accessible under the same domain as the redirection page, otherwise an external redirection must be used. |
| External forwarding | This page type redirects visitors to an external page. This can be a page outside your server or a page within the Contao page structure but under a different domain than the redirection page. |
| Starting point of a website | This page type marks the starting point of a web page within the page structure. Contao supports the management of multiple websites with one installation. These websites can differ e.g. by different languages or run completely independently under different domains (multi-domain operation). |
| Log out | This page type creates a logout link for a protected area. After logging out, you can redirect visitors to any page or to the last page they visited. |
| 401 Not authenticated | This page is called if a member is not logged in and therefore is not allowed to access a protected page. You can either use the page as a regular page and display a corresponding hint or automatically redirect the visitor to the login page, for example. <sup> 1 {{< version "4.6" >}}</sup> |
| 403 Access denied | This page is called if a member is logged in but does not have the necessary access rights to access a protected page. You can choose to use the page as a regular page and display a hint or automatically redirect the visitor to another page. <sup> 1</sup> |
| 404 page not found | This page is called when a visitor requests a page that does not exist. You can choose to use the page as a regular page and include a sitemap or automatically redirect the user to another page. |

{{% notice note %}}
1 Before Contao 4.6, there was only the page type "403 access denied" which handled both situations "unauthenticated"(401) and "unauthorized" (403). There it could be useful to display a login module or forward it to the login. Starting with Contao 4.6, this only makes sense on the 401 page.
