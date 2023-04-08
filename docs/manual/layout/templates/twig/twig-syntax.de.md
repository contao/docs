---
title: "Twig-Syntax"
description: "Syntax von Twig."
url: "layout/templates/twig/syntax"
aliases:
  - /de/layout/templates/twig/syntax
weight: 20
---

Twig-Templates haben ihre eigene Syntax. Wir stellen hier nur die wichtigsten Regeln vor, die zum Grundverständnis
von Twig notwendig sind.

{{% notice info %}}
Die Twig Syntax ist [gut dokumentiert](https://twig.symfony.com/doc/3.x/). Als Startpunkt ist der
Abschnitt [Twig für Template-Designer](https://twig.symfony.com/doc/3.x/templates.html) zu empfehlen.
{{% /notice %}}


## Bezeichner

In Twig werden folgende drei Bezeichner verwendet

* `{# ... #}` - [Kommentare](#kommentare)
* `{{ ... }}` - [Variable ausgeben](#ausgabe-von-variablen)
* `{% ... %}` - [Kommandos und Kontrollstrukturen](#kommandos-und-kontrollstrukturen)


### Kommentare

Ein Kommentar kann ein- oder mehrzeilig sein. Alles was zwischen `{#` und `#}` steht, wird auskommentiert.

{{% example "Einzeiliger Kommentar" %}}
```twig
{# mein Kommentar #}
```
{{% /example %}}

Es ist auch möglich Teile des Code auszukommentieren.

{{% example "Mehrzeiliger Kommentar mit auskommentiertem Code" %}}
```twig
{# auskommentierter Code - der Code wird nicht ausgeführt
{{ variable }}
#}
```
{{% /example %}}


### Ausgabe von Variablen

Eine Variable kannst du mit `{{ name_der_variablen }}` ausgeben.

{{% example "Ausgabe einer Variable" %}}
```twig
<p>Ausgabe: {{ name_der_variablen }} </p>
```
{{% /example %}}


### Kommandos und Kontrollstrukturen

Hierunter versteht man im weitesten Sinn alles, was im Zusammenhang mit der Steuerung bei der Ausgabe von Variablen
verbunden ist.
Hier werden nur die gängigsten vorgestellt, die häufig auch in Contao-Templates verwendet werden.


#### If-Abfrage

Wenn bestimmte Ausgaben nur dann erfolgen sollen, wenn eine Bedingung erfüllt ist, verwendest du die If-Abfrage.

{{% example "If-Abfrage" %}}
```twig
{% if meine_variable %}
    <p>Die Variable hat folgenden Inhalt:</p>
    <p>{{ meine_variable }}</p>
{% endif %}
```
{{% /example %}}


#### For-Schleife

Eine For-Schleife wird verwendet, um Code wiederholt auszuführen. Ein typisches Anwendungsbeispiel ist die
Ausgabe von Inhalten eines Arrays.

{{% example "For Schleife" %}}
```twig
<ul>
    {% for item in items %}
        <li>{{ item }}</li>
    {% endfor %}
</ul>
```
{{% /example %}}


### Filter

Filter werden auf Variable angewendet. Sie geben an wie eine Variable verarbeitet werden soll.

{{% example "Filter" %}}
```twig
{{ name der variable|name_des_filters }}
```
{{% /example %}}

Filter in Twig sind extrem leistungsfähig und vielseitig. Twig bringt viele
[Filter](https://twig.symfony.com/doc/3.x/filters/index.html) von Haus aus mit. Entwickler können aber auch eigene
Filter erstellen.  
Wer sich für die Erstellung eigener Filter interessiert schaut bitte in die
[Entwicklerdokumentation](https://docs.contao.org/dev/framework/templates/getting-started/#extending-twig).

{{% notice tip %}}
Du möchtest etwas ausprobieren? Dazu kannst du [Twig fiddle](https://twigfiddle.com/) verwenden.
{{% /notice %}}
