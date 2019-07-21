---
title: "prepareFormData"
description: "prepareFormData hook"
tags: ["hook-form"]
---


The `prepareFormData` hook is triggered after a form has been submitted, but
before it is processed. It passes the form data array, the form labels array
and the form object as arguments and does not expect a return value. This way
the data can be changed or extended, prior to execution of actions like email
distribution or data storage.


## Parameters

1. *array* `$submittedData`

    The user input from the form.

2. *array* `$labels`

    The field labels of the form.

3. *array* `$fields`

    The fields for this form as an array of `\Contao\Widget` instances.

3. *\Contao\Form* `$form`

    The form instance.


## Example

```php
// src/App/EventListener/PrepareFormDataListener.php
namespace App\EventListener;

class PrepareFormDataListener
{
    public function onPrepareFormData(array &$submittedData, array $labels, array $fields, \Contao\Form $form)
    {
        // This calculates a deadline from a given timestamp
        // and stores it as deadline in $submittedData.
        $submittedData['deadline'] = strtotime('+1 hour', $submittedData['tstamp']);
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\PrepareFormDataListener:
    public: true
    tags:
      - { name: contao.hook, hook: prepareFormData, method: onPrepareFormData }
```


## References

- [\Contao\Form#L306-L314](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/forms/Form.php#L306-L314)
