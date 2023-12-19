---
title: "Fields"
description: "Definition of table columns."
weight: 3
---


The `fields` key of the DCA defines the columns of a table. Depending on these 
settings, the Contao core engine decides which type of form field to load, whether 
a user is allowed to access a certain field and whether a field can be used as sort 
or filter criteria.


## Example

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['fields']['myfield'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_example']['myfield'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => ['tl_class'=>'w50', 'maxlength'=>255],
    'sql' => "varchar(255) NOT NULL default ''",
];
```


## Reference

| Key                  | Value                                           | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
|:---------------------|:------------------------------------------------|:------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| label                | `&$GLOBALS['TL_LANG']` (`array`)                | Field label. Typically a reference to the global language array. Needs to be an array containing two elements: the field's label and its description.<sup>1</sup>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
| default              | Default value (`mixed`)                         | Default value that is set when a new record is created.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| exclude              | true/false (`bool`)                             | If true the field will be excluded for non-admins. It can be enabled in the user group module (allowed excluded fields).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| toggle               | true/false (`bool`)                             | {{< version-tag "4.13" >}} If true the field can be used to trigger the `toggle` action.
| search               | true/false (`bool`)                             | If true the field will be included in the search menu (see "sorting records" -> "panelLayout").                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| sorting              | true/false (`bool`)                             | If true the field will be included in the sorting menu (see "sorting records" -> "panelLayout").                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
| filter               | true/false (`bool`)                             | If true the field will be included in the filter menu (see "sorting records" -> "panelLayout").                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| flag                 | Sorting mode (`integer`)                        | **1** Sort by initial letter ascending <br>**2** Sort by initial letter descending <br>**3** Sort by initial X letters ascending (see length) <br>**4** Sort by initial X letters descending (see length) <br>**5** Sort by day ascending <br>**6** Sort by day descending <br>**7** Sort by month ascending <br>**8** Sort by month descending <br>**9** Sort by year ascending <br>**10** Sort by year descending <br>**11** Sort ascending <br>**12** Sort descending<br><br><i>Note:</i> flags 5 through 10 will also enable formatting of timestamps in the back end when used as a label somewhere.                                                                                                                                                                        |
| length               | Sorting length (`integer`)                      | Allows to specify the number of characters that are used to build sorting groups (flag **3** and **4**).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| inputType            | Field type (`string`)                           | [`checkbox`][CheckboxWidget] Checkbox <br>[`checkboxWizard`][CheckboxWizardWidget] Checkbox Wizard <br>`chmod` CHMOD table <br>[`fileTree`][FileTreeWidget] File tree <br>`imageSize` Two text fields with drop-down menu (creates an [Image Size Array](/framework/image-processing/image-sizes/#size-array)) <br>`inputUnit` Text field with small unit drop-down menu <br>`keyValueWizard` Key » Value wizard <br>[`listWizard`][ListWizardWidget] List wizard <br>`metaWizard` Used for setting meta information in the file manager <br>`moduleWizard` Module wizard <br>`optionWizard` Option wizard <br>`pageTree` Page tree <br>`password` Password field <br>[`picker`][PickerWidget] General purpose picker <br>`radio` Radio button <br>`radioTable` Table with images and radio buttons <br>`sectionWizard` Used for defining sections in the page layout <br>[`select`][SelectWidget] Drop-down menu <br>`serpPreview` Search Engine Result Preview (SERP) widget <br>`tableWizard` Table wizard <br>`text` Text field <br>`textStore` Text field that will not display its current value <br>[`textarea`][TextareaWidget] Textarea <br>`timePeriod` Text field with drop-down menu <br>`trbl` Four text fields with a small unit drop-down menu |
| options              | Options (`array`)                               | Options of a drop-down menu or radio button menu.<br />Specify as `['opt1', 'opt2', 'opt3']` or `['value1' => 'label1', 'value2' => 'label2']`.<br />Special case **ambiguous numerical value/index**: `[0 => 'label1', 1 => 'label2']` or `['0' => 'label1', '1' => 'label2']`: If option values are integers and starting with 0, the label will also be used as value. Use the eval option `isAssociative` to prevent this.                                                                                                                                                                                                                  |
| [options_callback](../callbacks/#fields-field-options)         | Callback function (`array`)                     | Callback function that returns an array of options. Please specify as `['Class', 'Method']`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| foreignKey           | table.field (`string`)                          | Get options from a database table. Returns ID as key and the field you specify as value. The field can be a complete SQL expression, e.g.: `tl_member.CONCAT(firstname,' ',lastname)`                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
| reference            | `&$GLOBALS['TL_LANG']` (`array`)                | Array that holds the options labels. Typically a reference to the global language array.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| explanation          | Array key (`string`)                            | Array key that holds the explanation. This is a reference to the `XPL` category of the `explain` translation domain. See more information [below](#explanation).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
| [input_field_callback](../callbacks/#fields-field-input-field) | Callback function (`array`)                     | Executes a custom function instead of using the default input field routine and passes the the DataContainer object and the label as arguments.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| eval                 | Field configuration (`array`)                   | Various configuration options. See next paragraph.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
| [wizard](../callbacks/#fields-field-wizard)                    | Callback functions (`array`)                     | Call a custom function and add its return value to the input field. Please specify each callback as `['Class', 'Method']`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| sql                  | Database field definition (`string` or `array`) | Describes data type and its database configuration. (see paragraph [SQL Column Definition](#sql-column-definition)).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
| relation             | Configuration of relations (`array`)            | Describes relation to parent table (see paragraph [Relations](#relations)).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| [load_callback](../callbacks/#fields-field-load)               | Callback functions (`array`)                    | These functions will be called when the field is loaded. Please specify each callback function as `['Class', 'Method']`. Passes the field's value and the data container as arguments. Expects the field value as return value.                                                                                                                                                                                                                                                                                                                                                                                                            |
| [save_callback](../callbacks/#fields-field-save)               | Callback functions (`array`)                    | These functions will be called when the field is saved. Please specify each callback function as `['Class', 'Method']`. Passes the field's value and the data container as arguments. Expects the field value as return value. Throw an exception to display an error message.                                                                                                                                                                                                                                                                                                                                                             |
| [xlabel](../callbacks/#fields-field-xlabel)                    | Callback functions (`array`)                    | These functions will be called when the widget is rendered and allows you to add additional html after the field label. Please specify each callback function as `['Class', 'Method']`.

{{% notice tip %}}
<sup>1</sup> Since Contao **4.9**, defining a label for a DCA field is optional. If
no label is defined, Contao will automatically look for a translation in `tl_example.field_name`,
e.g. `$GLOBALS['TL_LANG']['tl_example']['field_name']`.
{{% /notice %}}


### Explanation

Explanations are used together with the `helpwizard` `eval` setting. The latter
will show the help wizard icon and the help wizard itself will show the explanation.
`explanation` is a configuration value holding a simple string. It is a reference
to the `$GLOBALS['TL_LANG']['XPL']` translation array, i.e. a reference into the
`XPL` category of the `explain` [translation domain][TranslationDomain].

The explanation itself can be defined in two ways: either as a single string:

```php
// contao/languages/en/explain.php
$GLOBALS['TL_LANG']['XPL']['example'] = 'Content for the help wizard.';
```

or as a multi dimensonal array representing an explanation table:

```php
// contao/languages/en/explain.php
$GLOBALS['TL_LANG']['XPL']['example'] = [
    ['First row header', 'First row content.'],
    ['Second row header', 'Second row content.'],
];
```

{{% expand "Show full example" %}}
```php
// contao/dca/tl_content.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_content']['fields']['example'] = [
    'inputType' => 'text',
    'explanation' => 'example',
    'eval' => ['tl_class' => 'w50', 'helpwizard' => true],
    'sql' => ['type' => 'string', 'default' => ''],
];

