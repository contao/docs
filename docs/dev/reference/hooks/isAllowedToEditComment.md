---
title: "isAllowedToEditComment"
description: "isAllowedToEditComment hook"
tags: ["hook-comment", "hook-backend", "hook-dca"]
---


The `isAllowedToEditComment` hook is triggered to determine permission on a
comment from unknown source in the back end. It passes the comment parent ID and
source table and expects a boolean as return value.


## Parameters

1. *int* `$parentId`

    The parent record ID.

2. *string* `$parentTable`

    The parent table name.


## Return Values

If you return `true`, access to the comment is granted. Return `false` if access
is prohibited or your function is not responsible for this comment.


## Example


```php
// src/EventListener/IsAllowedToEditCommentListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

class IsAllowedToEditCommentListener
{
    /**
     * @Hook("isAllowedToEditComment")
     */
    public function onIsAllowedToEditComment(int $parentId, string $parentTable): bool
    {
        // Check the access to your custom module
        if (\Contao\BackendUser::getInstance()->hasAccess('custom', 'modules')) {
            return true;
        }

        return false;
    }
}
```

## References

* [\tl_comments#L457-L472](https://github.com/contao/contao/blob/4.7.6/comments-bundle/src/Resources/contao/dca/tl_comments.php#L457-L472)
