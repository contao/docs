---
title: "compileDefinition"
description: "compileDefinition hook"
tags: ["hook-stylesheet"]
---

The `compileDefinition` hook is triggered when a format definition of an internal
style sheet is written. It passes the database record of the style definition as 
an array and expects a string as return value.

## Example

```php
// src/App/EventListener/CompileDefinitionListener.php
namespace App\EventListener;

class CompileDefinitionListener
{
    public function onCompileDefinition(array $row, bool $writeToFile, array $vars, array $parent): string
    {
        if (isset($row['border-radius'])) {
            return "\nborder-radius:" . $arrRow['border-radius'] . ";";
        }

        return '';
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\CompileDefinitionListener:
    public: true
    tags:
      - { name: contao.hook, hook: compileDefinition, method: onCompileDefinition }
```

## References

* [\Contao\StyleSheets#L930-L943](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/StyleSheets.php#L930-L943)
