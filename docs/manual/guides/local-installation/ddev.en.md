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
ddev config --project-type=php --docroot=public --webserver-type=apache-fpm --php-version=8.2 --create-docroot
```

Install Contao 5.3:

```shell
ddev composer create contao/managed-edition:5.3
```

After installation, the database access data must be entered in the `.env`. At the same time, we also set up Mailpit directly.

```env
APP_ENV=prod
DATABASE_URL="mysql://db:db@db:3306/db"
MAILER_DSN="smtp://localhost:1025?encryption=&auth_mode="
```

Then create the database:

```shell
ddev exec "bin/console contao:migrate"
```

Create backend user:

```shell
ddev exec "bin/console contao:user:create"
```

To use Apache instead of NGINX, change your entry `webserver_type: nginx-fpm` to `apache-fpm`.

```shell
ddev launch
```

{{% notice note %}}

With `ddev launch contao` you get directly to the administration.

{{% /notice %}}

The `ddev` binary is not available in the container, so first switch to the host console with `exit`.

## Additional information

`ddev start` starts the project, `ddev stop` ends it. Make sure beforehand that you have changed to the project folder.

`ddev poweroff` can stop all started projects/containers from any directory.

With `ddev ssh` you can switch to the shell of the container and work on the console. The `ddev` binary is not available in the container, so first switch to the host console with `exit`.

`ddev describe` gives an overview of the services available in the project and how to access them.

`ddev xdebug on` starts Xdedug. [Information about the IDE setup](https://ddev.readthedocs.io/en/latest/users/debugging-profiling/step-debugging/#ide-setup)

A database already exists in DDEV. The connection data for the installation are:

| entry | value |
|:--------------------|:----------------------|
| **host** | db |
| **username** | db |
| **password** | db |
| **Database** | db |

## DDEV Addons

DDEV now offers [Services as Addon](https://ddev.readthedocs.io/en/latest/users/extend/additional-services/).


### Example: Adminer

```shell
ddev get ddev/ddev-adminer && ddev restart
```

With `ddev describe` you can find out how to reach Adminer.