---
title: "Content Elements for your Table"
menuTitle: "Using Content Elements for your Table"
description: "This guide shows how to use Contao's content elements as child records for the records of your own table."
aliases:
  - /guides/using-content-elements/
---


In Contao, Content Elements are the fundamental content blocks. The records for
these content elements are stored in the `tl_content` table, which comes with its
own Data Container Array definition. Within the Contao core (and its core extensions), 
content elements are used to define the content of regular pages (via their articles)
and the detail content of news and events. Thus the records of `tl_content` are
all associated with a specific _parent table_.

As shown in the guide for [Managing Data Records][ManagingDataRecords] a data container
can have child tables as well as a specific parent table. The same principle is
used for content elements: all DCAs that enable you to use content elements within
them define `tl_content` as one of their child tables - but there can only be one
parent table. By default the `ptable` definition of `tl_content` is empty. It needs
to be set dynamically. This could be done directly in your DCA adjustment of `tl_content` 
\- or via the [`loadDataContainer`][LoadDataContainerHook] hook.

The following explains the necessary steps in order to be able to create, edit and
then render content elements for your own DataContainer.


## Adjusting the DCA of your Table

First we have a look at the necessary changes within the Data Container Array configuration
of your own table. Two changes are necessary: adding the new child table and adding
a new operation for the list in order to create and edit content elements.

Within the `config` of your DCA, add a `ctable` entry (if you do not already have
one) and add `tl_content` as one of the child tables:

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example'] = [
    'config' => [
        // …
        'ctable' => ['tl_content'],
    ],
    // …
];
```

Next add a new operation to the `list` section. Traditionally the action to edit
the content elements of a parent is called `edit` and uses the `edit.svg` icon of
the back end theme, whereas the action to edit the properties of the parent records
is called `editheader` and uses the `header.svg` icon of the back end theme. However,
this is entirely up to you. In principle you can name these actions as you like
and also choose different icons.

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example'] = [
    // …
    'list' => [
        // …
        'operations' => [
            'edit' => [
                'href' => 'table=tl_content',
                'icon' => 'edit.svg',
            ],
            'editheader' => [
                'href' => 'act=edit',
                'icon' => 'header.svg',
            ],
            // …
        ],
    ],
    // …
];
```


## Adjusting the Back End Module

When using the newly added `edit` operation from the previous step, Contao will
now tell you, that `tl_content` is not an allowed table for your back end module.

To enable editing of `tl_content` records within your back end module, it needs
to be within the list of `tables` of your back end module:

```php
// contao/config/config.php
$GLOBALS['BE_MOD']['content']['example'] = [
    'tables' => ['tl_example', 'tl_content'],
];
```


## Adjusting the Parent Table

Editing `tl_content` records will now be possible with the previous steps - however,
the `ptable` definition of `tl_content` will still be empty and thus Contao would
not know which parent table should be assigned to any new record of `tl_content`.
As already mentioned we will use a service where we listen to the [`loadDataContainer`][LoadDataContainerHook]
and adjust the `ptable` definition of the `tl_content` DCA accordingly.

```php
// src/EventListener/SetPtableForContentListener.php
namespace App\EventListener;

use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @Hook("loadDataContainer")
 */
class SetPtableForContentListener
{
    private $requestStack;
    private $scopeMatcher;

    public function __construct(RequestStack $requestStack, ScopeMatcher $scopeMatcher)
    {
        $this->requestStack = $requestStack;
        $this->scopeMatcher = $scopeMatcher;
    }

    public function __invoke(string $table)
    {
        // We only want to adjust the DCA of tl_content
        if ('tl_content' !== $table) {
            return;
        }

        $request = $this->requestStack->getCurrentRequest();

        // Check if this is a back end request
        if (null === $request || !$this->scopeMatcher->isBackendRequest($request)) {
            return;
        }

        // Check if we are in our "example" back end module
        if ('example' === $request->query->get('do')) {
            $GLOBALS['TL_DCA']['tl_content']['config']['ptable'] = 'tl_example';
        }
    }
}
```

This event listener checks set the `ptable` for `tl_content` to our own `tl_example`
table under the following conditions:

* The DataContainer definition to be loaded is for `tl_content`.
* The current request is actually a back end request, as front end requests are 
  of no interest to us for this purpose.
* The `do` action in the back end coincides with the name of our back end module.


## Rendering your Content Elements

Rendering the content elements for a specific parent ID and parent table can be
done with the help of two static functions of the Contao framework:

* `\Contao\ContentModel::findPublishedByPidAndTable(…)`
* `\Contao\Controller::getContentElement(…)`

The former returns a collection of models found in the database for the given parent
ID and parent table while the latter will render a content element by its given ID.
A front end module utilising these functions could look like this:

```php
// src/Controller/FrontendModule/ExampleModuleController.php
namespace App\Controller\FrontendModule;

use App\Model\ExampleModel;
use Contao\ContentModel;
use Contao\Controller;
use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\ServiceAnnotation\FrontendModule;
use Contao\ModuleModel;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @FrontendModule(category="miscellaneous")
 */
class ExampleModuleController extends AbstractFrontendModuleController
{
    protected function getResponse(Template $template, ModuleModel $model, Request $request): ?Response
    {
        // Get the parent ID via a query parameter
        $parentId = $request->query->get('example_id');

        // Get the parent record
        $example = ExampleModel::findById($parentId),

        if (null === $example) {
            return new Response();
        }

        // Fill the template with data from the parent record
        $template->setData(array_merge($example->row(), $template->getData()));

        $template->content = function() use ($request, $parentId): ?string {
            // Get all the content elements belonging to this parent ID and parent table
            $elements = ContentModel::findPublishedByPidAndTable($parentId, 'tl_example');

            if (null === $elements) {
                return null;
            }

            // The layout section is stored in a request attribute
            $section = $request->attributes->get('section', 'main');

            // Get the rendered content elements
            $content = '';

            foreach ($elements as $element) {
                $content .= Controller::getContentElement($element->id, $section);
            }

            return $content;
        };

        return $template->getResponse();
    }
}
```

This controller assigns a new variable to the template, which is actually an anonymous
function. Whenever this variable is accessed, the function is executed. Assuming 
you are using a query parameter to show the detail content of a given parent ID, 
this function will retrieve the content models for this parent ID and then render
and return these content elements.

```html
<!-- contao/templates/mod_example_module.html5 -->
<?php $this->extend('block_searchable'); ?>

<?php $this->block('content'); ?>

  <!-- This triggers our anonymous function and renders the content elements -->
  <?= $this->content ?>

<?php $this->endblock(); ?>
```

{{% notice note %}}
The advantage of using an anonymous function for rendering the content elements
is that the elements are only fetched from the database and rendered if they are
actually requested within the template. Thus if you have multiple modules and templates
where one renders the content elements and the other one does not, there is no performance
penalty, since the work is only done as needed and not multiple times.
{{% /notice %}}


[ManagingDataRecords]: /guides/dca/
[LoadDataContainerHook]: /reference/hooks/loadDataContainer/
