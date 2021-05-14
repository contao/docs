---
title: "Callbacks"
description: "Callbacks within a Data Container Array."
weight: 6
aliases:
  - /reference/dca/callbacks/
---


Callbacks are entry-points for custom code in the DCA. Using callbacks you
can modify the static Data Container Array during runtime.

Callback functions are based on the event dispatcher pattern. They are similar 
to [Hooks][hooks], but always bound to a specific DCA table. You can register
one or more callbacks for a certain event and when the event is triggered, the
callback functions are being executed. See the [framework article][registerCallbacks]
on how to register callbacks.

{{% notice tip %}}
You can also use [anonymous functions](http://php.net/functions.anonymous) for DCA callbacks.
{{% /notice %}}

The following is a reference of all available callbacks, using their service tag
callback property name.

{{% notice info %}}
Generally these callbacks are exectued in the back end, e.g. when editing data records.
However in some instances they might also be executed by front end modules, most
prominently the member modules. In this case the parameters passed to the callback
will be different, as there will be no `\Contao\DataContainer` instance for example,
which only exists in the back end. The reference below will list these differences
of the respective callbacks. Keep in mind that any extension might also execute
any of these callbacks in the front end.
{{% /notice %}}

***


## Global Callbacks


### `config.onload`

Executed when the DataContainer object is initialized. Allows you to e.g. check
permissions or to modify the Data Container Array dynamically at runtime.

{{% expand "Parameters" %}}
#### Back end

* `\Contao\DataContainer` Data Container object

**return:** _void_


#### Front end modules "Personal data", "Registration", "Password" & "Change Password"

_No parameters._

**return:** _void_
{{% /expand %}}

{{% expand "Example" %}}
This example changes the `mandatory` attribute for the `tl_content.text` field for a specific content element.

```php
// src/EventListener/DataContainer/MakeTextNotMandatoryCallback.php
namespace App\EventListener\DataContainer;

use Contao\ContentModel;
use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @Callback(table="tl_content", target="config.onload")
 */
class MakeTextNotMandatoryCallback
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function __invoke(DataContainer $dc = null): void
    {
        if (!$dc->id || 'edit' !== $this->requestStack->getCurrentRequest()->query->get('act')) {
            return;
        }

        $element = ContentModel::findById($dc->id);

        if (null === $element || 'text' !== $element->type) {
            return;
        }

        $GLOBALS['TL_DCA']['tl_content']['fields']['text']['eval']['mandatory'] = false;
    }
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

Executed when a back end form is submitted _after_ the record has been updated
in the database. Allows you to e.g. modify the record afterwards (used to calculate 
intervals in the calendar extension).

{{% expand "Parameters" %}}
#### Back end

* `\Contao\DataContainer` Data Container object

**return:** _void_


#### Front end module "Personal data"

* `\Contao\FrontendUser` The front end user instance
* `\Contao\ModulePersonalData` The front end module instance

**return:** _void_
{{% /expand %}}


### `config.ondelete`

Executed before a record is removed from the database.

{{% expand "Parameters" %}}
#### `DC_Folder` (e.g. `tl_files`)

* `string` The path of the file
* `\Contao\DataContainer` Data Container object

**return:** _void_


#### Other Data Containers

* `\Contao\DataContainer` Data Container object
* `integer` The ID of the `tl_undo` database record

**return:** _void_
{{% /expand %}}

{{% expand "Example" %}}
This example also removes a record from a different table, if a front end member
is deleted in the back end.

```php
// src/EventListener/DataContainer/MemberDeleteCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use Doctrine\DBAL\Connection;

/**
 * @Callback(table="tl_member", target="config.ondelete")
 */
class MemberDeleteCallbackListener
{
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function __invoke(DataContainer $dc, int $undoId): void
    {
        if (!$dc->id) {
            return;
        }

        $this->db->delete('tl_foobar', ['member' => (int) $dc->id]);
    }
}
```
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
* `integer` Insert ID
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


### `config.onrestore`

Executed after a record has been restored from an old version.

{{% notice info %}}
This callback is deprecated and will be removed in Contao 5.0. Use [config.onrestore_version](#configonrestore_version)
instead.
{{% /notice %}}

{{% expand "Parameters"%}}
* `integer` Parent ID of the `tl_version` entry
* `string` Table
* `array` Record data
* `integer` Version number

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


## Listing Callbacks

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
* `string` Always empty
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

{{% expand "Example for tree view" %}}
This example adds an icon to the label of the example entity as tree view.

```php
// src/EventListener/DataContainer/ExampleLabelCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use Contao\Image;

/**
 * @Callback(table="tl_example", target="list.label.label")
 */
class ExampleLabelCallbackListener
{
    public function __invoke(array $row, string $label, DataContainer $dc, string $imageAttribute = '', bool $returnImage = false, ?bool $isProtected = null): string
    {
        $icon = Image::getHtml('bundles/app/images/example.svg');

        return $icon.sprintf(' %s <span class="tl_gray" style="margin-left:3px;">[%s]</span>', $row['title'], $row['name']);
    }
}
```
{{% /expand %}}

{{% expand "Example for list view" %}}
This example translates a dynamic status field for the label of the example entity as list view.

```php
// src/EventListener/DataContainer/ExampleLabelCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Callback(table="tl_example", target="list.label.label")
 */
class ExampleLabelCallbackListener
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    
    public function __invoke(array $row, string $label, DataContainer $dc, array $labels): array
    {
        $fieldName = 'status';
        $fields = $GLOBALS['TL_DCA'][$dc->table]['list']['label']['fields'];
        $key = array_search($fieldName, $fields, true);

        $labels[$key] = $this->translator->trans('tl_example.status_option.'.$labels[$key], [], 'contao_tl_example') ?? $this->translator->trans('tl_example.status_option_unknown', [], 'contao_tl_example');

        return $labels;
    }
}
```
{{% /expand %}}

***


## Operations callbacks

{{% notice note %}}
All operations callbacks are _singular_ callbacks - meaning there can only be
one callback, not multiple ones.
{{% /notice %}}

The following is a list of button callbacks for operations. Replace `<OPERATION>`
in each case with the actual [operation][DcaListOperations] you want to use the callback for.

These callbacks allow for individual navigation icons and is e.g. used in the
site structure to disable buttons depending on the user's permissions (requires
an additional command check via load_callback).


### `list.global_operations.<OPERATION>.button`

{{% expand "Parameters" %}}
* `string`/`null` Button href
* `string` Label
* `string` Title
* `string` Class
* `string` HTML attributes
* `string` Table
* `array` IDs of all root records

**return:** `string` HTML for the button
{{% /expand %}}


### `list.operations.<OPERATION>.button`

{{% expand "Parameters" %}}
* `array` Record data
* `string`/`null` Button href
* `string` Label
* `string` Title
* `string`/`null` Icon
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


## Field Callbacks

The following is a list of callbacks for DCA fields. Replace `<FIELD>` with a
field name of your choice.


### `fields.<FIELD>.options`

{{% notice note %}}
The `fields.<FIELD>.options` callback is a _singular_ callback - meaning there can
only be one callback, not multiple ones.
{{% /notice %}}

Allows you to define an individual function to load data into a drop-down menu
or checkbox list. Useful e.g. for conditional foreinKey-relations.

{{% expand "Parameters" %}}
* `\Contao\DataContainer`/`null` Data Container object

**return:** `array` Array of available options
{{% /expand %}}


### `fields.<FIELD>.input_field`

{{% notice note %}}
The `fields.<FIELD>.input_field` callback is a _singular_ callback - meaning there
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


### `fields.<FIELD>.load`

Executed when a form field is initialized and can e.g. be used to load a default
value.

{{% expand "Parameters" %}}
#### Back end

* `mixed` Currently stored value
* `\Contao\DataContainer` Data Container object

**return:** `mixed` New value to be loaded


#### Front end module "Personal data"

* `mixed` Currently stored value
* `\Contao\FrontendUser` The front end user instance
* `\Contao\ModulePersonalData` The front end module instance

**return:** `mixed` New value to be loaded
{{% /expand %}}


### `fields.<FIELD>.save`

Executed when a field is submitted and can e.g. be used to add an individual
validation routine. If the new value does not validate, you can throw an
`\Exception` with an appropriate error message. The record will not be saved
then and the error message will be shown in the form.

{{% expand "Parameters" %}}
#### Back end

* `mixed` Value to be saved
* `\Contao\DataContainer` Data Container object

**return:** `mixed` New value to be saved


#### Front end module "Personal data"

* `mixed` Value to be saved
* `\Contao\FrontendUser` The front end user instance
* `\Contao\ModulePersonalData` The front end module instance

**return:** `mixed` New value to be saved


#### Front end module "Registration"

* `mixed` Value to be saved

**return:** `mixed` New value to be saved
{{% /expand %}}


### `fields.<FIELD>.wizard`

Allows you to add additional HTML after the field input, typically used to show
a button that starts a "wizard".

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object

**return:** `string` HTML for the button
{{% /expand %}}


### `fields.<FIELD>.xlabel`

Allows you to add additional HTML after the field label, typically used to show
a button for an import "wizard".

{{% expand "Parameters" %}}
* `\Contao\DataContainer` Data Container object

**return:** `string` HTML for the button
{{% /expand %}}


### `fields.<FIELD>.eval.url`

Allows you to add an url to the serp preview field.

{{% expand "Parameters" %}}
* `\Contao\Model` Model object (class from the table)

**return:** `string` URL for the serp preview
{{% /expand %}}

{{% expand "Example" %}}

```php
// src/EventListener/DataContainer/ExampleSerpPreviewUrlCallbackListener.php
namespace App\EventListener\DataContainer;

