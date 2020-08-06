---
title: "getAttributesFromDca"
description: "getAttributesFromDca hook"
tags: ["hook-widget", "hook-dca", "hook-config"]
aliases:
    - /reference/hooks/getAttributesFromDca/
    - /reference/hooks/getattributesfromdca/
---


The `getAttributesFromDca` hook is triggered when attributes of a widget are 
extracted from a Data Container array. It passes the attributes and the DCA object 
as arguments and expects the (modified) widget attributes as return value.
Note that the DCA object can be optional (`null`).


## Parameters

1. *array* `$attributes`

    An array of attributes.

2. `$context`

    A `\Contao\DataContainer` or `\Contao\Module` object. It can be `null` if no object was passed 
    to the `\Contao\Widget::getAttributesFromDca` method.


## Return Values

Return the attributes for the widget as an associative array.


## Example

```php
// src/EventListener/GetAttributesFromDcaListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("getAttributesFromDca")
 */
class GetAttributesFromDcaListener
{
    public function __invoke(array $attributes, $context = null): array
    {
        // Modify $attributes here …

        return $attributes;
    }
}
```


## References

* [\Contao\Widget#L1407-L1414](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Widget.php#L1407-L1414)
