---
title: "CSS- und JavaScript-Assets"
description: "CSS- und JavaScript-Assets in Templates einsetzen."
url: "layout/templates/assets"
aliases:
    - /de/layout/templates/assets/
weight: 20
---

Oft werden zu einem individuellen Template zusätzliche Assets wie CSS- oder JavaScript-Dateien benötigt. Man kann diese 
Dateien grundsätzlich über das Seitenlayout eines Themes einbinden. Allerdings werden die Assets dann immer geladen 
auch wenn diese auf verschiedenen Seiten gar nicht benötigt werden. Es ist daher sinnvoll diese Dateien im Template 
selbst anzugeben. Hierbei stehen verschiedene Möglichkeiten zur Verfügung. 

Am einfachsten ist es die Dateien in einem öffentlichen Verzeichnis unterhalb von `files` anzulegen 
und dann im Template zu referenzieren:

```php
<link href="files/myfolder/custom.css" rel="stylesheet">
<script src="files/myfolder/custom.js"></script>
```

Alternativ kann man die Assets im Template auch so hinterlegen, das diese z. B. im HTML-Header oder -Footer 
der Seite ausgegeben werden:

```php
$GLOBALS['TL_CSS'][] = 'files/myfolder/custom.css|static';
$GLOBALS['TL_JAVASCRIPT'][] = 'files/myfolder/custom.js|static';
```

Diese Umsetzung bietet weitere Optionen. Mit Angabe von `static` werden die Dateien z. B. zu den bestehenden Assets
eines Seitenlayouts hinzugefügt bzw. diese zusammengefasst. Eine detaillierte Beschreibung aller Optionen findest du 
in der Entwickler-Dokumentation unter [Adding CSS & JavaScript Assets](https://docs.contao.org/dev/framework/asset-management/).
