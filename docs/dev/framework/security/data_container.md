---
title: "Data Container permissions"
description: Explanation of creating data container voters.
aliases:
    - /framework/security/data_container/
---

Since contao 5 data container permissions can be set by data container voters. This replaces the "checkPermission" onload callbacks that were used in Contao 4 and before.

Contao comes with an bundles abstract class [AbstractDataContainerVoter](https://github.com/contao/contao/blob/5.3/core-bundle/src/Security/Voter/DataContainer/AbstractDataContainerVoter.php).
A class extending it is able to voter for data container actions. See following example:

```php
<?php

namespace App\Security\Voter\DataContainer;

use App\Model\ExampleArchiveModel;
use App\Security\ExamplePermissions;
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
        return ExampleArchiveModel::getTable();
    }

    protected function hasAccess(TokenInterface $token, UpdateAction|CreateAction|ReadAction|DeleteAction $action): bool
    {
        if (!$this->accessDecisionManager->decide($token, ['contao_user.modules.example'])) {
            return false;
        }

        return match (true) {
            $action instanceof CreateAction => $this->accessDecisionManager->decide($token,['contao_user.examplep.create']),
            $action instanceof ReadAction,
            $action instanceof UpdateAction => $this->accessDecisionManager->decide($token,['contao_user.examples'], $action->getCurrentId()),
            $action instanceof DeleteAction => 
                $this->accessDecisionManager->decide($token,['contao_user.examples'], $action->getCurrentId()) && 
                $this->accessDecisionManager->decide($token,['contao_user.examplep.delete']),
        };
    }
}
```