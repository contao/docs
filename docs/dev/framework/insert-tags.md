---
title: "Insert Tags"
description: "Integrate specific content into any place in Contao."
aliases:
    - /framework/insert-tags/
---


Insert tags are a Contao specific way to replace specific tokens in your templates
and database fields with content. They follow the format `{{TAG_NAME}}`. In most
cases they contain parameters after the tag name, ie: `{{TAG_NAME::PARAMETERS}}`.

A list of readily available insert tags can be found in the [user manual][UserManualInsertTags].

## Register custom insert tags

{{< version-tag "5.2" >}} Custom insert tags can be registered using the PHP attributes
`AsInsertTag` and `AsBlockInsertTag` or their corresponding service tags
`contao.insert_tag` and `contao.block_insert_tag`. The following options are 
supported for these service tags:

| Option              | Description                                                                                                                   |
|---------------------|-------------------------------------------------------------------------------------------------------------------------------|
| `name`              | The name of the insert tag. Has to be in lowercase.                                                                           |
| `resolveNestedTags` | `true` will resolve all nested tags before passing it to the method. `false` will keep nested tags unreplaced.                |
| `priority`          | For multiple insert tags with the same name only the one with the highest priority will be executed.                          |
| `method`            | Will default to `__invoke` or the name of the method the attribute is attached to. Otherwise a method name has to be defined. |
| `asFragment`        | If enabled the insert tag will be rendered as a fragment via an `<esi>` tag. Only for regular (not block) insert tags.        |
| `endTag`            | The name of the end tag. Has to be in lowercase. Only for block insert tags.                                                  |

The following example will provide an insert tag which transforms a string with
the `str_rot13` function provided by PHP.

```php
// src/InsertTags/Rot13InsertTag.php
namespace App\InsertTags;

use Contao\CoreBundle\DependencyInjection\Attribute\AsInsertTag;
use Contao\CoreBundle\InsertTag\InsertTagResult;
use Contao\CoreBundle\InsertTag\OutputType;
use Contao\CoreBundle\InsertTag\ResolvedInsertTag;
use Contao\CoreBundle\InsertTag\Resolver\InsertTagResolverNestedResolvedInterface;

#[AsInsertTag('rot13')]
class Rot13InsertTag implements InsertTagResolverNestedResolvedInterface
{
    public function __invoke(ResolvedInsertTag $insertTag): InsertTagResult
    {
        if (null === $insertTag->getParameters()->get(0)) {
            throw new InvalidInsertTagException('Missing parameters for insert tag.');
        }
        
        $parameter = $insertTag->getParameters()->get(0);
        
        $rotated = str_rot13($parameter);
        
        return new InsertTagResult($rotated, OutputType::text);
    }
}
```

Now the insert tag `{{rot13::Contao}}` will be replaced with `Pbagnb`.

An example for a block insert tag can be found in the Contao core bundle: 
[`IfLanguageInsertTag`][IfLanguageInsertTag].

### `InsertTag` and `InsertTagParameters` objects

An insert tag resolver gets an `InsertTag` object passed, either as `ParsedInsertTag` 
or as `ResolvedInsertTag` depending on the `resolveNestedTags` attribute setting.
A _parsed_ insert tag can still include other nested insert tags in its parameters
while in a _resolved_ insert tag all parameters are directly available. For an
insert tag like `{{tag::foo{{nested}}bar}}` these objects would look like:

```php
/** @var ResolvedInsertTag $tag */
$tag->getParameters()->get(0); // "foonestedbar"

/** @var ParsedInsertTag $tag */
$tag->getParameters()->get(0); // object(ParsedSequence)
$tag->getParameters()->get(0)->get(0); // "foo"
$tag->getParameters()->get(0)->get(1); // object(ParsedInsertTag)
$tag->getParameters()->get(0)->get(2); // "bar"
```

The parameters objects can be used to access named, scalar or array parameters if 
desired:

