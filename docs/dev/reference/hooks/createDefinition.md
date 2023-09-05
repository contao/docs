---
title: "createDefinition"
description: "createDefinition hook"
tags: ["hook-stylesheet"]
aliases:
    - /reference/hooks/createDefinition/
    - /reference/hooks/createdefinition/
---


The `createDefinition` hook is triggered when a format definition of a style 
sheet is imported. It passes the key and value, the original format definition 
and the data array as arguments and expects an array or `null` as return value.

{{% notice info %}}
Using the `sendNewsletter` hook has been deprecated and will no longer work in Contao 5.0.
{{% /notice %}}

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

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('createDefinition')]
class CreateDefinitionListener
{
    public function __invoke(string $key, string $value, string $definition, array &$dataSet): ?array
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
