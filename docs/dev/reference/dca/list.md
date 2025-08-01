---
title: "List"
description: "Definition of how records are listed in the back end."
weight: 2
---


The listing array defines how records are listed. The Contao core engine
supports three different "list view", "parent view" and "tree view".
You can configure various sorting options like filters or the default sorting
order and you can add custom labels.


## Sorting

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['list']['sorting'] = [
    // …
];
```

| Key                   | Value                            | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
|-----------------------|----------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| mode                  | Sorting mode (`integer`)         | **0** Records are not sorted <br>**1** Records are sorted by a fixed field <br>**2** Records are sorted by a switchable field <br>**3** Records are sorted by the parent table <br>**4** Displays the child records of a parent record (see content elements) <br>**5** Records are displayed as tree (see site structure) <br>**6** Displays the child records within a tree structure (see articles module) {{% notice tip %}} Use the constants in `\Contao\DataContainer` class for sorting modes.{{% /notice %}} {{% notice info %}}Before Contao **4.13**  you will need to implement a [child_record_callback](../callbacks#list-sorting-child-record) in **mode 4**, otherwise no records will be shown in backend.{{% /notice %}}                                                                                                                                                                          |
| flag                  | Sorting flag (`integer`)         | **1** Sort by initial letter ascending <br>**2** Sort by initial letter descending <br>**3** Sort by initial two letters ascending <br>**4** Sort by initial two letters descending <br>**5** Sort by day ascending <br>**6** Sort by day descending <br>**7** Sort by month ascending <br>**8** Sort by month descending <br>**9** Sort by year ascending <br>**10** Sort by year descending <br>**11** Sort ascending <br>**12** Sort descending <br><br>{{< version-tag "5.1" >}}<br> **13** Sort by initial letter ascending and descending <br>**14** Sort by initial two letters ascending and descending <br>**15** Sort by day ascending and descending <br>**16** Sort by month ascending and descending <br>**17** Sort by year ascending and descending <br>**18** Sort ascending and descending {{% notice tip %}} Use the constants in `\Contao\DataContainer` class for sorting flags.{{% /notice %}} |
| panelLayout           | Panel layout (`string`)          | **search** show the search records menu <br>**sort** show the sort records menu <br>**filter** show the filter records menu <br>**limit** show the limit records menu. <br>Separate options with comma (= space) and semicolon (= new line) like `sort,filter;search,limit`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| fields                | Default sorting values (`array`) | One or more fields that are used to sort the table.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| headerFields          | Header fields (`array`)          | One or more fields that will be shown in the [header element]({{< asset "images/dev/reference/mode_parent_header.png" >}}) (sorting mode 4 only).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   |
| icon                  | Tree icon (`string`)             | Path to an icon that will be shown on top of the tree (sorting mode 5 and 6 only).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  |
| root                  | Root nodes (`array`)             | IDs of the root records (pagemounts). This value usually takes care of itself.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |
| rootPaste             | true/false (`bool`)           | Enable paste buttons at root level. (default: false)                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
| filter                | Query filter (`array`)           | Allows you to add custom filters as arrays, e.g. `[['status=?', 'active'], ['usages>?', 0]]`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       |
| disableGrouping       | true/false (`bool`)           | Allows you to disable the group headers in list view and parent view.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| defaultSearchField    | Field name (`string`)           | {{< version-tag "5.1" >}} Set a default search field for the search records menu instead of selecting the alphabetically first field.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| [paste_button_callback](../callbacks#list-sorting-paste-button) | Callback function (`array`)      | These functions will be called instead of displaying the default paste buttons. Please specify as `['Class', 'Method']` or use an anonymous function.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| [child_record_callback](../callbacks#list-sorting-child-record) | Callback function (`array`)      | These functions must be specified to render the child elements (sorting mode 4 only). Please specify as `['Class', 'Method']` or use an anonymous function.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| [header_callback](../callbacks#list-sorting-header) | Callback function (`array`) | These functions will be called when the header fields (sorting mode 4 only) are created. Please specify as `['Class', 'Method']` or use an anonymous function.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      |
| [panel_callback](../callbacks#list-sorting-panel-callback-subpanel) | Callback function (`array`) | This callback allows you to inject HTML for custom panels. Please specify as `['Class', 'Method']` or use an anonymous function.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
| child_record_class    | CSS class (`string`)             | Allows you to add a CSS class to the parent view elements.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          |

{{% notice tip %}}
{{< version-tag "4.13" >}} The `Contao\DataContainer` class provides constants for the various sorting modes and flags, e.g.

```php
// Displays the child records of a parent record (see content elements)
'mode' => Contao\DataContainer::MODE_PARENT, // 4

