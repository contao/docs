---
title: "sqlGetFromDca"
description: "sqlGetFromDca hook"
tags: ["hook-installer"]
aliases:
    - /reference/hooks/sqlGetFromDca/
    - /reference/hooks/sqlgetfromdca/
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
// src/EventListener/SqlGetFromDcaListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("sqlGetFromDca")
 */
class SqlGetFromDcaListener
{
    public function __invoke(array $sql): array
    {
        // Modify the array of SQL statements

        return $sql;
    }
}
```


## References

* [\Contao\Database\Installer#L296-L304](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Database/Installer.php#L296-L304)
