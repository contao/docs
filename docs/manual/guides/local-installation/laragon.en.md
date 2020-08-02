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

With **Laragon WAMP** a local software stack consisting of the following server components is installed:

- Apache Web Server
- MySQL
- PHP

The installation package also includes other useful tools, which will  
 not be discussed here, but you can find more information about Laragon (installation, features, etc.) in the [official documentation](https://laragon.org/docs/).

## 1. system requirements

Windows 7, 8, 8.1, 10

{{% notice note %}}
This manual describes how to install Laragon on Windows 10 (64-bit).
{{% /notice %}}

## 2. preparatory measures

The security concept of current Contao versions (specifically Contao 4.x and higher) requires that *symbolic links* (*symlinks*) have to be created for the proper operation of the web application. However, creating symlinks under Windows usually requires administrator rights. It is therefore recommended that the ordinary Windows user also be granted the appropriate right to create symlinks. The easiest way to do this is to use the free [Polsedit](https://www.southsoftware.com) tool. The ZIP archive contains both a 32-bit and 64-bit version of Polsedit and can be run directly without installation.

**ToDo: Configure permission to create symbolic links in Group Policy**

- Download Polsedit: <https://www.southsoftware.com/polsedit.html>
- Unpack ZIP archive
- For Windows 10 (64 bit): `polseditx64.exe` (64 bit version) run
- In the right pane, `(SE_CREATE_SYMBOLIC_LINK_NAME)`search for the policy "*Create symbolic links*":

![Search for "Create symbolic links"](/de/guides/local-installation/images/de/laragon/01_polsedit.png?width=800px&classes=shadow)

- Double-click on "*Create symbolic links*" to open the policy's properties window:

![Open the policy entry](/de/guides/local-installation/images/de/laragon/02_polsedit_policy_properties.png?width=300px&classes=shadow)

- Via the button "*Add User or Group*... " button to select your (current) Windows user in the list of user accounts and click "OK" to confirm your selection. The Windows user should now also be listed in the policy properties (in addition to the existing user accounts).
- Close the properties window and quit Polsedit.
- Log off/log on the user (or restart the system) so that the policy changes take effect.

## 3. download and install Laragon

The installation of Laragon is consistently intuitive and largely self-explanatory via the guided installation process. The latest release of the WAMP stack can be downloaded directly from GitHub in the appropriate version.

**ToDo: Download and install Laragon**

- Download the latest release from the Laragon [GitHub repository](https://github.com/leokhoa/laragon/releases/latest)
- For Windows 10 (64-bit): `laragon-wamp.exe` (64-bit version) download
- Run the installation file`laragon-wamp.exe`. Under certain circumstances, a message from the Windows Defender SmartScreen may appear at this point, indicating that the start of an unknown app has been prevented. However, the link "*More Information*" allows you to "*Run* Laragon Setup *anyway*".
- In the first step of the setup process the language can be changed to "*German*" if desired.
- The setup wizard will then guide you through the installation.
- In the dialog "*Select destination folder*" you can specify where Laragon should be installed (e.g. on another drive or partition).
- In the next dialog window, some configuration settings can already be specified, including the option to automatically create "*virtual hosts*".
- At the end of the installation process there is the option to start Laragon automatically.

In the future, Laragon can be accessed via the corresponding new entry in the Windows Start menu or via the Laragon shortcut icon on the Windows desktop. After starting the application, a program icon appears in the Windows notification area (System Tray) that also displays the status of the services (started or stopped) and can be used to open the Laragon management panel:

![Laragon Management Panel](/de/guides/local-installation/images/de/laragon/03_laragon.png?width=500px&classes=shadow)

## 4. configure Laragon

Laragon can be adapted and configured relatively easily. For example, the "*Create new website*" feature can be used to completely automate the installation of a new Contao instance so that a fresh Contao installation can be set up with just a few clicks.

**ToDo: Define settings in Laragon and configure apps**

- Start Laragon
- In the Laragon management panel, click on "*Menu*" and then "*Settings*" (the menu can also be opened by right-clicking on a free space in the management panel):

![Open menu in the Laragon Management Panel](/de/guides/local-installation/images/de/laragon/04_laragon_menu.png?width=500px&classes=shadow)

- In the "*General*" tab of the Laragon settings, enable the option "*Start all services automatically*" and for the option "*Create virtual hosts automatically*" change the "*host name*" scheme as follows: `{name}.local`

![Laragon Settings](/de/guides/local-installation/images/de/laragon/05_laragon_settings.png?width=500px&classes=shadow)

- In the "*Services/Ports*" tab of the Laragon settings, make sure that the two services "*Apache*" and "*MySQL*" are selected. If desired, you could also enable SSL support via port 443 here:

![Laragon Settings](/de/guides/local-installation/images/de/laragon/06_laragon_services.png?width=500px&classes=shadow)

The Laragon configuration settings are `laragon\usr\laragon.ini`stored in the file and can of course be changed there as well.{{% notice note %}}
%

- Use "*Menu*" &gt; "Laragon*"* &gt; "laragon*.ini"* to open *the* Laragon configuration file for editing:

![Edit Laragon configuration file](/de/guides/local-installation/images/de/laragon/07_laragon_ini.png?width=500px&classes=shadow)

- In the section `[php]`add the PHP `sys_temp_dir`variable to the values of the key`QuickSettings`:

```
QuickSettings=xdebug, max_execution_time, upload_max_filesize, post_max_size, memory_limit, sys_temp_dir
```

- Open the PHP quick settings via "*Menu*" &gt; "PHP*"* &gt; "Quick *settings"*:

![Open PHP quick settings](/de/guides/local-installation/images/de/laragon/08_laragon_php.png?width=500px&classes=shadow)

- Select the entry "\_memorylimit *= ..."* from the submenu and set the PHP memory limit to the value (or `-1``2G`or `4G`):

![Set PHP memory limit](/de/guides/local-installation/images/de/laragon/09_laragon_php_memory_limit.png?width=250px&classes=shadow)

- In the same submenu, select the entry "\_sys\_tempdir *= ..."* and set the temporary directory to the value `C:\laragon\tmp`(adjust the Laragon root directory if necessary, if Laragon is not installed on the drive `C:\`under the default path):

![set sys_temp_dir](/de/guides/local-installation/images/de/laragon/10_laragon_php_sys_temp_dir.png?width=250px&classes=shadow)

- Via "*Menu*" &gt; "PHP*"* &gt; "PHP extensions*"* further PHP extensions can be easily activated or deactivated if required.
- The button "*All services*... " starts the web and database server:

![Start web and database server](/de/guides/local-installation/images/de/laragon/11_laragon_servers.png?width=500px&classes=shadow)

- At this point, the Windows Defender Firewall (or possibly another system firewall) will almost certainly report and prompt both the "*Apache HTTP Server*" and the *MySQL* server "*mysqld.exe*" to allow access to the local network. These two accesses must be granted for the further operation of the web and database server.
- If the servers are allowed to access the corresponding ports successfully, Laragon should show the two services "*Apache*" and "*MySQL*" as "*started*":

![Services successfully started](/de/guides/local-installation/images/de/laragon/12_laragon_running.png?width=500px&classes=shadow)

- Now the local web server should be running and the Laragon index page should already be accessible via the web browser via [http://localhost/:](http://localhost/)

![Laragon index page](/de/guides/local-installation/images/de/laragon/13_laragon_localhost.png?width=500px&classes=shadow)

- In order to allow system-wide access to PHP (and all other Laragon tools/programs), the corresponding Laragon paths must be added to the Windows environment variable (PATH variable). The environment variables can be updated automatically via the Laragon management panel: "*Menu*" &gt; "*Tools"* &gt; "*Environment Variables" &gt; "*Add Laragon *to Path":*

![Add Windows environment variable in the Laragon management panel](/de/guides/local-installation/images/de/laragon/14_laragon_path.png?width=500px&classes=shadow)

In the same submenu, the Laragon environment variables can be removed if necessary. You can also use the menu item "*Manage Path*" to check if the path information has been added correctly to the PATH environment variable.

- Via "*Menu*" &gt; "*Create New Website"* &gt; "*Configuration*... " the existing app configurations can be changed or supplemented accordingly:

![Customizing App Configurations](/de/guides/local-installation/images/de/laragon/15_laragon_app_config.png?width=500px&classes=shadow)

{{% notice note %}}
The app configurations are saved to the file`laragon\usr\sites.conf`.
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

Using the parameter `AutoCreateDatabase`in the section `Options`you can configure whether databases should also be created automatically or not. By default, every newly created web project will also create a new, empty database with the same name at the same time.

{{% notice note %}}
The changes in the `laragon\usr\sites.conf`are immediately active after saving; Laragon does not need to be restarted. 
{{% /notice %}}

## 5. install Composer globally

Although Laragon already comes with Composer, it may be necessary to install the PHP dependency manager globally on the system.

**ToDo: Install Composer globally**

- Download the Composer Windows installer: <https://getcomposer.org/Composer-Setup.exe>
- Run the installation file `Composer-Setup.exe`and follow the guided installation process in the setup wizard:

![Install Composer](/de/guides/local-installation/images/de/laragon/16_composer_install.png?width=500px&classes=shadow)

- The Composer Setup Wizard `php.exe`should be able to determine the path to automatically, provided the Laragon Paths have been added to the Windows PATH environment variable as specified above.
- The Composer Windows Installer also updates the Windows PATH environment variable to make Composer available and accessible system-wide.
- For testing purposes, you could `laragon\www`navigate to the Laragon directory in Windows Explorer, right-click on it to start the "*Console*" and, for example`php -v`, execute and `composer -V`run it:

![Testing whether Composer was successfully installed](/de/guides/local-installation/images/de/laragon/17_laragon_console.png?width=800px&classes=shadow)

## 6. install Contao

As mentioned before, the Laragon feature "*Create a new website*" allows you to create a new website based on any version of Contao relatively quickly and with just a few clicks. Laragon will automatically create the empty database and configure the virtual host.

**ToDo: Set up a new Contao installation**

- Start Laragon
- The goal is to create a sample website "*mycompany*" that runs with Contao 4.9.
- Open "*Menu*" &gt; "*Create new website"* in the Laragon Management Panel (or alternatively right-click the Laragon tray icon in the Laragon Management Panel) and select the entry "Contao *4.9 Website ..."*:

![Create new website](/de/guides/local-installation/images/de/laragon/18_laragon_websiteproject.png?width=500px&classes=shadow)

- Enter the project name of the example website `mycompany`in the input field (if possible, the project name should not contain any special characters, because it is also used as database name) and confirm with "OK":

![Enter project name](/de/guides/local-installation/images/de/laragon/19_laragon_websiteproject_2.png?width=250px&classes=shadow)

- A console window opens: In the background, Contao 4.9 (including all required packages) is installed via Composer. Afterwards, the Contao Manager script is downloaded and saved in the subfolder `web/`as `contao-manager.phar.php`.
- Laragon also automatically creates a database of the same name "*mycompany*" and a virtual host `mycompany.local`
- For the virtual host, the Windows hosts file must also be updated. Therefore, depending on the Windows User Account Control (UAC) configuration, you may be prompted to confirm the changes to the system file after installation is complete. In addition, a message from the anti-virus software (or other security software) may indicate that access to the Windows hosts file is blocked for security reasons. If this is indeed the case, you would first have to temporarily disable the corresponding setting in the security software and then manually add the entry in the Windows hosts file. To do this, open *the* Hosts file in the editor in the Laragon management panel via "*Menu*" &gt; "*Tools"* &gt; "*Edit drivers\\etc\\hosts"* and add a new line

```
127.0.0.1      mycompany.local      #laragon magic!
```

in addition:

![Edit drivers\etc\hosts in the Laragon management panel](/de/guides/local-installation/images/de/laragon/20_laragon_hosts.png?width=500px&classes=shadow)

- If the new virtual host is configured correctly, you should now be able to launch the [Contao install tool](/de/installation/contao-installtool/) via `http://mycompany.local/contao/install`.
- After confirming the license terms, you first set the password of the Contao installation tool as usual and then enter the database access data in the corresponding fields. By default, the DB user name is root, the DB password field remains empty (if no password has been set) and the project name (i.e. mycompany) is entered for the database name:

![Contao installation tool](/de/guides/local-installation/images/de/laragon/21_contao_installtool.png?width=800px&classes=shadow)

- If Contao can successfully connect to the specified database, the database will be updated immediately afterwards by generating all necessary tables and the database structure.
- At the end of the installation process, an administrator account is created for the Contao back end.
- The Contao front and back end, the Contao installation tool and the Contao Manager should now be accessible via the following URLs:

  
**Contao front end:** [**http://mycompany.local/Contao-Backend:**](http://mycompany.local/) <http://mycompany.local/contao> (or  
[ http://mycompany.local/contao/login](http://mycompany.local/contao/login))**Contao installation tool:**  
[ http:](http://mycompany.local/contao/install)**//mycompany.local/contao/installContao Manager:**  
[ http://mycompany.local/contao-manager.phar.php](http://mycompany.local/contao-manager.phar.php)(the system check of the Contao Manager should automatically detect the path to the PHP binary if a manual configuration is selected in the server configuration via "*Other .*..")

{{% notice note %}}
If the browser software performs a web search for this keyword when entering, for example, contrary `mycompany.local`to expectations, the schema or network protocol `http://`should also be specified when calling, i.e. `http://mycompany.local/`.
{{% /notice %}}

## Addendum

**Appendix with further information/tasks:**

### Update A Laragon

**ToDo: Install the latest version of Laragon**

- First stop all running services (Apache, MySQL) and close Laragon.
- Download the latest version of the Laragon executable from the [GitHub Master branch](https://github.com/leokhoa/laragon/raw/master/laragon.exe)
- Replace the existing `laragon.exe`one in the Laragon installation directory with the previously downloaded executable.
- Start Laragon.

### B Delete project

**ToDo: Remove an existing website project**

- Open "*Menu*" &gt; "*Tools"* &gt; "Delete *project"* in the Laragon management panel and select the website project to be deleted from the submenu:

![Remove Website Project in the Laragon Management Panel](/de/guides/local-installation/images/de/laragon/22_laragon_deleteproject.png?width=500px&classes=shadow)

- In the next dialog box, Laragon will inform you that both the project folder and its associated database will be removed. These actions cannot be undone, i.e. the data will be irretrievably deleted. When you are aware of what you are doing, confirm the deletion.

### C Install Contao Official Demo (COD)

**ToDo: Install Contao Official Demo**

- In the Laragon Management Panel, click the "*WWW Folder*" button to open the Laragon www folder in Explorer:

![Open Laragon www folder in Explorer](/de/guides/local-installation/images/de/laragon/23_laragon_www.png?width=500px&classes=shadow)

- Open a new console window in the context menu of the website's project folder (corresponds to the installation directory of the Contao installation) via "*Console*".
- On the command line, execute the following command to install the [Contao Official Demo (COD)](https://packagist.org/packages/contao/official-demo) via Composer

```
composer require contao/official-demo
```

Depending on the Contao version, it might be necessary to request the appropriate version of the Contao Official Demo (COD). For Contao 4.9, this would be the case:

```
composer require contao/official-demo:4.4.0
```

- Composer then performs a dependency resolution. If this is successful, the package is downloaded and installed in the system.
- Call the Contao install tool and import the SQL database dump of the Contao Official Demo (COD). Note: All data already in the database will be deleted when the COD dump is imported.

{{% notice note %}}
 Like any other package/bundle, the Contao Official Demo (COD) can be installed in the same way via Contao Manager.

### D Database administration with phpMyAdmin

**ToDo: Install phpMyAdmin**

- Download phpMyAdmin from the official website: <https://www.phpmyadmin.net/downloads/>
- Unpack the ZIP archive and rename the folder `phpMyAdmin-x.x.x-all-languages`in phpMyAdmin (Attention: Please note that the folder name is case sensitive!)
- `laragon\etc\apps\`Copy/move the folder `phpMyAdmin`including all files and subfolders to copy/move.in the folder `laragon\etc\apps\phpMyAdmin\``config.sample.inc.php`duplicate the example template of the phpMyAdmin configuration file and rename the copy to`config.inc.php`.`config.inc.php`edit the configuration file and adjust the settings as follows

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

- `http://localhost/phpmyadmin`call phpMyAdmin via
- Log in to phpMyAdmin:
  - Username: `root`
  - Password: <leer></leer>

{{% notice note %}}The Apache alias configuration for phpMyAdmin is located in 
{{% /notice %}}
`laragon\etc\apache2\alias\phpmyadmin.conf`

### E Additional PHP versions

Sometimes you need PHP 5.6 for older web projects, but you want to test new features with PHP 7.3. In the following, both PHP 5.6 and PHP 7.3 will be made available in Laragon.

**ToDo: Add more PHP versions and switch between the different PHP versions**

- Download the latest releases of PHP 5.6 and PHP 7.3 (currently `php-5.6.40-Win32-VC11-x64.zip`and `php-7.3.2-Win32-VC15-x64.zip`): <https://windows.php.net/downloads/releases/>
- Unpack the two ZIP archives of PHP 5.6 and PHP 7.3 in the folder `laragon\bin\php`into the corresponding folders (`php-5.6.40-Win32-VC11-x64` or `php-7.3.2-Win32-VC15-x64`).
- After choosing the thread-safe (TS) variant for the two PHP versions, make sure that the compiler versions of Visual C++ (VCxx) for the Apache web server and PHP match:
  - PHP: `php-5.6.40-Win32-`**VC11**`-x64` --&gt; Apache: VC11`httpd-2.4.38-win64-`
  - PHP: `php-7.3.2-Win32-`**VC15**`-x64` --&gt; Apache: VC15`httpd-2.4.35-win64-`
- For PHP 7.3, the appropriate Apache version is already available. For PHP 5.6, the VC11 version of the Apache web server must be downloaded first.
- Download Apache 2.4 VC11 Windows Binary (`httpd-2.4.38-win64-VC11.zip`): <https://www.apachelounge.com/download/VC11/>
- Unpack the ZIP archive for Apache 2.4 VC11 in the folder `laragon\bin\apache`into the corresponding folder (`httpd-2.4.38-win64-VC11`). The unpacked files and folders may have to be moved to match the given folder structure (see `httpd-2.4.35-win64-VC15`).
- Change PHP version:

![Change PHP version](/de/guides/local-installation/images/de/laragon/24_laragon_php_versions.png?width=500px&classes=shadow)

- Change Apache version:

![Changing Apache Version](/de/guides/local-installation/images/de/laragon/25_laragon_apache_version.png?width=500px&classes=shadow)

### F Help

There is a [thread](https://community.contao.org/de/showthread.php?74042) in the [Contao forum](https://community.contao.org/) that deals with the installation and operation of Laragon or you can get advice in the Laragon forum [DE](https://laraboard.io/forum/) or [EN](https://forum.laragon.org/)
