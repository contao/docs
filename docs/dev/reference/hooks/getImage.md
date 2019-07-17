---
title: "getImage"
description: "getImage hook"
tags: ["hook-image"]
---

The `getImage` hook is triggered when a thumbnail is generated and allows you to
add a custom routine. It passes the path, the width and height, the mode, the
cache name and the file object as arguments and expects a path as return value.


## Parameters

1. *string* `$originalPath`

    The image location, relative to Contao root.

2. *int* `$width`

    The target image width.

3. *int* `$height`

    The target image height.
    
4. *string* `mode`

    The resize mode.

5. *string* `$cacheName`

    The cache file name generated from source file name, width, height and mode
    setting.

6. *\Contao\File* `$file`

    A `\Contao\File` object from the source image.

7. *string* `$targetPath`

    The target location where the image should be stored. This will be `null` in
    most cases, if not you should ignore `$cacheName`.

8. *\Contao\Image* `$imageObject`
 
    The instance of the `\Contao\Image` class that triggered the hook.


## Return Values

If you want to override Contao's `Image::get` method, return a string to the new image. 
Otherwise return the boolean `false`.


## Example

```php
// src/App/EventListener/GetImageListener.php
namespace App\EventListener;

class GetImageListener
{
    public function onGetImage(
        string $originalPath, 
        int $width, 
        int $height, 
        string $mode, 
        string $cacheName, 
        \Contao\File $file, 
        string $targetPath, 
        \Contao\Image $imageObject
    ): ?string
    {
        // Return the path to a custom image
        if (…) {
            return $newImagePath;
        }

        return null;
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\GetImageHook:
    public: true
    tags:
      - { name: contao.hook, hook: getImage, method: onGetImage }
```


## References

* [\Contao\CoreBundle\Image\LegacyResizer#L100-L114](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Image/LegacyResizer.php#L100-L114)
