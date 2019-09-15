---
title: "Profiler"
description: Symfony's profiler in Contao.
---

Contao ships with the `symfony/profile-pack` package that includes a Web Developer
Toolbar and the Profiler view to use as a powerful development tool.

More information about the general Symfony Profiler can be found in the [Symfony Documentation][1].

However, Contao provides a custom data collector that collects and processes
specific data from Contao requests, and presents them in the profiler.
Furthermore there is also a Web Developer Toolbar extension that looks like this.

![](../images/profiler.png?classes=shadow)

The data collectors, profiler and web developer toolbar are usually only enabled
in `dev` mode. As soon as the mode is changed to `prod`, those features are disabled
for performance and security reasons.

[1]: https://symfony.com/doc/current/profiler.html
