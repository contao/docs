---
title: "addLogEntry"
description: "addLogEntry hook"
tags: ["hook-backend"]
---

The `addLogEntry` hook is triggered when a new log entry is added. It passes
the message, the function and the action as arguments and does not expect 
a return value.

{{% notice info %}}
Using the `addLogEntry` hook has been deprecated and will no longer work in Contao 5.0.
{{% /notice %}}


## Parameters

1. *string* `$message`

    The log message.

2. *string* `$func`

    The PHP source method. Be aware that this is not necessarily a real function,
    the function accepts any string!

3. *string* `$action`

    The log action. Usually one of the following constants, but can be any string.

    - `TL_ERROR`
    - `TL_ACCESS`
    - `TL_GENERAL`
    - `TL_FILES`
    - `TL_CRON`
    - `TL_FORMS`
    - `TL_CONFIGURATION`
    - `TL_NEWSLETTER`
    - `TL_REPOSITORY`


## Example

```php
// src/EventListener/AddLogEntryListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class AddLogEntryListener
{
    /**
     * @Hook("addLogEntry")
     */
    public function onAddLogEntry(string $message, string $func, string $action): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\CoreBundle\Monolog\ContaoTableHandler#L158-L160](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Monolog/ContaoTableHandler.php#L158-L160)
