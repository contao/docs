---
title: 'Front end modules'
description: 'The "Calendar" extension contains four new frontend modules which you can configure as usual via the module management.'
aliases:
    - /en/core-extensions/calendar/frontend-modules/
weight: 20
---

Now that you know how to manage calendars and events in the back end, we'll explain how to display this content in the 
front end. The "Calendar" extension contains four front end modules, which you can configure as usual in module 
management.

![Calendar modules]({{% asset "images/manual/core-extensions/calendar/de/kalender-module.png" %}}?classes=shadow)

## Calendar

The front end module "Calendar" adds a calendar to the website, in which the events of one or more calendars are 
displayed.

**Default calendar module `cal_default`**

![The default calendar module in the frontend]({{% asset "images/manual/core-extensions/calendar/en/the-default-calendar-module-in-the-frontend.png" %}}?classes=shadow)

**Mini calendar module `cal_mini`**

![The mini calendar module in the frontend]({{% asset "images/manual/core-extensions/calendar/en/the-mini-calendar-module-in-the-frontend.png" %}}?classes=shadow)


### Module configuration

**Calendar:** Here you can specify the calendar from which posts should be listed.

**Shortened view:** By default, Contao shows events of several days on each day individually. If you select this 
option, the view is shortened and the event appears only once on the first day.

**Week start day:** Here you define the first day of the week.

**Featured events:** Here you can define how featured events are handled. The following options are available: 
"Show all events", "Show featured events only" and "Skip featured events".


### Redirect settings

**FRedirect page:** Here you define the page which a visitor is forwarded when clicking on a link in the calendar. On 
the target page the front end module "Event reader" should be included.


### Template settings

**Calendar template:** Here you select the template for the calendar.

The following calendar templates are available by default:

| Template      | Explanation                                                                                                                                                                                                                                                                                                           |
|---------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `cal_default` | This template represents a large calendar in which the individual events are listed and can be clicked on directly.                                                                                                                                                                                                   |
| `cal_mini`    | This template represents a mini calendar, which in contrast to the large calendar does not contain direct links to individual events, but only links to individual days. The mini-calendar was originally used to navigate the event list; however, this is now done with the more flexible module "Event List Menu". |

**Module template:** Here you can overwrite the module template.


## Event reader

