---
title: escape - Twig Filter
linkTitle: escape
description: The escape filter escapes a string using strategies that depend on the context.
tags: [Twig]
---

Contao overrides [Twig's default `escape` filter](https://twig.symfony.com/doc/3.x/filters/escape.html) in order to
support `ChunkedText` from [insert tags]({{% ref insert-tags %}}) and to employ its own escaper strategies. The latter
is important due to Contao using input encoding by default which would then lead to double encoded output when rendering
content in Twig. 

```twig
{# Outputs &gt; i.e. without double encoding #}
{{ '&gt;'|e }}
```

This is only applied to templates within the `@Contao` and `@Contao_*` namespaces.

{{< version "5.3.19" >}}

You can opt into double encoding by passing `double_encode = true` to the escape filter, which is necessary if you have
HTML code nested in another language.

```twig
{# Outputs &amp;gt; i.e. with double encoding #}
{{ '&gt;'|e('html', doubl_encode = true) }}
```

You can find more information in the double encoding section of the
[Twig architecture]({{% ref "architecture#double-encoding-prevention" %}}) article.
