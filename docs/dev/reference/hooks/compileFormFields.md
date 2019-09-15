---
title: "compileFormFields"
description: "compileFormFields hook"
tags: ["hook-form"]
---

The `compileFormFields` hook is triggered when the fields of a form are compiled. 
It passes the form fields, the ID of the form and the form object as arguments
and expects the modified form fields as return value.


## Parameters

1. *array* `$fields`

	  An array of `\Contao\FormFieldModel` instances.

2. *string* `$formId`

	  Alias of the current form. Used in the `value` attribute of the hidden form
    field `FORM_SUBMIT`. Don't confuse with `$objForm->id`.

3. *\Contao\Form* `$form`

	  The form (an instance of `\Contao\Form`).

  
## Return Values

An `array` of of `\Contao\FormFieldModel` instances.


## Example

```php
// src/EventListener/CompileFormFieldsListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Form;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class CompileFormFieldsListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("compileFormFields")
     */
    public function onCompileFormFields(array $fields, string $formId, Form $form): array
    {
        // Modify $fields as needed

        return $fields;
    }
}
```


## References

* [\Contao\Form#L130-L138](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/forms/Form.php#L130-L138)
