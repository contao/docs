---
title: "Insert Tags"
---

Insert tags are a Contao specific way to replace specific tokens in your templates
and database fields with content. They follow the format `{{TAG_NAME}}`. In most
cases they contain a payload after the tag name, ie: `{{TAG_NAME::PAYLOAD}}`.

A list of readily available insert tags can be found in the user manual.

{{% notice info %}}
Insert tags will not be cached. Its code is therefore executed on each page load.
Be sure to avoid resource heavy operations in these callbacks.
{{% /notice %}}


## Create a custom Insert Tag

Custom Insert Tags can be replaced by creating a service tagged with the `contao.hooks`
tag. This service will be called whenever the replacement takes place for each
occurring insert tag. This means, you will need to filter out the specific tag
you want to process yourself.

The following example will provide an Insert Tag which transforms a string with
the `str_rot13` function provided by PHP. The first thing is to create a
listener class in `App\EventListener`.

```php
<?php

declare(strict_types=1);

namespace App\EventListener;

class Rot13InsertTagListener
{
    public const TAG = 'rot13';
    
    public function onReplaceInsertTags(string $tag)
    {
        $chunks = explode('::', $tag);

        if (self::TAG !== $chunks[0]) {
            return false;
        }
        
        return str_rot13($chunks[1]);
    }
}
```

Afterwards, this service is tagged with the tag `contao.hook`.

You can either provide the `method` key containing the name of the invoked method
or rely on the given naming convention, which will call the method `onReplaceInsertTags`
if possible. The two possibilities are listed below.

```yml
# Use the naming convention
services:
    App\EventListener\Rot13InsertTagListener:
        public: true
        tags:
            - { name: contao.hook, hook: replaceInsertTags }
```

```yml
# Specifiy the invoked method
services:
    App\EventListener\Rot13InsertTagListener:
        public: true
        tags:
            - { name: contao.hook, hook: replaceInsertTags, method: myMethod }
```
