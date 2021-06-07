---
title: 'Move Contao'
description: 'Moving a Contao installation is almost the same as a new installation.'
aliases:
    - /en/installation/move-contao/
weight: 50
---

Moving a Contao installation from one location to another (e.g. from a local installation to a live server) is almost
the same as [installing](../install-contao) but also includes transferring the existing database and
application related files.

1. [Transferring the database](#transferring-the-database)
2. [Transferring the files](#transferring-the-files)
3. [Installing Contao](#installing-contao)

{{% notice warning %}}
To reduce the risk of conflicts, make sure your source and target server both run the **[same PHP version](../system-requirements/#minimum-php-requirements)**.
{{% /notice %}}


## Transferring the database
### Export the database (source)
You can either create a SQL dump with the graphical database administration tool [phpMyAdmin](https://www.phpmyadmin.net/)
or use the `mysqldump` program from the command line.

{{< tabs groupId="mysql-transfer" >}}
{{% tab name="phpMyAdmin" %}}
Log into "phpMyAdmin", select the database you want to export, select the "Export" tab in the upper menu and click "Ok".

You will receive a `sql` file that you can import in the next step.

![Exporting the database](/de/installation/images/de/datenbank-exportieren.png?classes=shadow)
{{% /tab %}}
{{% tab name="Command line" %}}
Make sure `mysqldump` and `gzip` is installed, then run the following command (replacing "my_user" and "my_db_name" with
your database user and database name):

```bash
mysqldump --host=localhost --user=my_user --password --hex-blob --opt my_db_name | gzip -c > my_dump.sql.gz
```

Enter your database password if asked for.

A `my_dump.sql.gz` file containing the dumps will be saved in the current directory that you can use in the next step.
{{% /tab %}}
{{< /tabs >}}


### Import the database (target)
{{< tabs groupId="mysql-transfer" >}}
{{% tab name="phpMyAdmin" %}}
Open "phpMyAdmin" and select a new (empty) database.

Click on the "Import" button in the upper menu, upload the previously created SQL dump and start the import.

![Importing the database](/de/installation/images/de/datenbank-importieren.png?classes=shadow)
{{% /tab %}}
{{% tab name="Command line" %}}
Copy the previously created dump file to the target machine and navigate to it.

Make sure `mysql` and `gunzip` is installed, then run the following command (replacing "my_user" and "my_db_name" with
your database user and database name as well as "my_dump.sql.gz" with the appropriate file name of the copied dump.):

```bash
gunzip < my_dump.sql.gz | mysql --host=localhost --user=my_user --password my_db_name
```

Enter your database password if asked for.
{{% /tab %}}
{{< /tabs >}}


## Transferring the files
The following files and folders need to be transferred from the source to the target machine.

- `files`
- `templates`
- `composer.json`
- `composer.lock`

If you still have old extensions within `system/modules/` or if you have created a `config.yml` in the directory
`config/` (or **before Contao 4.8** `app/config/`) or if you created Contao adjustments under `contao/` (or **before 
Contao 4.8** `app/Resources/contao/`), then they have to be transferred as well.

You can use an FTP client for this task or, if you prefer the command line, use `scp`:

```bash
cd /path/to/project

scp -r files/ templates/ composer.json composer.lock your_server:/www/project/
```

## Installing Contao

1. Make sure you have correctly set up your [hosting configuration](../install-contao/#hosting-configuration).
2. Then we let *Composer* do its work – as we also transferred the `composer.lock` file containing all package version
   details from the original server, Composer will replicate the identical state as before.
   
   To do so, either use the [Contao Manager](../install-contao#installation-via-the-contao-manager) or the 
   [command line](../install-contao#installation-via-the-command-line) like you would with a regular
   installation.
3. Run the [install tool](../contao-installtool) to configure the new database connection. 

That's it! You're now ready to use your Contao installation on a new location.
