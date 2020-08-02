---
title: 'Schedule management'
description: 'The event management is a separate module in the backend called "Events", which you can find in the group "Contents".'
aliases:
    - /en/core-extensions/calendar/calendar-management/
weight: 10
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

The event management is a separate module in the backend called "Events", which you can find in the group "Contents". There you can create several calendars, which contain the individual appointments or events. By using multiple calendars, it is possible to categorize the entries.

## Calendar

Archives are used to group and/or categorize calendars. Each archive can refer to a specific language or topic.

To create a new calendar click on ![Create a new calendar](/de/icons/new.svg?classes=icon "Einen neuen Kalender erstellen")**New** .

### Title and forwarding

**Title:** The title of a calendar is used in the backend overview.

**Forwarding page:** Here you define to which page a visitor is forwarded when clicking on an event. This target page should contain the module "Eventleser" to display the complete article.

### Access protection

Just like content elements, calendars can also be protected. The events of the calendar are then only displayed to registered members.

**Protect archive:** Here you activate the access protection.

**Allowed member groups:** Here you define which member groups should have access to the calendar after logging in to the frontend.

### Comments

You already know the Contao comment function from the "News/Blog" extension or the [content element (comments)](../../../artikelverwaltung/inhaltselemente/#kommentare) of the same name. It is also available for calendars and events.

**Enable comments:** Here you activate the comment function for the calendar.

**Notification on:** Here you define whether the system administrator, the author of a post or both are notified when new comments are added.

**Sorting:** Here you define the order of the comments.

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
| `[quota][/quote]` | Insert quote |
| `[quote=time][/quote]` | Insert quote with mention of the author |
| `[url][/url]` | Insert link |
| `[url=http://example.com][/url]` | Insert link with link title |
| `[email] [email]` | Insert e-mail address |
| `[email=info@example.com][/email]` | Insert e-mail address with title |

**Login required for commenting:** If you select this option, only logged in members can add comments. However, comments already submitted will still be visible to all visitors of the website.

**Disable spam protection:** By default, visitors are required to answer a security question when posting comments, to prevent the commenting feature from being misused for spam purposes. If you want to allow only logged in members to comment anyway, you can disable the security question here. Since Contao 4.4 this question is only "displayed" to spambots.

## RSS feeds

Each calendar can be exported as RSS feed if desired. RSS feeds are XML files containing your contributions, which can be subscribed to with an RSS reader and integrated into another website, for example.

The feeds can be integrated via the [page layout](../../../theme-manager/seitenlayouts-verwalten/#rss-atom-feeds) in the header area of the page. The "header" is not the header of your page layout, but the `<head> tag` of the HTML source code.

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
        <link>https://www.domain.de/</link>
        <language>Feed-Sprache</language>
        <pubDate>…</pubDate>
        <generator>Contao Open Source CMS</generator>
        <atom:link href="https://www.domain.de/share/feed-alias.xml" rel="self" type="application/rss+xml" />
        <item>
            <title>Titel der Nachricht</title>
            <description><![CDATA[<p>Beschreibung der Nachricht.</p>]]></description>
            <link>https://www.domain.de/veranstaltung/alias-der-nachricht.html</link>
            <pubDate>…</pubDate>
            <guid>https://www.domain.de/veranstaltung/alias-der-nachricht.html</guid>
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

### Calendar

**Calendars:** Here you define which calendars are included in the feed.

### Feed settings

**Feed format:** Here you define the format of the feed. Contao supports RSS 2.0 and Atom, the two most common formats.

**Export settings:** Here you can define whether only the teaser texts of the posts or the complete posts are exported as feed.

**Maximum number of contributions:** Here you can limit the number of posts of the feed. Usually about 25 posts per feed are sufficient. Most of the time only the first three to five are actually used anyway.

**Base URL:** The base URL is especially important in multi-domain environments when you run multiple websites with one Contao installation. To make sure that the feed links to the correct domain, you can enter it here.

**Feed description:** Here you can enter a description of the feed.

## Events

This section explains how to create an event. Events are always sorted by date, so there are no icons to change the order.

The events consist of the event settings ("Event list") and their contents ("Event reader").

To create a new event, click on the desired archive and then click on ![Create a new event](/de/icons/new.svg?classes=icon "Ein neues Event erstellen")**New** .

### Title and author

**Titles:** Here you can enter the title of the event.

**Event Alias:** The alias of an event is a unique and meaningful reference that you can use to call it up in your browser.

**Author:** Here you can change the author of the event.

### Date and time

**Add time:** If you select this option, you can add a time to the event. Otherwise, Contao assumes that the event will last a whole day.

**Start time:** Here you enter the start time of the event.

**End time:** Here you enter the end time of the event. To create an event with an open end, do not fill out this field.

**Start date:** Here you enter the start date of the event.

**End date:** Here you enter the end date of the event. If you do not fill in this field, Contao automatically assumes that the event will last one day.

### Metadata

{{< version "4.7" >}}

**Meta-title:** Here you can enter an individual meta-title to overwrite the default page title.

**Meta description:** Here you can enter an individual meta description to override the default page description.

### Subheading and teaser {#subheading-and-teaser}

**Venue:** Here you can enter a venue for your event.

**Address:** Here you can enter the address of the venue.

**Teaser text:** Here you can enter a short summary of the event, which is displayed e.g. with the module "Event list", followed by a link to read more.

### Picture settings

**Add an image:** You can add an image to your post if you wish.

**Source file:** Here you select the image to be inserted. If you have not yet transferred the image to the server, you can do so directly in the pop-up window without leaving the input mask.

![Add an image to a post](/de/core-extensions/calendar/images/de/einem-beitrag-ein-bild-hinzufuegen.png?classes=shadow)

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

**Image Alignment:** Here you set the alignment of the image. If it is ![right-justified](/de/icons/right.svg?classes=icon)inserted **above**, **below**, **left-aligned** or ![right-justified](/de/icons/right.svg?classes=icon)**right-aligned**. If **left-** or **right-aligned**, the text flows around the image (as symbolized by the icon).

**Image distance:** Here you define the distance between the image and the text. The order of the input fields is clockwise "top, right, bottom, left".

**Large View/New Window:** If this option is selected, the image will be opened in its original size when clicked. This option is not available for linked images.

**Overwrite metadata:**  Here you can overwrite the metadata from the file manager.

**Alternative text:** Here you can enter an alternative text for the image *(alt attribute)*. A barrier-free website should contain a short description for each object, which is displayed if the object itself cannot be displayed. Alternative texts are also evaluated by search engines and are therefore an important tool for onpage optimization.

**Picture title:** Here you can enter the title of the image *(title attribute)* .

**Image link address:** When you click on a linked image, you will be redirected to the specified target page (corresponds to an image link). Please note that for a linked image a lightbox large view is no longer possible.

**Caption:** Here you can enter a caption.

### Repetitions

If necessary, you can repeat an event at certain intervals. Possible entries include every four days, every two weeks, every five months, or every year.

**Repeat event:** Here you activate the repeat function.

**Interval:** Here you define the intervals at which the event is repeated.

**Repetitions:** If you enter a value greater than 0 here, the date is no longer displayed after the specified number of repetitions.

### Annexes

Enclosures, also called "enclosures" in the context of RSS feeds, are files that are associated with an event. These files are both exported in the RSS feed and offered for download on the website.

**Add attachments:** Here you activate the adding of attachments.

**Put it on:** Here you select the files you want to link to the event.

### Forwarding destination

The redirection destination determines to which page a visitor is redirected when clicking on an event. Normally this is the page on which the front-end module "Eventleser" is integrated to display the complete event.

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

### Expert settings

**CSS class:** Here you can add a CSS class to the event.

**Disable comments:** Here you deactivate the comment function for an event.

### Publication {#publication}

As long as an event is not published, it is not displayed in the frontend. You already know this behaviour from pages and articles. In addition to the manual publication you have the possibility to activate events automatically on a certain date.

**Publish event:** Here you can publish the event.

**Displays off:** Here you activate the event on a specific date.

**Display until:** Here you deactivate the event on a specific date.

## Content for events {#content-for-events}

After we have made the settings for the event, we can add content elements for the output in the "event reader", click on the desired event and then on ![Create a new content element](/de/icons/new.svg?classes=icon "Ein neues Inhaltselement erstellen")**New** .

In the events, all [content elements](../../../artikelverwaltung/inhaltselemente/) of Contao are available to you.
