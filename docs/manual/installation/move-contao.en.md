---
title: 'Contao move'
description: 'Moving a local installation to a live server is almost the same as a new installation.'
aliases:
    - /en/installation/move-contao/
weight: 50
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Moving a local installation to a live server is almost the same as a new installation.

{{% notice warning %}}
To avoid inconvenience during the move, your local server should have the **[same PHP version](/en/installation/system-requirements/#minimum-php-requirements)** as running on the live server.
{{% /notice %}}

## Move Contao with the Contao Manager

### Export database on the local server

The easiest way to create a MySQL dump is to use the database administration "[phpMyAdmin](https://www.phpmyadmin.net/)". Log in to "phpMyAdmin", select the database you want to export and click the "Export" button in the upper menu.

![Exporting the database](/de/installation/images/de/datenbank-exportieren.png?classes=shadow)

### Import database on the live server

Open "phpMyAdmin" on the target server and create a new database for Contao. Depending on the server configuration, this might only be possible via the administration interface (e.g. Confixx, Plesk or cPanel). Select the new empty database and click on the "Import" button in the upper menu. Then upload the SQL dump of the local database and start the import.

![Importing the database](/de/installation/images/de/datenbank-importieren.png?classes=shadow)

### Installing Contao Manager on the live server

Before you can move Contao to your server, you need to [install and configure the Contao Manager](/en/installation/contao-manager/#install-contao-manager).

### Transfer files to the live server { #transfer files to the server }

Open your FTP program and connect to your server. Copy the following files and folders from the localContao directory to the server.

- `files`
- `templates`
- `composer.json`
- `composer.lock`

If you still have old extensions within `system/modules/` or if you have created a `config.yml` in the directory `config/` or **before Contao 4.8** `app/config/` or if you created Contao adjustments under `contao/` or **before Contao 4.8** `app/Resources/contao/` then they have to be transferred to your server as well.

### Install Contao on the live server

Log in to the Contao Manager. Call your domain with the extension `/contao-manager.phar.php` and enter your access data.

The Contao Manager automatically detects the extensions you have stored in the root directory `composer.json` and `composer.lock` when you click on the "Install" button, the manager `composer install` runs in the background and installs Contao and the extensions you used in the local installation.

![Install Composer dependencies](/de/installation/images/de/composer-abhaengigkeiten-installieren.png?classes=shadow)

The installation can now take several minutes. Details of the installation process can be displayed by clicking on the icon![Show/Hide Console Output](/de/icons/konsolenausgabe.png?classes=icon).

![Relocation completed](/de/installation/images/de/umzug-abgeschlossen.png?classes=shadow)

Open the [Contao install tool](/en/installation/contao-installtool/) and enter the access data for the new database.

## Moving Contao from the command line { #contao-over-the-command line-move}

### Export database on the local server

The easiest way to create a MySQL dump on the command line is to use the following command followed by the password

```bash
mysqldump -h localhost -u Benutzer -p --opt Datenbankname | gzip -c > mysqldump.sql.gz
```

The file will be saved in the directory you are in when you send the command.

### Transfer files to the server

Now you can transfer the data `secure copy` to your server.

```bash
scp -r /pfad/lokal/files/ /pfad/lokal/templates/ /pfad/lokal/composer.json /pfad/lokal/composer.lock 
/pfad/lokal/mysqldump.sql.gz benutzername@example.com:server/www/example/
```

### Hosting Configuration

In Contao, all publicly accessible files are located in the subfolder `/web` of the installation. Set the document root of the installation to this subfolder via the admin panel of the hosting provider and set up a database on this occasion.

Example: `example.com`points to the directory `/www/example/web`

{{% notice note %}}
Pro Contao installation therefore requires a separate (sub)domain.
{{% /notice %}}

### Import database on the live server

You have logged on to your server with your user name and domain.

```bash
ssh benutzername@example.com
```

To do this, change to the directory on the console where you want to install Contao.

```bash
cd www/example/
```

If [Composer has not yet been installed](/en/installation/install-contao/#install-composer), we will install it later.

In the next step you can import the MySQL dump with the following command followed by the password.

```bash
gunzip < mysqldump.sql.gz | mysql -h localhost -u Benutzer -p Datenbankname
```

### Installing Contao on the live server

After we have successfully completed all preparations, we install Contao with `composer install`. Unlike the `update`, 
the `install` does not resolve any dependencies, they are located in the included `composer.lock`. Therefore, this process 
will not go wrong because the system requirements are too high.

```bash
php composer.phar install
```

Then open the [Contao install tool](/en/installation/contao-installtool/) and enter the access data for the new database.
