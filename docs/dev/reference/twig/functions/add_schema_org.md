---
title: add_schema_org - Twig Function
linkTitle: add_schema_org
description: Adds JSON-LD metadata to the current page.
tags: [Twig]
---

With this function you can add JSON-LD metadata to the current page. The function takes an array containing
[Schema.org](https://schema.org) data such as:

```php
[
    '@type' => 'Event',
    'identifier' => '#/schema/events/123',
    'name' => 'Foobar',
    'startDate' => '2025-04-22T12:12:12P',
]
```

The above example uses the [`Event`](https://schema.org/Event) Schema.org Type. Using Twig's `do` tag you could do:

```twig
{% do add_schema_org({
    '@type': 'Events',
    'identifier': '#/schema/events/' ~ id,
    'name': title,
    'startDate': startTime|date('Y-m-d\TH:i:sP'),
}) %}
```

Though typically you will want your controller to prepare said data.

When it comes to files Contao can automatically generate the appropriate JSON-LD metadata for your. For this the classes
`FilesystemItem` from the [virtual file system]({{% ref "virtual-filesystem" %}}), the legacy `FilesModel` as well as
the `Figure` classes have appropriate getters for that.

```twig
{# Add metadata from a FilesystemItem #}
{% do add_schema_org(file.schemaOrgData|default) %}

{# Add metadata from a Figure #}
{% do add_schema_org(figure.schemaOrgData|default) %}
```

## Arguments

* `jsonLd`: An array containing JSON-LD metadata.
