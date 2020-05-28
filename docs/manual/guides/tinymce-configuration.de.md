---
title: "TinyMCE Editor Konfiguration"
description: "Die TinyMCE Editor Konfiguration"
url: "anleitungen/tinymce-konfiguration"
weight: 40
---


Zur Bearbeitung der meisten Inhalte im Contao Backend wird der [TinyMCE](https://www.tiny.cloud/) Editor herangezogen. 
Der Editor ist für Contao bereits vorkonfiguriert. Individuelle Änderungen sind also optional. 


## Das Template be_tinyMCE.html5

Deine individuelle Konfiguration erfolgt über das Template `be_tinyMCE.html5`. Hier findest du die von Contao gesetzte
Konfiguration und kannst die Angaben updatesicher anpassen.

Erstelle ein neues Template über den Link `Neues Template`. Wähle über `Original-Template` das Template aus und gebe 
als `Zielverzeichnis` das Templates Hauptverzeichnis an. 

{{% notice note %}}
Das Template **muss** im Templates Hauptverzeichnis (`templates/be_tinyMCE.html5`) abgelegt werden und du solltest die Datei
in keinem Fall umbenennen. Alle Zeilen innerhalb von `<script>...</script>` bis auf die letzte Zeile müssen 
mit einem **Komma** abgeschlossen werden. Nach dem Speichern des Templates werden deine Änderungen sofort übernommen.
{{% /notice %}}


## Beispiele

Welche Version des Editors herangezogen wird kannst du der aktuellen Contao 
[composer.json](https://github.com/contao/contao/blob/master/composer.json#) entnehmen. Abhängig von der jeweiligen 
TinyMCE Version findest du die entsprechenden Infos zur individuellen Konfiguration dann in der 
[TinyMCE Dokumentation](https://www.tiny.cloud/docs-4x/configure/content-formatting/).

Falls etwas nach deinen Änderungen nicht funktionieren sollte entferne diese zunächst wieder. Du kannst auch das 
Template löschen. Es wird dann wieder die Contao Standard Konfiguration des Editors benutzt.


### Funktion "Als Text einfügen" standardmäßig aktivieren

Im Editor kann du über das Menü `Bearbeiten` oder über eine Tastenkombination Text aus der Zwischenablage einfügen. 
Hierbei kann es passieren das nicht nur der Text sondern auch weitere Formatierungen (z. B. aus einer Word Datei) übernommen
werden. Damit nur Text eingefügt wird kannst du über das Menü die Option `Bearbeiten\Als Text einfügen` manuell auswählen.

Über die Konfiguration werden wir die Option standardmäßig aktivieren. Diese Funktion des Editors erfolgt über das `Paste` Plugin 
und die Möglichkeiten sind hier [dokumentiert](https://www.tiny.cloud/docs-4x/plugins/paste/#paste_as_text). Wir müssen 
demnach die Angabe `paste_as_text` im Template hinzufügen:

```php
// be_tinyMCE.html5
...

toolbar: 'link unlink | image | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code',
  
// activate paste_as_text option
paste_as_text: true
```

Im Beispiel haben wir dies über eine neue Zeile unterhalb der bestehenden Zeile (toolbar: ...) eingetragen. Da unsere
neue Zeile die letzte Zeile ist brauchen wir hier kein Komma setzen. Allerdings musst du darauf achten das die bestehende
Zeile (toolbar: ...) nun zusätzlich mit einem Komma abgeschlossen werden muss.

Im Editor ist die Option `Bearbeiten\Als Text einfügen` jetzt immer aktiviert.


### Die Toolbar ändern

Die Toolbar des Editors bietet u. a. die Möglichkeit der Absatz Ausrichtung. Wenn du dies für deine Redakteure 
unterbinden möchtest entferne die Einträge `alignleft aligncenter alignright alignjustify` in der `toolbar` Definition:

```php
// be_tinyMCE.html5
...

// custom toolbar settings
toolbar: 'link unlink | image | formatselect | bold italic | bullist numlist outdent indent | code',

// activate paste_as_text option
paste_as_text: true
```


### Das Menü ändern

Analog zur Toolbar können auch die Menüs konfiguriert werden. Wenn du den Menüpunkt `Tabelle` vollständig entfernen
möchtest lösche den Eintrag `table` in der Zeile der Menübar Definition (`menubar:...`).

Zur gezielten Kontolle einzelner Menüpunkte steht die `menu` Definition zur Verfügung. Die detaillierten Infos hierzu
findest du in der [TinyMCE Dokumentation](https://www.tiny.cloud/docs-4x/configure/editor-appearance/#menu).

Wir haben in der Toolbar die Absatz Ausrichtung entfernt. Allerdings ist diese noch im Menü unter `Format\Ausrichtung` 
erreichbar. Wir möchten gezielt diesen Menüpunkt entfernen und die übrigen Menüeinträge beibehalten. Hierzu kannst
du den Eintrag [removed_menuitems](https://www.tiny.cloud/docs-4x/configure/editor-appearance/#removed_menuitems) benutzen. 
Eine vollständige Liste der Toolbar und Menü Items findest du 
[hier](https://www.tiny.cloud/docs-4x/advanced/editor-control-identifiers/).


```php
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


### Eigene Format Definitionen



