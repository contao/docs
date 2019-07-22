---
title: "activateRecipient"
description: "activateRecipient hook"
tags: ["hook-newsletter"]
---

The `activateRecipient` hook is triggered when a new newsletter recipient is added. 
It passes the e-mail address, the recipient IDs and the channel IDs as arguments 
and does not expect a return value.


## Parameters

1. *string* `$email`

    The newsletter recipient's email address.

2. *array* `$recipientIds`

    Array of recipient IDs for which this email address was used.

3. *array* `$channelIds`

    Array of newsletter channel IDs for which this email address is subscribed to.


## Example

```php
// src/App/EventListener/ActivateRecipientListener.php
namespace App\EventListener;

class ActivateRecipientListener
{
    public function onActivateRecipient(string $email, array $recipientIds, array $channelIds): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\ActivateRecipientListener:
    public: true
    tags:
      - { name: contao.hook, hook: activateRecipient, method: onActivateRecipient }
```

## References

* [\Contao\ModuleSubscribe#L229-L237](https://github.com/contao/contao/blob/4.7.6/newsletter-bundle/src/Resources/contao/modules/ModuleSubscribe.php#L229-L237)
