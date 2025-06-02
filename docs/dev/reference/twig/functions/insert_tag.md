---
title: insert_tag - Twig Function
linkTitle: insert_tag
description: Allows you to render an insert tag directly.
tags: [Twig]
---

The `insert_tag` function allows you to process a single [insert tag]({{% ref "insert-tags" %}}) within your Twig
template. This can be useful for executing specific functionalities that are only exposed via the insert tag system.

```twig
{# Insert a page URL #}
<a href="{{ insert_tag('link_url::10') }}">{{ insert_tag('link_title::10') }}</a>

{# Insert an article #}
<p>{{ insert_tag('insert_article::123')|raw }}</p>
```

## Arguments

* `insertTag`: The insert tag with all its arguments and filters (but without the curly braces).
