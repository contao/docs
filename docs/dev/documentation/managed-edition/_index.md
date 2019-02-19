---
title: "Managed Edition"
weight: 1
---

Contao is available as a so-called `Managed Edition`. Compared to a regular Symfony application, a Managed Edition
is limited in its customization possibilities to allow automatic configuration by third-party bundles.
If you are familiar with Symfony Flex you might find some similarities but the Managed Edition was actually a thing
before Symfony Flex even existed!

## The Manager Plugin and the Manager Bundle

The heart of the `Managed Edition` consists of two main components:

* [The Manager Bundle (contao/manager-bundle)](https://github.com/contao/manager-bundle)
* [The Manager Plugin (contao/manager-plugin)](https://github.com/contao/manager-plugin)

The `Manager Bundle` contains the full application skeleton such as entry points, config files etc. thus giving us full
control on how the application is built during an update. Hence, if you want to install e.g. Contao 4.7, you would require
`contao/manager-bundle` in `4.7.*`.

{{% notice info %}}
To start a new project, don't just require the `contao/manager-bundle` because you'll also need the `post-install` and
`post-update` Composer scripts to be in place. Just run `composer create-project contao/managed-edition [<directory>] [<version>]` instead.
{{% /notice %}}

The `Manager Plugin` on the other hand is a `Composer plugin` which hooks into Composer to automate tasks on every `composer install` or
`composer update` (see how similar it works to Symfony Flex?). It provides all the interfaces aka the API for other bundles
to configure the Managed Edition.
