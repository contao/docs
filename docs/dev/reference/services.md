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


## OptIn

Contao offers an opt-in service (`contao.opt-in`) so that any opt-in process can be tracked centrally. The opt-in references will be saved 
for the legally required duration and are then automatically discarded (if applicable).

```php
namespace App;

use App\Model\ExampleModel;
use Contao\CoreBundle\OptIn\OptIn;

class Example
{
    private $optIn;

    public function __construct(OptIn $optIn)
    {
        $this->optIn = $optIn;
    }

    public function createOptIn(string $email, ExampleModel $model, string $optInUrl): void
    {
        $token = $this->optIn->create('example-', $email, ['tl_example' => $model->id]);
        $token->send('Opt-In', 'Click this link to opt-in: '.$optInUrl.'?token='.$token->getIdentifier());
    }

    public function confirmOptIn($tokenId): void
    {
        $token = $this->optIn->find($tokenId);

        if (null === $token) {
            throw new \RuntimeException('Invalid token identifier');
        }

        if ($token->isConfirmed()) {
            throw new \RuntimeException('Token already confirmed');
        }

        $related = $token->getRelatedRecords();

        if (1 !== count($related) || 'tl_example' !== key($related) || null === ExampleModel::findByPk(current($related))) {
            throw new \RuntimeException('Invalid token');
        }

        $token->confirm();
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
        // Check for admin back end user role
        if ($this->security->isGranted('ROLE_ADMIN')) {
            // …
        }

        // Check for regular back end user role
        if ($this->security->isGranted('ROLE_USER')) {
            // …
        }

        // Check for front end user role
        if ($this->security->isGranted('ROLE_MEMBER')) {
            // …
        }

        // Get current back end user
        if (($user = $this->security->getUser()) instanceof BackendUser) {
            // …
        }

        // Get current front end user
        if (($user = $this->security->getUser()) instanceof FrontendUser) {
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


## Slug

The `contao.slug` service can be used to generate a so called "slug", i.e. a human-readable, unique identifier from non-standardized string. 
The service then in turn uses [`ausi/slug-generator`](https://github.com/ausi/slug-generator) and you can pass the same 
[options](https://github.com/ausi/slug-generator#options) as an associative array as the second parameter of the `generate` method:

```php
namespace App;

use Contao\CoreBundle\Slug\Slug;

class Example
{
    private $slug;

    public function __construct(Slug $slug)
    {
        $this->slug = $slug;
    }

    public function getSlug(string $text, string $locale = 'en', string $validChars = '0-9a-zA-Z'): string
    {
        $options = [
            'locale' => $locale,
            'validChars' => $validChars,
        ];

        return $this->slug->generate($text, $options);
    }
}
```

When using the `contao.slug` service rather than the `ausi/slug-generator` directly additional Contao-specific processing of the passed
string will take place, e.g. decoding HTML entities and stripping insert tags for example. The `contao.slug` service's `generate` method
also allows to pass a _duplicate check_ as a callable for the third parameter. This check will be used to automatically append a number to
the slug, if the slug already exists.

```php
namespace App;

use Contao\CoreBundle\Slug\Slug;
use Doctrine\DBAL\Connection;

class Example
{
    private $slug;
    private $db;

    public function __construct(Slug $slug, Connection $db)
    {
        $this->slug = $slug;
        $this->db = $db;
    }

    public function getSlug(string $text, string $locale = 'en', string $validChars = '0-9a-zA-Z'): string
    {
        $options = [
            'locale' => $locale,
            'validChars' => $validChars,
        ];

        $duplicateCheck = function (string $slug): bool {
            return $this->slugExists($slug);
        };

        return $this->slug->generate($text, $options, $duplicateCheck);
    }

    private function slugExists(string $slug): bool
    {
        return !empty($this->db->fetchAllAssociative("SELECT * FROM tl_example WHERE slug = ?", [$slug]));
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


[SimpleTokenUsage]: https://github.com/contao/contao/blob/master/core-bundle/tests/Util/SimpleTokenParserTest.php
[ExpressionLanguage]: https://symfony.com/doc/current/components/expression_language.html
[ExpressionProvider]: https://symfony.com/doc/current/components/expression_language/extending.html#components-expression-language-provider
[RequestTokens]: /framework/request-tokens/
