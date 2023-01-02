---
title: "Twig-Templates"
description: "Übersicht Twig-Templates."
url: "layout/templates/twig"
aliases:
    - /de/layout/templates/twig/
weight: 10
---

Twig ist eine Template Engine für PHP. Es ist die Standard Template Engine von Symfony. 

Wie ein PHP-Template wird ein Twig-Template für die Ausgabe eines Moduls, Inhaltselements, Formulars oder einer anderen Komponente verwendet. 
Mit Twig-Templates kann das Design von der Programmierung strikt getrennt werden.
Sie ist schnell, sicher und leicht erweiterbar.

Twig bietet außerdem viele leistungsstarke Methoden zur Strukturierung von Vorlagen, wie z. B. das Einbinden, Vererben, Wiederverwenden
von Blöcken oder Makros, den erleichterten Zugriff auf Objekte mit »Property Access«, verfügt über Leerzeichenkontrolle,
String-Interpolationsfunktionen und vieles mehr.

{{% notice note %}}
In Contao können Twig-Templates seit Version 4.12 genutzt werden. Seit Contao 5.0 werden Twig-Templates auch im Contao-Core verwendet.
{{% /notice %}}

{{% children %}}

## Dateiendungen
Twig-Templates haben die Dateiendung `.twig`. Zusätzlich wird noch der Ausgabetyp angegeben. 
Für eine Ausgabe von HTML wird die Dateiendung `html.twig` verwendet
