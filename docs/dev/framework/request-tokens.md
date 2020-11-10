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

By default, Contao protects all `POST` requests coming from Contao routes (except Ajax requests). That means routes which
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


## Checking The Token Manually

If, for some reason, you need to check the request token yourself, you can do so by combining the token manager
service (`@contao.csrf.token_manager`) and the configured token name (`%contao.csrf_token_name%`): 

```php
namespace App;

use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class MyTokenCheckService
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

    public function check(string $tokenValue): bool
    {
        $token = new CsrfToken($this->csrfTokenName, $tokenValue);
    
        return $this->csrfTokenManager->isTokenValid($token);
    }
}
```


## Deprecated Constants And Configuration Settings

For historical reasons, you may still come across the following constants or configuration settings.
They are all deprecated and you must not use them anymore. Register your own route and implement your own
handling as outlined above, if you need to disable the CSRF protection for some reason.

* The constant `BYPASS_TOKEN_CHECK`. It disables CSRF protection completely.
* The localconfig configuration value `disableRefererCheck`. It disables CSRF protection completely.
* The localconfig configuration value `requestTokenWhitelist`. It can contain an exact hostname or regular expression.
  It will disable CSRF protection only on hostname match.


[OWASP_CSRF]: https://owasp.org/www-community/attacks/csrf
[OWASP_Double_Submit_Cookie]: https://cheatsheetseries.owasp.org/cheatsheets/Cross-Site_Request_Forgery_Prevention_Cheat_Sheet.html#double-submit-cookie
