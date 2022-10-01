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


## Vertrauenswürdige Inhalte

Wenn du absichtlich eine Variable ausgeben möchtest, die HTML beinhaltet, musst du den 
[Filter](https://twig.symfony.com/doc/3.x/filters/raw.html) `|raw` der Variablen hinzufügen. Denke daran, dass du `|raw` immer 
nur in Verbindung mit vertrauenswürdigen Inhalten verwenden solltest. In Zusammenhang mit Eingaben über den TinyMCE-Editor im Backend kannst du in diesem speziellen 
Fall jedoch den `|raw` Filter durchaus verwenden. 

Beispiel: Das Inhaltselement vom Typ »Text« beinhaltet folgenden Eintrag `<p>Mein<br>Text</p>`:

```twig
{% extends "@Contao/content_element/text.html.twig" %}

{% block content %}

  {# encode #}
  {{ text }}
  {# yields: "&lt;p&gt;Mein&lt;br&gt;Text&lt;/p&gt;" #}

  {# do not encode #}
  {{ text|raw }}
  {# yields: "<p>Mein<br>Text</p>" #}

{% endblock %}
```

### Twig Filter und Insert-Tags

In Inhaltselementen, beispielsweise vom »Typ« Text, werden u. U. [Insert-Tags](/de/artikelverwaltung/insert-tags/) verwendet. Hierzu werden zusätzlich die Filter 
`|insert_tag` und `|insert_tag_raw` bereit gestellt. 

Beispiel: Das Inhaltselement vom Typ »Text« beinhaltet folgenden Eintrag (mit dem Insert-Tag `{{br}}`): `<p>Meine<br>Text{{br}}Demo</p>`. 
Über diese Twig Filter kannst du die Ausgabe gezielt beeinflussen:

```twig
{% extends "@Contao/content_element/text.html.twig" %}

{% block content %}

  {# encode #}
  {{ text|insert_tag }}
  {# yields: "&lt;p&gt;Meine&lt;br&gt;Text&lt;br&gt;Demo&lt;/p&gt"#}

  {# do not encode): #}
  {{ text|insert_tag|raw }}
  {# yields: "<p>Meine<br>Text<br>Demo</p>" #}    

  {# only encode content around the insert tag #}
  {{ text|insert_tag_raw }}
  {# yields: "&lt;p&gt;Meine&lt;br&gt;Text<br>Demo&lt;/p&gt;" (note the intact "<br>") #}

{% endblock %}
```