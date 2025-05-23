---
title: "processFormData"
description: "processFormData hook"
tags: ["hook-form"]
aliases:
    - /reference/hooks/processFormData/
    - /reference/hooks/processformdata/
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
// src/EventListener/ProcessFormDataListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Form;

#[AsHook('processFormData')]
class ProcessFormDataListener
{
    public function __invoke(array $submittedData, array $formData, array|null $files, array $labels, Form $form): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\Form#L533-L541](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/forms/Form.php#L533-L541)
