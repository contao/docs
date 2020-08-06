---
title: "listComments"
description: "listComments hook"
tags: ["hook-comment", "hook-backend", "hook-dca"]
aliases:
    - /reference/hooks/listComments/
    - /reference/hooks/listcomments/
---


The `listComments` hook is triggered when listing comment from unknown source in
the back end. It passes the current record as argument and expects a string as
return value.


## Parameters

1. *array* `$comment`

    The current comment record data.


## Return Values

Return a string representing your comment, or an empty string if your method is not
responsible for the source table.


## Example

```php
// src/EventListener/ListCommentsListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("listComments")
 */
class ListCommentsListener
{
    public function __invoke(array $comment): string
    {
        if ('tl_mytable' === $comment['source']) {
            return '<a href="contao/main.php?do=…">' . $comment['title'] . '</a>';
        }

        return '';
    }
}
```


## References

* [\tl_comments.php#L558-L573](https://github.com/contao/contao/blob/4.7.6/comments-bundle/src/Resources/contao/dca/tl_comments.php#L558-L573)
