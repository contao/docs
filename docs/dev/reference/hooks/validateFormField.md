---
title: "validateFormField"
description: "validateFormField hook"
tags: ["hook-form"]
---


The `validateFormField` hook is triggered when a form field is submitted. It
passes the widget object and the form ID as arguments and expects a widget
object as return value.


## Parameters

1. *\Contao\Widget* `$widget`

    Object of the current front end widget. Use it to access form field properties.

2. *int* `$intId`

    ID of the `tl_form_field` record.

3. *array* `$formData`

    Form configuration data from the `tl_form` table.

4. *\Contao\Form* `$form`

    The form instance.


## Return Value

Return the `$widget` instance after modification or your custom widget.


## Example

```php
// src/App/EventListener/ValidateFormFieldListener.php
namespace App\EventListener;

class ValidateFormFieldListener
{
    public function onValidateFormField(
        \Contao\Widget $widget, string $formId, array $formData, \Contao\Form $form
    ): \Contao\Widget
    {
        if ('myform' === $formId && $widget instanceof \Contao\FormText) {
            // Do your custom validation and add an error if widget does not validate
            if (!$this->validateWidget($widget)) {
                $widget->addError('My custom widget error');
            }
        }

        return $widget;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ValidateFormFieldListener:
    public: true
    tags:
      - { name: contao.hook, hook: validateFormField, method: onValidateFormField }
```


## References

- [\Contao\Form#L206-L214](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/forms/Form.php#L206-L214)
