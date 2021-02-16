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

    public function __construct(ContaoFramework $framework)
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
use App\Controller\ExampleController;
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
        $url = $this->router->generate(ExampleController::class, ['id' => 1]);
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
        if ($isBackendAdmin = $this->security->isGranted('ROLE_ADMIN')) {
            // …
        }
    
        if ($isBackendUser = $this->security->isGranted('ROLE_USER')) {
            // …
        }

        if ($isFrontendUser = $this->security->isGranted('ROLE_MEMBER')) {
            // …
        }
    }
}
```


## SimpleTokenParser

{{< version "4.10" >}}

This service allows parsing *simple tokens*. See the [usage examples][SimpleTokenUsage] from the tests for more details.

```php
use Contao\CoreBundle\Util\SimpleTokenParser;

class Example
{
    private $parser;

    public function __construct(SimpleTokenParser $parser)
    {
        $this->parser = $parser;
    }

    public function execute()
    {
        // Token replacement
        $output = $this->parser->parse(
            'I like ##cms##.',
            ['cms' => 'Contao']
        );

        // Conditional expressions
        $output = $this->parser->parse(
            'This is {if value>=10}big{else}small{endif}',
            ['value' => 20]
        );
    }
}
```


### Extending the parser

The simple token parser builds on top of the [Symfony Expression Language][ExpressionLanguage]. If you want to extend
its functionality, you can register an [expression provider][ExpressionProvider] that adds your own expression functions:

 1. Create a service that implements `Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface`
 2. Return an array of expression functions in the `getFunctions()` method
 3. Tag the service with `contao.simple_token_extension`


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


## CsrfTokenManager

This service allows you to generate and validate [request tokens][RequestTokens]. You will need this service for custom
forms for example that will allow the front end user to generate a POST request on a Contao route. Such requests need
to have a valid request token present. Contao registers its own `Symfony\Component\Security\Csrf\CsrfTokenManager` under 
the service ID `@contao.csrf.token_manager` and configures its own token name under the parameter 
`%contao.csrf_token_name%`.

```php
// src/Controller/ContentElement/ExampleFormElementController.php
namespace App\Controller\ContentElement;

use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\ServiceAnnotation\ContentElement;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @ContentElement(category="texts")
 */
class ExampleFormElementController extends AbstractContentElementController
{
    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;

    /**
     * @var string
     */
    private $csrfTokenName;

    public function __construct(CsrfTokenManagerInterface $csrfTokenManager, string $csrfTokenName)
    {
        $this->csrfTokenManager = $csrfTokenManager;
        $this->csrfTokenName = $csrfTokenName;
    }

    protected function getResponse(Template $template, ContentModel $model, Request $request): ?Response
    {
        $template->token = $this->csrfTokenManager->getToken($this->csrfTokenName)->getValue();

        return $template->getResponse();
    }
}
```

```html
<!-- contao/templates/ce_example_form_element.html5 -->
<form>
  <input type="hidden" name="REQUEST_TOKEN" value="<?= $this->token ?>">
  <!-- … -->
</form>
```


[SimpleTokenUsage]: https://github.com/contao/contao/blob/master/core-bundle/tests/Util/SimpleTokenParserTest.php
[ExpressionLanguage]: https://symfony.com/doc/current/components/expression_language.html
[ExpressionProvider]: https://symfony.com/doc/current/components/expression_language/extending.html#components-expression-language-provider
[RequestTokens]: /framework/request-tokens/
