---
title: "Template-Daten anzeigen"
description: "Alle Template-Daten anzeigen."
url: "layout/templates/twig/data"
aliases:
    - /de/layout/templates/twig/data/
weight: 60
---


Zur Anzeige der Daten in einer Vorlage, kannst du die  `dump()`-Funktion verwenden. 
Wenn du nur die Daten von bestimmten Variablen benötigst, kannst du diesen als Argument übergeben:

```twig
{{ dump() }} {# Ausgabe aller verfügbaren Daten #}
{{ dump(a) }} {# Ausgabe der Daten der Variable "a" #}
{{ dump(a, b) }} {# Ausgabe der Daten der Variable "a"  und "b" #}
```
{{% example "Ausgabe der Überschrift des Textelementes" %}}
```twig
{# /templates/content_element/text.html.twig #}
{% extends "@Contao/content_element/text.html.twig" %}
    {% block text %}
        {{ dump(headline) }}
    {% endblock %}
```
{{% /example %}}

{{% notice info %}}
Beachte, dass in erweiterten Templates die `dump()`-Funktion innerhalb eines Blockes verwendet werden muss.
{{% /notice %}}


{{% notice warning %}}
Da die ausgewerteten Daten sicherheitskritische Informationen über das System enthalten können, ist dies nur möglich, wenn der 
[Debug-Modus](/de/system/debug-modus/) aktiviert ist.
{{% /notice %}}

