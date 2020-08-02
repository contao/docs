---
title: Miscellaneous
description: 'In this section you will be introduced to the other core modules in the "Miscellaneous" section.'
aliases:
    - /en/layout/module-management/miscellaneous/
weight: 50
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

In this section you will be introduced to the other core modules in the "Miscellaneous" section. The list of frontend modules can be extended by (third-party) extensions.

## article list

With the frontend module "article list" you can output a list of all articles of a column.

**Skip elements:** Here you define how many elements are to be skipped.

**Column:** Here you can select the column whose articles you want to list.

**Set a reference page:** Here you can assign an individual source or target page to the module.

**Individual template:** Here you can overwrite the default `mod_articlelist`template.

**HTML outputThe**  
 frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_articlelist block">

<ul>
    <li><a href="…#article-01" title="…">…</a></li>
    <li><a href="…#article-02" title="…">…</a></li>
    <li><a href="…#article-03" title="…">…</a></li>
</ul>

</div>
<!-- indexer::continue -->
```

## Random picture

The frontend module "Random image" adds a random image from a certain selection of images to the website. You can select single images or whole folders as source. Existing meta files are evaluated.

**Source files:** Here you can select multiple files or folders. The images contained in a folder are automatically included in the selection.

**Image size:** Here you can set the dimensions of the image and the scaling mode.

| Relative Format |  |
| --------------- | --- |
| Proportional | The longer side of the picture is adjusted to the given dimensions and the picture is proportionally reduced in size. |
| Fit to frame | The shorter side of the image is adapted to the given dimensions and the image is proportionally reduced in size. |

| Exact format |  |
| ------------ | --- |
| Important part | Preserves the important part of the image as specified in the file manager. |
| Left / Top | Preserves the left part of a landscape image and the upper part of a portrait image. |
| Center / Top | Preserves the central part of a landscape image and the upper part of a portrait image. |
| Right / Top | Get the right part of a landscape image and the upper part of a portrait image. |
| Left / Middle | Preserves the left part of a landscape image and the center part of a portrait image. |
| Center / Center | Get the middle part of a landscape image and the middle part of a portrait image. |
| Right / Middle | Preserves the right part of a landscape image and the center part of a portrait image. |
| Left / Bottom | Preserves the left part of a landscape image and the lower part of a portrait image. |
| Middle / Bottom | Gets the middle part of a landscape image and the lower part of a portrait image. |
| Right / Bottom | Preserves the right part of a landscape image and the lower part of a portrait image. |

**Large View/New Window:** If this option is selected, the image will be opened in its original size when clicked. This option is not available for linked images.

**Show caption:** If you select this option, either the corresponding caption from the metadata is displayed or an automatic caption is generated from the file name.

**Individual template:** Here you can overwrite the standard `mod_randomImage`template.

**HTML OutputThe**  
 frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_randomImage block">

    <figure class="image_container">
        <a href="…" title="…" data-lightbox="8e0a5c">
            <img src="…" alt="" itemprop="image">
        </a>
    </figure>

</div>
<!-- indexer::continue -->
```

## Own HTML code

The frontend module "Custom HTML Code" adds any HTML code to the website.

**HTML code:** Here you can enter the HTML code. Note that you can only use HTML tags that you have enabled in the backend settings under "Allowed HTML tags".

The module has no enclosing HTML markup.

**Individual template**: Here you can overwrite the standard `mod_html`template.

## RSS reader

With the frontend module "RSS Reader" you can subscribe to any RSS feed and insert it into your website, e.g. to integrate the news feed of contao.org.

Open the module administration in the backend and select the module "RSS reader". In the following, the individual input fields will be explained to you.

**feed URLs:** Here you can enter one or more RSS feed URLs.

**Total number of posts:** Here you define how many posts are displayed.

**Elements per page:** If you enter a value greater than 0 here, Contao will automatically spread the posts over multiple pages - assuming you have entered the correct number.

**Skip elements:** Here you can specify that a certain number of posts are skipped as seen from the most recent post of the RSSS feed.

**Cache expiry time**: Here you can define how long an RSS feed is stored in the local cache before a new request is made.

**Feed Template**: Here you select the feed template.

| Template | Declaration |
| -------- | ----------- |
| `rss_default` | Both the header of the RSS feed and the contributions are displayed. |
| `rss_items_only` | Only the contributions of the RSS feed are displayed. |

  
**HTML Output**The front-end module generates the `rss_default`following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_rssReader block">

    <div class="rss_default_header">
        <h1><a href="…" target="_blank" rel="noreferrer noopener">…</a></h1>
        <div class="description">…</div>
    </div>

    <div class="rss_default first even">
        <h2><a href="…" target="_blank" rel="noreferrer noopener">…</a></h2>
        <div class="description"><p>…</p></div>
    </div>
    <div class="rss_default odd">
        <h2><a href="…" target="_blank" rel="noreferrer noopener">…</a></h2>
        <div class="description"><p>…</p></div>
    </div>
    <div class="rss_default last even">
        <h2><a href="…" target="_blank" rel="noreferrer noopener">…</a></h2>
        <div class="description"><p>…</p></div>
     </div>

</div>
<!-- indexer::continue -->
```

The frontend module generates with `rss_items_only`the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_rssReader block">

    <div class="rss_items_only first even">
        <h2><a href="#" target="_blank" rel="noreferrer noopener">#</a></h2>
        <div class="description"><p>…</p></div>
    </div>
    <div class="rss_items_only odd">
        <h2><a href="#" target="_blank" rel="noreferrer noopener">#</a></h2>
        <div class="description"><p>…</p></div>
    </div>
    <div class="rss_items_only last even">
        <h2><a href="#" target="_blank" rel="noreferrer noopener">#</a></h2>
        <div class="description"><p>…</p></div>
    </div>

</div>
<!-- indexer::continue -->
```
