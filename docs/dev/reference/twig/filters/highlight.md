---
title: highlight - Twig Filter
linkTitle: highlight
description: Syntax highlighting via highlight.php.
tags: [Twig]
---

This Twig filter creates server-side syntax highlighting of the given code via 
[highlight.php](https://github.com/scrivo/highlight.php). It takes the name of the programming language to create syntax
highlighting for as an argument. If no language is given, `plaintext` is used by default.

This filter is used in the _Code_ content element for example.

```twig
{# code contains some PHP code #}
{% set highlighted = code|highlight('php') %}
{% set code_attributes = attrs()
    .addClass('hljs')
    .addClass(highlighted.language)
%}
<pre><code{{{ code_attributes }}>
    {{- highlighted.value|raw -}}
</code></pre>
```

_Note:_ the filter returns a `Contao\CoreBundle\Twig\Runtime\HighlightResult` instance, which is just a thin wrapper for
`Highlight\HighlightResult`, adding a `__toString()` method, so that you can also use `{{ highlighted|raw }}`.
