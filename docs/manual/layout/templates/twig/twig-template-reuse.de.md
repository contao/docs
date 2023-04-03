---
title: "Templates wiederverwenden"
description: "Template Wiederverwendung"
url: "layout/templates/twig/wiederverwendung"
weight: 40
aliases:
- /de/layout/templates/twig/wiederverwendung/
---

Contao setzt mit Twig konsequent auf das Wiederverwenden von Teilen eines Templates. Twig unterstützt viele
Möglichkeiten Teile eines Templates wiederzuverwenden. Dazu gehören u.a.:
* [Erweitern](#erweitern)
* [Horizontale Wiederverwendung](#horizontale-wiederverwendung)

Für komplexere Anpassungen stehen noch viele weitere Möglichkeiten zur Verfügung. Die Beschreibung findest Du in der
Entwicklerdokumentation

* [Einfügen](https://docs.contao.org/dev/framework/templates/creating-templates/#includes)
* [Einbetten](https://docs.contao.org/dev/framework/templates/creating-templates/#embeds),
* [Makros](https://docs.contao.org/dev/framework/templates/creating-templates/#macros)
* [Komponenten](https://docs.contao.org/dev/framework/templates/creating-templates/#contao-components)
* [Vorlagenfunktionen](https://docs.contao.org/dev/framework/templates/creating-templates/#template-features)

## Template-Hierarchie

Für die Wiederverwendung von Templates solltest Du Dich mit der Template-Hierarchie in Contao vertraut
machen.

* Templates aus einem Bundle (Core und Erweiterungen)
* Templates aus einer Anwendung
* globale Templates
* globale Varianten-Templates

Die übergeordneten Templates (Basis-Templates) des Cores, aus Erweiterungen oder Anwendungen können durch ein
[globale Templates](../verwaltung/#globale-templates) aus dem Ordner `/templates` einmal grundsätzlich für alle Elemente
eines Typs angepasst werden
oder es können globale [Varianten-Templates](../verwaltung/#globale-varianten-templates) zur Verfügung gestellt
werden. Ein Varianten-Template kann dabei entweder direkt ein Template
aus dem Core, aus Erweiterungen oder Anwendungen anpassen oder ein globales Template aus dem Ordner `/templates`.

Zusätzlich stehen noch [themespezifische Templates](../verwaltung/#themespezifische-templates) zur Verfügung, die aber
nicht zur Template-Hierarchie gehören, weil sie erst zur Laufzeit erzeugt werden.

Die Template-Hierarchie kann über die Kommandozeile mit
dem [debug:contao-twig Kommando](https://docs.contao.org/dev/framework/templates/debugging/#debug-contao-twig-command)
dargestellt werden.
Beachte bei der Verwendung des Kommandozeilenbefehls auch den [entsprechenden Abschnitt im Handbuch](/de//cli).

## Erweitern

Zum Erweitern eines Templates steht der `{% extend %}`-Tag zu Verfügung.<br>
Beim Erweitern wird ein Template nicht komplett überschrieben, sondern es werden nur gezielt einzelne Teilbereiche (
Blöcke)
eines übergeordneten Templates (Basis-Template) angepasst.
Dazu muss das Basis-Template mit `{% extends "@Contao/('pfad-des-templates')/('name-des-templates') %}`
angegeben werden.

Contao unterstützt Euch bei der Erweiterung von Templates und bei der [Anpassung von Blöcken](#blöcke-anpassen) und
[Anpassen von HTML-Attributen](#html-attribute-anpassen).<br>
Wählst Du eines der neuen Twig-Templates zur Anpassung aus, dann wird Dir das neue Template für die Vererbung so
vorbereitet, dass das Basis-Template bereits angegeben ist. In den Kommentaren findest Du die Blöcke und
HTML-Attribute, die angepasst werden können.

### Blöcke anpassen

Anpassbare Bereiche in Twig Templates befinden sich in Blöcken. Blöcke beginnen mit einem  `{% block('name-des-blocks')
%}`-Tag und enden mit einem `{% endblock %}`-Tag.

Alle Anpassungen müssen innerhalb der verfügbaren Blöcke vorgenommen werden.

Mit `{{ parent() }}` lässt sich der originale Inhalt des Blocks ausgeben.

Alle nicht angepassten Blöcke werden automatisch aus dem übergeordneten Template übernommen.

{{% example "Erweiterung für das Textelement" %}}
Wir legen uns über das Backend ein neues Template für das Inhaltselement Text an und fügen in den Block `{% block text
%}`
einen zusätzlichen Text ein

```twig
{# /templates/content_element/text.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
    {% block text %}
        <p>Einleitender Text für alle Textelemente</p>
        {{ parent() }}
    {% endblock %}
```
In unserem Textelements wird jetzt vor dem Text, den wir im Tiny-MCE eingegeben haben, der Text `Einleitender Text
für alle Textelemente` ausgegeben.

Wir legen uns nun zusätzlich zwei Varianten für das Textelement an. Die Varianten erhalten im Block `{% block text%}`
jeweils einen eigenen Schlusstext.
```twig
{# /templates/content_element/text/tip.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
    {% block text %}
        {{ parent() }}
        <p>Hier steht ein zusätzlicher Schlusstext für die Variante "Tip"</p>
    {% endblock %}
```

```twig
{# /templates/content_element/text/notice.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
    {% block text %}
        {{ parent() }}
        <p>Hier steht ein zusätzlicher Schlusstext für die Variante "Notice"</p>
    {% endblock %}
```

Wählen wir jetzt das Template `content_element/text/tip` aus, dann ist das übergeordnete Template das Template  
`/templates/content_element/text.html.twig`.
Zu Beginn wird wieder der Text `Einleitender Text für alle Textelemente` ausgegeben und zusätzlich am Ende der
Text `Hier steht ein zusätzlicher Schlusstext für die Variante "Tip"`. Zwischen diesen beiden Texten steht der komplette
Text, den wir im Tiny-MCE eingegeben haben.
Bei Verwendung des Templates `content_element/text/notice` wird der Schlusstext `Hier steht ein zusätzlicher
Schlusstext für die Variante "Notice"` ausgegeben.
{{% /example %}}

### HTML-Attribute anpassen

Für die meisten Contao-Komponenten kannst Du zusätzliche CSS-ID oder CSS-Klasse im Backend vergeben.
Diese werden für die entsprechende Komponente gesetzt. Manchmal ist das nicht gewünscht und man möchte die Klasse
nur für ein bestimmtes HTML-Tag vergeben bzw. verändern.<br>
Dafür stellt Dir Contao die `{{ attrs() }}`-Funktion zur Verfügung. Damit wird es möglich im übergeordneten Template
als Variable verfügbare HTML-Attribute anzupassen.

{{% example "Klasse für den Textbereich anpassen" %}}

Wir möchten für das div-Tag, welches um den Textbereich liegt, die Klasse `description` ergänzen. Dazu passen wir die
Variable `text_attributes` entsprechend an. Mit `set` wird die Variable mit neuem Inhalt gefüllt. Die
Funktion `attrs(text_attributes|default)`
stellt uns die vorhandenen Attribute zur Verfügung mit `addClass` ergänzen wir die Attribute um die gewünschte Klasse.
```twig
{# /templates/content_element/text.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
{% set text_attributes = attrs(text_attributes|default).addClass('description') %}
```
{{% /example %}}

Weiter Beispiele und tiefer gehende Erklärungen findest Du im entsprechenden Abschnitt in
der [Entwicklerdokumentation](https://docs.contao.org/dev/framework/templates/creating-templates/#html-attributes)

## Horizontale Wiederverwendung

Eine sehr leistungsfähige Möglichkeit Teile eines Templates wiederzuverwenden biete uns die  `{{ block }}`-Funktion.
Damit ist es möglich Blöcke innerhalb eines Templates ein oder mehrmals auszugeben.

Dazu muss der Block im Template verfügbar sein. Ein Block ist verfügbar, wenn
* der Block direkt im Template definiert ist
* der Block aus einem übergeordneten Template stammt
* der Block über das `{% use %}`-Tag importiert wird

Wenn Du Dir
die [neuen Contao Core-Templates auf Github](https://github.com/contao/contao/tree/5.x/core-bundle/contao/templates/_new)
anschaust, wirst Du feststellen, dass das `{% use %}`-Tag neben dem `{% extends %}`-Tag am häufigsten verwendet wird.
<br>
Während mit dem `{% extends %}`-Tag alle Blöcke des übergeordneten Templates im Frontend ausgegeben werden, werden mit
dem `{% use %}`-Tag die Blöcke dem Template nur zur Verfügung gestellt. Die Ausgabe eines Blockes erfolgt erst mit
der`{{ block }}`-Funktion.
Dabei können zusätzliche Template-Parameter übergeben werden.

Weitere Informationen und Beispiele zur horizontalen Wiederverwendung findest Du in der
[Entwicklerdokumentation](https://docs.contao.org/dev/framework/templates/creating-templates/#horizontal-reuse)

Hier im Handbuch erwähnen wir diese komplexe Möglichkeit der Wiederverwendung von Templates nur deshalb, weil Du
für komplexere Template-Anpassungen insbesondere das `{% use %}`-Tag und die Verwendung
von [Contao-Komponenten](https://docs.contao.org/dev/framework/templates/creating-templates/#contao-components)
verstehen musst.

{{% notice tip %}}
Schau dir den Aufbau der neuen Core Templates an. Dann siehst Du, welcher Code sich in den einzelnen Blöcken der  
Templates befindet. Du findest diese
auf [Github](https://github.com/contao/contao/tree/5.x/core-bundle/contao/templates/_new)
{{% /notice %}}