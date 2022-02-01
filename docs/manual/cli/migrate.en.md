---
title: "contao:migrate"
description: "Perform database updates and migrations."
aliases:
    - /en/cli/migrate/
weight: 25
---

With this command you can perform database updates and migrations after a new installation or update of Contao or an 
extension. The migrations that get executed are update scripts of Contao, registered migrations of extensions, 
legacy `runonce.php` files and the database update.

```bash
php vendor/bin/contao-console contao:migrate [options]
```

| Option             | Description |
|--------------------|-------------|
| `--with-deletes`   | Executes all database migrations including `DROP` queries.|
| `--schema-only`    | Executes database schema migration only. Update scripts, registered migrations and `runonce.php` files get skipped.|
| `--migrations-only` | Only executes the migrations without updating the database tables and fields. |
| `--dry-run` | Shows pending migrations and schema updates without actually executing them. |
| `--no-interaction` | With this option enabled all confirmation questions are automatically answered with “yes”. This is useful if you want to execute the migrations in an automated system. |
| `--no-backup` | {{< version-tag "4.13" >}} Disable the [database backup][DatabaseBackup] which is created by default before executing the migrations. |

[DatabaseBackup]: /en/cli/db-backups/