PaletteManipulator::create()
    ->addField('example', 'text')
    ->applyToPalette('text', 'tl_content')
;
```

```php
// contao/languages/en/tl_content.php
$GLOBALS['TL_LANG']['example'] = [
    'Example field',
    'Field for demonstrating the explanation configuration.'
];
```

```php
// contao/languages/en/explain.php
$GLOBALS['TL_LANG']['XPL']['example'] = 'Explanatory text for the <strong>example</strong> field.';
```
{{% /expand %}}


### Evaluation

The evaluation array (`eval`) configures a particular field in detail. You can e.g.
create mandatory fields, add a date picker or define the rows and columns of a
textarea. You can also modify the field appearance or enable data encryption.
Each field can be validated against a regular expression.

| Key                | Value                            | Description                                                                                                                                                              |
|:-------------------|:---------------------------------|:-------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| addWizardClass     | true/false (`bool`) | Whether or not to add the `wizard` CSS class for the widget if a wizard icon is in use. Default: `true`. _Note:_ this setting does not exist anymore in Contao **4.12** and up. |
| allowHtml          | true/false (`bool`)           | If true the current field will accept HTML input (see "Allowed HTML tags" in the back end System => Settings).                                                            |
| alwaysSave         | true/false (`bool`)           | If true the field will always be saved, even if its value has not changed. This can be useful in conjunction with a load_callback.                                       |
| blankOptionLabel   | Label (`string`)                 | Label for the blank option (defaults to `-`).                                                                                                                         |
| chosen             | true/false (`bool`)           | Native selects enhanced with [Chosen](http://harvesthq.github.io/chosen/).                                                                                               |
| collapseUncheckedGroups | true/false (`bool`) | {{< version "4.13" >}} If true all option groups without at least one checked option will be collapsed. The first group of options will not be collapsed if there are no options selected at all. Applies to checkbox widgets with a nested array of options only.                                                                                                                  |
| colorpicker        | true/false (`bool`)           | If true the current field will have a [mooRainbow](https://mootools.net/forge/p/moorainbow) color picker.                                                                                                                            |
| cols               | Columns (`integer`)              | Number of columns (used for `textarea`, `radioTable` and `tableWizard` fields).                                                                                                                                |
| csv                | Delimiter (`string`)             | The choice of this field will not be stored as serialized string but rather as given delimiter-separated list. Example: `'eval' => ['csv'=>',']`                 |
| customRgxp        | Regular expression (`string`) | {{< version "4.11" >}} Custom regular expression to be used when using `'rgxp' => 'custom'` |
| customTpl        | Filename (`string`) | Use own template for this input field `'customTpl' => 'template-file-name'` |
| datepicker         | true/false (`bool`)           | If true the current field will have a [MooTools-DatePicker](https://github.com/arian/mootools-datepicker).                                                                                                                             |
| dcaPicker          | true/false (`bool`)           | If true the general purpose picker will be shown. Allows to pick different records from the system and return them as an insert tag.                                     |
| decodeEntities     | true/false (`bool`)           | If true HTML entities will be decoded. Note that HTML entities are always decoded if allowHtml is true.                                                                  |
| disabled           | true/false (`bool`)           | Disables the field (not supported by all field types).                                                                                                                   |
| doNotCopy          | true/false (`bool`)           | If true the current field will not be duplicated if the record is duplicated.                                                                                            |
| doNotSaveEmpty     | true/false (`bool`)           | If true the field will not be saved if it is empty.                                                                                                                      |
| doNotShow          | true/false (`bool`)           | If true the current field will not be shown in "edit all" or "show details" mode.                                                                                        |
| doNotTrim          | true/false (`bool`)           | If true the whitespace of the input of this field will not be trimmed before saving.                                                                                     |
| encrypt            | true/false (`bool`)           | If true the field value will be stored encrypted.                                                                                                                        |
| extensions         | File extensions (`string`)       | Limits the file tree to certain file types (comma separated list). Applies to file trees only.                                                                        |
| fallback           | true/false (`bool`)           | If true the field can only be assigned once per table.                                                                                                                   |
| feEditable         | true/false (`bool`)           | If true the current field can be edited in the front end. Applies to table `tl_member` only.                                                                             |
| feGroup            | Group name (`string`)            | **personal** personal data <br>**address** address details <br>**contact** contact details <br>**login** login details (table `tl_member` only) <br>You can also define your own groups. |
| feViewable         | true/false (`bool`)           | If true the current field is viewable in the member listing module.                                                                                                      |
| fieldType          | Input field type (`string`)      | **checkbox** allow multiple selections <br>**radio** allow a single selection only Applies to file and page trees only.                                               |
| files              | true/false (`bool`)           | If true files and folders will be shown. If false, only folders will be shown. Applies to file trees only.                                                               |
| filesOnly          | true/false (`bool`)           | Removes the radio buttons or checkboxes next to folders. Applies to file trees only.                                                                                     |
| findInSet          | true/false (`bool`)           | Sort by the actual option values instead of their labels.                                                                                                                |
| helpwizard         | true/false (`bool`)           | If true the [helpwizard](#explanation) <img src="../images/help-wizard.svg" style="margin:0;display:inline"> icon will appear next to the field label.                                                                                                         |
| hideInput          | true/false (`bool`)           | If true the field value will be hidden (it is still visible in the page source though!).                                                                                 |
| includeBlankOption | true/false (`bool`)           | If true a blank option will be added to the options array. Applies to drop-down menus only.                                                                              |
| isAssociative      | true/false (`boolean`)           | Indicates that an array of options is indeed an associative array. Example of an ambiguous array of options: `['0' => 'Zero', '1' => 'One']`.                         |
| isBoolean          | true/false (`bool`)           | Indicates that a particular field is boolean.                                                                                                                            |
| isGallery          | true/false (`bool`)     | Displays selected files of a `fileTree` widget as an image gallery. |
| isHexColor         | true/false (`bool`)              | Defines the input as being a color definition in Hex notation. Invalid characters will automatically be removed. |
| isSortable         | true/false (`bool`)           | {{< version "4.10" >}} Enable sorting for the selected items. Applies to file trees and pickers.                                                                              |
| mandatory          | true/false (`bool`)           | If true the field cannot be empty.                                                                                                                                       |
| maxlength          | Maximum length (`integer`)       | Maximum number of characters that is allowed in the current field.                                                                                                       |
| maxval             | Maximum value (`integer`)        | Maximum number value to be checked (upper bound).                                                                                                                        |
| metaFields         | `metaWizard` fields (`array`) | Defines the available fields for the `metaWizard` input type. |
| minlength          | Minimum length (`integer`)       | Minimum number of characters that have to be entered.                                                                                                                    |
| minval             | Minimum value (`integer`)        | Minimum number value to be checked (lower bound).                                                                                                                        |
| multiple           | true/false (`bool`)           | Make the input field multiple. Applies to text fields, select menus, radio buttons and checkboxes. Required for the checkbox wizard.                                     |
| nospace            | true/false (`bool`)           | If true whitespace characters will not be allowed.                                                                                                                       |
| orderField         | Order column (`string`)       | Database column where the order of the selected items gets stored. This is only required if `isGallery` or `isDownloads` is set. Applies to file trees only.                                                                              |
| path               | Path (`string`)                  | Custom root directory for file trees. Applies to file trees only.                                                                                                     |
| placeholder        | Placeholder (`string`)        | Displays a placeholder for the respective field.    
| preserveTags       | true/false (`bool`)           | If true no HTML tags will be removed at all.                                                                                                                             |
| readonly           | true/false (`bool`)           | Makes the field read only (not supported by all field types).                                                                                                            |
| rgxp               | Regular expression (`string`)    | Limits the user input to certain rules (see paragraph [Regular Expressions](#regular-expressions)).                                                                      |
| rows               | Rows (`integer`)                 | Number of rows (used for `textarea` and `tableWizard` fields).                                                                                                                                   |
| rte                | Rich text editor file (`string`) | `ace` or `tinyMCE` for example. For `ace` you can also define the type, e.g. `ace\|js` or `ace\|php`. _Note:_ `allowHtml` and `decodeEntities` is automatically enabled if `rte` equals to `ace\|html` or if it starts with `tiny`. |
| size               | Size (`integer`)                 | Size of a multiple select menu or number of input fields.                                                                                                                |
| spaceToUnderscore  | true/false (`bool`)           | If true any whitespace character will be replaced by an underscore.                                                                                                      |
| style              | Style attributes (`string`)      | Style attributes (e.g. `border:2px`).                                                                                                                                    |
| submitOnChange     | true/false (`bool`)           | If true the form will be submitted when the field value changes.                                                                                                         |
| tl_class           | CSS class(es) (`string`)         | Add the given CSS class(es) to the generated HTML. See section [Arranging Fields](/reference/dca/palettes/#arranging-fields) for supported values.                                 |
| trailingSlash      | true/false (`bool`)           | If true a trailing slash will be added to the field value. If false, an existing trailing slash will be removed from the field value.                                    |
| unique             | true/false (`bool`)           | If true the field value cannot be saved if it exists already.                                                                                                            |
| uploadFolder       | Path (`string`)                  | The target path for file uploads of the `upload` widget.                                                                                                              |
| useRawRequestData  | true/false (`bool`)           | If true the raw request data from the Symfony request is used. **Warning:** input filtering is bypassed! Make sure the data is never output anywhere in the back end unescaped which it would if you added the field to a regular back end list view for example. |
| versionize         | true/false (`bool`)           | If false skip this field in the versioning. Default `true`.

{{% notice warning %}}
Using the `encrypt` option is deprecated and its internal implementation relies 
on `mcrypt`, which will no longer be available in PHP 7.2 and higher. Use a [load](/reference/dca/callbacks/#fields-field-load)
and [save callback](/reference/dca/callbacks/#fields-field-save) with your own implementation instead.
{{% /notice %}}


#### Regular Expressions

Regular expressions (`rgxp`) requires the input of a field to match a pre-defined format.
A lot of useful formats are shipped with Contao, but additional formats
can be [registered using a hook][3].


| Key         | Description                                                                                                       |
|:------------|:------------------------------------------------------------------------------------------------------------------|
| digit       | allows numeric characters only (including full stop [.] and minus [-])                                            |
| natural     | allows non-negative natural numbers (including 0)                                                                 |
| alpha       | allows alphabetic characters only (including full stop [.] minus [-] and space [ ])                               |
| alnum       | allows alphanumeric characters only (including full stop [.] minus [-], underscore [\_] and space [ ])            |
| extnd       | disallows `#<>()\\=`                                                                                              |
| date        | expects a valid date                                                                                              |
| time        | expects a valid time                                                                                              |
| datim       | expects a valid date and time                                                                                     |
| friendly    | expects a valid "friendly name format" e-mail address (`Lorem Ipsum <foobar@example.com>` or `Lorem Ipsum [foobar@example.com]`) |
| email       | expects a valid e-mail address                                                                                    |
| emails      | expects a valid list of valid e-mail addresses                                                                    |
| url         | expects a valid URL                                                                                               |
| alias       | expects a valid alias                                                                                             |
| folderalias | expects a valid folder URL alias                                                                                  |
| phone       | expects a valid phone number (numeric characters, space [ ], plus [+], minus [-], parentheses [()] and slash [/]) |
| prcnt       | allows numbers between 0 and 100                                                                                  |
| locale      | expects a valid locale (e.g. "de_CH")                                                                             |
| language    | expects a valid language code (e.g. "de-CH")                                                                      |
| google+     | expects a Google+ ID or vanity name                                                                               |
| fieldname   | expects a valid field name (added in version 3.5.16 / 4.2.3)                                                      |
| httpurl     | {{< version "4.11" >}} expects a valid absolute URL (beginning with `http://` or `https://`)                      |
| custom      | {{< version "4.11" >}} enables you to define a custom regular expression under the `customRgxp` evaluation key e.g. `'eval' => ['rgxp' => 'custom', 'customRgxp' => '/^[1-9]\d*$/']` |


