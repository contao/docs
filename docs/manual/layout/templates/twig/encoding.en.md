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

{{% notice note %}}Hall
By default Twig encodes **all** variables. The chosen escaper strategy will depend on the template's file extension: your `.html.twig`
templates will automatically get the `|e('html')` treatment, so you could omit this part in the above example.
{{% /notice %}}

You can mark a whole section of a template to be escaped or not by using the [autoescape](https://twig.symfony.com/doc/3.x/tags/autoescape.html) tag.


## Trusted content

If you want to intentionally output a variable that contains HTML, you must add the 
[Filter](https://twig.symfony.com/doc/3.x/filters/raw.html) `|raw` to the variable. Remember that you should always use `|raw` only in 
connection with trusted content. However, in connection with input via the TinyMCE editor in the backend, you can use the `|raw` filter in 
this particular case.

Example: The content element of type "Text" contains the following entry `<p>My<br>Text</p>`:

```twig
{% extends "@Contao/content_element/text.html.twig" %}

{% block content %}

  {# encode #}
  {{ text }}

  {# do not encode #}
  {{ text|raw }}

{% endblock %}
```


### Twig Filter and Insert Tags

In content elements, for example of the "type" text, [insert tags](/en/article-management/insert-tags/) may be used. For this purpose the 
additional filters `|insert_tag` and `|insert_tag_raw` are provided.

Example: The content element of type "Text" contains the following entry (with the insert tag `{br}}`): `<p>My<br>Text{{br}}Demo</p>`. 
You can use these Twig filters to target the output:

```twig
{% extends "@Contao/content_element/text.html.twig" %}

{% block content %}

  {{ text }}
  {# Do not replace insert tags, encode #}
  {# yields: "&lt;p&gt;My&lt;br&gt;Text{{br}}Demo&lt;/p&gt;" #}

  {{ text|raw }}
  {# Do not replace insert tags, do not encode #}
  {# yields: "<p>My<br>Text{{br}}Demo</p>" #}

  {{ text|insert_tag }}
  {# Replace insert tags, encode everything #}
  {# yields: "&lt;p&gt;My&lt;br&gt;Text&lt;br&gt;Demo&lt;/p&gt;" #}

  {{ text|insert_tag_raw }}
  {# Replace insert tags, but *only* encode the text around #}
  {# yields: "&lt;p&gt;My&lt;br&gt;Text<br>Demo&lt;/p&gt;" (note the intact "<br>") #}

  {{ text|insert_tag|raw }}
  {# Replace insert tags, do not encode #}
  {# yields: "<p>My<br>Text<br>Demo</p>" #}

{% endblock %}
```