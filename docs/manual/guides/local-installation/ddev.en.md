---
title: "DDEV"
menuTitle : "With DDEV"
description: "With DDEV you can launch one or more Docker instances. XDEBUG, MariaDB and MySQL in different versions, PHP and much more."
url: "guides/local-installation/ddev"
aliases:
    - /en/guides/local-installation/ddev/
weight: 10
tags:
   - "Installation"
---

DDEV is an open source tool for launching local PHP development environments in minutes.

DDEV creates a `config.yml`, this contains all settings for your project. This can be versioned in GIT and supports collaborative work in teams or freelancers.

{{% notice note %}}
To use the DDEV, _Docker_ must be installed on your system. If this is not yet
the case, you can download the
[DDEV documentation](https://ddev.readthedocs.io/en/stable/users/install/docker-installation/) for
more information about installing these programs.
{{% /notice %}}


## Install DDEV

DDEV is available for all platforms, please refer to the [DDEV documentation](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/) for the installation of your platform.


### Example: Perform the installation on macOS with __brew__.

```shell
brew install ddev/ddev/ddev
```

After the installation install the local SSL certificates (afterwards restart your browser).

```shell
mkcert -install
```

You should also update your installation regularly.

```shell
brew upgrade ddev
```


### Example: Installation on Debian/Ubuntu

```shell
curl -fsSL https://apt.fury.io/drud/gpg.key | gpg --dearmor | sudo tee /etc/apt/trusted.gpg.d/ddev.gpg > /dev/null

echo "deb [signed-by=/etc/apt/trusted.gpg.d/ddev.gpg] https://apt.fury.io/drud/ * *" | sudo tee /etc/apt/sources.list.d/ddev.list

sudo apt update && sudo apt install -y ddev
```

If necessary, install the local SSL certificates after the installation (afterwards restart your browser).

```shell
mkcert -install
```

Installation Update

```shell
sudo apt update && sudo apt upgrade
```


## Create project

Open the console of your choice, create the desired directory and then change to it.

```shell
mkdir -p ~/projects/contao/contao-ddev && cd ~/projects/contao/contao-ddev
```

Create the DDEV configuration with:

```shell
ddev config
```

Make DDEV settings, select `php` as __Project Type__ in any case. Leave the __Docroot Location__ empty for now, because there is no `public` folder for new installations and DDEV can not start then.

```shell
ddev start
```

For installation via console it is easiest to go via ssh into the container.

```shell
ddev ssh
```

```shell
composer create-project contao/managed-edition contao 4.13
```

In the `.ddev/config.yml` now adjust the docroot and restart ddev.

```yml
docroot: "contao/public"
```

To use Apache instead of NGINX, change your entry `webserver_type: nginx-fpm` to `apache-fpm`.

```yml
webserver_type: apache-fpm
```

The `ddev` binary is not available in the container, so first switch to the host console with `exit`.

```shell
ddev restart
```

A database already exists in DDEV. The connection data for the installation are:

| entry | value |
|:--------------------|:----------------------|
| **host** | db |
| **username** | db |
| **password** | db |
| **Database** | db |

The database of the current project can be accessed via the phpMyAdmin add-on. Enter the following command to automatically open a browser tab with the administration tool for MySQL databases:

```shell
ddev phpmyadmin
```

Since ddev version 1.22.0 the support of phpmyadmin has been converted into a DDEV add-on. Therefore the above command must be used instead of `ddev launch -p`.

{{% notice note %}}
With `ddev describe` you get an overview of the services available in the project and how to reach them. With `ddev poweroff` you can stop all started projects/containers from any directory.

{{% /notice %}}


## DDEV Addons

DDEV now offers [Services as Addon](https://ddev.readthedocs.io/en/latest/users/extend/additional-services/).


### Example: Adminer

```shell
ddev get ddev/ddev-adminer && ddev restart
```
