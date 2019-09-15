---
title: "createNewUser"
description: "createNewUser hook"
tags: ["hook-module", "hook-member"]
---

The createNewUser hook is triggered when a new front end user registers on the 
website. It passes the ID of the new user and the data array as arguments and 
does not expect a return value.


## Parameters

1. *int* `$userId`

    Unique ID of the user.

2. *array* `$userData`

    All values which have been submitted on the registration form. Be aware that
    the user ID is not contained in this array (`$userData['id']` is empty).

3. *\Contao\Module* `$module`

    The front end module instance executing this hook.


## Example

```php
// src/EventListener/CreateNewUserListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class CreateNewUserListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("createNewUser")
     */
    public function onCreateNewUser(int $userId, array $userData, \Contao\Module $module): void
    {
        // Do something …
    }
}
```

* [\Contao\Newsletter#L604-L641](https://github.com/contao/contao/blob/4.7.6/newsletter-bundle/src/Resources/contao/classes/Newsletter.php#L604-L641)


## References

* [\Contao\ModuleRegistration#L426-L434](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleRegistration.php#L426-L434)
