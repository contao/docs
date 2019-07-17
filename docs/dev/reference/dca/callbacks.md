---
title: "Callbacks"
description: "Callbacks within a Data Container Array."
weight: 3
---

Callbacks are entry-points for custom code in the DCA. Using callbacks you
can modify static Data Container Array during runtime.

Callback functions are based on the event dispatcher pattern. You can register
one or more callbacks for a certain event and when the event is triggered, the
callback functions are being executed.

Callbacks are very similar to [Hooks][hooks], but always bound to a specific DCA table.

{{% notice tip %}}
Since Contao 3.2.0, you can also use [anonymous functions](http://php.net/functions.anonymous) for DCA callbacks.
{{% /notice %}}

***

## Global callbacks


### `config.onload`

Executed when the DataContainer object is initialized. Allows you to e.g. check
permissions or to modify the Data Container Array dynamically at runtime.

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object

**return:** _void_
{{% /expand %}}

{{% expand "Example" %}}
```php
public function onLoadCallback(\Contao\DataContainer $dc): void
{
    // …
}
```
{{% /expand %}}



### `config.oncreate`

Executed when a new record is created.

{{% expand "Parameters" %}}
* `string` Table
* `integer` Insert ID
* `array` Fields of the new record
* `\Contao\DataContainer` Data Container object

**return:** _void_
{{% /expand %}}


### `config.onsubmit`

Executed when a back end form is submitted. Allows you to e.g. modify the form
data before it is written to the database (used to calculate intervals in the
calendar extension).

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object

**return:** _void_
{{% /expand %}}


### `config.ondelete`

Executed before a record is removed from the database.

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object
* `integer` The ID of the `tl_undo` database record

**return:** _void_
{{% /expand %}}


### `config.oncut`

Is executed after a record has been moved to a new position.

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object

**return:** _void_
{{% /expand %}}


### `config.oncopy`

Executed after a record has been duplicated.

{{% expand "Parameters" %}}
* `integer` Inset ID
* `\Contao\DataContainer` Data Container object

**return:** _void_
{{% /expand %}}


### `config.oncreate_version`

Executed after the old version of the record has been added to `tl_version`.

{{% expand "Parameters"%}}
* `string` Table
* `integer` Parent ID of the `tl_version` entry
* `integer` Version number
* `array` Record data

**return:** _void_
{{% /expand %}}


### `config.onrestore_version`

Executed after a record has been restored from an old version.

{{% expand "Parameters"%}}
* `string` Table
* `integer` Parent ID of the `tl_version` entry
* `integer` Version number
* `array` Record data

**return:** _void_
{{% /expand %}}


### `config.onundo`

Executed after a deleted record has been restored from the "undo" table.

{{% expand "Parameters"%}}
* `string` Table
* `array` Record data
* `\Contao\DataContainer` Data Container object

**return:** _void_
{{% /expand %}}


### `config.oninvalidate_cache_tags`

{{< version "4.7" >}}

This callback is executed whenever a record is changed in any way via the Contao
back end. It allows you to add additional cache tags that should be invalidated.

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object
* `array` Tags

**return:** `array` An array of cache tags to be invalidated
{{% /expand %}}


### `config.onshow`

{{< version "4.7" >}}

Allows you to customize the info <i class="fa fa-info-circle"></i> modal window
of a database record.

{{% expand "Parameters" %}}
* `array` Existing modal window data
* `array` Record data
* `\Contao\DataContainer` Data Container object

**return:** `array` An array containing the table rows and columns for the modal
window.
{{% /expand %}}

***

## Listing callbacks

{{% notice note %}}
All listing callbacks are _singular_ callbacks - meaning there can only be one
callback, not multiple ones.
{{% /notice %}}


### `list.sorting.paste_button`

Allows for individual paste buttons and is e.g. used in the site structure to
disable buttons depending on the user's permissions (requires an additional
command check via load_callback).

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object
* `array` Record data
* `string` Table
* `bool` Whether this is a circular reference of the tree view
* `array` Clipboard data
* `array` Children
* `string` "Previous" label
* `string` "Next" label

**return:** `string` HTML for additional buttons
{{% /expand %}}


### `list.sorting.child_record`

Defines how child elements are rendered in "parent view".

{{% expand "Parameters" %}}
* `array` Record data

**return:** `string` HTML for the child record
{{% /expand %}}


### `list.sorting.header`

Allows for individual labels in header of "parent view".

