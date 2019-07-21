---
title: "sqlGetFromFile"
description: "sqlGetFromFile hook"
tags: ["hook-installer"]
---


The `sqlGetFromFile` hook is triggered when parsing database.sql files. It passes
the generated SQL definition and expects the same as return value.


## Parameters

1. *array* `$sql`

    The parsed SQL definition.


## Return Values

Return `$sql` after adding your custom definitions.


## Example

```php
// src/App/EventListener/SqlGetFromFileListener.php
namespace App\EventListener;

class SqlGetFromFileListener
{
    public function onSqlGetFromFile(array $sql): array
    {
        // Modify the array of SQL statements

        return $sql;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\SqlGetFromFileListener:
    public: true
    tags:
      - { name: contao.hook, hook: sqlGetFromFile, method: onSqlGetFromFile }
```


## References

- [\Contao\Database\Installer#L328-L336](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Database/Installer.php#L328-L336)
