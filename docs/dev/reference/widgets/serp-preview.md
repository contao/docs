---
title: SERP Preview
description: Search Engine Results Page (SERP) preview widget.
---

This widget shows the preview of how a search engine might render the title and description of the URL for the current
record.

![Search Engine Results Page Preview]({{% asset "images/dev/reference/widgets/serp-preview.png" %}}?classes=shadow)

Within Contao this is used within the settings of pages, news, events and FAQ entries. You can integrate this also into
your own DCA - the widget provides settings with which you can configure how it retrieves the relevant data.

## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a [full field reference]({{% relref "reference/dca/fields" %}}).

| Key   | Value | Description
| ----- | ----- | -----------
| `inputType` | `serpPreview` | |
| `titleFields` | `array` | An array of title fields from which the title should be taken. The first non-empty value will be used. |
| `descriptionFields` | `array` | An array of description fields from which the meta descriptions should be taken. The first non-empty value will be used. |
| `title_tag_callback` | `function\|callable` | A callback function that returns the format (including placeholders) of the title tag - e.g. `'%s - Example Website'` where `%s` will be replaced by the record's title via the widget's JavaScript. This is optional and by default only the title of the record will be displayed. |
| `url_callback` | `function\|callable` | A callback function that returns the URL for the given record. This is optional and by default the [Content URL Generator]({{% relref "content-routing" %}}) is executed. |

## Example

```php
// …
'serpPreview' => [
    'inputType' => 'serpPreview',
    'eval' => [
        'title_tag_callback' => static fn (): string => '%s - Example Website',
        'titleFields' => ['pageTitle', 'headline'],
        'descriptionFields' => ['description', 'teaser'],
    ],
    'sql' => null,
],
// …
```

_Note:_ this hardcodes the format of the title tag, but ideally you would figure out the format of the title tag based
on the layout that this record will likely be rendered under, if possible.
