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

{{% notice tip %}}
If you want to use the image size `name` from the [configuration file](/../../reference/config/#contao-bundle-configuration) you have to use the following size format:
```php
$size = [0, 0, '_name'];
```
{{% /notice %}}

In the template itself the image can then be inserted with `<?php $this->insert('image', $this->arrData); ?>`. This creates a `<figure class="image_container">` containing the image, an image link and a caption if one was specified.

To use the image without the boilerplate code around it `<?php $this->insert('picture_default', $this->picture); ?>` can be used instead.
