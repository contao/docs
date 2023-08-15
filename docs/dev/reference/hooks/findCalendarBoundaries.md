---
title: "findCalendarBoundaries"
description: "findCalendarBoundaries hook"
tags: ["hook-module", "hook-calendar"]
aliases:
    - /reference/hooks/findCalendarBoundaries/
---


The `findCalendarBoundaries` hook allows you to modify the boundary that the calendar module allows you to display. The calendar module
always displays a certain month and generates links to the previous and next month, if there are events in that month. However, if you are
dynamically adding events via the [`getAllEvents`][getAllEventsHook] you might want to override this boundary manually via this hook, so
that the calendar module still displays pagination links to the desired months.


## Parameters

1. *int* `$dateFrom`

    UNIX timestamp of the lower boundary.

2. *int* `$dateTo`

    UNIX timestamp of the upper boundary.

3. *int* `$repeatUntil`

    The maximum `repeatEnd` value in `tl_calendar_events` for the selected archives.

5. *\Contao\Module* `$module`

    The front end module instance executing this hook.


## Example

```php
// src/EventListener/FindCalendarBoundariesListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Module;

#[AsHook('findCalendarBoundaries')]
class FindCalendarBoundariesListener
{
    public function __invoke(int &$dateFrom, int &$dateTo, int &$repeatUntil, Module $module): array
    {
        // Modify $dateForm, $dateTo or $repeatUntil here
    }
}
```


## References

* [\Contao\ModuleCalendar#L131](https://github.com/contao/contao/blob/bebedc1f2597c6df2f5be1901346ed50ae4596d9/calendar-bundle/src/Resources/contao/modules/ModuleCalendar.php#L131)


[getAllEventsHook]: /reference/hooks/getAllEvents
