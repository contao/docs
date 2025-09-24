---
title: format_bytes - Twig Filter
linkTitle: format_bytes
description: Converts bytes to a human readable format.
tags: [Twig]
---

{{< version "5.0" >}}

The `format_bytes` filter converts a number representing bytes into a human readable format like "128.0 MiB".

```twig
{# Outputs "128.0 MiB" #}
{{ 134217728|format_bytes }}
```

You can also adjust how many decimal places will be output.

```twig
{# Outputs "128.7 MiB" #}
{{ 135000000|format_bytes }}

{# Outputs "128.75 MiB" #}
{{ 135000000|format_bytes(2) }}

{# Outputs "128.746 MiB" #}
{{ 135000000|format_bytes(3) }}
```

Internally this functions calls `Contao\System::getReadableSize()` and uses the `MSC.decimalSeparator`,
`MSC.thousandsSeparator` and `UNITS.*` labels from the `contao_default` translation domain, where `UNITS.0` starts with
"bytes", then `UNITS.1` is "KiB" etc. Thus if you adjust the translations to

```yaml
# translations/contao_default.en.yaml
UNITS:
    1: KB
    2: MB
    3: GB
    4: TB
    5: PB
    6: EB
    7: ZB
    8: YB
```

then the output of `{{ 134217728|format_bytes }}` will be "128.0 MB" instead.

## Arguments

* `decimals`: The number of decimal places to show (default: `1`).
