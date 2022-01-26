---
title: "Command line"
description: "Contao provides various commands that you can use to manage your application"
aliases:
- /en/cli/
weight: 91
---

The command line is not scary, but offers you a variety of possibilities to increase your productivity. The Contao
Manager is the graphical interface for our command line. However, only a fraction of all the commands Contao provides
are implemented in the Manager.

Many commands are relatively self-explanatory. For example `contao:user:create` which lets you create a back end user.
Just call it and follow the instructions.

You can get a list of all available commands like so:

```bash
vendor/bin/contao-console list
```

You can also display the help text for each command. For `contao:user:create` that would look like this:

```bash
vendor/bin/contao-console contao:user:create --help
```

Some commands require more detailed explanations. These are covered in this chapter accordingly:

{{% children %}}