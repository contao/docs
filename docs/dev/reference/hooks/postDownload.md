---
title: "postDownload"
description: "postDownload hook"
tags: ["hook-controller"]
---


The `postDownload` hook is triggered after a file has been downloaded with the
download/downloads content element. It passes the file name as argument and does
not expect a return value.


## Parameters

1. *string* $file

    The file which has been downloaded (relative path from `TL_ROOT`).


## Example

```php
// src/App/EventListener/PostDownloadListener.php
namespace App\EventListener;

class PostDownloadListener
{
    public function onPostDownload(string $file): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\PostDownloadListener:
    public: true
    tags:
      - { name: contao.hook, hook: postDownload, method: onPostDownload }
```


## References

- [\Contao\Controller.php#L1257-L1264](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L1257-L1264)
