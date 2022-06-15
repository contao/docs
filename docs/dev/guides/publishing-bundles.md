---
title: "Publishing Bundles"
description: "How to publish a bundle to be installed in Contao."
aliases:
  - /guides/publishing-bundles/
---


Publishing a Contao bundle is very similar to any other Composer package
or Symfony bundle. There are [plenty][1] [of][2] [good][3] [resources][4] available 
on the Internet on how to distribute your code. It all boils down to one thing:
packages are installed using Composer. Your package must be available to Composer,
and Composer must be able to resolve your dependencies. 


## Optimizing a Composer package for Contao

If you are not familiar with how Composer works or how to create a `composer.json`
for your project, please [read the Composer manual][Composer] first.
Once your project is a Composer package, there are additional steps necessary
to integrate into the Contao ecosystem.


### Different `type` of Composer packages

Setting the `type` in your `composer.json` will give tools a hint on what
your package contains.

 1. Choose `library` if your package does not integrate with Symfony or 
    Contao directly, e.g. if it provides an abstraction for a common task.
    You should also choose this type if your package is Contao-specific, but
    is not providing user features but helpers/services/classes that are only
    useful to other developers. Feel free to use `contao-library` if you feel
    like readers should see what your package is made for.
    
 2. Using `contao-bundle` will allow Contao users to discover your package.
    Learn more about integration into the Contao ecosystem below.

 3. You can also use `symfony-bundle` if your package contains a bundle class and couples
    to the Symfony framework, but not specificly to Contao. Symfony bundles are useful
    because they can be used by any Symfony application, and another Contao bundle can
    integrate their functionality into the CMS. 

 4. The `contao-module` type was necessary to integrate a Contao 3 extension into
    Composer and Contao 4. Using it is not recommended anymore, as Contao 3 has reached
    its end of life. Refer to the [CCA Plugin Documentation][CCA] for integration details.    


### Adding a `contao-manager-plugin`

The _Contao Managed Edition_ is a self-configuring implementation of a Symfony app,
which is designed to ease installation and configuration of Symfony for
Contao-specific use cases. Optimizing your package for the Managed Edition
is totally optional, but highly recommended if you want the package to
be available for most Contao users. To integrate with the Contao
Managed Edition, you have to add a [Contao Manager Plugin][Plugin] to your package. 

If you do **not** add a _Contao Manager Plugin_ to your extension, it will still 
work with Contao, but:

 - it will require a user to manually register the bundle class in Symfony.
 - therefore, your extension will **not** be listed on [extensions.contao.org][extensions] nor in the
   Contao Manager.


## Publishing to the Contao ecosystem

Your extension is now technically compatible with Contao but you also want Contao users
to be able to discover it. In most cases, this means making the
package discoverable in the Contao Manager search. A public version of this search index
is available on [extensions.contao.org][extensions].

