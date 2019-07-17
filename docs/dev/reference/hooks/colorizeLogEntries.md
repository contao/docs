---
title: "colorizeLogEntries"
description: "colorizeLogEntries hook"
tags: ["hook-backend"]
---

The `colorizeLogEntries` hook is triggered when a user closes his account. It passes 
the user ID, the operation mode and the module as arguments and does not expect 
a return value.

The operation mode will either be `close_deactivate` or `close_delete`.

## Example

```php
// src/App/EventListener/ColorizeLogEntriesListener.php
namespace App\EventListener;

class ColorizeLogEntriesListener
{
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

```yml
# config/services.yml
services:
  App\EventListener\ColorizeLogEntriesListener:
    public: true
    tags:
      - { name: contao.hook, hook: colorizeLogEntries, method: onColorizeLogEntries }
```

## References

* [\Contao\tl_log#L93-L101](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/dca/tl_log.php#L168-L177)
