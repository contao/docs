---
title: 'Front-end modules'
description: 'The "Calendar" extension contains four new frontend modules which you can configure as usual via the module management.'
aliases:
    - /en/core-extensions/calendar/frontend-modules/
weight: 20
---

Now that you know how to manage calendars and events in the back end, we'll explain how to display this content in the front end. The "Calendar" extension contains four front end modules, which you can configure as usual in module management.

![Calendar modules](/en/core-extensions/calendar/images/en/calendar-module.png?classes=shadow)

## Calendar

The frontend module "Calendar" adds a calendar to the website, in which the events of one or more calendars are displayed.

![The calendar module in the frontend](/de/core-extensions/calendar/images/de/das-kalender-modul-im-frontend.png?classes=shadow)

### Module configuration

**Calendar:** Here you can specify the calendar from which posts should be listed.

**First day of the week:** Here you define the first day of the week.

**Shortened display:** By default, Contao displays events of several days on each day individually. If you select this option, the display is shortened and the event appears only once on the first day.

### Forwarding

**Forwarding page:** Here you define the page which a visitor is forwarded when clicking on a link in the calendar. On the target page the frontend module "Event reader" should be included.

### Template settings

**Calendar-Template:** Here you select the template for the calendar.

The following calendar templates are available by default:

| Template | Explanation |
| -------- | ----------- |
| `cal_default` | This template represents a large calendar in which the individual events are listed and can be clicked on directly. |
| `cal_mini` | This template represents a mini calendar, which in contrast to the large calendar does not contain direct links to individual events, but only links to individual days. The mini-calendar was originally used to navigate the event list; however, this is now done with the more flexible module "Event List Menu". |

**Individual template:** Here you can overwrite the standard template.

**HTML OutputThe**  
 frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_calendar block">
    <table class="calendar">
        <thead>
            <tr>
                <th colspan="2" class="head previous"><a href="…" title="…">&lt; April 2020</a></th>
                <th colspan="3" class="head current">Mai 2020</th>
                <th colspan="2" class="head next"><a href="…" title="…">Juni 2020 &gt;</a></th>
            </tr>
            <tr>
                <th class="label col_first weekend">So<span>nntag</span></th>
                <th class="label">Mo<span>ntag</span></th>
                <th class="label">Di<span>enstag</span></th>
                <th class="label">Mi<span>ttwoch</span></th>
                <th class="label">Do<span>nnerstag</span></th>
                <th class="label">Fr<span>eitag</span></th>
                <th class="label col_last weekend">Sa<span>mstag</span></th>
            </tr>
        </thead>
        <tbody>
            <tr class="week_0 first">
                <td class="days empty weekend col_first"><div class="header">&nbsp;</div></td>
                <td class="days empty"><div class="header">&nbsp;</div></td>
                <td class="days empty"><div class="header">&nbsp;</div></td>
                <td class="days empty"><div class="header">&nbsp;</div></td>
                <td class="days empty"><div class="header">&nbsp;</div></td>
                <td class="days"><div class="header">1</div></td>
                <td class="days weekend col_last"><div class="header">2</div></td>
            </tr>
            <tr class="week_1">
                <td class="days weekend col_first"><div class="header">3</div></td>
                <td class="days"><div class="header">4</div></td>
                <td class="days"><div class="header">5</div></td>
                <td class="days"><div class="header">6</div></td>
                <td class="days"><div class="header">7</div></td>
                <td class="days"><div class="header">8</div></td>
                <td class="days active weekend col_last">
                    <div class="header">9</div>
                    <div class="event cal_3 upcoming" itemscope itemtype="http://schema.org/Event">
                        <a href="…" title="…" itemprop="url"><span itemprop="name">…</span></a>
                    </div>
                </td>
            </tr>
            …
        </tbody>
    </table>
