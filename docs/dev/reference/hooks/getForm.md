---
title: "getForm"
description: "getForm hook"
tags: ["hook-controller", "hook-form"]
---

The `getForm` allows to manipulate the generation of the forms. IT passes the
form object and the current form output buffer as arguments and epxects a string
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
// src/App/EventListener/GetFormListener.php
namespace App\EventListener;

class GetFormListener
{
    public function onGetForm(\Contao\FormModel $form, string $buffer): string
    {
        if (2 === (int) $form->id) {
            // Do something …
        }

        return $buffer;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GetFormHook:
    public: true
    tags:
      - { name: contao.hook, hook: getForm, method: onGetForm }
```

## References

- [\Contao\Controller#L540-L547](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L540-L547)
