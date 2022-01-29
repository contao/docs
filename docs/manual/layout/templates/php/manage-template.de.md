---
title: "Templates verwalten"
description: "Die Verwaltung der Template-Dateien."
url: "layout/templates/php/verwaltung"
aliases:
    - /de/layout/templates/php/verwaltung/
weight: 20
---

## Ordnerstruktur

Du kannst Templates im  `/templates` Ordner ablegen, damit diese im Backend, etwa bei der Konfiguration eines 
Inhaltselements, zur Auswahl angeboten werden.

* Templates, die dabei direkt im **Hauptverzeichnis** liegen, werden als `global` gekennzeichnet.
* Im [Theme-Manager](../../theme-manager/themes-verwalten) kannst du ein vorhandenes **Unterverzeichnis** mit einem
  Theme verknüpfen. Template-Dateien aus diesem Ordner werden bei der Auswahl dann mit dem jeweiligen `Theme-Namen`
  gekennzeichnet.

{{% notice note %}}
Template-Dateien in weiteren (unverknüpften) Unterordnern werden bei der Auswahl nicht berücksichtigt.
{{% /notice %}}


## Dateinamen

Die Template-Dateien werden zur Erkennung mit einem Präfix versehen. Beispielsweise deutet `ce_` auf ein
Inhaltselement (**c**ontent **e**lement) hin. Möchte man z.&nbsp;B. die Ausgabe des Inhaltselements vom Typ »Text«
ändern, kann man das Template `ce_text.html5` hierzu verwenden. 

In diesem Fall haben die Template-Änderungen Auswirkung auf alle Inhaltselemente vom Typ »Text«. Dies ist nicht immer
erwünscht. Zur gezielten Nutzung kann man das Template individuell bezeichnen. Hierbei muss die jeweils vorgegebene
Template-Bezeichnung beibehalten und lediglich erweitert werden: also z.&nbsp;B. `ce_text.html5` 
umbenennen nach `ce_text_individuell.html5`. Dieses Template kann dann gezielt zur Ausgabe für ein (o. mehrere)
Inhaltselement(e) vom Typ »Text« genutzt werden.
