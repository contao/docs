---
title: "Hooks"
description: Extending front end and back end functionality.
aliases:
    - /framework/hook/
    - /framework/hooks/
---


Hooks are entry points into the Contao core (and some of its extension bundles).
Have a look at the [hook reference][1] for a list of all available hooks.
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

As of Contao 4.8, there are three different ways of subscribing to a hook:


### Using the PHP Array configuration

You can add your custom logic to hooks by extending the `TL_HOOKS` key in the
`$GLOBALS` array in your [`config.php`][contaoConfig] file.

```php
// contao/config.php
$GLOBALS['TL_HOOKS']['activateAccount'][] = [\App\EventListener\ActivateAccountListener::class, 'onActivateAccount'];
```

In this case, the method `onActivateAccount` in the class (or service) `App\EventListener\ActivateAccountListener` 
is called as soon as the hook `activateAccount` is executed.

```php
// src/EventListener/ActivateAccountListener.php

namespace App\EventListener;

use Contao\MemberModel;
use Contao\ModuleRegistration;

class ActivateAccountListener
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
  App\EventListener\ActivateAccountListener:
    tags:
      - { name: contao.hook, hook: activateAccount, method: onAccountActivation, priority: 0 }
```

The service tag can have the following options:

| Option   | Type      | Description                                                                                              |
| -------- | --------- | -------------------------------------------------------------------------------------------------------- |
| name     | `string`  | Must be `contao.hook`.                                                                                   |
| hook     | `string`  | The name of the hook this service will listen to.                                                        |
| method   | `string`  | _Optional:_ the method name in the service - otherwise infered from the hook (e.g. `onActivateAccount`). |
| priority | `integer` | _Optional:_ priority of the hook. (Default: `0`)                                                         |

{{% notice note %}}
When using the default priority, or a priority of `0`, the 
hook will be executed according to the extension loading order, along side hooks 
that are using the legacy configuration via `$GLOBALS['TL_HOOK']`. With a priority 
that is greater than zero the hook will be executed _before_ the legacy registered 
hooks. With a priority of lower than zero the hook will be executed _after_ the 
legacy registered hooks.
{{% /notice %}}


### Using Annotations

{{< version "4.8" >}}

Hooks can also be registered using the `@Hook` _Annotation_. See the following example:

```php
// src/EventListener/ParseArticlesListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\FrontendTemplate;
use Contao\Module;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class ParseArticlesListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("parseArticles")
     */
    public function onParseArticles(FrontendTemplate $template, array $newsEntry, Module $module): void
    {
        // Do something …
    }
}
```

You can also define the priority through the annotation:

```php
/**
 * @Hook("parseArticles", priority=-10)
 */
```


### Invokable Services

{{< version "4.9" >}}

You can also use [invokable classes][invoke] for your services. If a service is
tagged with `contao.hook` and no method name is given, the `__invoke` method will
be called automatically. This also means that you can define the service annotation
on the class, instead of a method:

```php
// src/EventListener/IndexPageListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

/**
 * @Hook("indexPage")
 */
class IndexPageListener implements ServiceAnnotationInterface
{
    public function __invoke(string $content, array $pageData, array &$indexData): void
    {
        // Do something …
    }
}
```


[1]: ../../reference/hooks/
[invoke]: https://www.php.net/manual/en/language.oop5.magic.php#object.invoke
[contaoConfig]: /getting-started/starting-development/#contao-configuration-translations
