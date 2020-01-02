---
title: "removeRecipient"
description: "removeRecipient hook"
tags: ["hook-newsletter", "hook-module"]
aliases:
    - /reference/hooks/removeRecipient/
    - /reference/hooks/removerecipient/
---


The `removeRecipient` hook is triggered when a newsletter recipient is removed.
It passes the email address and the channel IDs as argument and does not expect
a return value.


## Parameters

1. *string* `$email`

    The recipient's email address which has been removed.

2. *array* `$channels`

    The channels from which the recipient has unsubscribed.


## Example

```php
// src/EventListener/RemoveRecipientListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class RemoveRecipientListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("removeRecipient")
     */
    public function onRemoveRecipient(string $email, array $channels): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\ModuleUnsubscribe#L260-L268](https://github.com/contao/contao/blob/4.7.6/newsletter-bundle/src/Resources/contao/modules/ModuleUnsubscribe#L260-L268)