#### Meta Wizard Fields

When using the `metaWizard` input type, as it is used in `tl_files` within the Contao
core for example, the available fields can be defined through the `metaFields` key
in the `eval` definition of the field. This definition is an associative array,
where the key is the key of the meta field and its value will be used for additional
attributes of the text input field.

{{% notice note %}}
The meta wizard only supports text input fields, and `textarea` fields since Contao
**4.9.10**.
{{% /notice %}}

For example, this is the definition of the `tl_files.meta` field from the Contao
core:

```php
$GLOBALS['TL_DCA']['tl_files']['fields']['meta']['eval']['metaFields'] = [
    'title' => 'maxlength="255"',
    'alt' => 'maxlength="255"',
    'link' => 'maxlength="255"',
    'caption' => 'maxlength="255"',
];
```

Each meta field is always a simple text input, which can be expanded with additional
HTML attributes. In this case, all the meta fields get the attribute `maxlength="255"`.

If you want to add an additional meta field to the file manager of Contao, you could
do it like this:

```php
// contao/dca/tl_files.php
$GLOBALS['TL_DCA']['tl_files']['fields']['meta']['eval']['metaFields']['example'] = 
    'maxlength="255"'
;
```

This will insert the new meta field, however it will have no label in the back end,
as its translation is still missing. The translation key for these meta fields consists
of the name of the field, grouped and prefixed by `MSC.aw_`. So for this new field
the translation definition could look like this:

