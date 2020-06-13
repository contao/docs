---
title: "Einsatz von SVG-Dateien"
description: "Praktische Informationen zur Einbindung von SVG-Dateien."
url: "anleitungen/svg"
aliases:
    - /de/anleitungen/svg/
weight: 60
tags: 
    - "Theme"
    - "Template"    
---

## Die »SVG-Datei«

Die Nutzung von Dateien im [SVG-Format](https://developer.mozilla.org/en-US/docs/Web/SVG) bietet zahlreiche Vorteile. 
Als reines Vektorformat werden diese, im Gegensatz zu anderen Formaten, verlustfrei skaliert. Häufig werden SVG-Dateien 
daher zur Darstellung eines Logo's oder von Symbolen eingesetzt.

Du möchtest deine SVG-Datei in Contao einsetzen?<br>
Für unser Beispiel verwenden wir das Contao-Logo im SVG-Format (`contao.svg`):

```html
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
<path d="M45.4 305c14.4 67.1 26.4 129 68.2 175H34c-18.7 0-34-15.2-34-34V66c0-18.7 15.2-34 34-34h57.7C77.9 44.6 65.6 59.2 54.8 75.6c-45.4 70-27 146.8-9.4 229.4zM478 32h-90.2c21.4 21.4 39.2 49.5 52.7 84.1l-137.1 29.3c-14.9-29-37.8-53.3-82.6-43.9-24.6 5.3-41 19.3-48.3 34.6-8.8 18.7-13.2 39.8 8.2 140.3 21.1 100.2 33.7 117.7 49.5 131.2 12.9 11.1 33.4 17 58.3 11.7 44.5-9.4 55.7-40.7 57.4-73.2l137.4-29.6c3.2 71.5-18.7 125.2-57.4 163.6H478c18.7 0 34-15.2 34-34V66c0-18.8-15.2-34-34-34z"/>
</svg>
```

Kopiere die SVG-Datei hierzu in ein als »Öffentlich« gekennzeichnetes Verzeichnis unterhalb von »files«. Genau wie bei 
anderen Bild-Formaten wird dir innerhalb der [Dateiverwaltung](/de/dateiverwaltung/) eine Vorschau angezeigt.

Anschließend kannst du die SVG-Datei u. a. im [Inhaltselement](/de/artikelverwaltung/inhaltselemente/) vom Typ "Bild" 
auswählen. Optional können hier auch die Einstellungen für die »[Bildgröße](/de/artikelverwaltung/inhaltselemente/#bild)«, 
analog zu anderen Bild-Formaten, festgelegt werden. Contao erstellt folgenden Quelltext:

```html
<div class="ce_image first last block">
  <figure class="image_container">
    <img src="files/myfolder/myfile.svg" alt="" itemprop="image">
  </figure>
</div>
```

Mit unterschiedlichen Einstellungen der »[Bildgröße](/de/artikelverwaltung/inhaltselemente/#bild)« 
erhalten wir folgende Darstellung(en) über das »`img`« HTML-Element:

![SVG Contao Brand 40px](/de/guides/images/de/svg/contao-gray.svg?width=40px)
![SVG Contao Brand 60px](/de/guides/images/de/svg/contao-gray.svg?width=60px)
![SVG Contao Brand 80px](/de/guides/images/de/svg/contao-gray.svg?width=80px)
![SVG Contao Brand 100px](/de/guides/images/de/svg/contao-gray.svg?width=100px)


## Die »inline« Alternative

Die Einbindung von SVG-Dateien über das HTML-Element »`img`« ist eine Variante. Weitere Möglichkeiten ergeben sich, 
wenn du die SVG-Datei »`inline`« einsetzt. Der Inhalt der SVG-Datei »`<svg>...</svg>`« wird dabei direkt im 
HTML-Quelltext hinterlegt. In dieser Form kannst du dann die Darstellung mit CSS-Angaben beeinflussen.

Zur Umsetzung benutzen wir ein [Template](/de/layout/templates) zusammen mit dem 
[Insert-Tag](/de/artikelverwaltung/insert-tags/#include-elemente) `{{file::*}}`. Erstelle dir ein neues 
Template »mysvgicon.html5« im Verzeichnis »mysvgfolder« unterhalb des Verzeichnis »Templates« und kopiere den vollständigen 
SVG-Code in die Template-Datei. 

Anschließend kannst du die Datei in einem [Inhaltselement](/de/artikelverwaltung/inhaltselemente/) über das 
Insert-Tag `{{file::/mysvgfolder/mysvgicon.html5}}` einbinden und mit CSS-Angaben kontrollieren. Die Ausgabe 
bei Nutzung innerhalb des Inhaltslement vom Typ »Text« (verkürzt):

```html
<div class="ce_text first block">
  <p>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> . . . </svg>
  </p>
</div>
```

{{% notice tip %}}
Im Gegensatz zu den Contao eigenen Template-Dateien kannst du hierbei diese Dateien in beliebig verschachtelte Verzeichnisse
unterhalb von »Templates« legen. Die relativen Pfadangaben definierst du im Insert-Tag.
{{% /notice %}}


## SVG über CSS colorisieren

Du könntest unser Beispiel mit der CSS-Angabe »svg { fill: #ff0000; }« einfärben. Allerdings möchten wir lieber
die CSS-Eigenschaft `color` verwenden. Hierzu ergänzen wir den SVG-Code im Template mit der Eigenschaft `fill` 
und dem Wert `currentcolor`:

```html
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
<path fill="currentcolor" d="M45.4 305c14.4 67.1 26.4 129 68.2 175H34c-18.7 0-34-15.2-34-34V66c0-18.7 15.2-34 34-34h57.7C77.9 44.6 65.6 59.2 54.8 75.6c-45.4 70-27 146.8-9.4 229.4zM478 32h-90.2c21.4 21.4 39.2 49.5 52.7 84.1l-137.1 29.3c-14.9-29-37.8-53.3-82.6-43.9-24.6 5.3-41 19.3-48.3 34.6-8.8 18.7-13.2 39.8 8.2 140.3 21.1 100.2 33.7 117.7 49.5 131.2 12.9 11.1 33.4 17 58.3 11.7 44.5-9.4 55.7-40.7 57.4-73.2l137.4-29.6c3.2 71.5-18.7 125.2-57.4 163.6H478c18.7 0 34-15.2 34-34V66c0-18.8-15.2-34-34-34z"/>
</svg>
```

In deinen CSS-Angaben könnest du jetzt folgendes verwenden:

```css
.ce_text {
  color: #000000;
}
```

Das Schlüsselwort [currentcolor](https://developer.mozilla.org/de/docs/Web/CSS/Farben#currentColor_Schl%C3%BCsselwort) 
folgt dabei der CSS-Kaskade. Daher übernimmt unser SVG-Symbol den Farbwert des übergeodneten »div« Blocks mit der
CSS-KLasse »ce_text«. Wenn du gezielt das SVG-Symbol ändern möchtest:

```css
.ce_text {
  color: #000000;
}

.ce_text svg {
  color: #f47c00;
}
```

![SVG Contao Brand Color Orange 100px](/de/guides/images/de/svg/contao-orange.svg?width=100px)


## Das »{{file::*}}« Insert-Tag mit Argument

Mit CSS kannst du deine »inline« verwendeten SVG-Dateien farblich gestalten. Du möchtest ohne weitere CSS Anpassungen 
gezielt eine SVG-Datei über das [Inhaltselement](/de/artikelverwaltung/inhaltselemente/) 
ändern? 

Das [Insert-Tag](/de/artikelverwaltung/insert-tags/#include-elemente) `{{file::*}}` unterstützt die Übergabe von 
Argumenten. Du kannst hierüber z. B. den Farbwert definieren:

`{{file::/mysvgfolder/mysvgicon.html5?color=#ff0000}}`

In der Template Datei ersetzen wir den Wert der Eigenschaft `fill` mit einer PHP-Abfrage. Wird ein übergebenes Argument 
gefunden wird dieses eingetragen, ansonsten bleibt es beim Schlüsselwort `currentcolor`. Deine CSS-Angaben werden
hiermit im entsprechenden Inhaltselement gezielt überschrieben.

```php
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
<path fill="<?= (is_null(\Contao\Input::get('color')) ? 'currentColor' : \Contao\Input::get('color')) ?>" 
d="M45.4 305c14.4 67.1 26.4 129 68.2 175H34c-18.7 0-34-15.2-34-34V66c0-18.7 15.2-34 34-34h57.7C77.9 44.6 65.6 59.2 54.8 75.6c-45.4 70-27 146.8-9.4 229.4zM478 32h-90.2c21.4 21.4 39.2 49.5 52.7 84.1l-137.1 29.3c-14.9-29-37.8-53.3-82.6-43.9-24.6 5.3-41 19.3-48.3 34.6-8.8 18.7-13.2 39.8 8.2 140.3 21.1 100.2 33.7 117.7 49.5 131.2 12.9 11.1 33.4 17 58.3 11.7 44.5-9.4 55.7-40.7 57.4-73.2l137.4-29.6c3.2 71.5-18.7 125.2-57.4 163.6H478c18.7 0 34-15.2 34-34V66c0-18.8-15.2-34-34-34z"/>
</svg>
```

![SVG Contao Brand Color red 100px](/de/guides/images/de/svg/contao-red.svg?width=100px)