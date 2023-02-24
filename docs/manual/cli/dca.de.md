---
title: "debug:dca"
description: "Zeige den finalen Stand der Konfiguration eines spezifischen Data Container Arrays"
aliases:
    - /de/cli/dca/
---

{{< version "4.8" >}}

Contao nutzt das Konzept von »[Data Container Arrays][DCA]«. Die Konfiguration jedes Data Containers kann innerhalb
deiner Contao Applikation, als auch von beliebigen Erweiterungen angepasst werden. Während der Entwicklung einer Website
kann es daher nützlich sein den finalen Stand eines DCAs zu analysieren - also nachdem alle Anpassungen zusammen geführt
wurden.

Dieses Kommando nimmat als Argument den Namen eines Data Containers, also bspw. `tl_page`, und gibt die finale
Konfiguration dieses DCAs dann auf der Konsole aus.

```bash
php vendor/bin/contao-console debug:dca tl_page
```

[DCA]: https://docs.contao.org/dev/framework/dca/