```php
// contao/languages/en/default.php
$GLOBALS['TL_LANG']['MSC']['aw_example'] = 'My example';
```


### Relations

Relations describe, how database fields are related to other tables.
Define the referenced table in the `foreignKey` key. Relations provide
model classes to load referenced data sets efficiently and developer friendly.
(see `\Contao\Model::getRelated()`).

| Key   | Value                           | Description                                                                                                                                                                                                                                     |
|-------|---------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| type  | Type of relation (`string`)     | **hasOne** Value references a child data set <br>**hasMany** Value references some child data sets (serialized) <br>**belongsTo** Value references a parent data set (e.g. `pid`) <br>**belongsToMany** Value references some parent data sets (serialized) |
| load  | Load behaviour (`string`)       | **lazy** Loading referenced records only when necessary (default, saves RAM) <br>**eager** Loading referenced records automatically (saves database calls)                                                                                          |
| table | Relation table (`string`)       | A database table for this relation. Optional, by default Contao tries to extract it from the `foreignKey` attribute.                                                                                                                            |
| field | Relation table field (`string`) | Override the default relation field (`id`). Useful for relation with `tl_files.uuid` for example.                                                                                                                                               |


### SQL Column Definition

Since Contao 3.0, the database definition is added using the `sql` key as a string 
to each DCA field, e.g. `varchar(255) NOT NULL default ''`. Starting from Contao 
**4.3**, one can use [Doctrine Schema Representation][2] to take full advantage of
the Doctrine Database Abstraction Layer.

