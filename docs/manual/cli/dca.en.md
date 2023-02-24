---
title: "debug:dca"
description: "Show the final configuration of a specific Data Container Array"
aliases:
    - /en/cli/dca/
---

{{< version "4.8" >}}

Contao uses the concept of [Data Container Arrays][DCA]. The configuration of each data container can be adjusted and
extended by yourself within your Contao application as well as by extensions. During development of a website it might
be helpful to analyze the final state of a DCA - after all the adjustments have been merged together.

This command takes the name of a data container, e.g. `tl_page`, and outputs its final configuration to the console.

```bash
php vendor/bin/contao-console debug:dca tl_page
```

[DCA]: https://docs.contao.org/dev/framework/dca/
