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

Article management is a separate module in Contao that you can *find* in the navigation at the top of the *Content* group. Each article is assigned to a specific page and layout area. In contrast to too many other CMSs, the inclusion of articles in Contao is not limited to the main column, so you can design your website flexibly.

![The article management](/de/article-management/images/de/die-artikelverwaltung.png?classes=shadow)

Each page can contain any number of articles, which are displayed one below the other within their layout area in the order determined by you. Contao automatically detects whether the whole article or only the text followed by a `Weiterlesen`link should be displayed.

![Several articles with teaser text](/de/article-management/images/de/mehrere-artikel-mit-teasertext.png?classes=shadow)

You assign an item to a layout part in the item settings in the Display in field. The quickest way to access the article settings is to use the **Edit Article Settings** navigation![Edit the article settings](/de/icons/header.svg?classes=icon) icon.

## Article aliases

The alias of an article is a unique and meaningful reference that you can use to call up an article in your browser. The alias allows you to use the following URL:

`unternehmen/articles/unser-team.html`

You may wonder why it is possible to call up an article directly in the frontend. In the introductory chapter it was mentioned that visitors in the frontend can only access pages and never specific content.

But if you look closely, you will see that the page is still part of the URL. Strictly speaking, this is where the page is called up and the display of the article module in the main column is changed; all other articles that are not included in the main column are still displayed as normal.

## Teaser text

A teaser text is a short summary of an article, which can be displayed in an overview instead of the actual article. Contao automatically detects whether the whole article or only the teaser text should be displayed.

**Teaser CSS ID/Class:** Here you can assign a CSS ID and class to the teaser.

**Show teaser text:** If this option is selected, Contao automatically displays the teaser text of the article if there is more than one article per layout area.

**Teaser text:** Here you enter the teaser text using the rich text editor.

## Syndication

In the syndication you define how an article can be syndicated.[ Content Syndication](https://de.wikipedia.org/wiki/Content-Syndication)" is the term used to describe the multiple use of media content, which in the online sector refers primarily to the linking of content from different websites:

| Name | Explanation |
| ---- | ----------- |
| Print this page | This button calls the print function of the browser. You can use it to put the article on paper. |
| Share on Facebook | This button opens a pop-up window where you can share the article directly on Facebook. You will need a Facebook account to do this. |
| Share on Twitter | This button opens a pop-up window where you can share the article directly on Twitter. Contao automatically shortens the URL using [tinyurl.com](https://tinyurl.com/). |

**Syndication:** Here you select the syndication options.

## Template settings

**Individual template:** Here you can overwrite the standard `mod_article`template.

## Access protection

With access protection, access to an article can be restricted to certain member groups.

**Protect articles:** Here you can display articles only to certain groups.

**Allowed member groups:** Choose which groups are allowed to see the article.

## Expert settings

In the expert settings you can assign a CSS ID and class to the article

**CSS ID/Class:** Here you can assign a CSS ID and class to the article.

**Show only guests:** The article is visible by default and will be hidden once a member has logged in to the front end.

## Publish {#publish}

Just like pages, articles are not available in the frontend until they are published. In addition to manual publishing, Contao also offers the possibility to automatically activate articles on a certain date. This way, you can for example promote a limited time offer.

**Published:** Here you can publish an article.

**Show from:** Here you activate an article on a specific date.

**Display until:** Here you deactivate an article on a certain date.
