---
title: "Enumerations"
description: "Resolve enumerations from DCA records"
---

{{< version "5.3" >}}

Models can be used to resolve the values stored for a record into enumerations:

## Set up the DCA

```php
// contao/dca/tl_member.php
$GLOBALS['TL_DCA']['tl_member']['salutation'] => [
  'inputType' => 'select',
  'enum' => App\Data\Salutation::class,
];
```

See the [DCA reference](../../../reference/dca/fields#enumerations) for more information.


## Resolve the Enumation

Only the `value` of an enumeration is stored in the database. 
You can use `Model::getEnum()` to resolve the enumeration.

```php
$member = MemberModel::findByPk(42);

$member->salutation; // string value, e.g. 'ms'
$member->getEnum('salutation'); // App\Data\Salutation or null
```


## Type safe methods & fallback values

It is also possible to access the enumerations in a type-safe way using dedicated methods.
In this process, you can also specify a suitable fallback if an enumeration cannot be resolved from the record's value.

```php
use App\Data\Salutation;
use Contao\MemberModel;

class SalutableMember extends MemberModel 
{
    public function getSalutation(): Salutation
    {
        return $this->getEnum('salutation') ?? Salutation::mx;
    }
}
```
