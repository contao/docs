---
title: "Request Tokens (CSRF Protection)"
description: "CSRF protection in Contao"
alias:
  - /framework/request-tokens/
---

Cross Site Request Forgery (CSRF) is a very common security vulnerability. In its essence, it allows attackers to 
execute unwanted requests on behalf of their victim.
For example, an attacker might let a logged-in user submit a form containing politically incorrect data which is
then stored and assigned to that logged-in user.
You can find more information about how CSRF attacks work and how they can be mitigated on [the respective
website of the Open Web Application Security Project][OWASP_CSRF].

The way Contao mitigates these attacks is by using the [Double Submit Cookie technique][OWASP_Double_Submit_Cookie].

Providing CSRF protection for users that are not authenticated against the app does not make any sense. So if you
visit a regular Contao page with a form placed on it, you will not necessarily see any cookies being set in your
browser. Only if you are authenticated in such a way that the browser will automatically send authentication information
along without any user interaction (e.g. any cookies or basic authentication via `Authorization` headers), CSRF
protection is required. So don't get fooled by the cookies not being present all the time, Contao is actually very smart
about them to improve HTTP cache hits.

By default, Contao protects all `POST` requests coming from Contao routes (except Ajax requests that are
hinted as such by the de-facto standard header `X-Requested-With: XMLHttpRequest`). That means routes which
have the route attribute `_scope` set to either `frontend` or `backend`.

If you explicitly want to disable the CSRF protection on your own route, you can set the route attribute `_token_check`
to `false`.
For example, you might want to listen to some webhook which sends you `POST` data and authorizes itself using the
`Authorization` header. If you need to run in e.g. `frontend` scope, CSRF protection will kick in and you might need
to disable the check for your route.
However, requiring the `_scope` to be set to `frontend` is highly unlikely for a webhook and this example is rather
for illustration purposes.
Remember, Contao is very smart about determining when CSRF protection is required!

{{% notice warning %}}
Setting `_token_check` to `false` will make your custom route vulnerable to CSRF attacks! Only do this if you have
alternative protection in place!
{{% /notice %}}


## Generating and Checking The Token

In order to generate a CSRF token you need the token manager service (`@contao.csrf.token_manager`) and the
configured token name (`%contao.csrf_token_name%`). You can also validate the token yourself, if you need to do that for
some reason.

```php
// src/ExampleService.php
namespace App;

use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class ExampleService
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

    public function generateToken(): string
    {
        return $this->csrfTokenManager->getToken($this->csrfTokenName)->getValue();
    }

    public function checkToken(string $tokenValue): bool
    {
        $token = new CsrfToken($this->csrfTokenName, $tokenValue);
    
        return $this->csrfTokenManager->isTokenValid($token);
    }
}
```

{{% notice tip %}}
You can omit getting the `%contao.csrf_token_name%` by explicitly using the `ContaoCsrfTokenManager` and its
`getDefaultTokenValue()` method:

```php
// before:
$csrfTokenManager->getToken($csrfTokenName)->getValue();

// after:
$contaoCsrfTokenManager->getDefaultTokenValue();
```
{{% /notice %}}

{{% notice tip %}}
In PHP templates you can also output the request token via `<?= $this->requestToken ?>` and in Twig templates via
`{{ contao.request_token }}`
{{% /notice %}}


## Requiring Contao CSRF for Symfony form submits

If you want to use Symfony Forms in a controller or in a custom service, you have to use the Contao CSRF configuration so that 
the request is not blocked.

If you have a Contao controller extended from `AbstractFrontendModuleController`, `AbstractContentElementController` 
or Contao's `AbstractController`, you can simply use `$this->getCsrfFormOptions()` and pass them to the options array:

```php
use Contao\ContentModel;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MyCustomController extends AbstractContentElementController
{
    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        $formBuilder = $this->createFormBuilder(options: $this->getCsrfFormOptions());
        // ....
    }
}
```

Otherwise you need the `FormFactoryInterface`, the `ContaoCsrfTokenManager` service  and the `contao.csrf_token_name` parameter
from the container:

```php
use Contao\CoreBundle\Csrf\ContaoCsrfTokenManager;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Form\FormBuilderInterface
use Symfony\Component\Form\FormFactoryInterface;

class MyCustomService
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly ContaoCsrfTokenManager $csrfTokenManager,
        #[Autowire(param: 'contao.csrf_token_name')]
        private readonly string $csrfTokenName,
    ){}

    public function getFormBuilder(): FormBuilderInterface
    {
        return $this->formFactory->createBuilder(options: [
            'csrf_field_name' => 'REQUEST_TOKEN',
            'csrf_token_manager' => $this->csrfTokenManager,
            'csrf_token_id' => $this->csrfTokenName,
        ]);
    }
}
```

{{% notice warning %}}
If you are using Symfony forms to store records that will be shown in the backend or are rendered in the frontend using
legacy templates, keep in mind that there won't be any input encoding! Without careful treatment, this will result in XSS
vulnerabilities!
{{% /notice %}}


[OWASP_CSRF]: https://owasp.org/www-community/attacks/csrf
[OWASP_Double_Submit_Cookie]: https://cheatsheetseries.owasp.org/cheatsheets/Cross-Site_Request_Forgery_Prevention_Cheat_Sheet.html#double-submit-cookie
