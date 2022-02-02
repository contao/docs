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


## Vertrauenswürdige Rohdaten

Wenn du absichtlich eine Variable ausgeben möchtest, die reines HTML enthält, wie z. B.  `<b>nett</b>`, musst du den Escape-Filter 
`|raw` der Variablen hinzufügen. Andernfalls wird `&lt;b&gt;nett&lt;/b&gt;` ausgegeben.

{{% notice warning %}}
Denke daran, dass du `|raw` immer nur vertrauenswürdigen Eingaben hinzufügst. Die Verwendung von `|raw` kann ansonsten zu schwerwiegenden XSS-Schwachstellen führen.
{{% /notice %}}