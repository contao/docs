---
title: "addComment"
description: "addComment hook"
tags: ["hook-comment"]
aliases:
    - /reference/hooks/addComment/
    - /reference/hooks/addcomment/
---


The `addComment` hook is triggered when a comment is added. It passes the ID of 
the record and the data array as arguments and does not expect a return value.


## Parameters

1. *int* `$commentId`

    ID of the new comment database record (Table `tl_comment`).

2. *array* `$commentData`

    Data of the new comment record (not including the ID).
    
3. *\Contao\Comments* `$comments`

    The instance of the `\Contao\Comments` class that triggered the hook.


## Example

```php
// src/EventListener/AddCommentListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Comments;

class AddCommentListener
{
    /**
     * @Hook("addComment")
     */
    public function onAddComment(int $commentId, array $commentData, Comments $comments): void
    {
        // Do something …
    }
}
```


## References

* [\Contao\Comments#L371-L379](https://github.com/contao/contao/blob/4.7.6/comments-bundle/src/Resources/contao/classes/Comments.php#L371-L379)
