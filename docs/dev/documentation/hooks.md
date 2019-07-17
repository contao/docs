---
title: "Hooks"
description: Extending front end and back end functionality.
---

Hooks are entry points into the Contao core (and some of its extension bundles).
You can register your own callable logic that will be executed as soon as a certain
point in the execution flow of the core will be reached.
Consider the following example.

```php
if (isset($GLOBALS['TL_HOOKS']['activateAccount']) && \is_array($GLOBALS['TL_HOOKS']['activateAccount']))
{
    foreach ($GLOBALS['TL_HOOKS']['activateAccount'] as $callback)
    {
        $this->import($callback[0]);
        $this->{$callback[0]}->{$callback[1]}($objMember, $this);
    }
}
```

The hook `activateAccount` will be executed as soon as a user account is activated
and all the callable functions registered to the particular hook are called in
order of addition.

In order to be compatible with the method execution you need to follow the parameter
list that will be passed to your function.

```php
$this->{$callback[0]}->{$callback[1]}($objMember, $this);
```

In this case, this is an instance of `Contao\MemberModel` and an instance of
`Contao\ModuleRegistration`.

Some hooks require its listener to return a specific value, that will be passed
along. For example the `compileFormFields` needs you to return `arrFields`.

```php
if (isset($GLOBALS['TL_HOOKS']['compileFormFields']) && \is_array($GLOBALS['TL_HOOKS']['compileFormFields']))
{
    foreach ($GLOBALS['TL_HOOKS']['compileFormFields'] as $callback)
    {
        $this->import($callback[0]);
        $arrFields = $this->{$callback[0]}->{$callback[1]}($arrFields, $formId, $this);
    }
}
```

## Registering hooks

### Using the PHP Array configuration

You can add your custom logic to hooks by extending the `TL_HOOKS` key in the
`$GLOBALS` array in your `config.php` file.

```php
// contao/config.php
$GLOBALS['TL_HOOKS']['activateAccount'][] = [App\EventListener\ActivateAccountListener::class, 'onActivateAccount'];
```

In this case, the method `onActivateAccount` in the class `App\EventListener\ActivateAccountListener` is called as soon as the hook
`activateAccount` is executed.

```php
<?php
// src/EventListener/AccountListener.php

namespace App\EventListener;

use Contao\MemberModel;
use Contao\ModuleRegistration;

class AccountListener
{
    public function onAccountActivation(MemberModel $member, ModuleRegistration $module): void
    {
        // Custom logic
    }
}
```

### Using service tagging

{{< version "4.5" >}}

Since Contao 4.5 hooks can be registered using the `contao.hook` service tag.
Hook listener can be added to the service configuration.

```yml
services:
    App\EventListener\AccountListener:
        public: true
        tags:
            - { name: contao.hook, hook: activateAccount, method: onAccountActivation }
```
