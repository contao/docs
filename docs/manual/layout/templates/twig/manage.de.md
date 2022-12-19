---
title: "Templates verwalten"
description: "Die Verwaltung der Template-Dateien."
url: "layout/templates/twig/verwaltung"
aliases:
    - /de/layout/templates/twig/verwaltung/
weight: 20
---

## Ordnerstruktur

Twig-Templates werden innerhalb von `/templates` in einer speziellen Ordnerstruktur abgelegt. 
Der jeweilige Unterordner muss dem Unterordner des Original-Templates entsprechen. Contao unterstützt euch dabei.
Wollt ihr eines der neuen Twig-Templates anpassen, dann wird das Template automatisch im richtigen Unterordner angelegt.

### Beispiel
Du möchtest das Template für das Textelement anpassen. Dazu wählst Du aus den Original-Templates das Template 
`text [content_element/text.html.twig]` aus. Das Template wird Dir automatisch im Ordner `/template/content_element` angelegt.


{{% notice info %}}
In Contao 4 (ab Contao 4.12) müssen Twig-Templates selbst geschrieben und direkt im Ordner `/templates` abgelegt werden.
Mit Twig-Templates in Contao 4, können PHP-Templates überschrieben oder erweitert werden.
{{% /notice %}}

{{% notice note %}}
Eventuell steht noch nicht für jedes Modul/Inhaltselement ein Twig-Template zur Verfügung. In diesen Fällen werden weiterhin die 
bisherigen (PHP/Legacy) Templates herangezogen.
{{% /notice %}}
