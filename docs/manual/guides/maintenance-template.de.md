---
title: "Wartungstemplate anpassen"
description: "Wartungstemplate updatesicher anpassen"
url: "anleitungen/wartungstemplate-anpassen"
aliases:
    - /de/anleitungen/wartungstemplate-anpassen/
weight: 10
tags: 
   - "Wartungstemplate"
---

## Wartungsmodus aktivieren

Der Wartungsmodus lässt sich über den Menüpunkt Systemwartung aktivieren. Sobald du dich aus dem Backend abgemeldet hast und deine Website im Frontend aufrufst, sieht das dann so aus:

![Contao Wartungsmodus]({{% asset "images/manual/guides/de/maintenance/wartungsmodus.jpg" %}}?classes=shadow)

Im Core von Contao 4.9 sind für die Frontendausgabe im Wartungsmodus folgende Dateien zuständig:

- `service_unavailable.html.twig` - Wartungstemplate
- `layout.html.twig` - Layoutemplate für alle Errortemplates
- `exception.xlf` - Sprachdateien für Fehlermeldungen


## Texte des Wartungstemplates anpassen

Wir wollen zunächst die Textausgabe für den Wartungsmodus anpassen.

Die Textausgabe für die Wartungsseite wird über Sprachvariablen gesteuert. Die originalen Sprachdateien findest du unter:
`vendor/contao/core-bundle/src/Resources/contao/languages`.

Für alle Fehlermeldungen ist das die Datei `exception.xlf`.

Wir sehen uns zunächst das Wartungstemplate `service_unavailable.html.twig` genauer an.

```html
{% trans_default_domain 'contao_exception' %}
{% extends "@ContaoCore/Error/layout.html.twig" %}
{% block title %}
{{ 'XPT.unavailable'|trans }}
{% endblock %}
{% block matter %}
<p>{{ 'XPT.maintenance'|trans }}</p>
{% endblock %}
```

Dort finden wir die Sprachvariable `XPT.unavailable` und `XPT.maintenance`. Diese suchen wir uns jetzt in der `exception.xlf`.

Nun erstellen wir eine neue Datei mit dem Namen `exception.xlf` und legen diese unter `/contao/languages/de/` ab, kopieren die benötigten Zeilen aus der originalen `exception.xlf` und passen die Texte nach unseren Wünschen an.

{{% notice note %}}
Sollte der Ordner `/contao` noch nicht vorhanden sein, muss dieser und die entsprechenden Unterordner angelegt werden.
{{% /notice %}}

Beispiel für eine angepasste Sprachdatei:

```xml
<?xml version="1.0" ?><xliff version="1.1">
  <file>
    <body>
      <trans-unit id="XPT.unavailable">
        <target>Wartungsmodus</target>
      </trans-unit>
      <trans-unit id="XPT.maintenance">
        <target>Die Webseite ist deshalb zur Zeit nicht verfügbar. Bitte versuchen Sie es später noch einmal. Wir bemühen uns die Wartungsarbeiten so schnell wie möglich zu beenden.</target>
      </trans-unit>
    </body>
  </file>
</xliff>
```

Alternativ kann auch die PHP Notation verwendet werden. Dazu legst du eine `exception.php` an, die dann ungefähr so aussieht:

```php
$GLOBALS['TL_LANG']['XPT']['unavailable'] = 'Wartungsmodus';
$GLOBALS['TL_LANG']['XPT']['maintenance'] = 'Hier kann beliebieger Text stehen';
```

Damit die neuen Texte nun sichtbar werden, muss der Produktions-Cache über den Contao Manager oder die Kommandozeile geleert werden.

Natürlich lassen sich auch noch weitere Texte wie z. B. die Fußzeile per `XPT.hint` überschreiben.

{{% notice note %}}
WICHTIG: Alle Änderungen wirken sich sowohl beim Wartungstemplate als auch auf alle anderen Errortemplates von Contao aus.
{{% /notice %}}


## Logo anpassen

Das machen wir in diesem Beispiel für alle Errortemplates. Für eine updatesichere Anpassung kopieren wir uns das Originaltemplate `vendor/contao/core-bundle/src/Resources/views/Error/layout.html.twig` nach `/templates/bundles/ContaoCoreBundle/Error/`

In Contao 5.1 befindet sich das Originaltemplate unter `vendor/contao/core-bundle/templates/Error/layout.html.twig`

Dort setzen wir unser eigenes Logo innerhalb des DIV's mit der Klasse `header-logo` ein. Du kannst dafür ein normales image-Tag verwenden oder wie im Originaltemplate ein Inline-SVG.

Beispiel für ein angepasstes Logo:

```html
{% trans_default_domain 'contao_exception' %}
<!DOCTYPE html>
<html lang="{{ language }}">
...
<body>
<div id="header">
    <div class="wrap">
        <div class="header-logo">
            <img src="files/layout/images/logo.png" alt="Mein Logo">
        </div>
    </div>
</div>
...
</body>
</html>
```

Damit die Änderungen sichtbar werden, muss zum Schluss der Produktions-Cache über den Contao Manager oder die Kommandozeile geleert werden.

Weitere Informationen zur Anpassung von Twigtemplates findest du in der [Twig-Dokumentation von Symfony](https://twig.symfony.com/doc/3.x/)


## Komplettes Wartungstemplate überschreiben

Anstatt nur einzelne Texte anzupassen, kannst du auch einfach das komplette Template `service_unavailable.html.twig` mit deinem eigenen HTML und CSS überschreiben.
Damit das ganze updatesicher ist, musst du die Datei in den Ordner `/templates/bundles/ContaoCoreBundle/Error/` speichern.

Zum Schluss muss auch hier der Produktions-Cache erneuert werden.