**Examples:**

| Doctrine Schema Representation                                              | SQL Equivalent                    |
|:----------------------------------------------------------------------------|:----------------------------------|
| `['type' => 'string', 'length' => 32, 'default' => '']`                     | `VARCHAR(32) NOT NULL DEFAULT ''` |
| `['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => '']`     | `CHAR(1) NOT NULL DEFAULT ''`     |
| `['type' => 'integer', 'notnull' => false, 'unsigned' => true]`             | `INT UNSIGNED NULL`               |
| `['type' => 'binary', 'length' => 16, 'fixed' => true, 'notnull' => false]` | `BINARY(16) NULL`                 |



[1]: https://docs.contao.org/books/manual/current/en/02-administration-area/listing-records.html
[2]: http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/schema-representation.html#column
[3]: ../../../framework/hooks/
[TranslationDomain]: /framework/translations/#domains
[CheckboxWidget]: /reference/widgets/checkbox/
[CheckboxWizardWidget]: /reference/widgets/checkbox-wizard/
[FileTreeWidget]: /reference/widgets/file-tree/
[ListWizardWidget]: /reference/widgets/list-wizard/
[PickerWidget]: /reference/widgets/picker/
[SelectWidget]: /reference/widgets/select/
[TextareaWidget]: /reference/widgets/textarea/
