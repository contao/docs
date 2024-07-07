---
title: "updatePersonalData"
description: "updatePersonalData hook"
tags: ["hook-member", "hook-module"]
aliases:
    - /reference/hooks/updatePersonalData/
    - /reference/hooks/updatepersonaldata/
---


The `updatePersonalData` hook is triggered after a member has updated their personal data via the respective 
front end module. It passes the front end user, the updated data and the front end module and does not expect 
a return value.

Be aware that the front end user object and the database has already been updated when this hook is triggered.


## Parameters

1. *\Contao\FrontendUser* `$member`

    The front end user instance who changed their data.

2. *array* `$data`

    The submitted form data.

3. *\Contao\Module* `$module`

    The front end module of type `\Contao\ModulePersonalData`.


## Example

```php
// src/EventListener/UpdatePersonalDataListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Module;
use Contao\FrontendUser;

#[AsHook('updatePersonalData')]
class UpdatePersonalDataListener
{
    public function __invoke(FrontendUser $member, array $data, Module $module): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\ModulePersonalData#L333-L341](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/modules/ModulePersonalData.php#L333-L341)
