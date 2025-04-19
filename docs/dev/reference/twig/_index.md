---
title: Twig
description: Developer Reference for Twig functions, filters and globals.
tags: [Twig]
---

This documents the Twig functions, filters and globals provided by Contao.

## The Contao Global

Contao provides its own `contao` Twig global.

```twig
{# Provides the `PageModel` of the current page #}
{% set page = contao.page %}
{{ contao.page.title }}

{# Check in the front end whether a back end user is present in the current session #}
{% if contao.has_backend_user %}…{% endif %}

{# Check whether the "preview mode" (i.e. show hidden elements) is active #}
{% if contao.is_preview_mode %}…{% endif %}

{# Outputs a request token for forms #}
{{ contao.request_token }}

{# Gives access to the back end user in the front end, if available #}
{% set backendUser = contao.backend_user %}
```

{{% children depth="2" %}}