use App\Model\ExampleCategoryModel;
use App\Model\ExampleModel;
use Contao\Config;
use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\PageModel;

/**
 * @Callback(table="tl_example", target="fields.serpPreview.eval.url")
 */
class ExampleSerpPreviewUrlCallbackListener
{
    public function __invoke(ExampleModel $model): string
    {
        /** @var ExampleCategoryModel $category */
        $category = $model->getRelated('pid');

        if (null === $category) {
            throw new \Exception('Invalid category');
        }

        /** @var PageModel $page */
        $page = $category->getRelated('jumpTo');

        if (null === $page) {
            throw new \Exception('Invalid jumpTo page');
        }

        $suffix = $page->getAbsoluteUrl(Config::get('useAutoItem') ? '/%s' : '/items/%s');

        return sprintf(preg_replace('/%(?!s)/', '%%', $suffix), $model->alias ?: $model->id);
    }
}
```
{{% /expand %}}


### `fields.<FIELD>.eval.title_tag`

Allows you to modify the title tag of the serp preview field.

{{% expand "Parameters" %}}
* `\Contao\Model` Model object (class from the table)

**return:** `string` title tag for the serp preview
{{% /expand %}}

{{% expand "Example" %}}

```php
// src/EventListener/DataContainer/ExampleSerpPreviewTitleTagCallbackListener.php
namespace App\EventListener\DataContainer;

