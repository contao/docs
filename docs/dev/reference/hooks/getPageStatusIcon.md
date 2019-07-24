---
title: "getPageStatusIcon"
description: "getPageStatusIcon hook"
tags: ["hook-page", "hook-controller"]
---

The `getPageStatusIcon` hook is triggered when the appropriate page status icon 
is calculated. It passes the database result object and the file name of the 
current icon as arguments and expects a file name as return value. 


## Parameters

1. *object* `$page`

	Database result set from table `tl_page`. Could be `\Contao\PageModel`, 
    `\Contao\Database\Result`, or `\stdClass`.

2. *string* `$image`

	The file name of the default status icon calculated by Contao.


## Return Value

You must always return a file name, which can be either a custom file name or 
the unchanged second parameter. 


## Example

```php
// src/App/EventListener/GetPageStatusIconListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class GetPageStatusIconListener
{
    /**
     * @Hook("getPageStatusIcon")
     */
    public function onGetPageStatusIcon(object $page, string $image): string
    {
        if ('my_page' === $page->type) {
            return 'path/to/custom_icon.svg';
        }

        return $image;
    }
}
```


## Reference

* [\Contao\Controller#L614-L621](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/library/Contao/Controller.php#L614-L621)
