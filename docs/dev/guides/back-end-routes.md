---
title: "Back End Routes"
description: "Custom routes within the Contao back end."
aliases:
  - /guides/backend-routes
  - /guides/back-end-routes
---


## Adding custom back end routes

You can use the Contao back end to display content generated in your own custom Controllers.
This way you can develop custom extensions without the need to use DCA configuration.
The following example can be changed according to your own setup. For example you're
not obliged to use the annotation configuration for your routes you could use
XML or YAML interchangeably.


### Create your Controller and Template

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
 *     defaults={
 *         "_scope" = "backend",
 *         "_token_check" = true,
 *         "_backend_module" = "my-module"
 *     }
 * )
 */
class BackendController extends AbstractController
{
    private $twig;
    
    public function __construct(TwigEnvironment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke()
    {
        return new Response($this->twig->render(
            'my_backend_route.html.twig', 
            []
        ));
    }
}
```

We need three different route parameters.

* `_scope`: This forces the scope of this route to be `backend`. That way you're
telling Contao, that this route belongs to the back end and should be handled accordingly.
* `_token_check`: If you're using Contao forms with the RequestToken integration
you need to set this to true, in order to get it to work.
* `_backend_module`: This attribute is not mandatory but will be used to match
the current route in order to highlight the currently active node in the back end menu.
More on this later.

Be sure to have imported your bundles Controllers in your `routing.yml` *before*
the `ContaoCoreBundle` routes.

```yaml
# config/routing.yml
app.controller:
    resource: ../src/Controller
    type: annotation
```

Our route `backendRouteAction` will render the template `my_backend_route.html.twig`
which must be placed into `/templates`.

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


### Extend the back end menu

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

class BackendMenuListener
{
    protected $router;
    protected $requestStack;

    public function __construct(RouterInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
    }

    public function onBuild(MenuEvent $event): void
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
                ->setCurrent($this->requestStack->getCurrentRequest()->get('_backend_module') === 'my-module')
        ;

        $contentNode->addChild($node);
    }
}

```

This EventListener creates a new menu node and handles its own `currentState` by
reading and matching the previously mentioned request attribute `_backend_module`.

The only thing left to do is to register the EventListener in the service container.
For this to work, we add the following lines to our service configuration in `config/services.yml`.

```yaml
services:
    App\EventListener\BackendMenuListener:
        arguments:
            - "@router"
            - "@request_stack"
        tags:
            - { name: kernel.event_listener, event: contao.backend_menu_build, method: onBuild, priority: -255 }
```

We purposely assign it a low priority, so that we can be sure to be loaded after
the Contao Core EventListeners. Otherwise, the `content` node we assign ourself to
will not be available yet.

And that's it. You controller should now be callable from the main back end menu in
the sidebar.


[BackEndMenuEvent]: /reference/events/#contao-backend-menu-build