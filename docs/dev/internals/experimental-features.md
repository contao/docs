---
title: "Experimental Features"
description: "Experimental features allow us to gather real-world usage."
---

Almost everything in Contao benefits from our [Backward Compatibility Promise](/internals/bc-promise). It ensures developers
know on what parts of Contao they can rely on and makes it easier to update to later versions.

However, sometimes making a promise on an API is hard. Especially when we plan to introduce a huge new feature. Even though
it will get peer-reviewed by the Core Developers team, gathering real-world usage examples and feedback is oftentimes
invaluable. 

Experimental APIs are marked with an `@experimental` annotation and are not covered by our Backward Compatibility Promise
so that we can incorporate the feedback we receive until we think it's mature enough. By that time, the `@experimental`
annotation will be removed and the feature is now considered "stable".

The following features are currently in their `@experimental` phase:

* The Twig integration (`Contao\CoreBundle\Twig\*`), since Contao 4.12
* The virtual filesystem (`Contao\CoreBundle\Filesystem\*`), since Contao 4.13

{{% notice tip %}}
If a feature is experimental, it does not mean you shouldn't be using it. Please, by all means **do use it**! Otherwise, how are
we supposed to gather real-world feedback? The Contao core itself uses them, too. The only difference to a stable API is that
you may watch the development in the Contao core a bit more closely and be ready to adjust your code in a more timely
manner.
{{% /notice %}}

