---
title: "CSS- und JavaScript-Assets"
description: "CSS- und JavaScript-Assets in Templates einsetzen."
url: "layout/templates/assets"
aliases:
    - /de/layout/templates/assets/
weight: 20
---

Oft werden zu einem individuellen Template zusätzliche Inhalte (»Assets«) wie CSS- oder JavaScript-Dateien benötigt.
Man kann diese Dateien grundsätzlich über das Seitenlayout eines Themes einbinden, allerdings werden sie dann immer
geladen, egal ob sie auf einer Seite benötigt werden oder nicht. Es kann daher sinnvoll sein, Assets an spezifische
Templates zu binden.

#### Assets einbinden

Am einfachsten ist es, die Dateien in einem öffentlichen Verzeichnis unterhalb von `/files` anzulegen und dann im
Template zu referenzieren:

```php
<link href="files/myfolder/custom.css" rel="stylesheet">
<script src="files/myfolder/custom.js"></script>
```

Sollen die Dateien stattdessen im HTML-Header eingebunden werden, so lässt sich das mit folgendem PHP-Code im Template
anweisen:

```php
<?php
// wird in <head> ausgegeben
$GLOBALS['TL_CSS'][] = 'files/myfolder/custom.css|static';
$GLOBALS['TL_JAVASCRIPT'][] = 'files/myfolder/custom.js|static';
?>
```

Diese Umsetzung bietet weitere Optionen: Mit Angabe von `|static` werden die Dateien z.&nbsp;B. zu den bestehenden
Assets eines Seitenlayouts hinzugefügt bzw. zusammengefasst. Eine detaillierte Beschreibung aller Optionen und
Ausgabeorte findest du in der Entwickler-Dokumentation unter [Adding CSS & JavaScript Assets](https://docs.contao.org/dev/framework/asset-management/).


#### Twig Template Unterstützung

{{< version "4.13" >}}

Bei der Nutzung von Twig Templates stehen die Optionen zwecks kombinierter Einbindung im HTML-Header nicht zur Verfügung.