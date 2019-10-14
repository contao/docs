---
title: "createDefinition"
description: "createDefinition hook"
tags: ["hook-stylesheet"]
---


The `createDefinition` hook is triggered when a format definition of a style 
sheet is imported. It passes the key and value, the original format definition 
and the data array as arguments and expects an array or `null` as return value.


## Parameters

1. *string* `$key`

    CSS property of the definition.

2. *string* `$value`

    CSS value of the definition.

3. *string* `$definition`

    Complete CSS definition string.

4. *array* `$dataSet`

    The current data set to be added to the database.


## Return Values

An associative array containing the CSS property as key and its value
as value or null to keep the default behaviour.


## Example

```php
// src/EventListener/CreateDefinitionListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class CreateDefinitionListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("createDefinition")
     */
    public function onCreateDefinition(string $key, string $value, string $definition, array &$dataSet): ?array
    {
        if ('border-radius' === $key) {
            return ['border-radius' => $value];
        }

        return null;
    }
}
```


## References

* [\Contao\StyleSheetsL2203-L2217](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/StyleSheets.php#L2203-L2217)
