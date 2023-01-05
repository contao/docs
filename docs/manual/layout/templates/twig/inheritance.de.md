---
title: "Template vererben"
description: "Die Template Vererbung."
url: "layout/templates/twig/vererbung"
aliases:
    - /de/layout/templates/twig/vererbung/
weight: 40
---

Contao setzt mit den Twig konsequent auf das Vererben von Templates. Dabei wird ein Template nicht komplett
überschrieben, sondern nur gezielt
einzelne Teilbereiche (Blöcke) angepasst.

## Blöcke anpassen
Zur Gliederung umschließen die Twig Templates ihre Inhalte bereits in ein oder mehreren Blöcken `{% block
('name-des-blocks') %}` und `{% endblock %}` Ausdrücke. Nur Inhalte, die in solchen Blöcken liegen, können angepasst 
werden.

Außerdem muss das Basis-Template mittels `{% extends "@Contao/('pfad-des-templates')/('name-des-templates') %}`
angegeben werden. Anzupassende Blöcke können dann, wie im originalen Template, durch Einschließen in `{% block
('name-des-blocks') %}` und `{% endblock %}` angegeben und ihre Inhalte überschrieben werden.

Mittels `{{ parent() }}` lässt sich der originale Inhalt des Blocks ausgeben.

Contao unterstützt Euch auch dabei. Willst Du eines der neuen Twig-Templates anpassen, dann wird Dir das neue 
Template für die Vererbung so vorbereitet, dass das Basis Template bereits angegeben ist. In den Kommentaren findest 
Du die verfügbaren Blöcke, die angepasst werden können.