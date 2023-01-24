---
title: "Image Studio"
description: The Image Studio consists of a set of classes and templates that help you generate and output images and metadata.
aliases:
  - /framework/image-processing/image-studio/
---

{{< version "4.10" >}}

The Image Studio consists of a set of classes and templates that help you generate and output images and metadata.

 * [Components](#components)
 * [Using the FigureBuilder](#using-the-figurebuilder)
 * [Templating](#templating)


## Components

You can find the Image Studio components in the `Contao\CoreBundle\Image\Studio` [namespace][Studio].


### Figure

The `Figure` is a data container that groups all data related to an image under one object. Along the responsive
image with multiple sizes itself, this can also contain image/file metadata (like an alt text or a caption), a secondary
lightbox image, image link attributes or additional template options.

The name *figure* originates from the idea that the HTML `<figure>` tag is also a container for an image with metadata.
The `Figure` object therefore plays well with the default `image.html5` PHP template as well as the Studio's own Twig
[templates and macros][TwigTemplates] that both render this tag.

{{% notice tip %}}
Have a look at the [templating section](#templating) for more information on how to output `Figure` data in your
templates.
{{% /notice %}}


### Studio factory

The `Contao\CoreBundle\Image\Studio\Studio` is a factory that allows creating one of the following result objects:

* The `FigureBuilder` provides a DX friendly way to create `Figure` objects (see below).

* The `ImageResult` provides picture/image data (such as source/img/original dimensions) by lazily querying the
  image and picture factories and caching the results when you use the object's getters. The `ImageResult` is always
  part of a `Figure`.

* The `LightboxResult` provides lightbox data (such as the lightbox group identifier or a link) and can optionally
  contain an `ImageResult` - the resized lightbox image. The `LightboxResult` can also be part of a `Figure`.


## Using the FigureBuilder

Use the `FigureBuilder` class to create Figure result objects. The class has a fluent interface to configure the
desired output. It configures Contao-typical scenarios like retrieving metadata from the DBAFS, fetching lightbox data
or handling image links for you out of the box. When you are ready, call `build()` to get a Figure. Have a look at the
[full reference](#figurebuilder-reference) for all available config options.

1) Use the `Studio` factory to create a new `FigureBuilder`

    ```php
    // Use dependency injection to inject the Contao\CoreBundle\Image\Studio\Studio service
    $figureBuilder = $this->studio->createFigureBuilder();
    
    // Or from within the legacy code
    $figureBuilder = System::getContainer()
                       ->get(Contao\CoreBundle\Image\Studio\Studio::class)
                       ->createFigureBuilder();
    ```
   
2) Dial in your needed configuration

    ```php
    // Example 1
    $figureBuilder
      ->fromUuid($myUuid)
      ->setSize([800, 600, 'crop'])
      ->enableLightbox()
      ->setLightboxGroupIdentifier('group1');
   
    // Example 2
    $figureBuilder
      ->fromPath('/path/to/my/file.png')
      ->setSize('_my_size')
      ->setMetadata($metadata) // overwrite with custom metadata
      ->setLinkHref('https://example.com')
      ->setLinkAttribute('data-foo', 'bar')
      ->setOptions(['attr' => ['class' => 'custom-figure']]);
    ```
   
3) Build a `Figure`

    ```php
    $figure = $figureBuilder->build();
    ```
  
{{% notice tip %}}
After building a `Figure` you can optionally repeat steps 2 and 3 to alter the configuration and create another result.
This can be helpful if you need to output multiple images with a similar configuration (e.g. a gallery).
{{% /notice %}}


### FigureBuilder Reference


#### Defining the base resource ####
|  |  |
|-|-|
| `fromFilesModel` | Define the base resource from a `FilesModel`. |
| `fromUuid` | Define the base resource from a `tl_files` UUID. |
| `fromId` | Define the base resource from a `tl_files` ID. |
| `fromPath` | Define the base resource from an absolute or relative (to the project dir) path. By default, this will try to find a matching `FilesModel` to retrieve metadata - set `$autoDetectDbafsPaths` to `false` to prevent this. |
| `fromImage` | Define the base resource from an `ImageInterface`. This will try to find a matching `FilesModel` to retrieve metadata. |
| `from` | Define the base resource by autodetecting the type and resolving to one of the above variants. |


#### Setting options #### 
|  |  |
|-|-|
| `setSize` | Set the size configuration that should be applied. This can either be a `PictureConfiguration`, an image [size array][SizeArray] or a reference to a predefined image configuration: either via ID of the `tl_image_size` record or via the underscore-prefixed name of the config key (`_my_size`). Pass `null` to disable resizing. |
| `setMetadata` | Overwrite the default metadata that the system tries to retrieve from the base resource's `FilesModel`. Pass `null` to restore the default behavior. |
| `disableMetadata` | Disable retrieving and outputting metadata completely. If this is active, the resulting `Figure` will not contain any metadata. Pass `false` to restore the default behavior. |
| `setLocale` | Explicitly set the locale that should be used to retrieve metadata. By default the system will try to match the current page's or root page's language. If you are using the `FigureBuilder` outside a request context and need metadata, you always need to define this option. Pass `null` to restore the default behavior. |
| `setLinkAttribute` | Add a custom link attribute. This takes precedence over an automatically generated attribute with the same name. Set the value to `null` to remove a previously set attribute again. By also setting `$forceRemove` to true, this will make sure the respective argument won't appear in the result list (even if it was autogenerated). |
| `setLinkAttributes` | Set all custom attributes at once: The list will be merged with the automatically generated ones and override arguments that are already existing. Set a value to `null` to make sure the respective argument won't appear in the result list (even if it was autogenerated).  |
| `setLinkHref` | Short hand for setting the `href` link attribute (see `setLinkAttribute`).  |
| `enableLightbox` | Enable the creation of lightbox (disabled by default). Pass `false` to restore the default behavior. |
| `setLightboxResourceOrUrl` | Overwrite the lightbox resource that the system tries to derive from the metadata URL or base resource. This can either be an absolute or relative (to the project dir) path or an `ImageInterface`. Pass `null` to restore the default behavior. |
| `setLightboxSize` | Overwrite the lightbox size that the system tries to read from the current page's associated layout. If you are using the `FigureBuilder` outside a request context and need a lightbox image, you always need to define this option. Pass `null` to restore the default behavior. |
| `setLightboxGroupIdentifier` | Define the lightbox group identifier (`data-lightbox="<group-identifier>"`). By default or if the argument is set to `null` the identifier will be empty. |
| `setOptions` | Set an associative array of template options. These options won't be processed and are intended to ship parameters to the template. If you are using the Image Studio's twig templates, you might for instance want to pass a HTML class: `['attr' => ['class' => 'my_figure']]` |


## Templating
{{< version-tag "5.0" >}} In Twig, there is a `figure()` function and a `figure` and `picture` component, that allows
generating and outputting `Figures` in your templates. This is by far the most versatile way to render the data while
still being able to finely control its appearance. Read more about how to use it in the
[image section](/framework/templates/creating-templates#images) of the Twig template documentation.

{{% notice note %}}
The following section covers how to use the image studio in **Contao 4.13**. For Contao 5, please refer to the best
practices outlined in the [Twig template documentation](/framework/templates/creating-templates#images).
{{% /notice %}}


#### PHP Templates

There are two ways to output images in your PHP templates:

1) **Rendering a `Figure`** &mdash; If you are creating your own PHP templates and want to apply `Figure` data
   directly, you currently need to create the markup yourself.

   If you are instead using the legacy Contao `image.html5` template, you can make use of two builtin helper functions
   to apply/get an array of data ready to use.

   ```php
   $template = new FrontendTemplate('image');
   
   // Transform and apply the figure data to a given template
   // - comparable to `Controller::addImageToTemplate` 
   $figure->applyLegacyTemplateData($template);
   
   // If you want you can set the data yourself. Note that you might
   // have to deal with a collision of the 'href' key yourself
   $template->setData($figure->getLegacyTemplateData());
   ```

2) **Inline** &mdash; You can also configure and output a figure directly from within your template by using the
   `Template#figure()` function. 
   
   {{< version "4.11" >}}

   The function expects a *resource* (uuid, id, path) as the first and the *image size* as the second argument.
   If you want to specify more config, you can pass a *config* array as the third argument.

   In the config array you can configure the same things you would as when using the `FigureBuilder` (see
   [reference][FigureBuilderOptionsReference]). In fact, under the hood, the template function uses
   [PropertyAccess][PropertyAccess] to configure a `FigureBuilder` instance.

   ```php
   <?php 
     // It's enough to specifiy the resource and size…
     echo $this->figure('path/to/my/image.png', '_my_size');
   ?>
   ```
   ```php     
   <?php
     // …but you can also go wild with the options.
     echo $this->figure(
       $id, [200, 200, 'proportional'], 
       [ 
         'metadata' => new Metadata([
           Metadata::VALUE_ALT => 'Contao Logo', Metadata::VALUE_CAPTION => 'Look at this CMS!'
         ]),
         'enableLightbox' => true,
         'lightboxGroupIdentifier' => 'logos',
         'lightboxSize' => '_big_size',
         'linkHref' => 'https://contao.org',
         'options' => ['attr' => ['class' => 'logo-container']],
       ]
     ); 
   ?>
   ``` 

   {{% notice info %}}
   By default, the `image.html5` template is used to render the result, but you can optionally pass a custom template 
   name as the fourth argument to use instead. This also accepts Twig templates: Make sure to specify the fully
   qualified template path including the `.twig` file extension in this case. The template will then receive a `figure`
   variable with your configured `Figure` as its context.
   {{% /notice %}}



#### Twig (Contao 4.13)

If you are using Twig, there are three supported ways to get figures/images into your templates:

1) **Default figure template** &mdash; Rendering the default `figure.html.twig` template will produce a single figure.
   It expects the variable `figure` to be set in its context with a `Studio\Figure`.
   
    ```php    
    $twig->render('@ContaoCore/Image/Studio/figure.html.twig', ['figure' => $figure]);
    ```

2) **Using macros** &mdash; The composition of a figure - even in the default template - is done with a bunch of macros
   that you can also call yourself.
   
   ```php
   $twig->render('@App/my_figure_collection.html.twig', [
       'figure_collection' => [$figure1, $figure2, $figure3],
   ]);
   ```
   
   ```twig
   {% import "@ContaoCore/Image/Studio/_macros.html.twig" as studio %}
   
   <h1>Gallery</h1>

   {% for figure in figure_collection %}
     {{- studio.figure(figure) -}}
   {% endfor %}
   ``` 
   
   {{% notice info %}}
   The macros accept an *options* object as the second argument. This can contain the same data as a `Figure`'s option
   property and will take precedence over already set values. You can for instance use these options to set custom HTML
   properties on the various tags. Have a look at the [macro definitions](https://github.com/contao/contao/blob/5.0/core-bundle/templates/Image/Studio/_macros.html.twig)
   for more information.  
   {{% /notice %}}
   
   {{% notice tip %}}
   The *figure* macro itself is built using a *picture* and *caption* macro. The *picture* macro again uses an *img*
   macro (and so on). You can also use these individual macros as building blocks for your custom template.
   {{% /notice %}}

3) **Inline** &mdash; You can also output a figure directly from within your template by using the `contao_figure` Twig
   function. The function expects a *resource* (uuid, id, path) as the first and the *image size* as the second argument.
   If you want to specify more config, you can pass a *config* object as the third argument.
   
   In the config object you can configure the same things you would as when using the `FigureBuilder` (see
   [reference][FigureBuilderOptionsReference]). In fact, under the hood, the Twig function uses
   [PropertyAccess][PropertyAccess] to configure a `FigureBuilder` instance. This is why you can also use the same short
   notation you expect from Twig when accessing variables (e.g. `size` instead of `setSize`). In the case of metadata,
   you can also just pass an object which will internally be converted into `Metadata`. 
   
   ```twig
   {# It's enough to specifiy the resource and size… #}
   {{ contao_figure('path/to/my/image.png', '_my_size') }}
     
   {# …but you can also go wild with the options. #}
   {{ contao_figure(id, [200, 200, 'proportional'], { 
     metadata: { alt: 'Contao Logo', caption: 'Look at this CMS!' },
     enableLightbox: true,
     lightboxGroupIdentifier: 'logos',
     lightboxSize: '_big_size',
     linkHref: 'https://contao.org',
     options: { attr: { class: 'logo-container' } }
   }) }}
   ``` 

   {{% notice info %}}
   By default, the `figure.html.twig` template (see 1) is used to render the result, but you can optionally pass a
   custom template as the fourth argument. The template will receive a `figure` variable with your configured `Figure`
   as its context.
   {{% /notice %}}

   If you want to use a complex size configuration for just one image, you do not need to create a global configuration.
   Instead, use the `picture_config` Twig function, pass it the configuration and use the result as the size argument
   of the `contao_figure` function:
   
   ```twig
   {% set special_size = picture_config({
       width: 400,
       height: 400,
       resizeMode: 'proportional',
       sizes: '0.75,1,1.5,2',
       items: [{
           width: 200,
           height: 100,
           media: '(max-width: 140px)',
       }]
   }) %}
   
   {{ contao_figure(uuid, special_size) }}
   ``` 


[Studio]: https://github.com/contao/contao/tree/5.0/core-bundle/src/Image/Studio
[TwigTemplates]: https://github.com/contao/contao/blob/5.0/core-bundle/templates/Image/Studio
[MacroDefinitions]: https://github.com/contao/contao/blob/5.0/core-bundle/templates/Image/Studio/_macros.html.twig
[PropertyAccess]: https://symfony.com/doc/current/components/property_access.html
[SizeArray]: /framework/image-processing/image-sizes/#size-array
[FigureBuilderOptionsReference]: /framework/image-processing/image-studio/#setting-options
