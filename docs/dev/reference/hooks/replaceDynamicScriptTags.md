---
title: "replaceDynamicScriptTags"
description: "replaceDynamicScriptTags hook"
tags: ["hook-controller"]
---


This hook is executed before Contao replaces the so called "script tags", i.e.

- `[[TL_JQUERY]]`
- `[[TL_MOOTOOLS]]`
- `[[TL_BODY]]`
- `[[TL_CSS]]`
- `[[TL_HEAD]]`

These tags will be replaced according to the global arrays containing all the necessary
JavaScript & CSS files etc. for the current page.

The hook allows you to replace these script tags yourself, or execute other custom
code before the replacement.


## Parameters

1. *string* `$buffer`

    The buffer containing the current page output, with the dynamic script tags 
    still in place.


## Return Values

A string containing the (modified) bufffer content.


## Example

```php
// src/App/EventListener/ReplaceDynamicScriptTagsListener.php
namespace App\EventListener;

class ReplaceDynamicScriptTagsListener
{
    public function onReplaceDynamicScriptTags(string $buffer): string
    {
        // Modify $buffer here …

        return $buffer;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ReplaceDynamicScriptTagsListener:
    public: true
    tags:
      - { name: contao.hook, hook: replaceDynamicScriptTags, method: onReplaceDynamicScriptTags }
```


## References

* [\Contao\Controller#L710-L717](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L710-L717)
