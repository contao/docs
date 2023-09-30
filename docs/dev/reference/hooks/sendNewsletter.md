---
title: "sendNewsletter"
description: "sendNewsletter hook"
tags: ["hook-newsletter"]
aliases:
    - /reference/hooks/sendNewsletter/
    - /reference/hooks/sendnewsletter/
---


This hook is executed directly after Contao has sent a newsletter to its recipients.

{{% notice info %}}
Using the `sendNewsletter` hook has been deprecated and will no longer work in Contao 5.0.
Use the [SendNewsletterEvent](/reference/events#sendnewsletterevent) instead.
{{% /notice %}}

## Parameters

1. *\Contao\Email* `$email`

    The `\Contao\Email` instance of the newsletter.

2. *\Contao\Database\Result* $newsletter

    A `\Contao\Database\Result` instance from the `tl_newsletter` table.

3. *array* `$recipient`

    An associative array containing information about the recipient.

4. *string* `$text`

    The text-only content of the newsletter.

5. *string* `$html`

    The HTML content of the newsletter.


## Example

```php
// src/EventListener/SendNewsletterListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Database\Result;
use Contao\Email;

#[AsHook('sendNewsletter')]
class SendNewsletterListener
{
    public function __invoke(Email $email, Result $newsletter, array $recipient, string $text, string $html): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\Newsletter#L404-L412](https://github.com/contao/contao/blob/4.7.6/newsletter-bundle/src/Resources/contao/classes/Newsletter.php#L404-L412)
