---
title: "getForm"
description: "getForm hook"
tags: ["hook-controller", "hook-form"]
aliases:
    - /reference/hooks/getForm/
    - /reference/hooks/getform/
---


The `getForm` allows to manipulate the generation of the forms. It passes the
form object and the current form output buffer as arguments and expects a string
as return value.


## Parameters

1. *\Contao\FormModel* `$form`

    Database result set from table `tl_form` as a `\Contao\FormModel` instance.

2. *string* `$buffer`

    The generated form buffer.


## Return Values

Return `$buffer` or your custom modification.


## Example

```php
// src/EventListener/GetFormListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\FormModel;

class GetFormListener
{
    /**
     * @Hook("getForm")
     */
    public function onGetForm(FormModel $form, string $buffer): string
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
