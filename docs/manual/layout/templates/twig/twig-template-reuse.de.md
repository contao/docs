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
* [Einfügen](#einfügen)
* [Einbetten](#einbetten)

Für weitere Möglichkeiten findest Du die Beschreibung in der Entwicklerdokumentation

* [Horizontal Wiederverwendung](https://docs.contao.org/dev/framework/templates/creating-templates/#horizontal-reuse)
* [Makros](https://docs.contao.org/dev/framework/templates/creating-templates/#macros)
* [Komponenten](https://docs.contao.org/dev/framework/templates/creating-templates/#contao-components)

## Templatehierarchie

Wenn Du mit der Wiederverwendung von Templates arbeitest, solltest Du Dich mit der Templatehierarchie in Contao vertraut
machen.

* Templates aus einem Bundle
* Templates aus einer Applikation
* [globale Templates](../verwaltung/#globale-templates)
* [globale Varianten-Templates](../verwaltung/#globale-varianten-templates)

Wichtig für eigene Anpassungen sind die letzten beiden. Damit besteht die Möglichkeit Templates des Cores oder aus
Erweiterungen einmal grundsätzlich für alle Elemente anzupassen oder auch Varianten-Templates zur
Verfügung zu stellen.

Zusätzlich stehen noch [themespezifische Templates](../verwaltung/#themespezifische-templates) zur Verfügung, die aber
nicht zur Templatehierarchie gehören, weil sie erst zur Laufzeit erzeugt werden.

## Erweitern

Dabei wird ein Template nicht komplett überschrieben, sondern es werden nur gezielt einzelne Teilbereiche (Blöcke)
eines übergeordneten Templates (Basis-Template) angepasst.
Dazu muss das Basis-Template mit `{% extends "@Contao/('pfad-des-templates')/('name-des-templates') %}`
angegeben werden.

Alle Anpassungen müssen innerhalb der verfügbaren Blöcke vorgenommen werden.

### Blöcke anpassen

Zur Gliederung umschließen die Twig Templates ihre Inhalte in ein oder mehreren Blöcken `{% block
('name-des-blocks') %}` und `{% endblock %}` Ausdrücke. Nur Inhalte, die in solchen Blöcken liegen, können angepasst
werden.

Mit `{{ parent() }}` lässt sich der originale Inhalt des Blocks ausgeben.

Contao unterstützt Euch bei der Erweiterung von Templates und bei der Anpassung von Blöcken.
Wählst Du eines der neuen Twig-Templates zur Anpassung aus, dann wird Dir das neue Template für die Vererbung so
vorbereitet, dass das Basis-Template bereits angegeben ist. In den Kommentaren findest Du die verfügbaren Blöcke, die
angepasst werden können.

{{% example "Erweiterung für das Textelement" %}}
Wir legen uns über das Backend ein neues Template für das Inhaltselement Text an.

```twig
{# /templates/content_element/text.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
    {% block text %}
        <p>Einleitender Text für alle Textelemente</p>
        {{ parent() }}
    {% endblock %}
```
Danach legen wir uns zusätzlich zwei Varianten für das Textelement an.
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
Dazu solltest Du Das

## Einbetten

