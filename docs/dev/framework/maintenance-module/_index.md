---
title: Maintenance Module
description: "Implementing a custom module for the maintenance section in the back end."
---


The _Maintenance_ section in the Contao back end allows you to perform certain maintenance tasks. By default it is home
to two different maintenance modules: the crawler module and the purge module. This article shows how to implement your
own custom maintenance module which will then be displayed in the back end maintenance view. There is also a dedicated
article on how to extend the purge module with additional tasks for your purposes 
[here](/framework/maintenance-module/purge-task/).

First you need to create a class that implements the `MaintenanceModuleInterface`:

```php
// src/Maintenance/CustomMaintenanceModule.php
namespace App\Maintenance;

use Contao\MaintenanceModuleInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Twig\Environment;

#[AsController]
class CustomMaintenanceModule implements MaintenanceModuleInterface
{
    public function __construct(private readonly Environment $twig)
    {
    }

    public function run()
    {      
        return $this->twig->render('custom_maintenance_module.html.twig', [
            'is_active' => $this->isActive(),
        ]);
    }

    public function isActive()
    {
        return false;
    }
}
```

The interface defines two methods: `run()` and `isActive()`. The former is expected to return a string and thus renders
our maintenance module. The latter is used to define whether the module is "active". When the module returns `true`,
_only_ this module will be rendered. Otherwise it will be rendered together with all the other maintenance modules.
This can be used to alternatively render a more detailed view of your maintenance module, based on an additional query
parameter for example.

Note that we can use dependency injection for maintenance modules - but the service needs to be public, which is done
via the `AsController` attribute in this example.

Within the template, the wrapper should at least contain either the `maintenance_active` or `maintenance_inactive` class
in order to apply the default back end maintenance module styles:

```twig
{# templates/custom_maintenance_module.html.twig #}
<div{{ attrs().addClass('maintenance_' ~ (is_active ? 'active' : 'inactive'))}}>
    <h2 class="sub_headline">Custom Maintenance Module</h2>
    <div class="tl_tbox">
        <p>Hello World!</p>
    </div>
</div>
```

Lastly we need to actually register our maintenance module in the `$GLOBALS['TL_MAINTENANCE']` array in the `config.php`:

```php
// contao/config/config.php
use App\Maintenance\CustomMaintenanceModule;

$GLOBALS['TL_MAINTENANCE'][] = CustomMaintenanceModule::class;
```

Now our maintenance module will be rendered in the back end:

![Custom maintenance module]({{% asset "images/dev/framework/custom-maintenance-module.png" %}}?classes=shadow)
