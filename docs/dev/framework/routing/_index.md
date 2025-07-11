---
title: "Routing"
description: "Routing in Contao"
alias:
  - /framework/routing/
---


This section covers "routing" in Contao, e.g. how to implement your own routes in
the Managed Edition, Contao-specific route attributes and Page controllers.


## Implementing Custom Routes

Routing and controllers are a core concept of any Symfony application. Regardless
of whether you are using Contao within your own Symfony application or the Managed
Edition, the same principles apply. This subsection provides a short introduction
on how to implement your own routes and controllers in the Contao Managed Edition.
Have a look at the [Symfony routing documentation][SymfonyRouting] for the full
range of possibilities.

Routes can be defined either in XML/PHP/YAML files or via annotations. For simplicity
this guide will only show the latter. To start off, we first need to tell Symfony
that our routes will be defined via annotations:

{{% expand "Defining routes in Contao 4.4" %}}
In Contao **4.4** you need to create a YAML file with the following definition:

```yaml
# app/config/routes.yaml
app.controller:
    resource: ../src/Controller
    type: annotation
```

This definition will not be automatically loaded however. In order to load this
YAML file within your Contao Managed Edition, you first need to create an
[Application-Specific Manager Plugin](/framework/manager-plugin/#the-application-specific-manager-plugin)
and implement the [`RoutingPluginInterface`](/framework/manager-plugin/#the-routingplugininterface):

```php
// src/ContaoManager/Plugin.php
namespace App\ContaoManager;

use Contao\ManagerPlugin\Routing\RoutingPluginInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class Plugin implements RoutingPluginInterface
{
    public function getRouteCollection(LoaderResolverInterface $resolver, KernelInterface $kernel)
    {
        return $resolver
            ->resolve(__DIR__.'/../../app/config/routes.yaml')
            ->load(__DIR__.'/../../app/config/routes.yaml')
        ;
    }
}
```
{{% /expand %}}

{{% expand "Defining routes in Contao 4.9 and up" %}}
In Contao **4.9** and up you can create a `config/routes.yaml` which will automatically
be loaded:

```yaml
# config/routes.yaml
app.controller:
    resource: ../src/Controller
    type: annotation
```
{{% /expand %}}

{{% expand "Defining routes in Contao 5 and up" %}}
Starting with Contao **5** (Symfony **6**) this still works the same as shown above, however you can now switch the type
to `attribute` instead of `annotation`. In Symfony **7** (Contao **5.4+**) the support for `annotation` has been
dropped. Note that `annotation` in Symfony 6 will support both PHP attributes as well as annotations.

```yaml
# config/routes.yaml
app.controller:
    resource: ../src/Controller
    type: attribute
```
{{% /expand %}}

{{% expand "Defining routes in Contao 5.3 and up" %}}
Starting with Contao **5.3** routes based on annotations or attributes in the `src/Controller/` directory are
automatically loaded by the `contao/manager-bundle`, thus you do not need to create your own `config/routes.yaml` there.
However, you can still do as shown above if you want or need to define custom routes of course.
{{% /expand %}}

This will tell Symfony that any controller defined under `src/Controller` within
your application (i.e. the `App\Controller\` namespace) will use PHP annotations
for defining routes.

Now we can go right ahead and create a simple controller and define its route via the
`Symfony\Component\Routing\Annotation\Route` attribute:

```php
// src/Controller/ExampleController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/example', name: ExampleController::class)]
class ExampleController
{
    public function __invoke(Request $request): Response
    {
        return new Response('Hello World!');
    }
}
```

This is the most bare bones controller you can build. In this case it is implemented
as an [invokable controller][InvokableController]. The route itself is registered
with two parameters:

* The actual route: `/example`. Our controller will be reachable under this path
  in the front end.
* The name of the route: in this case we chose the [_Fully Qualified Class Name_][FQCN]
  (FQCN) of the controller as the
  name of the route. This takes advantage of your IDE's auto-complete feature, if
  you want to reference the route for the `UrlGenerator` for example.

We can use the `debug:router` command to confirm its successful registration:

```
$ vendor/bin/contao-console debug:router "App\Controller\ExampleController"
+--------------+---------------------------------------------------------+
| Property     | Value                                                   |
+--------------+---------------------------------------------------------+
| Route Name   | App\Controller\ExampleController                        |
| Path         | /example                                                |
| Path Regex   | #^/example$#sD                                          |
| Host         | ANY                                                     |
| Host Regex   |                                                         |
| Scheme       | ANY                                                     |
| Method       | ANY                                                     |
| Requirements | NO CUSTOM                                               |
| Class        | Symfony\Component\Routing\Route                         |
| Defaults     | _controller: App\Controller\ExampleController           |
| Options      | compiler_class: Symfony\Component\Routing\RouteCompiler |
+--------------+---------------------------------------------------------+
```

Accessing `https://example.com/example` in the front end should show the following:

```none
Hello World!
```

Within your controller you can access any information about the request via the
`Request` parameter that is automatically passed to the function of your action
(in this case the `__invoke` function of our invokable controller). See also the
[Symfony routing documentation][SymfonyRouteNameParams].

{{% notice tip %}}
When using controllers as services and taking advantage of dependency injection,
the controller's service needs to be set to `public` or be tagged with the
`controller.service_arguments` tag.

```php
// src/Controller/ExampleController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTag;

#[Route('/example', name: ExampleController::class)]
#[AsController]
class ExampleController
{
    public function __construct(
        private readonly AuthorizationCheckerInterface $authorizationChecker
    ) {
    }

    public function __invoke(): Response
    {
        if ($this->authorizationChecker->isGranted('ROLE_MEMBER')) {
            return new Response('Member is logged in.');
        }

        return new Response ('Member is not logged in.');
    }
}
```
{{% /notice %}}


## Request Attributes

When defining a route Symfony allows you to set some default parameters for the
request handled by this route. There are two different special request attributes 
that Contao will listen to during the handling of a request, which will be outlined
here. Contao will also set additional request attributes which you can then access 
within your controller.


### Request Scope

The scope of a request can be set via the `_scope` request attribute. If the value
of this attribute is either `frontend` or `backend`, the request will be identified
as a "Contao request" and thus handled accordingly with the following effects:

* The `_locale` request attribute will be automatically set by Contao, according
  to which language the current request belongs to (depending on your site structure, 
  if the request can be matched there) or the `Accept-Language` request header.
* The CSRF protection is automatically enabled.
* The user session is automatically recorded in the database, if a logged in user 
  is present.
* The output of content elements and front end modules change, depending on the
  scope. For example, front end modules typically do not show their output in the
  back end, but instead show the headline and name of the module instead.
* If the scope is `backend`, the route is automatically protected by the `contao_backend` firewall. Contao will also automatically generate 
  a "referer ID token" and store it as another request attribute under `_contao_referer_id`. Plus the current and last URL will be stored in
  the session. This is used in the back end for the "go back" links for example.
* Depending on the scope, different session bags will be used in the session and
  the session bag's data will be replaced with the user's stored session from the
  database.

{{% notice tip %}}
In your own services you can query the current scope using the [`ScopeMatcher`](/reference/services/#scopematcher)
service.
{{% /notice %}}

The following example will execute any request to the defined controller in the
Contao `frontend` scope:

```php
// src/Controller/ExampleController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/example', name: ExampleController::class, defaults: ['_scope' => 'frontend'])]
class ExampleController
{
    public function __invoke(): Response
    {
        return new Response('I am a Contao request!');
    }
}
```

See the [Back End Routes Guide][BackEndRoutes] for a full example and explanation
on how to create your own controller for the Contao back end.


### CSRF Protection

Contao comes with its own protection against CSRF attacks. This protection can be
enabled for your own controller by using the `_token_check` request attribute. The
protection is enabled by default for any Contao request (and thus can be disabled
using the request attribute), but needs to be manually enabled for your custom controller
that does not use either of Contao's scopes.

```php
// src/Controller/ExampleController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/example', name: ExampleController::class, defaults: ['_token_check' => true])]
class ExampleController
{
    public function __invoke(): Response
    {
        return new Response('I am a CSRF protected controller.');
    }
}
```

See the article on [Request Tokens][RequestTokens] for more details.


### Maintenance Mode

The Contao back end allows you to enable a maintenance mode in the front end. The
maintenance mode is applied globally, but you can exempt routes by using the `_bypass_maintenance`
request attribute for your own routes.

```php
// src/Controller/ExampleController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/example', name: ExampleController::class, defaults: ['_bypass_maintenance' => true])]
class ExampleController
{
    public function __invoke(): Response
    {
        return new Response('This route is exempt from the maintenance mode.');
    }
}
```


### Page Model

{{< version "5.0" >}}

The `Contao\PageModel` instance for a regular Contao page request is available under the `pageModel` request attribute.
This allows you to access any current and inherited attributes of the current page.

```php
// src/ExampleService.php
namespace App;

use Contao\PageModel;
use Symfony\Component\HttpFoundation\RequestStack;

class ExampleService
{
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    public function __invoke(): void
    {
        $request = $this->requestStack->getCurrentRequest();

        /** @var PageModel $page */
        if ($page = $request->attributes->get('pageModel')) {
            $title = $page->title;

            // …
        }
    }
}
```

{{% notice "info" %}}
This is also available in Contao **4.9** and later. However, prior to Contao **5** the `pageModel` attribute might also
just be an integer ID rather than a `PageModel` instance (specifically in fragment subrequests). The attribute might
also not be available at all, depending on the request's circumstances. As explained in the respective articles you can
use the `getPageModel()` method in fragment controller for content elements and fron end modules to retrieve the current
`PageModel`. If you need this in a different service in Contao 4 then you will need to copy the
[implementation](https://github.com/contao/contao/blob/705b8bcf18d3f30c967cf75a69c381b3397466f4/core-bundle/src/Controller/AbstractFragmentController.php#L50-L75)
of that method.
{{% /notice %}}

{{< version "5.4" >}}

Starting with Contao **5.4** you can also use the `PageFinder` to retrieve the `PageModel` of the current request, if
available:

```php
// src/ExampleService.php
namespace App;

use Contao\CoreBundle\Routing\PageFinder;

class ExampleService
{
    public function __construct(private readonly PageFinder $pageFinder)
    {
    }

    public function __invoke(): void
    {
        $page = $this->pageFinder->getCurrentPage();

        // …
    }
}
```


[SymfonyRouting]: https://symfony.com/doc/current/routing.html
[InvokableController]: https://symfony.com/doc/current/controller/service.html#invokable-controllers
[FQCN]: https://www.php-fig.org/psr/psr-4/
[BackEndRoutes]: /guides/back-end-routes/
[RequestTokens]: /framework/request-tokens/
[SymfonyRouteNameParams]: https://symfony.com/doc/current/routing.html#getting-the-route-name-and-parameters
