---
title: "Grid-System Einführung"
description: "Ein Grid-System verstehen und einsetzen."
url: "anleitungen/grid"
aliases:
    - /de/anleitungen/grid/
weight: 54
tags: 
   - "Theme"
---

Ein beliebtes Stilmittel ist die inhaltliche Aufteilung in Spalten. Hierbei hat sich der Einsatz von »Grid-Systemen«
etabliert. Der zur Verfügung stehende Bereich wird in eine feste Anzahl von Spalten (Columns) unterteilt. Ein 
fester, äußerer Abstand wird einmal für die Gesamtbreite und dann zwischen den einzelnen Spalten des Rasters (Grid) selbst definiert. 

Möchtest du z. B. bei einem »12-Spalten System« zwei Spalten anzeigen, musst du deinen beiden Bereichen jeweils sechs Grids 
zuordnen. Diese Zuordnung erfolgt über CSS-Klassen.

![Grid Demo](/de/guides/images/de/grid/grid-struktur.jpg?classes=shadow)

Es existieren u. a. »12-spaltige« oder »16-spaltige« Umsetzungen. Manche sind »pixelbasierend«, andere »prozentual«. 
Auch die Abstandsbreite kann bei verschiedenen Systemen variieren. Letztlich handelt es sich um CSS-Angaben 
die eine definierte HTML-Struktur entsprechend darstellen.

Die ersten Lösungen erfolgten über [CSS-float](https://developer.mozilla.org/de/docs/Web/CSS/float). Der Vorteil 
hierbei ist die Unterstützung älterer Browser-Versionen. Es folgten Realisierungen via
[CSS-flexbox](https://developer.mozilla.org/en-US/docs/Web/CSS/flex) und mittlerweile existiert die 
[CSS-grid](https://developer.mozilla.org/de/docs/Web/CSS/grid) Eigenschaft selbst. Die Unterstützung ist in den gängigen, 
aktuellen Browser-Versionen vorhanden.

Häufig findest du die Bezeichnung »responsive« Grid vor. Darunter ist nicht allein die variable Breitenanpassung 
der einzelnen Spalten in Abhängigkeit von der Gesamtbreite zu verstehen. Du kannst hiermit gezielt die Spaltenanzahl
selbst kontrollieren. Beispielsweise kann der Inhalt auf einem Desktop »4-spaltig«, beim Tablet »2-spaltig« und auf 
einem Smartphone »1-spaltig« angezeigt werden.


## Das Contao-Grid

Das Contao-Grid wurde bereits mit der [Contao Version 3.0](https://contao.org/de/news/contao_3-0-RC1.html) eingeführt 
und basiert auf [960.gs](https://github.com/nathansmith/960-grid-system/). Die Umsetzung (via 
[CSS-float](https://developer.mozilla.org/de/docs/Web/CSS/float)) ist »pixelbasierend« mit 12-Spalten wobei
die Abstandsbreite via [CSS-margin](https://developer.mozilla.org/de/docs/Web/CSS/margin) jeweils 10 Pixel beträgt.

Die Gesamtbreite von 960 Pixel mit zwei »Breakpoints« bei `kleiner 980 Pixel` 
und `kleiner 768 Pixel` ist fest vorgegeben. Als CSS-Klassen stehen die Bezeichnungen von »grid1 bis grid12« und 
»offset1 bis offset12« zur Verfügung. 

Die CSS-Datei findest du zur Ansicht im Verzeichnis `assets/contao/css/grid.min.css` bzw. `grid.css`. Dieser kannst
du auch entnehmen unter welchen Bedingungen u. a. die Abstände gesetzt werden:

- Float und Margin für alle Elemente deren Klasse die Bezeichnung »grid« enthält
- Margin für alle Elemente innerhalb von »mod\_article« wenn sie eine Klasse beginnend mit »ce\_« oder »mod\_« enthalten
- Kein Margin für »mod\_article« mit zusätzlicher »grid« Bezeichnung.

Das Contao-Grid kann über dein [Seitenlayout]({{< ref "manage-page-layouts.de.md" >}}) im Bereich 
»CSS-Framework > 12-Spalten Grid« eingebunden werden. 

Zur »2-spaltigen« Darstellung zweier Inhaltselemente vom Typ »Text« kannst du die CSS-Klasse »grid6« dann jeweils im 
Bereich »Experteneinstellungen > CSS-ID/Klasse« eintragen. Oberhalb von 768 Pixel werden die Inhaltselemente immer
»2-spaltig« dargestellt und unterhalb von 768 Pixel dann »1-spaltig«.

{{% notice note %}}
Das in die Jahre gekommene Contao-Grid funktioniert mit obigen Einschränkungen. Empfohlen wird aber die Nutzung einer 
aktuellen Grid-Lösung. Als Alternative stehen hierzu [zahlreiche Erweiterungen](https://extensions.contao.org/?q=grid) zur 
einfachen [Installation]({{< ref "install-extensions.de.md" >}}) zur Verfügung. 
{{% /notice %}}
