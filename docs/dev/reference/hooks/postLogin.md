---
title: "postLogin"
description: "postLogin hook"
tags: ["hook-user", "hook-member"]
aliases:
    - /reference/hooks/postLogin/
    - /reference/hooks/postlogin/
---


The `postLogin` hook is triggered after a user has logged in. This can 
be either in the back end or the front end. It passes the user object 
as argument and does not expect a return value.

{{% notice info %}}
Using the `postLogin` hook has been deprecated and will no longer work in Contao 5.0.
You can use the [security.interactive_login](https://symfony.com/doc/4.4/components/security/authentication.html#authentication-events)
event instead for example.
{{% /notice %}}


## Parameters

1. *\Contao\User* `$user`

    The back end or front end user (object) which has been logged in.


## Example

```php
// src/EventListener/PostLoginListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\User;

class PostLoginListener
{
    /**
     * @Hook("postLogin")
     */
    public function onPostLogin(User $user): void
    {
        if ($user instanceof \Contao\FrontendUser) {
            // Do something with the front end user $user  
        }
    }
}
```


## References

* [\Contao\CoreBundle\Security\Authentication\AuthenticationSuccessHandler#L112-L128p](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Security/Authentication/AuthenticationSuccessHandler.php#L112-L128)
