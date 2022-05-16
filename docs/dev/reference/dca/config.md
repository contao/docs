---
title: "Config"
description: "Configuration of the table itself."
weight: 1
---


The table configuration describes the table itself, e.g. which type of data
container is used to store the data or how it relates to other tables. Also you
can enable versioning or define what happens to child records when data is being
edited or deleted.


## Example

```php
use Contao\DC_Table;

// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['config'] = [
    'dataContainer' => DC_Table::class,
    'enableVersioning' => true,
    'sql' => [
        'keys' => [
            'id' => 'primary',
        ],
    ],
];
```


## Reference

| Key                | Value                             | Description                                                                                                                                                                                                             |
|--------------------|-----------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| label              | `&$GLOBALS['TL_LANG']` (`string`) | The label is used with page or file trees and typically includes reference to the language array.                                                                                                                       |
| ptable             | Parent table (`string`)           | Name of the related parent table (table.pid = ptable.id).                                                                                                                                                               |
| dynamicPtable      | true/false (`bool`)               | Dynamically set the parent table like in `tl_content`.                                                                                                                                                                  |
| ctable             | Child tables (`array`)            | Name of the related child tables (table.id = ctable.pid).                                                                                                                                                               |
| dataContainer      | Data Container (`string`)         | `\Contao\DC_Table` (database table)<sup>1</sup>, `\Contao\DC_File` (local configuration file) or `\Contao\DC_Folder` (file manager).                                                                                    |
| markAsCopy         | Field name (`string`)             | {{< version-tag "4.6" >}} Appends "(copy)" to this field when copying a record.                                                                                                                                         |
| uploadPath         | Folder name (`string`)            | {{< version-tag "4.12" >}} Path to the root folder of the file manager.                                                                                                                                                 |
| validFileTypes     | File extensions (`string`)        | Limits the file manager to certain file types (comma separated list).                                                                                                                                                   |
| editableFileTypes  | File extensions (`string`)        | {{< version-tag "4.12" >}} Limits the file types that can be edited with the source code editor (comma separated list).                                                                                                 |
| databaseAssisted   | true/false (`bool`)               | If true, the file manager is synchronized with a database table.                                                                                                                                                        |
| closed             | true/false (`bool`)               | If true, you cannot add further records to the table.                                                                                                                                                                   |
| notEditable        | true/false (`bool`)               | If true, the table cannot be edited.                                                                                                                                                                                    |
| notDeletable       | true/false (`bool`)               | If true, records in the table cannot be deleted.                                                                                                                                                                        |
| notSortable        | true/false (`bool`)               | If true, records in the table cannot be sorted.                                                                                                                                                                         |
| notCopyable        | true/false (`bool`)               | If true, records in the table cannot be duplicated.                                                                                                                                                                     |
| notCreatable       | true/false (`bool`)               | If true, records in the table cannot be created but can be duplicated.                                                                                                                                                  |
| switchToEdit       | true/false (`bool`)               | Activates the "save and edit" button when a new record is added (sorting mode 4 only).                                                                                                                                  |
| enableVersioning   | true/false (`bool`)               | If true, Contao saves the old version of a record when a new version is created.                                                                                                                                        |
| doNotCopyRecords   | true/false (`bool`)               | If true, Contao will not duplicate records of the current table when a record of its parent table is duplicated.                                                                                                        |
| doNotDeleteRecords | true/false (`bool`)               | If true, Contao will not delete records of the current table when a record of its parent table is deleted.                                                                                                              |
| backlink           | Back link parameters (`string`)   | Optional query parameters for the back link, e.g. `do=news`.                                                                                                                                                            |
| [onload_callback](../callbacks/#config-onload)                       | Callback functions (`array`)      | Calls a custom function when a DataContainer is initialized and passes the DataContainer object as argument.                                                                                                            |
| [onsubmit_callback](../callbacks/#config-onsubmit)                   | Callback functions (`array`)      | Calls a custom function after a record has been updated and passes the DataContainer object as argument.                                                                                                                |
| [ondelete_callback](../callbacks/#config-ondelete)                   | Callback functions (`array`)      | Calls a custom function when a record is deleted and passes the DataContainer object as argument.                                                                                                                       |
| [oncut_callback](../callbacks/#config-oncut)                         | Callback functions (`array`)      | Calls a custom function when a record is moved and passes the DataContainer object as argument.                                                                                                                         |
| [oncopy_callback](../callbacks/#config-oncopy)                       | Callback functions (`array`)      | Calls a custom function when a record is duplicated and passes the insert ID and the DataContainer object as argument.                                                                                                  |
| [onundo_callback](../callbacks/#config-onundo)                       | Callback functions (`array`)      | Calls a custom function when a deleted record has been restored from the "undo" table.                                                                                                                                  |
| [onversion_callback](../callbacks/#config-onversion)                 | Callback functions (`array`)      | Calls a custom function when a new version of a record is created and passes the table, the insert ID and the DataContainer object as argument.                                                                         |
| [onrestore_callback](../callbacks/#config-onrestore)                 | Callback functions (`array`)      | Calls a custom function when a version of a record is restored and passes the insert ID, the table, the data array and the version as argument.  This callback is deprecated, use `onrestore_version_callback` instead. |
| [onrestore_version_callback](../callbacks/#config-onrestore-version) | Callback functions (`array`)      | Calls a custom function when a version of a record is restored and passes the table, insert ID, the table, the version and the data array as argument.                                                                  |
| sql                | Table configuration (`array`)     | Describes table configuration, e.g. `'keys' => [ 'id' => 'primary', 'pid' => 'index' ]`, see [SQL configuration](#sql-configuration).                                                                                   |

{{% notice note %}}
<sup>1</sup> A Data Container of type `\Contao\DC_Table` also needs at least the primary key configuration for the database table, as shown in the <nobr>[example](#example).</nobr>
{{% /notice %}}


### SQL Configuration

The `$GLOBALS['TL_DCA']['tl_example']['config']['sql']` part of your DCA configuration allows you to set various SQL properties for your
table (and thus is only relevant for the `Table` data container).


| Key | Value | Description |
| --- | --- | --- |
| `engine` | Storage engine (`string`) | Allows you to define the storage engine for this table different to the default. |
| `charset` | Character set (`string`) | Allows you to define the character set for this table different to the default. |
| `keys` | Keys and indexes (`array`) | Allows you to define primary keys and indexes for your fields. |


#### SQL Keys and Indexes

The `$GLOBALS['TL_DCA']['tl_example']['config']['sql']['keys']` part of your DCA configuration allows you to define whether a field should
be the primary key or have a general or even unique index applied to it. This array consists of the field name as the key and the index
definition as the value. The key can also consist of multiple field names separated by a comma in order to create combined indexes.

```php
$GLOBALS['TL_DCA']['tl_example']['config'] = [
    // …
    'sql' => [
        'keys' => [
            // Define the primary key of the table
            'id' => 'primary',
            // Create an index for the field "foobar" to speed up queries on this field
            'foobar' => 'index',
            // Set the field "alias" to be unique
            'alias' => 'unique',
            // Create a combined index for the fields "lorem" and "ipsum" to speed up queries that use both these fields
            'lorem,ipsum' => 'index',
        ],
    ],
];
```
