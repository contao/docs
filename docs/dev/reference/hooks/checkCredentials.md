---
title: "checkCredentials"
description: "checkCredentials hook"
tags: ["hook-module", "hook-member"]
aliases:
    - /reference/hooks/checkCredentials/
    - /reference/hooks/checkcredentials/
---


The `checkCredentials` hook is triggered when a login attempt fails due to a wrong 
password. It passes the username and password as well as the user object as 
arguments and expects a boolean as return value which indicates whether the
credentials are correct or not. If the return value is `false`, other hooks of
the same type will still be executed.

{{% notice info %}}
Using the `checkCredentials` hook has been deprecated and will no longer work in Contao 5.0.
{{% /notice %}}


## Parameters

1. *string* `$username`

    The username submitted from the login form.

2. *string* `$credentials`

    The password submitted from the login form.

3. *\Contao\User* `$user`

    User object model from database record with the given username.


## Return Values

Return `true` if the credentials are valid, `false` otherwise.


## Example

```php
// src/EventListener/CheckCredentialsListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\User;

#[AsHook('checkCredentials')]
class CheckCredentialsListener
{
    public function __invoke(string $username, string $credentials, User $user): bool
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


## References

* [\Contao\CoreBundle\Security\Authentication\Provider\AuthenticationProvider#L111-L133](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Security/Authentication/Provider/AuthenticationProvider.php#L111-L133)
