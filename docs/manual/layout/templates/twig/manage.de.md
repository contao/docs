---
title: "Templates verwalten"
description: "Die Verwaltung der Template-Dateien."
url: "layout/templates/twig/verwaltung"
aliases:
    - /de/layout/templates/twig/verwaltung/
weight: 20
---

## Ordnerstruktur

Du kannst Templates im  `/templates` Ordner ablegen. 

{{< version-tag "4.13" >}} Diese können im Backend, etwa bei der Konfiguration eines Inhaltselements, ausgewählt werden.

* Templates, die dabei direkt im **Hauptverzeichnis** liegen, werden als `global` gekennzeichnet.
* Im [Theme-Manager](../../theme-manager/themes-verwalten) kannst du ein vorhandenes **Unterverzeichnis** mit einem
  Theme verknüpfen. Template-Dateien aus diesem Ordner werden bei der Auswahl dann mit dem jeweiligen `Theme-Namen`
  gekennzeichnet.

{{% notice note %}}
Es kann derzeit entweder **eine** Twig- **oder** eine PHP-Variante des gleichen Templates am gleichen Ort geben.
{{% /notice %}}


## Dateinamen

Die Template-Dateien werden zur Erkennung mit einem Präfix versehen. Beispielsweise deutet `ce_` auf ein
Inhaltselement (**c**ontent **e**lement) hin. 

Möchte man z.&nbsp;B. die Ausgabe des Inhaltselements vom Typ »Text« ändern, kann man das Template `ce_text.html.twig` 
hierzu verwenden. In diesem Fall haben die Template-Änderungen Auswirkung auf alle Inhaltselemente vom Typ »Text«. 

{{< version-tag "4.13" >}} Dies ist nicht immer erwünscht. Zur gezielten Nutzung kann man das Template individuell bezeichnen. Hierbei muss die 
jeweils vorgegebene Template-Bezeichnung beibehalten und lediglich erweitert werden: also z.&nbsp;B. `ce_text.html.twig` 
umbenennen nach `ce_text_individuell.html.twig`. Dieses Template kann dann gezielt zur Ausgabe für ein (o. mehrere) Inhaltselement(e) 
vom Typ »Text« genutzt werden.