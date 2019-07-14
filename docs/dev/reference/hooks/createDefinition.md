---
title: "createDefinition"
description: "createDefinition hook"
tags: ["hook-stylesheet"]
---

The `createDefinition` hook is triggered when a format definition of a style 
sheet is imported. It passes the key and value, the original format definition 
and the data array as arguments and expects an array or `null` as return value.

## Example

```php
// src/App/EventListener/CreateDefinitionListener.php
namespace App\EventListener;

class CreateDefinitionListener
{
    public function onCreateDefinition(string $Key, string $value, $string $definition, array &$dataSet): ?array
    {
        if ('border-radius' === $key) {
            return ['border-radius' => $value];
        }

        return null;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\CreateDefinitionHook:
    public: true
    tags:
      - { name: contao.hook, hook: createDefinition, method: onCreateDefinition }
```

## References

* [\Contao\StyleSheetsL2203-L2217](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/StyleSheets.php#L2203-L2217)
