---
title: "Creating an Extension"
description: "How to create a re-usable extension for Contao."
weight: 900
aliases:
    - /getting-started/extension/
---


Like many other CMS, Contao's functionality can easily be extended by installing
extensions from third parties. This article will explain the basics on how to create
an extension of your own - for others to use or just yourself.

As Contao itself is just a Symfony bundle that's loaded to your Symfony application 
or Contao Managed Edition, writing your own bundle is very similar to writing a 
regular Symfony bundle. To learn more about bundles in general, you can read the 
[respective Symfony documentation][1] first.

{{% notice note %}}
Within this documentation, the terms _package_, _bundle_ and _extension_ is often
used interchangably. For Composer, everything is a _package_, while a `symfony-bundle`
or a `contao-bundle` is a specific type of package. _Contao bundles_ are referred 
to as _extensions_ within the Contao universe.
{{% /notice %}}


* Create folder for your extension.
* Initialize `composer.json` with desired package name, requirements and autoloading.
* Include as repository in root `composer.json` of Contao.
* Develop within `src/` of your extension.

Show differences between app and extension development.

* Initialize git and push to remote repository.
* Add repository to Packagist.
* Remove local repository from root `composer.json`.



[1]: https://symfony.com/doc/current/bundles.html
