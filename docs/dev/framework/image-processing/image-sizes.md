---
title: Image Sizes
description: How to apply image size configurations and pre-define them in your configuration.
aliases:
  - /framework/image-processing/image-sizes/
---


The Contao back end allows users to configure various properties for image processing different places, e.g. in the `image`
or `text` content element in order to define the output size of the selected image. This configuration is then used by 
the respective implementation of the content element, which will pass it on to the image studio, the image factory or
the legacy `Controller::addImageToTemplate` function for example.

The back end not only allows you to set an image size and crop or resize mode, but also any pre-defined image size, which
can be created beforehand in the back end or can be configured via the application configuration. These image size 
configurations can be as simple as setting a width and/or height plus a crop or resize mode, but they can also be more 
elaborate when it comes to responsive images. You can configure the `sizes` attribute or the densities of the image for 
example and you can also define additional sources that are applied at different media queries which in turn will use 
different settings again.


## Size Configuration

As already mentioned you can pre-configure image sizes in the container configuration of your application 
(`config/config.yml`) via `contao.image.sizes` without the need to store them in the database. Here you can define 
multiple image sizes and their properties. The following is a basic example that creates two image size configurations 
called `example` and `foobar` which will resize the images to a width of 512 or 1024 pixels respectively when selected:

```yaml
# config/config.yml
contao:
    image:
        sizes:
            example:
                width: 512
            foobar:
                width: 1024
```

There are many more options available. The following configuration called `example` would crop an image to 128 by 128
pixel and zoom fully into its _important part_ (if defined). Furthermore the image's `srcset` will contain `1.5x` and `2.x`
densities and the `<img>` will have a CSS class called `example`: 

```yaml
# config/config.yml
contao:
    image:
        sizes:
            example:
                width: 128
                height: 128
                resize_mode: crop
                zoom: 100
                css_class: example
                lazy_loading: true
                densities: 1.5x, 2x
```

{{% notice note %}}
Contao always generates the `1x` density (i.e. the original size), even if you do not define it specifically in your 
`densities` setting.
{{% /notice %}}

{{% notice note %}}
As of Contao **4.9**, an image will always be served from `assets/images/` by default, when using an image size, even
when the configured size would not require any resizing or cropping. This behavior can be changed through the
`skip_if_dimensions_match` setting for each image size.
{{% /notice %}}

Use `vendor/bin/contao-console config:dump-reference contao` in order to view the full configuration reference of Contao,
including the image size configuration. Or head over to [Config Reference][ConfigReference] article here in the documentation.


### Media Queries

In order to create a `<picture>` element with different `<source>` elements, i.e. different sizes and/or zoom levels for
the same image depending on a media query, you can use the `items` property of an image size. Consider the following
example, which contains two additional image sizes that are applied via media query:

```yaml
contao:
    image:
        sizes:
            example:
                width: 1024
                height: 512
                resize_mode: box
                densities: 1.25x
                css_class: example
                items:
                    -
                        media: '(max-width: 512px)'
                        width: 128
                        height: 64
                        resize_mode: box
                        densities: 2x
                    -
                        media: '(max-width: 1024px)'
                        width: 512
                        height: 256
                        resize_mode: box
                        densities: 1.5x
```

The HTML output of this image size configuration would look as follows:

```html
<figure class="image_container">
  <picture>
    <source srcset="assets/images/….jpg 1x, assets/images/….jpg 2x" media="(max-width: 512px)">
    <source srcset="assets/images/….jpg 1x, assets/images/….jpg 1.5x" media="(max-width: 1024px)">
    <img class="example" src="assets/images/….jpg" srcset="assets/images/….jpg 1x, assets/images/….jpg 1.25x" alt="" itemprop="image" width="1024" height="683">
  </picture>
</figure>
```


### Format Conversion

Contao supports the automatic conversion of formats. For each source format you can define one or more target formats
which will then create a `<picture>` element containing all the target formats, with the last one being the fallback for
the actual `<img>`. The following example will convert all JPEG files with WebP as another source and JPEG as the fall 
back, all WebP files with WebP as another source and JPEG as the fallback and all PNG files with WebP as another source 
and PNG as the fall back:

```yml
contao:
    image:
        sizes:
            example:
                width: 256
                height: 256
                resize_mode: crop
                formats:
                    jpg: [webp, jpg]
                    webp: [webp, jpg]
                    png: [webp, png]
```

