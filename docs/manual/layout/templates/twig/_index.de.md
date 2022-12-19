---
title: "Twig-Templates"
description: "Übersicht Twig-Templates."
url: "layout/templates/twig"
aliases:
    - /de/layout/templates/twig/
weight: 10
---

Twig ist eine Template Engine für PHP und Standard in Symfony. 
Wie ein PHP-Template wird Twig für die Ausgabe eines Moduls, Inhaltselements, Formulars oder einer anderen Komponente verwendet. 
Im Gegensatz zu PHP-Templates enthalten Twig-Templates keine Geschäftslogik, was die Trennung zwischen Designer und Programmierer erreicht.
Sie ist schnell, sicher und leicht erweiterbar.

Twig bietet außerdem viele leistungsstarke Methoden zur Strukturierung von Vorlagen, wie z. B. das Einbinden, Vererben, Wiederverwenden
von Blöcken oder Makros, den erleichterten Zugriff auf Objekte mit »Property Access«, verfügt über Leerzeichenkontrolle,
String-Interpolationsfunktionen und vieles mehr.

{{% notice note %}}
In Contao können Twig-Templates seit Version 4.12 genutzt werden. Seit Contao 5.0 werden Twig-Templates auch im Contao-Core verwendet.  
{{% /notice %}}

{{% children %}}

## Syntax

Twig-Templates haben ihre eigene Syntax.

### Bezeichner

In Twig werden folgende drei Bezeichner verwendet
* {{ ... }} - Variable ausgeben
* {# ... #} - Kommentare
* {% ... %} - Kommandos und Kontrollstrukturen z. B. If-Abfragen

#### Beispiele
Ausgabe der Variable `meine_variable` in einem `p-Tag`
```twig
<p>Ausgabe: {{ meine_variable }} </p>
```
Ausgabe eines Kommentars
```twig
{# mein Kommentar #}
```
Prüfen ob `meine_variable` einen Inhalt hat und diesen ausgeben (If-Abfrage)
```twig
{% if meine_variable %}
    <p>Die Variable hat folgenden Inhalt:</p>
    <p>{{ meine_variable }}</p>
{% endif %}
```
Die Twig Syntax ist [gut dokumentiert](https://twig.symfony.com/doc/3.x/). Als Startpunkt ist der
Abschnitt [Twig für Template-Designer](https://twig.symfony.com/doc/3.x/templates.html) zu empfehlen. 

Du möchtest schnell etwas ausprobieren?
Verwende dazu [Twig fiddle](https://twigfiddle.com/).
