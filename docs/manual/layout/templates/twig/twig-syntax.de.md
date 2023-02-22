---
title: "Twig-Syntax"
description: "Syntax von Twig."
url: "layout/templates/twig/syntax"
aliases:
    - /de/layout/templates/twig/syntax
weight: 20
---

Twig-Templates haben ihre eigene Syntax.

## Bezeichner

In Twig werden folgende drei Bezeichner verwendet
* {{ ... }} - Variable ausgeben
* {# ... #} - Kommentare
* {% ... %} - Kommandos und Kontrollstrukturen z. B. If-Abfragen

### Beispiele
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

Du möchtest schnell etwas ausprobieren? Dazu kannst Du [Twig fiddle](https://twigfiddle.com/) verwenden.

