---
title: "Templates verwalten"
description: "Die Verwaltung der Template-Dateien."
url: "layout/templates/verwaltung"
aliases:
    - /de/layout/templates/verwaltung/
weight: 10
---

## Ordnerstruktur

Ein Template kann im Hauptverzeichnis abgelegt werden. Das entsprechende Template wird dann z. B. 
in einem Inhaltselement zur Auswahl angeboten und als `global` gekennzeichnet.

Im [Theme-Manager](../../theme-manager/themes-verwalten) kannst du einen vorhandenen Template-Ordner mit dem Theme 
verknüpfen. Die Template-Dateien in diesem Ordner werden bei der Auswahl dann mit dem jeweiligen `Theme-Namen` gekennzeichnet.

{{% notice note %}}
Template-Dateien in weiteren Unterodnern werden bei der Auswahl nicht berücksichtigt.
{{% /notice %}}


## Dateinamen

Die Template-Dateien werden zur Erkennung mit einem Präfix versehen. Beispielsweise deutet `ce_` auf ein
Inhaltselement (**c**ontent **e**lement) hin. Möchte man z. B. die Ausgabe des Inhaltselement vom Typ »Text« ändern kann man das Template `ce_text.html5` hierzu verwenden. 

In diesem Fall haben die Template Änderungen Auswirkung auf alle Inhaltselemente vom Typ »Text«. Dies ist nicht immer
erwünscht. Zur gezielten Nutzung kann man das Template individuell bezeichnen. Hierbei muss die jeweils vorgegebene
Template Bezeichnung beibehalten und lediglich erweitert werden. Also z. B. `ce_text.html5` 
umbenennen nach  `ce_text_individuell.html5`.

Dieses Template kann dann gezielt zur Ausgabe für ein (o. mehrere) Inhaltselement(e) vom Typ »Text« genutzt werden.
