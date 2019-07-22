---
title: "processFormData"
description: "processFormData hook"
tags: ["hook-form"]
---


The `processFormData` hook is triggered after a form has been submitted. It
passes the form data array, the Data Container Array and the files array as
arguments and does not expect a return value.


## Parameters

1. *array* `$submittedData`

    Form data submitted by the visitor.

2. *array* `$formData`

    The form configuration from `tl_form` table.

3. *array* `$files`

    Contains information about uploaded files (from "upload" widgets). Can be null.

4. *array* `$labels`
    
    The field labels of the form.

5. *\Contao\Form* `$form`

    The form instance.
 

## Example

```php
// src/App/EventListener/ProcessFormDataListener.php
namespace App\EventListener;

class ProcessFormDataListener
{
    public function onProcessFormData(
        array $submittedData, 
        array $formData, 
        ?array $files, 
        array $labels, 
        \Contao\Form $form
    ): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ProcessFormDataListener:
    public: true
    tags:
      - { name: contao.hook, hook: processFormData, method: onProcessFormData }
```


## References

* [\Contao\Form#L533-L541](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/forms/Form.php#L533-L541)
