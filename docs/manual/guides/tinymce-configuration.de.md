---
title: "TinyMCE-Editor Konfiguration"
description: "Den TinyMCE-Editor für verschiedene Bereiche unterschiedlich konfigurieren."
url: "anleitungen/tinymce-konfiguration"
aliases:
    - /de/anleitungen/tinymce-konfiguration/
weight: 40
tags:
   - "Template"
---


Zur Bearbeitung der meisten Inhalte mit individueller Formatierung wird der [TinyMCE-Editor](https://www.tiny.cloud/) eingesetzt.
Der Editor ist für Contao bereits vorkonfiguriert, aber eine individuelle Konfiguration ist optional möglich. 


## Das Template be_tinyMCE.html5

Deine individuelle Konfiguration erfolgt über das Template `be_tinyMCE.html5`. Hier findest du die von Contao gesetzte
Konfiguration vor und kannst die Angaben updatesicher anpassen.

Erstelle über den [Navigationsbereich](../../administrationsbereich/aufruf-und-aufbau-des-backends/#der-navigationsbereich) 
»Layout« unter »Templates« ein neues [Template](../../theme-manager/templates-verwalten). 
Wähle über `Original-Template` das Template `be_tinyMCE.html5` aus und gebe als `Zielverzeichnis` das Hauptverzeichnis an. 

{{% notice note %}}
Das Template **muss** im Hauptverzeichnis (`templates/be_tinyMCE.html5`) abgelegt werden, da das Backend von Contao das
Template nur dort findet. Alle Zeilen innerhalb von `<script>...</script>` bis auf die letzte Zeile müssen mit einem
**Komma** abgeschlossen werden. Nach dem Speichern des Templates werden deine Änderungen sofort übernommen.
{{% /notice %}}

{{% notice tip %}}
Seit Contao **4.10** kann [Template Vererbung](/en/layout/templates/template-inheritance/) benutzt werden, um nur Teile
des Standard `be_tinyMCE` Templates nach den eigenen Bedürfnissen anzupassen.
{{% /notice %}}


## Verschiedene Editor-Konfigurationen

Wenn du den Template Namen `be_tinyMCE.html5` beibehälst führt dies dazu, dass deine Änderungen sich auf alle Bereiche 
auswirken die den Editor benutzen. Dies gilt zumindest für die Contao eigenen Komponenten.

Du möchstest gezielt eine Editor-Konfiguration z. B. nur für das Inhaltselement vom Typ »Text« erstellen? Dazu kannst
du das Template beliebig umbenennen: z.B. nach `be_myTinyMCE.html5`.

Als nächstes müssen wir Contao dazu bringen dieses Template zu nutzen. Dazu muss folgendes in die `contao/dca/tl_content.php` 
eingefügt werden:

```php
// contao/dca/tl_content.php

// Custom RTE-Configuration for Content Text
$GLOBALS['TL_DCA']['tl_content']['fields']['text']['eval']['rte'] = 'myTinyMCE';
```

Der letzte Eintrag entspricht der Template Bezeichnung (ohne be_ Präfix). In unserem Fall `myTinyMCE`. Im Anschluß musst du über 
den Contao-Manager (»Systemwartung« > »Prod.-Cache erneuern«) oder über die Konsole einmalig den Anwendungs-Cache leeren. 

Analog wäre die Vorgehensweise z. B. für deine Nachrichten Texte mit einem Template `be_myTinyMCENews` und 
einer `tl_news.php`:

```php
// contao/dca/tl_news.php

// Custom RTE-Configuration for News Text
$GLOBALS['TL_DCA']['tl_news']['fields']['text']['eval']['rte'] = 'myTinyMCENews';
```

Eine Einführung zum Contao `Data Container Array` findest du unter [Adjusting the DCA](https://docs.contao.org/dev/getting-started/dca/) 
und die detaillierte Referenz unter [Data Container Array](https://docs.contao.org/dev/reference/dca/) in der Entwickler-Dokumentation.


## Beispiele

Welche Version des Editors herangezogen wird kannst du der aktuellen Contao 
[composer.json](https://github.com/contao/contao/blob/master/composer.json#) entnehmen. Abhängig von der jeweiligen 
TinyMCE-Version findest du die Infos zur weiteren Konfiguration in der 
[TinyMCE-Dokumentation](https://www.tiny.cloud/docs-4x/configure/content-formatting/).

Falls etwas nach deinen Änderungen nicht funktionieren sollte entferne diese zunächst wieder. Du kannst auch das 
Template löschen. Es wird dann wieder die Contao-Standardkonfiguration des Editors benutzt.


### Die TinyMCE »extended_valid_elements« Definition

Im Bereich »`Einstellungen > Sicherheitseinstellungen`« kannst du [Erlaubte HTML-Tags](/de/system/einstellungen/#sicherheitseinstellungen) definieren. Es kann vorkommen, dass diese Angaben allein nicht ausreichen. 

Falls du beispielsweise mit verfügbaren »Font-Awesome« das [Contao-Logo](https://fontawesome.com/v4.7.0/icon/contao) in einem 
[Inhaltselement](/de/artikelverwaltung/inhaltselemente/) vom Typ »Aufzählung« wie folgt einsetzt, werden deine 
Angaben nach dem »Speichern« nicht übernommen.

```html
<i class="fa fa-contao" aria-hidden="true">Contao Logo</i>
```

Auch wenn das HTML-Element `<i>` bereits im Bereich [Erlaubte HTML-Tags](/de/system/einstellungen/#sicherheitseinstellungen) 
berücksichtigt wird, musst du dies zusätzlich für den TinyMCE freigeben. Ergänze hierzu im Template die Zeile 
beginnend mit »extended_valid_elements«:

```js
// be_tinyMCE.html5

extended_valid_elements: 'q[cite|class|title],article,section,hgroup,figure,figcaption,i[class]/em',
```

Anschließend musst du über den Contao-Manager (»Systemwartung« > »Prod.-Cache erneuern«) oder über die Konsole 
den Anwendungs-Cache leeren, deine HTML-Angabe im Inhaltselement erneut eintragen und »Speichern«.


### Funktion »Als Text einfügen« standardmäßig aktivieren

Im Editor kann du über das Menü `Bearbeiten` oder über eine Tastenkombination Text aus der Zwischenablage einfügen. 
Hierbei kann es passieren, dass nicht nur der Text sondern auch weitere Formatierungen (z. B. aus einer Word Datei) übernommen
werden. Damit nur Text eingefügt wird kannst du über das Menü die Option `Bearbeiten > Als Text einfügen` manuell auswählen.

Über die Konfiguration werden wir die Option standardmäßig aktivieren. Diese Funktion des Editors erfolgt über das `Paste` 
-Plugin und die möglichen Einstellungen findest du in der 
[Dokumentation](https://www.tiny.cloud/docs-4x/plugins/paste/#paste_as_text). Wir müssen demnach die 
Angabe `paste_as_text` im Template hinzufügen:

```js
// be_tinyMCE.html5
...

toolbar: 'link unlink | image | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code',
  
// activate paste_as_text option
paste_as_text: true
```

Im Beispiel haben wir dies über eine neue Zeile unterhalb der bestehenden Zeile (toolbar: ...) eingetragen. Da unsere
neue Zeile die letzte Zeile, ist brauchen wir hier kein Komma setzen. 

Allerdings musst du darauf achten, dass die bestehende Zeile (toolbar: ...) nun zusätzlich mit einem Komma abgeschlossen 
werden muss. Im Editor ist die Option `Bearbeiten > Als Text einfügen` jetzt immer aktiviert.


### Die Toolbar ändern

Die Toolbar des Editors bietet u. a. die Möglichkeit der Absatz Ausrichtung. Wenn du dies für deine Redakteure 
unterbinden möchtest entferne die Einträge `alignleft aligncenter alignright alignjustify` in der `toolbar` Definition:

```js
// be_tinyMCE.html5
...

// custom toolbar settings
toolbar: 'link unlink | image | formatselect | bold italic | bullist numlist outdent indent | code',

// activate paste_as_text option
paste_as_text: true
```


### Das Menü ändern

Analog zur Toolbar kannst du auch das Menü konfigurieren. Wenn du den Menüpunkt `Tabelle` vollständig entfernen
möchtest lösche den Eintrag `table` in der Zeile der Menübar Definition (`menubar:...`).

Zur gezielten Kontrolle einzelner Menüpunkte steht die `menu` Definition zur Verfügung. Die detaillierten Infos hierzu
findest du in der [TinyMCE-Dokumentation](https://www.tiny.cloud/docs-4x/configure/editor-appearance/#menu).

Wir haben in der Toolbar die Absatz Ausrichtung entfernt. Allerdings ist diese noch im Menü unter `Format > Ausrichtung` 
erreichbar. Wir möchten gezielt diesen Menüpunkt entfernen und die übrigen Menü-Einträge beibehalten. Hierzu kannst
du den Eintrag [removed_menuitems](https://www.tiny.cloud/docs-4x/configure/editor-appearance/#removed_menuitems) benutzen. 

Eine vollständige Liste der Toolbar-Items und Menü-Items findest du in der 
[TinyMCE-Dokumentation](https://www.tiny.cloud/docs-4x/advanced/editor-control-identifiers/).


```js
// be_tinyMCE.html5
...

// removed table menu
menubar: 'file edit insert view format',

// remove align settings from format menu
removed_menuitems: "align",

// custom toolbar settings
toolbar: 'link unlink | image | formatselect | bold italic | bullist numlist outdent indent | code',

// activate paste_as_text option
paste_as_text: true

```


### Eigene Format-Definition

Du möchtest eigene Format-Definitionen zur Auswahl anbieten? Der TinyMCE-Editor bietet hierzu die Option
`style_formats` an. Du kannst hierüber z. B. deine Definition auf bestimmte HTML-Selektoren begrenzen, 
mit Inline-Style Angaben versehen oder bestimmte CSS-KLassen übergeben.

Du erweiterst die Toolbar mit dem Eintrag `styleselect`. Über die Toolbar können dann deine eigenen Angaben aus den 
`style_formats` Definitionen ausgewählt werden:

```js
// be_tinyMCE.html5
...

// removed table menu
menubar: 'file edit insert view format',

// remove align settings from format menu
removed_menuitems: "align",

// custom toolbar settings
toolbar: 'link unlink | image | formatselect | styleselect | bold italic | bullist numlist outdent indent | code',

// custom styles
style_formats: [
  {title: 'Red Text - Inline Style', inline: 'span', styles: {color: '#ff0000'}},
  {title: 'Blue Text - Inline Class', inline: 'span', classes: 'myCssClassA'},
  {title: 'Div - Block Class', block: 'div', classes: 'myCssClassB', exact: true, wrapper: true},
  {title: 'Table row - Restrict Selector', selector: 'tr', classes: 'myCssClassC'}
],

// activate paste_as_text option
paste_as_text: true
```

Alle Details über die `style_formats` Möglichkeiten findest du in der 
[TinyMCE-Dokumentation](https://www.tiny.cloud/docs-4x/configure/content-formatting/#style_formats). 
Lesenswert sind auch die [Informationen](https://www.tiny.cloud/docs-4x/configure/content-formatting/#formatparameters) 
über die Format-Parameter wie z. B. `exact` oder `wrapper`.


### Die eigene TinyMCE.css

In unserem obigen `style_formats` Beispiel haben wir im ersten Eintrag den Farbwert über eine inline CSS-Angabe definiert.
Das sollte du möglichst vermeiden und lieber mit CSS-KLassen arbeiten. Möchtest du später den Style z. B. den Farbwert 
ändern, kannst du das global über deine CSS-Klasse realisieren.

Der Nachteil ist hierbei das du oder deine Redakteure die Styles im Editor nicht sehen können. Hierzu kannst du dem
Editor deine eigene CSS-Datei über die `content_css` Angabe zur Verfügung stellen. 

Wir erstellen uns unterhalb des `files`-Ordner in einem öffentlichen Verzeichnis die Datei `myCustomTiny.css`:

```css
// files/myfolder/myCustomTiny.css

.myCssClassA {
  color: #0000ff;
}
  
.myCssClassB {
  color: #ffffff;
  background-color: #ff0000;
}
```

Die hier angegebenen CSS-KLassen entsprechen den `style_formats` Definitionen. Die Angabe `content_css` existiert
bereits im Template. Du kannst den bestehenden Eintrag mit deiner eigenen CSS-Datei vollständig ersetzen oder du 
fügst deine CSS-Datei hinzu: 

```js
// be_tinyMCE.html5
...

//content_css: 'system/themes/<?= Backend::getTheme() ?>/tinymce.min.css',

// add new custom css file
content_css: [
	'system/themes/<?= Backend::getTheme() ?>/tinymce.min.css',
	'files/myfolder/myCustomTiny.css'
],
```

Wählst du im Editor deine Format-Definition aus wird diese auch so angezeigt. Allerdings werden nun in der Toolbar unsere 
CSS-Klassen aus der CSS-Datei zusätzlich aufgeführt. Dies ist nicht erwünscht. Mit einem kleinen Trick können wir das
verhindern.

Die Option `importcss_selector_filter` ist eigentlich dazu gedacht die Anzeige auf bestimmte Bezeichnungen zu bgrenzen. Die 
Informationen findest du in der [TinyMCE-Dokumentation](https://www.tiny.cloud/docs/plugins/importcss/#importcss_selector_filter).
Wir verwenden dies in unserem Sinne und geben einen Filter an der gar nicht existiert:

```js
// be_tinyMCE.html5
...

//content_css: 'system/themes/<?= Backend::getTheme() ?>/tinymce.min.css',

// add new custom css file
content_css: [
	'system/themes/<?= Backend::getTheme() ?>/tinymce.min.css',
	'files/myfolder/myCustomTiny.css'
],

// do not import all css-classes from custom .css, only classes starts with prefix
importcss_selector_filter: ".myDummyPrefix-",
```

In der Toolbar werden jetzt wieder nur unsere eigenen Format-Definitionen entsprechend den `style_formats` Angaben angezeigt.

Wenn du also eigene Format-Definitionen im Editor zu Verfügung stellst, solltest du möglichst auch eine eigene CSS-Datei einbinden.
Die CSS-Datei kann darüber hinaus auch weitere Styles beinhalten die du für das eigentliche Layout deiner Webseite benutzt.

Allerdings kann das sehr schnell aufwendig werden. Bei dieser Vorgehensweise musst du abwägen was du in welchem Umfang 
zur Verfügung stellen möchtest.
