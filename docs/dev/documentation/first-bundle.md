---
title: Your first bundle
weight: 2
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
Composer packages on packagist.org. It's especially useful for the package index of the Contao Manager where it makes
no sense to show any other packages to the end users.






[1]: https://symfony.com/doc/current/bundles.html
