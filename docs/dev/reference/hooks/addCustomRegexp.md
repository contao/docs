---
title: "addCustomRegexp"
description: "addCustomRegexp hook"
tags: ["hook-custom", "hook-widget"]
---

The `addCustomRegexp` hook is triggered when an unknown regular expression is 
found. It passes the name of the regexp, the current value and the widget 
object as arguments and expects a boolean return value. If you return `true`,
the result of the hook will be final and no other hooks of the same type will
be executed. If you return `false`, other hooks will continue to process the
regular expression.

## Example

```php
// src/App/EventListener/AddCustomRegexpListener.php
namespace App\EventListener;

class AddCustomRegexpListener
{
    public function onAddCustomRegexp(string $regexp, mixed $input, \Contao\Widget $widget): bool
    {
        if ('myregexp' === $regexp) {
            // Do something …

            return true;
        }

        return false;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\AddCustomRegexpListener:
    public: true
    tags:
      - { name: contao.hook, hook: addCustomRegexp, method: onAddCustomRegexp }
```

## References

* [\Contao\Widget#L1078-L1094](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Widget.php#L1078-L1094)
