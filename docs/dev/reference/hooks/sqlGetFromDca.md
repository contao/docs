---
title: "sqlGetFromDca"
description: "sqlGetFromDca hook"
tags: ["hook-installer"]
---


The `sqlGetFromDca` hook is triggered when sql definitions in DCA files are evaluated. It passes
the generated SQL definition and expects the same as return value.


## Parameters

1. *array* `$sql`

    The parsed SQL definition.


## Return Values

Return `$sql` after adding your custom definitions.


## Example

```php
// src/App/EventListener/SqlGetFromDcaListener.php
namespace App\EventListener;

class SqlGetFromDcaListener
{
    public function onSqlGetFromDca(array $sql): array
    {
        // Modify the array of SQL statements

        return $sql;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\SqlGetFromDcaListener:
    public: true
    tags:
      - { name: contao.hook, hook: sqlGetFromDca, method: onSqlGetFromDca }
```


## References

- [\Contao\Database\Installer#L296-L304](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Database/Installer.php#L296-L304)
