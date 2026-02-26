---
title: "Twig-Templates"
description: "Übersicht Twig-Templates."
url: "layout/templates/twig"
aliases:
  - /de/layout/templates/twig/
weight: 10
tags: [Twig]
---

{{% notice note %}}
Der gesamte Abschnitt behandelt die Verwendung von Twig-Templates in Contao ab Version 5.0.  
In Contao können Twig-Templates zwar seit Version 4.12 genutzt werden, aber erst seit Contao 5.0 werden Twig-Templates
auch im Contao-Core verwendet. Es wurde darauf verzichtet, die abweichende Verwendung von Twig-Templates in älteren
Versionen im Handbuch zu dokumentieren.
{{% /notice %}}

Twig ist eine Template Engine für PHP und die Standard Template Engine von Symfony. Sie ist schnell, sicher und leicht
erweiterbar.  
Mit Twig-Templates kann das Design von der Programmierung strikt getrennt werden.

Wie ein PHP-Template wird ein Twig-Template für die Ausgabe eines Moduls, Inhaltselements, Formulars oder einer anderen
Komponente verwendet.

{{% notice info %}}
In Twig-Templates wird konsequent auf die leistungsstarken Methoden zur Strukturierung und Wiederverwendung von
Vorlagen gesetzt, wie
z. B. [Erweitern](wiederverwendung/#erweitern),
[Einfügen](https://docs.contao.org/dev/framework/templates/creating-templates/#includes),
[Einbetten](https://docs.contao.org/dev/framework/templates/creating-templates/#embeds),
[horizontale Wiederverwendung](wiederverwendung/#horizontale-wiederverwendung) oder
[Makros](https://docs.contao.org/dev/framework/templates/creating-templates/#macros).
Deshalb sollten keine Templates mehr komplett überschrieben werden, wie das bei den PHP-Templates häufig üblich bzw.
notwendig war.  
Wir werden innerhalb des Handbuches nur die wichtigste Technik - das Erweitern von Twig-Templates für Contao genauer
behandeln.  
Weitergehende Informationen zu Twig-Templates in Contao findest du in der
[Entwicklerdokumentation](https://docs.contao.org/dev/framework/templates/).
{{% /notice %}}

{{% children %}}


## Twig-Templates im Contao-Core

{{< version "5.7" >}} Für jedes `.html5`-Template steht ein Twig-Pendant zur Verfügung. Twig ist damit der
neue Standard und löst die HTML5-Templates vollständig ab.

Standardmäßig wird immer die Twig-Version eines Templates verwendet. Liegt jedoch ein gleichnamiges
`.html5`-Template in deinem `templates`-Verzeichnis, hat dieses Vorrang gegenüber dem Twig-Template.

**Beispiel:** `news_full.html.twig` wird verwendet, solange kein `news_full.html5` im `templates`-Ordner
vorhanden ist.

Für eine Übergangszeit kann noch auf die PHP-Templates zurückgegriffen werden. Informationen zur Nutzung
der alten Inhaltselemente (`ce_*.html5`) findest du in der
[Upgrade-Anleitung](https://github.com/contao/contao/blob/5.x/UPGRADE.md#content-elements).

{{% notice warning %}}
Wir empfehlen dringend, auf jegliche HTML5-Templates und die alten Inhaltselemente (Präfix `ce_`)
zu verzichten. Nutze diese Möglichkeit nur in Ausnahmefällen, z. B. um nach einem Upgrade auf Contao 5
mehr Zeit für die notwendigen Anpassungen zu haben.
Bedenke dabei auch, dass Erweiterungen für Contao 5 unter Umständen keine Unterstützung für
PHP-Templates mehr mitbringen.
{{% /notice %}}


## Dateiendungen

Twig-Templates haben die Dateiendung `.twig`. Zusätzlich wird noch der Ausgabetyp angegeben.
Für eine Ausgabe von HTML wird die Dateiendung `.html.twig` verwendet.
