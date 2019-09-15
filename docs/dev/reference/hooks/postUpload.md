---
title: "postUpload"
description: "postUpload hook"
tags: ["hook-backend"]
---


The `postUpload` hook is triggered after a user has uploaded one or more file in
the back end. It passes an array of filenames as argument and does not expect
a return value.


{{% notice note %}}
This hook can also be implemented as an anonymous function.
{{% /notice %}}


## Parameters

1. *array* `$files`

    List of files that have been uploaded. The file paths are relative to the
    Contao root directory.


## Example

```php
// src/EventListener/PostUploadListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class PostUploadListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("postUpload")
     */
    public function onPostUpload(array $files): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\DC_Folder#L1140-L1155](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/drivers/DC_Folder.php#L1140-L1155)
