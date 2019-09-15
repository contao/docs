---
title: "getFrontendModule"
description: "getFrontendModule hook"
tags: ["hook-controller", "hook-module"]
---

The `getFrontendModule` hook allows to manipulate the generation of the front end
modules.


## Parameters

1. *\Contao\ModuleModel* `$moduleModel`

    Database result of the front end module as a `\Contao\ModuleModel` instance.

2. *string* `$buffer`

    The generated front end module buffer.
    
3. *\Contao\Module* `$module`

    The class of the front end module (inherits from `\Contao\Module`).


## Return Values

Return `$buffer` or your custom modification.


## Example

```php
// src/EventListener/GetFrontendModuleListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Module;
use Contao\ModuleModel;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class GetFrontendModuleListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("getFrontendModule")
     */
    public function onGetFrontendModule(ModuleModel $moduleModel, string $buffer, Module $module): string
    {
        // Wrap a specific module in an additional wrapper div
        if (2 === (int) $moduleModel->id) {
            return '<div class="module">' . $buffer . '</div>';
        }

        return $buffer;
    }
}
```


## References

* [\Contao\Controller.php#L319-L326](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L319-L326)
