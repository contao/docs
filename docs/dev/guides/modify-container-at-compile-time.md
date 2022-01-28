---
title: "Modify the Container at Compile Time"
description: "How to make changes to the container at compile time in the Contao Managed Edition."
aliases:
  - /guides/modify-container-at-compile-time/
---


## Modify the Container at Compile Time

In a regular Symfony application or bundle a compiler pass for instance can be added
by calling `$container->addCompilerPass()` inside the `build()` function of the application's
`Kernel` or the bundle's `Bundle` class (see the [Symfony documentation](https://symfony.com/doc/4.4/service_container/compiler_passes.html)
for details). In fact this holds true for any modifications that need to be made to
the container at compile time.
 
In a typical **Contao Managed Edition** setup, we cannot alter the Kernel nor does the
application - following current best practices to be *bundle-less* - contain a
`Bundle` class. However, we can also utilize the Contao Manager Plugin to alter the
container and thus also add compiler passes and other things there.


### Contao Manager Plugin to the rescue

Make sure your plugin implements the `ConfigPluginInterface` and implement the
`registerContainerConfiguration` method (see [Plugin documentation](/framework/manager-plugin#the-configplugininterface)).
Now the provided loader allows accessing the container. 

See this example on how to add a custom compiler pass:

```php
// src/ContaoManager/Plugin.php
namespace App\ContaoManager;

use App\DependencyInjection\Compiler\MyCompilerPass;
use Contao\ManagerPlugin\Config\ConfigPluginInterface;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Plugin implements ConfigPluginInterface
{
    public function registerContainerConfiguration(LoaderInterface $loader, array $managerConfig)
    {
        $loader->load(static function (ContainerBuilder $container) {
            $container->addCompilerPass(new MyCompilerPass());
        });
    }
}
```

This can be very useful for example to make certain services public, if you need to access them in
legacy code where you cannot use Dependency Injection yet and have to rely on `Contao\System::getContainer()->get('<service.id>')`
for that matter. Combined with anonymous classes, this could look like this:


```php
// src/ContaoManager/Plugin.php
namespace App\ContaoManager;

use App\DependencyInjection\Compiler\MyCompilerPass;
use Contao\ManagerPlugin\Config\ConfigPluginInterface;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Plugin implements ConfigPluginInterface
{
    public function registerContainerConfiguration(LoaderInterface $loader, array $managerConfig)
    {
        $loader->load(static function (ContainerBuilder $container) {
            $container->addCompilerPass(new class implements CompilerPassInterface {
                public function process(ContainerBuilder $container)
                {
                    // Example for making a custom monolog logger public
                    $container->getDefinition('monolog.logger.api')
                        ->setPublic(true);
                    
                    // Or the general "logger" alias
                    $container->getAlias('logger')
                        ->setPublic(true);
                }
            });
        });
    }
}
```