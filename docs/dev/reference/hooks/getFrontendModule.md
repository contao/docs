---
title: "getFrontendModule"
description: "getFrontendModule hook"
tags: ["hook-controller", "hook-module"]
aliases:
    - /reference/hooks/getFrontendModule/
    - /reference/hooks/getfrontendmodule/
---


The `getFrontendModule` hook allows to manipulate the generation of the front end
modules.


## Parameters

1. *\Contao\ModuleModel* `$model`

    Database result of the front end module as a `\Contao\ModuleModel` instance.

2. *string* `$buffer`

    The generated front end module buffer.
    
3. *object* `$module`

    An instance of the front end module's class that is registered for this module's
    type.


## Return Values

Return `$buffer` or your custom modification.


## Example

```php
// src/EventListener/GetFrontendModuleListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Form;
use Contao\Module;
use Contao\ModuleModel;

/**
 * @Hook("getFrontendModule")
 */
class GetFrontendModuleListener
{
    public function __invoke(ModuleModel $model, string $buffer, $module): string
    {
        // Wrap a specific module in an additional wrapper div
        if (2 === (int) $model->id) {
            return '<div class="module">' . $buffer . '</div>';
        }

        return $buffer;
    }
}
```


## References

* [\Contao\Controller.php#L319-L326](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L319-L326)
