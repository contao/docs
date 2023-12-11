---
title: "prepareFormData"
description: "prepareFormData hook"
tags: ["hook-form"]
aliases:
    - /reference/hooks/prepareFormData/
    - /reference/hooks/prepareformdata/
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
{{< tabs groupId="attribute-annotation-yaml-php" >}}
{{% tab name="Since Contao 5.2" %}}
```php
// src/EventListener/PrepareFormDataListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Form;

#[AsHook('prepareFormData')]
class PrepareFormDataListener
{
    public function __invoke(
        array &$submittedData, 
        array $labels, 
        array $fields, 
        Form $form, 
        array $files
        ): void
    {
        
        // Add a custom file as attachment
        $files[] = [
            'name' => 'MyAttachmentFileName.txt',
            'tmp_name' => 'path/to/MyAttachmentFileName.txt',
            'type' => 'text/html'
        ];
    
        // This calculates a deadline from a given timestamp
        // and stores it as deadline in $submittedData.
        $submittedData['deadline'] = strtotime('+1 hour', $submittedData['tstamp']);
    }
}
```
{{% /tab %}}
{{% tab name="Before Contao 5.2" %}}
```php
// src/EventListener/PrepareFormDataListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Form;

#[AsHook('prepareFormData')]
class PrepareFormDataListener
{
    public function __invoke(array &$submittedData, array $labels, array $fields, Form $form): void
    {
        // This calculates a deadline from a given timestamp
        // and stores it as deadline in $submittedData.
        $submittedData['deadline'] = strtotime('+1 hour', $submittedData['tstamp']);
    }
}
```
{{% /tab %}}
{{< /tabs >}}




## References

* [\Contao\Form#L309-L317](https://github.com/contao/contao/blob/4.9.13/core-bundle/src/Resources/contao/forms/Form.php#L309-L317)
* [\Contao\Form#L394-L400](https://github.com/contao/contao/blob/5.x/core-bundle/contao/forms/Form.php#L394-L400)
