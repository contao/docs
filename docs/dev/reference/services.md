---
title: Services
description: Overview of Contao's Symfony Services relevant to your development.
aliases:
    - /framework/services/
---


This is a list of potentially helpful services available within the Contao Managed Edition.
Some are part of Contao's own framework while others originate from Symfony or other dependencies.


## ContaoFramework

This service manages and initializes Contao's legacy framework. If you need any
functionality from the legacy framework (e.g. Models) or you want to create adapters
for Contao's static classes, then you need to use this service.

```php
use Contao\CoreBundle\Framework\ContaoFramework;

class Example
{
    public function __construct(private readonly ContaoFramework $framework)
    {
    }

    public function execute()
    {
        $this->framework->initialize();

        $contentElement = \Contao\ContentModel::findById(…);

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
use Contao\CoreBundle\Csrf\ContaoCsrfTokenManager;
use Contao\CoreBundle\DependencyInjection\Attribute\AsContentElement;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsContentElement(category: 'texts')]
class ExampleFormElementController extends AbstractContentElementController
{
    public function __construct(private readonly ContaoCsrfTokenManager $csrfTokenManager)
    {
    }

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        $template->token = $this->csrfTokenManager->getDefaultTokenValue();

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


## Database Connection

Being able to operate on the database is of course a very common use case. Within Contao the database connection is provided via Symfony's
[Doctrine Bundle][DoctrineBundle]. The bundle provides each configured database connection via its own service instance. The name of the
service is `doctrine.dbal.[name]_connection` where `[name]` is the name of the database connection in your configuration. However, commonly
you will only have one database in your Contao instance, the `default` connection. The default database connection will be available via
the `database_connection` service (or `doctrine.dbal.default_connection`). All connection service instances will be of the type
`Doctrine\DBAL\Connection`.

```php
use Doctrine\DBAL\Connection;

class Example
{
    public function __construct(private readonly Connection $connection)
    {
    }

    public function __invoke(): void
    {
        $records = $this->connection->fetchAllAssociative("SELECT * FROM tl_foobar");

        // …
    }
}
```


## EntityCacheTags

{{< version "4.13" >}}

The `contao.cache.entity_tags` (`Contao\CoreBundle\Cache\EntityCacheTags`) service helps you tag responses and 
invalidate cache tags based on entity and model classes and instances. Contao uses a naming convention for database 
related tags: A tag `contao.db.tl_content.5` targets the content element with the ID 5, while `contao.db.tl_content` 
would target *all* content elements.

### Tagging

Instead of composing these tags yourself, let the service handle this for you by passing in class names or entity/model 
instances into one of its `tagWith()` methods:

```php
// An instance of a blog post entity with relations to an author (1:1) and comment entity (1:n)
$blog = $blogRepository->find(42);

// Will add the following tags:
// 'contao.db.tl_blog.42', 'contao.db.tl_author.123', 'contao.db.tl_blog_comment.1', 'contao.db.tl_blog_comment.2'
$entityCacheTags->tagWith([$blog, $blog->getAuthor(), $blog->getComments()]);

// Will add the tag 'contao.db.tl_blog'
$entityCacheTags->tagWith(Blog::class);
```

Tagging works with entity/model class names, objects and collections. You can also safely pass in `null`.

### Invalidating

Analogous to tagging, you can also use the service to invalidate certain cache tags. This, again, works with
entity/model class names, objects and collections as well as `null`:

```php
// Invalidates 'contao.db.tl_content', 'contao.db.tl_page.4', 'contao.db.tl_page.12'
$entityCacheTags->invalidateTagsFor([ContentModel::class, $pages]);
```

{{% notice "info" %}}
Contao's `AbstractController` is also using this functionality in the `tagResponse()` method.
{{% /notice %}}


## OptIn

{{< version "4.7" >}}

Contao offers an opt-in service (`contao.opt-in`) so that any opt-in process can be tracked centrally. The opt-in references will be saved 
for the legally required duration and are then automatically discarded (if applicable). The maximum length of the prefix before the "-" is 6.

```php
namespace App;

use App\Model\ExampleModel;
use Contao\CoreBundle\OptIn\OptIn;

class Example
{
    public function __construct(private readonly OptIn $optIn)
    {
    }

    public function createOptIn(string $email, ExampleModel $model, string $optInUrl): void
    {
        $token = $this->optIn->create('exampl-', $email, ['tl_example' => [$model->id]]);
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

        if (1 !== count($related) || 'tl_example' !== key($related) || null === ExampleModel::findById(current($related))) {
            throw new \RuntimeException('Invalid token');
        }

        $token->confirm();
    }
}
```


## Router

This service from Symfony handles any routing task and can be used to generate URLs to routes in your services.

```php
use App\Controller\ExampleController;
use Symfony\Component\Routing\RouterInterface;

class Example
{
    public function __construct(private readonly RouterInterface $router)
    {
    }

