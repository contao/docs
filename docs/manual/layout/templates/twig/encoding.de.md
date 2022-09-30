---
title: "Kodierung / Escaping"
description: "Informationen zu Kodierung / Escaping."
url: "layout/templates/twig/encoding"
aliases:
    - /de/layout/templates/twig/encoding/
weight: 70
---


Aus historischen Gründen verwendet Contao die *Eingabe*-Kodierung, aber Twig verwendet die vernünftigere *Ausgabe*-Kodierung. 
Du kannst mehr über das Thema (und warum die Ausgabekodierung bevorzugt werden sollte) in 
diesem [OWASP-Artikel](https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html#rule-0-never-insert-untrusted-data-except-in-allowed-locations) über Verhinderung von Cross Site Scripting (XSS) Angriffen lesen.


## Warum dich das interessieren sollte

Das Wesentliche: Als Vorlagendesigner musst du entscheiden, wie Dinge ausgegeben werden sollen, denn *du* kennst den Kontext und weißt, 
welchen Inhalten du vertrauen kannst oder nicht. Die *exakt gleichen* Daten können in einem Kontext gefährlich und in einem anderen harmlos sein:

Mit Twig können wir genau festlegen, wie eine bestimmte Variable behandelt werden soll. Verwende dazu den 
[Filter](https://twig.symfony.com/doc/3.x/filters/escape.html) `|escape` oder kurz `|e`:

```twig
<style>
  .box { background: {{ color|e('css') }} }
</style>

[…]

<div class="box">{{ color|e('html') }}</div>
```

{{% notice note %}}
Standardmäßig kodiert Twig **alle** Variablen. Die gewählte Escaper Strategie hängt von der Dateierweiterung der Vorlage ab: Deine 
`.html.twig` Vorlagen werden automatisch mit `|e('html')` behandelt, so dass du diesen Teil im obigen Beispiel weglassen könntest.
{{% /notice %}}

Mit dem [autoescape](https://twig.symfony.com/doc/3.x/tags/autoescape.html) Tag kannst du einen ganzen Abschnitt so markieren, 
dass er escaped wird oder nicht.


## Vertrauenswürdige Rohdaten

Wenn du absichtlich eine Variable ausgeben möchtest, die reines HTML enthält musst du den 
[Filter](https://twig.symfony.com/doc/3.x/filters/raw.html) `|raw` der Variablen hinzufügen. 

In Zusammenhang mit »Contao Insert-Tags« existieren zusätzlich die Filter `|insert_tag` und `|insert_tag_raw`. Benutzt du in einem 
Inhaltselement vom Typ »Text« z. B. den Insert-Tag `{{br}}`, kannst du über die Twig Filter die Ausgabe beeinflussen.


```twig
{% extends "@Contao/content_element/text.html.twig" %}

{% block content %}

  {# Do not replace insert tags, encode #}
  {{ text }}
  {# yields: "&lt;p&gt;my{{br}}text&lt;/p&gt;" #}

  {# Do not replace insert tags, do not encode  #}
  {{ text|raw }}
  {# yields: "<p>my{{br}}text</p>" #}

  {# Replace insert tags, encode everything #}
  {{ text|insert_tag }}
  {# yields: "&lt;p&gt;my&lt;br&gt;text&lt;/p&gt;"#}

  {# Replace insert tags, but *only* encode the text around the insert tags #}
  {{ text|insert_tag_raw }}
  {# yields: "&lt;p&gt;my<br>text&lt;/p&gt;" (note the intact "<br>") #}

{% endblock %}
```

{{% notice warning %}}
Denke daran, dass du `|raw` immer nur vertrauenswürdigen Eingaben hinzufügst. Die Verwendung von `|raw` kann ansonsten zu 
schwerwiegenden XSS-Schwachstellen führen.
{{% /notice %}}