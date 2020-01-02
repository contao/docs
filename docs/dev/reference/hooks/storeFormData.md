---
title: "storeFormData"
description: "storeFormData hook"
tags: ["hook-form"]
aliases:
    - /reference/hooks/storeFormData/
    - /reference/hooks/storeformdata/
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
// src/EventListener/StoreFormDataListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Form;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class StoreFormDataListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("storeFormData")
     */
    public function onStoreFormData(array $data, Form $form): array
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


## References

* [\Contao\Form#L499-L507](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/forms/Form.php#L499-L507)
