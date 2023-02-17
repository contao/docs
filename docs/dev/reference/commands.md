---
title: "Commands"
description: Contao's console commands.
---


Contao uses the Console component of Symfony and provides a few commands.
To execute these commands locate the `console` executable in your project
and append the subsequently documented commands.

```sh
php vendor/bin/contao-console <command-name>
```

You can get a list of all available commands like so:

```sh
php vendor/bin/contao-console list
```

By appending the `--help` argument to any command, a usage guide is printed to the shell.

```sh
php vendor/bin/contao-console contao:user:password --help

Description:
  Changes the password of a Contao back end user.

Usage:
  contao:user:password [options] [--] <username>

Arguments:
  username                 The username of the back end user

Options:
  -p, --password=PASSWORD  The new password
  […]

```

{{% notice note %}}
Detailed information about some commands can be found [here](https://docs.contao.org/manual/en/cli/).
{{% /notice %}}
