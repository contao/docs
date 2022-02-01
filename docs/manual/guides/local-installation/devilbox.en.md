---
title: "The Docker Devilbox"
menuTitle : "With Docker Devilbox"
description: "With the Docker Devilbox one or more Contao installations can be installed and maintained locally."
weight: 10
aliases:
    - /en/guides/local-installation/devilbox/
tags: 
   - "Installation"
---

The [Devilbox Project](http://devilbox.org/) is a complete LAMP stack for [Docker](https://www.docker.com/).
If you use the Docker-Toolbox, [this part](https://devilbox.readthedocs.io/en/latest/howto/docker-toolbox/docker-toolbox-and-the-devilbox.html#howto-docker-toolbox-and-the-devilbox) of the documentation are worth reading.

{{% notice note %}}
In order to run the Devilbox you need to have _Docker_ and _Docker Compose_ installed on your system. Read through the
[Devilbox Prerequisites documentation](https://devilbox.readthedocs.io/en/latest/getting-started/prerequisites.html) for 
more information on that, if you are not running these applications yet on your system.
{{% /notice %}}


## Install and configure the Devilbox

There is no installation routine. You just have to download the files from the Devilbox [GitHub Page](https://github.com/cytopia/devilbox) into an empty directory. The configuration takes place via a single file. In your directory you will find the file `env-example`. Copy and rename
the file to `.env`. In the new file you can now make your configurations. The following settings need to be changed:

* [NEW_UID](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#new-uid)
* [NEW_GID](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#new-gid)
* [HTTPD_DOCROOT_DIR](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#httpd-docroot-dir)
* [HTTPD_SERVER](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#httpd-server)
* [PHP_SERVER](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#php-server)
* [MYSQL_SERVER](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#mysql-server)

The individual steps (especially for the entries `NEW_UID` and` NEW_GID`) are well described in the [Devilbox Documentation](https://devilbox.readthedocs.io/en/latest/getting-started/install-the-devilbox.html#set-uid-and-gid). For Contao itself, the other entries should be set to something like this:

- `HTTPD_DOCROOT_DIR=web`
- `HTTPD_SERVER=apache-2.4`
- `PHP_SERVER=7.3`
- `MYSQL_SERVER=mariadb-10.3`

{{% notice note %}}
After every change in the configuration `.env` file, the Devilbox must be restarted.
{{% /notice %}}

{{% notice warning %}}
**Do not delete entries in the .env file!** For example, by default, the entry `HTTPD_SERVER=nginx-stable`
is set and `# HTTPD_SERVER=apache-2.4` is disabled (see **` # `** at the beginning of the line). To change such
entries you only have to enable or disable them by adding or removing the comment symbol. Make sure to enable `HTTPD_SERVER=apache-2.4`. As a web server nginx
could also be used. For Contao, however, further configuration of the web server will then be necessary.
{{% /notice %}}


## Start the Devilbox

Change to the directory and start the Devilbox with Docker. Initially it can take a while to create and load 
each Docker image and the containers. Restarts are much faster afterwards.

```bash
docker-compose up -d httpd php mysql
```


## Stop the Devilbox

```bash
docker-compose stop
```


## The Devilbox Dashboard

Once the Devilbox has started you can access the Devilbox dashboard in your browser under **`http: //127.0.0.1`**. The navigation gives you access to the various functions.

{{% notice note %}}
The IP address to use depends on your Docker environment. If you have the Docker-Toolbox installed, your IP address 
may be different. The IP address can be determined by using the command `docker-machine ip`.
{{% /notice %}}

| Navigation          | Description                                |
|:--------------------|:-------------------------------------------|
| **Home**            | Status information                         |
| **Virtual Hosts**   | List of existing vhosts or websites        |
| **Emails**          | E-Mail catch service                       |
| **Databases**       | Database information                       |
| **Info**            | More information                           |
| **Tools**           | Access to tools such as `phpMyAdmin`       |


## Prepare the Contao installation

One or more Contao installations are created in the Devilbox directory **`data\www`**. Each Contao installation will
reside in its own directory there. The directory name you choose will correspond to the vhost name. For example, a
directory named `contao4` will correspond to a vhost for `contao4.loc`. 

You have created a directory (e. g. `contao4`). Change to this directory and create a new subfolder `web`. Copy the 
Contao Manager `.phar` file into this folder and rename the file to` contao-manager.phar.php`.

{{% notice note %}}
The domain suffix `.loc` is the default. However, this can be changed in the `.env` file via the entry `TLD_SUFFIX`.
The manual editing of »`/etc/hosts`« may be neglected. The »Devilbox« offers a 
"[Auto DNS](https://devilbox.readthedocs.io/en/latest/intermediate/setup-auto-dns.html) feature. 
{{% /notice %}}


## Installation via the Contao Manager

Start `phpMyAdmin` in the Devilbox dashboard via `Tools\phpMyAdmin` and create a new database. Change then
in the navigation to the page `Virtual Hosts`. Here you should see a list of your existing web projects
and you can call them right away. You can now initiate the Contao installation via the Contao Manager. For example: `contao4.loc/contao-manager.phar.php`.

The further procedure is then identical to the normal installation.


## Installation via the command line

By default, the PHP memory limit for the Devilbox's PHP container is too low and therefore must be previously configured for Composer.
Change to the directory `cfg`. Did you configure the devilbox with PHP 7.3 in the `.env` file, make the following changes 
accordingly in the directory `cfg\php-ini-7-3`. Create a file `memory_limit.ini` with the following entry:

```bash
[PHP]
memory_limit = -1
```

Afterwards you have to restart the Devilbox. The Devilbox main directory contains the files `shell.sh` and` shell.bat`.
So you can plug into the running Devilbox PHP container. Here are already [numerous tools](https://devilbox.readthedocs.io/en/latest/readings/available-tools.html) preinstalled. Also `composer`. After calling you are in the directory `shared\http`. To install e. g. Contao 4.13 in a directory `contao413` you just have to enter:

```bash
composer create-project contao/managed-edition contao413 4.13
```

Create a new database:

```bash
mysql -u root -h mysql -p -e 'CREATE DATABASE db_contao413;'
```

Afterwards you can leave the container via `exit` and open the Contao Install Tool.


## The Contao Install Tool

The settings for the Contao Install Tool are basically identical. You only have to pay attention to the following entries:

| Entry               | Value                 |
|:--------------------|:----------------------|
| **Host**            | mysql                 |
| **Username**    | root                  |
| **Password**        | Do not enter a value  |

{{% notice note %}}
The user `root` with empty password is the Devilbox default setting. This could be changed in the Devilbox [configuration](https://devilbox.readthedocs.io/en/latest/support/faq.html#can-i-change-the-mysql-root-password). In this case, you must enter your configured credentials in the Contao Install Tool.
{{% /notice %}}
