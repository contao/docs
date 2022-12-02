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


## Vertrauenswürdige Inhalte

Wenn du absichtlich eine Variable ausgeben möchtest, die HTML beinhaltet, musst du den 
[Filter](https://twig.symfony.com/doc/3.x/filters/raw.html) `|raw` der Variable hinzufügen. Denke daran, dass du **nie** `|raw` verwenden 
solltest, wenn du den Daten nicht vertraust, da dies sonst eine XSS-Schwachstelle verursacht. 

Ein typischer Anwendungsfall, bei dem es in Ordnung ist `|raw` zu verwenden, ist die Eingabe von Inhalten über den TinyMCE-Editor. Contao 
überprüft bereits die Benutzereingaben (basierend auf den Sanitizer-Einstellungen), bevor die Daten an das Template weiter gegeben werden.

Im folgenden Beispiel hat eine Kontextvariable `text` den Inhalt `<p>Mein<br>Text</p>`, während eine Variable `user_input` den 
Inhalt `<script>alert('Ich bin unsicher!');</script>` enthält. Beachte, dass das Hinzufügen von `|raw` im letzten Beispiel gefährlich ist, 
während es im zweiten Beispiel in Ordnung ist:

```twig
{{ text }}
{# outputs: "&lt;p&gt;Mein&lt;br&gt;Text&lt;/p&gt;" #}

{{ text|raw }}
{# outputs: "<p>Mein<br>Text</p>" #}

{{ user_input|raw }}
{# outputs the potentially dangerous: "<script>alert('Ich bin unsicher!');</script>" #}
```


### Twig Filter und Insert-Tags

In Inhaltselementen, beispielsweise vom »Typ« Text, werden u. U. [Insert-Tags](/de/artikelverwaltung/insert-tags/) verwendet. Hierzu werden 
zusätzlich die Filter `|insert_tag` und `|insert_tag_raw` bereit gestellt. 

Beispiel: Das Inhaltselement vom Typ »Text« beinhaltet folgenden Eintrag (mit dem Insert-Tag `{{br}}`): `<p>Meine<br>Text{{br}}Demo</p>`. 
Über diese Twig Filter kannst du die Ausgabe gezielt beeinflussen:

```twig
{{ text }}
{# Do not replace insert tags, encode #}
{# yields: "&lt;p&gt;Meine&lt;br&gt;Text{{br}}Demo&lt;/p&gt;" #}

{{ text|raw }}
{# Do not replace insert tags, do not encode #}
{# yields: "<p>Meine<br>Text{{br}}Demo</p>" #}

{{ text|insert_tag }}
{# Replace insert tags, encode everything #}
{# yields: "&lt;p&gt;Meine&lt;br&gt;Text&lt;br&gt;Demo&lt;/p&gt;" #}

{{ text|insert_tag_raw }}
{# Replace insert tags, but *only* encode the text around #}
{# yields: "&lt;p&gt;Meine&lt;br&gt;Text<br>Demo&lt;/p&gt;" (note the intact "<br>") #}

{{ text|insert_tag|raw }}
{# Replace insert tags, do not encode #}
{# yields: "<p>Meine<br>Text<br>Demo</p>" #}

```