Your extension will be [automatically picked up](https://github.com/contao/package-metadata/actions) in our search index
once

* your package is published to [packagist.org](https://packagist.org)
* your package is of type `contao-bundle`
* your package does have at least one version tag (packages with only branches and no tags are ignored)
* your package references a [Contao Manager Plugin][Plugin] in the `extra` section of your `composer.json`.

To extend the description, add multilingual translations, a logo etc., you have to add
your package to the `contao/package-metadata` repository. Read and follow
[the metadata documentation][metadata] on how to do that.

If your extension is **not** available on [packagist.org](https://packagist.org)
or not of `"type": "contao-bundle"`, you can still add it to the
`contao/package-metadata` repository. It will then show up in the search results 
with a link to your homepage, where you can provide custom installation instructions, information
regarding pricing or licensing and more.

{{% notice info %}}
Note that certain information on packagist.org is cached up to 12 hours. If you think your extension
fulfills all the requirements listed above, you might have to wait for the next day for the search index
to pick it up!
{{% /notice %}}


## Private and commercial packages

If users need to pay for your package or you created it just for a single
client, you might not want to publish it on [packagist.org](https://packagist.org).
There are still various ways to install it with Composer, for example 
by using what [Private Packagist](https://packagist.com) has to offer.
Unfortunately, bypassing [packagist.org](https://packagist.org) means
users will have to manually adjust their `composer.json` to add repositories
and requirements, which is cumbersome and error-prone for non-developers.

Composer has always allowed to install packages from ZIP archives, which
are called _Artifacts_. Using this feature, the Contao Manager allows
users to upload ZIP archives and install packages without the need
for manually adjusting the `composer.json`. We are distinguishing between
two types of _artifacts_ in the Contao Manager.

 1. a _regular_ artifact is any Composer package packed into a ZIP archive.
 2. a `contao-provider` is a special type of artifact, which adds private 
    repositories to require additional packages into a Contao installation.


### Creating an Artifact Package

Creating an artifact package for the Contao Manager is no different from
a regular Composer artifact. It's a ZIP archive of all package 
files, including a `composer.json` in the root of the ZIP archive.<br>
There is one significant additional requirement: You **must** 
add [a `version` property][version] to your `composer.json`. Because Composer 
is unable to extract version information (e.g. by reading tags from your GIT repository),
this info has to be provided manually.

That's it. Create a ZIP archive of your package and upload it to the Contao Manager
by drag & drop or the upload button. Whenever the package needs to be updated,
a new ZIP archive with a new `version` property has to be uploaded to the
Contao Manager.

{{% notice info %}}
On most operating systems the ZIP archive must be created by selecting all package
files individually, not by creating an archive of the parent folder of your package!
{{% /notice %}}

{{% notice tip %}}
Don't forget that your artifact package can still have a `require` section
in the `composer.json`, as can any other Composer package. You can require
any package from [packagist.org](https://packagist.org) or even another
artifact (that can be uploaded simultaneously).
{{% /notice %}}


### Adding packages from private repositories

If your private package changes regularly, it might be cumbersome for users
to upload a ZIP file for each and every new version. External repositories 
like [Private Packagist](https://packagist.com) or a version control system (VCS) 
are the key feature to this in Composer. Unfortunately, Composer does only
read [the `repositories` configuration][repositories] from the root `composer.json`, but not
from the `composer.json` of any installed package. 

To solve this issue for Contao, we came up with a special package of `"type": "contao-provider"`.
When creating an artifact package of this type, you can add repository information 
to the `composer.json`, which will then be included when loading dependencies. 
Be aware that you can **only** use repositories, you cannot add an `auth.json` 
or a `config` section with authentication details. If your repository requires
authentication, it must be included in the repository URL.

{{% notice info %}}
Unfortunately, [GitHub](https://github.com) does not support repository-based authentication.
Known options are [Private Packagist](https://packagist.com) or [GitLab](https://gitlab.com).
{{% /notice %}}

{{% notice tip %}}
A `contao-provider` package is still a regular artifact, which can contain any
number of files. A good example would be an artifact that contains a license key
for a software, and also installs the software via `require` and `repositories`
definitions. 
The software can then check the provider's vendor folder automatically
for a valid license file.
{{% /notice %}}


### Behind the scenes

Most of what is described here applies to the Contao Managed Edition
and the use of the Contao Manager. The whole Contao ecosystem is built in 
layers to hide technical details from non-developers.

1. The Contao CMS features can be used in any Symfony application, but this means
   you need to be familiar with how to configure Symfony.
   
2. If you do not want to take care of configuring Symfony, you can use the
   Contao Managed Edition. It will automatically configure the application
   and third-party bundles, but you're always free to adjust any configuration values
   they provide.
   
3. The `contao/manager-plugin`, an essential part of the Contao Managed Edition,
   is also responsible for the Composer integration. It will automatically incorporate
   artifacts and `contao-provider` packages into the Composer dependency resolving
   process.
   
4. The Contao Manager is the cherry on the cake. It will use the available tools
   to manage your installation, but any other tool could use the same tools.
   
    - The Contao Manager uses the Composer command line binary (packaged into the
      Contao Manager) to install new packages.
    - It will use the Contao/Symfony Console to control the Symfony application
      (for things like `cache:clear`). 



[1]: https://symfonycasts.com/screencast/symfony-bundle/packagist
[2]: https://genieblog.ch/how-to-create-a-third-party-symfony-bundle/
[3]: https://ourcodeworld.com/articles/read/342/how-to-create-with-github-your-first-psr-4-composer-packagist-package-and-publish-it-in-packagist 
[4]: https://symfonycasts.com/screencast/symfony-bundle
[Composer]: https://getcomposer.org/doc/02-libraries.md
[repo]: https://getcomposer.org/doc/05-repositories.md
[extensions]: https://extensions.contao.org
[CCA]: https://github.com/contao-community-alliance/composer-plugin/blob/master/README.md
[Plugin]: /framework/managed-edition/manager-plugin/
[metadata]: https://github.com/contao/package-metadata/blob/master/docs/en/README.md
[version]: https://getcomposer.org/doc/04-schema.md#version
[repositories]: https://getcomposer.org/doc/04-schema.md#repositories
