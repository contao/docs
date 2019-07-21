---
title: "importUser"
description: "importUser hook"
tags: ["hook-member", "hook-user"]
---


The `importUser` hook is triggered when a username cannot be found in the
database. It passes the username, the password and the table name as arguments
and expects a boolean return value.

{{% notice info %}}
Using the `importUser` hook has been deprecated and will no longer work in Contao 5.0. Use the `contao.import_user` event instead.'
{{% /notice %}}


## Parameters

1. *string* `$username`

    The unknown username.

2. *string* `$password`

    The password submitted in the login form.

3. *string* `$table`

    The user model table, either `tl_member` (for front end) or `tl_user`
    (for back end).


## Return Values

A record must exist in the database for Contao to load a user. Return `true` if
you added the user to the respective table, or `false` if not.


## Example

```php
// src/App/EventListener/ImportUserListener.php
namespace App\EventListener;

class ImportUserListener
{
    public function onImportUser(string $username, string $password, string $table): bool
    {
        if ('tl_member' === $table) {
            // Import user from an LDAP server
            if ($this->importUserFromLdap($username, $password)) {
                return true;
            }
        }

        return false;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ImportUserListener:
    public: true
    tags:
      - { name: contao.hook, hook: importUser, method: onImportUser }
```


## References

- [\Contao\User#L655-L688](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/User.php#L655-L688)
