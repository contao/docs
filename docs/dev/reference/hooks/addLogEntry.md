---
title: "addLogEntry"
description: "addLogEntry hook"
tags: ["hook-backend"]
---

The `addLogEntry` hook is triggered when a new log entry is added. It passes
the message, the function and the action as arguments and does not expect 
a return value.

## Example

```php
// src/App/EventListener/AddLogEntryListener.php
namespace App\EventListener;

class AddLogEntryListener
{
    public function onAddLogEntry(string $message, string $func, string $action): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\AddLogEntryListener:
    public: true
    tags:
      - { name: contao.hook, hook: addLogEntry, method: onAddLogEntry }
```

## References

* [\Contao\CoreBundle\Monolog\ContaoTableHandler#L158-L160](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Monolog/ContaoTableHandler.php#L158-L160)
