---
title: "postLogout"
description: "postLogout hook"
tags: ["hook-user", "hook-member"]
aliases:
    - /reference/hooks/postLogout/
    - /reference/hooks/postlogout/
---


The `postLogout` hook is triggered after a user has logged out from the back end 
or front end. It passes the user object as argument and does not expect a return value.

{{% notice info %}}
Using the `postLogout` hook has been deprecated and will no longer work in Contao 5.0.
{{% /notice %}}


## Parameters

1. *\Contao\User* `$user`

    The back end or front end user (object) which has been logged out.


## Example

```php
// src/EventListener/PostLogoutListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\User;

/**
 * @Hook("postLogout")
 */
class PostLogoutListener
{
    public function __invoke(User $user): void
    {
        if ($user instanceof \Contao\FrontendUser) {
            // Do something with the front end user $user  
        }
    }
}
```


## References

* [\Contao\CoreBundle\Security\Logout\LogoutHandler#L64-L82](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Security/Logout/LogoutHandler.php#L64-L82)
