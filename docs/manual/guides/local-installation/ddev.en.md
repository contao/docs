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

DDEV creates a `config.yaml`, this contains all settings for your project. This can be versioned in GIT and supports collaborative work in teams or freelancers.

{{% notice info %}}
To use the DDEV, _Docker_ must be installed on your system. If this is not yet
the case, you can download the
[DDEV documentation](https://ddev.readthedocs.io/en/stable/users/install/docker-installation/) for
more information about installing these programs.
{{% /notice %}}


## Install DDEV

DDEV is available for all platforms, please refer to the [DDEV documentation](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/) for the installation of your platform.

## Create project

{{% notice tip %}}
The [Contao demo website](https://demo.contao.org/) is maintained for the currently supported Contao versions and can be [optionally 
installed](https://github.com/contao/contao-demo). Via the Contao Manager you can simply select this option during the first installation.
{{% /notice %}}

{{< tabs groupid="ddev-contao-install">}}

{{% tab title="Composer" %}}
Open the console of your choice, create the desired directory and then change to it. The directory name reflects the subsequent project hostname. However, you can [configure this](https://ddev.readthedocs.io/en/latest/users/extend/additional-hostnames/) additionally.

```shell
mkdir contao && cd contao
```

Create the DDEV configuration with:

```shell
ddev config --project-type=php --docroot=public --webserver-type=apache-fpm --php-version=8.2
```

Install Contao 5.3:

```shell
ddev composer create contao/managed-edition:5.3
```

After installation, the database credentials must be entered in the `.env.local`. At the same time, we also set up 
[Mailpit](https://ddev.readthedocs.io/en/stable/users/usage/developer-tools/#email-capture-and-review-mailpit) directly.

```shell
ddev dotenv set .env.local --database-url=mysql://db:db@db:3306/db --mailer-dsn=smtp://localhost:1025
```

Then create the database:

```shell
ddev exec contao-console contao:migrate --no-interaction
```

Create backend user (Administrator):

```shell
ddev exec contao-console contao:user:create --username=admin --name=Administrator --email=admin@example.com --language=en --admin
```

Call up the Administration in the browser:

```shell
ddev launch contao
```

{{% /tab %}}

{{% tab title="Contao Manager" %}}

Open the console of your choice, create the desired directory and then change to it. The directory name reflects the subsequent project hostname. However, you can [configure this](https://ddev.readthedocs.io/en/latest/users/extend/additional-hostnames/) additionally.

```shell
mkdir contao && cd contao
```

Create the DDEV configuration with:

```shell
ddev config --project-type=php --docroot=public --webserver-type=apache-fpm --php-version=8.2
```

After installation, the database access data must be entered in the .env.local. At the same time, we also set up 
[Mailpit](https://ddev.readthedocs.io/en/stable/users/usage/developer-tools/#email-capture-and-review-mailpit) directly.

```shell
ddev dotenv set .env.local --database-url=mysql://db:db@db:3306/db --mailer-dsn=smtp://localhost:1025
```

Download the Contao Manager, rename it (.php) and copy it into the `public` directory. You can also use `wget` or `curl` to do this.

```shell
ddev start
ddev exec "wget -O public/contao-manager.phar.php https://download.contao.org/contao-manager/stable/contao-manager.phar"
```

Open the Contao Manager and follow the instructions:

```shell
ddev launch contao-manager.phar.php
```

{{% /tab %}}

{{< /tabs >}}


## Additional information

You can find more information about managing projects [here](https://ddev.readthedocs.io/en/stable/users/usage/managing-projects/#listing-project-information).

- `ddev start` starts the project, `ddev stop` ends it. Make sure beforehand that you have changed to the project folder.

- `ddev poweroff` can stop all started projects/containers from any directory.

- With `ddev ssh` you can switch to the shell of the container and work on the console. The `ddev` binary is not available in the container, so first switch to the host console with `exit`.

- `ddev describe` gives an overview of the services available in the project and how to access them.

- `ddev xdebug on` starts XDebug. [Information about the IDE setup](https://ddev.readthedocs.io/en/latest/users/debugging-profiling/step-debugging/#ide-setup)

{{% notice info %}}
If you are a Windows user using the "Git Bash" as a console, it may be necessary, depending on your "Git for Windows" configuration, to prepend the command `winpty` (e.g.: `winpty ddev ssh`).
{{% /notice %}}

## Custom PHP Configuration

DDEV can be used to provide additional PHP configurations for a project. You can add any number of `.ini` files in the directory `.ddev/php/`. Subsequent changes require a `ddev restart`. Further information can be found in the [DDEV documentation](https://ddev.readthedocs.io/en/stable/users/extend/customization-extendibility/#custom-php-configuration-phpini).

An example file in `.ddev/php/my-php.ini` could look like this:

```ini
[PHP]
memory_limit = -1
```


## Database Tools

If you want to use a database client such as `Adminer` or `phpMyAdmin` for example, you can install these as a 
[Addon](https://ddev.readthedocs.io/en/latest/users/extend/additional-services/).


### Example: Adminer

```shell
ddev add-on get ddev/ddev-adminer && ddev restart
```

### Example: phpMyAdmin

```shell
ddev add-on get ddev/ddev-phpmyadmin && ddev restart
```

With `ddev describe` you can find out how to access the respective database tool.


## Setting up a cron job in DDEV

{{< version-tag "5.5" >}} The [back end search](https://docs.contao.org/manual/en/installation/system-requirements/backend-search/) can be activated by setting up the [Contao cronjob framework](https://docs.contao.org/manual/en/performance/cronjobs/).

To do this, first install the [cron add-on](https://github.com/ddev/ddev-cron) in DDEV:

```shell
ddev add-on get ddev/ddev-cron
```
{{% notice info %}}
If you have been using DDEV for a long time, you may receive an error message when setting up `ddev add-on get ddev/ddev-cron`. The reason for this is that the add-on has only been supported by DDEV since version 1.24. So you need to update DDEV.
{{% /notice %}}

Then create a `/.ddev/web-build/contao.cron` file with the following content:

```shell
* * * * * ddev exec vendor/bin/contao-console contao:cron
```

{{% notice info %}}
Please note that under certain circumstances, it is not possible to call the contao console outside the container. A `* * * * * php /var/www/html/vendor/bin/contao-console contao:cron` is not possible. This is only possible on root installations. Please use **ddev ssh** or **ddev exec** instead, in accordance with the DDEV Docs.
{{% /notice %}}

Then restart the DDEV project/container:

```shell
ddev restart
```

The Contao cronjob is executed every minute. When setting up for the first time, it may take 1-2 minutes before the search bar is available in the back end.

## Setting up a local shared repository path inside your DDEV container

If you want to configure a path in your container where all your local bundles are stored and which you can use in your **composer.json**, you can do so as follows:

Create a file inside the **./ddev** folder with the name **docker-compose.bundles.yaml**.

The content can look like this (Please adjust the paths to suit your needs.):
```
services:
  web:
    volumes:
    - /home/$USER/repository:/home/$USER/repository:rw
```
Then restart the container with `ddev restart`.

Now you can use the repository in your root **composer.json**. 
```
"repositories": [
  {
    "type": "path",
    "url": "~/repository/my-local-bundle"
  }
],
```

{{% notice info %}}
If the Contao Manager cannot find the repositories, it helps to deactivate the **Composer Resolver Cloud**.
{{% /notice %}}
