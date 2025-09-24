---
title: deserialize - Twig Filter
linkTitle: deserialize
description: Unserializes data from a serialized string.
tags: [Twig]
---

{{< version "5.3.8" >}}

The `deserialize` filter unserializes a string that contains serialized data into an array.

{{% notice "info" %}}
Internally, this filter uses the `Contao\StringUtil::deserialize()` method.
{{% /notice %}}

```twig
{# data will be a ["Foo", "Bar"] array #}
{% set data = 'a:2:{i:0;s:3:"Foo";i:1;s:3:"Bar";}'|deserialize %}

{# outputs the content of "foo" from the serialized array in "bar" #}
{{ (bar|deserialize).foo }}
```
