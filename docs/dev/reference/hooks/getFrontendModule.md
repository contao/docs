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

{{% notice info %}}
This hook is only executed, when a front end module is rendered directly via 
`\Contao\Controller::getFrontendModule()`. This will _not_ be the case if a module 
is inserted into a page via the _Module_ content element for example. The hook is
executed when a front end module is rendered via the page layout or via an insert
tag - or in some cases when a module dynamically inserts another module (e.g. when
the news, events or faq list module dynamically shows the selected reader module).
You will need to implement the [`getContentElement`](/reference/hooks/getContentElement/)
hook as well, if you want to cover all bases.
{{% /notice %}}

{{% notice info %}}
This hook is also executed for forms that are integrated into a page layout via
a front end module.
{{% /notice %}}


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
