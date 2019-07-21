---
title: "sqlGetFromDB"
description: "sqlGetFromDB hook"
tags: ["hook-installer"]
---


The `sqlGetFromDB` hook is triggered when parsing the current database
definition. It passes the generated SQL definitions and expects the same
as return value.


## Parameters

1. *array* `$sql`

    The compiled SQL definitions.


## Return Values

Return `$sql` after adding your custom definitions.


## Example

```php
// src/App/EventListener/SqlGetFromDBListener.php
namespace App\EventListener;

class SqlGetFromDBListener
{
    public function onSqlGetFromDB(array $sql): array
    {
        // Modify the array of SQL statements

        return $sql;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\SqlGetFromDBListener:
    public: true
    tags:
      - { name: contao.hook, hook: sqlGetFromDB, method: onSqlGetFromDB }
```


## References

- [\Contao\Database\Installer#L457-L465](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Database/Installer.php#L457-L465)
