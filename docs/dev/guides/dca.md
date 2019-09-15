---
title: "Managing Data Records"
description: "Creating a DCA to manage custom data records."
---

In this tutorial we will have a look on how to build a [DCA][1] definition, so you 
can manage custom data records within the Contao back end for your web application 
project. We will devise an example utilising different features and then build each 
aspect step by step.


## Our Example

In our example we will assume that we are creating a web application for a 
wholesale dealer who is trading "industrial parts". Each part belongs to a vendor
and can have detailed information like the name, part number, description and an
image. Furthermore each vendor can have detailed information as well, like the
the name of the vendor and their main address.

For the back end workflow we decide that the "parts" should be organised as child
records for each vendor and that we will manage these records under the main menu
item called "Parts" within the other "Content" menu items.

For the actual data record tables we decide on the table names `tl_vendor` (for 
the vendor records) and `tl_parts` (for the parts records).


## Creating the DCA

Creating the DCA in this case is obviously divided into two main steps: creating
the DCA for our `tl_vendor` records and creating the DCA for our `tl_parts` records.
For each table, we will go through the individual steps of defining the [configuration][2],
[record listing][3], [fields][4], [palettes][5] and may be [callbacks][6].


### `tl_vendor`

To create our DCA for the `tl_vendor` table, first create the following file
within your Contao installation: `/contao/dca/tl_vendor.php` (_Note:_ prior to Contao
4.8 these files need to be created under `/app/Resources/contao/dca/tl_vendor.php`).


#### Config

For our DCA configuration of `tl_vendor`, we want to define the following:

* The data container for our records should be a database table.
* The records can have child records in the `tl_parts` table.
* We want to use the versioning feature to be enabled for these records.
* We will have a primary key called `id` for our records.

```php
// contao/dca/tl_vendor.php
$GLOBALS['TL_DCA']['tl_vendor'] = [
    'config' => [
        'dataContainer' => 'Table',
        'ctable' => ['tl_parts'],
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
            ],
        ], 
    ],
];
```

Defining the child record table is important so that we can then later actually
edit the child records for each vendor record.


#### List

Here is where things get more complex. We want:

* all vendor records to be sorted by their name
* to be able to search through vendors bei their name
* the listing to show us the name of the vendor
* to be able to edit the child records of each vendor
* to be able to edit the properties of each vendor
* to be able to delete the vendor

This results in the following configuration for the `list` part of the DCA:

```php
// contao/dca/tl_vendor.php
$GLOBALS['TL_DCA']['tl_vendor'] = [
    'config' => […],

    'list' => [
        'sorting' => [
			'mode' => 1,
			'fields' => ['name'],
			'flag' => 1,
			'panelLayout' => 'search,limit'
        ],
        'label' => [
			'fields' => ['name'],
			'format' => '%s',
        ],
		'operations' => [
			'edit' => [
				'href' => 'table=tl_parts',
				'icon' => 'edit.svg',
            ],
			'editheader' => [
				'href' => 'act=edit',
				'icon' => 'header.svg',
            ],
			'delete' => [
				'href' => 'act=delete',
				'icon' => 'delete.svg',
            ],
			'show' => [
				'href' => 'act=show',
				'icon' => 'show.svg'
            ],
        ],
    ],
];
```

As you can see we have defined the _sorting_ of all records and the _label_ and 
_operations_ for each record.


#### Fields

Now we will actually define the fields for our `tl_vendor` records. As previously
defined, each vendor should have a name and an address. We will further split the
address into _street_, _postal_, _city_ and _country_.

```php
// contao/dca/tl_vendor.php
$GLOBALS['TL_DCA']['tl_vendor'] = [
    'config' => […],
    'list' => […],

    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0]
        ],
        'name' => [
            'label' => &$GLOBALS['TL_LANG']['tl_vendor']['name'],
            'search' => true,
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'street' => [
            'label' => &$GLOBALS['TL_LANG']['tl_vendor']['street'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'postal' => [
            'label' => &$GLOBALS['TL_LANG']['tl_vendor']['postal'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'clr w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'city' => [
            'label' => &$GLOBALS['TL_LANG']['tl_vendor']['city'],
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'country' => [
            'label' => &$GLOBALS['TL_LANG']['tl_vendor']['country'],
            'inputType' => 'select',
            'options' => \Contao\System::getCountries(),
            'eval' => ['tl_class' => 'w50', 'mandatory' => true, 'includeBlankOption' => true],
            'sql' => ['type' => 'string', 'length' => 2, 'default' => '']
        ],
    ],
];
```

When table data records are managed by Contao, you always need to add at least
the fields `id` and `tstamp`. The latter will contain a Unix timestamp when the
record was last edited.

