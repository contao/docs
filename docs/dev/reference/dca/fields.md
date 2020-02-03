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
$GLOBALS['TL_DCA']['fields']['tl_example'] = [
    'myfield' => [
        'label' => &$GLOBALS['TL_LANG']['tl_example']['myfield'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['tl_class'=>'w50', 'maxlength'=>255],
        'sql' => "varchar(255) NOT NULL default ''",
    ]
];
```


## Reference

| Key                  | Value                                           | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
|:---------------------|:------------------------------------------------|:------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| label                | `&$GLOBALS['TL_LANG']` (`array`)                | Field label. Typically a reference to the global language array. Needs to be an array containing two elements: the field's label and its description.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
| default              | Default value (`mixed`)                         | Default value that is set when a new record is created.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| exclude              | true/false (`bool`)                             | If true the field will be excluded for non-admins. It can be enabled in the user group module (allowed excluded fields).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| search               | true/false (`bool`)                             | If true the field will be included in the search menu (see "sorting records" -> "panelLayout").                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| sorting              | true/false (`bool`)                             | If true the field will be included in the sorting menu (see "sorting records" -> "panelLayout").                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                |
| filter               | true/false (`bool`)                             | If true the field will be included in the filter menu (see "sorting records" -> "panelLayout").                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| flag                 | Sorting mode (`integer`)                        | **1** Sort by initial letter ascending <br>**2** Sort by initial letter descending <br>**3** Sort by initial X letters ascending (see length) <br>**4** Sort by initial X letters descending (see length) <br>**5** Sort by day ascending <br>**6** Sort by day descending <br>**7** Sort by month ascending <br>**8** Sort by month descending <br>**9** Sort by year ascending <br>**10** Sort by year descending <br>**11** Sort ascending <br>**12** Sort descending                                                                                                                                                                        |
| length               | Sorting length (`integer`)                      | Allows to specify the number of characters that are used to build sorting groups (flag **3** and **4**).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| inputType            | Field type (`string`)                           | **text** Text field <br>**password** Password field <br>**textarea** Textarea <br>**select** Drop-down menu <br>**checkbox** Checkbox <br>**radio** Radio button <br>**radioTable** Table with images and radio buttons <br>**imageSize** Two text fields with drop-down menu <br>**inputUnit** Text field with small unit drop-down menu <br>**trbl** Four text fields with a small unit drop-down menu <br>**chmod** CHMOD table <br>**pageTree** Page tree <br>**fileTree** File tree <br>**tableWizard** Table wizard <br>**timePeriod** Text field with drop-down menu <br>**listWizard** List wizard <br>**optionWizard** Option wizard <br>**moduleWizard** Module wizard <br>**checkboxWizard** Checkbox Wizard |
| options              | Options (`array`)                               | Options of a drop-down menu or radio button menu.<br />Specify as `['opt1', 'opt2', 'opt3']` or `['value1' => 'label1', 'value2' => 'label2']`.<br />Special case **ambiguous numerical value/index**: `[0 => 'label1', 1 => 'label2']` or `['0' => 'label1', '1' => 'label2']`: If option values are integers and starting with 0, the label will also be used as value. Use the eval option `isAssociative` to prevent this.                                                                                                                                                                                                                  |
| [options_callback](../callbacks/#fieldsfieldoptions)         | Callback function (`array`)                     | Callback function that returns an array of options. Please specify as `['Class', 'Method']`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| foreignKey           | table.field (`string`)                          | Get options from a database table. Returns ID as key and the field you specify as value. The field can be a complete SQL expression, e.g.: `tl_member.CONCAT(firstname,' ',lastname)`                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
| reference            | `&$GLOBALS['TL_LANG']` (`array`)                | Array that holds the options labels. Typically a reference to the global language array.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        |
| explanation          | `&$GLOBALS['TL_LANG']` (`array`)                | Array that holds the explanation. Typically a reference to the global language array.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           |
| [input_field_callback](../callbacks/#fieldsfieldinput_field) | Callback function (`array`)                     | Executes a custom function instead of using the default input field routine and passes the the DataContainer object and the label as arguments.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| eval                 | Field configuration (`array`)                   | Various configuration options. See next paragraph.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              |
| [wizard](../callbacks/#fieldsfieldwizard)                    | Callback function (`array`)                     | Call a custom function and add its return value to the input field. Please specify as `['Class', 'Method']`.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               |
| sql                  | Database field definition (`string` or `array`) | Describes data type and its database configuration. (see paragraph [SQL Column Definition](#sql-column-definition)).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            |
| relation             | Configuration of relations (`array`)            | Describes relation to parent table (see paragraph [Relations](#relations)).                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     |
| [load_callback](../callbacks/#fieldsfieldload)               | Callback functions (`array`)                    | These functions will be called when the field is loaded. Please specify each callback function as `['Class', 'Method']`. Passes the field's value and the data container as arguments. Expects the field value as return value.                                                                                                                                                                                                                                                                                                                                                                                                            |
| [save_callback](../callbacks/#fieldsfieldsave)               | Callback functions (`array`)                    | These functions will be called when the field is saved. Please specify each callback function as `['Class', 'Method']`. Passes the field's value and the data container as arguments. Expects the field value as return value. Throw an exception to display an error message.                                                                                                                                                                                                                                                                                                                                                             |
| [xlabel](../callbacks/#fieldsfieldxlabel)                    | Callback functions (`array`)                    | These functions will be called when the widget is rendered and allows you to add additional html after the field label. Please specify each callback function as `['Class', 'Method']`.


### Evaluation

The evaluation array (`eval`) configures a particular field in detail. You can e.g.
create mandatory fields, add a date picker or define the rows and columns of a
textarea. You can also modify the field appearance or enable data encryption.
Each field can be validated against a regular expression.

| Key                | Value                            | Description                                                                                                                                                              |
|:-------------------|:---------------------------------|:-------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| helpwizard         | true/false (`bool`)           | If true the helpwizard icon will appear next to the field label.                                                                                                         |
| mandatory          | true/false (`bool`)           | If true the field cannot be empty.                                                                                                                                       |
| maxlength          | Maximum length (`integer`)       | Maximum number of characters that is allowed in the current field.                                                                                                       |
| minlength          | Minimum length (`integer`)       | Minimum number of characters that have to be entered.                                                                                                                    |
| maxval             | Maximum value (`integer`)        | Maximum number value to be checked (upper bound).                                                                                                                        |
| minval             | Minimum value (`integer`)        | Minimum number value to be checked (lower bound).                                                                                                                        |
| fallback           | true/false (`bool`)           | If true the field can only be assigned once per table.                                                                                                                   |
| rgxp               | Regular expression (`string`)    | Limits the user input to certain rules (see paragraph [Regular Expressions](#regular-expressions)).                                                                      |
| cols               | Columns (`integer`)              | Number of columns (textarea fields only).                                                                                                                                |
| rows               | Rows (`integer`)                 | Number of rows (textarea fields only).                                                                                                                                   |
| multiple           | true/false (`bool`)           | Make the input field multiple. Applies to text fields, select menus, radio buttons and checkboxes. Required for the checkbox wizard.                                     |
| size               | Size (`integer`)                 | Size of a multiple select menu or number of input fields.                                                                                                                |
| style              | Style attributes (`string`)      | Style attributes (e.g. `border:2px`).                                                                                                                                    |
| rte                | Rich text editor file (`string`) | `ace` or `tinyMCE` for example. |
| submitOnChange     | true/false (`bool`)           | If true the form will be submitted when the field value changes.                                                                                                         |
| nospace            | true/false (`bool`)           | If true whitespace characters will not be allowed.                                                                                                                       |
| allowHtml          | true/false (`bool`)           | If true the current field will accept HTML input (see "Allowed HTML tags" in the back end System => Settings).                                                            |
| preserveTags       | true/false (`bool`)           | If true no HTML tags will be removed at all.                                                                                                                             |
| decodeEntities     | true/false (`bool`)           | If true HTML entities will be decoded. Note that HTML entities are always decoded if allowHtml is true.                                                                  |
| doNotSaveEmpty     | true/false (`bool`)           | If true the field will not be saved if it is empty.                                                                                                                      |
| alwaysSave         | true/false (`bool`)           | If true the field will always be saved, even if its value has not changed. This can be useful in conjunction with a load_callback.                                       |
| spaceToUnderscore  | true/false (`bool`)           | If true any whitespace character will be replaced by an underscore.                                                                                                      |
| unique             | true/false (`bool`)           | If true the field value cannot be saved if it exists already.                                                                                                            |
| encrypt            | true/false (`bool`)           | If true the field value will be stored encrypted.                                                                                                                        |
| trailingSlash      | true/false (`bool`)           | If true a trailing slash will be added to the field value. If false, an existing trailing slash will be removed from the field value.                                    |
| files              | true/false (`bool`)           | If true files and folders will be shown. If false, only folders will be shown. Applies to file trees only.                                                               |
| filesOnly          | true/false (`bool`)           | Removes the radio buttons or checkboxes next to folders. Applies to file trees only.                                                                                     |
| extensions         | File extensions (`string`)       | Limits the file tree to certain file types (comma separated list). Applies to file trees only.                                                                        |
| path               | Path (`string`)                  | Custom root directory for file trees. Applies to file trees only.                                                                                                     |
| fieldType          | Input field type (`string`)      | **checkbox** allow multiple selections <br>**radio** allow a single selection only Applies to file and page trees only.                                               |
| includeBlankOption | true/false (`bool`)           | If true a blank option will be added to the options array. Applies to drop-down menus only.                                                                              |
| blankOptionLabel   | Label (`string`)                 | Label for the blank option (defaults to `-`).                                                                                                                         |
| chosen             | true/false (`bool`)           | Native selects enhanced with [Chosen](http://harvesthq.github.io/chosen/).                                                                                               |
| findInSet          | true/false (`bool`)           | Sort by the actual option values instead of their labels.                                                                                                                |
| datepicker         | true/false (`bool`)           | If true the current field has a date picker.                                                                                                                             |
| colorpicker        | true/false (`bool`)           | If true the current field has a color picker.                                                                                                                            |
| feEditable         | true/false (`bool`)           | If true the current field can be edited in the front end. Applies to table `tl_member` only.                                                                             |
| feGroup            | Group name (`string`)            | **personal** personal data <br>**address** address details <br>**contact** contact details <br>**login** login details (table `tl_member` only) <br>You can also define your own groups. |
| feViewable         | true/false (`bool`)           | If true the current field is viewable in the member listing module.                                                                                                      |
| doNotCopy          | true/false (`bool`)           | If true the current field will not be duplicated if the record is duplicated.                                                                                            |
| hideInput          | true/false (`bool`)           | If true the field value will be hidden (it is still visible in the page source though!).                                                                                 |
| doNotShow          | true/false (`bool`)           | If true the current field will not be shown in "edit all" or "show details" mode.                                                                                        |
| isBoolean          | true/false (`bool`)           | Indicates that a particular field is boolean.                                                                                                                            |
| isAssociative      | true/false (`boolean`)           | Indicates that an array of options is indeed an associative array. Example of an ambiguous array of options: `['0' => 'Zero', '1' => 'One']`.                         |
| disabled           | true/false (`bool`)           | Disables the field (not supported by all field types).                                                                                                                   |
| readonly           | true/false (`bool`)           | Makes the field read only (not supported by all field types).                                                                                                            |
| csv                | Delimiter (`string`)             | The choice of this field will not be stored as serialized string but rather as given delimiter-separated list. Example: `'eval' => ['csv'=>',']`                 |
| tl_class           | CSS class(es) (`string`)         | Add the given CSS class(es) to the generated HTML. See section [Arranging Fields](palettes.md#arranging-fields) for supported values.                                 |
| dcaPicker          | true/false (`bool`)           | If true the dca-picker will be shown.  Enables pick up different data sets from the system.                                                                              |

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
| alnum       | allows alphanumeric characters only (including full stop [.] minus [-], underscore [_] and space [ ])             |
| extnd       | disallows `#<>()\\=`                                                                                              |
| date        | expects a valid date                                                                                              |
| time        | expects a valid time                                                                                              |
| datim       | expects a valid date and time                                                                                     |
| friendly    | expects a valid "friendly name format" e-mail address                                                             |
| email       | expects a valid e-mail address                                                                                    |
| emails      | expects a valid list of valid e-mail addresses                                                                    |
| url         | expects a valid URL                                                                                               |
| alias       | expects a valid alias                                                                                             |
| folderalias | expects a valid folder URL alias                                                                                  |
| phone       | expects a valid phone number (numeric characters, space [ ], plus [+], minus [-], parentheses [()] and slash [/]) |
| prcnt       | allows numbers between 0 and 100                                                                                  |
| locale      | expects a valid locale (e.g. "de-CH")                                                                             |
| language    | expects a valid language code                                                                                     |
| google+     | expects a Google+ ID or vanity name                                                                               |
| fieldname   | expects a valid field name (added in version 3.5.16 / 4.2.3)                                                      |


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
4.3, one can use [Doctrine Schema Representation][2] to take full advantage of
the Doctrine Database Abstraction Layer.

**Examples:**

| Doctrine Schema Representation                                          | SQL Equivalent                    |
|:------------------------------------------------------------------------|:----------------------------------|
| `['type' => 'string', 'length' => 32, 'default' => '']`                 | `varchar(32) NOT NULL default ''` |
| `['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => '']` | `char(1) NOT NULL default ''`     |
| `['type' => 'integer', 'notnull' => false, 'unsigned' => true]`         | `INT unsigned NULL`               |



[1]: https://docs.contao.org/books/manual/current/en/02-administration-area/listing-records.html
[2]: http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/schema-representation.html#column
[3]: ../../../framework/hooks/
