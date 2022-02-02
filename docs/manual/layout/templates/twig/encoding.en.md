---
title: "Encoding / Escaping"
description: "Encoding and Escaping information."
aliases:
    - /en/layout/templates/twig/encoding/
weight: 70
---


For historic reasons Contao uses *input* encoding, but Twig embraces the more
sane *output* encoding. You can read more about the topic (and why you should
favor output encoding) in this [OWASP article](https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html#rule-0-never-insert-untrusted-data-except-in-allowed-locations) about preventing Cross Site Scripting (XSS) attacks.


## Why you should care

The gist: You, as a template designer, have to decide how things should be
output, because *you* know the context and which content you trust or not. The
*exact same* data can be dangerous in one context and harmless in another:

With Twig we can be specific how a certain variable should be treated. Use the `|escape` or - short - `|e` 
[filter](https://twig.symfony.com/doc/3.x/filters/escape.html) for this:

```twig
<style>
  .box { background: {{ color|e('css') }} }
</style>

[…]

<div class="box">{{ color|e('html') }}</div>
```

{{% notice note %}}
By default Twig encodes **all** variables. The chosen escaper
strategy will depend on the template's file extension: your `.html.twig`
templates will automatically get the `|e('html')` treatment, so you could omit
this part in the above example.
{{% /notice %}}


## Trusted raw data

If you intentionally **do** want to output a variable containing raw HTML, like 
`<b>nice</b>`, you need to add the `|raw` escaper filter to your variable which tells Twig to skip escaping this value.
Otherwise `&lt;b&gt;nice&lt;/b&gt;` will be output, i.e. a text saying *&lt;b&gt;nice&lt;/b&gt;* and not a bold word <b>nice</b>. 

{{% notice warning %}}
Keep in mind, that you only ever add `|raw` to trusted input! Using `|raw` on 
anything else may result in severe XSS vulnerabilities!
{{% /notice %}}