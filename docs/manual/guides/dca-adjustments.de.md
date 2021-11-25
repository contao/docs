---
title: "DCA Anpassungen"
description: "Eine Liste praktischer DCA Anpassungen."
url: "anleitungen/dca"
aliases:
    - /de/anleitungen/dca/
weight: 12
tags: 
    - "DCA"
---


Das Contao »[Data Container Array](https://docs.contao.org/dev/reference/dca/)« (DCA) bietet zahlreiche, 
praktische Konfigurationsmöglichkeiten. Hier findest du eine Auswahl hilfreicher Beispiele.

Ab Contao 4.9 werden die jeweiligen Anpassungen im Verzeichnis »contao/dca« erwartet. Falls die Verzeichnisse noch 
nicht existieren, musst du diese zunächst erstellen. Für jede Contao Tabelle benötigst du eine eigene Datei, 
beispielsweise »contao/dca/tl_content.php«. Anschließend mußt du den Anwendungs-Cache über den 
[Contao-Manager](/de/installation/contao-manager/) oder über 
die Konsole neu aufbauen. Dieser Schritt wird nach jeder Änderung erforderlich.

{{% notice note %}}
Du kennst weitere, praktische Beispiele? Dann ergänze diese Sammlung mit deinen Informationen. Ausführliche Angaben wie
du zur Dokumentation beitragen kannst [findest du hier](/de/beitragen/).
{{% /notice %}}


{{% expand "HTML in Überschriften" %}}
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


{{% expand "Ein Feld im Backend ausblenden" %}}
```php
// for example: contao/dca/tl_member.php
unset($GLOBALS['TL_DCA']['tl_member']['fields']['dateOfBirth']);
```
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
