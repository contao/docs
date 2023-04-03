---
title: "Templates wiederverwenden"
description: "Template Wiederverwendung"
url: "layout/templates/twig/wiederverwendung"
weight: 40
aliases:
- /de/layout/templates/twig/wiederverwendung/
---

Contao setzt mit Twig konsequent auf das Wiederverwenden von Teilen eines Templates. Twig unterstützt viele
Möglichkeiten, Teile eines Templates wiederzuverwenden. Dazu gehören u.a.:
* [Erweitern](#erweitern)

* [Horizontale Wiederverwendung](#horizontale-wiederverwendung)

Für weitere Möglichkeiten findest Du die komplette Beschreibung in der Entwicklerdokumentation
* [Einfügen](#einfügen)
* [Einbetten](#einbetten)
* [Makros](https://docs.contao.org/dev/framework/templates/creating-templates/#macros)
* [Komponenten](https://docs.contao.org/dev/framework/templates/creating-templates/#contao-components)

{{% notice tip %}}
Schau dir den Aufbau der neuen Core Templates an. Dann siehst Du, welcher Code sich in den einzelnen Blöcken der  
Templates befindet. Du findest diese
auf [Github](https://github.com/contao/contao/tree/5.x/core-bundle/contao/templates/_new)
{{% /notice %}}

## Templatehierarchie

Für die Wiederverwendung von Templates solltest Du Dich mit der Templatehierarchie in Contao vertraut
machen.

* Templates aus einem Bundle (Core und Erweiterungen)
* Templates aus einer Anwendung
* [globale Templates](../verwaltung/#globale-templates)
* [globale Varianten-Templates](../verwaltung/#globale-varianten-templates)

Die übergeordneten Templates (Basis-Templates) des Cores, aus Erweiterungen oder Anwendungen können durch Deine
globalen Templates im Ordner `/templates` einmal grundsätzlich für alle Elemente angepasst/erweitert werden oder es
können Varianten-Templates zur Verfügung gestellt werden. Ein Varianten-Template kann dabei entweder direkt ein Template
aus dem Core, aus Erweiterungen oder Anwendungen erweitern oder auch Dein eigenes globales Template.

Zusätzlich stehen noch [themespezifische Templates](../verwaltung/#themespezifische-templates) zur Verfügung, die aber
nicht zur Templatehierarchie gehören, weil sie erst zur Laufzeit erzeugt werden.

## Erweitern

Dabei wird ein Template nicht komplett überschrieben, sondern es werden nur gezielt einzelne Teilbereiche (Blöcke)
eines übergeordneten Templates (Basis-Template) angepasst.
Dazu muss das Basis-Template mit `{% extends "@Contao/('pfad-des-templates')/('name-des-templates') %}`
angegeben werden.

### Blöcke anpassen

Anpassbare Bereiche in Twig Templates befinden sich in Blöcken. Blöcke beginnen mit  `{% block
('name-des-blocks') %}` und enden mit `{% endblock %}` Ausdrücke.

Alle Anpassungen müssen innerhalb der verfügbaren Blöcke vorgenommen werden.

Mit `{{ parent() }}` lässt sich der originale Inhalt des Blocks ausgeben.

Contao unterstützt Euch bei der Erweiterung von Templates und bei der Anpassung von Blöcken.<br>
Wählst Du eines der neuen Twig-Templates zur Anpassung aus, dann wird Dir das neue Template für die Vererbung so
vorbereitet, dass das Basis-Template bereits angegeben ist. In den Kommentaren findest Du die verfügbaren Blöcke, die
angepasst werden können.

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
Danach legen wir uns zusätzlich zwei Varianten für das Textelement an. Die Varianten erhalten im Block `{% block text
%}`
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
Wird im Backend für das Textelement das Template `content_element/text` ausgewählt, dann wird zu Beginn unseres
Textelements der
Text `Einleitender Text für alle Textelemente` ausgegeben.

Wählen wir jetzt das Template `content_element/text/tip` aus, dann wird zu Beginn unseres Textelements wieder der
Text `Einleitender Text für alle Textelemente` ausgegeben und zusätzlich am Ende der
Text `Hier steht ein zusätzlicher Schlusstext für die Variante "Tip"`. Zwischen diesen beiden Texten steht der komplette
Text, den wir im Tiny-MCE eingegeben haben.
Bei Verwendung des Templates `content_element/text/notice` gibt es dann den
Schlusstext `Hier steht ein zusätzlicher Schlusstext für die Variante "Notice"`.
{{% /example %}}

## Einfügen

Beim Einfügen wird ein komplettes Template in einem anderen Template aufgenommen.
Dazu solltest Du in der Regel das `{% include %}`-Tag verwenden.
Weitere Informationen und ein Beispiel zum Einfügen findest Du in der
[Entwicklerdokumentation](https://docs.contao.org/dev/framework/templates/creating-templates/#includes)

## Einbetten

Beim Einbetten fügt man eine Vorlage ein und verändert diese gleichzeitig. Dazu wird der `{% embed %}`-Tag verwendet.
Auch hier findest Du ein Beispiel in
der [Entwicklerdokumentation](https://docs.contao.org/dev/framework/templates/creating-templates/#embeds)

## Horizontale Wiederverwendung

Eine sehr mächtige Möglichkeit Teile eines Templates wiederzuverwenden biete uns die  `{{ block }}`-Funktion.
Damit ist es möglich Blöcke innerhalb eines Templates ein oder mehrmals auszugeben und zusätzlich auch
anzupassen.
Dazu muss der Block im Template verfügbar sein. Ein Block ist verfügbar, wenn
* der Block direkt im Template definiert ist
* der Block aus einem übergeordneten Template stammt
* der Block über das `{% use %}`-Tag importiert wird

Wenn Du Dir
die [neuen Contao Core-Templates auf Github](https://github.com/contao/contao/tree/5.x/core-bundle/contao/templates/_new)
anschaust, wirst Du feststellen, dass das `{% use %}`-Tag neben dem `{% extends %}`-Tag sehr häufig verwendet wird.
Damit können Templates wiederverwendet werden ohne das deren Inhalt automatisch im Frontend ausgegeben wird. Die 
Ausgabe erfolgt erst  zur Verfügung gestellt werden, aber 
nicht aut

Weitere Informationen und Beispiele zum horizontalen Wiederverwenden findest Du in der
[Entwicklerdokumentation](https://docs.contao.org/dev/framework/templates/creating-templates/#horizontal-reuse)



