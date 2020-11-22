---
title: "Adding Custom Back End Routes"
menuTitle: "Back End Routes"
description: "Custom routes within the Contao back end."

aliases:
  - /guides/backend-routes
  - /guides/back-end-routes
---


{{% notice note %}}
This guide assumes a Contao version of at least **4.9**. Back end routes can be
created in previous Contao versions as well, but might require additional steps.
For example, in Contao **4.4** instead of using the `contao.backend_menu_build`
event, the back end menu needs to be altered using the `getUserNavigation` hook.
{{% /notice %}}

You can use the Contao back end to display content generated in your own custom Controllers.
This way you can develop custom extensions without the need to use DCA configuration.
The following example can be changed according to your own setup. For example you're
not obliged to use the annotation configuration for your routes you could use
XML or YAML interchangeably.


## Create your Controller and Template

The first step is to create your own Controller. A more detailed explanation
on how Symfony Controller work can be found in the [Symfony documentation](https://symfony.com/doc/current/controller.html).
The Controller class is placed inside the `Controller` directory
and is configured through annotations.

```php
// src/Controller/BackendController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as TwigEnvironment;

/**
 * @Route("/contao/my-backend-route",
 *     name=BackendController::class,
 *     defaults={"_scope": "backend"}
 * )
 */
class BackendController extends AbstractController
{
    private $twig;
    
    public function __construct(TwigEnvironment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(): Response
    {
        return new Response($this->twig->render(
            'my_backend_route.html.twig', 
            []
        ));
    }
}
```

There are two requirements for the route definition, in order to have a correct Contao
back end route:

- The route must start with `/contao/`, otherwise Contao's back end firewall will 
  not be in effect.
- We need an additional request parameter called `_scope` with the value `backend`.
  That way you are telling Contao, that this route belongs to the back end and should
  be handled accordingly.

Be sure to have imported your bundle's Controllers in your `routing.yml` *before*
the `ContaoCoreBundle` routes.

```yaml
# config/routes.yaml
app.controller:
    resource: ../src/Controller
    type: annotation
```

Our route will render the template `my_backend_route.html.twig` which must be placed 
into `/templates`.

```twig
{% extends "@ContaoCore/Backend/be_page.html.twig" %}

{% block headline %}
    Not only the content of the `title`-tag but also the title of the content section.
{% endblock %}

{% block error %}
    Will be placed within the error block.
{% endblock %}

{% block main %}
    <div class="tl_listing_container">
        Main Content.
    </div>
{% endblock %}
```

As we extend from `@ContaoCore/Backend/be_page.html.twig` it is worth noting
that there are three different blocks you can currently use:

* `headline`: This block renders the headline of the document.
* `error`: In case of an error, place your message here, it will be placed prominently
on the top of the page
* `main`: This is the content area for output.

This example renders like this:

![](../images/custom-backend-routes-1.png?classes=shadow)


## Extend the Back End Menu

Most of the time you probably want to add a menu entry for your back end module.
Since the back end menu can be extended with an `EventListener` we can easily
create one that listens for the [menu event][BackEndMenuEvent] to be dispatched.

```php
// src/EventListener/BackendMenuListener.php
namespace App\EventListener;

use App\Controller\BackendController;
use Contao\CoreBundle\Event\MenuEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTag;

/**
 * @ServiceTag("kernel.event_listener", event="contao.backend_menu_build", priority=-255)
 */
class BackendMenuListener
{
    protected $router;
    protected $requestStack;

    public function __construct(RouterInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
    }

    public function __invoke(MenuEvent $event): void
    {
        $factory = $event->getFactory();
        $tree = $event->getTree();

        if ('mainMenu' !== $tree->getName()) {
            return;
        }

        $contentNode = $tree->getChild('content');

        $node = $factory
            ->createItem('my-module')
                ->setUri($this->router->generate(BackendController::class))
                ->setLabel('My Modules')
                ->setLinkAttribute('title', 'Title')
                ->setLinkAttribute('class', 'my-module')
                ->setCurrent($this->requestStack->getCurrentRequest()->get('_controller') === BackendController::class)
        ;

        $contentNode->addChild($node);
    }
}
```

This EventListener creates a new menu node and handles its own current state by
reading and matching the controller class, which Symfony provides under the `_controller`
request attribute by default.

The EventListener registers itself to the `contao.backend_menu_build` event by using
a [`@ServiceTag` annotation][ServiceAnnotationBundle] directly in the PHP file. 
This allows us to skip defining a service tag in the service configuration. We 
purposely assign it a low priority, so that we can be sure to be loaded after the 
Contao Core EventListeners. Otherwise, the `content` node we assign ourself to will 
not be available yet.

And that's it. You controller should now be callable from the main back end menu in
the sidebar.


[BackEndMenuEvent]: /reference/events/#contao-backend-menu-build
[ServiceAnnotationBundle]: https://github.com/terminal42/service-annotation-bundle
