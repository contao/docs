---
title: "Twig-Templates"
description: "Übersicht Twig-Templates."
url: "layout/templates/twig"
aliases:
    - /de/layout/templates/twig/
weight: 10
---


Twig ist die Standard Template Engine von Symfony. Es wird genauso wie PHP-Template zur Ausgabe eines Moduls, 
Inhaltselements, Formulars oder einer anderen Komponente verwendet.

{{% notice note %}}
In Contao wurde Twig in der Version 4.12 eingeführt. Seit Contao 5.0 werden Twig-Templates auch im Contao-Core verwendet.  
{{% /notice %}}

Es ist schnell, sicher und leicht erweiterbar. Im Gegensatz zu 
PHP-Templates enthalten Twig-Templates keine Geschäftslogik, was die gemeinsame Nutzung durch Designer und Programmierer erleichtert. 
Diese Tatsache hilft, eine saubere Trennung zwischen der Präsentations- und der Daten-/Logikschicht aufrechtzuerhalten.

Twig bietet außerdem viele leistungsstarke Methoden zur Strukturierung von Vorlagen, wie z. B. das Einbinden, Vererben, Wiederverwenden 
von Blöcken oder Makros, den erleichterten Zugriff auf Objekte mit »Property Access«, verfügt über Leerzeichenkontrolle, 
String-Interpolationsfunktionen und vieles mehr.

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