For the other fields have a look at the [fields reference][4] to see all the possibilities
for each field. For the `country` selection field we also used another feature:
we are retrieving all countries directly from the system via `\Contao\System::getCountries()`.
This gives us an associative array of all translated countries, indexed by their
country code (e.g. `'at' => 'Austria'`).


#### Palettes

When editing a record the layout of the input fields is defined by a "[palette][5]".
For our vendor records we only need to provide a single default palette. However,
within that palette, we will group the address information and thus separate it 
from the vendor's name.


```php
// contao/dca/tl_vendor.php
$GLOBALS['TL_DCA']['tl_vendor'] = [
    'config' => […],
    'list' => […],
    'fields' => […],

    'palettes' => [
        'default' => '{vendor_legend},name;{address_legend},street,postal,city,country'
    ],
];
```

This finishes our DCA definition for `tl_vendor`.


### `tl_parts`

Now we will execute the same steps for our `tl_parts` table. Only the major differences
will be outlined.


#### Config

The basic DCA configuration is the same as before. This time we do not have a child
table though, but we must define a parent table. Also we are using an [`onload_callback`][7]
here to dynamically adjust our DCA definition. We are assuming that the part number
always consists of the first two letters of the vendor. So to make things easier
for the editor, we fetch the name of the parent (the vendor) and define the first
two letters of the name as the default for the `number` field.

```php
// contao/dca/tl_parts.php
$GLOBALS['TL_DCA']['tl_parts'] = [
    'config' => [
        'dataContainer' => 'Table',
        'enableVersioning' => true,
        'ptable' => 'tl_vendor',
        'sql' => [
            'keys' => [
                'id' => 'primary'
            ],
        ],
        'onload_callback' => [
            function (\Contao\DataContainer $dc) {
                $db = \Contao\Database::getInstance();
                $pid = \Contao\Input::get('pid');
                $result = $db->prepare('SELECT `name` FROM `tl_vendor` WHERE `id` = ?')
                             ->execute([$pid]);
                $prefix = strtoupper(substr($result->name, 0, 2));
                $GLOBALS['TL_DCA']['tl_parts']['fields']['number']['default'] = $prefix;
            },
        ] 
    ],
];
```

{{% notice note %}}
Generally it is recommended to use services for such callbacks. For the
simplicity of this article an anonymous function is implemented, using the legacy 
way of retrieving the database connection and parameter inputs.
{{% /notice %}}


#### List

For the list configuration we are using sorting mode `4`, which is specific to
displaying child records of a parent record. In this mode however we need to define
a `child_record_callback`, otherwise no records will be rendered. this callback
is implemented as an anonymous function.

```php
// contao/dca/tl_parts.php
$GLOBALS['TL_DCA']['tl_parts'] = [
    'config' => […],

    'list' => [
        'sorting' => [
			'mode' => 4,
            'fields' => ['name'],
            'headerFields' => ['name'],
            'panelLayout' => 'search,limit',
            'child_record_callback' => function (array $row) {
                return '<div class="tl_content_left">'.$row['name'].' ['.$row['number'].']</div>';
            },
        ],
		'operations' => [
			'edit' => [
				'href' => 'act=edit',
				'icon' => 'edit.svg',
            ],
			'delete' => [
				'href' => 'act=delete',
				'icon' => 'delete.svg',
			],
			'show' => [
				'href' => 'act=show',
				'icon' => 'show.svg'
            ],
        ],
    ],
];
```


#### Fields

As described before, our parts will consist of a _name_, _number_, _description_
and an _image_. For our _description_ we will provide the ability to use the _TinyMCE_
editor. For the image we will configure the ability to use the file tree picker.

We also defined the flag `1` for our `name` field. Using list sorting mode `4` Contao 
will group the child records according to the given fields. By setting the flag 
of the field to `1`, the child records will be grouped by their name's initial letter.

```php
// contao/dca/tl_parts.php
$GLOBALS['TL_DCA']['tl_parts'] = [
    'config' => […],
    'list' => […],

    'fields' => [
        'id' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'autoincrement' => true],
        ],
        'pid' => [
            'foreignKey' => 'tl_vendor.name',
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0],
            'relation' => ['type'=>'belongsTo', 'load'=>'lazy']
        ],
        'tstamp' => [
            'sql' => ['type' => 'integer', 'unsigned' => true, 'default' => 0]
        ],
        'name' => [
            'label' => &$GLOBALS['TL_LANG']['tl_parts']['name'],
            'search' => true,
            'flag' => 1,
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'number' => [
            'label' => &$GLOBALS['TL_LANG']['tl_parts']['number'],
            'search' => true,
            'inputType' => 'text',
            'eval' => ['tl_class' => 'w50', 'maxlength' => 255, 'mandatory' => true],
            'sql' => ['type' => 'string', 'length' => 255, 'default' => '']
        ],
        'description' => [
            'label' => &$GLOBALS['TL_LANG']['tl_parts']['description'],
            'inputType' => 'textarea',
            'eval' => ['tl_class' => 'clr', 'rte' => 'tinyMCE', 'mandatory' => true],
            'sql' => ['type' => 'text', 'notnull' => false]
        ],
        'singleSRC' => [
            'label' => &$GLOBALS['TL_LANG']['tl_parts']['singleSRC'],
            'inputType' => 'fileTree',
            'eval' => [
                'tl_class' => 'clr',
                'mandatory' => true, 
                'fieldType' => 'radio', 
                'filesOnly' => true, 
                'extensions' => \Contao\Config::get('validImageTypes'), 
                'mandatory' => true,
            ],
            'sql' => ['type' => 'binary', 'length' => 16, 'notnull' => false, 'fixed' => true]
        ],
    ],
];
```


