---
title: "storeFormData"
description: "storeFormData hook"
tags: ["hook-form"]
---


The `storeFormData` hook is triggered before a submitted form is stored to the
database. It passes the result set and the form object and expects the result
set as return value.


## Parameters

1. *array* `$data`

    The result set that will be written to the database table.

2. *\Contao\Form* `$form`

    The form instance.


## Return Values

Return `$data` or an array of key => values that should be written to the
database.


## Example

```php
// src/App/EventListener/StoreFormDataListener.php
namespace App\EventListener;

class StoreFormDataListener
{
    public function onStoreFormData(array $data, \Contao\Form $form): array
    {
        $data['member'] = 0;

        if (FE_USER_LOGGED_IN && \Contao\Database::getInstance()->fieldExists('member', $form->targetTable)) {
            // Also store the member ID who submitted the form
            $data['member'] = \Contao\FrontendUser::getInstance()->id;
        }

        return $data;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\StoreFormDataListener:
    public: true
    tags:
      - { name: contao.hook, hook: storeFormData, method: onStoreFormData }
```


## References

- [\Contao\Form#L499-L507](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/forms/Form.php#L499-L507)
