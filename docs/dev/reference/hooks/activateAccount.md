---
title: "activateAccount"
description: "activateAccount hook"
tags: ["hook-module", "hook-member"]
aliases:
    - /reference/hooks/activateAccount/
    - /reference/hooks/activateaccount/
---


The `activateAccount` hook is triggered when a new front end account is activated. 
It passes the `MemberModel` of the activated account and the `Module` object of
the calling front end module as arguments and does not expect a return value.


## Parameters

1. *\Contao\MemberModel* `$member`

    A model of the activated user account.
    
2. *\Contao\Module* `$module`

    The registration module that was used to activate the account.


## Example

```php
// src/EventListener/ActivateAccountListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Module;
use Contao\MemberModel;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class ActivateAccountListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("activateAccount")
     */
    public function onActivateAccount(MemberModel $member, Module $module): void
    {
        // Do something …
    }
}
```

* [\Contao\Newsletter#L643-L671](https://github.com/contao/contao/blob/4.7.6/newsletter-bundle/src/Resources/contao/classes/Newsletter.php#L643-L671)


## References

* [\Contao\ModuleRegistration#L553-L561](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleRegistration.php#L553-L561)
