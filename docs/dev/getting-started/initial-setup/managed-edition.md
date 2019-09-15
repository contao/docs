---
title: "The Contao Managed Edition"
menuTitle: "Managed Edition"
description: "A pre-configured Symfony application that allows automatic configuration by third-party bundles."
weight: 1
---

Contao is available as a so-called `Managed Edition`. Compared to a regular Symfony 
application, a Managed Edition allows automatic configuration by third-party bundles.
If you are familiar with Symfony Flex you might find some similarities but the 
Managed Edition was actually a thing before Symfony Flex even existed!

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

The core of the `Manager Bundle` is the special application kernel. Instead of loading e.g. bundles and routes from a
from the app specific folders it asks all the installed Composer packages (or in other words, the other Contao bundles)
for that information. It does so using the interfaces the `Manager Plugin` provides making your application fully
autoconfigurable. 

The `Manager Plugin` is a `Composer plugin` which hooks into Composer to automate tasks on every `composer install` or
`composer update` (see how similar it works to Symfony Flex?). As mentioned in the section above, it also provides all
the interfaces aka the API for other bundles to configure the `Managed Edition`.

Maybe an illustration helps you to understand how the pieces are put together:

{{<mermaid align="left">}}
graph LR;
    A[Managed Edition]-- requires -->B[contao/manager-bundle]
    A-- requires -->C[contao/news-bundle]
    A-- requires -->D[acme/another-bundle]
    B-- requires -->F("Everything needed to run a completely managed Contao.<br><br>contao/core-bundle<br>doctrine/dbal<br>symfony/framework-bundle<br>etc.")
    B-- requires -->E[contao/manager-plugin]
    C-- requires -->E
    D-- requires -->E
    E-- manages -->A
    style B fill:#fcc
    style E fill:#ffc
{{< /mermaid >}}

The key of a `Managed Edition` are the following lines in your `composer.json` which you'll get automatically when you
run `composer create-project contao/managed-edition`:

```json
{
    "scripts": {
        "post-install-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ],
        "post-update-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ]
    }
}
```

So after every `composer update` or `composer install`, the `ScriptHandler` of the `Managed Edition` is called so it is
able to initialize the application.
Here are examples of what the `ScriptHandler` does to give you an idea about its responsibilities:

* Creating the whole application structure. Folders such as the `app` and the `web` folders with the entry points.
* It purges and rebuilds the cache
* It creates symlinks

## Do I need the Managed Edition?

It depends. If you have an existing Symfony full stack application and you want 
to install Contao to provide additional CMS functionality, probably not. You have 
full control about your application kernel and the configuration but it also means 
you have to adjust the settings for every Contao update (or any other Contao bundle 
update for that matter). If, however, you are planning to make Contao the most important 
part of your application (meaning most of what you're going to do is content management) 
you're likely better of using the `Managed Edition`. Updates are easier because 
your application auto-configures itself via the `Manager Plugin`s of all the installed 
bundles. You can still control all of it  through a global, application-wide `Manager Plugin` 
that is loaded at the very end but it maybe requires a bit more code.

To learn more about the `Manager Plugin` visit [its dedicated article](manager-plugin). 


## Application Structure Differences

Development of Contao 4 and its Contao Managed Edition was started before Symfony
4 was released. Since then the best practises and defaults of Symfony have changed
slightly. If you are familiar with the default Symfony 4 application structure as
used by the Symfony Skeleton for example, then it might help to know some of these
differences.

* Automatically loaded configuration files use the file extension `.yml` instead 
  of `.yaml`.<sup>1</sup>
* The automatically loaded file containing the routes definition is called `routing.yml`
  rather than `routing.yaml`.<sup>1</sup>
* The public entry point is called `web/` instead of `public/`.

<sup>1</sup> See [here][1] for a list of configuration files, that are automatically 
loaded.


[1]: /getting-started/starting-development/#application-configuration
