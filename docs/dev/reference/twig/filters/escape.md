---
title: escape - Twig Filter
linkTitle: escape
description: The escape filter escapes a string using strategies that depend on the context.
tags: [Twig]
---

Contao overrides [Twig's default `escape` filter](https://twig.symfony.com/doc/3.x/filters/escape.html) to employ its
own escaper strategies. 

## Double Encoding Prevention

As mention in other sections, Contao uses input encoding by default which would then lead to double encoded output when
rendering content in Twig. Contao overrides this behavior for templates within the `@Contao` and `@Contao_*` namespaces.

```twig
{# Outputs &gt; i.e. without double encoding #}
{{ '&gt;'|e }}
```

You can find more information in the double encoding section of the
[Twig architecture]({{% relref "architecture#double-encoding-prevention" %}}) article.
