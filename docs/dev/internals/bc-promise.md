---
title: "BC Promise"
description: "Our backwards compatibility promise."
---

Everyone involved in the development of Contao knows about the importance of stable software and thus stable APIs.
We try our very best to make sure Contao updates are as smooth as they can be.

Being a project that sits on top of the Symfony full-stack framework we generally [follow the same rules as
Symfony itself][SF_BC_Promise].
We also follow the principles of [Semantic Versioning][Semver], which means that breaking changes must only be expected
when switching to a new major version.

However, in contrast to Symfony itself, Contao is not "just" a framework. We do not only build the tools for other
developers but we also build tools ourselves, which are then shipped with the core distribution of Contao.
That being said, there are a few deviations from the Symfony BC Promise compared to our promise:

* Our BC promise does not cover any template changes. Templates are subject to change very often and you have to compare
  them with every update of Contao. Generally speaking, we try to only ever apply template changes in major and minor
  versions but if a bugfix requires us to change a template then we might do that as well.
  
* We do not cover translation keys. Translations may be added and removed in every minor version as they change quite
  often. If you want to reuse the ones provided by the core, double check them after every update. You may also provide
  your own ones so you are not affected of any changes in the core.
  
* Because Contao is a Symfony bundle like every other bundle, everything that is about integrating Contao into a Symfony
  application might be subject to change. So expect breaking changes for the following aspects of Contao:
  
  * Event Listeners
  * Dependency Injection Compiler Passes
  * Commands
  

The general rule of thumb is that we try to break as little as possible and as much as required. To make sure you're
affected as little as possible, you may also benefit from best practices in software engineering such as [preferring
Composition over Inheritance][Composition_over_Inheritance].

If you encounter any problematic break, please feel free to
[open an issue in our monorepository project on GitHub][Monorepo_Issues] so we can analyze and discuss if there's a
possible solution and extend or fix the document at hand.

[SF_BC_Promise]: https://symfony.com/doc/current/contributing/code/bc.html
[Semver]: https://semver.org/
[Composition_over_Inheritance]: https://en.wikipedia.org/wiki/Composition_over_inheritance
[Monorepo_Issues]: https://github.com/contao/contao/issues
