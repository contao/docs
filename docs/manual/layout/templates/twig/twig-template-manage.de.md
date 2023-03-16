---
title: "Templates verwalten"
description: "Die Verwaltung der Template-Dateien."
url: "layout/templates/twig/verwaltung"
aliases:
- /de/layout/templates/twig/verwaltung/
weight: 30
---

## Ordnerstruktur

Du kannst Deine eigenen Templates im Ordner `/templates` ablegen, damit diese im Backend, etwa bei der Konfiguration 
eines Inhaltselements, zur Auswahl angeboten werden. Contao verwendet
* [globale Templates](#globale-templates) und
* [themespezifische Templates](#themespezifische-templates)

## Globale Templates

Eigene globale Twig-Templates werden innerhalb von `/templates` in einer speziellen Ordnerstruktur abgelegt.
Bei der Auswahl des Templates ist die Struktur in eckigen Klammern hinter dem Template-Namen angegeben. Der Unterordner
`content_element` ist zum Beispiel für Inhaltselemente vorgesehen.
Contao unterstützt Dich bei der Strukturierung der Templates. Willst Du eines der neuen Twig-Templates anpassen, dann
wird das Template automatisch im richtigen Unterordner angelegt.

{{% example "Globales Template für das Textelement" %}}
Du möchtest das Template für das Textelement anpassen. Dazu wählst Du aus den Original-Templates das Template
`text [content_element/text.html.twig]` aus. Das Template wird Dir automatisch im Ordner `/templates/content_element`
angelegt.
{{% /example %}}

Diese Template-Änderungen gelten für alle Elemente des jeweiligen Typs. Nicht immer ist das erwünscht. Möchte man
Template-Änderungen gezielt nur für bestimmte Elemente bereitstellen, werden verschiedene Varianten des Templates
benötigt, die dann im Backend des entsprechenden Elementes ausgewählt werden können.

### Globale Varianten-Templates

Willst Du mehrere Varianten eines eigenen Templates zur Verfügung stellen, dann müssen die Templates für die Varianten
in einem Unterordner der neuen Struktur abgelegt werden, der dem Namen des anzupassenden Templates entspricht. Der Name
des Varianten-Templates ist unter Einhaltung der 
[Namenskonventionen](https://docs.contao.org/dev/framework/templates/creating-templates/#naming-convention) frei
wählbar, sollte aber aus Gründen der Übersicht einen Hinweis auf den Zweck der Templateanpassung geben.

{{% example "Varianten-Templates für das Textelement" %}}
Du möchtest mehrere Varianten des Textelements bereitstellen.
Dazu legst Du innerhalb von `/templates/content_element` einen Ordner `text` an. Innerhalb des neuen Ordners
`/templates/content_element/text` kannst Du jetzt ein oder mehrere Varianten des Templates für das Inhaltselement Text
anlegen, z.B. `tip.html.twig` und `highlight.html.twig`.
Im Backend stehen jetzt neben dem Core-Template `text.html.twig` auch Deine beiden Varianten-Templates zur Auswahl.
{{% /example %}}

{{% notice tip %}}
Du kannst auch global ein Core-Template anpassen und zusätzlich Varianten-Template erstellen.
Damit sind die Möglichkeiten zur Anpassung von Templates sehr flexibel.
{{% /notice %}}

## Themespezifische Templates

Im [Theme-Manager](../../../theme-manager/themes-verwalten) kannst du einen vorhandenen Unterordner mit einem
Theme verknüpfen. Das ist der **Themeordner**. Templates in diesem Ordner sind **themespezifische Templates**. Sie sind
in
Bezug auf Ihre Behandlung etwas Besonderes, denn sie sind zwar am spezifischsten, aber dennoch nicht Teil der
[Templatehierarchie](../wiederverwendung/#templatehierarchie). Erst zur Laufzeit wird entschieden, ob ein 
themespezifisches
Template verwendet wird.<br>

{{% notice note %}}
Du kannst mit themespezifischen Templates grundsätzlich nur Templates anpassen, die als globale Templates in der
[Templatehierarchie](../wiederverwendung/#templatehierarchie) vorhanden sind.
{{% /notice %}}

Für die neuen Twig-Templates muss innerhalb des Themeordners die gleiche Ordnerstruktur für die Templates eingehalten
werden, wie das für die globalen Templates der Fall ist.

{{% example "Themespezifisches Template" %}}
Du hast ein Theme, das Theme A. Der Themeordner für dieses Theme ist `/templates/themeA/`. Du möchtest für das
Textelement ein themespezifisches Template anbieten. Der Pfad zu diesem Template ist
`/templates/themeA/content_element/text.html.twig`.<br>
Für ein Theme B ist der Themeordner `/templates/themeB/`. In diesem Ordner kannst Du unter
`/templates/themeB/content_element/text.html.twig` eine andere Anpassung für das Text-Template verwenden.
{{% /example %}}

### Themespezifische Varianten-Templates

Themespezifische Varianten-Templates benötigen ein globales themespezisches Template mit dem gleichen Namen.

{{% example "Themespezifisches Varianten-Template" %}}
Wenn ein themespezifisches Template`/templates/content_element/text/highlight.html.twig` existiert,
kannst Du zusätzlich noch themespezifische Varianten-Templates verwenden. Für das Theme A mit dem Templateordner
`/templates/themeA/` wäre das `/templates/themeA/content_element/text/highlight.html.twig`.
{{% /example %}}

{{% notice warning %}}
Themespezifische Varianten-Templates ohne gleichnamiges globales Varianten-Templates können nicht eingesetzt
werden. Ein solches Template steht im Backend nicht zur Auswahl zur Verfügung.
{{% /notice %}}







