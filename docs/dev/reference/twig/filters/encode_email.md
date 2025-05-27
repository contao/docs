---
title: encode_email - Twig Filter
linkTitle: encode_email
description:
tags: [Twig]
---

{{< version "5.2" >}}

This filter encodes a given email address with HTML entities, similar to the `{{email_url::*}}` insert tag. Just as the
insert tag this filter calls `Contao\StringUtil::encodeEmail()` internally.

```twig
{# Renders the email as HTML entities #}
{{ 'foobar@example.com'|encode_email }}
```
