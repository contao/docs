---
title: "Nutzung von SVG-Dateien"
description: "Praktische Informationen zur Einbindung von SVG-Dateien."
url: "anleitungen/svg"
aliases:
    - /de/anleitungen/svg/
weight: 60
hidden: true
tags: 
    - "Theme"
    - "Template"    
---

Die Nutzung von Dateien im [SVG-Format](https://developer.mozilla.org/en-US/docs/Web/SVG) bietet zahlreiche Vorteile. 
Als reines Vektorformat werden diese, im Gegensatz zu anderen Formaten, verlustfrei skaliert. Häufig werden SVG-Dateien 
daher zur Darstellung des Logo's oder von Symbolen eingesetzt.

Du möchtest deine SVG-Datei in Contao einsetzen?<br>
Für unser Beispiel verwenden wir das Contao-Logo im SVG-Format (`contao.svg`):

```html
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M45.4 305c14.4 67.1 26.4 129 68.2 175H34c-18.7 0-34-15.2-34-34V66c0-18.7 15.2-34 34-34h57.7C77.9 44.6 65.6 59.2 54.8 75.6c-45.4 70-27 146.8-9.4 229.4zM478 32h-90.2c21.4 21.4 39.2 49.5 52.7 84.1l-137.1 29.3c-14.9-29-37.8-53.3-82.6-43.9-24.6 5.3-41 19.3-48.3 34.6-8.8 18.7-13.2 39.8 8.2 140.3 21.1 100.2 33.7 117.7 49.5 131.2 12.9 11.1 33.4 17 58.3 11.7 44.5-9.4 55.7-40.7 57.4-73.2l137.4-29.6c3.2 71.5-18.7 125.2-57.4 163.6H478c18.7 0 34-15.2 34-34V66c0-18.8-15.2-34-34-34z"/></svg>
```

Kopiere die SVG-Datei hierzu in ein als »Öffentlich« gekennzeichnetes Verzeichnis unterhalb von »files«. Genau wie bei 
anderen Bild-Formaten wird dir innerhalb der [Dateiverwaltung](/de/dateiverwaltung/) eine Vorschau angezeigt.

Anschließend kannst du deine SVG-Datei u. a. im Inhaltselement vom Typ "Bild" auswählen. Optional können hier auch 
die Einstellungen für die »[Bildgröße](/de/artikelverwaltung/inhaltselemente/#bild)«, analog zu anderen Bild-Formaten, 
festgelegt werden. Contao erstellt folgenden Quelltext:

```html
<div class="ce_image first last block">
  <figure class="image_container">
    <img src="files/myfolder/myfile.svg" alt="" itemprop="image">
  </figure>
</div>
```

Mit unterschiedlichen Einstellungen der »[Bildgröße](/de/artikelverwaltung/inhaltselemente/#bild)« 
erhalten wir z. B. folgende Darstellung(en) über das »`img`« HTML-Element:

![SVG Contao Brand 40px](/de/guides/images/de/svg/contao.svg?width=40px)
![SVG Contao Brand 60px](/de/guides/images/de/svg/contao.svg?width=60px)
![SVG Contao Brand 80px](/de/guides/images/de/svg/contao.svg?width=80px)
![SVG Contao Brand 100px](/de/guides/images/de/svg/contao.svg?width=100px)


## Alternative Einbindung«

Die Einbindung von SVG-Dateien über das HTML-Element »`img`« ist eine Variante. Weitere Möglichkeiten ergeben sich, 
wenn du die SVG-Datei »`inline`« einsetzt.