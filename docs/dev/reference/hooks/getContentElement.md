---
title: "getContentElement"
description: "getContentElement hook"
tags: ["hook-controller"]
---

The `getContentElement` hook is triggered when a content element is rendered. 
It passes the database object, the buffer string and the content element object
as arguments and expects a buffer string as return value.


## Parameters

1. *\Contao\ContentModel* `$contentModel`

    Database result set from table `tl_content`.

2. *string* `$buffer`

    The output buffer of the generated content element.

3. *\Contao\ContentElement* `$contentElement`

    The content element instance.


## Return Values

The (modified) content of the content element as a string.


## Example

```php
// src/EventListener/GetContentElementListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\ContentElement;
use Contao\ContentModel;
use Terminal42\ServiceAnnotationBundle\ServiceAnnotationInterface;

class GetContentElementListener implements ServiceAnnotationInterface
{
    /**
     * @Hook("getContentElement")
     */
    public function onGetContentElement(ContentModel $contentModel, string $buffer, ContentElement $contentElement): string
    {
        // Modify or create new $buffer here …

        return $buffer;
    }
}
```


## References

* [\Contao\Controller#L476-L483](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L476-L483)
