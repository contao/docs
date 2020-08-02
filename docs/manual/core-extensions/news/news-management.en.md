---
title: 'Message management'
description: 'The message management is a separate module in the backend, which you can find in the group "Content".'
aliases:
    - /en/core-extensions/news/news-management/
weight: 10
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

The message management is a separate module in the backend, which you can find in the group "Content". There you can create several archives, which contain the individual news or blog entries. By using several archives, it is possible to categorize the posts.

## News archives

Archives are used to group and/or categorize messages. Each archive can refer to a specific language or topic.

To create a new message archive click on ![Create a new message archive](/de/icons/new.svg?classes=icon "Ein neues Nachrichtenarchiv erstellen")**New** .

### Title and forwarding

**Title:** The title of a news archive is used in the backend overview.

**Forwarding page:** Here you define to which page a visitor is forwarded when clicking on the read more link of a post. The target page should contain the "news reader" module to display the complete post.

### Access protection

Just like content elements, news or blog posts can also be protected. In this case, only registered members will be able to view the archive's articles.

**Protect archive:** Here you activate the access protection.

**Allowed member groups:** Here you define which member groups should have access to the posts after logging in to the frontend.

### Comments

You already know the Contao comment function from the [content element (comments)](../../../artikelverwaltung/inhaltselemente/#kommentare) . It is also available for news and blog posts and should be activated if you use the extensions as a blog.

**Enable comments:** Here you activate the comment function for the archive.

**Notification on:** Here you define whether the system administrator, the author of a post or both are notified when new comments are added.

**Sorting:** Here you define the order of the comments. Normally the oldest comment is shown first in a blog (ascending order).

**Comments per page:** Here you can set the number of comments per page. Contao automatically generates a page break if needed.

**Moderate comments:** If you choose this option, comments will not appear on the website immediately, but only after you have approved them in the backend.

**Allow BBCode:** If you select this option, your visitors can use [BBCode](https://de.wikipedia.org/wiki/BBCode) to format their comments. The following tags are supported:

| Day | Declaration |
| --- | ----------- |
| `[b][/b]` | Boldface |
| `[i][/i]` | Italics |
| `[u][/u]` | Underlined |
| `[img][/img]` | Insert picture |
| `[code][/code]` | Insert program code |
| `[color=#f00][/color]` | Coloured text |
| `[quote][/quote]` | Insert quote |
| `[quote=Tim][/quote]` | Insert quote with mention of the author |
| `[url][/url]` | Insert link |
| `[url=http://example.com][/url]` | Insert link with link title |
| `[email][email]` | Insert e-mail address |
| `[email=info@example.com][/email]` | Insert e-mail address with title |

**Login required for commenting:** If you select this option, only logged in members can add comments. However, comments already submitted will still be visible to all visitors of the website.

**Disable spam protection:** By default, visitors are required to answer a security question when posting comments, to prevent the commenting feature from being misused for spam purposes. If you want to allow only logged in members to comment anyway, you can disable the security question here. Since Contao 4.4 this question is only "displayed" to spambots.

## RSS feeds

Every news or blog archive can be exported as RSS/Atom feed if desired. RSS feeds are XML files containing your contributions, which can be subscribed to with an RSS reader and integrated into another website, for example.

The feeds can be integrated via the [page layout](../../../theme-manager/seitenlayouts-verwalten/#rss-atom-feeds) in the header area of the page. The "header" is not the header of your page layout, but the `head`tag of the HTML source code.

Furthermore, the XML file can also be opened directly in the browser.

The URL is:

`www.example.com/share/feed-alias.xml`

**The XML file of the feed consists of the following information:**

```rss
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>Feed-Titel</title>
        <description>Feed-Beschreibung</description>
        <link>http://www.domain.de/</link>
        <language>Feed-Sprache</language>
        <pubDate>…</pubDate>
        <generator>Contao Open Source CMS</generator>
        <atom:link href="https://www.domain.de/share/feed-alias.xml" rel="self" type="application/rss+xml" />
        <item>
            <title>Titel der Nachricht</title>
            <description><![CDATA[<p>Beschreibung der Nachricht.</p>]]></description>
            <link>https://www.domain.de/nachricht/alias-der-nachricht.html</link>
            <pubDate>…</pubDate>
            <guid>https://www.domain.de/nachricht/alias-der-nachricht.html</guid>
        </item>
        …
     </channel>
</rss>
```

To create a new feed click on **RSS feeds** and then on ![Create a new feed](/de/icons/new.svg?classes=icon "Einen neuen Feed erstellen")**New** .

### Title and language

**Title:** The title is output as a feed title in the XML file.

**Feed Alias:** The alias of a feed is used as the file name.

**Feed language:** Here you can enter the language of the [feed](http://www.rssboard.org/rss-language-codes#table).

### News archives

**News archives:** Here you define which news archives are included in the feed.

### Feed settings

**Feed format:** Here you define the format of the feed. Contao supports RSS 2.0 and Atom, the two most common formats.

**Export settings:** Here you can define whether only the teaser texts of the posts or the complete posts are exported as feed.

**Maximum number of contributions:** Here you can limit the number of posts of the feed. Usually about 25 posts per feed are sufficient. Most of the time only the first three to five are actually used anyway.

**Base URL:** The base URL is especially important in multi-domain environments when you run multiple websites with one Contao installation. To make sure that the feed links to the correct domain, you can enter it here.

**Feed description:** Here you can enter a description of the feed.

## News items {#news items}

This section explains how to create a news item. News items are always sorted by date, so there are no icons to change the order.

The news items consist of the settings for the items ("message list") and their contents ("message reader").

To create a new post, click on the desired archive and then on ![Create a new post](/de/icons/new.svg?classes=icon "Einen neuen Beitrag erstellen")**New** .

### Title and author

**Titles:** Here you can enter the title of the message.

**Message aliases:** The alias of a post is a unique and meaningful reference that you can use to view it in your browser.

**Author:** Here you can change the author of the article.

### Date and time

**Date:** Enter the date of the contribution here.

**Time:** Enter the time of the contribution here.

### Metadata

{{< version "4.7" >}}

**Meta-title:** Here you can enter an individual meta-title to overwrite the default page title.

**Meta description:** Here you can enter an individual meta description to override the default page description.

### Subheading and teaser {#subheading-and-teaser}

**Subheading:** Here you can enter an optional subheading.

**Teaser text:** Here you can enter a short summary of the news item (teaser), which can then be displayed, for example, with the "News list" module, followed by a read more link to the actual post.

### Picture settings

**Add an image:** You can add an image to your post if you wish.

**Source file:** Here you select the image to be inserted. If you have not yet transferred the image to the server, you can do so directly in the pop-up window without leaving the input mask.

![Add an image to a post](/de/core-extensions/news/images/de/einem-beitrag-ein-bild-hinzufuegen.png?classes=shadow)

**Image size:** Here you can specify the desired image size. You can choose between the following scaling modes:

| Relative format |  |
| --------------- | --- |
| Proportional | The longer side of the image is adapted to the given dimensions and the image is proportionally reduced. |
| Fit to frame | The shorter side of the image is adjusted to the given dimensions and the image is proportionally reduced. |

| Exact format |  |
| ------------ | --- |
| Important part | Preserves the important part of the image as specified in the file manager. |
| Left / Top | Preserves the left part of a landscape image and the upper part of a portrait image. |
| Middle / Top | Preserves the central part of a landscape image and the upper part of a portrait image. |
| Right / Top | Preserves the right part of a landscape image and the upper part of a portrait image. |
| Left / Middle | Preserves the left part of a landscape image and the center part of a portrait image. |
| Center / Center | Preserves the central part of a landscape image and the central part of a portrait image. |
| Right / middle | Preserves the right part of a landscape image and the center part of a portrait image. |
| Left / Bottom | Preserves the left part of a landscape image and the lower part of a portrait image. |
| Middle / Bottom | Preserves the central part of a landscape image and the lower part of a portrait image. |
| Right / Bottom | Preserves the right part of a landscape image and the lower part of a portrait image. |

**Image alignment:** Here you can set the alignment of the image. If it is   
 ![above](/de/icons/above.svg?classes=icon) ![right-justified](/de/icons/right.svg?classes=icon) inserted **above**, **below**, **left-justified** or ![right-justified](/de/icons/right.svg?classes=icon)**right-justified**. If **left-** or **right-aligned**, the text flows around the image (as symbolized by the icon).

**Image distance:** Here you define the distance between the image and the text. The order of the input fields is clockwise "top, right, bottom, left".

**Large View/New Window:** If this option is selected, the image will be opened in its original size when clicked. This option is not available for linked images.

**Overwrite metadata:**  Here you can overwrite the metadata from the file manager.

**Alternative text:** Here you can enter an alternative text for the image *(alt attribute)*. A barrier-free website should contain a short description for each object, which is displayed if the object itself cannot be displayed. Alternative texts are also evaluated by search engines and are therefore an important tool for onpage optimization.

**Picture title:** Here you can enter the title of the image *(title attribute)* .

**Image link address:** When you click on a linked image, you will be redirected to the specified target page (corresponds to an image link). Please note that for a linked image a lightbox large view is no longer possible.

**Caption:** Here you can enter a caption.

### Annexes

Enclosures, also known as "enclosures" in the context of RSS feeds, are files that are linked to an article. These files are both exported in the RSS feed and offered for download on the website.

**Add attachments:** Here you activate the adding of attachments.

**Put it on:** Here you select the files you want to attach to the post.

### Forwarding destination

The redirection destination determines which page a visitor is redirected to when clicking on a post. Normally, this is the page on which the front-end module "news reader" is integrated to display the complete article.

**Forwarding destination:** Here you set the forwarding destination.

**Forwarding page:** Here you select the target page from the page structure.

**Article:** Here you select the target article.

**Link address:** Here you enter the URL of the external target page.

**Open in a new window:** Here you can determine whether the external target page is opened in a new browser window or not.

| Forwarding destination | Declaration |
| ---------------------- | ----------- |
| Standard | You will be redirected to the page you specified in the archive settings. On this page the frontend module "news reader" should be included. |
| Page | The redirection is to a specific page in the page structure. |
| Article | The redirection is to a specific article. |
| Individual URL | The redirection is to an individual URL. |

### Expert Settings

In this section the highlighting of contributions is particularly interesting. Highlighted articles allow the creation of a "virtual archive", which contains only the highlighted articles from the different archives. This allows you to display a comprehensive list of important messages on the home page, for example.

**CSS class:** Here you can add a CSS class to your post.

**Disable comments:** Here you deactivate the comment function for a post.

**Highlight contribution:** Here you mark a post as highlighted.

### Publication {#publication}

As long as an article is not published, it will not be displayed in the frontend. You already know this behavior from pages and articles and we will encounter it in several other places in Contao. In addition to manual publishing, you have the option to activate posts automatically on a specific date.

**Publish a contribution:** Here you can publish your contribution.

**Displays off:** Here you activate a post on a specific date.

**Display until:** Here you deactivate a post on a specific date.

## Content for news articles {#content-for-news-articles}

After we have made the settings for the article, we can add content elements for the output in the "product reader", click on the desired article and then on ![Create a new content element](/de/icons/new.svg?classes=icon "Ein neues Inhaltselement erstellen") **New** .

In the news posts, you can use all the [content elements](../../../artikelverwaltung/inhaltselemente/) of Contao.
