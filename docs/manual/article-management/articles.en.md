---
title: Article
description: 'Each article is assigned to a specific page and layout area.'
aliases:
    - /en/article-management/articles/
weight: 10
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

The article management is a separate module in Contao that you can find in the navigation at the top of the *Content* group. Each article is assigned to a specific page and layout area. Unlike many other CMS, the inclusion of articles in Contao is not limited to the main column, so you can design your website flexibly.

![The article management](/de/article-management/images/de/die-artikelverwaltung.png?classes=shadow)

Each page can contain any number of articles, which are displayed one below the other within their layout area in the order you specify. Contao automatically detects if you want to display the whole article or just the teaser text followed by a `read more` link.

![Several articles with teaser text](/de/article-management/images/de/mehrere-artikel-mit-teasertext.png?classes=shadow)

You assign an item to a layout part in the item settings in the Display in field. The quickest way to access the article settings is to use the ![Edit the article settings](/de/icons/header.svg?classes=icon) **Edit Article Settings** navigation icon.

## Article aliases

The alias of an article is a unique and meaningful reference that you can use to call up an article in your browser. The alias allows you to use the following URL:

`company/articles/our-team.html`

You may be wondering now that it is apparently possible to call up an article directly in the frontend. In the introductory chapter it was mentioned that visitors in the frontend can only access pages and never specific content.

However, if you look closely, you will see that the page is still part of the URL. Strictly speaking, this is where the page is called up and the display of the article module in the main column is also changed. All other articles that are not included in the main column will still be displayed normally.

## Teaser text

A teaser text is a short summary of an article, which can be displayed in an overview instead of the actual article. Contao automatically detects whether the whole article or only the teaser text should be displayed.

**Teaser CSS ID/Class:** Here you can assign a CSS ID and class to the teaser.

**Display teaser text:** If this option is selected, Contao automatically displays the teaser text of the article if there is more than one article per layout area.

**Teaser text:** Here you enter the teaser text using the Rich Text Editor.

## Syndication

In the syndication you define how an article can be syndicated. "[Content syndication](https://de.wikipedia.org/wiki/Content-Syndication)" refers to the multiple use of media content, which in the online sector refers primarily to the linking of content from different websites. The following options are available:

| Name | Declaration |
| ---- | ----------- |
| Print this page | This button calls up the print function of the browser. You can use it to put the article on paper. |
| Share on Facebook | This button opens a pop-up window where you can share the article directly on Facebook. You will need a Facebook account to do this. |
| Share on Twitter | This button opens a pop-up window where you can share the article directly on Twitter. Contao automatically shortens the URL using [tinyurl.com](https://tinyurl.com/). |

**Syndication:** Here you select the syndication options.

## Template settings

**Individual template:** Here you can overwrite the standard template `mod_article`.

## Access protection

With access protection, access to an article can be restricted to certain member groups.

**Protect articles:** Here you can display articles only to certain groups.

**Allowed member groups:** Choose from which groups are allowed to see the article.

## Expert settings

In the expert settings you can assign a CSS ID and class to the article

**CSS ID/Class:** Here you can assign a CSS ID and class to the article.

**Show guests only:** The article is visible by default and is hidden as soon as a member has logged on to the frontend.

## Publish {#publish}

Just like pages, articles are not available in the frontend as long as they have not been published. In addition to manual publishing, Contao also offers the possibility to automatically activate articles on a specific date. This way, you can for example promote a limited time offer.

**Published:** Here you can publish an article.

**Displays off:** Here you activate an article on a specific date.

**Display until:** Here you deactivate an article on a certain date.
