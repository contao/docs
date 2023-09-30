---
title: "getForm"
description: "getForm hook"
tags: ["hook-controller", "hook-form"]
aliases:
    - /reference/hooks/getForm/
    - /reference/hooks/getform/
---


The `getForm` hook allows to manipulate the generation of the forms. It passes the
form object and the current form output buffer as arguments and expects a string
as return value.

{{% notice info %}}
This hook is only executed, when a form is rendered directly via 
`\Contao\Controller::getForm()`. Within the Contao core this is currently only the
case if a form is integrated via the `{{insert_form::*}}` insert tag. The content
element and module _Form_ render the form directly and thus the hook is not executed.
You will need to implement the [`getContentElement`](/reference/hooks/getContentElement/)
and [`getFrontendModule`](/reference/hooks/getFrontendModule/)
hook as well, if you want to cover all bases.
{{% /notice %}}


## Parameters

1. *\Contao\FormModel* `$formModel`

    Database result set from table `tl_form` as a `\Contao\FormModel` instance.

2. *string* `$buffer`

    The generated form buffer.
    
3. *\Contao\Form* `$form`

    The Form object.


## Return Values

Return `$buffer` or your custom modification.


## Example

```php
// src/EventListener/GetFormListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Form;
use Contao\FormModel;

#[AsHook('getForm')]
class GetFormListener
{
    public function __invoke(FormModel $formModel, string $buffer, Form $form): string
    {
        if (2 === (int) $form->id) {
            // Do something …
        }

        return $buffer;
    }
}
```


## References

* [\Contao\Controller#L540-L547](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L540-L547)
