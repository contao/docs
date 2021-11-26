---
title: 'Front end modules'
description: 'The message extension contains four new front end modules, which you can configure as usual via the 
module management'
aliases:
    - /en/core-extensions/news/front-end-modules/
weight: 20
---

Now that you know how archives and posts are managed in the back end, we will explain how to display this content in 
the front end. The message extension contains four new front end modules, which you can configure as usual via the 
module management.

![News/Blog modules](/de/core-extensions/news/images/en/news-blog-modules.png?classes=shadow)


## News list

The front end module "message list" displays any number of posts from one or more message archives in the front end. 
Which parts of a news item are displayed depends on the respective template. Everything is possible from a simple 
headline to a complete post.


### Module configuration

**News archives:** Here you define from which archives posts should be listed. By default, the posts are sorted by date 
in descending order.

**News reader module :** Here you can determine whether the system should automatically switch to the news reader when 
an article is selected.

{{% notice info %}}
**Caution:** in most cases this functionality should not be used for message lists that are placed in the page layout. 
Otherwise, you would automatically have a message reader on each page of the page layout at a different position in the 
layout. This would prevent the functionality of other "reader modules" on the same page.
{{% /notice %}}

**Number of items:** If you enter a value greater than 0 here, the number of messages or blog posts will automatically 
be limited to this value.

**Featured items:** Here you define whether only highlighted, only unhighlighted, highlighted first or all posts of the 
selected archives are displayed.

{{< version "4.5" >}}

**Sort order:** Here you can set the sort order. There are five sort orders available: by date ascending, by date 
descending, by headline ascending, by headline descending and by a random order.

**Skip items:** Here you define the number of items to be skipped.

**Items per page:** If you enter a value greater than 0, Contao automatically distributes the posts to multiple pages - 
assuming you have enough of them.


### Template settings

**Meta fields:** Here you can specify which meta information (date of the post, author of the post and number of 
comments) is displayed.

**News template:** Here you select the template for the posts. The following message templates are available by default:

| Template | Explanation |
| -------- | ----------- |
| `news_full` | This template represents the complete article and is therefore recommended for use with the news reader. |
| `news_latest` | This template displays the meta information of a post, an image (if added), the headline, the teaser text and a read more link. |
| `news_short` | This template outputs the meta information of a post, the headline, the teaser text and a read more link. |
| `news_simple` | This template displays the date and the title of a post. |

**Module template:** Here you can overwrite the standard template.


### Image settings

**Image size:** Here you can specify the desired image size.

**The HTML Output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_newslist block">

    <div class="layout_short arc_1 block first even" itemscope itemtype="http://schema.org/Article">
        <p class="info"><time datetime="…" itemprop="datePublished">…</time> by <span itemprop="author">…</span></p> 
        <h2 itemprop="name"><a href="…" title="Read the article: …" itemprop="url"><span itemprop="headline">…</span></a></h2>
        <div class="ce_text block" itemprop="description">
            <p>…</p> 
        </div>
        <p class="more"><a href="…" title="Read the article: …" itemprop="url"><span itemprop="headline">Read more …</span><span class="invisible"> …</span></a></p>
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

The front end module "news reader" is used to display a specific news item. The module obtains the alias of the article 
via the URL, so that news with so-called permanent links can be specifically linked:

`www.example.com/news/form-follows-function.html`

In this example, the message with the alias "form-follows-function" is called via the "news" page: If the searched 
message does not exist, the message reader returns an error message and the HTTP status code "404 Not Found". The 
status code is important for search engine optimization.

{{% notice info %}}
There can only be one "reader module" on a single page, regardless of type. Otherwise, one or the other module would 
trigger a 404 page, because, for example, the alias of a message cannot be found in a calendar, or vice versa, the 
alias of an event in a message archive.
{{% /notice %}}


### Module configuration

**News archives:** Here you can define in which archives the requested post is to be searched for; posts from archives 
that have not been selected are not displayed, even if the URL is correct and the message exists. This feature is 
especially important in multi-domain operations with several independent websites.


### Template settings

**Meta fields:** Here you can define which meta information (date of the post, author of the post and number of 
comments) is displayed.

**News template:** Here you select the message template. By default, the template `news_full` displays the complete 
article.

**Module template:** Here you can overwrite the standard template.


### Image settings

**Image size:** Here you can specify the desired image size.

**The HTML output**  
The front end module generates the following HTML code:

