---
title: 'About Contao Manager'
description: 'Contao Manager is a tool that provides a graphical interface to easily manage a Contao installation.'
aliases:
    - /en/installation/contao-manager/
weight: 20
---

The development of the Contao Manager is supported by the [Contao Association](https://association.contao.org/).

## Task of the manager

Like most PHP projects, Contao is installed and updated with [Composer](https://getcomposer.org). Composer is a package manager that can be used from the command line and can also be used to manage Contao completely from the command line. The Contao Manager is a tool that provides a graphical user interface to manage a Contao installation. It takes the hurdle of the command line and allows you to execute the necessary commands with just one click.

The manager can be used to perform the following tasks, among others:

- Install Contao
- Update Contao
- Search for extensions
- Install extensions
- Uninstalling extensions
- Empty Contao Cache (system maintenance)

Further functions are planned for the future, such as Define system settings.

The Contao Manager is optional and not required for running Contao. However, the tool makes it easier for beginners to install and manage extensions because no composer knowledge is required.

It is still possible to manage the installation of Contao 4 and extensions directly from the command line using Composer.

## Install Contao Manager

### System requirements

The system requirements are basically the same as for [Contao](/en/installation/system-requirements/). The Contao Manager automatically checks if the requirements are met.

- PHP version 7.4 or newer
- PHP extension *Intl* and *OpenSSL*
- PHP functions *proc\_open* and *proc\_close*
- PHP setting *allow\_url\_fopen* must be active

### Hosting Configuration

In Contao, all publicly accessible files are located in the subfolder `/web` of the installation. Create the folder `web` and set the document root of the installation to this subfolder using your hosting provider's admin panel.

**Example:** `example.com` points to the directory `/www/example/web`

{{% notice note %}}
Every Contao installation requires a separate (sub)domain.
{{% /notice %}}

### Download and Installation

The Contao Manager consists of a single file that can be [downloaded from contao.org](https://contao.org/en/download.html). After the successful download you will receive a file `contao-manager.phar`. transfer this file to the directory `web` on your web server.

{{% notice info %}}
Files `.phar` are not executed by all hosting providers. For best compatibility, add the file extension `.php`(final file name: `contao-manager.phar.php`).
{{% /notice %}}

{{% notice warning %}}
`.php` files are transferred by most FTP programs in text mode instead of binary mode, which destroys the manager file. Therefore, add the file extension `.php` only after the upload. 
{{% /notice %}}

### Starting Contao Manager

Then use your browser to access the URL `www.example.com/contao-manager.phar.php`. You should see the Contao Manager welcome page.

![Welcome page of the Contao Manager](/de/installation/images/en/welcomepage-contao-manager.png?classes=shadow)

### Basic configuration

Before you install Contao, you have to configure the manager itself. Create a new user by entering a username and password. The password is independent from the following Contao installation.

Contao Manager does not need its own database. The configuration of the Contao Manager is stored in the database `manager.json` and the user data in the `users.json` in the directory `/contao-manager`.

{{% notice warning %}}
It is important to complete the basic configuration. Otherwise, anyone could gain access with their own username and password.
{{% /notice %}}


### Server configuration

The Contao Manager needs the path to the PHP binary and other server information to run background processes correctly. The path is usually automatically detected by the Contao Manager.
faulhaber.com


![Server configuration](/de/installation/images/en/server-configuration.png?classes=shadow)

#### Composer Resolver Cloud

The [Composer Resolver Cloud](https://composer-resolver.cloud/) allows you to install Composer dependencies even if the server does not have enough memory. Please note that your dependency resolution package information is [sent](https://association.contao.org/) to a [Contao Association](https://association.contao.org/) cloud service.

After the successful basic configuration, Contao can now be [installed](/en/installation/install-contao/#installing-contao-with-the-contao-manager).

## Frequently asked questions about the Contao Manager

### How to update the Contao Manager?

Basically, a manual update is not necessary. The manager automatically checks in the background and updates itself if a new version is available.

In case of problems, you can always download the latest `contao-manager.phar` version and [upload and replace](#download-and-installation) it manually via [FTP](#download-and-installation).

### Did you forget your Contao Manager login information?

To reset your password, you must connect to your server via FTP.

In the directory `contao-manager`, delete the file `users.json`.

Now call the Contao Manager from your domain with the addition `contao-manager.phar.php` and create a new admin user.

If you see the login mask for an existing user despite deleting the file `users.json`, delete the cookies of the domain or open the Contao Manager page in the "incognito mode" of your browser.

### The Contao Manager has "hung up"

If the Contao Manager stops responding, the console output window does not close, or after a reload of the manager page
or after a reload of the manager page you always get the same output, delete the file `contao-manager` in the directory `task.json`.
delete the file `task.json`.

After that, the Contao Manager should run again.

### Can I add another user account to Contao Manager?

Yes, you have to edit the file `users.json` in the directory `contao-manager` and add an additional user account. In our case this is `h.lewis`.

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

{{% notice info %}}
The value for "password" must be entered encrypted. You can use services like [bcrypt-generator.com](https://bcrypt-generator.com/)
for example in order to generate the necessary hashed value. Alternatively, you can generate the hash value with the following console call
in your own Contao installation:

```bash
php vendor/bin/contao-console security:encode-password 'my_1._pA~~~w0rd'
```
{{% /notice %}}


### Can Contao Manager be added to an existing installation?

Yes, if you use a Contao installation in the Managed Edition, you can install Contao Manager later. Just upload the `contao-manager.phar` files into the directory `web` and add the file extension `.php`.

During the basic installation, the manager recognizes that Contao is already installed.


### Can I rename the ».phar« file?
Yes. You can use any file name you want. However, the Contao Manager is no longer accessible from the Contao Backend. 
In this case, you can change the [config.yml](/en/system/settings/#config-yml) accordingly. Afterwards, you have to empty the application cache 
once using the Contao Manager ("Maintenance" &gt; "Application Cache" &gt; "Rebuild Production Cache") or the console.
```yml
# config/config.yml
contao_manager:
    manager_path: your-name.phar.php
```