</div>
<!-- indexer::continue -->
```

## Event reader

The front end module "Event reader" is used to display a specific event. The module obtains the alias of the entry via the URL, so that events can be linked with [permalinks](https://wikipedia.org/wiki/Permalink):

`www.domain.en/event/european-design-awards.html`

The keyword of the event reader is *event* and tells the module to search and output a specific event. If the entry searched for does not exist, the event reader returns an error message and the HTTP status code "404 Not found". The status code is important for search engine optimization.

{{% notice info %}}
On a single page there can only be one "reader module" at a time, regardless of the type. Otherwise, one or the other module will trigger a 404 page, because, for example, the alias of a message cannot be found in a calendar, or vice versa the alias of an event in a message archive.
{{% /notice %}}

### Module configuration

**Calendar**: Here you can define in which calendars the requested event should be searched. Events from calendars that are not selected will not be displayed, even if the URL is correct and the entry is entered correctly. This feature is especially important in multi-domain operation with several independent websites.

{{< version "4.7" >}}

**Hide running events:** Here you can hide the running events in the list of future events.

### Template settings

**Event template:** Here you select the event template.

| Template | Declaration |
| -------- | ----------- |
| `event_full` | This template represents the complete event and is therefore recommended for use with the event reader. |
| `event_list` | This template displays the title of an event, the date and time and the event text for the event list. |
| `event_teaser` | This template displays the title of an event, the date and time, the teaser text and a read more link. |
| `event_upcoming` | This template displays the date and the heading of an event. |

**Individual template:** Here you can overwrite the standard template.

### Image settings

**Image size**: Here you can specify the desired image size.

### Comments settings

**Comment template:** Here you can select the comment template.

**HTML output**  
 The front-end module generates the following HTML code:

```html
<div class="mod_eventreader block">
    <div class="event layout_full block upcoming" itemscope itemtype="http://schema.org/Event">
        <h1 itemprop="name">…</h1>
        <p class="info"><time datetime="…" itemprop="startDate"…</time></p>
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

For details on how to mark up the comments, see the Comments section.

## Event list

The frontend module "Event List" is used to list all events of a certain period. In connection with the module "Event list menu" you can search all available events by day, month or year.

### Module configuration

**Calendar:** Here you define from which calendars events should be listed. The events are sorted in ascending order by date.

**Display format:** Here you define the period of time for the display. With the display format you also define the operating mode of the event list.

| Operating mode | Declaration |
| -------------- | ----------- |
| Event list | The event list lists all events of a certain time period, which you can specify with the module "Event list menu". |
| Future events | The event list only lists future events (preview). |
| Past events | The event list only lists past events (review). |

**Shortened display:** By default, Contao displays events of several days on each day individually. If you select this option, the display will be shortened and the event will only appear once on the first day.

**Sort order:** Here you can change the sort order of the events.

**event reader:** Here you can define if the selected event reader module should be displayed automatically instead of the event list module when an event is selected. This makes it possible to have the event list and the event reader on the same page with only one module instead of having a separate page for the event reader.

{{% notice info %}}
Caution**:** In most cases, this functionality should not be used for event lists that are placed in the page layout. Otherwise, you would automatically have an event reader on each page of the page layout at the respective position in the layout. This would prevent the functionality of other "reader modules" on the same page.
{{% /notice %}}

**Number of events:** If you enter a value greater than 0 here, the number of events in the event list is automatically limited to this value.

**Elements per page:** If you enter a value greater than 0, Contao automatically distributes the events to multiple pages - assuming the number is sufficient.

**Ignore URL parameters:** If you select Ignore URL parameters here, the period will not be changed based on thedate/month/year parameters in the URL.

{{< version "4.7" >}}

**Hide running events:** Here you can hide the running events in the list of future events.

### Template settings

**Event template:** Here you select the event template.

| Template | Explanation |
| -------- | ----------- |
| `event_full` | This template represents the complete event and is therefore recommended for use with the event reader. |
| `event_list` | This template displays the title of an event, the date and time and the event text for the event list. |
| `event_teaser` | This template outputs the event title, the date and time, the teaser text and a read more link. |
| `event_upcoming` | This template displays the date and the heading of an event. |

**Individual template:** Here you can overwrite the standard template.

### Image settings

**Image size:** Here you can specify the desired image size.

