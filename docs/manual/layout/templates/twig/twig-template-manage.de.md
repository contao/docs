---
title: "Templates verwalten"
description: "Die Verwaltung der Template-Dateien."
url: "layout/templates/twig/verwaltung"
weight: 30
aliases:
  - /de/layout/templates/twig/verwaltung/
---

## Ordnerstruktur

Du kannst deine eigenen Templates im Ordner `/templates` ablegen, damit diese im Backend, etwa bei der Konfiguration
eines Inhaltselements, zur Auswahl angeboten werden. Contao unterscheidet im Template-Ordner zwischen:

* [Globalen Templates](#globale-templates) und [Themespezifischen Templates](#themespezifische-templates)

Beim Anlegen, Verschieben oder Umbenennen von Twig-Templates empfehlen wir dir die Verwendung des 
[Debug-Modus](/de/system/debug-modus/#contao-4-8-und-hoeher), damit die neu angelegten Templates auch verwendet werden.  
Nach Fertigstellung muss der Anwendungs-Cache über den Contao-Manager oder über die Konsole neu aufgebaut werden.

{{% notice info %}}
Auch im Debug-Modus kann es in manchen Fällen erforderlich sein, den Anwendungs-Cache zu löschen, damit euer
angepasstes Template greift.
{{% /notice %}}


## Globale Templates

Eigene globale Twig-Templates werden innerhalb von `/templates` in einer speziellen Ordnerstruktur abgelegt. Der
Unterordner `content_element` ist zum Beispiel für Inhaltselemente vorgesehen.  
Contao unterstützt dich bei der Strukturierung der Templates. Willst du eines der neuen Twig-Templates anpassen, dann
wird das Template automatisch im richtigen Unterordner angelegt.

{{% example "Globales Template für das Text-Element" %}}
Du möchtest das Template für das Text-Element anpassen. Dazu wählst du aus den Original-Templates das Template
`text [content_element/text.html.twig]` aus. Die notwendige Struktur wird dir dabei in eckigen Klammern hinter dem
Template-Namen angegeben. Das Template wird dir automatisch im Ordner `/templates/content_element` angelegt.
{{% /example %}}

Diese Template-Änderungen gelten für alle Elemente des jeweiligen Typs. Nicht immer ist das erwünscht. Möchte man
Template-Änderungen gezielt nur für bestimmte Elemente bereitstellen, werden verschiedene Varianten des Templates
benötigt, die dann im Backend des entsprechenden Elementes ausgewählt werden können.


### Globale Varianten-Templates

Willst du mehrere Varianten eines eigenen Templates zur Verfügung stellen, dann müssen die Templates für die Varianten
in einem Unterordner der neuen Struktur abgelegt werden, der dem Namen des anzupassenden Templates entspricht. Der Name
des Varianten-Templates ist unter Einhaltung der 
[Namenskonventionen](https://docs.contao.org/dev/framework/templates/creating-templates/#naming-convention) frei
wählbar, sollte aber aus Gründen der Übersicht einen Hinweis auf den Zweck der Template-Anpassung geben.

{{% example "Varianten-Templates für das Text-Element" %}}
Du möchtest mehrere Varianten des Text-Elements bereitstellen.  
Dazu legst du innerhalb von `/templates/content_element` einen Ordner `text` an. Innerhalb des neuen Ordners
`/templates/content_element/text` kannst du jetzt ein oder mehrere Varianten des Templates für das Inhaltselement Text
anlegen, z.B. `tip.html.twig` und `highlight.html.twig`. Im Backend stehen jetzt neben dem Core-Template 
`text.html.twig` auch deine beiden Varianten-Templates zur Auswahl.
{{% /example %}}

{{% notice tip %}}
Du kannst auch global ein Core-Template anpassen und zusätzlich Varianten-Template erstellen. Damit sind die 
Möglichkeiten zur Anpassung von Templates sehr flexibel.
{{% /notice %}}


## Themespezifische Templates

Im [Theme-Manager](../../../theme-manager/themes-verwalten) kannst du einen vorhandenen Unterordner mit einem Theme
verknüpfen. Das ist der **Theme-Ordner**.

{{% notice warning %}}
Der Name des Theme-Ordners darf aus technischen
Gründen ([verwalteter Namespace](https://docs.contao.org/dev/framework/templates/architecture/#managed-namespace)) keine
Unterstriche enthalten.
{{% /notice %}}

Templates im Theme-Ordner sind **themespezifische Templates**. Sie sind in Bezug
auf ihre Behandlung etwas Besonderes, denn sie sind zwar am spezifischsten, aber dennoch nicht Teil der
[Template-Hierarchie](../wiederverwendung/#templatehierarchie). Erst zur Laufzeit wird entschieden, ob ein
themespezifisches Template verwendet wird.

{{% notice note %}} 
Du kannst mit themespezifischen Templates grundsätzlich nur Templates anpassen, die als globale Templates in der
[Template-Hierarchie](../wiederverwendung/#templatehierarchie) vorhanden sind. 
{{% /notice %}}

Für die neuen Twig-Templates muss innerhalb des Theme-Ordners die gleiche Ordnerstruktur für die Templates eingehalten
werden, wie das für die globalen Templates der Fall ist.

{{% example "Themespezifisches Template für das Text-Element" %}}
Du hast ein Theme, das Theme A. Der Theme-Ordner für dieses Theme ist `/templates/themeA/`. Du möchtest für das 
Text-Element ein themespezifisches Template anbieten.Der Pfad zu diesem Template ist 
`/templates/themeA/content_element/text.html.twig`.

Für ein Theme B ist der Theme-Ordner `/templates/themeB/`. In diesem Ordner kannst du mit
`/templates/themeB/content_element/text.html.twig` eine Anpassung für das Text-Element im Theme B hinterlegen.
{{% /example %}}


### Themespezifische Varianten-Templates

Themespezifische Varianten-Templates benötigen ein globales Varianten-Template mit dem gleichen Namen.

{{% example "Themespezifisches Varianten-Template für das Text-Element" %}}
Wenn ein themespezifisches Template`/templates/content_element/text/highlight.html.twig` existiert, kannst du zusätzlich 
noch themespezifisches Varianten-Templates verwenden. Für das Theme A mit dem Templateordner
`/templates/themeA/` wäre das `/templates/themeA/content_element/text/highlight.html.twig`.
{{% /example %}}

{{% notice warning %}}
Themespezifische Varianten-Templates ohne gleichnamiges globales Varianten-Templates können nicht eingesetzt werden. 
Ein solches Template steht im Backend nicht zur Auswahl zur Verfügung.
{{% /notice %}}
