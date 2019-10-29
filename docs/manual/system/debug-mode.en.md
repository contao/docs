---
title: "Debug Mode"
description: "The debug mode is useful during development of the web application and for tracking down errors."
weight: 30
---


During development of your web application the debug mode (also called _developer mode_
or _developer environment_) can be helpful for a variety of things. When enabled, 
the following things are in effect:

* Images are always generated and not loaded from cache.
* The page cache is disabled.
* The Symfony Profiler and its toolbar is enabled.
* CSS and JavaScript assets will not be combined.
* Template names will be shown in the source as HTML comments.


## Accessing the Debug Mode

The way you activate the debug mode is different between certain Contao
versions. 


### Contao 4.4 through 4.7

In Contao **4.4** through **4.7** you access the debug mode
by accessing the `app_dev.php` entry point. Prepend any URL you want to debug
with that entry point. For example, if you need to track down an error within the
Contao Install Tool, then you would access the debug mode via

```none
https://example.org/app_dev.php/contao/install
```

The `app_dev.php` entry point can be accessed at any time in your local developer
environment. However, in any other environment, you will need to set a username
and password first.


#### Command Line

Setting a username and a password for the `app_dev.php` entry point can be done
the following via the `contao:install-web-dir` console command:

```bash
$ vendor/bin/contao-console contao:install-web-dir --user=<USER> --password
```

Replace `<USER>` with the desired username. The command line utility will then ask 
you for the password. This creates a `.env` file in the root directory of the Contao
installation containing an environment variable which in turn will contain the username
and the encrypted password.


#### Contao Manager

In Contao **4.5** through **4.7** the username and password can also be set via 
the Contao Manager by using the _Debug Mode_ option in the _Maintenance_ section.

![Debug Mode](/de/system/images/en/contao-manager_c44-debug-mode_en.png?classes=shadow)

When clicking on _Activate_ the Contao Manager will ask you for the username and
password for the `app_dev.php` entry point. This in turn will execute the aforementioned
console command in the background and also create the `.env` file accordingly.


### Contao 4.8 and up

In Contao **4.8** and up the debug mode is enabled either via a special cookie
just for one user or via an environment variable.


#### Environment Variable

The environment variable used for controlling the debug mode is called `APP_ENV`
and needs to be set to `dev` in order to enable the debug mode. This environment
variable could be set globally in your system or within the configuration of your
web application's web server. It is also possible to set this environment variable
via `.env` files in your project root. The content of this files should then be:

```none
APP_ENV=dev
```

It is also possible to create an (initially) empty `.env` file and then next to
that a `.env.local` file with said content. Typically, you would then commit the
`.env` file to your project's Git repsitory, but the `.env.local` file should be
in your ignore list.

{{% notice warning %}}
Do _not_ deploy this file with the enabled debug mode to your live server! It would
pose a major security risk.
{{% /notice %}}


#### Back End Setting

The debug mode can also be enabled by administrators within the back end of Contao.
Next to the preview button there will be a _Debug Mode_ button. When clicked, this
will set a special cookie that enables the debug mode only for the current user.


#### Contao Manager

The debug mode can also be enabled from within the Contao Manager by using the 
_Debug Mode_ option in the _Maintenance_ section.


![Debug Mode](/de/system/images/en/contao-manager_c48-debug-mode_en.png?classes=shadow)

By clicking _Activate_ the Contao Manager will also set a cookie enabling the debug
mode for the current user.


## Symfony Profiler

The Symfony Profiler and its toolbar give detailed information about the execution 
of any request. When the debug mode is enabled, the toolbar will appear at the 
bottom of the browser window in a fixed position. It can be collapsed and opened
by clicking onto the Symfony logo.

![Symfony toolbar](/de/system/images/en/symfony-toolbar.png)

Some of the information you can gather via the profiler are:

* Symfony, Contao & PHP version
* Collected debug output from the `VarDumper` (`dump()`)
* Memory consumption
* Database processing times
* Logged in user properties
* Errors, warnings and deprecations


## Stack Trace

Usually when an error happens it will be logged into the `var/logs` directory.
However, to track down the cause of the error it is often helpful to get the full
stack trace. Within the debug mode you will be able to able to reproduce
the error and then get the full stack trace in the browser window - as well as in
the profiler.
