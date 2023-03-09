---
title: "Twig-Templates"
description: "Übersicht Twig-Templates."
url: "layout/templates/twig"
aliases:
    - /de/layout/templates/twig/
weight: 10
---

{{% notice info %}}
Der gesamte Artikel behandelt die Verwendung von Twig-Templates in Contao ab Version 5.0.
In Contao können Twig-Templates zwar seit Version 4.12 genutzt werden, aber erst seit Contao 5.0 werden Twig-Templates
auch im Contao-Core verwendet. Es wurde darauf verzichtet, die abweichende Verwendung von Twig-Templates
in älteren Versionen zu dokumentieren.
{{% /notice %}}

Twig ist eine Template Engine für PHP. Es ist die Standard Template Engine von Symfony. Sie ist schnell, sicher und 
leicht erweiterbar.<br>
Mit Twig-Templates kann das Design von der Programmierung strikt getrennt werden.

Wie ein PHP-Template wird ein Twig-Template für die Ausgabe eines Moduls, Inhaltselements, Formulars oder einer anderen
Komponente verwendet.

{{% notice note %}}
In Twig-Templates wird konsequent auf die leistungsstarken Methoden zur Strukturierung von Vorlagen gesetzt, wie z.B.
Vererben, [Einbinden](einbinden), Wiederverwenden von Blöcken oder Makros. Deshalb sollten keine
Templates mehr komplett überschrieben werden, wie das bei den PHP-Templates häufig üblich bzw. notwendig war.<br>
Weitergehende Informationen zu Twig-Templates in Contao findest Du in der 
[Entwicklerdokumentation](https://docs.contao.org/dev/framework/templates/).
{{% /notice %}}

{{% children %}}

## Dateiendungen

Twig-Templates haben die Dateiendung `.twig`. Zusätzlich wird noch der Ausgabetyp angegeben.
Für eine Ausgabe von HTML wird die Dateiendung `html.twig` verwendet.
