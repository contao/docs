---
title: "Legacy"
description: Image template handling for Contao versions < 4.10.
aliases:
  - /framework/image-processing/legacy/
---

{{% notice note %}}
This section only applies to Contao versions prior to **4.10**. For later versions use the
[Image Studio](/framework/image-processing/image-studio/) features and templates instead.
{{% /notice %}}


### Using images in Contao templates

If you have a DCA with an image and an image size field, you can use the `Contao\Controller::addImageToTemplate()` method to get all the data that is needed to use the image in the `image.html5` template. This method can be used like this:

```php
use Contao\FrontendTemplate;
use Contao\FilesModel;
use Contao\Controller;

$template = new FrontendTemplate('mod_mymodule');
$image = FilesModel::findByUuid($uuid);

Controller::addImageToTemplate($template, [
    'singleSRC' => $image->path,
    'size' => $size,
], null, null, $image);
```

The second argument is an array supporting the following optional parameters:

| Key | Description |
| --- | --- |
| `singleSRC` | Path of the source image. |
| `size` | [Size array][SizeArray] for the desired image size. |
| `imagemargin` | Serialized array containing image margin values. |
| `fullsize` | Boolean value defining whether to open the link target of the image in a new window or a lightbox. |
| `overwriteMeta` | Boolean value defining whether to overwrite any meta data that is extracted from the `FilesModel` (last parameter). |
| `imageUrl` | Link target of the image. |
| `imageTitle` | Title of the image. |
| `linkTitle`/`title` | Link title of the image. |
| `alt` | The `alt` attribute for the image. |
| `caption` | Caption for the image. |
| `floating` | Floating setting of the image (`above`, `below`, `left` or `right`). Will be used as a CSS class prepended with `float_`. |
| `floatClass` | Custom CSS class for the `<figure>`. Needs to prepended with a space. _Note:_ will be overridden, if `floating` is defined. |
| `lightboxSize` | [Size array][SizeArray] for the lightbox image, if applicable. |

In the template itself the image can then be inserted with `<?php $this->insert('image', $this->arrData); ?>`. This creates a `<figure class="image_container">` containing the image, an image link and a caption if one was specified.

To use the image without the boilerplate code around it `<?php $this->insert('picture_default', $this->picture); ?>` can be used instead.


[SizeArray]: /framework/image-processing/image-sizes/#size-array
