---
title: "getAllEvents"
description: "getAllEvents hook"
tags: ["hook-module", "hook-calendar"]
---

The `getAllEvents` hook allows you to modify the result sets of calendar and 
event modules. It passes the current result set, the IDs of the parent items 
and the start and end time as arguments and expects a result set (array) as 
return value.

## Example

```php
// src/App/EventListener/GetAllEventsListener.php
namespace App\EventListener;

class GetAllEventsListener
{
    public function onGetAllEvents(array $events, array $calendars, int $timeStart, int $timeEnd, \Contao\Module $module): array
    {
        // Add events to $events or modify the array …

        return $events;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GetAllEventsListener:
    public: true
    tags:
      - { name: contao.hook, hook: getAllEvents, method: onGetAllEvents }
```

## References

* [\Contao\Events#L180-L188](https://github.com/contao/contao/blob/4.7.6/calendar-bundle/src/Resources/contao/classes/Events.php#L180-L188)
