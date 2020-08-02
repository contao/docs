---
title: 'About Contao Manager'
description: 'Contao Manager is a tool that provides a graphical interface to easily manage a Contao installation.'
aliases:
    - /en/installation/contao-manager/
weight: 20
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

The development of Contao Manager is supported by the [Contao Association](https://association.contao.org/).

## Task of the Manager

Like most PHP projects, Contao is installed and updated with [Composer](https://getcomposer.org). Composer is a package manager that can be used on the command line and can also be used to manage Contao completely from the command line. The Contao Manager is a tool that provides a graphical user interface to manage a Contao installation. It takes the hurdle of the command line and allows you to execute the necessary commands with just one click.

The manager can be used to perform the following tasks, among others:

- Install Contao
- Update Contao
- Search for extensions
- Install extensions
- Uninstalling extensions
- Empty Contao Cache (system maintenance)

For the future, there are more features planned, such as defining system settings.

The Contao Manager is optional and not required for running Contao. However, the tool makes it easier for beginners to install and manage extensions because no composer knowledge is required.

It is still possible to manage the installation of Contao 4 and extensions directly from the command line using Composer.

## Install Contao Manager

### System requirements

The system requirements are basically the same as for [Contao](../../installation/systemvoraussetzungen). TheContao Manager automatically checks if the requirements are met.

- PHP version 7.1 or newer
- PHP extension *Intl* and *OpenSSL*
- PHP functions *proc\_open* and *proc\_close*
- PHP setting *allow\_url\_fopen* must be active

### Hosting configuration

In Contao, all publicly accessible files are located in the subfolder `/web`of the installation. Create the folder `web`and set the document root of the installation to this subfolder via the admin panel of the hosting provider.

**Example:** `example.com`points to the directory `/www/example/web`

{{% notice note %}}
Pro Contao installation therefore requires its own (sub)domain.
{{% /notice %}}

### Download and installation

The Contao Manager consists of a single file that can be [downloaded from contao.orgher](https://contao.org/de/download.html). After successful download you will receive a file `contao-manager.phar`.transfer this file to the directory `web`on your web server.

{{% notice info %}}
`.phar` files are not executed by all hosting providers. For best compatibility, add the file extension `.php`(final filename: `contao-manager.phar.php`).
{{% /notice %}}

{{% notice warning %}}
`.php` Files are transferred by most FTP programs in text instead of binary mode, which destroys the Manager file. Therefore, add the file extension `.php`only after the upload.
{{% /notice %}}

### Starting Contao Manager

Then call up the URL `www.example.com/contao-manager.phar.php`with your browser. You should see nundie welcome page of Contao Manager.

![Welcome page of the Contao Manager](/de/installation/images/de/willkommensseite-des-contao-managers.png?classes=shadow)

### Basic configuration

Before you install Contao, you have to configure the manager itself. Create a new user by entering a username and password. The password is independent from the later Contao installation.

The Contao Manager does not need its own database. The configuration of the Contao Manager is stored in the database`manager.json` and the user data in the `users.json`directory`/contao-manager`.

### Server configuration

The Contao Manager needs the path to the PHP binary and other server information to run background processes correctly.

Most servers are detected automatically. If your hosting provider is not listed, you can [add](https://github.com/contao/contao-manager/wiki) it [to our Wiki](https://github.com/contao/contao-manager/wiki).

#### Server configuration

Choose the appropriate configuration for your server or hosting provider. For a manual configuration select "Other ...".

![Server configuration](/de/installation/images/de/serverkonfiguration.png?classes=shadow)

#### Composer Resolver Cloud

The [Composer Resolver Cloud](https://composer-resolver.cloud/) allows you to install Composer dependencies even if the server does not have enough memory. Please note that your dependency resolution package information is [sent](https://association.contao.org/) to a [Contao Association](https://association.contao.org/) cloud service.

After the successful basic configuration, Contao can now be[ installed](../contao-installieren/#contao-mit-dem-contao-manager-installieren).

## Frequently asked questions about Contao Manager {#frequently asked questions about the Contao manager}

### How to update the Contao Manager?

Basically, a manual update is not necessary. The manager automatically checks in the background and updates itself if a new version is available.

In case of problems, you can always download the latest `contao-manager.phar`version and[ upload and replace](#download-und-installation) it manually via[ FTP](#download-und-installation).

### Did you forget your Contao Manager access data?

To reset your password, you need to connect to your server via FTP.

In the directory`contao-manager`, delete the file `users.json`.

Now call the Contao Manager from your domain with the addition `contao-manager.phar.php`and create a new admin user.

If you see the login mask for an existing user despite deleting the file`users.json`, delete the cookies of the domain or open the Contao Manager page in the "incognito mode" of your browser.

### Can I add another user account to Contao Manager? {#can-add-another-user-account to the Contao Manager}

Yes, you have to edit the file `users.json`in the directory `contao-manager`and add an additional user account. In our case this is `h.lewis`.

```json
{
    "users": {
        "k.jones": {
            "username": "k.jones",
            "password": "…"
        },
        "h.lewis": {
            "username": "h.lewis",
            "password": "…"
        }
    },
    "version": 2,
    "secret": "…"
}

```

### Can Contao Manager be added to an existing installation? {#the-contao manager can be added to an existing installation}

Yes, if you use a Contao installation in the Managed Edition, you can install Contao Manager later. Just upload the `contao-manager.phar`files into the directory `web`and add the file extension`.php`.

During the basic installation, the manager recognizes that Contao is already installed.
