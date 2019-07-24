---
title: "loadFormField"
description: "loadFormField hook"
tags: ["hook-form"]
---


The `loadFormField` hook is triggered when a form field is loaded. It passes the
widget object, the form ID and the form data as arguments and expects a widget
object as return value.


## Parameters

1. *\Contao\Widget* `$widget`

    Instance of the current front end widget.

2. *string* `$formId`

    Alias of the current form. Used in the `value` attribute of the hidden form
    field `FORM_SUBMIT`. Don't confuse with `$objForm->id`.

3. *array* `$formData`

    The form configuration, a `tl_form` record.

4. *\Contao\Form* `$form`

    The form instance.


## Return Values

Return the `$widget` instance. You can override it's settings or even create
your own widget instead.


## Example

```php
// src/App/EventListener/LoadFormFieldListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class LoadFormFieldListener
{
    /**
     * @Hook("loadFormField")
     */
    public function onLoadFormField(\Contao\Widget $widget, string $formId, array $formData, \Contao\Form $form): \Contao\Widget
    {
        if ('myForm' === $formId) {
            $widget->class.= ' myclass';
        }

        return $widget;
    }
}
```


## References

* [\Contao\Form#L191-L199](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/forms/Form.php#L191-L199)
