---
title: "compileFormFields"
description: "compileFormFields hook"
tags: ["hook-form"]
---

The `compileFormFields` hook is triggered when the fields of a form are compiled. 
It passes the form fields, the ID of the form and the form object as arguments
and expects the modified form fields as return value.

## Example

```php
// src/App/EventListener/CompileFormFieldsListener.php
namespace App\EventListener;

class CompileFormFieldsListener
{
    public function onCompileFormFields(array $fields, string $formId, \Contao\Form $form): array
    {
        // Modify $fields as needed

        return $fields;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\CompileFormFieldsListener:
    public: true
    tags:
      - { name: contao.hook, hook: compileFormFields, method: onCompileFormFields }
```

## References

* [\Contao\Form#L130-L138](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/forms/Form.php#L130-L138)
