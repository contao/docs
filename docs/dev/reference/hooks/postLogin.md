---
title: "postLogin"
description: "postLogin hook"
tags: ["hook-user", "hook-member"]
---


The `postLogin` hook is triggered after a user has logged in. This can 
be either in the back end or the front end. It passes the user object 
as argument and does not expect a return value.

{{% notice info %}}
Using the `postLogin` hook has been deprecated and will no longer work in Contao 5.0.
{{% /notice %}}


## Parameters

1. *\Contao\User* `$user`

    The back end or front end user (object) which has been logged in.


## Example

```php
// src/App/EventListener/PostLoginListener.php
namespace App\EventListener;

class PostLoginListener
{
    public function onPostLogin(\Contao\User $user): void
    {
        if ($user instanceof \Contao\FrontendUser) {
            // Do something with the front end user $user  
        }
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\PostLoginListener:
    public: true
    tags:
      - { name: contao.hook, hook: postLogin, method: onPostLogin }
```


## References

- [\Contao\CoreBundle\Security\Authentication\AuthenticationSuccessHandler#L112-L128p](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Security/Authentication/AuthenticationSuccessHandler.php#L112-L128)
