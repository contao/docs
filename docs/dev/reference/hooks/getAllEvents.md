---
title: "getAllEvents"
description: "getAllEvents hook"
tags: ["hook-module", "hook-calendar"]
---


The `getAllEvents` hook allows you to modify the result sets of calendar and 
event modules. It passes the current result set, the IDs of the parent items 
and the start and end time as arguments and expects a result set (array) as 
return value.


## Parameters

1. *array* `$events`

    Associative array of all events (grouped by date).

2. *array* `$calendars`

    The IDs of calendars enabled in the front end module.

3. *int* `$timeStart`

    The calendar period start date (e.g. if the user selected "current month",
    it will contain the timestamp of 00:00:00 of the first day of the month).

4. *int* `$timeEnd`

    The calendar period end date (e.g. if the user selected "current month",
    it will contain the timestamp of 23:59:59 of the last day of the month).

5. *\Contao\Module* `$module`

    The front end module instance executing this hook.


## Return Values

An array containing all the events, grouped by a time stamp.


## Example

```php
// src/EventListener/GetAllEventsListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Module;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class GetAllEventsListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("getAllEvents")
     */
    public function onGetAllEvents(array $events, array $calendars, int $timeStart, int $timeEnd, Module $module): array
    {
        // Add events to $events or modify the array …

        return $events;
    }
}
```


## References

* [\Contao\Events#L180-L188](https://github.com/contao/contao/blob/4.7.6/calendar-bundle/src/Resources/contao/classes/Events.php#L180-L188)
