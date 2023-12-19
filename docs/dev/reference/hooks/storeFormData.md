---
title: "storeFormData"
description: "storeFormData hook"
tags: ["hook-form"]
aliases:
    - /reference/hooks/storeFormData/
    - /reference/hooks/storeformdata/
---


The `storeFormData` hook is triggered before a submitted form is stored to the
database. It passes the result set and the form object and expects the result
set as return value.


## Parameters

1. *array* `$data`

    The result set that will be written to the database table.

2. *\Contao\Form* `$form`

    The form instance.


## Return Values

Return `$data` or an array of key => values that should be written to the
database.


## Example

```php
// src/EventListener/StoreFormDataListener.php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\Form;
use Contao\FrontendUser;
use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Security;

#[AsHook('storeFormData')]
class StoreFormDataListener
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var Security
     */
    private $security;

    public function __construct(Connection $connection, Security $security)
    {
        $this->connection = $connection;
        $this->security = $security;
    }

    public function __invoke(array $data, Form $form): array
    {
        $data['member'] = 0;

        $user = $this->security->getUser();
       
        if (!$user instanceof FrontendUser) {
            return $data;
        }   

        if (!$this->columnExistsInTable('member', $form->targetTable)) {
            return $data;
        }

        // Also store the member ID who submitted the form
        $data['member'] = $user->id;

        return $data;
    }
    
    private function columnExistsInTable(string $columnName, string $tableName): bool
    {
        $columns = $this->connection->getSchemaManager()->listTableColumns($tableName);
            
        foreach ($columns as $column) {
            if ($column->getName() === $columnName) {
                return true;
            }
        }

        return false;
    }
}
```


## References

* [\Contao\Form#L499-L507](https://github.com/contao/contao/blob/4.7.6/core-bundle/src/Resources/contao/forms/Form.php#L499-L507)
