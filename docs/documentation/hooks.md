---
title: "Hooks"
weight: 8
---

## Hooks

Hooks reassemble custom entry points into several points into the Contao core as well as some of its extension bundles.
You can register your own callable logic that will be executed as soon as a certain point in the execution flow of the core
will be reached. Consider the following example.

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

The hook `activateAccount` will be executed as soon as a user account is activated and all the callable functions
in `$GLOBALS['TL_HOOKS']` are called in order of addition.

In order to be compatible with the method execution you need to follow the parameter list that will be passed to your function.

```php
$this->{$callback[0]}->{$callback[1]}($objMember, $this);
```

In this case, this is an instance of `Contao\MemberModel` and an instance of `Contao\ModuleRegistration`.

Some hooks require its listener to return a specific value, that will be passed along. For example the `compileFormFields`
needs you to return `arrFields`.

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

### Registering hooks

You can add your custom logic to hooks by extending the `TL_HOOKS` key in the `$GLOBALS` array in your `config.php` file.

```php
// src/AppBundle/Resources/contao/config.php
$GLOBALS['TL_HOOKS']['activateAccount'][] = [AppBundle\Hook\AccountListener::class, 'onAccountActivation'];
```

In this case, the method `onAccountActivation` in the class `AppBundle\Hook\AccountListener` is called as soon as the hook
`activateAccount` is executed.

```php
<?php
// src/AppBundle/Hook/AccountListener.php

namespace AppBundle\Hook;

use Contao\MemberModel;
use Contao\ModuleRegistration;

class AccountListener
{
    public function onAccountActivation(MemberModel $member, ModuleRegistration $module)
    {
        // Custom logic
    }
}
```

You can find a [list of available hooks](/reference/hooks) in the reference section of this documentation.