```php
// {{tag::key=value}}
$tag->getParameters()->get('key'); // "value"
$tag->getParameters()->get(0); // "key=value"

// {{tag::key=value1::key=value2}}
$tag->getParameters()->all('key'); // ["value1", "value2"]

// {{tag::int=1::float=1.2::string=value}}
$tag->getParameters()->getScalar('int'); // 1
$tag->getParameters()->getScalar('float'); // 1.2
$tag->getParameters()->getScalar('string'); // "value"
```


## Register custom insert tag flags

{{< version-tag "5.2" >}} Custom [insert tag flags][InsertTagFlags] can be registered
using the PHP attribute `AsInsertTagFlag` or the corresponding service tag
`contao.insert_tag_flag`. The following options are supported for this service tag:

| Option              | Description                                                                                                                   |
|---------------------|-------------------------------------------------------------------------------------------------------------------------------|
| `name`              | The name of the insert tag flag. Has to be in lowercase.                                                                      |
| `priority`          | For multiple insert tag flags with the same name only the one with the highest priority will be executed.                     |
| `method`            | Will default to `__invoke` or the name of the method the attribute is attached to. Otherwise a method name has to be defined. |

The following example will provide an insert tag flag which transforms the output
of the tag or the previous flag with the `str_rot13` function provided by PHP.

```php
// src/InsertTags/Rot13InsertTagFlag.php
namespace App\InsertTags;

use Contao\CoreBundle\DependencyInjection\Attribute\AsInsertTagFlag;
use Contao\CoreBundle\InsertTag\InsertTagResult;
use Contao\CoreBundle\InsertTag\OutputType;
use Contao\CoreBundle\InsertTag\ResolvedInsertTag;
use Contao\CoreBundle\InsertTag\Flag\InsertTagFlagInterface;

#[AsInsertTagFlag('rot13')]
class Rot13InsertTagFlag implements InsertTagFlagInterface
{
    public function __invoke(InsertTagFlag $flag, InsertTagResult $result): InsertTagResult
    {
        return $result
            ->withValue(str_rot13($result->getValue()))
            ->withOutputType(OutputType::text) // Switch to text here as rot13 results in unsafe HTML.
        ;
    }
}
```

Now the insert tag `{{label::MSC:reset|rot13}}` will be replaced with `Erfrg`.


## Formal syntax (EBNF)

The formal syntax of insert tags is defined as follows:

```bnf
   InsertTag ::= "{{" Name Parameter * Flag * "}}"
        Name ::= [a-z#x80-#xFF] [a-z0-9_#x80-#xFF] *
   Parameter ::= "::" ( KeyValuePair | Value )
        Flag ::= "|" [^{}|] *
KeyValuePair ::= Key "=" Value
         Key ::= [^{}|=] *
       Value ::= ( [^{}|] | InsertTag ) *
```


## Create a custom Insert Tag hook

{{% notice note %}}
This section applies to Contao versions prior to **5.2**. For later versions use the
attributes mentioned above instead.
{{% /notice %}}

Custom insert tags can be replaced by creating a service tagged with the `contao.hook`
tag and registering a specific Hook. This service will be called whenever the replacement 
takes place for each occurring insert tag. This means, you will need to filter out 
the specific tag you want to process yourself.

The following example will provide an insert tag which transforms a string with
the `str_rot13` function provided by PHP. It registers the [`replaceInsertTags`][ReplaceInsertTagsHook]
hook using PHP attributes:

```php
// src/EventListener/Rot13InsertTagListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

#[AsHook('replaceInsertTags')]
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


## Cache behaviour of legacy insert tags

{{% notice note %}}
This section applies to Contao versions prior to **5.2**. For later versions take
a look at the setting `asFragment` from above.
{{% /notice %}}

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

[InsertTagFlags]: https://docs.contao.org/manual/en/article-management/insert-tags/#insert-tag-flags
[IfLanguageInsertTag]: https://github.com/contao/contao/blob/5.x/core-bundle/src/InsertTag/Resolver/IfLanguageInsertTag.php
[ReplaceInsertTagsHook]: /reference/hooks/replaceInsertTags/
[FrameworkHooks]: /framework/hooks/
[UserManualInsertTags]: https://docs.contao.org/manual/en/article-management/insert-tags/
