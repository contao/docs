---
title: 'FAQ management'
description: 'The FAQ management is a separate module in the backend, which you can find in the group "Contents".'
aliases:
    - /en/core-extensions/faq/faq-management/
weight: 10
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

The FAQ management is a separate module in the backend, which you can find in the group "Contents". There you can create several categories which contain the individual questions. By using several categories, you can group FAQs by topic, language or website (multi-domain operation).

## Categories

Categories are used to group FAQs. Each category can refer to a specific language or topic.

To create a new category click on ![Create a new category](/de/icons/new.svg?classes=icon "Eine neue Kategorie anlegen")**New** .

### Title and forwarding

**Title:** The title of a category is only used in the backend overview.

**Heading:** The heading of a category is displayed in the frontend.

**Forwarding page:** Here you define to which page a visitor is forwarded when clicking on a FAQ. The target page should contain the module "FAQ reader" to display the answer to the question.

### Comments

You already know the Contao comment function from the "News/Blog" extension or the [content element (comments)](../../../artikelverwaltung/inhaltselemente/#kommentare) of the same name. It is also available for FAQs.

**Enable comments:** Here you activate the comment function for the category.

**Notification on:** Here you define whether the system administrator, the author of a question or both are notified when new comments are made.

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

## Questions

This section explains how to create a question. You can ![Move question](/de/icons/drag.svg?classes=icon "Frage verschieben")determine the order of the questions within a category by dragging and dropping them with the corresponding navigation icons.

To create a new question, click ![Create a new question](/de/icons/new.svg?classes=icon "Eine neue Frage erstellen")**New** .

### Title and author

**Question:** Here you can enter the question.

**FAQ alias:** The alias of a question is a unique and meaningful reference that you can use to call it up in your browser.

**Author:** Here you can change the author of the event.

### Answer

**Answer:** Enter the answer to the question here. The input is done like the content element "Text" with the Rich Text Editor.

### Picture settings

**Add an image:** You can add an image to your post if you wish.

**Source file:** Here you select the image to be inserted. If you have not yet transferred the image to the server, you can do so directly in the pop-up window without leaving the input mask.

![Add an image to an FAQ](/de/core-extensions/faq/images/de/einer-faq-ein-bild-hinzufuegen.png?classes=shadow)

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

### Annexes

Attachments are files that are linked to an FAQ. These files are offered for download in the frontend module "FAQ reader".

**Add attachments:** Here you activate the adding of attachments.

**Put it on:** Here you select the files you want to link to the FAQ.

### Expert Settings

**Disable comments:** Here you deactivate the comment function for a question.

### Publication {#publication}

As long as an FAQ is not published, it will not be displayed in the frontend.

**Publish question:** Here you can publish the question.
