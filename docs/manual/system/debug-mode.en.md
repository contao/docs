---
title: "Debug Mode"
description: "The debug mode is useful during development of the web application and for tracking down errors."
weight: 30
aliases:
    - /en/system/debug-mode/
---


During development of your web application the debug mode (also called _developer mode_
or _developer environment_) can be helpful for a variety of things. When enabled, 
the following things are in effect:

* Stack traces of errors will be shown.
* The page cache is disabled.
* The Symfony Profiler and its toolbar is enabled.
* CSS and JavaScript assets will not be combined.
* Template names will be shown in the source as HTML comments.


## Accessing the Debug Mode

In Contao the debug mode is enabled either via a special cookie
just for one user or via an environment variable for everyone.


### Environment Variable

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
`.env` file to your project's Git repository, but the `.env.local` file should be
in your ignore list.

{{% notice warning %}}
Do _not_ deploy this file with the enabled debug mode to your live server! It would
pose a major security risk.
{{% /notice %}}

{{% notice info %}}
Further environment variables can be set this way. A description can be found in the [Developer Documentation](/../dev/reference/config/#environment-variables-for-the-contao-managed-edition).
{{% /notice %}}


### Back End Setting

The debug mode can also be enabled by administrators within the back end of Contao.
Next to the preview button there will be a _Debug Mode_ button. When clicked, this
will set a special cookie that enables the debug mode only for the current user.

{{% notice info %}}
The button will only be displayed, if you have not defined the app environment in your `.env` file.
{{% /notice %}}


## Symfony Profiler

The Symfony Profiler and its toolbar give detailed information about the execution 
of any request. When the debug mode is enabled, the toolbar will appear at the 
bottom of the browser window in a fixed position. It can be collapsed and opened
by clicking onto the Symfony logo.

![Symfony toolbar](/de/system/images/en/symfony-toolbar.png?classes=shadow)

Some of the information you can gather via the profiler are:

* Symfony, Contao & PHP version
* Collected debug output from the `VarDumper` (`dump()`)
* Memory consumption
* Database query times
* Logged in user properties
* Errors, warnings and deprecations


## Stack Trace

Usually when an error happens it will be logged into the `var/logs` directory.
However, to track down the cause of the error it is often helpful to get the full
stack trace. Within the debug mode you will be able to reproduce
the error and then get the full stack trace in the browser window - as well as in
the profiler.
