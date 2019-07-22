---
title: "executePreActions"
description: "executePreActions hook"
tags: ["hook-dca"]
---

The `executePreActions` hook is triggered on Ajax requests that do not require 
a DCA object. It passes the name of the action as argument and does not expect 
a return value.


## Parameters

1. *string* `$action`

    The name of the action.


## Example

```php
// src/App/EventListener/ExecutePreActionsListener.php
namespace App\EventListener;

class ExecutePreActionsListener
{
    public function onExecutePreActions(string $action): void
    {
        if ('update' === $action) {
            // Do something …
        }
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ExecutePreActionsListener:
    public: true
    tags:
      - { name: contao.hook, hook: executePreActions, method: onExecutePreActions }
```


## References

* [\Contao\Ajax.php#L153-L163](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Ajax.php#L153-L163)
