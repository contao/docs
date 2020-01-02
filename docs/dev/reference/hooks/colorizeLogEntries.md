---
title: "colorizeLogEntries"
description: "colorizeLogEntries hook"
tags: ["hook-backend"]
aliases:
    - /reference/hooks/colorizeLogEntries/
    - /reference/hooks/colorizelogentries/
---


The `colorizeLogEntries` hook is triggered when a user closes his account. It passes 
the user ID, the operation mode and the module as arguments and does not expect 
a return value.

The operation mode will either be `close_deactivate` or `close_delete`.


## Parameters

1. *string* `$row`

    The data of the log entry record.

2. *string* `$label`

    The label as created by Contao. If not modified by this hook, this
    is what will be displayed.


## Return Values

Return the processed `$label` string.


## Example

```php
// src/EventListener/ColorizeLogEntriesListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class ColorizeLogEntriesListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("colorizeLogEntries")
     */
    public function onColorizeLogEntries(array $row, string $label): string
    {
        // Wrap the label with a span containing a custom CSS class or style attributes
        if (…) {
            $label = preg_replace('@^(.*</span> )(.*)$@U', '$1 <span class="tl_purple">$2</span>', $label);
        }
        
        return $label;
    }
}
```


## References

* [\tl_log#L93-L101](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/dca/tl_log.php#L168-L177)
