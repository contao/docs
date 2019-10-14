---
title: Your First Extension
description: How to set up a Contao extension.
aliases:
  - /guides/first-bundle/
---


As Contao itself is just a Symfony bundle that's loaded to your Symfony application or Contao Managed Edition, writing
your own bundle is very similar to writing a regular Symfony bundle. It's thus very important you read the [respective
Symfony documentation][1] first.

Copying the excellent documentation of Symfony itself into the Contao documentation doesn't make much sense thus you'll
learn about the differences between a Symfony bundle and a Contao bundle.

The first and most obvious difference between a Symfony and a Contao bundle is its `type` in the `composer.json`:

```diff
-"type": "symfony-bundle",
+"type": "contao-bundle",
```

The one and only reason as of today is the simple fact that it allows us to distinguish Contao bundles from other
Composer packages on packagist.org. It's especially useful for the package index of the `Contao Manager` where it makes
no sense to show any other packages to the end users.


## Structure

We recommend you stick to the structure recommended by [Symfony in their docs][2]. One thing that will differ are the
Contao specific resources that will go under `Resources/contao`.
Contao specific resources in general are the following folders:

* `config`
* `dca`
* `languages`
* `templates`

Although you might not need `config` and `languages` because most of what used to be configured in `config/config.php`
has moved to the Symfony Container instead and you may also write your language files using the Symfony Translator.

Also make sure you check out the [Contao Skeleton Bundle][3] which may help you to get your foundation right.


## Integration of the Manager Plugin

If you want to provide integration with the _Contao Managed Edition_ make sure you checkout the documentation on the
[Contao Manager Plugin][4].


[1]: https://symfony.com/doc/current/bundles.html
[2]: https://symfony.com/doc/current/bundles.html#bundle-directory-structure
[3]: https://github.com/contao/skeleton-bundle
[4]: /framework/manager-plugin/