```html
<div class="mod_newsreader formbottomborder block">
    <div class="layout_full block" itemscope itemtype="http://schema.org/Article">
        <h1 itemprop="name">…</h1>
        <p class="info"><time datetime="…" itemprop="datePublished">…</time> by <span itemprop="author">…</span> </p>
        <h2 itemprop="headline">…</h2>
        <div class="ce_text block">
            <p>…</p>  
        </div>
    </div>

    <!-- indexer::stop -->
    <p class="back"><a href="javascript:history.go(-1)" title="Go back">Go back</a></p>
    <!-- indexer::continue -->

    <div class="ce_comments block">
        … 
    </div>
</div>
```

For details on how to mark up the comments, see the [comments](/en/article-management/content-elements/#comments) section.


## News archive

The front end module "News archive" is used to list all news items of a certain period. In connection with the module 
"News archive menu" you can search through all available articles by day, month or year.


### Module configuration

**News archives:** Here you can specify the archives from which the posts should be listed. By default, the posts are 
sorted by date in descending order.

**News reader module:** Here you can define whether the system should automatically switch to the message reader when a 
post is selected.

**Archive format:** Here you define the archive format (day, month or year).

{{< version "4.5" >}}

**Sort order:** Here you can define the sort order. There are five sort orders available: by date ascending, by date 
descending, by heading ascending, by heading descending and by a random order.

**No period selected:** Here you define what the front end module should display if no specific time period is selected.

| Option | Declaration |
| ------ | ----------- |
| Hide the module | The module is completely hidden if no period is selected. |
| Jump to the current period | If no time period is selected, the posts of the current time period (day, month or year) are displayed automatically. |
| Show all news items | All contributions of the archive are displayed if no period is selected. |

**Items per page:** If you enter a value greater than 0 here, Contao automatically distributes the posts to multiple 
pages - assuming you have entered the correct number.


### Template settings

**Meta fields:** Here you can define which meta information (date of the post, author of the post and number of 
comments) is displayed.

**News template:** Here you select the template.

**Module template:** Here you can overwrite the default template.


### Image settings

**Image size:** Here you can specify the desired image size.

**The HTML output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_newsarchive block">

    <div class="layout_latest arc_1 block first even" itemscope itemtype="http://schema.org/Article">
        <p class="info"><time datetime="…" itemprop="datePublished">…</time> by <span itemprop="author">…</span> </p>
        <h2 itemprop="name"><a href="…" title="Read the article: …" itemprop="url"><span itemprop="headline">…</span></a></h2>
        <div class="ce_text block" itemprop="description">
            <p>…</p>
        </div>
        <p class="more"><a href="…" title="Read the article: …" itemprop="url"><span itemprop="headline">Read more …</span><span class="invisible"> …</span></a></p> 
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


## News archive menu

The front end module "News archive menu" adds a menu to the website, which allows you to view the posts of the 
individual days, months or years.


### Module configuration

**News archives:** Here you define from which archives articles should be linked. This selection should be the same as 
that of the news archive.

**Show number of items:** If you select this option, the number of posts per month or year will be shown in the menu.

**Archive format**: Here you can define the archive format (day, month or year).

**Week start day**: Here you can specify the day of the week.

**Sort order:** Here you can change the sort order of the menu.


### Redirect settings

**Redirect page:** Here you can define to which page a visitor is forwarded after clicking on a menu item 
(day, month or year).


### Template settings

**Module template:** Here you can overwrite the standard template.

**The HTML output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_newsmenu block">
    <ul class="level_1">
        <li class="year submenu"><a href="…">2020</a>
            <ul class="level_2">
                <li class="first"><a href="…" title="…">April 2020</a></li>
                <li><a href="…" title="…">March 2020</a></li>
                <li class="last"><a href="…" title="…">February 2020</a></li>
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
        <li class="first"><a href="…" title="…">2019 (3 entries)</a></li>
        <li><a href="…" title="…">2018 (6 entries)</a></li>
        <li class="last"><a href="…" title="…">2017 (2 entries)</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```

In the "Day" archive format, the HTML markup looks like this:

```html
<!-- indexer::stop -->
<div class="mod_newsmenu block">
    <table class="minicalendar">
        <thead>
            <tr>
                <th class="head previous"><a href="…" title="January 2020">&lt;</a></th>
                <th colspan="5" class="head current">February 2020</th>
                <th class="head next"><a href="…" title="March 2020">&gt;</a></th>
            </tr>
            <tr>
                <th class="label">Mo</th>
                <th class="label">Tu</th>
                <th class="label">We</th>
                <th class="label">Th</th>
                <th class="label">Fr</th>
                <th class="label">Sa</th>
                <th class="label">Su</th>
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
