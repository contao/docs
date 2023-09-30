---
title: "postAuthenticate"
description: "postAuthenticate hook"
tags: ["hook-user", "hook-member"]
aliases:
    - /reference/hooks/postAuthenticate/
    - /reference/hooks/postauthenticate/
---


The `postAuthenticate` hook is triggered after a user was authenticated. It 
passes the user object as argument and does not expect a return value.


{{% notice info %}}
Using the `postAuthenticate` hook has been deprecated and will no longer work in Contao 5.0.
You can use the [security.authentication.success](https://symfony.com/doc/4.4/components/security/authentication.html#authentication-events)
event instead for example.
{{% /notice %}}


## Parameters

1. *\Contao\User* `$user`

    The user (object) which just has been authenticated.


## Example

```php
// src/EventListener/PostAuthenticateListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\User;

#[AsHook('postAuthenticate')]
class PostAuthenticateListener
{
    public function __invoke(User $user): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\CoreBundle\Security\User\ContaoUserProvider#L140-L154](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Security/User/ContaoUserProvider.php#L140-L154)
