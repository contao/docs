---
title: "compileDefinition"
description: "compileDefinition hook"
tags: ["hook-stylesheet"]
aliases:
    - /reference/hooks/compileDefinition/
    - /reference/hooks/compiledefinition/
---


The `compileDefinition` hook is triggered when a format definition of an internal
style sheet is written. It passes the database record of the style definition as 
an array and expects a string as return value.

{{% notice info %}}
Using the `compileDefinition` hook has been deprecated and will no longer work in Contao 5.0. There is no replacement as the internal stylesheet functionality has been removed in Contao 5.0.
{{% /notice %}}

## Parameters

1. *array* `$row`

    The style definition database record (`tl_style_sheet`).

2. *bool* `$writeToFile`

    Defines whether or not the style definition will be written to a file.

3. *array* `$vars`

    CSS variables from the theme.

4. *array* `$parent`

    The parent record of the style definition (`tl_style`).


## Return Values

A string containing the customized style definition. Or an empty string, if the original
definition should be used.


## Example

```php
// src/EventListener/CompileDefinitionListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('compileDefinition')]
class CompileDefinitionListener
{
    public function __invoke(array $row, bool $writeToFile, array $vars, array $parent): string
    {
        if (isset($row['border-radius'])) {
            return "\nborder-radius:" . $arrRow['border-radius'] . ";";
        }

        return '';
    }
}
```


## References

* [\Contao\StyleSheets#L930-L943](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/StyleSheets.php#L930-L943)
