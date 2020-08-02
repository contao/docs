---
title: Test
aliases:
    - /en/test/
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

| Insert-Tag | Description |
| ---------- | ----------- |
| `{{date}}` | This day is replaced with the current date according to the global date format. |
| `{{date::*}}` | This day is replaced with the current date according to an individual date format. Contao supports all date and time formats that can be parsed with the [PHP function date](https://www.php.net/manual/de/function.date.php). `{{date::d.m.Y}}` |
| `{{format_date::*::*}}` | {{< version "4.10" >}} This tag can be used to format a UNIX timestamp or a *standardized date specification*. The first parameter is the timestamp or date. The second parameter is the date format (see `{{date::*}}`) and is optional. If the date format is not specified, the date is output according to the global date format. This tag makes sense in combination with other tags or simple tokens to (re)format the output date or timestamp. Examples: `{{date_format::{{user::tstamp}}::d.m.Y}}`, `{{date_format::##member_dateAdded##}}`. If the date format cannot be recognized automatically, it can be used instead `{{convert_date::*::*::*}}`. |
| `{{convert_date::*::*::*}}` | {{< version "4.10" >}} This tag can be used to reformat a date. The first parameter is the date, the second parameter is its date format (see `{{date::*}}`). The third parameter is the new date format (see `{{date::*}}`) and optional. If the date format is not specified, the date is output according to the global date format. This tag is useful in combination with other tags or simple tokens to reformat the output date. Example: `{{convert_date::##some_date##::Y, j.n.::j. F Y}}` (converts `2020, 12.7.`to `12. Juli 2020`), for example. |
| `{{last_update}}` | This tag is replaced with the date of the last update according to the global date format. |
