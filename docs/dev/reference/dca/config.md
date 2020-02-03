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
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['config'] = [
    'dataContainer'               => 'Table',
    'enableVersioning'            => true,
    'sql' => [
        'keys' => [
            'id' => 'primary',
        ]
    ]
];
```


## Reference

| Key                | Value                             | Description                                                                                                                                     |
|--------------------|-----------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------|
| label              | `&$GLOBALS['TL_LANG']` (`string`) | The label is used with page or file trees and typically includes reference to the language array.                                               |
| ptable             | Parent table (`string`)           | Name of the related parent table (table.pid = ptable.id).                                                                                       |
| dynamicPtable      | true/false (`bool`)               | Dynamically set the parent table like in `tl_content`.                                                                                          |
| ctable             | Child tables (`array`)            | Name of the related child tables (table.id = ctable.pid).                                                                                       |
| dataContainer      | Data Container (`string`)         | Table (database table), File (local configuration file) or Folder (file manager).                                                               |
| markAsCopy         | Field name (`string`)             | Appends "(copy)" to this field when copying a record (Contao __4.6__ and up).                                                                         |
| closed             | true/false (`bool`)               | If true, you cannot add further records to the table.                                                                                           |
| notEditable        | true/false (`bool`)               | If true, the table cannot be edited.                                                                                                            |
| notDeletable       | true/false (`bool`)               | If true, records in the table cannot be deleted.                                                                                                |
| notSortable        | true/false (`bool`)               | If true, records in the table cannot be sorted.                                                                                                 |
| notCopyable        | true/false (`bool`)               | If true, records in the table cannot be duplicated.                                                                                             |
| notCreatable       | true/false (`bool`)               | If true, records in the table cannot be created but can be duplicated.                                                                          |
| switchToEdit       | true/false (`bool`)               | Activates the "save and edit" button when a new record is added (sorting mode 4 only).                                                          |
| enableVersioning   | true/false (`bool`)               | If true, Contao saves the old version of a record when a new version is created.                                                                |
| doNotCopyRecords   | true/false (`bool`)               | If true, Contao will not duplicate records of the current table when a record of its parent table is duplicated.                                |
| doNotDeleteRecords | true/false (`bool`)               | If true, Contao will not delete records of the current table when a record of its parent table is deleted.                                      |
| [onload_callback](../callbacks/#configonload)                       | Callback functions (`array`)      | Calls a custom function when a DataContainer is initialized and passes the DataContainer object as argument.                                                                                                            |
| [onsubmit_callback](../callbacks/#configonsubmit)                   | Callback functions (`array`)      | Calls a custom function after a record has been updated and passes the DataContainer object as argument.                                                                                                                |
| [ondelete_callback](../callbacks/#configondelete)                   | Callback functions (`array`)      | Calls a custom function when a record is deleted and passes the DataContainer object as argument.                                                                                                                       |
| [oncut_callback](../callbacks/#configoncut)                         | Callback functions (`array`)      | Calls a custom function when a record is moved and passes the DataContainer object as argument.                                                                                                                         |
| [oncopy_callback](../callbacks/#configoncopy)                       | Callback functions (`array`)      | Calls a custom function when a record is duplicated and passes the insert ID and the DataContainer object as argument.                                                                                                  |
| [onundo_callback](../callbacks/#configonundo)                       | Callback functions (`array`)      | Calls a custom function when a deleted record has been restored from the "undo" table.                                                                                                                                  |
| [onversion_callback](../callbacks/#configonversion)                 | Callback functions (`array`)      | Calls a custom function when a new version of a record is created and passes the table, the insert ID and the DataContainer object as argument.                                                                         |
| [onrestore_callback](../callbacks/#configonrestore)                 | Callback functions (`array`)      | Calls a custom function when a version of a record is restored and passes the insert ID, the table, the data array and the version as argument.  This callback is deprecated, use `onrestore_version_callback` instead. |
| [onrestore_version_callback](../callbacks/#configonrestore_version) | Callback functions (`array`)      | Calls a custom function when a version of a record is restored and passes the table, insert ID, the table, the version and the data array as argument.                                                                  |
| sql                | Table configuration (`array`)     | Describes table configuration, e.g. `'keys' => [ 'id' => 'primary', 'pid' => 'index' ]`                                                         |
