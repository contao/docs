---
title: "Image Size"
description: Allows to define an output size for images.
---


This widget renders a drop down and two input fields for defining the output size of images. Typically you can select
a resize method in the drop down and define the width and/or height in the text fields - or you can select a predefined
image size in the drop down instead.

![Image size widget]({{% asset "images/dev/reference/widgets/image-size.png" %}}?classes=shadow)

The predefined sizes originate either from the application configuration ("Predefined dimensions") or the theme.


## Options

This widget does not have any special options. See the DCA reference for a [full field reference](../../dca/fields).

The options for the drop down are automatically retrieved from the `contao.image.sizes` service 
(`Contao\CoreBundle\Image\ImageSizes`). However, you can still override these options via your own 
[`options_callback`](../../dca/callbacks#fields-field-options):

```php
// src/EventListener/DataContainer/ContentImageSizeOptionsListener.php
namespace App\EventListener\DataContainer;

use Contao\BackendUser;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\CoreBundle\Image\ImageSizes;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[AsCallback('tl_content', 'fields.size.options')]
class ContentImageSizeOptionsListener
{
    public function __construct(
        private readonly ImageSizes $imageSizes,
        private readonly TokenStorageInterface $tokenStorage,
    ) {
    }

    public function __invoke(): array
    {
        if (!($user = $this->tokenStorage->getToken()?->getUser()) instanceof BackendUser) {
            return [];
        }

        $options = $user->admin ? 
            $this->imageSizes->getAllOptions() : 
            $this->imageSizes->getOptionsForUser($user)
        ;

        // Remove the "proportional" image resizing method
        if (false !== ($i = array_search('proportional', $options['custom'], true))) {
            unset($options['custom'][$i]);
        }

        return $options;
    }
}
```


## Example

```php
// ...
'size' => [
    'exclude'   => true,
    'inputType' => 'imageSize',
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval'      => [
        'rgxp' => 'natural',
        'includeBlankOption' => true,
        'nospace' => true,
        'tl_class' => 'w50',
    ],
    'sql'       => [
        'type' => 'string',
        'length' => 128,
        'default' => '',
        'customSchemaOptions' => ['collation' => 'ascii_bin'],
    ],
],
// ...
```


## Usage in Contao

The image size widget is used very often in contao. Examples are the text, image and gallery content elements. The
widget stores a serialized [image size array][ImageSizeArray] in the database which can then be used to resize images
in your controller for example.

[ImageSizeArray]: /framework/image-processing/image-sizes#size-array
