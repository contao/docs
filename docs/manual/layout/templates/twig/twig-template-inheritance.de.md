---
title: "Template vererben"
description: "Die Template Vererbung."
url: "layout/templates/twig/vererbung"
aliases:
- /de/layout/templates/twig/vererbung/
weight: 40
---

Contao setzt mit Twig konsequent auf das Vererben von Templates. Dabei wird ein Template nicht komplett
überschrieben, sondern es werden nur gezielt einzelne Teilbereiche (Blöcke) angepasst.

## Blöcke anpassen

Zur Gliederung umschließen die Twig Templates ihre Inhalte in ein oder mehreren Blöcken `{% block
('name-des-blocks') %}` und `{% endblock %}` Ausdrücke. Nur Inhalte, die in solchen Blöcken liegen, können angepasst
werden.

Außerdem muss das Basis-Template mittels `{% extends "@Contao/('pfad-des-templates')/('name-des-templates') %}`
angegeben werden. Anzupassende Blöcke können dann, wie im originalen Template, durch Einschließen in `{% block
('name-des-blocks') %}` und `{% endblock %}` angegeben und ihre Inhalte überschrieben werden.

Mittels `{{ parent() }}` lässt sich der originale Inhalt des Blocks ausgeben.

Contao unterstützt Euch bei der Vererbung und bei der Verwendung von Blöcken.
Wählst Du eines der neuen Twig-Templates zur Anpassung aus, dann wird Dir das neue Template für die Vererbung so
vorbereitet, dass das Basis-Template bereits angegeben ist. In den Kommentaren findest
Du die verfügbaren Blöcke, die angepasst werden können.

{{% notice note %}}
Informiere Dich auch über die neue [Ordnerstruktur](../verwaltung) bei den Twig-Templates.
{{% /notice %}}

## Templatehierarchie

Wenn Ihr mit der Vererbung von Templates arbeitet, solltet Ihr Euch mit der Templatehierarchie bei
Twig-Templates vertraut machen.

* Template aus dem Core
* Templates aus Erweiterungen
* Templates aus dem Ordner für den Typ des Templates, z.B. `/templates/content_element` (globaler Template-Ordner für
  Inhaltselemente)
* Templates aus dem Ordner für die Varianten eines Templates, z.B. `/templates/content_element/text`
  (Varianten-Ordner für das Inhaltselement `text`)

Wichtig für die Anpassungen im Backend sind die letzten beiden Punkte. Damit besteht die Möglichkeit Templates des
Cores oder aus Erweiterungen einmal grundsätzlich für alle Elemente anzupassen und darauf aufbauend verschiedene
Varianten zu verwenden.

Zusätzlich stehen noch [themespezifische Templates](../verwaltung#themespezifische-templates) zur Verfügung, die aber
nicht zur
Templatehierarchie gehören, weil sie erst zur Laufzeit erzeugt werden.

Beispiel:

Wir legen uns ein neues Template für das Inhaltselement Text an.

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
{# /templates/content_element/text/text_v1.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
    {% block text %}
        {{ parent() }}
        <p>Hier steht ein zusätzlicher Schlusstext für die Variante 1</p>
    {% endblock %}
```

```twig
{# /templates/content_element/text/text_v2.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
    {% block text %}
        {{ parent() }}
        <p>Hier steht ein zusätzlicher Schlusstext für die Variante 2</p>
    {% endblock %}
```
Wird im Backend das Template `content_element/text` ausgewählt, dann wird zu Beginn unseres Textelements der
Text `Einleitender Text für alle Textelemente` ausgegeben.

Wählen wir jetzt das Template `content_element/text/text_v1` aus, dann wird zu Beginn unseres Textelements wieder der
Text `Einleitender Text für alle Textelemente` ausgegeben und zusätzlich am Ende der
Text `Hier steht ein zusätzlicher Schlusstext für die Variante 1`. Zwischen diesen beiden Texten steht der komplette
Text, den wir
im Tiny-MCE eingegeben haben.
Bei Verwendung des Templates `content_element/text/text_v2` gibt es dann den
Schlusstext `Hier steht ein zusätzlicher Schlusstext für die Variante 2`.