// Records are displayed as tree (see site structure)
'mode' => Contao\DataContainer::MODE_TREE, // 5

//Sort by initial letter ascending
'flag' => Contao\DataContainer::SORT_INITIAL_LETTER_ASC, // 1

// Sort by initial letter descending
'flag' => Contao\DataContainer::SORT_INITIAL_LETTER_DESC, // 2
```
{{% /notice %}}

## Labels

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['list']['label'] = [
    // …
];
```

| Key            | Value                            | Description                                                                                        |
|----------------|----------------------------------|----------------------------------------------------------------------------------------------------|
| fields         | Fields (`array`)                 | One or more fields that will be shown in the list (e.g. `['title', 'user_id:tl_user.name']`). |
| showColumns    | true/false (`bool`)           | If true Contao will generate a table header with column names (e.g. back end member list)          |
| showFirstOrderBy | true/false (`bool`)           | {{< version-tag "4.13.36" >}} If false Contao will not force the first sorting field to show up in the list. (default: `true`)         |
| format         | Format string (`string`)         | HTML string used to format the fields that will be shown (e.g. `'%s (%s)'`).                       |
| maxCharacters  | Number of characters (`integer`) | Maximum number of characters of the label.                                                         |
| [group_callback](../callbacks#list-label-group) | Callback functions (`array`)     | Call a custom function instead of using the default group header function.                         |
| [label_callback](../callbacks#list-label-label) | Callback functions (`array`)     | Call a custom function instead of using the default label function.                                |


## Operations

The operations are divided into two sections: global operations that relate
to all records at once (e.g. editing multiple records) and regular operations
that relate to a particular record only (e.g. editing or deleting a record).


### Global operations

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['list']['global_operations'] = [
    // …
];
```

| Key             | Value                             | Description                                                                                                        |
|-----------------|-----------------------------------|--------------------------------------------------------------------------------------------------------------------|
| label           | `&$GLOBALS['TL_LANG']` (`string`) | Button label. Typically a reference to the global language array.                                                  |
| href            | URL fragment (`string`)           | URL fragment that is added to the URI string when the button is clicked (e.g. `act=editAll`).                      |
| icon            | Icon (`string`)                   | Path and filename of the icon.                                                                                     |
| class           | CSS class (`string`)              | CSS class attribute of the button.                                                                                 |
| attributes      | Additional attributes (`string`)  | Additional attributes like event handler or style definitions.                                                     |
| [button_callback](../callbacks/#list-global-operations-operation-button) | Callback function (`array`)       | Call a custom function to generate the button. Please specify as `['Class', 'Method']` or use service tagging. |
| route           | Symfony Route Name (`string`)     | {{< version-tag "4.7" >}} The button will redirect to the given Symfony route.                                     |


{{% notice "info" %}}
{{< version-tag "5.3" >}} You do not have to define any settings for global operations anymore. Instead, you can give a list
of which operations should be available for your data container. You can also adjust the order.

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['list']['global_operations'] = [
    'all',
    'custom_operation' => [
        'href' => 'do=custom_operation'
    ],
    'toggleNodes',
];
```
{{% /notice %}}


### Regular operations

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['list']['operations'] = [
    // …
];
```

| Key             | Value                             | Description                                                                                                        |
|-----------------|-----------------------------------|--------------------------------------------------------------------------------------------------------------------|
| label           | `&$GLOBALS['TL_LANG']` (`string`) | Button label. Typically a reference to the global language array.                                                  |
| href            | URL fragment (`string`)           | URL fragment that is added to the URI string when the button is clicked (e.g. `act=edit`).                         |
| icon            | Icon (`string`)                   | Path and filename of the icon.                                                                                     |
| attributes      | Additional attributes (`string`)  | Additional attributes like event handler or style definitions.                                                     |
| [button_callback](../callbacks/#list-operations-operation-button) | Callback function (`array`)       | Call a custom function to generate the button. Please specify as `['Class', 'Method']` or use service tagging. |
| showInHeader    | true/false (`bool`)               | {{< version-tag "4.5" >}} Shows the operation in the [header element]({{< asset "images/dev/reference/mode_parent_header.png" >}}) (sorting mode 4 only).                                                   |
| route           | Symfony Route Name (`string`)     | {{< version-tag "4.7" >}} The button will redirect to the given Symfony route.                                                               |
| primary         | true/false (`bool`)               | {{< version-tag "5.5" >}} Shows the operation in the overview, instead of hiding it in the context menu.                                                   |

{{% notice "info" %}}
{{< version-tag "5.0" >}} You do not have to define any settings for standard operations anymore. Instead, you can give a list
of which operations should be available for your data container. Contao will also check the appropriate
[`contao_dc.<data-container>` permission](/framework/security/) for these operations.

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['list']['operations'] = [
    'edit',
    'children',
    'copy',
    'cut',
    'delete',
    'toggle',
    'show',
];
```
{{% /notice %}}

{{% notice "info" %}}
{{< version-tag "5.5" >}}
All operations are now shown within the context-menu. If you want them to appear in the overview, you can enable them by
prepending your key with `!` as seen in the example (or use `'primary' => true` in your custom operation config). Note that the operations `edit`, `children` and `toggle` will always appear in
the overview regardless.

```php

$GLOBALS['TL_DCA']['tl_example']['list']['operations'] = [
    '!edit',
    '!children',
    'copy',
    'cut',
    'delete',
    'toggle',
    'show'
];
```
{{% /notice %}}

#### Toggle Operation

{{< version-tag "4.13" >}} You can implement an automatic toggle operation for data containers that contain a boolean
field. This is typically used for fields that control a "published" state of a data record for example, but the use case
can be arbitrary.

```php
// contao/dca/tl_foobar.php
$GLOBALS['TL_DCA']['tl_foobar']['list']['operations']['toggle'] = [
    'href' => 'act=toggle&amp;field=published',
    'icon' => 'visible.svg',
];

$GLOBALS['TL_DCA']['tl_foobar']['fields']['published'] = [
    'toggle' => true,
    'inputType' => 'checkbox',
    'sql' => ['type' => 'boolean', 'default' => false],
];
```

If the state of your field is reversed you can instead define `reverseToggle`:

```php
$GLOBALS['TL_DCA']['tl_foobar']['fields']['invisible'] = [
    'reverseToggle' => true,
    'inputType' => 'checkbox',
    'sql' => ['type' => 'boolean', 'default' => false],
];
```

{{< version-tag "5.0" >}} Since contao 5 you can reduce the toggle operation to a single line:

```php
// contao/dca/tl_foobar.php
$GLOBALS['TL_DCA']['tl_foobar']['list']['operations'][] = 'toggle';
```

Instead of using the default `visible.svg` icon you can of course also provide your own. However, in the DCA you
only define the icon of the _active_ state - and then you additionally provide a second icon file for the inactive
state in the same folder, but appended with an underscore in its name. So for example `myicon.svg` and `myicon_.svg`.

Note that for custom icons not provided by Contao's back end theme you will need to provide a path to the icon,
relative to the public directory, e.g.

```php
// contao/dca/tl_foobar.php
$GLOBALS['TL_DCA']['tl_foobar']['list']['operations']['toggle'] = [
    'href' => 'act=toggle&amp;field=published',
    'icon' => 'icons/myicon.svg',
];
```

Or in case of a custom bundle, where the icon resides in the `public/` directory of that bundle:

```php
// contao/dca/tl_foobar.php
$GLOBALS['TL_DCA']['tl_foobar']['list']['operations']['toggle'] = [
    'href' => 'act=toggle&amp;field=published',
    'icon' => 'bundles/foobar/myicon.svg',
];
```

You can also use the [`assets.packages` service]({{% relref "asset-management#accessing-assets-in-templates" %}}):

```php
// contao/dca/tl_foobar.php
$GLOBALS['TL_DCA']['tl_foobar']['list']['operations']['toggle'] = [
    'href' => 'act=toggle&amp;field=published',
    'icon' => Contao\System::getContainer()->get('assets.packages')->getUrl('myicon.svg', 'foobar'),
];
```
