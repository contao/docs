---
title: "getSystemMessages"
description: "getSystemMessages hook"
tags: ["hook-backend"]
aliases:
    - /reference/hooks/getSystemMessages/
    - /reference/hooks/getsystemmessages/
---


The `getSystemMessages` hook allows to add additional messages to the back end
home screen. It does not pass any parameters and expects a string as return value.


## Return Values

Return a string with the message(s) you want to add to the home screen (including
HTML markup) or an empty string.


## Example

```php
// src/EventListener/GetSystemMessagesListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class GetSystemMessagesListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("getSystemMessages")
     */
    public function onGetSystemMessages(): string
    {
        // Display a warning if the system admin's email is not set
        if (empty($GLOBALS['TL_ADMIN_EMAIL'])) {
            return '<p class="tl_error">Please add your email address to system settings.</p>';
        }

        return '';
    }
}
```

* [\Contao\Messages.php#L35-L62](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Messages.php#L35-L62)
* [\Contao\Messages.php#L64-L108](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Messages.php#L64-L108)


## References

* [\Contao\Backend#L918-L949](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/classes/Backend.php#L918-L949)
