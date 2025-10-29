---
title: "Data Container permissions"
description: Explanation of creating data container voters.
aliases:
    - /framework/security/data-container/
---

Starting with version 5.0, Contao uses Symfony security voters to check _create_, _read_, _update_ and _delete_ (CRUD) permissions in data containers. This replaces the `checkPermission` onload callbacks that were used in Contao 4 and before. Before implementing your Contao-specific voter, make sure to get familiar with [Symfony security voters](https://symfony.com/doc/current/security/voters.html).

Contao provides an abstract class [AbstractDataContainerVoter](https://github.com/contao/contao/blob/5.3/core-bundle/src/Security/Voter/DataContainer/AbstractDataContainerVoter.php) to simplify voting on CRUD operations for one specific DCA table. See the following example for a typical parent table definition.

First, we need the DCA for the parent table:

```php
// contao/dca/tl_example_archive.php
use Contao\DC_Table;

$GLOBALS['TL_DCA']['tl_example_archive'] = [
    'config' => [
        'dataContainer' => DC_Table::class,
        'ctable' => ['tl_example_item'],
    ],
    // ...
]
```

We also register custom permissions. One to define to which parent record the user can have access to and one to define what kind of CRUD permissions are granted for this table:

```php
// contao/config/config.php
$GLOBALS['TL_PERMISSIONS'][] = 'examples';
$GLOBALS['TL_PERMISSIONS'][] = 'examplep';
```

Add permissions to the user group DCA (can be also done for tl_user):

```php
// contao/dca/tl_user_group.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->addLegend('example_legend', 'amg_legend', PaletteManipulator::POSITION_AFTER)
    ->addField('examples', 'example_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('examplep', 'example_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_user_group')
;

$GLOBALS['TL_DCA']['tl_user_group']['fields']['examples'] = [
    'inputType'  => 'checkbox',
    'foreignKey' => 'tl_example_archive.title',
    'eval'       => ['multiple' => true],
    'sql'        => "blob NULL"
];

$GLOBALS['TL_DCA']['tl_user_group']['fields']['examplep'] = [
    'inputType' => 'checkbox',
    'options'   => ['create', 'delete'],
    'reference' => &$GLOBALS['TL_LANG']['MSC'],
    'eval'      => ['multiple' => true],
    'sql'       => "blob NULL"
];
```

Now we can implement the voter:
```php
// src/Security/Voter/DataContainer/ExampleAccessVoter.php
namespace App\Security\Voter\DataContainer;

use App\Model\ExampleArchiveModel;
use App\Security\ExamplePermissions;
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\CoreBundle\Security\DataContainer\CreateAction;
use Contao\CoreBundle\Security\DataContainer\DeleteAction;
use Contao\CoreBundle\Security\DataContainer\ReadAction;
use Contao\CoreBundle\Security\DataContainer\UpdateAction;
use Contao\CoreBundle\Security\Voter\DataContainer\AbstractDataContainerVoter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class ExampleAccessVoter extends AbstractDataContainerVoter
{
    public function __construct(
        private readonly AccessDecisionManagerInterface $accessDecisionManager
    ) {
    }

    protected function getTable(): string
    {
        return 'tl_example_archive';
    }

    protected function hasAccess(TokenInterface $token, UpdateAction|CreateAction|ReadAction|DeleteAction $action): bool
    {
        if (!$this->accessDecisionManager->decide($token, [ContaoCorePermissions::USER_CAN_ACCESS_MODULE], 'example')) {
            return false;
        }

        return match (true) {
            $action instanceof CreateAction =>
                $this->accessDecisionManager->decide($token, ['contao_user.examplep.create']),
            $action instanceof ReadAction,
            $action instanceof UpdateAction =>
                $this->accessDecisionManager->decide($token, ['contao_user.examples'], $action->getCurrentId()),
            $action instanceof DeleteAction =>
                $this->accessDecisionManager->decide($token, ['contao_user.examples'], $action->getCurrentId()) && 
                $this->accessDecisionManager->decide($token, ['contao_user.examplep.delete']),
        };
        // You can also add additional checks/conditions for allowing/disallowing actions here, if your code requires it.
    }
}
```

In your archive list view you need to filter out all items the user has no read access, otherwise you'll get a permission denied exception.
See following example listener that sets the root IDs for the current user:

```php
// src/EventListener/DataContainer/ExampleArchiveOnLoadListener.php
namespace App\EventListener\DataContainer;

use Contao\BackendUser;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[AsCallback(table: 'tl_example_archive', target: 'config.onload')]
class ExampleArchiveOnLoadListener
{
    public function __construct(
        private readonly TokenStorageInterface $tokenStorage,
    ) {
    }

    public function __invoke(): void
    {
        $user = $this->tokenStorage->getToken()?->getUser();

        if (!$user instanceof BackendUser || $user->isAdmin) {
            return;
        }

        // Set root IDs
        if (!$user->examples || !\is_array($user->examples)) {
            $root = [0];
        } else {
            $root = $user->examples;
        }

        $GLOBALS['TL_DCA']['tl_example_archive']['list']['sorting']['root'] = $root;
    }
}
```

If you need to update the permission for new archives, 
see how this is done in the Contao core, for example for [news](https://github.com/contao/contao/blob/5.3/news-bundle/contao/dca/tl_news_archive.php#L172).