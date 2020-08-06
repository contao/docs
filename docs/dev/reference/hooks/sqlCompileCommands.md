---
title: "sqlCompileCommands"
description: "sqlCompileCommands hook"
tags: ["hook-installer"]
aliases:
    - /reference/hooks/sqlCompileCommands/
    - /reference/hooks/sqlcompilecommands/
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
// src/EventListener/SqlCompileCommandsListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class SqlCompileCommandsListener
{
    /**
     * @Hook("sqlCompileCommands")
     */
    public function onSqlCompileCommands(array $sql): array
    {
        // Modify the array of SQL statements

        return $sql;
    }
}
```


## References

* [\Contao\InstallationBundle\Database\Installer#L164-L169](https://github.com/contao/contao/blob/4.7.6/installation-bundle/src/Database/Installer.php#L164-L169)
