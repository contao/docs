---
title: "Initial Setup"
description: "Setting up Contao for your custom web application."
weight: 1
---


An important thing to note right from the start is that Contao can be used as a 
standalone __Symfony Bundle__ in your existing Symfony application. So if you need
to expand your Symfony web application with the functionalities of a Content Management
System, head over to the [Symfony Application][1] article to learn more about that.

Otherwise, when installing Contao from scratch, e.g. via

```bash
composer create-project contao/managed-edition
```

or via the Contao Manager, it will still be a Symfony application -- the [Contao Managed Edition][2]. 
Within that setup you are still able to use the Symfony Framework and its Bundles 
to their full extent, while also having the possibility to auto-load and configure 
bundles for example (e.g. for Contao Extensions). Head over to the linked article 
to learn more about the Managed Edition.

To install a specific version of the Contao Managed Edition in the current directory (`.`), run the
command as follows (e.g. for `4.9`):


```bash
composer create-project contao/managed-edition . 4.9
```

[1]: symfony-application
[2]: managed-edition
