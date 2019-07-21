---
title: "sqlCompileCommands"
description: "sqlCompileCommands hook"
tags: ["hook-installer"]
---


The `sqlCompileCommands` hook is triggered when compiling the database update
commands. It passes the array of changes and expects the same as return value.


## Parameters

1. *array* `$sql`

    Array of changes that should be applied to the database.


## Return Values

Return the array of changes that should be applied to the database.


## Example

```php
// src/App/EventListener/SqlCompileCommandsListener.php
namespace App\EventListener;

class SqlCompileCommandsListener
{
    public function onSqlCompileCommands(array $sql): array
    {
        // Modify the array of SQL statements

        return $sql;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\SqlCompileCommandsListener:
    public: true
    tags:
      - { name: contao.hook, hook: sqlCompileCommands, method: onSqlCompileCommands }
```


## References

- [\Contao\InstallationBundle\Database\Installer#L164-L169](https://github.com/contao/contao/blob/4.7.6/installation-bundle/src/Database/Installer.php#L164-L169)
