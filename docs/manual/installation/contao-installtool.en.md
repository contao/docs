---
title: 'Contao installation tool'
description: 'With the Contao install tool, you can connect to a database, update tables, import a template and create an administrator account.'
aliases:
    - /en/installation/contao-installtool/
weight: 90
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

In your Internet browser, open the URL of your Contao installation and hang in the `/contao/install`back to start the install tool.

z. B. `www.example.com/contao/install`

Accept the license and assign a password.

## Create database connection

The Contao install tool cannot create new databases itself because most shared hosting packages only allow this with the management software (e.g. Confixx, Plesk or cPanel). So, go to the management interface of your server and create a new database there. Then enter the credentials for the database in the Contao install tool.

![Enter database connection for Contao](/de/installation/images/de/datenbankverbindung-fuer-contao-eingeben.png?classes=shadow)

**Host:** Here you enter the domain or IP address of the database server.

**Port number:** Here you can change the port number of the database server.

**Username:** Here you enter the username for your database.

**Password:** Enter the password here.

**Database:** Here you enter the name of the database.

## Update tables

After you have saved the database access data, the install tool connects to the database and compares the tables with the current version of Contao. If an update is necessary, the install tool automatically presents you a list of changes that you can confirm or reject.

![Confirm database changes](/de/installation/images/de/datenbankaenderungen-bestaetigen.png?classes=shadow)

Usually, you should accept the offered changes so that your tables are always up-to-date and Contao does not try to access missing fields later. For a new installation, the list of changes is usually very long since all tables have to be created again first.

If you have multiple applications sharing a database on your server, the install tool offers you the possibility to "clean up" the tables of the other applications that are not needed.

{{% notice warning %}}
Although it is technically possible to run multiple applications in one database, you should use a separate database for each application.

## Importing a Template

At this point you can import a `.sql`file from the `/templates`directory. This will delete all existing data! If you just want to import a theme instead, please use the theme manager in the Contao back end.

{{% notice warning %}}
When you import a template, existing data is overwritten! 
{{% /notice %}}

## Create an administrator account

If you did not import a template, for example if you want to create a new website with Contao, you need to create an administrator user that you can use to log in to the Contao back end later.

![Create an administrator account](/de/installation/images/de/ein-administratorkonto-anlegen.png?classes=shadow)

**Username**: Here you enter the username of the administrator.

**Name:** Enter the first and last name of the administrator here.

**e-mail address:** Here you enter the email address of the administrator.

**Password:** Here you set and confirm the password of the administrator.

After you have created the administrator user, the installation of Contao is complete  
 and the link at the bottom right brings you to the backend.

## Reset the install tool {#reset the-installtool}

There are two reasons why you might want to reset the install tool:

1. The install tool has been locked.
2. You have forgotten the install tool password.

The install tool is protected against [brute force attacks](https://de.wikipedia.org/wiki/Brute-Force-Methode) and is automatically locked if an incorrect password is entered more than three times in a row.

You have three options to unlock the install tool:

- Via the Contao Manager by clicking on "Unlock install tool" under System maintenance.![Reset the install tool](/de/installation/images/de/das-installtool-zuruecksetzen.png?classes=shadow)
- From the command line by issuing the following command in the root directory of your Contao installation:
  
  ```bash
  php vendor/bin/contao-console contao:install:unlock
  ```
- By deleting the file `install_lock`in the directory `/var`on the web server.

A forgotten password can be reset in the local configuration `/system/config/localconfig.php`file.

Search for the line with the statement `$GLOBALS['TL_CONFIG']['installPassword'] = '…';`and remove it completely from the file. Then you can set a new password when you start the install tool again.
