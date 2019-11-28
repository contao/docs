---
title: "BC Promise"
description: "Our backwards compatibility promise."
---

Everyone involved in the development of Contao knows about the importance of stable software and thus stable APIs.
We try our very best to ensure that Contao updates are as smooth as they can be.

Being a project that is built on top of the Symfony full-stack framework, we generally make the same
[Backwards Compatibility Promise][SF_BC_Promise] as Symfony itself.
We also follow the principles of [Semantic Versioning][Semver], which means that breaking changes must only be
expected when switching to a new major version.

However, in contrast to Symfony, Contao is not "just" a framework. We do not only build the tools for other
developers but we also build tools ourselves, which are then shipped with the core distribution of Contao.
Therefore, our BC promise deviates from the Symfony BC promise in some regards:

* Our BC promise does not cover classes and methods marked as `@internal`. In most cases this concerns constructors
  of services Contao provides. If you want to change the behaviour of a service, do not replace it with your own
  instance of the class but instead decorate the original service (see the tip about "Composition over Inheritance").

* Our BC promise does not cover templates. Templates are subject to change very often and you have to compare
  them with every update of Contao. Generally, we try to only ever apply template changes in major and minor
  versions but if a bugfix requires us to change a template, then we might do that as well.
  
* Our BC promise does not cover translation keys. Translations may be added and removed in every minor version as
  they change quite often. If you want to reuse the labels provided by the core, double check them after
  every update. You may also provide your own labels so you are not affected by any changes in the core.
  
* Because Contao is a Symfony bundle like every other bundle, our BC promise does not cover anything that is about 
  integrating Contao into the Symfony application. This includes:
  
  * Commands
  * Data collectors
  * Dependency injection compiler passes
  * Event listeners

* Our BC promise also does not cover the `ContaoManager/Plugin` class, which is required to integrate a bundle into
  the [Contao Managed Edition][Contao_ME].

{{% notice tip %}}

**Composition over Inheritance**<br>
The general rule of thumb is that we try to break as little as possible and as much as required. To make sure you
are affected as little as possible, you might also benefit from best practices in software engineering such as
preferring [Composition over Inheritance](https://en.wikipedia.org/wiki/Composition_over_inheritance).

{{% /notice %}}

If you should encounter a problematic break, please open an issue in our [monorepository on GitHub][Monorepo_Issues]
so we can analyze and discuss if there is a possible solution.

[SF_BC_Promise]: https://symfony.com/doc/current/contributing/code/bc.html
[Semver]: https://semver.org/
[Monorepo_Issues]: https://github.com/contao/contao/issues
[Contao_ME]: ../getting-started/initial-setup/managed-edition
