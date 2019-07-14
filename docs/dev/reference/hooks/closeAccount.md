---
title: "closeAccount"
description: "closeAccount hook"
tags: ["hook-module", "hook-member"]
---

The `closeAccount` hook is triggered when a user closes his account. It passes 
the user ID, the operation mode and the module as arguments and does not expect 
a return value.

The operation mode will either be `close_deactivate` or `close_delete`.

## Example

```php
// src/App/EventListener/CloseAccountListener.php
namespace App\EventListener;

class CloseAccountListener
{
    public function onCloseAccount(int $userId, string $mode, \Contao\Module $module): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\CloseAccountHook:
    public: true
    tags:
      - { name: contao.hook, hook: closeAccount, method: onCloseAccount }
```

* [\Contao\Newsletter#L578-L602](https://github.com/contao/contao/blob/4.7.6/newsletter-bundle/src/Resources/contao/classes/Newsletter.php#L578-L602)

## References

* [\Contao\ModuleCloseAccount#L93-L101](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModuleCloseAccount.php#L93-L101)
