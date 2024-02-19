---
title: "Security"
description: Contao's Symfony Security implementation.
aliases:
    - /framework/security/
---

Contao uses [Symfony's Security Component][SymfonySecurityComponent] to handle front end and back end user authentication and authorization.
The Contao Managed Edition provides its own [firewall][SymfonyFirewall], [user providers][SymfonyUserProvider] and 
[access control][SymfonyAccessControl] via the `contao/manager-bundle`. If you do not use the Managed Edition and added Contao to your
custom Symfony application, you will have to register Contao's security settings yourself, as mentioned in the 
[Getting Started article][ContaoConfiguration]. Contao's Symfony Security configuration [in Contao **4.9**][Contao49SecurityYaml] looks like this for example:

{{% expand "Contao's Symfony Security Configuration" %}}
```yaml
security:
    providers:
        contao.security.backend_user_provider:
            id: contao.security.backend_user_provider

        contao.security.frontend_user_provider:
            id: contao.security.frontend_user_provider

    encoders:
        Contao\User:
            algorithm: auto

    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt|error)|css|images|js)/
            security: false

        contao_install:
            pattern: ^/contao/install$
            security: false

        contao_backend:
            request_matcher: contao.routing.backend_matcher
            provider: contao.security.backend_user_provider
            user_checker: contao.security.user_checker
            anonymous: ~
            switch_user: true

            contao_login:
                remember_me: false

            logout:
                path: contao_backend_logout
                handlers:
                    - contao.security.logout_handler
                    - contao_manager.security.logout_handler
                success_handler: contao.security.logout_success_handler

        contao_frontend:
            request_matcher: contao.routing.frontend_matcher
            provider: contao.security.frontend_user_provider
            user_checker: contao.security.user_checker
            anonymous: ~
            switch_user: false

            contao_login:
                remember_me: true

            remember_me:
                secret: '%kernel.secret%'
                remember_me_parameter: autologin

            logout:
                path: contao_frontend_logout
                target: contao_root
                handlers:
                    - contao.security.logout_handler
                success_handler: contao.security.logout_success_handler

    access_control:
        - { path: ^/contao/login$, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/contao/logout$, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/contao(/|$), roles: ROLE_USER }
        - { path: ^/, roles: [IS_AUTHENTICATED_ANONYMOUSLY] }
```
{{% /expand %}}

If you want to learn more about Symfony's Security Component use the provided links to read up on. This documentation will only cover
implementation details that are unique to Contao.

Since within Contao you can put a login form on basically any page, Contao does not utilise Symfony's built-in 
[`form_login` Authentication Provider][SymfonyFormLogin]. Instead, Contao implements its own [user checker][SymfonyUserChecker] and 
[request matcher service][SymfonyRequestMatcherService], the latter of which checks the [request scope][RequestScope]. For example in the 
front end, all URLs to Contao pages will have the `_scope` request attribute set to `frontend` and the `contao_frontend` firewall will thus 
be applicable to all these URLs. Contao implements an [authentication listener][SymfonyAuthenticationListener] which will check for any
POST request containing the parameters `username` and `password` and the parameter `FORM_SUBMIT` with the value `tl_login` (as these are the
parameters used by Contao's login module).


## Voters

{{< version "4.7" >}}

Starting with Contao **4.7** Contao implements [Voters][SymfonyVoters] in order to easily check whether an authenticated user is authorized 
to access specific resources. These voters are automatically added to Symfony's security system and then invoked when the respective
permission is accessed via the [Security Helper][SecurityHelperService].

{{% notice note %}}
Contao automatically uses the `priority` 
[access decision strategy](https://symfony.com/doc/current/security/voters.html#changing-the-access-decision-strategy) for any request that
is either in Contao's `frontend` or `backend` scope. This means the first voter that does not abstain will decide on the vote. Thus if you 
want to expand voting on a certain back end privilege you need to make sure that your voter abstains from any query it is not concerned 
with and that the service has a priority higher than the default via the `security.voter` service tag.
{{% /notice %}}

The security helper can be used to check whether the currently authenticated user has access in the back end to specific forms, table fields
(as defined via the DCA), folders and modules for example:

```php
// User has access to form ID 5
$security->isGranted('contao_user.forms', 5);

// User is allowed to access field "published" of table "tl_page"
$security->isGranted('contao_user.alexf', 'tl_page::published');

// Check access to folder
$security->isGranted('contao_user.filemounts', '/files/foo/bar');
```

{{< version "4.10" >}}

You can also use the security helper to check wether the user can edit a page or is allowed to edit fields in a specific DCA for example:

```php
// whether the user can access any field in tl_page
$security->isGranted('contao_user.can_edit_fields', 'tl_page');

// whether user can edit the given page (array of row or page model)
$security->isGranted('contao_user.can_edit_page', [/* row of page data */]);
$security->isGranted('contao_user.can_edit_page', $pageModel);
```

{{< version "4.12" >}}

The security helper can also be used to check whether a front end user belongs to any of the specified user groups:

```php
$security->isGranted('contao_member.groups', $groupId);
$security->isGranted('contao_member.groups', [/* array of group IDs */]);
```

{{< version "5.0" >}}

The `contao_dc.<data-container>` permission can be used to check whether a back end user has the right to perform 
certain DCA actions. The subject in this case will be a `Contao\CoreBundle\Security\DataContainer\AbstractAction`.

```php
use Contao\CoreBundle\Security\DataContainer\CreateAction;
use Contao\CoreBundle\Security\DataContainer\DeleteAction;
use Contao\CoreBundle\Security\DataContainer\ReadAction;
use Contao\CoreBundle\Security\DataContainer\UpdateAction;

$security->isGranted('contao_dc.tl_foobar', new CreateAction('tl_foobar', $record));
$security->isGranted('contao_dc.tl_foobar', new DeleteAction('tl_foobar', $record));
$security->isGranted('contao_dc.tl_foobar', new ReadAction('tl_foobar', $record));
$security->isGranted('contao_dc.tl_foobar', new UpdateAction('tl_foobar', $record));
```

{{% notice tip %}}
{{< version-tag "4.10" >}} There are now class constants available for the various permission attributes, so that you do not have to remember them
yourself and instead can use your IDE to find the correct attribute. For the Contao Core these constants are available in 
`Contao\CoreBundle\Security\ContaoCorePermissions` while the permissions of the additional bundles are available in 
`Contao\NewsBundle\Security\ContaoNewsPermissions`, `Contao\CalendarBundle\Security\ContaoCalendarPermissions`, 
`Contao\NewsletterBundle\Security\ContaoNewsletterPermissions` and `Contao\FaqBundle\Security\ContaoFaqPermissions` respectively. The
PHP documentation of these constants also contain hints about what type the subject should be. Examples:

```php
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\NewsBundle\Security\ContaoNewsPermissions;

// Whether user can access the news module in the back end
$security->isGranted(ContaoCorePermissions::USER_CAN_ACCESS_MODULE, 'news');

// Whether user can use the hidden input field in the form generator
$security->isGranted(ContaoCorePermissions::USER_CAN_ACCESS_FIELD, 'hidden');

// Whether user has access to any field of tl_content
$security->isGranted(ContaoCorePermissions::USER_CAN_EDIT_FIELDS_OF_TABLE, 'tl_content');

// Whether user can create news archives
$security->isGranted(ContaoNewsPermissions::USER_CAN_CREATE_ARCHIVES);
```
{{% /notice %}}


### Examples

By default admins can access everything and you can restrict access to back end sections only for non-admins via back 
end user groups. The following example implements a custom voter for your application which grants access to the 
"Maintenance" back end section only for the admin with ID "1".

```php
// src/Security/Voter/AdminMaintenanceAccessVoter.php
namespace App\Security\Voter;

use Contao\BackendUser;
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class AdminMaintenanceAccessVoter extends Voter
{
    public function vote(TokenInterface $token, mixed $subject, array $attributes): int
    {
        // Abstain if not back end admin
        if (!($user = $token->getUser()) instanceof BackendUser || !$user->isAdmin) {
            return Voter::ACCESS_ABSTAIN;
        }

        return parent::vote($token, $subject, $attributes);
    }

    protected function supports(string $attribute, $subject): bool
    {
        // Abstain if we are not voting for maintenance back end module access
        if ('maintenance' !== $subject || $attribute !== ContaoCorePermissions::USER_CAN_ACCESS_MODULE) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        // Only allow admin with ID "1"
        return 1 === (int) $token->getUser()->id;
    }
}
```

{{< version-tag "5.0" >}} Here is another example with which you can restrict editing of news records to their original 
authors. The voter checks for any update or delete actions of the data container and then checks whether the author of 
the news record is the currently logged in user. In this case we implement the necessary checks also for the child table
`tl_content` accordingly - otherwise  you would still be able to edit the news content.

```php
// src/Security/Voter/NewsAccessVoter.php
namespace App\Security\Voter;

use Contao\BackendUser;
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\CoreBundle\Security\DataContainer\DeleteAction;
use Contao\CoreBundle\Security\DataContainer\UpdateAction;
use Contao\NewsModel;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class NewsAccessVoter extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        // We only want to vote on edit actions (delete and update)
        if (!$subject instanceof DeleteAction && !$subject instanceof UpdateAction) {
            return false;
        }

        if (ContaoCorePermissions::DC_PREFIX.'tl_news' === $attribute) {
            return true;
        }

        // Also take content elements of news into account
        if (ContaoCorePermissions::DC_PREFIX.'tl_content' === $attribute) {
            return 'tl_news' === $subject->getCurrent()['ptable'];
        }

        return false;
    }

    /**
     * @param DeleteAction|UpdateAction $subject
     */
    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        /** @var BackendUser $user */
        $user = $token->getUser();

        if ($user->isAdmin) {
            return true;
        }

        // Determine the author ID
        $record = $subject->getCurrent();

        if ('tl_news' === $subject->getDataSource()) {
            $authorId = $record['author'];
        } else {
            $news = NewsModel::findByPk($record['pid']);
            $authorId = $news->author;
        }

        return (int) $user->id === (int) $authorId;
    }
}
```


## Custom Back End Access Rights

To implement your own back end access rights (e.g. for custom modules in the back end) the following steps are necessary:

1. Add your new permission to `$GLOBALS['TL_PERMISSIONS']`. This registers this permission to be used by Contao's `contao_user` voter.
2. Add your new permission to `tl_user` and `tl_user_group`.

```php
// contao/config/config.php
$GLOBALS['TL_PERMISSIONS'][] = 'my_permissions';
```

```php
// contao/dca/tl_user.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_user']['fields']['my_permissions'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['multiple' => true],
    'options' => [
        'first_permission' => 'First permission',
        'second_permission' => 'Second permission',
    ],
    'sql' => ['type' => 'blob', 'notnull' => false],
];

PaletteManipulator::create()
    ->addLegend('my_legend', null)
    ->addField('my_permissions', 'my_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('extend', 'tl_user')
    ->applyToPalette('custom', 'tl_user')
;
```

```php
// contao/dca/tl_user_group.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_user_group']['fields']['my_permissions'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['multiple' => true],
    'options' => [
        'first_permission' => 'First permission',
        'second_permission' => 'Second permission',
    ],
    'sql' => ['type' => 'blob', 'notnull' => false],
];

PaletteManipulator::create()
    ->addLegend('my_legend', null)
    ->addField('my_permissions', 'my_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_user_group')
;
```

Once that is done you can check for this permission in your own back end controller for example. These permissions can be checked via the 
security helper by using the `contao_user.*` attribute. We also check that the current user is not `ROLE_ADMIN` because administrators 
should always be able to access the controller.

```php
// src/Controller/BackendController.php
namespace App\Controller;

use Contao\CoreBundle\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Twig\Environment;

#[Route('/contao/my-backend-route', name: BackendController::class, defaults: ['_scope' => 'backend'])]
class BackendController
{
    private $twig;
    private $security;

    public function __construct(Environment $twig, Security $security)
    {
        $this->twig = $twig;
        $this->security = $security;
    }

    public function __invoke(): Response
    {
        if (!$this->security->isGranted('ROLE_ADMIN') && !$this->security->isGranted('contao_user.my_permissions', 'first_permission')) {
            throw new AccessDeniedException('Not enough permissions to access this controller.');
        }

        return new Response($this->twig->render('my_backend_route.html.twig', []));
    }
}
```

{{% notice note %}}
We do not need to check whether a user is logged in this case, since the Contao firewall automatically checks this
for this controller with the configured routing parameters (see also the [back end route guide](/guides/back-end-routes/)).
{{% /notice %}}

{{% notice tip %}}
Instead of extending Contao's own permissions system you are also free to implement 
[your own voter](https://symfony.com/doc/4.4/security/voters.html#creating-the-custom-voter). See the examples
[above](#examples).
{{% /notice %}}


[SymfonySecurityComponent]: https://symfony.com/doc/4.4/components/security.html
[SymfonyFirewall]: https://symfony.com/doc/4.4/components/security/firewall.html
[SymfonyAuthenticationListener]: https://github.com/symfony/symfony/blob/4.4/src/Symfony/Component/Security/Http/Firewall/AbstractAuthenticationListener.php
[SymfonyUserProvider]: https://symfony.com/doc/4.4/security/user_provider.html
[SymfonyAccessControl]: https://symfony.com/doc/4.4/security/access_control.html
[ContaoConfiguration]: /getting-started/initial-setup/symfony-application/contao-4.9/#configure-your-contao-installation
[Contao49SecurityYaml]: https://github.com/contao/contao/blob/4.9.42/manager-bundle/src/Resources/skeleton/config/security.yml
[SymfonyFormLogin]: https://symfony.com/doc/4.4/security/form_login.html
[SymfonyUserChecker]: https://symfony.com/doc/4.4/security/user_checkers.html
[SymfonyRequestMatcherService]: https://symfony.com/doc/4.4/security/firewall_restriction.html#restricting-by-service
[RequestScope]: /framework/routing/#request-scope
[SymfonyVoters]: https://symfony.com/doc/4.4/security/voters.html
[SecurityHelperService]: /reference/services/#security-helper
[PermissionsReference]: /reference/permissions/
[BackEndRouteGuide]: /guides/back-end-routes/
