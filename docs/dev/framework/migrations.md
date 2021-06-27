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
  This method checks if all prerequisites that are needed for the migration to run are met and if it actually needs to run. This method 
  should be written very defensively because the application might be in an unexpected state when the method gets called, e.g. the database 
  could be completely empty.

* __run()__ <br>
  As the name suggests, that is where the real magic happens. If `shouldRun()` returned `true`, this method will be called and should do the
  actual migration.<br>
  It returns a `MigrationResult` object that can hold more information about what happened during the execution and if the migration was 
  successful or not.<br>
  If something goes unexpectedly wrong here and you want to abort the migration process completeley you should throw an exception here.

{{% notice tip %}}
You can extend from `Contao\CoreBundle\Migration\AbstractMigration` which already implements the `MigrationInterface` and provides two
methods: `getName()` and `createResult()`. You can use the latter to automatically generate a `MigrationResult` with a default message. You 
can also override its `getName()` method to provide a custom name for your migration, otherwise it will automatically use the FQCN of your 
migration class.
{{% /notice %}}


## Example

Lets say we have a database table `tl_customers` with a `firstName` and `lastName` column that we combined to a `name` column in the new 
version:

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

        return $this->createResult(
            true, 
            'Combined '. $stmt->rowCount().' customer names.'
        );
    }
}
```


## Recorded Migration

{{< version "4.12" >}}

Contao's own migration usually use the inherent state of the database in order to check whether a specific migration should be run or not.
For example they check for the existence of certain table fields and may be their content to determine if the execution of a migration is
necessary. However, there might be some migrations where this cannot be done and thus you need a record of whether or not a migration has
already been run or not.

In Contao **4.12** a new  `Contao\CoreBundle\Migration\AbstractRecordedMigration` class has been introduced that allows you to automatically
track whether a migration already ran in a Contao instance. This abstract class will create a record for a migration in the `tl_migration`
table where the name of the migration and its execution date will be stored.

This happens in the `createResult()` method of the abstract class. The new abstract class also brings its own `shouldRun()` implementation
which already checks whether the migration has been run via the `tl_migration` database table. So the minimum requirement when extending
from `AbstractRecordedMigration` would look like this:

```php
// src/Migration/ExampleRecordedMigration.php
namespace App\Migration;

use Contao\CoreBundle\Migration\AbstractRecordedMigration;
use Contao\CoreBundle\Migration\MigrationResult;

class ExampleRecordedMigration extends AbstractRecordedMigration
{
    public function run(): MigrationResult
    {
        // Execute your migration here
        // …

        return $this->createResult(true);
    }
}
```

{{% notice warning %}}
For recorded migrations the migration's name must be unique! Keep that in mind if you implement `getName()` on your own.
{{% /notice %}}

If your migration still processes database tables and fields, then your migration still needs to check for the existence of these tables and
fields, otherwise an error would occur (after a fresh deployment for example, where these tables and fields might not exist yet). The
`AbstractRecordedMigration` class additionally provides a `hasRun()` method with which you can check whether this migration was already
executed once before:

```php
namespace App\Migration;

use Contao\CoreBundle\Migration\AbstractRecordedMigration;
use Contao\CoreBundle\Migration\MigrationResult;
use Doctrine\DBAL\Connection;

class ExampleRecordedMigration extends AbstractRecordedMigration
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
        // We check whether the migration already ran early
        if ($this->hasRun()) {
            return false;
        }

        // Check for the existence of tl_example.foobar
        $schemaManager = $this->connection->getSchemaManager();

        if (!$schemaManager->tablesExist(['tl_example'])) {
            return false;
        }

        $columns = $schemaManager->listTableColumns('tl_example');

        return isset($columns['foobar']);
    }

    public function run(): MigrationResult
    {
        // Execute migration for tl_example.foobar
        // …

        return $this->createResult(true);
    }
}
```

Alternatively you can also `return parent::shouldRun();` in your `shouldRun()` implementation.


## Read more

* [Contao's console commands][commands]


[commands]: /reference/commands/
