---
title: highlight_auto - Twig Filter
linkTitle: highlight_auto
description: Automaic syntax highlighting via highlight.php.
tags: [Twig]
---

This Twig filter creates server-side syntax highlighting of the given code via 
[highlight.php](https://github.com/scrivo/highlight.php). It works the same way as the
[`highlight` filter]({{% relref "highlight" %}}), except the programming language will be autodetected.

```twig
{# code contains some C++ code #}
{% set highlighted = code|highlight_auto %}
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
