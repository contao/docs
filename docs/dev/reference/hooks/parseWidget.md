---
title: "parseWidget"
description: "parseWidget hook"
tags: ["hook-widget"]
---


This hook allows you to customize the output of a `\Contao\Widget` when it is
parsed.


## Parameters

1. *string* `$buffer`

    The output buffer for the widget.

2. *\Contao\Widget* `$widget`

    The `\Contao\Widget` instance.


## Return Values

The (modified) output buffer for the widget.


## Example

```php
// src/App/EventListener/ParseWidgetListener.php
namespace App\EventListener;

class ParseWidgetListener
{
    public function onParseWidget(string $buffer, \Contao\Widget $widget): string
    {
        // Do something …
        
        return $buffer;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ParseWidgetListener:
    public: true
    tags:
      - { name: contao.hook, hook: parseWidget, method: onParseWidget }
```


## References

* [\Contao\Widget#L616-L624](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Widget.php#L616-L624)
* https://github.com/contao/core/pull/5553
