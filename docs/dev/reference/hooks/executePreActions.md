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
// src/EventListener/ExecutePreActionsListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class ExecutePreActionsListener
{
    /**
     * @Hook("executePreActions")
     */
    public function onExecutePreActions(string $action): void
    {
        if ('update' === $action) {
            // Do something …
        }
    }
}
```


## References

* [\Contao\Ajax.php#L153-L163](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Ajax.php#L153-L163)