use App\Model\ExampleCategoryModel;
use App\Model\ExampleModel;
use Contao\Controller;
use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\LayoutModel;
use Contao\PageModel;

/**
 * @Callback(table="tl_example", target="fields.serpPreview.eval.title_tag")
 */
class ExampleSerpPreviewTitleTagCallbackListener
{
    public function __invoke(ExampleModel $model): string
    {
        /** @var ExampleCategoryModel $category */
        $category = $model->getRelated('pid');

        if (null === $category) {
            return '';
        }

        /** @var PageModel $page */
        $page = $category->getRelated('jumpTo');

        if (null === $page) {
            return '';
        }

        $page->loadDetails();

        /** @var LayoutModel $layout */
        $layout = $page->getRelated('layout');

        if (null === $layout) {
            return '';
        }

        global $objPage;
        $objPage = $page;

        return Controller::replaceInsertTags(str_replace('{{page::pageTitle}}', '%s', $layout->titleTag ?: '{{page::pageTitle}} - {{page::rootPageTitle}}'));
    }
}
```
{{% /expand %}}


## Edit Callbacks

The following is a list of callbacks relating to edit actions of a Data Container.


### `edit.buttons`

Allows you to modify the action buttons at the bottom of record editing form. This
can be used to add additional buttons or remove any of the existing buttons.

{{% expand "Parameters" %}}
* `array` Array of strings
* `\Contao\DataContainer` Data Container object

**return:** `array` Array of strings containing the buttons' markup
{{% /expand %}}

{{% expand "Example" %}}
This example removes the "Save and close" button from the editing form of a record
of the `tl_example` Data Container.

```php
// src/EventListener/DataContainer/EditButtonsCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;

/**
 * @Callback(table="tl_example", target="edit.buttons")
 */
class EditButtonsCallbackListener
{
    public function __invoke(array $buttons, DataContainer $dc): array
    {
        // Remove the "Save and close" button
        unset($buttons['saveNclose']);

        return $buttons;
    }
}
```
{{% /expand %}}

## Select Callbacks


The following is a list of callbacks relating to select actions of a Data Container.

### `select.buttons`

Allows you to modify the action buttons at the bottom after selecting rows. This
can be used to add additional buttons or update and remove any of the existing buttons.

{{% expand "Parameters" %}}
* `array` Array of strings
* `\Contao\DataContainer` Data Container object

**return:** `array` Array of strings containing the buttons' markup
{{% /expand %}}

{{% expand "Example" %}}
This example removes the "delete" button from the editing form of a record
of the `tl_example` Data Container.

```php
// src/EventListener/DataContainer/SelectButtonsCallbackListener.php
namespace App\EventListener\DataContainer;

use Contao\CoreBundle\ServiceAnnotation\Callback;
use Contao\DataContainer;

/**
 * @Callback(table="tl_example", target="select.buttons")
 */
class SelectButtonsCallbackListener
{
    public function __invoke(array $buttons, DataContainer $dc): array
    {
        // Remove the delete button
        unset($buttons['delete']);
        
        return $buttons;
    }
}
```
{{% /expand %}}

[hooks]: /framework/hooks/
[registerCallbacks]: /framework/dca/#registering-callbacks
[DcaListOperations]: /reference/dca/list/#operations
