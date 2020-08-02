---
title: 'Front-end modules'
description: 'The message extension contains four new frontend modules, which you can configure as usual via the module management'
aliases:
    - /en/core-extensions/news/frontend-modules/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Now that you know how archives and posts are managed in the backend, we will now explain how to display this content in the frontend. The news extension contains four new frontend modules that you can configure as usual via the module management.

![News/Blog modules](/de/core-extensions/news/images/de/news-blog-module.png?classes=shadow)

## News list

The frontend module "Message List" displays any number of posts from one or more message archives in the frontend. Which parts of a news item are displayed depends on the respective template. Everything is possible from a simple headline to a complete article.

### Module configuration

**News archives:** Here you define from which archives posts should be listed. By default, the posts are sorted by date in descending order.

**News reader:** Here you can determine whether the system should automatically switch to the news reader when a post is selected.

{{% notice info %}}} **Caution:** in most cases, this functionality should not be used for message lists that are placed in the page layout. Otherwise you would automatically have a news reader on each page of the page layout at the respective position in the layout. This would prevent the functionality of other "reader modules" on the same page.
{{% /notice %}}

**Total number of contributions:** If you enter a value greater than 0 here, the number of messages or blog posts is automatically limited to this value.

**Highlighted contributions:** Here you define whether only highlighted, only unhighlighted, highlighted first   
or all contributions of the selected archives are displayed.

{{< version "4.5" >}}

**Sort order:** Here you can define the sort order. There are the following five sort orders available: by date ascending, by date descending (default), by heading ascending, by heading descending and by a random order.

**Skip elements:** Here you define the number of items to skip.

**Elements per page:** If you enter a value greater than 0 here, Contao will automatically spread the posts over multiple pages - assuming there are enough of them.

### Template settings

**Meta-fields:** Here you define which meta information (date of the post, author of the post and number of comments) is displayed.

**Message template:** Here you select the template for the posts. The following message templates are available by default:

| Template | Declaration |
| -------- | ----------- |
| `news_full` | This template represents the complete article and is therefore recommended for use with the news reader. |
| `news_latest` | This template displays the meta-information of a post, a possibly added image, the headline, the teaser text and a read more link. |
| `news_short` | This template outputs the meta information of a post, the headline, the teaser text and a read more link. |
| `news_simple` | This template displays the date and the heading of a contribution. |

**Individual template:** Here you can overwrite the standard template.

### Picture settings

**Image size:** Here you can specify the desired image size.

**HTML output**   
 The frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_newslist block">

    <div class="layout_short arc_1 block first even" itemscope itemtype="http://schema.org/Article">
        <p class="info"><time datetime="…" itemprop="datePublished">…</time> von <span itemprop="author">…</span></p> 
        <h2 itemprop="name"><a href="…" title="Den Artikel lesen: …" itemprop="url"><span itemprop="headline">…</span></a></h2>
        <div class="ce_text block" itemprop="description">
            <p>…</p> 
        </div>
        <p class="more"><a href="…" title="Den Artikel lesen: …" itemprop="url"><span itemprop="headline">Weiterlesen …</span><span class="invisible"> …</span></a></p>
    </div>

    <div class="layout_short arc_1 block odd" itemscope itemtype="http://schema.org/Article">
        …
    </div>

    <div class="layout_short arc_1 block last even" itemscope itemtype="http://schema.org/Article">
        …
    </div>

</div>
<!-- indexer::continue -->
```

## News reader

The front-end module "news reader" is used to display a specific news item. The module obtains the alias of the article via the URL, so that messages with so-called [permalinks](https://de.wikipedia.org/wiki/Permalink) can be linked specifically:

`www.domain.de/nachricht/form-folgt-funktion.html`

In this example, the message with the alias "form-folgt-function" is called via the "message" page. If the searched message does not exist, the message reader returns an error message and the HTTP status code "404 Not found". The status code is important for search engine optimization.

{{% notice info %}}
Only one "reader module" may be located on a single page, regardless of the type. Otherwise one or the other module would trigger a 404 page, because for example the alias of a message cannot be found in a calendar, or vice versa the alias of an event in a message archive.
{{% /notice %}}

### Module configuration

**News archives:** Here you can define in which archives the requested post should be searched. Contributions from archives that are not selected are generally not displayed, even if the URL is correct and the message exists. This feature is especially important in multi-domain operations with several independent websites.

### Template settings

**Meta-fields:** Here you define which meta information (date of the post, author of the post and number of comments) is displayed.

**Message template:** Here you select the message template. By default, the `news_full` template displays the complete article.

**Individual template:** Here you can overwrite the standard template.

### Picture settings

**Image size:** Here you can specify the desired image size.

**HTML output**   
 The frontend module generates the following HTML code:

```html
<div class="mod_newsreader formbottomborder block">
    <div class="layout_full block" itemscope itemtype="http://schema.org/Article">
        <h1 itemprop="name">…</h1>
        <p class="info"><time datetime="…" itemprop="datePublished">…</time> von <span itemprop="author">…</span> </p>
        <h2 itemprop="headline">…</h2>
        <div class="ce_text block">
            <p>…</p>  
        </div>
    </div>

    <!-- indexer::stop -->
    <p class="back"><a href="javascript:history.go(-1)" title="Zurück">Zurück</a></p>
    <!-- indexer::continue -->

    <div class="ce_comments block">
        … 
    </div>
