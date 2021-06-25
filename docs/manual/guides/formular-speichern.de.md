---
title: "Einfache Reservierungen"
description: "Übertragene Formulardaten in eine Datenbanktabelle speichern."
aliases:
  - /de/anleitungen/formular-speichern/
weight: 95
tags: 
  - "Formular"
  - "Template"
  - "Datenbank"
  - "Auflistung"
  - "Leads"
  - "Hook"
---


Mit Contao kannst du übertragende Formulardaten nicht nur als E-Mail versenden, sondern auch in eine vorhandene
Datenbanktabelle speichern. Möchtest du dazu keine vorhandene oder eigene Datenbanktabelle nutzen, kann als
Alternative die [Erweiterung Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) installiert werden.


## Hintergrund

Für einen fiktiven Bootsverein können sich Vereinsmitglieder das Vereinsboot über ein Formular für einen oder mehrere 
Tag(e) reservieren. Die Datumsauswahl über die Formularfelder soll bequem über einen Minikalendar erfolgen und 
hierbei die Datumseinträge bereits existierender Reservierungen ausgeschlossen werden. Weiterhin müssen die 
Reservierungen im Contao Backend zur Verfügung stehen.

Im ersten Beispiel verwenden wir zur Speicherung die in Contao zur Verfügung stehenden Möglichkeiten zusammen mit der
Erweiterung [Auflistungen](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle) und dem 
[Hook](https://docs.contao.org/dev/reference/hooks/) »[prepareFormData](https://docs.contao.org/dev/reference/hooks/prepareFormData/)«. 
Im Backend werden die Reservierungen in der [Terminverwaltung](/de/core-erweiterung/kalender/terminverwaltung/) aufgeführt. 
Im zweiten Beispiel nutzen wir zur Speicherung und Backend Darstellung der Daten 
die [Erweiterung Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads).


## Formularaufbau

Für unser Beispiel halten wir den Formularaufbau übersichtlich. Über den [Formulargenerator](/de/formulargenerator/)
erstellst du dir ein neues Formular mit dem Titel ``Boot-Reservierung``. Als [Formularfelder](/de/formulargenerator/formularfelder/) 
benötigen wir lediglich folgende Feldtypen zusammen mit einem 
[Absendefeld](http://localhost:1313/de/formulargenerator/formularfelder/#absendefeld):


|Feldtyp   |Feldname  |Feldbezeichnung  |Pflichtfeld |Eingabeprüfung         |CSS-Klasse   | 
|:---------|:---------|:----------------|:-----------|:----------------------|:------------|
|Textfeld  |title     |Mitgliedsname    |Ja          |Alphabetische Zeichen  |             |
|Textfeld  |startDate |Von              |Ja          |Datum                  |js_startDate |
|Textfeld  |endDate   |Bis              |Nein        |Datum                  |js_endDate   |



## Beispiel I

Die Daten sollen im Backend über die [Terminverwaltung](/de/core-erweiterung/kalender/terminverwaltung/) zur Verfügung 
stehen. Erstelle dir dazu ein neues Event-Archiv z. B. mit dem Namen ``Reservierungen``.


### Formulardaten speichern

In den Einstellungen deines Formulars aktivierst du nun die Option [Eingaben speichern](http://localhost:1313/de/formulargenerator/formulare/#formulardaten-speichern) und verwendest als Zieltabelle den Eintrag ``tl_calendar_events``.

{{% notice info %}}
Zur Auswahl der Zieltabelle stehen alle vorhandenen Datenbanktabellen deiner Contao Installation zur Verfügung. 
Du könntest dir auch eine eigene Datenbanktabelle erstellen. Der entsprechende Tabellenname muss dann mit dem Präfix »tl_«
beginnen. Grundsätzlich müssen die Feldnamen deines Formulars mit den entsprechenden Feldnamen der Datenbanktabelle 
übereinstimmen.
{{% /notice %}}


### Der Hook prepareFormData

Die Datenbanktabelle ``tl_calendar_events`` beinhaltet zahlreiche Felder. Nicht alle sind für unser Beispiel notwendig.
Wir benötigen zumindest Einträge für die Felder »pid«, »title«, »alias«, »author«, »startDate«, »startTime«, »endDate«, 
»endTime« und »published«, damit wir im Contao Backend eine gültige Darstellung unserer Reservierungen erhalten. Optional 
wären Einträge für »location«, »description« oder »teaser«. 

Unser Formular bedient zur Zeit zumindest die Felder »title«, »startDate« und optionales »endDate«. Die weiteren Felder
könnte man über versteckte Formularfelder hinzufügen. Diese Vorgehensweise ermöglicht jedoch die Manipulation der zu 
übermittelten Formulardaten. Aus diesem Grund verwenden wir den Hook 
»[prepareFormData](https://docs.contao.org/dev/reference/hooks/prepareFormData/)«.


Dieser Hook greift nach der Formular Übermittlung aber vor der eigentlichen Datenspeicherung. Du kannst darüber 
die übermittelten Daten bearbeiten und neue Informationen hinzufügen. Erstelle dir in deiner Contao Installation 
die Verzeichnisse ``src\EventListener\`` und darin die Datei ``PrepareFormDataListener.php`` mit folgendem Inhalt:


```php
// src/EventListener/PrepareFormDataListener.php

namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Form;
use Contao\CoreBundle\Slug\Slug;

/**
 * @Hook("prepareFormData")
 */
class PrepareFormDataListener 
{
  private $slug;

  public function __construct(Slug $slug)
  {
      $this->slug = $slug;
  }  

  public function __invoke(array &$submittedData, array $labels, array $fields, Form $form): void
  {
    // set id of form, eventarchiv and author
    $idForm         = 3;
    $idEventArchiv  = 5;
    $idAuthor       = 1;
    
    $ticketNr = strtotime("now");
    
    // form restriction 
    if ($form->id == strval($idForm)) {

      // mandatory fields
      $submittedData['pid']       = $idEventArchiv;
      $submittedData['author']    = $idAuthor;
      $submittedData['published'] = 1;
      
      $tmpTitle = $submittedData['title'] . " Ticket: " . $ticketNr;
      $submittedData['title'] = $tmpTitle;
      $submittedData['alias'] = $this->slug->generate(
        $tmpTitle, ['validChars' => 'a-z0-9', 'locale' => 'de', 'delimiter' => '-']
      );      
      
      $submittedData['startTime'] = strtotime($submittedData['startDate']);
      
      // optional fields
      if (!empty(trim($submittedData['endDate']))) {
        $submittedData['endTime'] = strtotime($submittedData['endDate']);
      } else {
        $submittedData['endTime'] = null;
        $submittedData['endDate'] = null;
      }
      
      $submittedData['location'] = "Bootsverein Anleger";
      $submittedData['teaser'] = "Reservierung Vereins-Boot: <br>" . $tmpTitle;

    }
  }
}
```

Die für unser Event-Archiv benötigten Felder werden hierüber gesetzt. Die folgenden Werte mußt du entsprechend
deiner Umgebung anpassen:

- »$idForm« ( Die ID deines Formulars)
- »$idEventArchiv« ( Die ID deines Event-Archivs)
- »$idAuthor« ( Die ID des Autors/Backend Benutzer)

Diese Angaben erhälst du im Contao Backend über die Detailinformationen der jeweiligen Einträge.

Das Feld »alias« entspricht dem »Event-Alias« deines Event-Archivs und muß eindeutig sein. Hierzu benutzen wir den
[Contao Slug-Service](https://docs.contao.org/dev/reference/services/#slug). Zunächst nutzen wir dazu den Inhalt 
unseres übermittelten »title« Feldes (Der Mitgliedsname) und lassen lediglich Kleinbuchstaben und Ziffern zu. Umlaute 
werden umgeschrieben und Leerzeichzen ausgetauscht. Abschließend erzeugen wir eine eindeutige Ticket-Nummer und 
ergänzen damit den finalen Eintrag.

Mit Eingabe eines Mitgliedsnamens von z. B. ``Jon Smith`` wird daraus der »alias« Eintrag ``jon-smith-ticket-1624279859``.

{{% notice info %}}
Du mußst im Anschluß den Contao Cache über den »Contao Manager« oder über die »Konsole« löschen damit der Hook 
verarbeitet werden kann. Dies wird auch notwendig nachdem du Änderungen an der Datei »PrepareFormDataListener.php«
vorgenommen hast.<br><br>
Der [Contao Slug-Service](https://docs.contao.org/dev/reference/services/#slug) bietet eine eigene Möglichkeit
zur eindeutigen »alias« Erstellung. Ein entsprechendes Beispiel wird in der Dokumentation aufgeführt. Für unser 
Beispiel soll die Nutzung einer zufälligen Tickernummer ausreichen.
{{% /notice %}}


### Zwischenfazit

Zum aktuellen Zeitpunkt werden deine Formulardaten gespeichert und können im Contao Backend im entsprechenden 
Event-Archiv eingesehen und auch geändert werden. Du könntest hier auch weitere Reservierungen manuell pflegen.


### Bequeme Datumsauswahl im Frontend

Im nächsten Schritt werden wir unsere beiden Formularfelder, »startDate« und «startEnd», mit einer bequemen Datumsauswahl
erweitern und benutzen hierzu das jQuery PlugIn »[pickadate.js](https://amsul.ca/pickadate.js/)«. Lade dir hierzu die 
Version (aktuell [v.3.6.2](http://github.com/amsul/pickadate.js/archive/3.6.2.zip)) herunter und lege die Dateien 
in ein öffentlich, zugängliches Verzeichnis deiner Contao Installation unterhalb von »files« ab.

Das jQuery PlugIn »[pickadate.js](https://amsul.ca/pickadate.js/)« bietet die Möglichkeit Datumsangaben von der Auswahl
auszuschließen. Hierbei könnte es sich um einzelne Tage oder einen ganzen Zeitraum (Von/Bis) handeln. Das Plugin erwartet 
diese Angaben als [Array](https://amsul.ca/pickadate.js/date/#disable-dates) in einem bestimmten Datumsformat und kann 
als Optionsparameter definiert werden. Eine mögliche Definition könnte wie folgt aussehen:


```js
...
disable: [
  [2021,7,2],                             // disable single date
  { from: [2021,7,14], to: [2021,7,18] }  // disable date range
]
...
```


#### Die Erweiterung Auflistungen

Die Datumsangaben unserer Reservierungen liegen uns vor und du kannst die benötigen Werte der Datenbanktabelle ``tl_calendar_events``
über die Erweiterung [Auflistungen](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle) abfragen.

Nach der Installation der Erweiterung [Auflistungen](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle) 
erstellst du dir ein neues Contao Template, z. B. ``list_pickadate.html5``, basierend auf dem Template 
»list_default.html5« mit folgenden Angaben:


```php
// list_pickadate.html5
<?php
  $GLOBALS['TL_USER_CSS'][] = 'files\EDITPATH\default.css|static';
  $GLOBALS['TL_USER_CSS'][] = 'files\EDITPATH\default.date.css|static';
?>
<script src="files\EDITPATH\picker.js"></script>
<script src="files\EDITPATH\picker.date.js"></script>
<script src="files\EDITPATH\picker.time.js"></script>
<script src="files\EDITPATH\translations\de_DE.js"></script>

<script>
$(document).ready(function(){
	
	// create javascript array wirh dates to disable and consider php/js difference
	var arrDisableDate = [
	<?php 
		foreach ($this->tbody as $row) {
	
			$startTimestamp = $row['startDate']['raw'];
			$startTimestampJs = date('Y,m,d', strtotime('-1 month', $startTimestamp));
			$endTimestamp = $row['endDate']['raw'];
			$endTimestampJs = date('Y,m,d', strtotime('-1 month', $endTimestamp));

			// check for optional endDate value
			if ( !empty(trim($endTimestamp)) ) {
				print "{from:[". $startTimestampJs ."], to:[". $endTimestampJs ."]},"; 
			} else {
		  		print "[". $startTimestampJs ."],"; 
			}
		}
	?> 
	]

    $.extend($.fn.pickadate.defaults, {
        showMonthsShort: true,
        showWeekdaysFull: false,        
        labelMonthNext: 'nächster Monat',
        labelMonthPrev: 'vorheriger Monat',
        closeOnSelect: true,
        closeOnClear: true,
        format: 'dd.mm.yyyy',
        formatSubmit: 'dd.mm.yyyy',
        hiddenName: true,
        min: new Date(),
        disable: arrDisableDate
    })    

    var from_$input = $('input.js_startDate').pickadate(),
        from_picker = from_$input.pickadate('picker')
    
    var to_$input = $('input.js_endDate').pickadate(),
        to_picker = to_$input.pickadate('picker')

    // Check if there’s a “from” or “to” date to start with.
    if ( from_picker.get('value') ) {
      to_picker.set('min', from_picker.get('select'))
    }
    if ( to_picker.get('value') ) {
      from_picker.set('max', to_picker.get('select'))
    }
    
    // When something is selected, update the “from” and “to” limits.
    from_picker.on('set', function(event) {
      if ( event.select ) {
        to_picker.set('min', from_picker.get('select'))    
      }
      else if ( 'clear' in event ) {
        to_picker.set('min', false)
      }
    })
    
    to_picker.on('set', function(event) {
      if ( event.select ) {
        from_picker.set('max', to_picker.get('select'))
      }
      else if ( 'clear' in event ) {
        from_picker.set('max', false)
      }
    })    
}) 
</script>
```

Die Pfadangaben für die .js und .css Dateien mußt du deiner Umgebung entsprechend anpassen. Eine Referenzierung auf 
unsere beiden Formularfelder erfolgt über deren CSS-Klassen »js_startDate« und »js_endDate« 
([siehe Formularaufbau](#formularaufbau)) und werden in den JavaScript Variablen »from_$input« und »to_$input« herangezogen.

Mit der Definition von »format« und »formatSubmit« stellen wir sicher, das die Übergabewerte mit der Eingabeprüfung
der Datumsangaben in unserem Formular übereinstimmen.

Die existierenden Datumsangaben bzw. Reservierungen aus der Datenbanktabelle ``tl_calendar_events`` 
(»startDate« und »endDate«) werden in der PHP »foreach Schleife« ermittelt, entsprechend den 
[Vorgaben](https://amsul.ca/pickadate.js/date/#disable-dates) des jQuery Plugin's aufbereitet und in »arrDisableDate« abgelegt.

In deinem [Contao Theme](/de/layout/theme-manager/) erstellst du dir anschließend ein neues 
[Modul](/de/layout/modulverwaltung/) vom Typ ``Auflistung`` mit folgenden Angaben:


| Feld                       | Wert                                             |
|:---------------------------|:-------------------------------------------------|
|**Tabelle**                 |tl_calendar_events                                |
|**Felder**                  |startDate, endDate                                |
|**Bedingung**               |pid = 1 AND published = 1                         |
|**Sortieren nach**          |startDate                                         |


Die Angabe »pid« muss dann mit der jeweiligen ID deines Contao Event-Archivs übereinstimmen. In der Auswahl
»Listen-Template» setzt du das obige Template ``list_pickadate.html5``.

Diese Modul bindest du anschließend im [Artikel](de/artikelverwaltung/) unterhalb deines Formulars ein.


### Fazit

Im Anschluß kannst du bequem über dein Formular die Datumsangaben setzen, wobei bereits vorhandene Registrierungen
berücksichtigt werden. Die Daten werden in der Contao Datenbank gespeichert und sind über das Contao Backend verfügbar.

Weiterhin stehen dir alle [Frontend Module](/de/core-erweiterung/kalender/frontend-module/#template-einstellungen) 
(z. B. der Mini-Kalendar) zwecks Darstellung dieses Event-Archivs zur Verfügung.


## Beispiel II

Falls du keine vorhandenen Contao Datenbanktabellen oder eine eigene Datenbanktabelle nutzen möchtest bietet sich die 
[Erweiterung Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) an. 


### Die Erweiterung Leads

Die Erweiterung legt je Formular die Daten automatisch in die Datenbanktabellen »tl_lead« bzw. »tl_lead_data« ab. 
Vorhandene Einträge sind darüber hinaus im Contao Backend einsehbar. 

Allerdings beinhaltet die Erweiterung keine eigenen Frontend Module zur Darstellung. Hierzu kannst du dann die 
Erweiterung [Auflistungen](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle) nutzen
oder gezielt, in beliebigen Contao Templates, die Funktionen der 
Leads »[DataCollector.php](https://github.com/terminal42/contao-leads/blob/master/library/Leads/DataCollector.php)» einsetzen.


### Formulardaten speichern

Unser bisheriger [Formularaufbau](#formularaufbau) bleibt unverändert. Nach Installation 
der [Erweiterung Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads)
musst du die Leads-Speicherung in den Formular Einstellungen über den Eintrag »Anfragen speichern« aktivieren.

Anschließend stehen dir weitere Optionen zur Verfügung, die der Leads Backend Darstellung dienen. Wir verwenden
hierzu folgende Einträge:


| Feld                    |Wert                                              |
|:----------------------- |:-------------------------------------------------|
|Hauptkonfiguration       |Dies ist ein Master-Formular                      |
|Navigations-Bezeichnung  |Reservierung Vereinsboot                          |
|Datensatz-Bezeichnung    |##title## - {{formatted_datetime::##startDate##::d.m.Y}} {{formatted_datetime::##endDate##::d.m.Y}}|

Weiterhin musst du in jedem Formularfeld, das gespeichert werden soll, dies expliziet aktivieren. Hierzu kannst du in den
jeweiligen Formularfeldern die Auswahl »In Anfrage speichern« auf »ja« setzen.


### Zwischenfazit

Wenn du jetzt das Fromular benutzt, werden die Daten gespeichert und sind im Navigationsbereich des Contao Backend über den 
Bereich »Anfragen« einsehbar. Zur Darstellung im Frontend kannst du über die 
Erweiterung [Auflistungen](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle)
ein neues [Modul](/de/layout/modulverwaltung/) vom Typ ``Auflistung`` mit folgenden Angaben erstellen:


| Feld                       | Wert                                             |
|:---------------------------|:-------------------------------------------------|
|**Tabelle**                 |tl_lead                                           |
|**Felder**                  |post_data                                         |


### Bequeme Datumsauswahl im Frontend

Die Umsetzung unterscheidet sich kaum von der bisherigen Vorgehensweise in Zusammenhang mit 
dem [Beispielformular](#formularaufbau). Wir benötigen ein Contao Template zur Integration und Konfiguration des jQuery 
PlugIn's »[pickadate.js](https://amsul.ca/pickadate.js/)«.

Zur gezielten Abfrage der Datumsangaben benötigen wir Zugriff auf die Werte der Datenbanktabelle »tl_lead_data«.
Über die Erweiterung [Auflistungen](https://extensions.contao.org/?q=Auflistung&pages=1&p=contao%2Flisting-bundle) 
können wir diese allerdings nicht abfragen.


#### Leads DataCollector

Die [Erweiterung Leads](https://extensions.contao.org/?q=Leads&pages=1&p=terminal42%2Fcontao-leads) bietet hierzu, über 
die »[DataCollector.php](https://github.com/terminal42/contao-leads/blob/master/library/Leads/DataCollector.php)», 
entsprechende Funktionen an.

Zunächst erstellen wir uns ein neues Contao Template basierend auf »form_wrapper.html« und benennen es z. B.
``form_wrapper_pickadate.html5``. Anschließend wählst du dieses Template in den Einstellungen des Formulars aus.


```js
// form_wrapper_pickadate.html5
<?php
// see https://github.com/terminal42/contao-leads/blob/master/library/Leads/DataCollector.php
use Leads\DataCollector;

// corresponding field master_id from table tl_lead
$myLeadsMasterID = 1;
$dataCollector = new DataCollector($myLeadsMasterID);

$GLOBALS['TL_USER_CSS'][] = 'files\EDITPATH\default.css|static';
$GLOBALS['TL_USER_CSS'][] = 'files\EDITPATH\default.date.css|static';
?>

<!-- indexer::stop -->
<div class="<?= $this->class ?> block"<?= $this->cssID ?><?php if ($this->style): ?> style="<?= $this->style ?>"<?php endif; ?>>

<?php if ($this->headline): ?>
  <<?= $this->hl ?>><?= $this->headline ?></<?= $this->hl ?>>
<?php endif; ?>

<form<?php if ($this->action): ?> action="<?= $this->action ?>"<?php endif; ?> method="<?= $this->method ?>" enctype="<?= $this->enctype ?>"<?= $this->attributes ?><?= $this->novalidate ?>>
  <div class="formbody">
    <?php if ('get' != $this->method): ?>
      <input type="hidden" name="FORM_SUBMIT" value="<?= $this->formSubmit ?>">
      <input type="hidden" name="REQUEST_TOKEN" value="{{request_token}}">
      <?php if ($this->maxFileSize): ?>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?= $this->maxFileSize ?>">
      <?php endif; ?>
    <?php endif; ?>
    <?= $this->hidden ?>
    <?= $this->fields ?>
  </div>
</form>

</div>
<!-- indexer::continue -->

<script src="files\EDITPATH\pickadate\picker.js"></script>
<script src="files\EDITPATH\picker.date.js"></script>
<script src="files\EDITPATH\picker.time.js"></script>
<script src="files\EDITPATH\translations\de_DE.js"></script>

<script>
$(document).ready(function(){
	
	// create javascript array wirh dates to disable and consider php/js difference
	var arrDisableDate = [

	<?php	
	$leadsData = $dataCollector-> getExportData(); 
	
	foreach($leadsData as $row) {
		foreach($row as $content) {
		    if ( $content['name'] == "startDate" )  {
				$startTimestamp = $content['value'];
				$startTimestampJs = date('Y,m,d', strtotime('-1 month', $startTimestamp));
			}
			
			if ( $content['name'] == "endDate" && !empty(trim($content['value'])) )  {
				$endTimestamp = $content['value'];
				$endTimestampJs = date('Y,m,d', strtotime('-1 month', $endTimestamp));	
			} else {
				$endTimestamp = null;
			}
		}
	
		// check for optional endDate value
		if ( !empty(trim($endTimestamp)) ) {
			print "{from:[". $startTimestampJs ."], to:[". $endTimestampJs ."]},"; 
		} else {
	  		print "[". $startTimestampJs ."],"; 
		}
	}
	?>	
	]
	
    $.extend($.fn.pickadate.defaults, {
        showMonthsShort: true,
        showWeekdaysFull: false,        
        labelMonthNext: 'nächster Monat',
        labelMonthPrev: 'vorheriger Monat',
        closeOnSelect: true,
        closeOnClear: true,
        format: 'dd.mm.yyyy',
        formatSubmit: 'dd.mm.yyyy',
        hiddenName: true,
        min: new Date(),
        disable: arrDisableDate
    })    

    var from_$input = $('input.js_startDate').pickadate(),
        from_picker = from_$input.pickadate('picker')
    
    var to_$input = $('input.js_endDate').pickadate(),
        to_picker = to_$input.pickadate('picker')

    // Check if there’s a “from” or “to” date to start with.
    if ( from_picker.get('value') ) {
      to_picker.set('min', from_picker.get('select'))
    }
    if ( to_picker.get('value') ) {
      from_picker.set('max', to_picker.get('select'))
    }
    
    // When something is selected, update the “from” and “to” limits.
    from_picker.on('set', function(event) {
      if ( event.select ) {
        to_picker.set('min', from_picker.get('select'))    
      }
      else if ( 'clear' in event ) {
        to_picker.set('min', false)
      }
    })
    
    to_picker.on('set', function(event) {
      if ( event.select ) {
        from_picker.set('max', to_picker.get('select'))
      }
      else if ( 'clear' in event ) {
        from_picker.set('max', false)
      }
    })    
}) 
</script>
```

Das Template unterscheidet sich hinsichtlich der »pickadate.js« Umsetzung nicht vom ersten Beispiel. 
Zur Erfassung der Datumsangaben aus der Tabelle »tl_lead_data« nutzen wir jetzt die Klasse ``DataCollector`` der 
Leads »[DataCollector.php](https://github.com/terminal42/contao-leads/blob/master/library/Leads/DataCollector.php)».

Die »$myLeadsMasterID« beinhaltet die jeweilige »master_id« der Tabelle »tl_lead«. Über die Methode ``getExportData()`` 
werden die Daten geliefert und dann entsprechend aufbereitet.


## Fazit

Für unseren Anwendungsfall ist das erste Beispiel sicher besser geeignet, da dir hierbei zusätzlich alle
Contao Frontend Module für Events zur Verfügung stehen. Die Angaben zur Erweiterung »Leads« in 
Kombination mit der Klasse ``DataCollector`` sind für die Umsetzung in deinen Projekten dennoch hilfreich.