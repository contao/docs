---
title: "Templates verwalten"
description: "Die Verwaltung der Template-Dateien."
url: "layout/templates/twig/verwaltung"
aliases:
    - /de/layout/templates/twig/verwaltung/
weight: 30
---

## Ordnerstruktur

Twig-Templates werden innerhalb von `/templates` in einer speziellen Ordnerstruktur abgelegt.
Bei der Auswahl des Templates ist die Struktur in eckigen Klammern hinter dem Template-Namen angegeben. Der Unterordner
`content_element` ist zum Beispiel für Inhaltselemente vorgesehen.
Contao unterstützt Dich bei der Strukturierung der Templates. Willst Du eines der neuen Twig-Templates anpassen, dann
wird das Template automatisch im richtigen Unterordner angelegt.

### Beispiel

Du möchtest das Template für das Textelement anpassen. Dazu wählst Du aus den Original-Templates das Template
`text [content_element/text.html.twig]` aus. Das Template wird Dir automatisch im Ordner `/template/content_element`
angelegt.

Diese Template-Änderungen gelten für alle Elemente des jeweiligen Typs. Nicht immer ist das erwünscht. Möchte man
Template-Änderungen gezielt nur für bestimmte Elemente bereitstellen, werden verschiedene Varianten des Templates
benötigt, die dann im Backend des entsprechenden Elementes ausgewählt werden können.

### mehrere Varianten eines Templates

Willst Du mehrere Varianten eines Twig-Templates zur Verfügung stellen, dann müssen die Templates für die Varianten
in einem Unterordner der neuen Struktur abgelegt werden, der dem Namen des anzupassenden Templates entspricht. Der Name
des Varianten-Templates ist vollkommen frei wählbar.

#### Beispiel

Du möchtest mehrere Varianten des Textelements bereitstellen.
Dazu legst Du innerhalb von `/templates/content_element` einen Ordner `text` an. Innerhalb des neuen Ordners
`/templates/content_element/text` kannst Du jetzt ein oder mehrere Varianten des Templates für das Inhaltselement Text
anlegen, z.B. `individuelles_textelement.html.twig`.
Im Backend ist jetzt bei den Templates das Core-Template auswählbar und Dein
Template `individuelles_textelement.html.twig`

{{% notice info %}}
Eine Zuordnung der Templates zu einem bestimmten Theme ist für Twig-Templates nicht vorgesehen.
{{% /notice %}}

{{% notice note %}}
Eventuell steht noch nicht für jedes Modul/Inhaltselement ein Twig-Template zur Verfügung. In diesen Fällen werden
weiterhin die bisherigen (PHP/Legacy) Templates herangezogen.
Auch diese Templates können durch Twig-Templates angepasst werden. Das entsprechende Twig-Template muss dazu direkt im
Ordner `/templates` abgelegt werden. Es hat den gleichen Namen, wie das Original-Template und die Endung `.html.twig`.
Die Benennung von verschiedenen Varianten erfolgt genauso wie bei den [PHP-Templates](../php/verwaltung).
{{% /notice %}}





