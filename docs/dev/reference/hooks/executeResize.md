---
title: "executeResize"
description: "executeResize hook"
tags: ["hook-image"]
---

The `executeResize` hook is triggered on whenever Contao resizes an image. It
passes the image object as an argument and expects either `null` or a the path
to the resized image as the return value. If the return value is `null`, other 
hooks of the same type will still be executed.

{{% notice info %}}
Using the `executeResize` and `getImage` hooks has been deprecated and will no 
longer work in Contao 5.0. Replace the `contao.image.resizer` service instead.
{{% /notice %}}


## Parameters

1. *\Contao\Image* `$image`

    The legacy image object instance.


## Return Values

The path to the process image or null to keep the default behaviour.


## Example

```php
// src/App/EventListener/ExecuteResizeListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class ExecuteResizeListener
{
    /**
     * @Hook("executeResize")
     */
    public function onExecuteResize(\Contao\Image $image): ?string
    {
        if (…) {
            // Do something and return the path to the resized image

            return $pathToResizedImage;
        }

        return null;
    }
}
```


## References

* [\Contao\LegacyResizer.php#L79-L87](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Image/LegacyResizer.php#L79-L87)
* [\Contao\Image.php#L429-L443](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Image.php#L429-L443)
