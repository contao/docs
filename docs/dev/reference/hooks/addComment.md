---
title: "addComment"
description: "addComment hook"
tags: ["hook-comment"]
---

The `addComment` hook is triggered when a comment is added. It passes the ID of 
the record and the data array as arguments and does not expect a return value.

## Example

```php
// src/App/EventListener/AddCommentListener.php
namespace App\EventListener;

class AddCommentListener
{
    public function onAddComment(int $commentId, array $commentData, \Contao\Comments $comments): void
    {
        // Do something …
    }
}
```

```yml
# config/services.yml
services:
  App\EventListener\AddCommentHook:
    public: true
    tags:
      - { name: contao.hook, hook: addComment, method: onAddComment }
```

## References

* [\Contao\Comments#L371-L379](https://github.com/contao/contao/blob/4.7.6/comments-bundle/src/Resources/contao/classes/Comments.php#L371-L379)
