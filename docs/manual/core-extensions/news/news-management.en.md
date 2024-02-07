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

To create a new news archive click on New 
![Create a new news archive]({{% asset "icons/new.svg" %}}?classes=icon "Create a new news archive").


### Title and redirect page

**Title:** The title of a news archive is used in the back end overview.

**Redirect page:** Here you can define the page to which a visitor is forwarded when clicking on the read more link 
of a post. The target page should contain the "News reader" module to display the complete article.


### Access protection

Just like content elements, news or blog posts can also be protected. Only registered members will be able to view the 
archive entries.

**Protect archive:** Here you can activate the access protection.

**Allowed member groups:** Here you define which member groups should have access to the posts after logging in to the 
front end.


### Comments

You already know the Contao comment function from the include element with the same name 
[comments](/en/article-management/content-elements/include-elements/#comments). It is also available for news and blog 
posts and should be activated if you use the extensions as a blog.

**Enable comments:** Here you activate the comment function for the archive.

**Notify:** Here you can specify whether the system administrator, the author of a post or both are to be 
notified when new comments are made.

**Sort order** Here you can determine the order of the comments. Normally the oldest comment is shown first in a blog 
(ascending order).

**Comments per page:** Here you can set the number of comments per page. Contao automatically creates a page break 
when it is needed.

**Moderate comments:** If you select this option, comments will not appear on the website immediately, but only after 
you have enabled them in the back end.

**Allow BBCode:** If you select this option, your visitors can use [BBCode](https://de.wikipedia.org/wiki/BBCode) to 
format their comments. The following tags are supported:

| Day                                  | Statement                               |
|--------------------------------------|-----------------------------------------|
| `[b][/b]`                            | Boldface                                |
| `[i][/i]`                            | Italics                                 |
| `[u][/u]`                            | Underlined                              |
| `[img][/img]`                        | Insert picture                          |
| `[code][/code]`                      | Insert program code                     |
| `[color=#f00][/color]`               | Coloured text                           |
| `[quote][/quote]`                    | Insert quote                            |
| `[quote=Tim][/quote]`                | Insert quote with mention of the author |
| `[url][/url]`                        | Insert link                             |
| `[url=http://example.com][/url]`     | Insert link with link title             |
| `[email][email]`                     | Insert e-mail address                   |
| `[email=info@example.com][/email]`   | Insert e-mail address with title        |

**Require login to comment:** If you select this option, only logged in members can add comments. However, 
comments already submitted will still be visible to all visitors of the website.

**Disable spam protection:** By default, visitors have to answer a security question when creating comments, so that 
the comment function cannot be misused for spam purposes. However, if you want to allow only logged in members to 
comment, you can disable the security question here. Since Contao 4.4, this question is only "displayed" to spambots.


## RSS feeds

{{< tabs groupId="contaoVersion">}}
{{% tab name="Contao  4" %}}
Every news or blog archive can be exported as RSS/Atom feed if desired. RSS feeds are XML files containing your news 
contributions, which can be subscribed to with an RSS reader and integrated into another website, for example.

The feeds can be integrated via the [page layout](/en/layout/theme-manager/manage-page-layouts/#rss-atom-feeds) in the 
header of the page. The "header" is not the header of your page layout, but the tag `head` of the HTML source code.

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

**Image size:** Here you can specify the desired image size. You can choose between the following scaling modes:

| Custom dimensions               |                                                                                                                     |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| Crop&nbsp;(important&nbsp;part) | Preserves the important part of an image as specified in the file manager. If necessary, the image will be cropped. |
| Proportional                    | The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.           |
| Fit&nbsp;the&nbsp;box           | The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.          |

{{% /tab %}}
{{% tab name="Contao 5" %}}
Every news or blog archive can be exported as RSS/Atom or JSON feed if desired. RSS feeds are XML files containing your 
news contributions, which can be subscribed to with an RSS reader and integrated into another website, for example.

To create a news feed, select the page type [news feed](/en/site-structure/news-feed/) in the "Pages" area and make the 
desired settings for your feed.

The feeds can be integrated via the [page layout](/en/layout/theme-manager/manage-page-layouts/#rss-atom-feeds) in the
header of the page. The "header" is not the header of your page layout, but the tag `head` of the HTML source code.
{{% /tab %}}
{{< /tabs >}}



## News items

This section explains how to create a news item. News items are generally sorted by date, so there are no icons to 
change the order.

The news items consist of the settings for the items ("News List") and their contents ("News Reader").

To create a new post, click on the desired archive 
![Edit news archive]({{% asset "icons/edit.svg" %}}?classes=icon "Edit news archive") or
![Edit news archive]({{% asset "icons/children.svg" %}}?classes=icon "Edit news archive") and then on 
![Create a new post]({{% asset "icons/new.svg" %}}?classes=icon "Create a new post") **New**.


### Title and Author

**Titles:** Here you can enter the title of the news post.

**Feature item:** Here you can mark a post as featured.

**News alias:** The alias of a post is a unique and meaningful reference that you can use to view it in your browser.

**Author:** Here you can change the author of the post.


### Date and time

**Date:** Enter the contribution date here.

**Time**: Enter the time of the post here.


### Redirect target

The redirection destination determines to which page a visitor is redirected when clicking on an event, usually the page
on which the front end module "Eventleser" is integrated to display the complete event.

**Redirect target:** Here you can set the forwarding destination.

| Redirect target                   | Explanation                                                                                                                                   |
|-----------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------|
| Use default <sup>1</sup>          | You will be redirected to the page you specified in the archive settings. On this page the front end module "news reader" should be included. |
| Page <sup>2</sup>                 | The redirection is to a specific page in the page structure.                                                                                  |
| Article <sup>3</sup>              | The redirection is to a specific article.                                                                                                     |
| Custom&nbsp;URL&nbsp;<sup>4</sup> | The redirection is to an individual URL.                                                                                                      |

**Link text:** Here you can overwrite the standard text of the "Read more..." link. <sup>1</sup> <sup>2</sup>
<sup>3</sup> <sup>4</sup>

{{< version-tag "5.3" >}} **Canonical URL:** Here you can define an individual canonical URL such as
https://www.example.com/. <sup>1</sup>

**Redirect page**: Here you can select the destination page from the page structure. <sup>2</sup>

**Article:** Here you select the destination article. <sup>3</sup>

**Link target:** Here you enter the URL of the external target page. <sup>4</sup>

**Open in a new window:** Here you can determine whether the external target page is opened in a new browser window or
not. <sup>4</sup>


### Metadata

**Meta title:** Here you can enter an individual meta-title to overwrite the default page title.

**Output in source code:**
```html
<title>Page title</title>
```

**Robots tag:** The robots tag defines how search engines treat a page.

- *index:* add the page to the search index
- *follow:* follow the links on the page
- *noindex:* do not include the page in the search index
- *nofollow:* do not follow the links on the page

The default case is *index,follow*, because we want Google and other search engines to include our pages in the search
index. However, certain pages, such as the imprint or the registration page, can be excluded from indexing using the
setting *noindex,nofollow*.

**Output in source code:**
```html
<meta name="robots" content="index,follow">
```

**Meta description**: Here you can enter an individual meta description to override the default page description.

**Output in source code:**
```html
<meta name="description" content="Description of the page (between 150 and 300 characters).">
```

**Google search results preview:** Here you can preview the metadata in the Google search results. Other search engines
might show longer texts or crop at a different position.

![Google search results preview]({{% asset "images/manual/layout/site-structure/en/google-search-results-preview.png" %}}?classes=shadow)


### Subheadline and Teaser

**Subheadline:** Here you can enter an optional Subheadline.

**Teaser text:** Here you can enter a short summary of the news item (teaser), which can then be displayed, for 
example, with the module "News list", followed by a link to the actual post.


### Image settings

**Add an image:** You can add an image to your post if you wish.

**source file:** Here you select the image to be inserted. If you have not yet uploaded the image to the server, you 
can upload it directly in the pop-up window without leaving the the News section.

**Full-size view/new window:** If this option is selected, the image will be opened in its original size when clicked. 
This option is not available for linked images.

![Add an image to a post]({{% asset "images/manual/core-extensions/news/en/add-an-image-to-a-post.png" %}}?classes=shadow)

**Image size:** Here you can specify the image size. You can choose between the following scaling modes:

| Custom dimensions               |                                                                                                                     |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| Crop&nbsp;(important&nbsp;part) | Preserves the important part of an image as specified in the file manager. If necessary, the image will be cropped. |
| Proportional                    | The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.           |
| Fit&nbsp;the&nbsp;box           | The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.          |

**Image Alignment:** Here you set the alignment of the image. If it is inserted  
![above]({{% asset "icons/above.svg" %}}?classes=icon) **above**,![under]({{% asset "icons/below.svg" %}}?classes=icon) **below**,
![left-justified]({{% asset "icons/left.svg" %}}?classes=icon) **left-aligned** or![right-justified]({{% asset "icons/right.svg" %}}?classes=icon) 
**right-aligned**. When **left-** or **right-aligned**, the text **flows around** the image (as symbolized by the icon).

**Overwrite metadata:**  Here you can overwrite the metadata from the file manager.

**Alternate text:** Here you can enter alternative text for the image *(alt attribute)*. Accessible web pages should 
contain a short description for each object, which will be displayed if the object itself cannot be displayed. 
Alternative texts are also evaluated by search engines and are therefore an important tool for onpage optimization.

**Image title:** Here you can enter the title of the image *(title attribute)*.

**Image link target:** When you click on a linked image, you will be redirected to the specified target page 
(corresponds to an image link). Please note that for a linked image a lightbox full view is no longer possible.

**Image caption:** Here you can enter a caption.


### Attachments

Enclosures, also known as "Enclosures" in connection with RSS feeds, are files that are linked to an article; these 
files are both exported in the RSS feed and offered for download on your website.

**Add Enclosures:** Here you can activate the adding of attachments.

**Enclosures:** Here you select the files you want to link to the post.


### Expert settings

In this section the featured posts are particularly interesting. Featured posts allow the creation of a "virtual 
archive", which contains only the Featured posts from the various archives. This allows you to display a comprehensive 
list of important posts on the home page, for example.

**CSS class:** Here you can add a CSS class to the post.

**Disable comments:** Here you can deactivate the comment function for a post.


### Publish settings

As long as an article is not published, it will not be displayed in the front end. You already know this behavior from 
pages and articles and will encounter it in several other places in Contao. In addition to manual publishing, you also 
have the option to automatically activate posts on a certain date.

**Publish item:** Here you can post your contribution.

**Show from:** Here you can activate a post on a specific date.

**Show until:** Here you can deactivate a post on a certain date.


## Content for news posts

After we have made the settings for the post, we can add content elements for the output in the "News reader", click on 
the desired article ![Edit contribution]({{% asset "icons/edit.svg" %}}?classes=icon "Edit contribution") or
![Edit contribution]({{% asset "icons/children.svg" %}}?classes=icon "Edit contribution") and then on 
![Create a new content element]({{% asset "icons/new.svg" %}}?classes=icon "Create a new content element") **New**.

All [content elements](/en/article-management/content-elements/) of Contao are available in the news items.