---
title: "createNewUser"
description: "createNewUser hook"
tags: ["hook-module", "hook-member"]
---

The createNewUser hook is triggered when a new front end user registers on the 
website. It passes the ID of the new user and the data array as arguments and 
does not expect a return value.

## Example

```php
// src/App/EventListener/CreateNewUserListener.php
namespace App\EventListener;

class CreateNewUserListener
{
    public function onCreateNewUser(int $userId, array $userData, \Contao\Module $module): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\CreateNewUserHook:
    public: true
    tags:
      - { name: contao.hook, hook: createNewUser, method: onCreateNewUser }
```

* [\Contao\Newsletter#L604-L641](https://github.com/contao/contao/blob/4.7.6/newsletter-bundle/src/Resources/contao/classes/Newsletter.php#L604-L641)

## References

* [\Contao\ModuleRegistration#L426-L434](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleRegistration.php#L426-L434)
