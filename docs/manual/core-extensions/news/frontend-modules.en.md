---
title: 'Front end modules'
description: 'The news extension contains four new front end modules, which you can configure as usual via the 
module management'
aliases:
    - /en/core-extensions/news/front-end-modules/
weight: 20
---

Now that you know how archives and posts are managed in the back end, we will explain how to display this content in 
the front end. The news extension contains four new front end modules, which you can configure as usual via the 
module management.

![News/Blog modules]({{% asset "images/manual/core-extensions/news/en/news-blog-modules.png" %}}?classes=shadow)


## Newslist

The front end module "Newslist" displays any number of posts from one or more news archives in the front end. 
Which parts of a news item are displayed depends on the respective template. Everything is possible from a simple 
headline to a complete post.


### Module configuration

**News archives:** Here you define from which archives posts should be listed. By default, the posts are sorted by date 
in descending order.

**News reader module:** Here you can determine whether the system should automatically switch to the news reader when 
an article is selected.

{{% notice info %}}
**Caution:** in most cases this functionality should not be used for news lists that are placed in the page layout. 
Otherwise you would automatically have a news reader on each page of the page layout at a different position in the 
layout. This would prevent the functionality of other "reader modules" on the same page.
{{% /notice %}}

**Number of items:** If you enter a value greater than 0 here, the number of news or blog posts will automatically 
be limited to this value.

**Featured items:** Here you can define how featured posts are handled. The following options are available: 
"Show all news items", "Show featured news items only", "Skip featured news items" and "Show featured news items first".

**Sort order:** Here you can set the sort order. There are five sort orders available: "Date ascending", "Date 
descending", "Headline ascending", "Headline descending" and "Random order".

**Skip items:** Here you define the number of items to be skipped.

**Items per page:** If you enter a value greater than 0, Contao automatically distributes the posts to multiple pages - 
assuming you have enough of them.


### Template settings

{{< version-tag "Contao 5 no longer available" >}}**Meta fields:** Here you can specify which meta information 
(date of the post, author of the post and number of comments) is displayed.

**News template:** Here you select the template for the posts. The following news templates are available by default:

| Template       | Explanation                                                                                                                      |
|----------------|----------------------------------------------------------------------------------------------------------------------------------|
| `news_full`    | This template represents the complete article and is therefore recommended for use with the news reader.                         |
| `news_latest`  | This template displays the meta information of a post, an image (if added), the headline, the teaser text and a read more link.  |
| `news_short`   | This template outputs the meta information of a post, the headline, the teaser text and a read more link.                        |
| `news_simple`  | This template displays the date and the title of a post.                                                                         |

**Module template:** Here you can overwrite the module template.


### Image settings

**Image size:** Here you can specify the desired image size.

| Custom dimensions               |                                                                                                                     |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| Crop&nbsp;(important&nbsp;part) | Preserves the important part of an image as specified in the file manager. If necessary, the image will be cropped. |
| Proportional                    | The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.           |
| Fit&nbsp;the&nbsp;box           | The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.          |


## Newsreader

The front end module "news reader" is used to display a specific news item. The module obtains the alias of the article 
via the URL, so that news with so-called permanent links can be specifically linked:

`www.example.com/news/form-follows-function.html`

In this example, the news with the alias "form-follows-function" is called via the "news" page: If the searched 
news does not exist, the news reader returns an error message and the HTTP status code "404 Not Found". The 
status code is important for search engine optimization.

{{% notice info %}}
There can only be one "reader module" on a single page, regardless of type. Otherwise, one or the other module would 
trigger a 404 page, because, for example, the alias of a news cannot be found in a calendar, or vice versa, the 
alias of an event in a news archive.
{{% /notice %}}


### Module configuration

**News archives:** Here you can define in which archives the requested post is to be searched for; posts from archives 
that have not been selected are not displayed, even if the URL is correct and the news exists. This feature is 
especially important in multi-domain operations with several independent websites.

**Use the current URL for canonical links:** Keep the current URL instead of the configured reader page for canonical 
links.


### Overview page

**Overview page:** Here you can select a page to set a link in the detail view back to the overview page.

**Custom label:** Here you can change the name of the link to the overview page change.


### Template settings

{{< version-tag "Contao 5 no longer available" >}}**Meta fields:** Here you can specify which meta information
(date of the post, author of the post and number of comments) is displayed.

**News template:** Here you select the news template. By default, the template `news_full` displays the complete 
article.

**Module template:** Here you can overwrite the module template.


### Image settings

