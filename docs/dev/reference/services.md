---
title: Services
description: Overview of Contao's Symfony Services relevant to your development.
aliases:
    - /framework/services/
---


{{% notice info %}}
This list is still incomplete.
{{% /notice %}}


## ContaoFramework

This service manages and initializes Contao's legacy framework. If you need any
functionality from the legacy framework (e.g. Models) or you want to create adapters
for Contao's static classes, then you need to use this service.

```php
use Contao\CoreBundle\Framework\ContaoFramework;

class Example
{
    private $framework;

    public function __consruct(ContaoFramework $framework)
    {
        $this->framework = $framework;
    }

    public function execute()
    {
        $this->framework->initialize();

        $contentElement = \Contao\ContentModel::findByPk(…);

        $system = $this->framework->getAdapter(\Contao\System::class);
        $system->loadLanguageFile('default');
        
        // …
    }
}
```


## Router

This service from symfony handles any routing task and can be ued to generate URLs
to routes in your services.

```php
use App\Action\ExampleAction;
use Symfony\Component\Routing\RouterInterface;

class Example
{
    private $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function execute()
    {
        $url = $this->router->generate(ExampleAction::class, ['id' => 1]);
    }
}
```


## ScopeMatcher

This service provides the ability to identify the Contao scope of a request, if
applicable. It should be used instead of checking the deprecated `TL_MODE` constant.

```php
use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\HttpFoundation\RequestStack;

class Example
{
    private $requestStack;
    private $scopeMatcher;

    public function __construct(RequestStack $requestStack, ScopeMatcher $scopeMatcher)
    {
        $this->requestStack = $requestStack;
        $this->scopeMatcher = $scopeMatcher;
    }

    public function isBackend()
    {
        return $this->scopeMatcher->isBackendRequest($this->requestStack->getCurrentRequest());
    }

    public function isFrontend()
    {
        return $this->scopeMatcher->isFrontendRequest($this->requestStack->getCurrentRequest());
    }
}
```


## Security Helper

Not directly related to Contao, but this helper service from Symfony lets you retrieve
the current Contao front end or back end user from the firewall.

```php
use Contao\BackendUser;
use Contao\FrontendUser;
use Symfony\Component\Security\Core\Security;

class Example
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function execute()
    {
        if (($backendUser = $this->security->getUser()) instanceof BackendUser) {
            // …
        }

        if (($frontendUser = $this->security->getUser()) instanceof FrontendUser) {
            // …
        }
    }
}
```


## TokenChecker

This service let's you query information of the Contao related security tokens, if
present. It allows you to check, whether a token for a front end user, back end
user or the preview mode is present. It also allows you to retrieve the username 
of the token.


```php
use Contao\CoreBundle\Security\Authentication\Token\TokenChecker;
use Contao\BackendUser;
use Contao\FrontendUser;

class Example
{
    private $tokenChecker;

    public function __construct(TokenChecker $tokenChecker)
    {
        $this->tokenChecker = $tokenChecker;
    }

    public function execute()
    {
        if ($this->tokenChecker->hasFrontendUser()) { /* … */ }
        if ($this->tokenChecker->hasBackendUser()) { /* … */ }
        if ($this->tokenChecker->isPreviewMode()) { /* … */ }
        if (null !== ($frontendUsername = $this->tokenChecker->getFrontendUsername())) { /* … */ }
        if (null !== ($backendUsername = $this->tokenChecker->getBackendUsername())) { /* … */ }
    }
}
```
