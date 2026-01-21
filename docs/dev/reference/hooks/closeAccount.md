---
title: "closeAccount"
description: "closeAccount hook"
tags: ["hook-module", "hook-member"]
aliases:
    - /reference/hooks/closeAccount/
    - /reference/hooks/closeaccount/
---


The `closeAccount` hook is triggered when a user closes their account. It passes 
the user ID, the operation mode and the module as arguments and does not expect 
a return value.

The operation mode will either be `close_deactivate` or `close_delete`.


## Parameters

1. *int* `$userId`

    ID of the user which closed their account.

2. *string* `$mode`

    The "close account" mode. Either `close_deactivate` or `close_delete`.

3. *\Contao\Module* `$module`

    The front end module object. This allows you to retrieve all data from the
    current `tl_module` result set.


## Example

```php
// src/EventListener/CloseAccountListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Module;

#[AsHook('closeAccount')]
class CloseAccountListener
{
    public function __invoke(int $userId, string $mode, Module $module): void
    {
        // Do something …
    }
}
```

* [\Contao\Newsletter#L578-L602](https://github.com/contao/contao/blob/4.7.6/newsletter-bundle/src/Resources/contao/classes/Newsletter.php#L578-L602)


## References

* [\Contao\ModuleCloseAccount#L93-L101](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleCloseAccount.php#L93-L101)
