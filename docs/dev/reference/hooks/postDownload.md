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


## Parameters

1. *string* $file

    The file which has been downloaded (a path relative to the project's directory).


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
