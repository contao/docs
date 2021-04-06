---
title: "Migrations"
description: "Database migrations and general purpose migration scripts."
---

{{% notice note %}}
This covers the documentation on how to create migrations in Contao **4.9**
and up. In previous Contao versions, migrations were written in `runonce.php` files that got deleted after execution.
{{% /notice %}}

Updating Contao, extensions or the application itself sometimes requires to migrate data to be compatible with the new version(s). For this purpose Contao has a migration framework that lets you write migration services that are integrated in the update process.

The migrations get executed via the install tool database update or with the [`contao:migrate` command][commands].


## Definition

To add a new migration, create a service that implements the interface `Contao\CoreBundle\Migration\MigrationInterface` and add the tag `contao.migration` (if autoconfiguration is enabled, this happens automatically):

```yaml
# config/services.yaml
services:
    App\Migration\MyMigration:
        tags:
            - { name: contao.migration, priority: 0 }
```

## MigrationInterface

The migration interface specifies three methods that need to be implemented:

* __getName()__ <br>
  A name that describes what the migration does. This text is shown to users when they are asked if they want to execute the migration.

* __shouldRun()__ <br>
  This method checks if all prerequisites that are needed for the migration to run are met and if it actually needs to run. This method should be written very defensively because the application might be in an unexpected state when the method gets called, e.g. the database could be completely empty.

* __run()__ <br>
  As the name suggests, that is where the real magic happens. If `shouldRun()` returned `true`, this method will be called and should do the actual migration.<br>
  It returns a `MigrationResult` object that can hold more information about what happened during the execution and if the migration was successful or not.<br>
  If something goes unexpectedly wrong here and you want to abort the migration process completeley you should throw an exception here.


## Example

Lets say we have a database table `tl_customers` with a `firstName` and `lastName` column that we combined to a `name` column in the new version:

```php
// src/Migration/CustomerNameMigration.php
namespace App\Migration;

use Contao\CoreBundle\Migration\AbstractMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

class CustomerNameMigration extends AbstractMigration
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function shouldRun(): bool
    {
        $schemaManager = $this->connection->getSchemaManager();

        // If the database table itself does not exist we should do nothing
        if (!$schemaManager->tablesExist(['tl_customers'])) {
            return false;
        }

        $columns = $schemaManager->listTableColumns('tl_customers');

        return 
	        isset($columns['firstname']) &&
	        isset($columns['lastname']) &&
	        !isset($columns['name']);
    }

    public function run(): MigrationResult
    {
        $this->connection->executeQuery("
            ALTER TABLE
                tl_customers
            ADD
                name varchar(255) NOT NULL DEFAULT ''
        ");

        $stmt = $this->connection->prepare("
            UPDATE
                tl_customers
            SET
                name = CONCAT(firstName, ' ', lastName)
        ");

        $stmt->execute();

        return new MigrationResult(
            true, 
            'Combined '. $stmt->rowCount().' customer names.'
        );
    }
}
```


## Read more

* [Contao's console commands][commands]


[commands]: /reference/commands/
