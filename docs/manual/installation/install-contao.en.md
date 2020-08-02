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

There are two ways to install Contao on your server, using the graphical interface of the [ContaoManager](#installation-mit-dem-contao-manager) or using the command line.

## Installation with the Contao Manager

### Installing Contao Manager

Before you can install Contao on your server, you need to[ install and configure](../../installation/contao-manager/#contao-manager-installieren) the Contao[ Manager](../../installation/contao-manager/#contao-manager-installieren).

### Installing Contao with the Contao Manager

After the successful basic configuration, Contao can now be installed. Select the desired version and the initial configuration and click the "Finish" button.

![Installing Contao with Contao Manager](/de/installation/images/de/contao-per-contao-manager-installieren.png?classes=shadow)

The installation can now take several minutes. Details of the installation process can be ![Show/Hide Console Output](/de/icons/konsolenausgabe.png?classes=icon)displayed by clicking the icon below.

![Contao is installed](/de/installation/images/de/contao-wird-installiert.png?classes=shadow)

### Update database tables

Once Contao Manager has installed all packages, you have to [run](../contao-installtool/) the [Contao install tool](../contao-installtool/) to update the database.

## Installation via the command line {#installation-over-the-command line}

If you are installing from the command line, `create-project`a `composer update`command is executed during the installation. This will cause some hosters not to be able to complete the process due to high system load, and the installation will fail. In this case you should use theContao[ Manager](#installation-mit-dem-contao-manager).

You have logged on to your server with your user name and domain.

```bash
ssh benutzername@example.com
```

Change to the public directory of your web hosting.

```bash
cd www
```

### Install Composer

[Composer](https://de.wikipedia.org/wiki/Composer_(Paketverwaltung)) is an application-oriented package manager for the PHP programming language and installs dependencies.

To install Composer, please follow the instructions on the [Composer website and](https://getcomposer.org/download/) copy the commands from there, because the SHA hash for verifying the download changes with each Composer version. At this point, the commands look like this.

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

### Installing Contao from the command line {#install Contao from the command line}

The second way is to install Contao using the composer. "example" stands for the desired installation directory and 4.8 for the [version of Contao you want to install](https://contao.org/de/download.html).

```bash
php composer.phar create-project contao/managed-edition example 4.8
```

### Hosting configuration

In Contao, all publicly accessible files are located in the subfolder `/web`of the installation. Use the admin panel of the hosting provider to set the document root of the installation to this subfolder and create a database on this occasion.

Example: `example.com`points to the directory `/www/example/web`

{{% notice note %}}
Pro Contao installation therefore needs its own (sub)domain.
{{% /notice %}}

### Update database tables

After the installation is before the database update, call the [Contao install tool](../contao-installtool/) or use (from Contao 4.9)

```bash
php vendor/bin/contao-console contao:migrate
```

on the command line.
