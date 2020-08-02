---
title: Laragon
menuTitle: 'With Laragon'
description: 'With Laragon, one or more Contao installations can be installed and maintained locally.'
aliases:
    - /en/guides/local-installation/laragon/
weight: 20
tags:
    - Installation
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

In this tutorial the setup of a local development environment under Windows is described using [Laragon](https://laragon.org) as an example.

With **Laragon WAMP**, a local software stack consisting of the following server components is installed:

- Apache Web Server
- MySQL
- PHP

The installation package also includes other useful tools, but these are not discussed in detail here.   
 More information about Laragon (installation, features, etc.) can be found in the [official documentation](https://laragon.org/docs/).

## 1. system requirements

Windows 7, 8, 8.1, 10

{{% notice note %}}
 This manual describes how to install Laragon on Windows 10 (64-bit). 
{{% /notice %}}

## 2. preparatory measures

The security concept of current Contao versions (specifically Contao 4.x and higher) requires that for the proper operation of the web application, *symbolic links* (so-called *symlinks*) have to be created. However, creating symlinks under Windows usually requires administrator rights. It is therefore recommended that the ordinary Windows user also be granted the appropriate right to create symlinks. The easiest way to do this is to use the free tool [Polsedit](https://www.southsoftware.com) . The ZIP archive contains both 32-bit and 64-bit versions of Polsedit and can be run directly without installation.

**ToDo: Configure permission to create symbolic links in Group Policy**

- Download Polsedit: <https://www.southsoftware.com/polsedit.html>
- Unpack ZIP archive
- For Windows 10 (64 bit): `polseditx64.exe` (64-bit version) run
- In the right pane, search for the " *Create symbolic links* " `(SE_CREATE_SYMBOLIC_LINK_NAME)`policy:

![Search for "Create symbolic links"](/de/guides/local-installation/images/de/laragon/01_polsedit.png?width=800px&classes=shadow)

- Double-click on " *Create symbolic links* " to open the properties window of the policy:

![Open the policy entry](/de/guides/local-installation/images/de/laragon/02_polsedit_policy_properties.png?width=300px&classes=shadow)

- The button " *Add User or Group.*.. " button to select your (current) Windows user in the list of user accounts and confirm the selection by clicking "OK". The Windows user should now also be listed in the policy properties (in addition to the existing user accounts).
- Close the properties window and exit Polsedit.
- User logoff/logon (or restart the system) for the policy changes to take effect.

## 3. download and install Laragon

The installation of Laragon is consistently intuitive and largely self-explanatory via the guided installation process. The latest release of the WAMP stack can be downloaded directly from GitHub in the appropriate version.

**ToDo: Download and install Laragon**

- Download the latest release from the Laragon [GitHub repository](https://github.com/leokhoa/laragon/releases/latest)
- For Windows 10 (64 bit): `laragon-wamp.exe` (64-bit version) download
- Run the installation file`laragon-wamp.exe`. Windows Defender SmartScreen may display a message at this point indicating that an unknown app was prevented from starting. However, the link " *More information* " allows you to " *Run* Laragon Setup *anyway* ".
- In the first step of the setup process, the language can be changed to " *English* " if desired.
- The setup wizard will then guide you through the rest of the installation.
- The "*Select destination folder*" dialog is used to specify where Laragon is to be installed (e.g. on another drive or partition).
- In the next dialog window, some configuration settings can already be specified, including the option to have "*Virtual Hosts*" created automatically.
- At the end of the installation process there is a possibility to start Laragon automatically.

In future, Laragon can be accessed via the corresponding new entry in the Windows Start menu or via the Laragon shortcut icon on the Windows desktop. When the application is started, a program icon will appear in the Windows notification area (System Tray), which also displays the status of the services (started or stopped) and from which the Laragon management panel can be opened:

![Laragon Management Panel](/de/guides/local-installation/images/de/laragon/03_laragon.png?width=500px&classes=shadow)

## 4. configure Laragon

Laragon can be adapted and configured relatively easily. For example, the " *Create new website*" feature allows you to completely automate the installation of a new Contao instance so that a fresh Contao installation can be set up with just a few clicks.

**ToDo: Set settings in Laragon and configure apps**

- Start Laragon
- In the Laragon management panel, click on " *Menu* " and then " *Settings* " (the menu can also be opened by right-clicking on a free space in the management panel):

![Open menu in the Laragon Management Panel](/de/guides/local-installation/images/de/laragon/04_laragon_menu.png?width=500px&classes=shadow)

- In the " *General* " tab of the Laragon settings, enable the " *Automatically start all services* " option and for the " *Automatically create virtual hosts* " option, change the " *Host name* scheme " as follows `{name}.local`

![Laragon Settings](/de/guides/local-installation/images/de/laragon/05_laragon_settings.png?width=500px&classes=shadow)

- In the " *Services/Ports* " tab of the Laragon settings, make sure that the two services " *Apache* " and " *MySQL* " are selected. If you wish, you can also enable SSL support via port 443:

![Laragon Settings](/de/guides/local-installation/images/de/laragon/06_laragon_services.png?width=500px&classes=shadow)

{{% notice note %}}
 The Laragon configuration settings are `laragon\usr\laragon.ini`stored in the and can of course be changed there as well. 
{{% /notice %}}

- Use " *Menu* " &gt; " Laragon *"* &gt; " laragon*.ini "* to open the Laragon configuration file for editing:

![Edit Laragon configuration file](/de/guides/local-installation/images/de/laragon/07_laragon_ini.png?width=500px&classes=shadow)

- In the section `[php]`add the PHP `sys_temp_dir`variable to the values of the key`QuickSettings`:

```
QuickSettings=xdebug, max_execution_time, upload_max_filesize, post_max_size, memory_limit, sys_temp_dir
```

- Use " *Menu* " &gt; " PHP *"* &gt; " Quick *settings "* to open the PHP quick settings

![Open PHP quick settings](/de/guides/local-installation/images/de/laragon/08_laragon_php.png?width=500px&classes=shadow)

- In the submenu select the entry "\_memory *limit = .*.. " and set the PHP memory limit to the value (or `-1``2G`or `4G`):

![Set PHP memory limit](/de/guides/local-installation/images/de/laragon/09_laragon_php_memory_limit.png?width=250px&classes=shadow)

- In the same sub-menu, select the entry "\_sys\_temp *dir = .*.. " and set the temporary directory to the value `C:\laragon\tmp`(adjust the Laragon root directory if necessary, if Laragon is not installed on the drive `C:\`under the default path):

![set sys_temp_dir](/de/guides/local-installation/images/de/laragon/10_laragon_php_sys_temp_dir.png?width=250px&classes=shadow)

- Via " *Menu* " &gt; " PHP *"* &gt; " PHP Extensions *"* further PHP extensions can be conveniently activated or deactivated if required.
- Click on the button " *All services*... " button starts the web and database server:

![Start web and database server](/de/guides/local-installation/images/de/laragon/11_laragon_servers.png?width=500px&classes=shadow)

- At this point, the Windows Defender Firewall (or possibly another system firewall) reports quite securely and prompts both the " *Apache HTTP Server* " and the *MySQL* server " *mysqld.exe* " to allow access to the local network. These two accesses must be granted for the further operation of the web and database server.
- If the servers are allowed to access the corresponding ports successfully, Laragon should display the two services " *Apache* " and " *MySQL* " as " *started* ":

![Services successfully started](/de/guides/local-installation/images/de/laragon/12_laragon_running.png?width=500px&classes=shadow)

- Now the local web server should be running and the Laragon index page should already be accessible via the web browser via <http://localhost/>

![Laragon index page](/de/guides/local-installation/images/de/laragon/13_laragon_localhost.png?width=500px&classes=shadow)

- To make PHP (and all other Laragon tools/programs) accessible system-wide, the corresponding Laragon paths must be added to the Windows environment variable (PATH variable). The environment variables can be updated automatically via the Laragon management panel: " *Menu* " &gt; " *Tools "* &gt; " *Environment Variables " &gt;* " Add Laragon *to Path ":*

![Add Windows environment variable in the Laragon management panel](/de/guides/local-installation/images/de/laragon/14_laragon_path.png?width=500px&classes=shadow)

In the same sub-menu, the Laragon environment variables can be removed if necessary. The "*Manage Path*" menu item can also be used to check whether the path specifications have been correctly added to the PATH environment variable.

- Via " *Menu* " &gt; " *Create new website "* &gt; " *Configuration*... " the existing app configurations can be changed or supplemented accordingly:

![Customizing App Configurations](/de/guides/local-installation/images/de/laragon/15_laragon_app_config.png?width=500px&classes=shadow)

{{% notice note %}}
 The app configurations are saved in the file`laragon\usr\sites.conf`. 
{{% /notice %}}

- In the configuration file `laragon\usr\sites.conf`the contao-specific adjustments can now be added:

```
# Options
AutoCreateDatabase=true
Cached=true

# Blank: an empty project
Blank=

------------------------------------------------------

# Contao 3.5
Contao 3.5 Website …=composer create-project contao/core %s 3.5.*

# Contao 4.4 LTS
Contao 4.4 Website …=composer create-project contao/managed-edition %s 4.4.* && curl https://download.contao.org/contao-manager/stable/contao-manager.phar -o %s/web/contao-manager.phar.php

# Contao 4.9 LTS
Contao 4.9 Website …=composer create-project contao/managed-edition %s 4.9.* && curl https://download.contao.org/contao-manager/stable/contao-manager.phar -o %s/web/contao-manager.phar.php

------------------------------------------------------

# Wordpress
Wordpress=https://wordpress.org/latest.tar.gz 

# Joomla
### Joomla=https://github.com/joomla/joomla-cms/releases/download/3.8.11/Joomla_3.8.11-Stable-Full_Package.tar.gz

# Prestashop
### Prestashop=https://github.com/PrestaShop/PrestaShop/releases/download/1.7.4.2/prestashop_1.7.4.2.zip

------------------------------------------------------

# Drupal
Drupal 8=https://ftp.drupal.org/files/projects/drupal-8.5.5.tar.gz
### Drupal 7=https://ftp.drupal.org/files/projects/drupal-7.59.tar.gz

------------------------------------------------------

# Laravel

Laravel=composer create-project laravel/laravel %s --prefer-dist

Laravel (zip)=https://github.com/leokhoa/quick-create-laravel/releases/download/5.6.21/laravel-5.6.21.7z

### Laravel dev-develop=composer create-project laravel/laravel %s dev-develop
### Laravel 4=composer create-project laravel/laravel  %s 4.2 --prefer-dist 
### Lumen=composer create-project laravel/lumen  %s --prefer-dist

------------------------------------------------------

# CakePHP
### CakePHP=composer create-project --prefer-dist cakephp/app %s

# Symfony 4
Symfony=composer create-project symfony/website-skeleton %s
```

Of course, the app configurations of the other web applications can also be removed or commented out, as long as they are no longer needed.

The parameter `AutoCreateDatabase`in the section `Options`can be used to configure whether databases should also be created automatically or not. By default, every newly created web project also creates a new, empty database with the same name at the same time.

{{% notice note %}}
 The changes in the `laragon\usr\sites.conf`are immediately active after saving, so Laragon does not need to be restarted. 
{{% /notice %}}

## 5. install Composer globally

Although Laragon already comes with Composer, it may be necessary to install the PHP dependency manager globally on the system.

**ToDo: Install Composer globally**

- Download the Composer Windows installer: <https://getcomposer.org/Composer-Setup.exe>
- Run the installation file `Composer-Setup.exe`and follow the guided installation process in the setup wizard:

![Install Composer](/de/guides/local-installation/images/de/laragon/16_composer_install.png?width=500px&classes=shadow)

- The Composer Setup Wizard should be able to determine the path to `php.exe`the Laragon automatically, provided that the Laragon paths - as specified above - have been added to the Windows PATH environment variable.
- The Composer Windows Installer also updates the Windows PATH environment variable to make Composer available and accessible system-wide.
- For testing purposes, you could navigate to the Laragon directory `laragon\www`in Windows Explorer, right-click on it to start the "*Console*" and, for example`php -v`, `composer -V`run it:

![Testing whether Composer was successfully installed](/de/guides/local-installation/images/de/laragon/17_laragon_console.png?width=800px&classes=shadow)

## 6. install Contao

As mentioned before, the Laragon feature " *Create new website* " allows you to create a new website based on any version of Contao relatively quickly and with just a few clicks. Laragon will automatically create the empty database and configure the virtual host.

**ToDo: Set up a new Contao installation**

- Start Laragon
- The goal is to set up a sample website " *mycompany* " that runs with Contao 4.9.
- In the Laragon Management Panel, open " *Menu* " &gt; " *Create new website "* (or alternatively right-click in the Laragon Management Panel or right-click on the Laragon tray icon) and select the entry " Contao *4.9 Website ... "*:

![Create new website](/de/guides/local-installation/images/de/laragon/18_laragon_websiteproject.png?width=500px&classes=shadow)

- Enter the project name of the example `mycompany`website in the input field (if possible, the project name should not contain any special characters, as this is also used as the database name) and confirm with "OK":

![Enter project name](/de/guides/local-installation/images/de/laragon/19_laragon_websiteproject_2.png?width=250px&classes=shadow)

- A console window opens: In the background, Contao 4.9 (including all required packages) is installed via Composer. Afterwards, the Contao Manager script is downloaded and saved in a subfolder `web/`as `contao-manager.phar.php`a file.
- Laragon also automatically creates a database of the same name " *mycompany* " and a virtual host `mycompany.local`
- For the virtual host, the Windows hosts file must also be updated. Therefore, depending on the Windows User Account Control (UAC) configuration, you may be prompted to confirm the changes to the system file after installation is complete. In addition, a message from the anti-virus software (or other security software) may indicate that access to the Windows hosts file is blocked for security reasons. If this is indeed the case, you would first have to temporarily disable the corresponding setting in the security software and then manually add the entry in the Windows hosts file. To do this, open the Hosts file in the editor in the Laragon management panel via " *Menu* " &gt; " *Tools "* &gt; " *Edit drivers\\etc\\hosts "* and add a new line

```
127.0.0.1      mycompany.local      #laragon magic!
```

in addition:

![Edit drivers\etc\hosts in the Laragon management panel](/de/guides/local-installation/images/de/laragon/20_laragon_hosts.png?width=500px&classes=shadow)

- If the new virtual host is configured correctly, you should now be able to launch the [Contao install tool](/de/installation/contao-installtool/) via `http://mycompany.local/contao/install`.
- After confirming the license terms, you first set the password of the Contao installation tool as usual and then enter the database access data in the corresponding fields. By default, the DB user name is root, the DB password field remains empty (if no password has been set) and the project name (i.e. mycompany) is entered for the database name:

![Contao installation tool](/de/guides/local-installation/images/de/laragon/21_contao_installtool.png?width=800px&classes=shadow)

- If Contao can successfully connect to the specified database, it will immediately update the database by generating all necessary tables and the database structure.
- At the end of the installation process, an administrator account for the Contao back end is created.
- The Contao front- and backend, the Contao install tool and the Contao Manager should now be accessible via the following URLs

**Contao front-end:** <http://mycompany.local/>   
  **Contao backend:** <http://mycompany.local/contao> (or http://mycompany.local/contao/login [)](http://mycompany.local/contao/login)   
 **Contao install tool:** <http://mycompany.local/contao/install>   
 **Contao Manager:** <http://mycompany.local/contao-manager.phar.php>   
 (the system check of the Contao Manager should automatically detect the path to the PHP binary if a manual configuration is selected in the server configuration via " *Other .*.. ")

{{% notice note %}}
 If the browser software carries out a web search for this keyword when you enter, for example`mycompany.local`, contrary to expectations, you should also specify the schema or network `http://`protocol when you call it up, i.e`http://mycompany.local/`. . 
{{% /notice %}}

## Addendum

**Appendix with further information/tasks:**

### A Update Laragon

**ToDo: Install the latest version of Laragon**

- First stop all running services (Apache, MySQL) and close Laragon.
- Download the latest version of the Laragon executable from the [GitHub Master branch](https://github.com/leokhoa/laragon/raw/master/laragon.exe)
- Replace the existing `laragon.exe`one in the Laragon installation directory with the previously downloaded executable.
- Launch Laragon.

### B Delete project

**ToDo: Remove an existing website project**

- In the Laragon management panel, open " *Menu* " &gt; " *Tools "* &gt; " Delete *project "* and select the website project to be deleted from the submenu:

![Remove Website Project in the Laragon Management Panel](/de/guides/local-installation/images/de/laragon/22_laragon_deleteproject.png?width=500px&classes=shadow)

- In the next dialog box, Laragon will inform you that both the project folder and the associated database will be removed. These actions cannot be undone, i.e. the data is irretrievably deleted. When you are aware of what you are doing, confirm the deletion.

### C Install Contao Official Demo (COD)

**ToDo: Install Contao Official Demo**

- In the Laragon Management Panel, use the " *WWW Folder* " button to open the Laragon www folder in the Explorer:

![Open Laragon www folder in Explorer](/de/guides/local-installation/images/de/laragon/23_laragon_www.png?width=500px&classes=shadow)

- In the context menu of the project folder of the website (corresponds to the installation directory of the Contao installation), open a new console window via " *Console* ".
- On the command line, run the following command to install the [Contao Official Demo (COD)](https://packagist.org/packages/contao/official-demo) via Composer

```
composer require contao/official-demo
```

Depending on the Contao version, it might be necessary to request the appropriate version of the Contao Official Demo (COD). For Contao 4.9 this would be for example:

```
composer require contao/official-demo:4.4.0
```

- Composer then performs a dependency resolution. If this is successful, the package is downloaded and installed in the system.
- Call the Contao install tool and import the SQL database dump of the Contao Official Demo (COD). Attention: All data already in the database will be deleted when importing the COD dump.

{{% notice note %}}
 Like any other package/bundle, the Contao Official Demo (COD) can be installed in the same way via Contao Manager. 
{{% /notice %}}

### D Database administration with phpMyAdmin

**ToDo: Install phpMyAdmin**

- Download phpMyAdmin from the official website: <https://www.phpmyadmin.net/downloads/>
- Unpack the ZIP archive and rename the folder `phpMyAdmin-x.x.x-all-languages`in phpMyAdmin (Attention: Please note that the folder name is case sensitive!)
- `laragon\etc\apps\`Copy/move the folder `phpMyAdmin`including all files and subfolders contained therein to Copy/Move. In the directory`laragon\etc\apps\phpMyAdmin\`, `config.sample.inc.php`duplicate the sample template of the phpMyAdmin configuration file and rename the copy to `config.inc.php``config.inc.php`Edit the configuration file and adjust the settings as follows:

```php
/* Authentication type */
$cfg['Servers'][$i]['auth_type'] = 'cookie';
/* Server parameters */
$cfg['Servers'][$i]['host'] = 'localhost';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = true;
$cfg['Servers'][$i]['port'] = 3306;

$cfg['LoginCookieValidity'] = 36000;  
```

- call phpMyAdmin via`http://localhost/phpmyadmin`
- Log in to phpMyAdmin: 
  - username: `root`
  - Password: <leer></leer>

{{% notice note %}}
 The Apache alias configuration for phpMyAdmin is located in `laragon\etc\apache2\alias\phpmyadmin.conf`
{{% /notice %}}

### E Additional PHP versions

Sometimes you need PHP 5.6 for older web projects, but you want to test new features with PHP 7.3. In the following, both PHP 5.6 and PHP 7.3 will be made available in Laragon.

**ToDo: Add more PHP versions and switch between the different PHP versions**

- Download the latest releases of PHP 5.6 and PHP 7.3 (currently `php-5.6.40-Win32-VC11-x64.zip`and `php-7.3.2-Win32-VC15-x64.zip`): <https://windows.php.net/downloads/releases/>
- Unpack the two ZIP archives of PHP 5.6 and PHP 7.3 in the folder `laragon\bin\php`into the appropriate folders ( `php-5.6.40-Win32-VC11-x64`or `php-7.3.2-Win32-VC15-x64`).
- After choosing the thread-safe (TS) variant for both PHP versions, make sure that the compiler versions of Visual C++ (VCxx) for the Apache web server and PHP match: 
  - PHP: `php-5.6.40-Win32-`**VC11**`-x64` --&gt; Apache: VC11`httpd-2.4.38-win64-`
  - PHP: `php-7.3.2-Win32-`**VC15**`-x64` --&gt; Apache: VC15`httpd-2.4.35-win64-`
- For PHP 7.3 the appropriate Apache version is already available. For PHP 5.6, however, the VC11 version of the Apache web server must first be downloaded.
- Download Apache 2.4 VC11 Windows Binary ( `httpd-2.4.38-win64-VC11.zip`): <https://www.apachelounge.com/download/VC11/>
- Unpack the ZIP archive for Apache 2.4 VC11 in the folder `laragon\bin\apache`into the corresponding folder ( `httpd-2.4.38-win64-VC11`). The unpacked files and folders may have to be moved to match the given folder structure (see `httpd-2.4.35-win64-VC15`).
- Change PHP version:

![Change PHP version](/de/guides/local-installation/images/de/laragon/24_laragon_php_versions.png?width=500px&classes=shadow)

- Change Apache version:

![Changing Apache Version](/de/guides/local-installation/images/de/laragon/25_laragon_apache_version.png?width=500px&classes=shadow)

### F Help

There is a [thread](https://community.contao.org/de/showthread.php?74042) in the [Contao forum](https://community.contao.org/) that deals with the installation and operation of Laragon or you can get advice in the Laragon forum [DE](https://laraboard.io/forum/) or [EN](https://forum.laragon.org/)
