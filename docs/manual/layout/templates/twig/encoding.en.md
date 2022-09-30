---
title: "Encoding / Escaping"
description: "Encoding and Escaping information."
aliases:
    - /en/layout/templates/twig/encoding/
weight: 70
---


For historic reasons Contao uses *input* encoding, but Twig embraces the more sane *output* encoding. You can read more about the topic 
(and why you should favor output encoding) in this [OWASP article](https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html#rule-0-never-insert-untrusted-data-except-in-allowed-locations) about preventing Cross Site Scripting (XSS) attacks.


## Why you should care

The gist: You, as a template designer, have to decide how things should be output, because *you* know the context and which content you 
trust or not. The *exact same* data can be dangerous in one context and harmless in another:

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
By default Twig encodes **all** variables. The chosen escaper strategy will depend on the template's file extension: your `.html.twig`
templates will automatically get the `|e('html')` treatment, so you could omit this part in the above example.
{{% /notice %}}

You can mark a whole section of a template to be escaped or not by using the [autoescape](https://twig.symfony.com/doc/3.x/tags/autoescape.html) tag.


## Trusted raw data

If you intentionally **do** want to output a variable containing raw HTML, you need to add the 
`|raw` [filter](https://twig.symfony.com/doc/3.x/filters/raw.html) to your variable.

In connection with "Contao insert-tags", the filters `|insert_tag` and `|insert_tag_raw` also exist. If you use for example 
a "Contao insert-tag" `{{br}}` within an content element of type "text", you can influence the output with Twig filters.

```twig
{% extends "@Contao/content_element/text.html.twig" %}

{% block content %}

  {# Do not replace insert tags, encode #}
  {{ text }}
  {# yields: "&lt;p&gt;my{{br}}text&lt;/p&gt;" #}

  {# Do not replace insert tags, do not encode  #}
  {{ text|raw }}
  {# yields: "<p>my{{br}}text</p>" #}

  {# Replace insert tags, encode everything #}
  {{ text|insert_tag }}
  {# yields: "&lt;p&gt;my&lt;br&gt;text&lt;/p&gt;"#}

  {# Replace insert tags, but *only* encode the text around the insert tags #}
  {{ text|insert_tag_raw }}
  {# yields: "&lt;p&gt;my<br>text&lt;/p&gt;" (note the intact "<br>") #}

{% endblock %}
```

{{% notice warning %}}
Keep in mind, that you only ever add `|raw` to trusted input! Using `|raw` on anything else may result in severe XSS vulnerabilities!
{{% /notice %}}