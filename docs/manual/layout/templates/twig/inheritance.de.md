---
title: "Template vererben"
description: "Die Template Vererbung."
url: "layout/templates/twig/vererbung"
aliases:
    - /de/layout/templates/twig/vererbung/
weight: 40
---


Contao erlaubt das Vererben von Templates. Dabei kann ein Template nicht nur komplett überschrieben, sondern auch gezielt
einzelne Teilbereiche (Blöcke) angepasst werden. 


### Blöcke anpassen

Zur Gliederung umschließen viele Templates ihre Inhalte bereits in Teilbereiche (Blöcke). 
Nur Inhalte, die in solchen Blöcken liegen, können angepasst werden.

{{< version "4.12" >}}

Um eine bestehende Vorlage zu erweitern (anstatt diese komplett zu ersetzen), verwende das Schlüsselwort `extends`. Anzupassende Blöcke
können dann, wie im originalen Template, durch Einschließen in `{% block name-des-blocks %}` und `{% endblock %}` angegeben 
und ihre Inhalte überschrieben werden.

Mittels `{{ parent() }}` lässt sich der originale Inhalt des Blocks ausgeben.


```twig
{# /templates/fe_page.html.twig #}

{% extends '@Contao/fe_page' %}

{% block main %}
  <h1>Hello from Twig!</h1>
  {{ parent() }}
{% endblock %}
```

{{% notice note %}}
Es ist möglich, PHP-Templates aus den Twig-Templates heraus zu erweitern. Du kannst Twig-Templates aber nicht aus PHP-Templates 
heraus erweitern, nur umgekehrt.
{{% /notice %}}

{{% notice tip %}}
Contao stellt für Twig-Templates spezielle Namensräume zur Verfügung. Detaillierte Informationen findest du [hier](/de/layout/templates/twig/namespace/).
{{% /notice %}}