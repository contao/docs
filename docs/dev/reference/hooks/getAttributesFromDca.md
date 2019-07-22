---
title: "getAttributesFromDca"
description: "getAttributesFromDca hook"
tags: ["hook-widget", "hook-dca", "hook-config"]
---

The `getAttributesFromDca` hook is triggered when attributes of a widget are 
extracted from a Data Container array. It passes the attributes and the DCA object 
as arguments and expects the (modified) widget attributes as return value.
Note that the DCA object can be optional (`null`).


## Parameters

1. *array* `$attributes`

    An array of attributes.

2. *\Contao\DataContainer* `$dc`

    The DataContainer object. It can be `null` if no object was passed 
    to the `\Contao\Widget::getAttributesFromDca` method.


## Example

```php
// src/App/EventListener/GetAttributesFromDcaListener.php
namespace App\EventListener;

class GetAttributesFromDcaListener
{
    public function onGetAttributesFromDca(array $attributes, \Contao\DataContainer $dc = null): array
    {
        // Modify $attributes here …

        return $attributes;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GetAttributesFromDcaListener:
    public: true
    tags:
      - { name: contao.hook, hook: getAttributesFromDca, method: onGetAttributesFromDca }
```


## References

* [\Contao\Widget#L1407-L1414](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Widget.php#L1407-L1414)
