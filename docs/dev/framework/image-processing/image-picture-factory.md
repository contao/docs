---
title: "Image/Picture Factory"
description: The ImageFactory and Picture factory allow creating responsive images with full control over the parameters.
aliases:
  - /framework/image-processing/image-picture-factory/
---


## ImageFactory

The image factory service `contao.image.image_factory` implements the `Contao\CoreBundle\Image\ImageFactoryInterface` and can be used to retrieve a resized version of a single image.

The `create($path, $size, $options)` method supports different formats for its parameters. As an alternative to the instances of `Contao\Image\ImageInterface`, `Contao\Image\ResizeConfiguration` and `Contao\Image\ResizeOptions` you can use a `string` for the path, an `array` (see [Size Array][SizeArray]) or `integer` (ID of an image size in the database) for the size and a `string` for options that gets used as the target path.

As a result you get an instance of `Contao\Image\ImageInterface` back from which you can retrieve the path, URL and dimensions of the image. If you don’t specify a target path and the resized version of the image doesn’t already exist you can get an instance of `Contao\Image\DeferredImageInterface` back which holds the same information but the image file itself doesn’t exist yet.


#### Example

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
echo $image->getPath(); 
// /root/assets/images/9/image-6dc4b466.jpg
echo $image->getUrl('/root'); 
// assets/images/9/image-6dc4b466.jpg
echo $image->getDimensions()->getSize()->getWidth();
// 100
```

## PictureFactory

The picture factory service `contao.image.picture_factory` implements the `Contao\CoreBundle\Image\PictureFactoryInterface` and can be used to retrieve a responsive image which may consist of multiple image files in different sizes. The resulting instance of `PictureInterface` is meant to be used with `<picture>`, `srcset` and `sizes`.

The `create($path, $size)` method supports different formats for its parameters. As an alternative to the instances of `Contao\Image\ImageInterface` and `Contao\Image\PictureConfiguration` you can use a `string` for the path and an `array`, `integer` or `string` for the size configuration.


#### Example

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


[SizeArray]: /framework/image-processing/image-sizes/#size-array
