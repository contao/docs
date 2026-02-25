---
title: "Front End Modules"
description: "Complex functionalities within your web pages."
aliases:
    - /documentation/front-end-modules/
    - /framework/content-modules/
    - /framework/front-end-modules/
---

Front end modules in Contao are used for more complex functionality, which are typically
used on more than one page or even in page layouts. They are used to generate dynamic
content, like news lists, displaying the detailed content of news or navigation items.

These modules are implemented as so called _fragment controllers_ which Contao then
renders into the main content, using their defined renderer. See the [caching documentation][fragments]
for more information.

Creating a front end module is very similar to creating [content elements][1].


## Definition

To create a new front end module, the following things must be defined and implemented:

* __Fragment Controller__ <br>
  The actual implementation of the front end module is done via a class that extends
  from `AbstractFrontendModuleController` of the Contao core.

* __Service Tag__ <br>
  To identify the controller as a Contao front end module, the service must be tagged
  with the service tag `contao.frontend_module` - and the tag will hold the following additional information:

  * __Type__ <a id="type"></a><br>
    The *type* of a front end module is a specific string which is used to identify
    the element's template (if not defined) and DCA palette. If omitted the type will be
    automatically inferred by converting the class name of the controller from pascal case to snake case and removing a
    possible `Controller` postfix.
  
  * __Category__ <br>
    All front end modules are categorised within the type dropdown of the front end module's palette. The default category
    is `miscellaneous` when using PHP attributes to tag the service.

  * __Template__ <br>
    If not specified, the [Twig template][TwigTemplates] name follows is the _type_ and prepends it with the
    `frontend_module/` path, i.e. `frontend_module/<type>.html.twig`.


## Example

Consider this fairly simple example of a front end module:

```php
// src/Controller/FrontendModule/ExampleModuleController.php
namespace App\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\Exception\RedirectResponseException;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Contao\PageModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule]
class ExampleModuleController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            if (null !== ($redirectPage = PageModel::findById($model->jumpTo))) {
                throw new RedirectResponseException($redirectPage->getAbsoluteUrl());
            }
        }

        $template->set('action', $request->getUri());

        return $template->getResponse();
    }
}
```

