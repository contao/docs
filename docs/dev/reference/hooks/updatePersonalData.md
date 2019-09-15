---
title: "updatePersonalData"
description: "updatePersonalData hook"
tags: ["hook-member", "hook-module"]
---


The `updatePersonalData` hook is triggered after a member has updated his
personal data. It passes the front end user, the updated data and the front
end module and does not expect a return value.

Be aware that the front end user object and the database has already been
updated when this hook is triggered.


## Parameters

1. *\Contao\FrontendUser* `$member`

    The front end user instance who changed his data.

2. *array* `$data`

    The submitted form data.

3. *\Contao\Module* `$module`

    The front end module of type `\Contao\ModulePersonalData`.


## Example

```php
// src/EventListener/UpdatePersonalDataListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class UpdatePersonalDataListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("updatePersonalData")
     */
    public function onUpdatePersonalData(\Contao\FrontendUser $member, array $data, \Contao\Module $module): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\ModulePersonalData#L333-L341](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModulePersonalData.php#L333-L341)
