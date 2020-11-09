---
title: 'Install Contao'
description: 'There are two ways to install Contao on your server, one is via the graphical user interface of the Contao Manager and the other is via the command line.'
aliases:
    - /en/installation/install-contao/
weight: 30
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

After you have checked all requirements and set up your web server, you can now start the installation.

There are two ways to install Contao on your server, using the graphical user interface of the [ContaoManager](#installation-mit-dem-contao-manager) or using the command line.

## Installation with the Contao Manager

### Install Contao Manager

Before you can install Contao on your server, you need to[ install and configure](../../installation/contao-manager/#contao-manager-installieren) the Contao[ Manager](../../installation/contao-manager/#contao-manager-installieren).

### Installing Contao with the Contao Manager

After the successful basic configuration, you can now install Contao. Select the desired version and the initial configuration and click the "Finish" button.

![Installing Contao with Contao Manager](/de/installation/images/de/contao-per-contao-manager-installieren.png?classes=shadow)

The installation can now take several minutes. Details about the installation process can be displayed by clicking the following icon![Show/Hide Console Output](/de/icons/konsolenausgabe.png?classes=icon).

![Contao is installed](/de/installation/images/de/contao-wird-installiert.png?classes=shadow)

### Update database tables

Once the Contao Manager has installed all packages, you have to [run](../contao-installtool/) the [Contao install tool](../contao-installtool/) to update the database.

## Installation via the command line {#installation-over-the-command line}

When installing from the command line, `create-project`a `composer update`command is executed during the installation. This will cause some hosters not to be able to terminate the process due to high system load, and the installation will fail. In this case you should use theContao[ Manager](#installation-mit-dem-contao-manager).

You have logged on to your server with your user name and domain.

```bash
ssh benutzername@example.com
```

Change to the public directory of your web hosting.

```bash
cd www
```

### Install Composer

[Composer](https://de.wikipedia.org/wiki/Composer_(Paketverwaltung)) is an application-oriented package manager for the 
PHP programming language and installs dependencies.

{{% notice note %}}
You can either install composer [locally](https://getcomposer.org/doc/00-intro.md#locally) 
or [globally](https://getcomposer.org/doc/00-intro.md#globally). 
 
 If you install locally, you will have a `composer.phar` file in your working directory (i.e. where your project's
 `composer.json`and `composer.lock` files are located). You would then call composer with `php composer.phar`.
 
 If you install globally, you can use the `composer` command in any directory. 
{{% /notice %}}


### Installing Contao from the command line {#install Contao from the command line}

In the second step, you install Contao using the Composer. "example" stands for the desired installation directory and 4.8 for the [version of Contao you want to install](https://contao.org/de/download.html).

```bash
php composer.phar create-project contao/managed-edition example 4.8
```

### Hosting Configuration

In Contao, all publicly accessible files are located in the subfolder `/web`of the installation. Use the admin panel of the hosting provider to set the document root of the installation to this subfolder and create a database on this occasion.

Example: `example.com`points to the directory `/www/example/web`

{{% notice note %}}
Pro Contao installation therefore requires its own (sub)domain.
{{% /notice %}}

### Update database tables

After the installation is before the database update, call the [Contao install tool](../contao-installtool/) or use (from Contao 4.9)

```bash
php vendor/bin/contao-console contao:migrate
```

on the command line.