{{% expand "Parameters" %}}
* `array` Current header labels
* `\Contao\DataContainer` Data Container object

**return:** `array` Header labels
{{% /expand %}}


### `list.sorting.panel_callback.subpanel`

This callback allows you to inject HTML for custom panels. Replace `subpanel`
wit your custom panel's name.

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object

**return:** `string` HTML for panel
{{% /expand %}}


### `list.label.group`

Allows for individual group headers in the listing.

{{% expand "Parameters" %}}
* `string` Group
* `string` Mode
* `string` Field
* `array` Record data
* `\Contao\DataContainer` Data Container object

**return:** `string` The group to be grouped by
{{% /expand %}}


### `list.label.label`

Allows for individual labels in the listing and is e.g. used in the user module
to add status icons.

{{% expand "Parameters" %}}
#### Tree view

* `array` Record data
* `string` Current label
* `\Contao\DataContainer` Data Container object
* `string` HTML attributes for label
* `bool` Always false
* `bool` Whether the record is protected

**return:** `string` The record label

#### List view

* `array` Record data
* `string` Current label
* `\Contao\DataContainer` Data Container object
* `array` Columns with existing labels

**return:** `array` Columns with labels
{{% /expand %}}

***

## Operations callbacks

{{% notice note %}}
All operations callbacks are _singular_ callbacks - meaning there can only be
one callback, not multiple ones.
{{% /notice %}}

The following is a list of button callbacks for operations. Replace `operation`
in each case with the actual operation you want to use the callback for.

These callbacks allow for individual navigation icons and is e.g. used in the
site structure to disable buttons depending on the user's permissions (requires
an additional command check via load_callback).


### `list.global_operations.operation.button`

{{% expand "Parameters" %}}
* `string` Button href
* `string` Label
* `string` Title
* `string` Class
* `string` HTML attributes
* `string` Table
* `array` IDs of all root records

**return:** `string` HTML for the button
{{% /expand %}}


### `list.operations.operation.button`

{{% expand "Parameters" %}}
* `array` Record data
* `string` Button href
* `string` Label
* `string` Title
* `string` Icon
* `string` HTML attributes
* `string` Table
* `array` IDs of all root records
* `array` IDs of all child records
* `bool` Whether this is a circular reference of the tree view
* `string` "Previous" label
* `string` "Next" label
* `\Contao\DataContainer` Data Container object

**return:** `string` HTML for the button
{{% /expand %}}

***

## Field callbacks

The following is a list of callbacks for DCA fields. Replace `field` with a
field name of your choice.


### `fields.field.options`

{{% notice note %}}
The `fields.field.options` callback is a _singular_ callback - meaning there can
only be one callback, not multiple ones.
{{% /notice %}}

Allows you to define an individual function to load data into a drop-down menu
or checkbox list. Useful e.g. for conditional foreinKey-relations.

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object

**return:** `array` Array of available options
{{% /expand %}}


### `fields.field.input_field`

{{% notice note %}}
The `fields.field.input_field` callback is a _singular_ callback - meaning there
can
only be one callback, not multiple ones.
{{% /notice %}}

Allows for the creation of individual form fields and is e.g. used in the back
end module "personal data" to generate the "purge data" widget. _Attention:_ the
field is not saved automatically!

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object
* `string` Extended label

**return:** `string` HTML output for the field
{{% /expand %}}


### `fields.field.load`

Executed when a form field is initialized and can e.g. be used to load a default
value.

{{% expand "Parameters" %}}
* `mixed` Currently stored value
* `\Contao\DataContainer` Data Container object

**return:** `mixed` New value to be loaded
{{% /expand %}}


### `fields.field.save`

Executed when a field is submitted and can e.g. be used to add an individual
validation routine. If the new value does not validate, you can throw an
`\Exception` with an appropriate error message. The record will not be saved
then and the error message will be shown in the form.

{{% expand "Parameters" %}}
* `mixed` Value to be saved
* `\Contoa\DataContainer` Data Container object

**return:** `mixed` New value to be saved
{{% /expand %}}


### `fields.field.wizard`

Allows you to add additional HTML after the field input, typically used to show
a button that starts a "wizard".

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object

**return:** `string` HTML for the button
{{% /expand %}}


### `fields.field.xlabel`

Allows you to add additional HTML after the field label, typically used to show
a button for an import "wizard".

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object

**return:** `string` HTML for the button
{{% /expand %}}

[hooks]: ../../../documentation/hooks/
