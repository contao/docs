---
title: "XAMPP"
menuTitle : "With XAMPP"
description: "Contao installation with XAMPP"
weight: 30
aliases:
    - /en/guides/local-installation/xampp/    
tags: 
   - "Installation"
---


This tutorial describes the local use of Contao with [XAMPP](https://www.apachefriends.org/) for Windows. 
We use a »XAMPP Portable Version«, which only needs to be copied. You select the appropriate Windows .zip archive, e.g. [xampp-portable-windows-x64-7.4.16-0-VC15.zip](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.16/xampp-portable-windows-x64-7.4.16-0-VC15.zip/download).

Then unpack the archive to e.g. `D:\xampp` and start the `setup_xampp.bat` file once. The »XAMPP installation« is now complete.


## Start XAMPP

In your directory you will find the file »xampp-control.exe«. Right-click on it to start it with the option »Run as administrator«. 
In the »XAMPP Control Panel«, activate the modules »Apache« and »MySQL«. 

Furthermore, click once on the button `Shell`. Afterwards the file »xampp_shell.bat« is created in your directory and a 
corresponding »XAMPP console« is opened. In order to check this, enter the command console enter the command `php -v`. 
You should receive the corresponding PHP (CLI) version as output and can then close the console.

In your browser, enter `http://localhost` to access the »XAMPP Dashboard" with general information. Here you will find a 
link in the upper menu called `PHPInfo` with information about the current PHP configuration.

{{% notice info %}}
You should always start the »XAMPP Control Panel« (xampp-control.exe) and the »XAMPP Console« (xampp_shell.bat) with 
administrator rights. 
{{% /notice %}}


## PHP configuration

According to the [Contao system requirements](/en/installation/system-requirements/) we have to adjust the 
PHP configuration once. To do this, first stop the modules »Apache« and »MySQL« in the »XAMPP Control-Panel«.

In the file `D:\xampp\apache\php.ini` look for the lines »memory_limit« and »extension=intl« and change them as follows:

| Entry                   | Change                     |
|:------------------------|:---------------------------|
| **memory_limit = 512M** | **memory_limit = -1**      |
| **;extension=intl**     | **extension=intl**         |

{{% notice tip %}}
The changes mentioned are mandatory for the installation via the [PHP composer](https://getcomposer.org/) or 
the [Contao manager](/en/installation/contao-manager/). In addition, you can optionally change the entries 
»allow_url_fopen«, »max_execution_time« or »file_uploads« and adjust them.
{{% /notice %}}

**Congratulations!** You have completed all preparations for a local Contao installation.


## Local PHP Composer Installation

We have not carried out a »XAMPP« installation under Windows in the true sense. Therefore, we will only copy the required 
PHP-Composer file. 

Start the »Apache« and »MySQL« modules via the »XAMPP Control Panel« with administrator authorisation. Open 
the »XAMPP-Console« (xampp_shell.bat) with administrator authorisation and change into your current XAMPP directory. 

Then carry out [the following information](https://getcomposer.org/download/) step by step:

```php
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

In your XAMPP directory you will now find the file `composer.phar`. By entering `php composer.phar -V` you should get 
a corresponding response.


### Installing Contao with PHP Composer

Without further vHost configuration (see below), XAMPP expects the files of your website in the XAMPP directory `htdocs`. 
In the »XAMPP console« you change to this subdirectory and install a Contao version by entering e.g.:

```php
php ../composer.phar create-project contao/managed-edition demo 4.9
```

Your Contao installation is now located in the XAMPP directory `htdocs\demo`.

{{% notice note %}}
This procedure is optional. You can also run the Contao installation directly from the Contao manager.
For example, create the directories `demo\web` in the XAMPP directory `htdocs`. Copy the 
[Contao-Manager](https://contao.org/de/download.html) into the directory `demo\web` and rename the file to 
to »contao-manager.phar.php«.
{{% /notice %}}


## Contao calls (without own vHost)

In the »XAMPP Control Panel« you can execute `phpMyAdmin` in the »MySql« area via the »Admin« button and create a 
database as usual. If you have not already done so, copy the [Contao-Manager](https://contao.org/de/download.html) 
into the directory `demo\web` and rename the file to »contao-manager.phar.php«. 

Your Contao installation can now be completed. However, the Contao calls are different. Without a vHost 
configuration (see below), they differ from the known possibilities. At the moment you can only use the local,
internal domain `localhost` and this points to the directory `htdocs` in XAMPP by default.

The Contao calls for our example installation in the directory `htdocs\demo` would therefore be:

| Destination     | Call                                                                                                         |
|:----------------|:-------------------------------------------------------------------------------------------------------------|
| Install-Tool    | http://localhost/demo/web/contao/install                                                                     |
| Contao-Backend  | http://localhost/demo/web/contao                                                                             |
| Contao-Frontend | http://localhost/demo/web                                                                                    |
| Contao-Manager  | http://localhost/demo/web/contao-manager.phar.php/ <br/>**The slash at the end is mandatory!**               |

{{% notice warning %}}
You can therefore work with Contao without your own »XAMPP vHost configuration« (see below) as long as you consider the 
above calls. Within Contao's own linking (e.g.: starting the Contao Manager from the backend etc.) you will still 
get error messages, because they assume a »correct« environment. Therefore, it would be advisable to establish a 
one-time XAMPP configuration via an own vHost.
{{% /notice %}}


## A own vHost configuration

A unique, own XAMPP vHost configuration offers numerous advantages. On the one hand, you can maintain your 
Contao installation(s) outside the XAMPP directory and link them to your own local domain names.

Create a new directory e.g. `D:\vhost\demo\web`. Copy the [Contao Manager](https://contao.org/de/download.html) 
into this directory and rename the file to »contao-manager.phar.php«. 


### Create domain name

We want to access our Contao installation via the domain `demo.local`. In the Windows directory `System32/drivers/etc`.
add the entry `127.0.0.1 demo.local` to the file `hosts`. Basically you can now use this 
domain. However, it still makes no difference to the previous procedure. We have to configure XAMPP to use our new directory.


### The vHost configuration

Open the file `\apache\conf\httpd.conf` in your XAMPP directory and look for the line 
`#LoadModule vhost_alias_module modules/mod_vhost_alias.so`. Remove the hashtag `#` and save your changes. 
In the `\apache\conf\extra\httpd-vhosts.conf` file, add the following information:

```php
<VirtualHost *:80>
  ServerAdmin webmaster@demo.local
  DocumentRoot "D:\vhost\demo\web"
  ServerName demo.local
  ServerAlias www.demo.local
  <Directory D:\vhost\demo>
    Options +FollowSymlinks
    AllowOverride All
    Require all granted
  </Directory>

  ErrorLog "D:\xampp\apache\logs\demo.local_error.log"
  CustomLog "D:\xampp\apache\logs\demo.local_access.log" combined
</VirtualHost>
```

If necessary, adjust the paths to your current directories. In the »XAMPP Control-Panel« you have to restart 
the modules »Apache« and »MySQL«. After that, you can access the Contao manager by calling `http://demo.local/contao-manager.phar.php`.

{{% notice tip %}}
With this approach, you could also maintain multiple Contao installations over different, local domain names with 
separate vHost entries.
{{% /notice %}}


## Create SSL certificate

By calling e.g.: `http://demo.local/contao-manager.phar.php` you will get a hint in the Contao Manager 
that this is an »Insecure connection«. This is correct, because XAMPP does not deliver an SSL certificate for our domain
`demo.local` or it does not exist.

In the XAMPP directory `\apache` you will find the file »makecert.bat«, which you can use to create a new local V1 
certificate. Start this file in the »XAMPP console« and follow the instructions. Your entries here are 
basically arbitrary. Only the entry at `Common Name` must correspond to the current, local domain name. 
For our example `demo.local` is mandatory.

In the directories `apache\conf\ssl.crt`, `apache\conf\ssl.csr` and `apache\conf\ssl.key` new certificate information 
has been generated. In the XAMPP vHost configuration this information must be must be stored. To do this, add the 
following information to the `\apache\conf\extra\httpd-vhosts.conf` file:

```php
<VirtualHost *:443>
  ServerAdmin webmaster@demo.local
  DocumentRoot "D:\vhost\demo\web"
  ServerName demo.local
  ServerAlias www.demo.local

  SSLEngine on
  SSLCertificateFile "D:\xampp\apache\conf\ssl.crt\server.crt"
  SSLCertificateKeyFile "D:\xampp\apache\conf\ssl.key\server.key"

  <Directory D:\vhost\demo>
    Options +FollowSymlinks
    AllowOverride All
    Require all granted
  </Directory>

  ErrorLog "D:\xampp\apache\logs\demo.local_error.log"
  CustomLog "D:\xampp\apache\logs\demo.local_access.log" combined
</VirtualHost>
```

Again, change the paths according to your current implementation and restart the modules »Apache« and »MySQL« 
in the »XAMPP Control-Panel«. Afterwards, you can access the Contao manager via `https://demo.local/contao-manager.phar`.

Your browser will still display a warning message, because it recognizes our locally created certificate but does not it. 
You can ignore this and confirm the domain `demo.local` as an exception. 

In the Contao manager itself, the previous warning about an »Unsecure connection« will no longer be displayed.