    public function execute()
    {
        $url = $this->router->generate(ExampleController::class, ['id' => 1]);
    }
}
```


## ScopeMatcher

The `contao.routing.scope_matcher` service provides the ability to identify the Contao scope of a request, if
applicable. It should be used instead of checking the deprecated `TL_MODE` constant.

```php
use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\HttpFoundation\RequestStack;

class Example
{
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly ScopeMatcher $scopeMatcher,
    ) {
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

{{< tabs groupId="services-contao4-contao5" >}}
{{% tab name="Contao 4" %}}
```php
use Contao\BackendUser;
use Contao\FrontendUser;
use Symfony\Component\Security\Core\Security;

class Example
{
    public function __construct(private readonly Security $security)
    {
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
{{% /tab %}}
{{% tab name="Contao 5" %}}
```php
use Contao\BackendUser;
use Contao\FrontendUser;
use Symfony\Bundle\SecurityBundle\Security;

class Example
{
    public function __construct(private readonly Security $security)
    {
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
{{% /tab %}}
{{< /tabs >}}

If you only need to check the authorization you can inject the `AuthorizationCheckerInterface` instead:

```php
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class Example
{
    public function __construct(private readonly AuthorizationCheckerInterface $auth)
    {
    }

    public function execute()
    {
        // Check for admin back end user role
        if ($this->auth->isGranted('ROLE_ADMIN')) {
            // …
        }

        // Check for regular back end user role
        if ($this->auth->isGranted('ROLE_USER')) {
            // …
        }

        // Check for front end user role
        if ($this->auth->isGranted('ROLE_MEMBER')) {
            // …
        }

        // Check whether the back end user can access any field in tl_page
        if ($this->auth->isGranted(ContaoCorePermissions::USER_CAN_EDIT_FIELDS_OF_TABLE, 'tl_page')) {
            // …
        }

        // Check whether the front end user is a member of specific groups
        if ($this->auth->isGranted(ContaoCorePermissions::MEMBER_IN_GROUPS, [2, 9])) {
            // …
        }
    }
}
```

If you only want to retrieve the logged in user you can inject the `TokenStorageInterface` instead:

```php
use Contao\BackendUser;
use Contao\FrontendUser;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Example
{
    public function __construct(private readonly TokenStorageInterface $tokenStorage)
    {
    }

    public function execute()
    {
        // Get current back end user
        if (($user = $this->tokenStorage->getToken()?->getUser()) instanceof BackendUser) {
            // …
        }

        // Get current front end user
        if (($user = $this->tokenStorage->getToken()?->getUser()) instanceof FrontendUser) {
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
    public function __construct(private readonly SimpleTokenParser $parser)
    {
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
    public function __construct(private readonly Slug $slug)
    {
    }

    public function getSlug(string $text, string $locale = 'en', string $validChars = '0-9a-z'): string
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
    public function __construct(
        private readonly Slug $slug,
        private readonly Connection $db,
    ) {
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
    public function __construct(private readonly TokenChecker $tokenChecker)
    {
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

## InsertTagParser

{{< version "4.13" >}}

This service lets you replace Insert Tags in within strings.

Some methods return a `ChunkedText` instance. The `ChunkedText` container was created to keep the surrounding text 
containing the insert tags separate from the replacements made by the insert tag parser. It is used for example in the 
twig escaper to skip encoding on inserttag replacement results.

```php
use Contao\CoreBundle\InsertTag\ChunkedText;
use Contao\CoreBundle\InsertTag\InsertTagParser;

class Example
{
    public function __construct(private readonly InsertTagParser $insertTagParser)
    {
    }

    public function __invoke(string $buffer): string
    {
        // Returns a string and should be used in HTML context when the replaced result is sent as a response to the 
        // client. It will allow ESI tags that can improve caching behaviour.
        $resultReplace = $this->insertTagParser->replace($buffer);

        // Returns a string and should be used when the result is not sent to a client 
        // (e.g. when using `$email->subject()`).
        $resultReplaceInline = $this->insertTagParser->replaceInline($buffer);

        // Returns a ChunkedText instance and should be used in HTML context when the replaced result is sent as a 
        // response to the client. It will allow ESI tags that can improve caching behaviour.
        $resultChunked = $this->insertTagParser->replaceChunked($buffer);

        // Returns a ChunkedText instance and should be used when the result is not sent to a client.
        $resultChunked = $this->insertTagParser->replaceInlineChunked($buffer);

        // Example usage for ChunkedText
        if ($resultChunked instanceof ChunkedText) {
            $parts = [];

            foreach ($resultChunked as [$type, $chunk]) {
                $parts[] = ChunkedText::TYPE_RAW === $type
                    ? $chunk
                    : htmlspecialchars($chunk);
            }

            return implode('', $parts);
        }
    }
}
```


## RequestStack

Symfony's [RequestStack][RequestStack] service provides a general way to retrieve the current request from the service
container, in case the request object is not otherwise already available.

```php
use Symfony\Component\HttpFoundation\RequestStack;

class Example
{
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    public function __invoke()
    {
        $request = $this->requestStack->getCurrentRequest();

        // Access request properties here
    }
}
```


## ResponseContextAccessor

This service allows you to access the [response context][ResponseContext] for the current Contao request or set one.

```php
namespace App;

use Contao\CoreBundle\Routing\ResponseContext\HtmlHeadBag\HtmlHeadBag;
use Contao\CoreBundle\Routing\ResponseContext\ResponseContextAccessor;

class ExampleService
{
    public function __construct(private readonly ResponseContextAccessor $responseContextAccessor)
    {
    }

    public function __invoke(): void
    {
        $responseContext = $this->responseContextAccessor->getResponseContext();

        if ($responseContext?->has(HtmlHeadBag::class)) {
            /** @var HtmlHeadBag $htmlHeadBag */
            $htmlHeadBag = $responseContext->get(HtmlHeadBag::class);

            // …
        }
    }
}
```


## Locales

This service can be used to retrieve a list of locale or language IDs or to provide labels for such a list.
See `contao.intl.locales` and `contao.intl.enabled_locales` in the [Container configuration][ContainerConfig].
Translations can be customized using language keys like `LNG.en`, `LNG.de_AT` and so on.

```php
namespace App;

use Contao\CoreBundle\Intl\Locales;

class ExampleService
{
    public function __construct(private readonly Locales $locales)
    {
    }

    public function __invoke(): void
    {
        // Returns all locale IDs as configured in contao.intl.locales
        $this->locales->getLocaleIds();

        // Returns only languages (de, en,…) without regions (de_DE, de_AT, en_US)
        $this->locales->getLanguageLocaleIds();

        // Returns only the enabled locale IDs as configured in contao.intl.enabled_locales
        $this->locales->getEnabledLocaleIds();
        
        // Same as getLocaleIds() but the array uses the locale IDs as the key
        // and their translated labels as values.
        $this->locales->getLocales();

        // Returns translated locales in German together with their native translation
        $this->locales->getLocales('de', true);
        
        // Same as getLanguageLocaleIds() but with translated labels
        $this->locales->getLanguages('de', true);
        
        // Same as getEnabledLocaleIds() but with translated labels
        $this->locales->getEnabledLocales('de', true);
        
        // Returns translations for the passed locales
        $this->locales->getDisplayNames(['de', 'en']);

        // Returns translations in German together with their native translation
        $this->locales->getDisplayNames(['de', 'en'], 'de', true);
    }
}
```


## Countries

This service can be used to retrieve a list of countries or country codes.
See `contao.intl.countries` in the [Container configuration][ContainerConfig].
Translations can be customized using language keys like `CNT.de`, `CNT.at` and so on.

```php
namespace App;

use Contao\CoreBundle\Intl\Countries;

class ExampleService
{
    public function __construct(private readonly Countries $countries)
    {
    }

    public function __invoke(): void
    {
        // Returns all country codes as configured in contao.intl.countries in uppercase
        $this->countries->getCountryCodes();

        // Same as getCountryCodes() but the array uses the country code as the key
        // and their translated labels as values.
        $this->countries->getCountries();

        // Returns the translated countries in German
        $this->countries->getCountries('de');
    }
}
```


## Mailer

If you want to create and send emails directly instead of using Contao's legacy `Contao\Email` class, you can use the
[Symfony Mailer][SymfonyMailer] (which is internally used by the legacy class).

```php
namespace App;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ExampleService
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function __invoke(): void
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            ->subject('Lorem ipsum dolor')
            ->text('Lorem ipsum dolor sit amet.')
            ->html('<p>Lorem ipsum dolor sit amet.</p>')
        ;

        $this->mailer->send($email);
    }
}
```


## PageFinder

{{< version "5.3" >}}

The `contao.routing.page_finder` service provides some utility methods in order to find pages from the site structure 
for a hostname, a request, etc. Since Contao **5.4.** this service also provies a `getCurrentPage()` method to get the 
current (or given) request's page (instead of having to access `$GLOBALS['objPage']`).

```php
namespace App;

use Contao\CoreBundle\Routing\PageFinder;

class ExampleService
{
    public function __construct(private readonly PageFinder $pageFinder)
    {
    }

    public function __invoke(): void
    {
        // The root page for the given domain (and optional language)
        $rootPageForHost = $this->pageFinder->findRootPageForHostAndLanguage('example.com');

        // The current request's page, if applicable
        $currentPage = $this->pageFinder->getCurrentPage();

        // …
    }
}
```


[SimpleTokenUsage]: https://github.com/contao/contao/blob/5.x/core-bundle/tests/String/SimpleTokenParserTest.php
[ExpressionLanguage]: https://symfony.com/doc/current/components/expression_language.html
[ExpressionProvider]: https://symfony.com/doc/current/components/expression_language/extending.html#components-expression-language-provider
[RequestTokens]: /framework/request-tokens/
[DoctrineBundle]: https://symfony.com/doc/current/reference/configuration/doctrine.html
[RequestStack]: https://symfony.com/doc/current/service_container/request.html
[ResponseContext]: /framework/response-context/
[ContainerConfig]: /reference/config/
[SymfonyMailer]: https://symfony.com/doc/current/mailer.html
