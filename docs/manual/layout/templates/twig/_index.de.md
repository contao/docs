---
title: "Twig-Templates"
description: "Übersicht Twig-Templates."
url: "layout/templates/twig"
aliases:
    - /de/layout/templates/twig/
weight: 10
---


Twig ist Symfony's Standardmethode zum Schreiben von Templates. Es ist schnell, sicher und leicht erweiterbar. Im Gegensatz zu 
PHP-Templates enthalten Twig-Templates keine Geschäftslogik, was die gemeinsame Nutzung durch Designer und Programmierer erleichtert. 
Diese Tatsache hilft, eine saubere Trennung zwischen der Präsentations- und der Daten-/Logikschicht aufrechtzuerhalten.

Twig bietet außerdem viele leistungsstarke Methoden zur Strukturierung von Vorlagen, wie z. B. das Einbinden, Vererben, Wiederverwenden 
von Blöcken oder Makros, den erleichterten Zugriff auf Objekte mit »Property Access«, verfügt über Leerzeichenkontrolle, 
String-Interpolationsfunktionen und vieles mehr.

{{% notice info %}}
Seit Einführung der Twig Unterstützung in Contao 4.12 wurden die Möglichkeiten in den folgenden Contao Versionen kontinuierlich ausgebaut. 
Empfohlen wird daher die Nutzung ab den Contao Versionen **4.13.10** bzw. **5.0.2**. Die Unterschiede werden hier jeweils beschrieben.
{{% /notice %}}

{{% children %}}

## Erste Schritte

Twig-Templates haben ihre eigene Syntax. Das folgende Beispiel zeigt wie ein PHP-Template in ein analoges Twig-Template übersetzt werden kann:

{{< tabs groupId="twig">}}
{{% tab name="PHP" %}}
```html
<div class="about-me">
  <h2><?= $this->name ?></h2>
  <p>I am <?= round($this->age) ?> years old.</p>

  <ul class="hobby-list">
    <?php foreach $this->hobbies as $hobby: ?>
      <li><?= ucfirst($hobby) ?></li>
    <?php endforeach; ?>
  </ul>
</div>
```
{{% /tab %}}
{{% tab name="Twig" %}}
```twig
<div class="about-me">
  <h2>{{ name }}</h2>
  <p>I am {{ age|round }} years old.</p>

  <ul class="hobby-list">
    {% for hobby in hobbies %}
      <li>{{ hobby|capitalize }}</li>
    {% endfor %}
  </ul>
</div>
```
{{% /tab %}}
{{< /tabs >}}


### Die Syntax erlernen

Zur Ausgabe von Variablen benutzt du deren Namen in geschweiften Klammern `{{ foo }}`. Schlüsselwörter wie `for` werden innerhalb 
von `{%` und `%}` gesetzt. Zur weiteren Verarbeitung der Ausgabe verwendest du [Filter](https://twig.symfony.com/doc/3.x/filters/index.html)
`|foo` und [Funktionen](https://twig.symfony.com/doc/3.x/functions/index.html) `bar()`.

Die Twig Syntax ist [gut dokumentiert](https://twig.symfony.com/doc/3.x/). Ein guter Startpunkt ist der
Abschnitt [Twig für Template-Designer](https://twig.symfony.com/doc/3.x/templates.html). Du möchtest schnell etwas ausprobieren? 
Verwende dazu [Twig fiddle](https://twigfiddle.com/).