**HTML OutputThe**  
 frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_eventlist example block">

    <div class="header even first">
        <span class="day">… </span><span class="date">…</span>
    </div>
    <div class="event layout_teaser upcoming even first last cal_3" itemscope itemtype="http://schema.org/Event">
        <h2 itemprop="name"><a href="…" title="…" itemprop="url">…</a></h2>
        <p class="time"><time datetime="…" itemprop="startDate">…</time></p>
        <div class="ce_text block" itemprop="description">
            <p>…</p>    
        </div>
        <p class="more">
            <a href="…" title="…" itemprop="url">Weiterlesen …<span class="invisible"> …</span></a>
        </p>
    </div>

    <div class="header odd last">
        <span class="day">… </span><span class="date">…</span>
    </div>
    <div class="event layout_teaser upcoming even first last cal_3" itemscope itemtype="http://schema.org/Event">
        <h2 itemprop="name"><a href="…" title="…" itemprop="url">…</a></h2>
        <p class="time"><time datetime="…" itemprop="startDate">…</time></p>
        <div class="ce_text block" itemprop="description">
            <p>…</p>
        </div>
        <p class="more">
            <a href="…" title="…" itemprop="url">Weiterlesen …<span class="invisible"> …</span></a>
        </p>
    </div>

</div>
<!-- indexer::continue -->
```

## Eventlist menu {#eventlist-menu}

The frontend module "Event List Menu" adds a menu to the website, with which you can call up the events of the individual days, months or years.

### Module configuration

**Calendar:** Here you define from which calendars events should be linked. This selection should match the selection in the event list.

**Display format**: Here you define the display format (day, month or year).

**Shortened display:** By default, Contao displays events that last several days on each day individually. If you select this option, the display is shortened and the event appears only once on the first day.

**Sort order:** Here you can change the sort order of the menu.

**Show number of events:** If you select this option, the number of events of each month or year will be displayed in the menu.

### Forwarding

**Forwarding page:** Here you define to which page a visitor is forwarded after clicking on a menu item (day, month or year).

### Template settings

**Individual template**: Here you can overwrite the default template.

**HTML OutputThe**  
 frontend module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_eventmenu block">
    <table class="minicalendar">
        <thead>
            <tr>
                <th class="head previous"><a href="…" rel="nofollow" title="April 2020">&lt;</a></th>
                <th colspan="5" class="head current">Mai 2020</th>
                <th class="head next"><a href="…" rel="nofollow" title="Juni 2020">&gt;</a></th>
            </tr>
            <tr>
                <th class="label col_first">Mo<span class="invisible">ntag</span></th>
                <th class="label">Di<span class="invisible">enstag</span></th>
                <th class="label">Mi<span class="invisible">ttwoch</span></th>
                <th class="label">Do<span class="invisible">nnerstag</span></th>
                <th class="label">Fr<span class="invisible">eitag</span></th>
                <th class="label weekend">Sa<span class="invisible">mstag</span></th>
                <th class="label col_last weekend">So<span class="invisible">nntag</span></th>
            </tr>
        </thead>
        <tbody>
            <tr class="week_0 first">
                <td class="days empty col_first">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days empty">&nbsp;</td>
                <td class="days">1</td>
                <td class="days weekend">2</td>
                <td class="days weekend col_last">3</td>
            </tr>
            <tr class="week_1">
                <td class="days col_first">4</td>
                <td class="days">5</td>
                <td class="days">6</td>
                <td class="days">7</td>
                <td class="days">8</td>
                <td class="days active weekend"><a href="…" title="…">9</a></td>
                <td class="days active weekend col_last"><a href="…" title="…">10</a></td>
            </tr>
            …
        </tbody>
    </table>
</div>
<!-- indexer::continue -->
```

In the display format "month" the HTML markup looks like this:

```html
<!-- indexer::stop -->
<div class="mod_eventmenu block">
    <ul class="level_1">
        <li class="year submenu">
            <a href="…">…</a>
            <ul class="level_2">
                <li class="first"><a href="…" title="…">März 2020</a></li>
                <li><a href="…" title="…">April 2020</a></li>
                <li class="last"><a href="…" title="…">Mai 2020</a></li>
            </ul>
        </li>
        …
    </ul>
</div>
<!-- indexer::continue -->
```

In the display format "Year" with Display number of posts, the HTML markup looks like this

```html
<!-- indexer::stop -->
<div class="mod_eventmenu block">
    <ul class="level_1">
        <li class="first"><a href="…" title="…">2020 (2 Einträge)</a></li>
        <li><a href="…" title="…">2021 (5 Einträge)</a></li>
        <li class="last"><a href="…" title="…">2022 (4 Einträge)</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```
