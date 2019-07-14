---
title: "checkCredentials"
description: "checkCredentials hook"
tags: ["hook-module", "hook-member"]
---

The `checkCredentials` hook is triggered when a login attempt fails due to a wrong 
password. It passes the username and password as well as the user object as 
arguments and expects a boolean as return value which indicates whether the
credentials are correct or not. If the return value is `false`, other hooks of
the same type will still be executed.

## Example

```php
// src/App/EventListener/CheckCredentialsListener.php
namespace App\EventListener;

class CheckCredentialsListener
{
    public function onCheckCredentials(string $username, string $credentials, \Contao\User $user): bool
    {
        // Custom method of checking credentials (e.g. external service)
        if ($this->customCredentialsCheck($username, $credentials)) {
            // More custom logic …

            return true;
        }

        return false;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\CheckCredentialsHook:
    public: true
    tags:
      - { name: contao.hook, hook: checkCredentials, method: onCheckCredentials }
```

## References

* [\Contao\CoreBundle\Security\Authentication\Provider\AuthenticationProvider#L111-L133](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Security/Authentication/Provider/AuthenticationProvider.php#L111-L133)
