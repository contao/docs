---
title: "Install Contao - Quick start"
description: "The first steps to installing Contao with the Contao Manager."
aliases:
- /en/installation/quickstart/
weight: 15
---

We assume here that you want to install either the latest version or the [Long Term Support Version](https://docs.contao.org/manual/en/installation/update-contao/#long-term-support-versions) with the Contao Manager. This is the easiest and recommended way for beginners. Some hosting 
providers offer 1-click installations. However, for the best user experience, we recommend using the Contao Manager or the console.


## Hosting configuration

You configure the hosting via the admin panel of your hosting provider.

### Root directory (document root)

Your provider will usually give you a folder where you can store your websites - this is often a `/www`, `/public_html` or `/httpdocs`
folder. There you can install Contao for your new website. It has proven useful to first create a subfolder in this 
path, e.g. `/example` for the page `example.com` - this is then your installation or project folder.

In Contao, all publicly accessible files are located in the `/public` subfolder. Create a folder called `public` and
set the root directory (document root) of the installation to this subfolder via the admin panel of the hosting provider
to this subfolder.

**Example:** `example.com` points to the directory `/www/example/public`.

### Database

Contao requires a [MySQL](../../installation/system-requirements/#mysql-minimum-requirements) database for operation, which you 
should ideally create right away. Its login credentials will be needed later.


## Installing the Contao Manager

The [Contao Manager](../../installation/contao-manager/) consists of a single file which can be downloaded from 
[contao.org](https://contao.org/en/download). After a successful download you will receive a file called `contao-manager.phar`. 
Transfer this file to the `public` directory on your web server.

{{% notice info %}}
`.phar` files are not executed by all hosting providers. For best compatibility, add the `.php` file extension 
<b>after the upload</b> (i.e. rename the file <b>on the server</b> to `contao-manager.phar.php`).
{{% /notice %}}

## Call Contao Manager

Now call up the URL `www.example.com/contao-manager.phar.php` with your browser, replacing `www.example.com` with your domain.
You should see the welcome page of the Contao Manager.

![Welcome page of the Contao Manager]({{% asset "images/manual/installation/en/welcomepage-contao-manager.png" %}}?classes=shadow)

### Basic configuration

Before you install Contao you need to configure the manager itself. To do this create a new user by
assigning a username and password. Username and password are independent of the later Contao installation!


### Server configuration

The Contao Manager needs the path to the PHP binary and other server information to run background processes correctly. 
Usually, this information is detected automatically.

![Server configuration]({{% asset "images/manual/installation/en/server-configuration.png" %}}?classes=shadow)


### Composer Resolver Cloud

The [Composer Resolver Cloud](https://composer-resolver.cloud/) allows the installation of Composer dependencies even 
if the server does not have enough memory. Please note that your package information is sent to a 
[Contao Association](https://association.contao.org/) cloud service for dependency resolution.


### Installing Contao with the Contao Manager

After the successful basic configuration, Contao can now be installed. To do this, select the desired version
and the initial configuration and click on the "Install" button.

Optionally, you can also install the Contao "[sample website](https://demo.contao.org/)".

![Installing Contao with the Contao Manager]({{% asset "images/manual/installation/en/contao-manager-setup.png" %}}?classes=shadow)

The installation may now take several minutes. Details of the installation process can be viewed by clicking on the following 
icon ![Show/hide console output]({{% asset "icons/konsolenausgabe.png" %}}?classes=icon).



![Contao is being installed]({{% asset "images/manual/installation/en/contao-manager-background-task.png" %}}?classes=shadow)


### Updating database tables

Once the Contao Manager has installed all packages, the database needs to be updated. To do this 
the [Contao-Installtool](../contao-installtool/) has to be started (Contao 4.13 LTS) or the required information has to be entered 
directly in the Contao Manager (Contao 5.x). 


## Create an administrator account

Finally, you need to create an administrator user with which you can log in to the Contao back end later.

![Create an administrator account]({{% asset "images/manual/installation/en/installtool-create-admin-account.png" %}}?classes=shadow)

**User name:** Here you define the user name of the administrator.

**Name:** Here you enter the first and last name of the administrator.

**E-mail address:** Here you enter the e-mail address of the administrator.

**Password:** Here you set the password of the administrator and confirm it.

After you have created the administrator user, the installation of Contao is complete.  
The link at the bottom right will take you to the back end. There you can create 
[the first start page](../../guides/add-first-index-page/).