</div>
```

For details on the markup of comments, see the [comments](../../../artikelverwaltung/inhaltselemente/#kommentare) section.

## News archive

The front-end module "News archive" is used to list all news items of a certain period. In connection with the module "News archive menu" you can search through all available posts on a daily, monthly or yearly basis.

### Module configuration

**News archives:** Here you define from which archives posts should be listed. By default, the posts are sorted by date in descending order.

**News reader:** Here you can determine whether the system should automatically switch to the news reader when a post is selected.

**Archive format:** Here you define the archive format (day, month or year).

{{< version "4.5" >}}

**Sort order:** Here you can define the sort order. There are the following five sort orders available: by date ascending, by date descending (default), by heading ascending, by heading descending and by a random order.

**No period selected:** Here you define what the frontend module should display if no specific time period is selected.

| Option | Declaration |
| ------ | ----------- |
| Hide the module | The module is completely hidden if no period is selected. |
| Jump to current period | The posts of the current period (day, month or year) are automatically displayed if no period is selected. |
| Show all posts | All contributions of the archive are displayed if no period is selected. |

**Elements per page:** If you enter a value greater than 0 here, Contao will automatically spread the posts over multiple pages - assuming there are enough of them.

### Template settings

**Meta-fields:** Here you define which meta information (date of the post, author of the post and number of comments) is displayed.

**Message template:** Here you select the template.

**Individual template:** Here you can overwrite the standard template.

### Picture settings

**Image size:** Here you can specify the desired image size.

**HTML output**   
 The frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_newsarchive block">

    <div class="layout_latest arc_1 block first even" itemscope itemtype="http://schema.org/Article">
        <p class="info"><time datetime="…" itemprop="datePublished">…</time> von <span itemprop="author">…</span> </p>
        <h2 itemprop="name"><a href="…" title="Den Artikel lesen: …" itemprop="url"><span itemprop="headline">…</span></a></h2>
        <div class="ce_text block" itemprop="description">
            <p>…</p>
        </div>
        <p class="more"><a href="…" title="Den Artikel lesen: …" itemprop="url"><span itemprop="headline">Weiterlesen …</span><span class="invisible"> …</span></a></p> 
    </div>

    <div class="layout_latest arc_1 block odd" itemscope itemtype="http://schema.org/Article">
        …
    </div>

    <div class="layout_latest arc_1 block last even" itemscope itemtype="http://schema.org/Article">
        …
    </div>

</div>
<!-- indexer::continue -->
```

## Message archive menu {#Message archive-menu}

The frontend module "News Archive Menu" adds a menu to the website, which allows you to view the posts of the individual days, months or years.

### Module configuration

**News archives:** Here you define from which archives articles should be linked. This selection should be the same as for the news archive.

**Show number of posts:** If you select this option, the number of posts per month or year will be displayed in the menu.

**Archive format:** Here you define the archive format (day, month or year).

**First day of the week:** Here you define with which day the week starts.

**Sort order:** Here you can change the sort order of the menu.

### Forwarding

**Forwarding page:** Here you define to which page a visitor is forwarded after clicking on a menu item (day, month or year).

### Template settings

**Individual template:** Here you can overwrite the standard template.

**HTML output**   
 The frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_newsmenu block">
    <ul class="level_1">
        <li class="year submenu"><a href="…">2020</a>
            <ul class="level_2">
                <li class="first"><a href="…" title="…">April 2020</a></li>
                <li><a href="…" title="…">März 2020</a></li>
                <li class="last"><a href="…" title="…">Februar 2020</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- indexer::continue -->
```

In the archive format "Year" with Show number of posts the HTML markup looks like this:

```html
<!-- indexer::stop -->
<div class="mod_newsmenu block">
    <ul class="level_1">
        <li class="first"><a href="…" title="…">2019 (3 Einträge)</a></li>
        <li><a href="…" title="…">2018 (6 Einträge)</a></li>
        <li class="last"><a href="…" title="…">2017 (2 Einträge)</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```

In the archive format "Tag" the HTML markup looks like this:

```html
<!-- indexer::stop -->
<div class="mod_newsmenu block">
    <table class="minicalendar">
        <thead>
            <tr>
                <th class="head previous"><a href="…" title="Januar 2020">&lt;</a></th>
                <th colspan="5" class="head current">Februar 2020</th>
                <th class="head next"><a href="…" title="März 2020">&gt;</a></th>
            </tr>
            <tr>
                <th class="label">Mo</th>
                <th class="label">Di</th>
                <th class="label">Mi</th>
                <th class="label">Do</th>
                <th class="label">Fr</th>
                <th class="label">Sa</th>
                <th class="label">So</th>
            </tr>
        </thead>
        <tbody>
            <tr class="week_0 first">
                <td class="days empty col_first">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days weekend">1</td>
                <td class="days weekend col_last">2</td>
            </tr>
            <tr class="week_1">
                <td class="days active col_first"><a href="…" title="…">3</a></td>
                <td class="days">4</td>
                <td class="days">5</td>
                <td class="days">6</td>
                <td class="days">7</td>
                <td class="days weekend">8</td>
                <td class="days weekend col_last">9</td>
            </tr>
            …
        </tbody>
    </table>
</div>
<!-- indexer::continue -->
```