The front end module "Event reader" is used to display a specific event. The module obtains the alias of the entry via 
the URL, so that events can be linked with [permalinks](https://wikipedia.org/wiki/Permalink):

`www.example.com/event/european-design-awards.html`

The keyword of the event reader is *event* and tells the module to search and output a specific event. If the entry 
searched for does not exist, the event reader returns an error message and the HTTP status code "404 Not found". The 
status code is important for search engine optimization.

{{% notice info %}}
On a single page there can only be one "reader module" at a time, regardless of the type. Otherwise, one or the other 
module will trigger a 404 page, because, for example, the alias of a message cannot be found in a calendar, or vice 
versa the alias of an event in a message archive.
{{% /notice %}}

### Module configuration

**Calendar**: Here you can define in which calendars the requested event should be searched. Events from calendars that 
are not selected will not be displayed, even if the URL is correct and the entry is entered correctly. This feature is 
especially important in multi-domain operation with several independent websites.

**Hide running events:** Here you can hide the running events in the list of future events.

{{< version-tag "5.3" >}} **Use the current URL for canonical links:**  Here you can set that the current URL is used instead of the configured 
reading page for canonical links.


### Overview page

**Overview page:** Here you can select a page to set a link in the detail view back to the
overview page.

**Custom label:** Here you can change the name of the link to the overview page change.


### Template settings

**Event template:** Here you select the event template.

| Template          | Declaration                                                                                                       |
|-------------------|-------------------------------------------------------------------------------------------------------------------|
| `event_full`      | This template represents the complete event and is therefore recommended for use with the event reader.           |
| `event_list`      | This template displays the title of an event, the date and time and the event text for the event list.            |
| `event_teaser`    | This template displays the title of an event, the date and time, the teaser text and a read more link.            |
| `event_upcoming`  | This template displays the date and the heading of an event.                                                      |

**Module template:** Here you can overwrite the module template.


### Image settings

**Image size**: Here you can specify the desired image size.

| Custom dimensions               |                                                                                                                     |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| Crop&nbsp;(important&nbsp;part) | Preserves the important part of an image as specified in the file manager. If necessary, the image will be cropped. |
| Proportional                    | The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.           |
| Fit&nbsp;the&nbsp;box           | The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.          |


### Comments settings

**Comment template:** Here you can select the comment template.

For details on how to mark up the comments, see the [comments](/en/article-management/content-elements/include-elements/#comments) section.


## Event list

The front end module "Event List" is used to list all events of a certain period. In connection with the module "Event list menu" you can search all available events by day, month or year.

### Module configuration

**Calendar:** Here you define from which calendars events should be listed. The events are sorted in ascending order by date.

**Shortened view:** By default, Contao shows events of several days on each day individually. If you select this option, 
the view will be shortened and the event will only appear once on the first day.

**Event list format:** Here you define the period of time for the display. With the display format you also define the 
operating mode of the event list.

| Operating mode | Declaration                                                                                                          |
|----------------|----------------------------------------------------------------------------------------------------------------------|
| Event list     | The event list lists all events of a certain time period, which you can specify with the module "Event list menu".   |
| Future events  | The event list only lists future events (preview).                                                                   |
| Past events    | The event list only lists past events (review).                                                                      |

**Featured events:** Here you can define how featured events are handled. The following options are available:
"Show all events", "Show featured events only" and "Skip featured events".

**Sort order:** Here you can change the sort order of the events.

**Event reader module:** Here you can define if the selected event reader module should be displayed automatically 
instead of the event list module when an event is selected. This makes it possible to have the event list and the event 
reader on the same page with only one module instead of having a separate page for the event reader.

{{% notice info %}}
**Caution**:** In most cases, this functionality should not be used for event lists that are placed in the page layout. 
Otherwise, you would automatically have an event reader on each page of the page layout at the respective position in 
the layout. This would prevent the functionality of other "reader modules" on the same page.
{{% /notice %}}

**Number of events:** If you enter a value greater than 0 here, the number of events in the event list is automatically 
limited to this value.

**Items per page:** If you enter a value greater than 0, Contao automatically distributes the events to multiple pages - 
assuming the number is sufficient.

**Ignore URL parameters:** If you select Ignore URL parameters here, the period will not be changed based on the 
date/month/year parameters in the URL.

**Hide running events:** Here you can hide the running events in the list of future events.


### Template settings

**Event template:** Here you select the event template.

| Template          | Explanation                                                                                               |
|-------------------|-----------------------------------------------------------------------------------------------------------|
| `event_full`      | This template represents the complete event and is therefore recommended for use with the event reader.   |
| `event_list`      | This template displays the title of an event, the date and time and the event text for the event list.    |
| `event_teaser`    | This template outputs the event title, the date and time, the teaser text and a read more link.           |
| `event_upcoming`  | This template displays the date and the heading of an event.                                              |

**Module template:** Here you can overwrite the module template.

### Image settings

**Image size:** Here you can specify the desired image size.

| Custom dimensions               |                                                                                                                     |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------|
| Crop&nbsp;(important&nbsp;part) | Preserves the important part of an image as specified in the file manager. If necessary, the image will be cropped. |
| Proportional                    | The longer side of the image is adjusted to the given dimensions and the image is resized proportionally.           |
| Fit&nbsp;the&nbsp;box           | The shorter side of the image is adjusted to the given dimensions and the image is resized proportionally.          |


## Eventlist menu

The front end module "Event List Menu" adds a menu to the website, with which you can call up the events of the 
individual days, months or years.


### Module configuration

**Calendar:** Here you define from which calendars events should be linked. This selection should match the selection 
in the event list.

**Shortened view:** By default, Contao shows events of several days on each day individually. If you select this option,
the view will be shortened and the event will only appear once on the first day.

**Event list format**: Here you define the display format (day, month or year).

**Featured events:** Here you can define how featured events are handled. The following options are available:
"Show all events", "Show featured events only" and "Skip featured events".

**Sort order:** Here you can change the sort order of the menu.

**Show number of events:** If you select this option, the number of events of each month or year will be displayed in 
the menu.


### Redirect settings

**Redirect page:** Here you define to which page a visitor is forwarded after clicking on a menu item (day, month or 
year).


### Template settings

**Module template**: Here you can overwrite the module template.

**HTML Output**  
The front end module generates the following HTML code:

```html
<!-- indexer::stop -->
<div class="mod_eventmenu block">
    <table class="minicalendar">
        <thead>
            <tr>
                <th class="head previous"><a href="…" title="January 2020">&lt;</a></th>
                <th class="head current" colspan="5" >February 2020</th>
                <th class="head next"><a href="…" title="March 2020">&gt;</a></th>
            </tr>
            <tr>
                <th class="label weekend">Sun<span class="invisible">day</span></th>
                <th class="label">Mon<span class="invisible">day</span></th>
                <th class="label">Tue<span class="invisible">sday</span></th>
                <th class="label">Wed<span class="invisible">nesday</span></th>
                <th class="label">Thu<span class="invisible">rsday</span></th>
                <th class="label">Fri<span class="invisible">day</span></th>
                <th class="label weekend">Sat<span class="invisible">urday</span></th>
            </tr>
        </thead>
        <tbody>
            <tr class="week_0">
                <td class="days weekend empty">&nbsp;</td>
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
                <td class="days weekend"><a href="…" title="…">8</a></td>
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
                <li><a href="…" title="…">March 2020</a></li>
                <li><a href="…" title="…">April 2020</a></li>
                <li><a href="…" title="…">May 2020</a></li>
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
        <li><a href="…" title="…">2020 (2 entries)</a></li>
        <li><a href="…" title="…">2021 (5 entries)</a></li>
        <li><a href="…" title="…">2022 (4 entries)</a></li>
    </ul>
</div>
<!-- indexer::continue -->
```
