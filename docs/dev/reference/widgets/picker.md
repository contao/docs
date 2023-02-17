---
title: "Picker"
description: General purpose picker.
---

This widget allows you to pick elements from arbitray data containers. The selected element will then be rendered in its back end view.

This is used to pick a record for the "Content element" content element for example:

![A content element picker](../images/picker_content_element.png?classes=shadow)

When picking the element, a back end view will be rendered in the popup which allows you to switch between page articles, news articles,
calendars etc. where you will be able to go into one of the parents to select a content element from there. The preview is then rendered via 
the `child_record_callback` of `tl_content` in this case.

You could also select news articles for example:

![A news article picker](../images/picker_news.png?classes=shadow)

The picker popup will show you the regular back end view of the news archives in this case which allows you to then select a news article
from any of these archives.


## Options

This table only shows the options relevant to the core functionality of this widget. See the DCA reference for a [full field reference](../../dca/fields).

| Key   | Value | Description
| ----- | ----- | --------------- |
| `inputType` | `picker` | |
| `foreignKey` | `string` | Reference another table to pick from (can also be done via `relation`) |
| `relation` | `array` | Reference another table to pick from via `'table' => 'tl_foobar'` |
| `eval.multiple` | true/false (default) `bool` | Set this to true if you want to be able to select multiple values. |


## Column Definition

Depending on the widget configuration, the widget persists different values to the database. You have to take care of the correct SQL column 
definition yourself. A **single** record will be saved as an integer, the primary key reference. **Multiple** selected values are stored as 
a serialized array. Since you do not know the length in advance, a blob column is preferred. 


## Examples

{{< tabs >}}

{{% tab name="News article" %}}

```php
// ...
'myNewsReference' => [
    'label' => ['Referenced news', 'Help text'],
    'inputType' => 'picker',
    'sql' => [
        'type' => 'integer',
        'unsigned' => true,
        'default' => 0,
    ],
    'relation' => [
        'type' => 'hasOne',
        'load' => 'lazy',
        'table' => 'tl_news',
    ],
],
// ...
```

{{% /tab %}}

{{% tab name="Multiple content elements" %}}

```php
// ...
'myContentElements' => [
    'label' => ['Referenced elements', 'Help text'],
    'inputType' => 'picker',
    'eval' => [
        'multiple' => true,
    ],
    'sql' => [
        'type' => 'blob',
        'notnull' => false,
    ],
    'relation' => [
        'type' => 'hasMany',
        'load' => 'lazy',
        'table' => 'tl_content',
    ],
],
// ...
```

{{% /tab %}}

{{< /tabs >}}


## Usage in Contao

This picker is used for content element and article include content element as well as the article teaser content element in order to pick 
and preview the referenced element or article.
