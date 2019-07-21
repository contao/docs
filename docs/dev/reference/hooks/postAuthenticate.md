---
title: "postAuthenticate"
description: "postAuthenticate hook"
tags: ["hook-user", "hook-member"]
---


The `postAuthenticate` hook is triggered after a user was authenticated. It 
passes the user object as argument and does not expect a return value.


{{% notice info %}}
Using the `postAuthenticate` hook has been deprecated and will no longer work in Contao 5.0.
{{% /notice %}}


## Parameters

1. *\Contao\User* `$user`

    The user (object) which just has been authenticated.


## Example

```php
// src/App/EventListener/PostAuthenticateListener.php
namespace App\EventListener;

class PostAuthenticateListener
{
    public function onPostAuthenticate(\Contao\User $user): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\PostAuthenticateListener:
    public: true
    tags:
      - { name: contao.hook, hook: postAuthenticate, method: onPostAuthenticate }
```

## References

- [\Contao\CoreBundle\Security\User\ContaoUserProvider#L140-L154](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Security/User/ContaoUserProvider#L140-L154)
