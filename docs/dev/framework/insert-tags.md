---
title: "Insert Tags"
description: "Integrate specific content into any place in Contao."
aliases:
    - /framework/insert-tags/
---


Insert tags are a Contao specific way to replace specific tokens in your templates
and database fields with content. They follow the format `{{TAG_NAME}}`. In most
cases they contain a payload after the tag name, ie: `{{TAG_NAME::PAYLOAD}}`.

A list of readily available insert tags can be found in the [user manual][UserManualInsertTags].


## Create a custom Insert Tag

Custom insert tags can be replaced by creating a service tagged with the `contao.hook`
tag and registering a specific Hook. This service will be called whenever the replacement 
takes place for each occurring insert tag. This means, you will need to filter out 
the specific tag you want to process yourself.

The following example will provide an insert tag which transforms a string with
the `str_rot13` function provided by PHP. It registers the [`replaceInsertTags`][ReplaceInsertTagsHook]
hook using service annotation:

```php
// src/EventListener/Rot13InsertTagListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * @Hook("replaceInsertTags")
 */
class Rot13InsertTagListener
{
    public const TAG = 'rot13';
    
    public function __invoke(string $tag)
    {
        $chunks = explode('::', $tag);

        if (self::TAG !== $chunks[0]) {
            return false;
        }
        
        return str_rot13($chunks[1]);
    }
}
```

Creating this file while using the `Hook` service annotation within is all you have
to do in Contao **4.9** and upwards. See the [framework article][FrameworkHooks] 
about Hooks on how to implement this Hook in previous Contao versions.

The Hook provides many additional parameters. See the [reference article][ReplaceInsertTagsHook]
for this Hook for more information about the possible parameters.


## Cache behaviour

Generally, replaced insert tags will be cached and stored in the public cache.
However, there are some exemptions worth noting.

The following tags will not be stored in the public cache, since they do not contain
data suitable for caching.

* `date`
* `ua`
* `post`
* `back`
* `referer`
* `request_token`

Furthermore, if a tag starts with `cache_` or has the flag `uncached` it will be
converted to a private ESI response, and is therefore not cached publicly.

If the custom insert tag mentioned above should be exempted from the public cache
add the `uncached` flag whenever used.

```html
<div>{{rot13::Payload|uncached}}</div>
```

{{% notice warning %}}
Using the `uncached` flag is deprecated and doesn’t work in Contao 5.0 anymore. Use the `{{fragment::*}}` insert tag instead.
{{% /notice %}}

[ReplaceInsertTagsHook]: /reference/hooks/replaceInsertTags/
[FrameworkHooks]: /framework/hooks/
[UserManualInsertTags]: https://docs.contao.org/manual/en/article-management/insert-tags/
