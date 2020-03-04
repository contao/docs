---
title: "Image Processing"
description: "Processing and resizing of image files and creation of responsive images."
---

## Image Libraries

Contao uses its own libraries for handling image resizes and creating responsive images. You can find more about the underlying implementation in [contao/image](https://github.com/contao/image) and [contao/imagine-svg](https://github.com/contao/imagine-svg).

## ImageFactory

The image factory service `contao.image.image_factory` implements the `Contao\CoreBundle\Image\ImageFactoryInterface` and can be used to retrieve a resized version of a single image.

The `create($path, $size, $options)` method supports different formats for its parameters. As an alternative to the instances of `Contao\Image\ImageInterface`, `Contao\Image\ResizeConfiguration` and `Contao\Image\ResizeOptions` you can use a `string` for the path, an `array` or `integer` for the size and a `string` for options that gets used as the target path.

As a result you get an instance of `Contao\Image\ImageInterface` back from which you can retrieve the path, URL and dimensions of the image. If you don’t specify a target path and the resized version of the image doesn’t already exist you can get an instance of `Contao\Image\DeferredImageInterface` back which holds the same information but the image file itself doesn’t exist yet.

### Example

```php
$image = $this->imageFactory->create(
    '/path/to/image.jpg',
    [100, 100, ResizeConfiguration::MODE_CROP]
);
```

Is the same as the following code:

```php
$image = $this->imageFactory->create(
    new Image('/path/to/image.jpg', $imagineService),
    new ResizeConfiguration()
        ->setWidth(100)
        ->setHeight(100)
        ->setMode(ResizeConfiguration::MODE_CROP)
);
```

```php
echo $resizedImage->getPath(); 
// /root/assets/images/9/image-6dc4b466.jpg
echo $resizedImage->getUrl('/root'); 
// assets/images/9/image-6dc4b466.jpg
echo $resizedImage->getDimensions()->getSize()->getWidth();
// 100
```

## PictureFactory

The picture factory service `contao.image.picture_factory` implements the `Contao\CoreBundle\Image\PictureFactoryInterface` and can be used to retrieve a responsive image which may consist of multiple image files in different sizes. The resulting instance of `PictureInterface` is meant to be used with `<picture>`, `srcset` and `sizes`.

The `create($path, $size)` method supports different formats for its parameters. As an alternative to the instances of `Contao\Image\ImageInterface` and `Contao\Image\PictureConfiguration` you can use a `string` for the path and an `array`, `integer` or `string` for the size configuration.

### Example

```php
$image = $this->pictureFactory->create(
    '/path/to/image.jpg',
    [100, 100, ResizeConfiguration::MODE_CROP]
);
```

Is the same as the following code:

```php
$image = $this->pictureFactory->create(
    new Image('/path/to/image.jpg', $imagineService),
    new PictureConfiguration()
        ->setSize(new PictureConfigurationItem()
            ->setResizeConfig(new ResizeConfiguration()
                ->setWidth(100)
                ->setHeight(100)
                ->setMode(ResizeConfiguration::MODE_CROP)
            )
        )
);
```

## Size Array

The size array for both, the image and the picture factory, can have different formats in Contao. The basic version is `[width, height, mode]` where width and height are integers and the mode is one of the `ResizeConfiguration::MODE_*` constants.

Additionally to this static format the array can be used as `[0, 0, imageSizeId]` where imageSizeId is an integer that represents the id of a resize configuration stored in the database table `tl_image_size`. If this format is used the factory fetches the configuration automatically from the database.

Another version of the size array is `[0, 0, imageSizeConfigKey]` where imageSizeConfigKey is a string beginning with an underscore (`_`). This key corresponds to a container configuration from `contao.image.sizes` where you can predefine resize configurations without the need to store them in the database. The underscore prefix is needed to distinguish configuration keys from resize modes. In the container configuration the key is specified without the prefix.

## Using images in Contao templates

If you have a DCA with an image and an image size field, you can use the `Contao\Controller::addImageToTemplate()` method to get all the data that is needed to use the image in the `image.html5` template. This method can be used like this:

```php
$template = new FrontendTemplate('mod_mymodule');
$image = \FilesModel::findByUuid($uuid);

$this->addImageToTemplate($template, [
    'singleSRC' => $image->path,
    'size' => $size,
], null, null, $image);
```

In the template itself the image can then be inserted with `<?php $this->insert('image', $this->arrData); ?>`. This creates a `<figure class="image_container">` containing the image, an image link and a caption if one was specified.

To use the image without the boilerplate code around it `<?php $this->insert('picture_default', $this->picture); ?>` can be used instead.