#### Palettes

The only thing left is the palette definition. We only need the default palette
and we will use only one group.

```php
// contao/dca/tl_parts.php
$GLOBALS['TL_DCA']['tl_parts'] = [
    'config' => […],
    'list' => […],
    'fields' => […],

    'palettes' => [
        'default' => '{parts_legend},name,number,description,singleSRC'
    ],
];
```


## Defining the Back End Module

So far there will not be a back end menu item yet where the records can be managed,
because the back end module definition is still missing. This is done in the `/contao/config/config.php`
file using the `$GLOBALS['BE_MOD']` global array. It is an associative array containing
all the back end modules grouped in their context (e.g. `content`).

For our back end module to appear as the last item in the main _Content_ menu, we
need to do the following:

```php
// contao/config/config.php
$GLOBALS['BE_MOD']['content']['parts'] = [
    'tables' => ['tl_vendor', 'tl_parts'],
];
```

The definition depends on the type of back end module. Since in our case we are
managing table records, we simply have to define the tables to be managed.


## Adding Translations

Now that we have finished the DCA configuration and added our back end module, we
can actually start creating and managing records. However, things will look a bit
off since our back end module is missing translations in many places. For example
labels for creating records and palette legends need to be defined for each data
container. Also we used references to translation variables for the labels of each
field - which are still empty.

Translations must be put into the `/contao/languages` folder, while each language
will have its own subfolder there. Our translations will go into the `/contao/languages/en` folder.

{{% notice note %}}
The English translations will also be the fallback when there are no other
translations available.
{{% /notice %}}

First we will add the translation for our back end module, which goes into the `modules.php`:

```php
// contao/languages/en/modules.php
$GLOBALS['TL_LANG']['MOD']['parts'] = ['Parts', 'Manage vendors and parts.'];
$GLOBALS['TL_LANG']['MOD']['tl_vendor'] = 'Vendors';
$GLOBALS['TL_LANG']['MOD']['tl_parts'] = 'Parts';
```

All other translations will go into files that have the same name as our data container
table names:

```php
// contao/languages/en/tl_vendor.php
$GLOBALS['TL_LANG']['tl_vendor']['new'] = ['Create new vendor', 'Creates a new vendor.'];
$GLOBALS['TL_LANG']['tl_vendor']['vendor_legend'] = 'Vendor';
$GLOBALS['TL_LANG']['tl_vendor']['address_legend'] = 'Address';
$GLOBALS['TL_LANG']['tl_vendor']['name'] = ['Name', 'Name of the vendor.'];
$GLOBALS['TL_LANG']['tl_vendor']['street'] = ['Street', "Street part of the vendor's address."];
$GLOBALS['TL_LANG']['tl_vendor']['postal'] = ['Postal code', "Postal code of the vendor's address."];
$GLOBALS['TL_LANG']['tl_vendor']['city'] = ['City', "City of the vendor's address."];
$GLOBALS['TL_LANG']['tl_vendor']['country'] = ['Country', "Country of the vendor's address."];
```

```php
// contao/languages/en/tl_parts.php
$GLOBALS['TL_LANG']['tl_parts']['new'] = ['Create new part', 'Creates a new part.'];
$GLOBALS['TL_LANG']['tl_parts']['parts_legend'] = 'Part';
$GLOBALS['TL_LANG']['tl_parts']['name'] = ['Name', 'Name of the part.'];
$GLOBALS['TL_LANG']['tl_parts']['number'] = ['Number', 'Part number.'];
$GLOBALS['TL_LANG']['tl_parts']['description'] = ['Description', 'Description of the part.'];
$GLOBALS['TL_LANG']['tl_parts']['singleSRC'] = ['Image', 'Image of the part.'];
```


[1]: ../../framework/dca
[2]: ../../reference/dca/config
[3]: ../../reference/dca/list
[4]: ../../reference/dca/fields
[5]: ../../reference/dca/palettes
[6]: ../../reference/dca/callbacks
[7]: ../../reference/dca/callbacks/#config-onload
