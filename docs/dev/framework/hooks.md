---
title: "Hooks"
description: Extending front end and back end functionality.
aliases:
    - /framework/hook/
    - /framework/hooks/
---


Hooks are entry points into the Contao core (and some of its extension bundles).
Have a look at the [hook reference][HookReference] for a list of all available hooks.
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

In order to be compatible with the method execution you need to consider the parameters that will be passed to your function.

```php
$this->{$callback[0]}->{$callback[1]}($objMember, $this);
```

In this case an instance of `Contao\MemberModel` and an instance of `Contao\ModuleRegistration` will be passed as arguments to the hook.

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

As of Contao **4.13**, there are four different ways of subscribing to a hook. The
recommended way is using _PHP attributes_ together with [invokable services](#invokable-services).
Which one you use depends on your setup. For example, if you still need to support PHP 7 you can use _annotations_. If you still develop hooks 
for Contao **4.4** then you still need to use the _PHP array configuration_.

{{% notice tip %}}
Using attributes or annotations means it is only necessary to create one file for the respective adaptation when using Contao's default
way of automatically registering services under the `App\` namespace within the `src/` folder.
{{% /notice %}}

{{< tabs groupId="serviceConfig" >}}
{{% tab name="Attribute" %}}
{{< version-tag "4.13" >}} Contao implements [PHP attributes](https://www.php.net/manual/en/language.attributes.overview.php) with which you can tag your service to be registered as a hook.

```php
// src/EventListener/ParseArticlesListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\FrontendTemplate;
use Contao\Module;

class ParseArticlesListener
{
    #[AsHook('parseArticles', priority: 100)]
    public function onParseArticles(FrontendTemplate $template, array $newsEntry, Module $module): void
    {
        // Do something …
    }
}
```

The priority parameter is optional.
{{% /tab %}}

{{% tab name="Annotation" %}}
{{% version-tag "4.8" %}}

Contao also supports its own annotation formats via the [Service Annotation Bundle](https://github.com/terminal42/service-annotation-bundle).

```php
// src/EventListener/ParseArticlesListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\FrontendTemplate;
use Contao\Module;

class ParseArticlesListener
{
    /**
     * @Hook("parseArticles", priority=100)
     */
    public function onParseArticles(FrontendTemplate $template, array $newsEntry, Module $module): void
    {
        // Do something …
    }
}
```

The priority parameter is optional.
{{% /tab %}}

{{% tab name="YAML" %}}
{{< version-tag "4.5" >}} Since Contao 4.5 hooks can be registered using the `contao.hook` service tag.

```yaml
# config/services.yaml
services:
    App\EventListener\ActivateAccountListener:
        tags:
            - { name: contao.hook, hook: activateAccount, method: onAccountActivation, priority: 100 }
```

The service tag can have the following options:

| Option   | Type      | Description                                                                                              |
| -------- | --------- | -------------------------------------------------------------------------------------------------------- |
| name     | `string`  | Must be `contao.hook`.                                                                                   |
| hook     | `string`  | The name of the hook this service will listen to.                                                        |
| method   | `string`  | _Optional:_ the method name in the service - otherwise infered from the hook (e.g. `onActivateAccount`). |
| priority | `integer` | _Optional:_ priority of the hook. (Default: `0`)                                                         |
{{% /tab %}}

{{% tab name="config.php" %}}
In this legacy way hooks are registered by extending the respective global array in your
[`config.php`](/getting-started/starting-development/#contao-configuration-translations) file (ever since hooks were introduced in Contao).

```php
// contao/config.php
use App\EventListener\ActivateAccountListener;

$GLOBALS['TL_HOOKS']['activateAccount'][] = [ActivateAccountListener::class, 'onActivateAccount'];
```

In this case, the method `onActivateAccount` in the class or service `App\EventListener\ActivateAccountListener` 
is called as soon as the hook `activateAccount` is executed. Note that the first element in the array can also be a service reference 
since Contao **4.3**.

```php
// src/EventListener/ActivateAccountListener.php
namespace App\EventListener;

use Contao\MemberModel;
use Contao\ModuleRegistration;

class ActivateAccountListener
{
    public function onAccountActivation(MemberModel $member, ModuleRegistration $module): void
    {
        // Do something …
    }
}
```
{{% /tab %}}
{{< /tabs >}}

{{% notice note %}}
When using the default priority, or a priority of `0` the hook will be executed according to the extension loading order, along side hooks 
that are using the legacy configuration via `$GLOBALS['TL_HOOK']`. With a priority that is greater than zero the hook will be executed 
_before_ the legacy registered hooks. With a priority of lower than zero the hook will be executed _after_ the legacy registered hooks.
{{% /notice %}}


### Invokable Services

{{< version-tag "4.9" >}} You can also use [invokable classes][invoke] for your services. If a service is
tagged with `contao.hook` and no method name is given, the `__invoke` method will
be called automatically. This also means that you can define the service annotation
on the class, instead of a method:

{{< tabs groupId="serviceConfig" >}}
{{% tab name="Attribute" %}}
```php
// src/EventListener/ParseArticlesListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\FrontendTemplate;
use Contao\Module;

#[AsHook('parseArticles')]
class ParseArticlesListener
{
    public function __invoke(FrontendTemplate $template, array $newsEntry, Module $module): void
    {
        // Do something …
    }
}
```
{{% /tab %}}

{{% tab name="Annotation" %}}
```php
// src/EventListener/ParseArticlesListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\FrontendTemplate;
use Contao\Module;

/**
 * @Hook("parseArticles")
 */
class ParseArticlesListener
{
    public function __invoke(FrontendTemplate $template, array $newsEntry, Module $module): void
    {
        // Do something …
    }
}
```
{{% /tab %}}

{{% tab name="YAML" %}}
```yaml
# config/services.yaml
services:
    App\EventListener\ParseArticlesListener:
        tags:
            - { name: contao.hook, hook: activateAccount }
```
```php
// src/EventListener/ParseArticlesListener.php
namespace App\EventListener;

use Contao\FrontendTemplate;
use Contao\Module;

class ParseArticlesListener
{
    public function __invoke(FrontendTemplate $template, array $newsEntry, Module $module): void
    {
        // Do something …
    }
}
```
{{% /tab %}}

{{% tab name="config.php" %}}
```php
// contao/config.php
use App\EventListener\ParseArticlesListener;

$GLOBALS['TL_HOOKS']['activateAccount'][] = [ParseArticlesListener::class, '__invoke'];
```
```php
// src/EventListener/ParseArticlesListener.php
namespace App\EventListener;

use Contao\FrontendTemplate;
use Contao\Module;

class ParseArticlesListener
{
    public function __invoke(FrontendTemplate $template, array $newsEntry, Module $module): void
    {
        // Do something …
    }
}
```
{{% /tab %}}
{{< /tabs >}}


[HookReference]: /reference/hooks/
[invoke]: https://www.php.net/manual/en/language.oop5.magic.php#object.invoke
[contaoConfig]: /getting-started/starting-development/#contao-configuration-translations
[ServiceAnnotationBundle]: https://github.com/terminal42/service-annotation-bundle
[PhpAttributes]: https://www.php.net/manual/en/language.attributes.overview.php
