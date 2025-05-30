---
title: "postDownload"
description: "postDownload hook"
tags: ["hook-controller"]
aliases:
    - /reference/hooks/postDownload/
    - /reference/hooks/postdownload/
---


The `postDownload` hook is triggered when a file is sent to the browser by Contao, e.g. by the Download(s) content
elements or the enclosures in News and Events. It passes the file name and does not expect a return value.

{{% notice "info" %}}
This hook is part of Contao's legacy framework and as such is not used anymore by more modern components of Contao,
e.g. the new Download(s) content elements in Contao **5**. If you want to universally react to any download response
by the application you should instead implement a [`kernel.response`](https://symfony.com/doc/current/reference/events.html#kernel-response) listener:

```php
// src/EventListener/DownloadResponseListener.php
namespace App\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

#[AsEventListener]
class DownloadResponseListener
{
    public function __invoke(ResponseEvent $event): void
    {
        if (!$event->isMainRequest() || !($response = $event->getResponse()) instanceof BinaryFileResponse) {
            return;
        }

        $file = $response->getFile();

        // Do something …
    }
}
```
{{% /notice %}}


## Parameters

1. *string* $file

    The file which has been downloaded (relative path from `TL_ROOT`).


## Example

```php
// src/EventListener/PostDownloadListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('postDownload')]
class PostDownloadListener
{
    public function __invoke(string $file): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\Controller.php#L1257-L1264](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L1257-L1264)
