---
title: "CSS- und JavaScript-Assets"
description: "CSS- und JavaScript-Assets in Templates einsetzen."
url: "layout/templates/twig/assets"
aliases:
    - /de/layout/templates/twig/assets/
weight: 30
---


Oft werden zu einem individuellen Template zusätzliche Inhalte (»Assets«) wie CSS- oder JavaScript-Dateien benötigt.
Man kann diese Dateien grundsätzlich über das Seitenlayout eines Themes einbinden, allerdings werden sie dann immer
geladen, egal ob sie auf einer Seite benötigt werden oder nicht. Es kann daher sinnvoll sein, Assets an spezifische
Templates zu binden.


#### Assets einbinden

Am einfachsten ist es, die Dateien in einem öffentlichen Verzeichnis unterhalb von `/files` anzulegen und dann im
Template zu referenzieren:

```twig
<link href="files/myfolder/custom.css" rel="stylesheet">
<script src="files/myfolder/custom.js"></script>
```