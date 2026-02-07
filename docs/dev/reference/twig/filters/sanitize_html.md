---
title: sanitize_html - Twig Filter
linkTitle: sanitize_html
description: Sanitizes HTML code using a pre-configured Symfony sanitizer.
tags: [Twig]
---

{{< version "5.1" >}}

Contao overrides [Symfony's default `sanitize_html` filter](https://symfony.com/doc/current/html_sanitizer.html#sanitizing-html-in-twig-templates) 
in order to also sanitize Contao-specific special characters like insert tags.

## Default sanitizer

The default sanitizer is configured in `framework.html_sanitizer.sanitizer.default` and allows all "safe" elements and 
attributes, as defined by the [W3C Standard Proposal](https://wicg.github.io/sanitizer-api/). You can find more 
information about it in the [Symfony documentation](https://symfony.com/doc/current/html_sanitizer.html).

```twig
{{ '<div title=test style=color:red onclick=alert(1)><script>alert(2)</script>{{date::Y}}'|sanitize_html }}
{# Output: #} <div title="test">&#123;&#123;date::Y&#125;&#125;</div>
```

{{% notice "info" %}}
Use the `default` sanitizer for HTML code that comes from external sources.
{{% /notice %}}

{{< version "5.7" >}}

## Contao sanitizer

If you use the filter with the `'contao'` sanitizer the HTML code is sanitized according to the rules configured in the
security section in the Contao system settings. Insert tags do not get encoded and unclosed tags do not get 
automatically closed in this case.

```twig
{{ '<div title=test style=color:red onclick=alert(1)><script>alert(2)</script>{{date::Y}}'|sanitize_html('contao') }}
{# Output: #} <div title="test" style="color:red">&#60;script&#62;alert(2)&#60;/script&#62;{{date::Y}}
```

{{% notice "info" %}}
Use the `contao` sanitizer for HTML code that comes from the Contao backend, e.g. from a tinyMCE editor.
{{% /notice %}}
