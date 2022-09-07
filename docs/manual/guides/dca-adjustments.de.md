---
title: "DCA-Anpassungen"
description: "Eine Liste praktischer DCA Anpassungen."
url: "/de/anleitungen/dca"
aliases:
    - /de/anleitungen/dca/
weight: 12
tags: 
    - "DCA"
---


Das Contao »[Data Container Array](https://docs.contao.org/dev/reference/dca/)« (DCA) bietet zahlreiche, 
praktische Konfigurationsmöglichkeiten. Hier findest du eine Auswahl hilfreicher Beispiele.

Ab Contao 4.9 werden die jeweiligen Anpassungen im Verzeichnis »contao/dca« erwartet. Falls die Verzeichnisse noch 
nicht existieren, musst du diese zunächst erstellen. Für jede Contao-Tabelle benötigst du eine eigene Datei, 
beispielsweise »contao/dca/tl_content.php«. Anschließend mußt du den Anwendungs-Cache über den 
[Contao Manager](/de/installation/contao-manager/) oder über die Konsole neu aufbauen. Dieser Schritt ist nach 
jeder Änderung erforderlich.

{{% notice note %}}
Du kennst weitere, praktische Beispiele? Dann ergänze diese Sammlung mit deinen Informationen. Ausführliche Angaben wie
du zur Dokumentation beitragen kannst [findest du hier](/de/beitragen/).
{{% /notice %}}


{{% expand "HTML in Überschriften erlauben" %}}
```php
// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['fields']['headline']['eval']['allowHtml'] = true;
```
{{% /expand %}}


{{% expand "HTML in News Überschriften bzw. Titel erlauben" %}}
```php
// contao/dca/tl_news.php
$GLOBALS['TL_DCA']['tl_news']['fields']['headline']['eval']['preserveTags'] = true;
```
{{% /expand %}}


{{% expand "HTML im Seitennamen und Seitentitel erlauben" %}}
```php
// contao/dca/tl_page.php

// HTML in Seitennamen
$GLOBALS['TL_DCA']['tl_page']['fields']['title']['eval']['allowHtml'] = true;
// HTML in Seitentitel
$GLOBALS['TL_DCA']['tl_page']['fields']['pageTitle']['eval']['allowHtml'] = true;
```
{{% /expand %}}


{{% expand "HTML in Bildunterschriften erlauben" %}}
```php
// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['fields']['caption']['eval']['allowHtml'] = true;
```
{{% /expand %}}


{{% expand "Ein Feld im Backend ausblenden" %}}
Um das Feld auszublenden, wird die Palette geändert und das Feld aus den Einstellungen der Konfiguration des 
[Moduls Personendaten](/de/layout/modulverwaltung/benutzermodule/#personendaten) entfernt:

```php
// contao/dca/tl_member.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->removeField('company')
    ->applyToPalette('default', 'tl_member')
;

unset($GLOBALS['TL_DCA']['tl_member']['fields']['company']['eval']['feEditable']);
unset($GLOBALS['TL_DCA']['tl_member']['fields']['company']['eval']['feViewable']);
unset($GLOBALS['TL_DCA']['tl_member']['fields']['company']['eval']['feGroup']);
```

Du kannst das Feld aber auch vollständig entfernen:   
```php
// contao/dca/tl_member.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->removeField('company')
    ->applyToPalette('default', 'tl_member')
;

unset($GLOBALS['TL_DCA']['tl_member']['fields']['company']);
```

Beachte: dadurch wird beim nächsten 
[Aktualisieren der Datenbank](/de/installation/contao-installtool/#tabellen-aktualisieren) die Spalte `company` 
zum Löschen vorgeschlagen!
{{% /expand %}}


{{% expand "IDs im Seiten-Baum anzeigen" %}}
```php
// contao/dca/tl_page.php
$GLOBALS['TL_DCA']['tl_page']['list']['label']['fields'][] = 'id';
$GLOBALS['TL_DCA']['tl_page']['list']['label']['format'] = '%s <span style="font-weight:normal; padding-left: 3px;">(IDp: %s)</span>';
```
{{% /expand %}}


{{% expand "IDs im Artikel-Baum anzeigen" %}}
```php
// contao/dca/tl_article.php
$GLOBALS['TL_DCA']['tl_article']['list']['label']['fields'][] = 'id'; 
$GLOBALS['TL_DCA']['tl_article']['list']['label']['format'] = '%s <span style="font-weight:normal; padding-left: 3px;">(%s, IDa: %s)</span>';
```
{{% /expand %}}


{{% expand "Firma zu einem Pflichtfeld in der Mitgliedertabelle machen" %}}
```php
// contao/dca/tl_member.php
$GLOBALS['TL_DCA']['tl_member']['fields']['company']['eval']['mandatory'] = true;
```
{{% /expand %}}


{{% expand "Suche in der Dateiverwaltung ausblenden" %}}
```php
// contao/dca/tl_files.php
unset($GLOBALS['TL_DCA']['tl_files']['list']['sorting']['panelLayout']);
```
{{% /expand %}}


{{% expand "H-Tag in Überschriften einschränken" %}}
```php
// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['fields']['headline']['options']= ['h2','h3']; # Beispiel auf h2 und h3 einschränken
```
{{% /expand %}}


{{% expand "Vorbelegungen Playergrösse" %}}
```php
// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['fields']['playerSize']['default'] = [960,540];
```
{{% /expand %}}


{{% expand "Vorbelegungen Bildeinstellung" %}}
```php
// contao/dca/tl_content.php
// Die Voreinstellungen werden für alle Inhalte mit Bildelementen übernommen. Bild, Galerie

// Vorschaubilder pro Reihe
$GLOBALS['TL_DCA']['tl_content']['fields']['perRow']['default'] = '4';

// Großansicht/Neues Fenster anhaken
$GLOBALS['TL_DCA']['tl_content']['fields']['fullsize']['default'] = '1';

// Vorauswahl Bildabstände in px
$GLOBALS['TL_DCA']['tl_content']['fields']['imagemargin']['default'] = serialize(['unit' => 'px']);

// Sortieren nach individueller Reihenfolge
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'custom'; 
// Sortieren nach Dateiname (aufsteigend)
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'name_asc'; 
// Sortieren nach Dateiname (absteigend)
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'name_desc'; 
// Sortieren nach Datum (aufsteigend)
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'date_asc'; 
// Sortieren nach Datum (absteigend)
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'date_desc'; 
// Sortieren nach zufälliger Reihenfolge
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'random'; 

// Bildgrösse zum Beispiel Exaktes Format Mitte | Mitte
$GLOBALS['TL_DCA']['tl_content']['fields']['size']['default'] = [500,500,'center_center'];
// weitere Variablen für Exaktes Format:
// 'crop', 'left_top', 'left_center', 'left_bottom', 'center_top', 'center_bottom', 'right_top', 'right_center', 'right_bottom'
$GLOBALS['TL_DCA']['tl_content']['fields']['size']['default'] = [150]; # Bildbreite von 150px
$GLOBALS['TL_DCA']['tl_content']['fields']['size']['default'] = [150,150]; # Bildbreite und Bildhöhe von 150px

// Eigene Bildgrössen
$GLOBALS['TL_DCA']['tl_content']['fields']['size']['default'] = [0, 0, 2]; # die '2' ist die ID der Bildgrösse
```
{{% /expand %}}


{{% expand "Anzeige der Artikel Sektion in der Listenansicht der Inhaltselemente" %}}
```php
// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['list']['sorting']['headerFields'][] = 'inColumn';
```
{{% /expand %}}
