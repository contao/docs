---
title: escape - Twig Filter
linkTitle: escape
description: The escape filter escapes a string using strategies that depend on the context.
tags: [Twig]
---

Contao overrides [Twig's default `escape` filter](https://twig.symfony.com/doc/3.x/filters/escape.html) in order to
support `ChunckedText` from [insert tags]({{% ref insert-tags %}}) and its escaper strategies.