The HTML output for a JPEG file would look as follows:

```html
<figure class="image_container">
  <picture>
    <source srcset="assets/images/c/example-d4fb9781.webp" type="image/webp">
    <img src="assets/images/8/example-f20645c3.jpg" alt="" itemprop="image" width="256" height="256">
  </picture>
</figure>
```


### Defaults

{{< version "4.11" >}}

You can also define defaults for your image sizes via the special `_defaults` key so that you do not have to define them
for each image size separately. So instead of writing:

{{% expand "Example without defaults" %}}
```yml
contao:
    image:
        sizes:
            large_photo:
                formats:
                    jpg:
                        - webp
                        - jpg
                densities: 0.75x, 2x
                lazy_loading: true
                resize_mode: crop
                width: 1000
                height: 500

            medium_photo:
                formats:
                    jpg:
                        - webp
                        - jpg
                densities: 0.75x, 2x
                lazy_loading: true
                resize_mode: crop
                width: 500
                height: 250

            small_box:
                formats:
                    jpg:
                        - webp
                        - jpg
                densities: 2x
                resize_mode: box
                width: 100
                height: 100
```
{{% /expand %}}

you could instead incorporate some of these settings as defaults and thus ommit or overwrite them in the specific image
size:

{{% expand "Example with defaults" %}}
```yml
contao:
    image:
        sizes:
            _defaults:
                formats:
                    jpg:
                        - webp
                        - jpg
                densities: 0.75x, 2x
                lazy_loading: true
                resize_mode: crop

            large_photo:
                width: 1000
                height: 500

            medium_photo:
                width: 500
                height: 250

            small_box:
                densities: 2x
                resize_mode: box
                width: 100
                height: 100
```
{{% /expand %}}


### Translating Size Configurations

Every configured image size will show up in the back end under the key given in the `config/config.yml`. However, in
order to improve usability for your back end users you might want to have a better label for these size configurations.
This is possible via Symfony translations by using the `image_sizes` translation domain. The translation label will be
the name of the size according to your configuration. The following example would change the label for the `example` and
`foobar` image size in the back end to _Image with … Pixel width_ for English back end users and to 
_Bild mit … Pixel Breite_ for German back end users:

```yaml
# translations/image_sizes.en.yml
example: Image with 512 Pixel width
foobar: Image with 1024 Pixel width
```

```yaml
# translations/image_sizes.de.yml
example: Bild mit 512 Pixel Breite
foobar: Bild mit 1024 Pixel Breite
```


## Size Array

The "size array" for the [legacy `Controller::addImageToTemplate`][Legacy] function, the [image and picture factory][Factory] 
as well as the [image studio][Studio] can have different formats in Contao. The basic version is `[width, height, mode]` 
where width and height are integers and the mode is one of the `ResizeConfiguration::MODE_*` constants (`crop`, `box` or 
`proportional`).

```php
// Uses the "crop" mode, i.e. crops the image to 256x128 pixels
$size = [256, 128, 'crop'];
```
```php
use Contao\Image\ResizeConfiguration;

// Uses the "box" mode, i.e. resizes the image to either 256 pixels width or 128 pixels height
$size = [256, 128, ResizeConfiguration::MODE_BOX];
```

Additionally to this static format the array can be used as `[0, 0, imageSizeId]` where _imageSizeId_ is an integer that 
represents the id of a resize configuration stored in the database table `tl_image_size`. If this format is used the 
factory fetches the configuration automatically from the database. The width and height values are ignored.

```php
// Uses the image size configuration of tl_image_size with the ID 8
$size = [0, 0, 8];
```

Another version of the size array is `[0, 0, imageSizeConfigKey]` where _imageSizeConfigKey_ is a string beginning with 
an underscore (`_`). This key corresponds to a container configuration from `contao.image.sizes` (see 
[Size Configuration][SizeConfiguration]). The underscore prefix is needed to distinguish configuration keys from regular
resize modes. In the container configuration the key is specified without the prefix. The width and height values are 
ignored.

```php
// Uses the "example" image size stored in contao.image.sizes
$size = [0, 0, '_example'];
```


[ConfigReference]: /reference/config/#contao-bundle-configuration
[SizeConfiguration]: /framework/image-processing/image-sizes/#size-configuration
[Legacy]: /framework/image-processing/legacy/
[Factory]: /framework/image-processing/image-picture-factory/
[Studio]: /framework/image-processing/image-studio/
