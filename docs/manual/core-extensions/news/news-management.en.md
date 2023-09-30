---
title: 'News management'
description: 'The news management is a separate module in the back end, which you can find in the group "Content".'
aliases:
    - /en/core-extensions/news/news-management/
weight: 10
---

The news management is a separate module in the back end, which you can find under "Contents". In new management you can 
create several archives, which contain individual news or blog entries. By using several archives you can categorize 
your posts.


## News archives

Archives are used to group and/or categorize news articles. Each archive can refer to a specific language or topic.

To create a new news archive click on New ![Create a new news archive]({{% asset "icons/new.svg" %}}?classes=icon "Create a new news archive").


### Title and forwarding

**Title:** The title of a news archive is used in the back end overview.

**Forwarding page:** Here you can define the page to which a visitor is forwarded when clicking on the read more link 
of a post. The target page should contain the "News reader" module to display the complete article.


### Access protection

Just like content elements, news or blog posts can also be protected. Only registered members will be able to view the 
archive entries.

**Protect archive:** Here you can activate the access protection.

**Allowed member groups:** Here you define which member groups should have access to the posts after logging in to the 
front end.


### Comments

You already know the Contao comment function from the content element with the same name 
[comments](/en/article-management/content-elements/#comments). It is also available for news and blog posts and should 
be activated if you use the extensions as a blog.

**Activate comments:** Here you activate the comment function for the archive.

**Notification on:** Here you can specify whether the system administrator, the author of a post or both are to be 
notified when new comments are made.

**Sorting**: Here you can determine the order of the comments. Normally the oldest comment is shown first in a blog 
(ascending order).

**Comments per page:** Here you can set the number of comments per page. Contao automatically creates a page break 
when it is needed.

**Moderate comments:** If you select this option, comments will not appear on the website immediately, but only after 
you have enabled them in the back end.

**Allow BBCode:** If you select this option, your visitors can use [BBCode](https://de.wikipedia.org/wiki/BBCode) to 
format their comments. The following tags are supported:

| Day | Statement |
| --- | --------- |
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

**Login required for commenting:** If you select this option, only logged in members can add comments. However, 
comments already submitted will still be visible to all visitors of the website.

**Disable spam protection:** By default, visitors have to answer a security question when creating comments, so that 
the comment function cannot be misused for spam purposes. However, if you want to allow only logged in members to 
comment, you can disable the security question here. Since Contao 4.4, this question is only "displayed" to spambots.


## RSS feeds

Every news or blog archive can be exported as RSS/Atom feed if desired. RSSFeeds are XML files containing your news 
contributions, which can be subscribed to with an RSS reader and integrated into another website, for example.

The feeds can be integrated via the [page layout](/en/layout/theme-manager/manage-page-layouts/#rss-atom-feeds) in the 
header of the page. The "header" is not the header of your page layout, but the tag `head` of the HTML source code.

Furthermore, the XML file can also be opened directly in the browser.

The URL is:

`www.example.com/share/feed-alias.xml`

**The XML file of the feed consists of the following information:**

```rss
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>Feed title</title>
        <description>Feed description</description>
        <link>https://www.example.com/</link>
        <language>Feed languag</language>
        <pubDate>…</pubDate>
        <generator>Contao Open Source CMS</generator>
        <atom:link href="https://www.example.com/share/feed-alias.xml" rel="self" type="application/rss+xml" />
        <item>
            <title>News title</title>
            <description><![CDATA[<p>Description of the news article.</p>]]></description>
            <link>https://www.example.com/news/alias-of-the-news.html</link>
            <pubDate>…</pubDate>
            <guid>https://www.example.com/news/alias-of-the-news.html</guid>
            <media:content url="https://www.example.com/assets/images/…/image.png" type="image/png" />
        </item>
        …
     </channel>
</rss>
```

To create a new feed click on **RSS Feeds** ![Manage RSS feeds]({{% asset "icons/rss.svg" %}}?classes=icon "RSS-Feeds verwalten") 
and then on **New** ![Create a new feed]({{% asset "icons/new.svg" %}}?classes=icon "Einen neuen Feed erstellen").


### Title and language

**Title:** The title is output as a feed title in the XML file.

**Feed Alias:** The alias of a feed is used as the file name.

**Feed language**: Here you can enter the language of the [feed](http://www.rssboard.org/rss-language-codes#table).


### News archives

**News archives:** Here you define which news archives are included in the feed.


### Feed settings

**Feed format**: Here you can define the format of the feed. Contao supports RSS 2.0 and Atom, the two most popular 
formats.

**Export settings:** Here you can specify whether only the teaser texts of the posts or the complete posts are exported 
as feed.

**Maximum number of contributions:** Here you can limit the number of posts of the feed. Usually about 25 posts per 
feed are sufficient. Most of the time only the first three to five are actually used anyway.

**Base URL:** The base URL is especially important in multi-domain operation, if you run several websites with one 
Contao installation. To make sure that the feed links to the correct domain, you can enter it here.

**Feed description**: Here you can enter a description of the feed.


### Image settings

{{< version "4.13" >}}

**Image size:** Here you can specify the desired image size. You can choose between the following scaling modes:

| Relative format |  |
| --------------- | --- |
| Proportional | The longer side of the image is adapted to the given dimensions and the image is proportionally reduced. |
| Fit to frame | The shorter side of the image is adjusted to the given dimensions and the image is proportionally reduced. |

&nbsp;

| Exact format |  |
| ------------ | --- |
| Important part | Preserves the important part of the image as specified in the file manager. |
| Left / Top | Preserves the left part of a landscape image and the upper part of a portrait image. |
| Middle / Top | Preserves the central part of a landscape image and the upper part of a portrait image. |
| Right / Top | Get the right part of a landscape image and the upper part of a portrait image. |
| Left / Middle | Preserves the left part of a landscape image and the center part of a portrait image. |
| Center / Center | Preserves the central part of a landscape image and the central part of a portrait image. |
| Right / Middle | Preserves the right part of a landscape image and the center part of a portrait image. |
| Left / Bottom | Contains the left part of a landscape image and the lower part of a portrait image. |
| Middle / Bottom | Preserves the central part of a landscape image and the lower part of a portrait image. |
| Right / Bottom | Preserves the right part of a landscape image and the lower part of a portrait image. |


## News items

This section explains how to create a news item. News items are generally sorted by date, so there are no icons to 
change the order.

The news items consist of the settings for the items ("News List") and their contents ("News Reader").

To create a new post, click on the desired archive 
![Edit news archive]({{% asset "icons/edit.svg" %}}?classes=icon "Edit news archive") and then on 
![Create a new post]({{% asset "icons/new.svg" %}}?classes=icon "Create a new post") **New**.


### Title and Author

**Titles:** Here you can enter the title of the news post.

**News alias:** The alias of a post is a unique and meaningful reference that you can use to view it in your 
browser.

**Author:** Here you can change the author of the post.


### Date and time

**Date:** Enter the contribution date here.

**Time**: Enter the time of the post here.


### Metadata

{{< version "4.7" >}}

**Meta-title:** Here you can enter an individual meta-title to overwrite the default page title.

**Meta description:** Here you can enter an individual meta description to override the default page description.


### Subheading and Teaser {#underheading-and-teaser}

**Subheading:** Here you can enter an optional subheading.

**Teaser text:** Here you can enter a short summary of the news item (teaser), which can then be displayed, for 
example, with the module "News list", followed by a link to the actual post.


### Image settings

**Add an image:** You can add an image to your post if you wish.

**source file:** Here you select the image to be inserted. If you have not yet uploaded the image to the server, you 
can upload it directly in the pop-up window without leaving the the News section.

![Add an image to a post]({{% asset "images/manual/core-extensions/news/en/add-an-image-to-a-post.png" %}}?classes=shadow)

**Image size:** Here you can specify the image size. You can choose between the following scaling modes:

| Relative format |  |
| --------------- | --- |
| Proportional | The longer side of the image is adapted to the given dimensions and the image is proportionally reduced. |
| Fit to frame | The shorter side of the image is adjusted to the given dimensions and the image is proportionally reduced. |

| Exact format |  |
| ------------ | --- |
| Important part | Keeps the important part of the image as specified in the file management. |
| Left / Top | Preserves the left part of a landscape image and the upper part of a portrait image. |
| Middle / Top | Preserves the central part of a landscape image and the upper part of a portrait image. |
| Right / Top | Preserves the right part of a landscape image and the upper part of a portrait image. |
| Left / Center | Preserves the left part of a landscape image and the center part of a portrait image. |
| Center / Center | Preserves the central part of a landscape image and the central part of a portrait image. |
| Right / Middle | Preserves the right part of a landscape image and the center part of a portrait image. |
| Left / Bottom | Preserves the left part of a landscape image and the lower part of a portrait image. |
| Center / Bottom | Preserves the middle part of a landscape image and the lower part of a portrait image. |
| Right / Bottom | Preserves the right part of a landscape image and the lower part of a portrait image. |

**Image Alignment:** Here you set the alignment of the image. If it is inserted  
![above]({{% asset "icons/above.svg" %}}?classes=icon) **above**,![under]({{% asset "icons/below.svg" %}}?classes=icon) **below**,
![left-justified]({{% asset "icons/left.svg" %}}?classes=icon) **left-aligned** or![right-justified]({{% asset "icons/right.svg" %}}?classes=icon) 
**right-aligned**. When **left-** or **right-aligned**, the text **flows around** the image (as symbolized by the icon).

**Image distance:** Here you define the distance between the image and the text. The order of the input fields is 
clockwise "top, right, bottom, left".

**Large View/New Window:** If this option is selected, the image will be opened in its original size when clicked. This 
option is not available for linked images.

**Overwrite metadata:**  Here you can overwrite the metadata from the file manager.

**Alternative text:** Here you can enter alternative text for the image *(alt attribute)*. Accessible web pages should 
contain a short description for each object, which will be displayed if the object itself cannot be displayed. 
Alternative texts are also evaluated by search engines and are therefore an important tool for onpage optimization.

**Image title:** Here you can enter the title of the image *(title attribute)*.

**Image link address:** When you click on a linked image, you will be redirected to the specified target page 
(corresponds to an image link). Please note that for a linked image a lightbox full view is no longer possible.

**caption:** Here you can enter a caption.


### Attachments

Enclosures, also known as "Enclosures" in connection with RSS feeds, are files that are linked to an article; these 
files are both exported in the RSS feed and offered for download on your website.

**Add Enclosures:** Here you can activate the adding of attachments.

**Enclose:** Here you select the files you want to link to the post.


### Forwarding destination

The redirection destination determines which page a visitor is redirected to when clicking on a post, usually the page 
where the front end module "News reader" is integrated to display the complete post.

Forwarding **destination:** Here you define the forwarding destination.

**Forwarding page:** Here you select the target page from the page structure.

**Articles:** Here you select the target article.

**Link address:** Here you enter the URL of the external target page.

**Open in a new window:** Here you can determine whether the external target page will be opened in a new browser 
window or not.

| Forwarding destination | Declaration |
| ---------------------- | ----------- |
| Standard | You will be redirected to the page you specified in the News archive settings. On this page the front end module "News reader" should be included. |
| Page | The redirection is to a specific page in the page structure. |
| Article | The redirection is to a specific article. |
| Individual URL | The redirection is to an individual URL. |


### Expert settings

In this section the featured posts are particularly interesting. Featured posts allow the creation of a "virtual 
archive", which contains only the Featured posts from the various archives. This allows you to display a comprehensive 
list of important posts on the home page, for example.

**CSS class:** Here you can add a CSS class to the post.

**Disable comments:** Here you can deactivate the comment function for a post.

**Highlight post:** Here you can mark a post as Featured.


### Publication {#publication}

As long as an article is not published, it will not be displayed in the front end. You already know this behavior from 
pages and articles and will encounter it in several other places in Contao. In addition to manual publishing, you also 
have the option to automatically activate posts on a certain date.

**Publish a post:** Here you can post your contribution.

**Show from:** Here you can activate a post on a specific date.

**Show until:** Here you can deactivate a post on a certain date.


## Content for news posts {#content-for-news}

After we have made the settings for the post, we can add content elements for the output in the "News reader", click on 
the desired article ![Edit contribution]({{% asset "icons/edit.svg" %}}?classes=icon "Beitrag bearbeiten") and then on 
![Create a new content element]({{% asset "icons/new.svg" %}}?classes=icon "Ein neues Inhaltselement erstellen") **New**.

All [content elements](/en/article-management/content-elements/) of Contao are available in the news items.