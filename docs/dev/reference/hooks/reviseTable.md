---
title: "reviseTable"
description: "reviseTable hook"
tags: ["hook-dca", "hook-backend"]
aliases:
    - /reference/hooks/reviseTable/
    - /reference/hooks/revisetable/
---


The `reviseTable` hook is triggered when Contao removes orphan records from a
table. It passes the name of the current table, the IDs of all new records, the
name of the parent table and the names of all child tables as arguments and
does expect a boolean as return value (returning `true` will cause the current
page to be reloaded).


{{% notice note %}}
This hook can also be implemented as an anonymous function.
{{% /notice %}}


## Parameters

1. *string* `$table`

    The current table name.

2. *array* `$newRecords`

    Array containing the ID of the new records. Can be `null`.

3. *string* `$parentTable`

    Optional parent table of the current table. Can be `null`.

4. *array* `$childTables`

    Optional array containing the names of the child tables. Can be `null`.


## Return Values

Return `true` if the current page should be reloaded. Otherwise return `false` or `null`.


## Example

```php
// src/EventListener/ReviseTableListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('reviseTable')]
class ReviseTableListener
{
    public function __invoke(string $table, ?array $newRecords, ?string $parentTable, ?array $childTables): ?bool
    {
        // Do something …
    }
}
```


## References

* [\Contao\DC_Table#L3284-L3306](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/drivers/DC_Table.php#L3284-L3306)
