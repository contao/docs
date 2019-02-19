---
title: "Install Contao Manager"
description: ""
weight: 1
---




### System requirements

The requirements basically correspond to those of Contao 4. The Contao Manager automatically checks the requirements.

- PHP version 5.5.9 or newer
- PHP extension `Intl` and `OpenSSL`
- PHP functions `proc_open` and `proc_close`
- PHP setting `allow_url_fopen` must be active

{{% notice note %}}
The Contao Manager currently can not be used on Windows servers.
{{% /notice %}}


### Hosting configuration

Contao 4 contains all publicly accessible files in the subfolder `/web` of the installation. Create the folder `web` and set the root directory (Document Root) of the installation to this subfolder (e.g. via the admin panel of the hosting provider).

**Example:** example.com points to the directory `/www/example.com/web`

{{% notice note %}}
Therefore each Contao installation requires its own (sub)domain.
{{% /notice %}}


### Download & installation

The Contao Manager consists of a single file, which can be downloaded via [contao.org][1]. After successful download you will receive a file `contao-manager.phar`. Transfer this file to the `web directory on your web server.

{{% notice info %}}
`.phar` files will not run by all hosting providers. For best compatibility, add the file extension `.php` (final filename: `contao-manager.phar.php`).
{{% /notice %}}

{{% notice warning %}}
`.php` files are transmitted in text instead of binary mode by most of the FTP programs, which destroys the manager file. Add the file extension `.php` after the upload.
{{% /notice %}}


### Call Contao Manager

Use your browser and go to the URL `http://www.example.com/contao-manager.phar.php`. You should now see the welcome screen of the Contao Manager.


### Basic configuration

You must configure the manager, before you can install Contao. To do
 so, create a new user by assigning a username and a password. The password
 is independent of the one used later for the Contao installation.

The Contao Manager does not need its own database. The configuration is
stored in several files in the subfolder `contao-manager`.

The subfolder `contao-manager` is in the root directory of your Contao installation.

```bash
├── app
├── assets
├── contao-manager
│   ├── cache
│   ├── config.json
│   ├── manager.json
│   └── users.json
├── files
├── system
├── templates
├── var
├── vendor
├── web
├── composer.lock
└── composer.json
```


### Server Configuration

The Contao Manager automatically tries to detect the PHP path. Unfortunately, 
this is not always possible, so you should check the setting.

The Composer Cloud Resolver is enabled per default and allows you to install
Composer dependencies even if your server does not provide enough local memory. 

{{% notice warning %}}
Please be aware that your package information will be transmitted to a cloud
server operated by the <a href="https://association.contao.org/">Contao Association</a>.
{{% /notice %}}
    

[1]: https://contao.org/en/download.html