**Image size:** Here you can specify the desired image size.

| Custom dimensions               |                                                                                                                     |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| Crop&nbsp;(important&nbsp;part) | Preserves the important part of an image as specified in the file manager. If necessary, the image will be cropped. |
| Proportional                    | The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.           |
| Fit&nbsp;the&nbsp;box           | The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.          |

For details on how to mark up the comments, see the 
[comments](/en/article-management/content-elements/include-elements/#comments) section.


## News archive

The front end module "News archive" is used to list all news items of a certain period. In connection with the module 
"News archive menu" you can search through all available articles by day, month or year.


### Module configuration

**News archives:** Here you can specify the archives from which the posts should be listed. By default, the posts are 
sorted by date in descending order.

**News reader module:** Here you can define whether the system should automatically switch to the news reader when a 
post is selected.

**Archive format:** Here you define the archive format (day, month or year).

**Sort order:** Here you can set the sort order. There are five sort orders available: "Date ascending", "Date
descending", "Headline ascending", "Headline descending" and "Random order".

**No period selected:** Here you define what the front end module should display if no specific time period is selected.

| Option                                           | Declaration                                                                                                             |
|--------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------|
| Hide the module                                  | The module is completely hidden if no period is selected.                                                               |
| Jump&nbsp;to&nbsp;the&nbsp;current&nbsp;period   | If no time period is selected, the posts of the current time period (day, month or year) are displayed automatically.   |
| Show all news items                              | All contributions of the archive are displayed if no period is selected.                                                |

**Items per page:** If you enter a value greater than 0 here, Contao automatically distributes the posts to multiple 
pages - assuming you have entered the correct number.


### Template settings

{{< version-tag "Contao 5 no longer available" >}}**Meta fields:** Here you can specify which meta information
(date of the post, author of the post and number of comments) is displayed.

**News template:** Here you select the template.

**Module template:** Here you can overwrite the module template.


### Image settings

**Image size:** Here you can specify the desired image size.

| Custom dimensions               |                                                                                                                     |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| Crop&nbsp;(important&nbsp;part) | Preserves the important part of an image as specified in the file manager. If necessary, the image will be cropped. |
| Proportional                    | The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.           |
| Fit&nbsp;the&nbsp;box           | The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.          |


## News archive menu

The front end module "News archive menu" adds a menu to the website, which allows you to view the posts of the 
individual days, months or years.


### Module configuration

**News archives:** Here you define from which archives articles should be linked. This selection should be the same as 
that of the news archive.

**Show number of items:** If you select this option, the number of posts per month or year will be shown in the menu.

**Archive format**: Here you can define the archive format (day, month or year).

**Week start day**: Here you can specify the day of the week.

**Sort order:** Here you can set the sort order. There are five sort orders available: "Date ascending", "Date
descending", "Headline ascending", "Headline descending" and "Random order".


### Redirect settings

**Redirect page:** Here you can define to which page a visitor is forwarded after clicking on a menu item 
(day, month or year).


### Template settings

**Module template:** Here you can overwrite the module template.

**The HTML output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_newsmenu block">
    <ul class="level_1">
        <li class="year submenu"><a href="…">2020</a>
            <ul class="level_2">
                <li><a href="…" title="…">April 2020</a></li>
                <li><a href="…" title="…">March 2020</a></li>
                <li><a href="…" title="…">February 2020</a></li>
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
        <li><a href="…" title="…">2019 (3 entries)</a></li>
        <li><a href="…" title="…">2018 (6 entries)</a></li>
        <li><a href="…" title="…">2017 (2 entries)</a></li>
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
                <th class="head current" colspan="5">February 2020</th>
                <th class="head next"><a href="…" title="March 2020">&gt;</a></th>
            </tr>
            <tr>
                <th class="label">Su</th>
                <th class="label">Mo</th>
                <th class="label">Tu</th>
                <th class="label">We</th>
                <th class="label">Th</th>
                <th class="label">Fr</th>
                <th class="label">Sa</th>
            </tr>
        </thead>
        <tbody>
            <tr class="week_0">
                <td class="days weekend">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days weekend">1</td>
            </tr>
            <tr class="week_1">
                <td class="days weekend active"><a href="…" title="…">2</a></td>
                <td class="days">3</td>
                <td class="days">4</td>
                <td class="days">5</td>
                <td class="days">6</td>
                <td class="days">7</td>
                <td class="days weekend">8</td>
            </tr>
            …
        </tbody>
    </table>
</div>
<!-- indexer::continue -->
```
