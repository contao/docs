---
title: "setNewPassword"
description: "setNewPassword hook"
tags: ["hook-member", "hook-module", "hook-backend"]
aliases:
    - /reference/hooks/setNewPassword/
    - /reference/hooks/setnewpassword/
---


The `setNewPassword` hook is triggered after a new password has been set. It
passes the user object and the encrypted password as arguments and does not
expect a return value.


## Parameters

1. *object* `$member`

    Current front end user (either `\Contao\Database\Result` or `\Contao\MemberModel`) 
    that changed their password.

2. *string* `$password`

    The new password (*not encrypted*).

3. *\Contao\Module* `$module`

    Calling front end module. Will be `null` in back end context.


## Example

```php
// src/EventListener/SetNewPasswordListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Module;

/**
 * @Hook("setNewPassword")
 */
class SetNewPasswordListener
{
    public function __invoke($member, string $password, Module $module = null): void
    {
        // Do something …
    }
}
```


## References

* [\tl_member#L537-L544](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/dca/tl_member.php#L537-L544)
* [\Contao\ModuleChangePassword.php#L178-L186](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleChangePassword.php#L178-L1866)
* [\Contao\ModulePassword#L266-L274](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModulePassword.php#L266-L274)
