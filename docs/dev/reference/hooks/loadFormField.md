---
title: "loadFormField"
description: "loadFormField hook"
tags: ["hook-form"]
aliases:
    - /reference/hooks/loadFormField/
    - /reference/hooks/loadformfield/
---


The `loadFormField` hook is triggered when a form field is loaded. It passes the
widget object, the form ID and the form data as arguments and expects a widget
object as return value. This hook can be used to dynamically alter or extend a form
field of the form generator.


## Parameters

1. *\Contao\Widget* `$widget`

    Instance of the current front end widget.

2. *string* `$formId`

    Alias of the current form. Used in the `value` attribute of the hidden form
    field `FORM_SUBMIT`. Don't confuse with `$form->id`.

3. *array* `$formData`

    The form configuration, a `tl_form` record.

4. *\Contao\Form* `$form`

    The form instance.


## Return Values

Return the `$widget` instance. You can override it's settings or even create
your own widget instead.


## Example

```php
// src/EventListener/LoadFormFieldListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Form;
use Contao\Widget;

#[AsHook('loadFormField')]
class LoadFormFieldListener
{
    public function __invoke(Widget $widget, string $formId, array $formData, Form $form): Widget
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
