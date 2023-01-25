---
title: "Templates"
description: Contao's template engine.
aliases:

- /framework/templates/

---

{{% notice note %}}
This section covers Twig templates in Contao **4.13** and up. The documentation for legacy PHP templates (`.html5`
extension) can be found in [this article](legacy).
{{% /notice %}}


## History and development

Contao's template system builds on the [Twig][Twig Docs Root] template engine. Historically, PHP templates were used and
are now transitioned away from — this is why you can still find a lot of their remains in the current codebase. Native
Twig support made its way into the core in Contao 4.12 and allowed users to substitute existing templates with Twig
templates. Beginning with Contao 5, the majority of content elements were rewritten and are now Twig-only. Extrapolating
from here, we ultimately plan to drop support for the PHP templating system in Contao 6. 

{{% notice info %}}
It's hard to get things right in the first try and replacing the old template system with Twig is a big undertaking.
That's why some classes in the `Contao\Twig` namespace are still marked with `@experimental`. First up, this neither
means, that we will remove the functionality or randomly change things up, nor that you should not use them (in
contrary!). It allows us to tweak things and make changes to the classes' API in a minor/bugfix release — for example if
a real world use case shows an issue that we did not think about. Should you need to use these classes directly, keep in
mind that, even though chances for changes are getting lower and lower, these classes are **not covered** by our BC
promise.  
{{% /notice %}}


## Contao Twig Handbook

All right! Get yourself a big coffee and start your deep-dive into the Contao-Twig ecosystem here:
 1. [Getting started](getting-started) <span style="color:gray">— A quick Twig 101</span>
 2. [Architecture](architecture) <span style="color:gray">— About the inner workings and how things are set up</span>
 3. [Creating templates](creating-templates) <span style="color:gray">— How to use the various template features</span>
 4. [Debugging](debugging) <span style="color:gray">— Problem-solving and developer experience</span>

{{% notice tip %}}
If you already got some understanding of the system and want to get started quickly, please have a look at our
[quick reference handbook](quick-reference), where we are collecting examples to cater for the most typical scenarios.     
{{% /notice %}}


[Twig Docs Root]: https://twig.symfony.com/