In this example the service tag was implemented via [PHP attributes](#registration). The controller itself processes the
request and checks, if it was a POST request. In that case, the redirect page is loaded via Contao's model functionality
and a `RedirectResponseException` is thrown to redirect to that page.

In order to be able to set the options for our front end module in the back end, we also need to define a [palette][2]
in the `tl_module` DCA configuration. The palette key is based on the _type_ of the front end module. Since we did not
specify a type in our example it defaults to `example_module` as explained above.

```php
// contao/dca/tl_module.php
$GLOBALS['TL_DCA']['tl_module']['palettes']['example_module'] = '
    {title_legend},name,headline,type;
    {redirect_legend},jumpTo;
';
```

This very simple palette enables us to select a redirect page using the pre-existing `jumpTo` field.

Using the naming convention for templates also mentioned above, the final template name for this front end module will
be `frontend_module/example_module` for [Twig templates][TwigTemplates]:

```twig
{# templates/frontend_module/example_module.html.twig #}
{% extends "@Contao/frontend_module/_base.html.twig" %}

{% block content %}
    <form action="{{ action }}" method="POST"> 
        <input type="hidden" name="REQUEST_TOKEN" value="{{ contao.request_token }}">
        <button type="submit">Submit</button>
    </form>
{% endblock %}
```

A "fragment template" instance of this template will automatically be generated and passed to the controller's
`getResponse()` method. The controller then returns the rendered Twig template as a response.


## Registration

As mentioned previously a front end module is registered by registering a controller as a service and tagging it with the 
`contao.frontend_module` service tag. The service tag supports the following options:

| Option   | Type     | Description                                                                                                                               |
| -------- | -------- | ------------------------------------------------------------------------------------------------------------------------------------------|
| name     | `string` | Must be `contao.frontend_module`.                                                                                                         |
| type     | `string` | _Optional:_ The *type* mentioned in [Type]({{% relref "#type" %}}) can be customized.                                                        |
| category | `string` | Defines in which option group this front end module will be placed in the module type selector.                                           |
| template | `string` | _Optional:_ Override the generated template name.                                                                                         |
| renderer | `string` | _Optional:_ The renderer can be changed to `inline` or `esi`. Defaults to `forward`. See [Caching Fragments][fragments] for more details. |
| method   | `string` | _Optional:_  Which method should be invoked on the controller.                                                                            |

Applying the service tag can either be done via PHP attributes, annotations or via the YAML configuration.

{{< tabs groupid="attribute-annotation-yaml" style="code" >}}

{{% tab title="Attribute" %}}
A front end module can be registered using the `AsFrontendModule` PHP attribute.

```php
// src/Controller/FrontendModule/ExampleModuleController.php
namespace App\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: 'miscellaneous')]
class ExampleModuleController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        return $template->getResponse();
    }
}
```

The above example only defines the mandatory `category` attribute. If you wish you can also define the other options of the service tag:

```php
// src/Controller/FrontendModule/ExampleModuleController.php
namespace App\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(
    type: 'example', 
    category: 'miscellaneous', 
    template: 'frontend_module/example', 
    renderer: 'forward', 
    method: '__invoke',
    priority: 100,
)]
class ExampleModuleController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        return $template->getResponse();
    }
}
```

However, it is recommended to only define what you need and otherwise leave the defaults.
{{% /tab %}}

{{% tab title="Annotation" %}}
A front end module can be registered using the `FrontendModule` annotation. The annotation can be used on the class of the front end module,
if the class is invokable (has an `__invoke` method) or extends from the `AbstractFrontendModuleController`. Otherwise the annotation can be 
used on the method that will deliver the response.

```php
// src/Controller/FrontendModule/ExampleModuleController.php
namespace App\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\ServiceAnnotation\FrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @FrontendModule(category="miscellaneous")
 */
class ExampleModuleController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        return $template->getResponse();
    }
}
```

The above example only defines the mandatory `category` attribute. If you wish you can also define the other options of the service tag:

```php
// src/Controller/FrontendModule/ExampleModuleController.php
namespace App\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\ServiceAnnotation\FrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @FrontendModule("example", category="miscellaneous", template="mod_example", renderer="forward", method="__invoke")
 */
class ExampleModuleController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        return $template->getResponse();
    }
}
```
{{% /tab %}}

{{% tab title="YAML" %}}
A front end module can be registered using the `contao.frontend_module` service tag.

```yaml
# config/services.yaml
services:
    App\Controller\FrontendModule\ExampleModuleController:
        tags:
            -
                name: contao.frontend_module
                category: miscellaneous
```
```php
// src/Controller/FrontendModule/ExampleModuleController.php
namespace App\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExampleModuleController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        return $template->getResponse();
    }
}
```

The above example only defines the mandatory `category` attribute. If you wish you can also define the other options of the service tag:

```yaml
# config/services.yaml
services:
    App\Controller\FrontendModule\ExampleModuleController:
        tags:
            -
                name: contao.frontend_module
                category: miscellaneous
                template: mod_example
                renderer: forward
                method: __invoke
```
{{% /tab %}}

{{< /tabs >}}


## Translations

In order to have a nice label in the back end, we also need to add a translation
for our front end module - otherwise it will only be named *example_module*.
The translation needs to be set as follows:

```yaml
# translation/contao_modules.en.yaml
FMD:
    example_module:
        - My front end module
        - A front end module for testing purposes
```


## Page Model

If your fragment extends from `AbstractFrontendModuleController` (or just `AbstractFragmentController`)
you can use `$this->getPageModel()` in order to receive the `\Contao\PageModel`
object of the currently rendered page of Contao's site structure.

```php
// src/Controller/FrontendModule/ExampleModuleController.php
namespace App\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\Exception\RedirectResponseException;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Contao\PageModel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(category: 'miscellaneous')]
class ExampleModuleController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $page = $this->getPageModel();

        // Get some information about the current page
        $template->set('rootTitle', $page->rootPageTitle ?: $page->rootTitle);

        return $template->getResponse();
    }
}
```


## Read More

* [DCA Configuration reference][2]
* [Manipulate and create palettes][3]
* [Create and use templates][4]
* [Customize Caching][5]


[1]: /framework/content-elements/
[2]: /reference/dca/
[3]: /reference/dca/palettes/
[4]: /framework/templates/
[5]: /framework/caching/
[fragments]: /framework/caching/#caching-fragments
[LegacyTemplates]: /framework/templates/legacy/
[TwigTemplates]: /framework/templates/
