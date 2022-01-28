---
title: "Contao Coding Standards"
menuTitle: "Coding Standards"
description: "Coding Standards that Contao follows."

aliases:
  - /guides/coding-standards
  - /guides/coding-standard
---

Since Contao is based on Symfony, we follow the [Symfony Coding Standards][1] very closely. If you are maintaining a
public bundle, we recommend you do the same, so other Contao or Symfony developers feel familiar with your code.

## Exception

There is one case that we handle differently from the Symfony coding standards in Contao:

> A service name must be the same as the fully qualified class name (FQCN) of its class

Please note that this does not apply if you are maintaining a reusable bundle. Symfony explicitly points this out in
their [best practices for reusable bundles][3]:

> If the bundle defines services, they must be prefixed with the bundle alias instead of using fully qualified class
> names like you do in your project services.

However, we consider controllers to be "project services" in Contao, therefore you are allowed to use their FQCNs as
names. You will most likely have to do so anyway to make them work correctly.

## contao/easy-coding-standard

To make it easier for you to ensure that your contributed code matches the expected code syntax, we have created the
[`contao/easy-coding-standard`][4] package. It is a combination of sniffs and fixers that will automatically do most
of the adjustments for you.

If you submit a pull request for Contao, our CI chain will run these checks as well.

[1]: https://symfony.com/doc/current/contributing/code/standards.html
[2]: https://blog.blackfire.io/php-7-performance-improvements-encapsed-strings-optimization.html
[3]: https://symfony.com/doc/current/bundles/best_practices.html#services
[4]: https://github.com/contao/easy-coding-standard
