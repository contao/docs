---
title: "Twig-Templates"
description: "Übersicht Twig-Templates."
url: "layout/templates/twig"
weight: 10erweiter
aliases:
- /de/layout/templates/twig/

---

{{% notice info %}}
Der gesamte Abschnitt behandelt die Verwendung von Twig-Templates in Contao ab Version 5.0.
In Contao können Twig-Templates zwar seit Version 4.12 genutzt werden, aber erst seit Contao 5.0 werden Twig-Templates
auch im Contao-Core verwendet. Es wurde darauf verzichtet, die abweichende Verwendung von Twig-Templates
in älteren Versionen im Handbuch zu dokumentieren.
{{% /notice %}}

Twig ist eine Template Engine für PHP und die Standard Template Engine von Symfony. Sie ist schnell, sicher und
leicht erweiterbar.<br>
Mit Twig-Templates kann das Design von der Programmierung strikt getrennt werden.

Wie ein PHP-Template wird ein Twig-Template für die Ausgabe eines Moduls, Inhaltselements, Formulars oder einer anderen
Komponente verwendet.

{{% notice note %}}
In Twig-Templates wird konsequent auf die leistungsstarken Methoden zur Strukturierung und Wiederverwendung von
Vorlagen gesetzt, wie
z.B. [Erweitern](wiederverwendung/#erweitern), [Einfügen](https://docs.contao.org/dev/framework/templates/creating-templates/#includes),
[Einbetten](https://docs.contao.org/dev/framework/templates/creating-templates/#embeds), [horizontale 
Wiederverwendung](wiederverwendung/#horizontale-wiederverwendung)
oder
[Makros](https://docs.contao.org/dev/framework/templates/creating-templates/#macros).
Deshalb sollten keine Templates mehr komplett überschrieben werden, wie das bei den PHP-Templates häufig üblich bzw.
notwendig war.<br>
Wir werden innerhalb des Handbuches nur die wichtigste Technik - das Erweitern von Twig-Templates Contao genauer
behandeln.
Weitergehende Informationen zu Twig-Templates in Contao findest Du in der
[Entwicklerdokumentation](https://docs.contao.org/dev/framework/templates/).
{{% /notice %}}

{{% children %}}

## Twig-Templates im Contao-Core
In Contao 5 werden für viele Core-Elemente Twig-Templates zur Verfügung gestellt. Das bedeutet, dass Template 
Anpassungen auch in den Twig-Templates erfolgen müssen.
Für eine Übergangszeit kann noch auf die PHP-Templates zurückgegriffen werden. Die notwendigen Einstellungen 
dafür findest Du in der [Upgrade-Anleitung](https://github.com/contao/contao/blob/5.x/UPGRADE.md#content-elements).

{{% notice warning %}}
Wir empfehlen dringend diese Möglichkeit nur in Ausnahmefällen zu nutzen, z.B. um nach einem Upgrade auf 
Contao 5 mehr Zeit für die notwendigen Anpassungen zu haben.<br>
Bedenke dabei auch, dass Erweiterungen für Contao 5 unter Umständen keine Möglichkeiten mehr zur Nutzung von 
PHP-Templates mitbringen.
{{% /notice %}}

Derzeit steht noch nicht für jedes Modul/Inhaltselement ein Twig-Template zur Verfügung. In diesen Fällen werden
weiterhin die bisherigen (PHP/Legacy) Templates herangezogen.
## Dateiendungen

Twig-Templates haben die Dateiendung `.twig`. Zusätzlich wird noch der Ausgabetyp angegeben.
Für eine Ausgabe von HTML wird die Dateiendung `html.twig` verwendet.




