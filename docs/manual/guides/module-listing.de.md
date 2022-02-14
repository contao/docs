---
title: "Modul Auflistung"
description: "Eine Mitgliederliste mit Kartendarstellung über das Modul Auflistung erstellen."
aliases:
  - /de/anleitungen/modul-auflistung/
weight: 90
tags: 
  - "Theme"
  - "Template"
---


Wir möchten für eine fiktive Vereinsseite eine Liste der Mitglieder zusammen mit einer Kartendarstellung 
über den Dienstleister [OpenStreetMap](https://www.openstreetmap.org/) realisieren. Hierzu benötigen wir entsprechende
[Mitglieder](/de/benutzerverwaltung/mitglieder/) die jeweils einer oder mehreren 
[Mitgliedergruppen](/de/benutzerverwaltung/mitglieder/#mitgliedergruppen) (z. B. »Turnierreiter« oder 
»Vorstand«) zugeordnet werden können.

Diese Angaben werden in der Datenbanktabelle `tl_member` gespeichert und können dann über das Modul vom »Typ« 
[Auflistung](/de/layout/modulverwaltung/anwendungen/#auflistung) abgefragt werden.

{{% notice info %}}
Zur Listendarstellung bestehender Mitglieder könntest du auch die Erweiterung 
[contao-memberlist](https://extensions.contao.org/?q=memberlkist&pages=1&p=friends-of-contao%2Fcontao-memberlist) 
installieren. Mit Nutzung des Moduls »Auflistung« können wir dies u. a. ohne Erweiterung umsetzen.
{{% /notice %}}


## Modultyp »Auflistung«

Das Contao Frontend-Modul vom »Typ« [Auflistung](/de/layout/modulverwaltung/anwendungen/#auflistung) wird meist unterschätzt.
Aus einer beliebigen Datenbanktabelle kannst du Datensätze abfragen, die anschließend im Frontend über 
entsprechende [Template-Dateien](/de/layout/templates/) ausgegeben werden können.

Das Modul realisiert eine bequeme Eingabe einfacher SQL-Abfragen. Die Ergebnisse werden dann 
standardmäßig u. a. zur Anzeige einer Liste (Template: »list_default.html5«) mit optionaler Verlinkung auf 
Detail Seiten (Template: »info_default.html5«) angezeigt.

Wir konzentrieren uns für unser Beispiel einfachheitshalber nur auf die Listendarstellung. Die jeweiligen 
Feld-Bezeichnungen findest du in der Datenbanktabelle `tl_member`. Ohne Angabe einer Bedingung werden alle angegebenen 
Datensätze im Bereich »Felder« aufgelistet. Setze hierzu im Modul folgende Angaben: 


| Feld                       | Wert                                             |
|:---------------------------|:-------------------------------------------------|
| **Tabelle**                | tl_member                                        |
| **Felder**                 | firstname, lastname, email, postal, street, city |
| **Bedingung**              | disable != 1                                     |
| **Elemente pro Seite**     | 0                                                |


### Bedingungen

Die Bedingung `disable != 1` filtert das Ergebnis der Abfrage dahin gehend, das nur als «aktiv« deklarierte Mitglieder
angezeigt werden (im Sinne von: Keine [deaktivierten](/de/benutzerverwaltung/mitglieder/#kontoeinstellungen-1) Mitglieder). 

Für unsere Vereinsseite könnten wir uns zwei fiktive Mitgliedergruppen vorstellen: »Turnierreiter« und »Vorstand«. 
Mitgliedergruppen werden in der Datenbanktabelle `tl_member_group` geführt. Wir gehen davon aus, das z. B. die Gruppe
»Vorstand« hier mit einer »id« von »2« vorliegt. Die Referenz der Gruppenzugehörigkeit eines Mitglieds erfolgt 
in der Tabelle `tl_member` über den Datensatz `groups`. 

Möchtest du die Mitgliederliste auf alle »aktiven« Mitglieder beschränken die zur Gruppe »Vorstand« gehören kannst du 
folgendes als Bedingung eintragen: `disable != 1 AND groups LIKE '%2%'`


### Template »list_default.html5«

Das Template »list_default.html5« ist umfangreich, da es im Zusammenspiel mit dem Modul alle Eventualitäten der 
Darstellung berücksichtigt. Für unser Beispiel, zusammen mit den noch folgenden Angaben hinsichtlich der 
Kartendarstellung, vereinfachen wir das Template. 

Erstelle dir in dem von dir unter »Themes« vorgegebenen [Template-Verzeichnis](/de/layout/templates/php/verwaltung/) ein 
neues Template »list_default_member.html5« und benutze dieses anschließend in deinem Modul »Auflistung«:

```html
// list_default_member.html5

<style>
.mod_listing div.memberitem {
  border: 1px solid #dadada;
	margin: 4px 4px;
	display: block;
}
.mod_listing div p {
	padding: 10px 10px;
	margin: 0;
}	
</style>

<div class="<?= $this->class ?> ce_table listing block"<?= $this->cssID ?><?php if ($this->style): ?> style="<?= $this->style ?>"<?php endif; ?>>

  <?php if ($this->headline): ?>
    <<?= $this->hl ?>><?= $this->headline ?></<?= $this->hl ?>>
  <?php endif; ?>


  <?php if ($this->searchable && $this->for && empty($this->tbody)): ?>
    <?= $this->no_results ?>
  <?php else: ?>
	  <?php foreach ($this->tbody as $class => $row): ?>
	    <div class="block memberitem <?= $class ?>"><p>
	  	  <a href="mailto:<?= $row['email']['raw'] ?>">
	  	  <?= $row['firstname']['content'] ?> <?= $row['lastname']['content'] ?></a>
		  
          <span><?= $row['street']['content'] ?> - 
		  <?= $row['postal']['content'] ?> <?= $row['city']['content'] ?></span>
		</p></div>
      <?php endforeach; ?>
  <?php endif; ?>

  <?= $this->pagination ?>
</div>
```

{{% notice note %}}
Einfachheitshalber haben wir rudimentäre CSS-Angaben hier direkt im Template eingetragen. 
Alternativ könntest du diese auch als [CSS-Asset](/de/layout/templates/php/assets/) hinterlegen.
{{% /notice %}}


## Neues Feld für Geo-Koordinaten {#neues-feld-fuer-geo-koordinaten}

Für die Kartendarstellung benötigen wir je Mitglied die entsprechenden Geo-Koordinaten der Adresse in Form von 
Breitengrad und Längengrad. Sofern noch nicht vorhanden erstellst du dir in deinem Contao-Hauptverzeichnis ein neues 
Verzeichns »contao/dca« mit einer Datei »tl_member.php«:

```php
// contao/dca/tl_member.php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_member']['fields']['myGeoData'] = [
    'label'       => ['Koordinaten der Adresse', 'Breiten- und Längengrad mit Komma getrennt.'],
    'inputType'   => 'text', 
    'eval'        => ['tl_class' => 'w50'],
    'sql'         => ['type' => 'string', 'length' => 255, 'notnull' => false],
];

PaletteManipulator::create()
    ->addLegend('Geo-Koordinaten', 'address_legend', PaletteManipulator::POSITION_AFTER)
    ->addField('myGeoData', 'Geo-Koordinaten', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_member')
;
```

Damit Contao diese Angaben übernimmt musst du im Anschluß über die Konsole oder über den Contao Manager im Bereich 
»Systemwartung« den »Anwendungs-Cache« aktualisieren. 

Rufe dann das Contao-Installtool auf (Oder ab Contao **4.9** auch über die Konsole: 
`vendor/bin/contao-console contao:migrate`). Das neue Feld `myGeoData` wird dann in der Datenbanktabelle 
»tl_member« angelegt. Im Contao Backend steht dir jetzt das Feld zur Eingabe der Geo-Koordinaten eines Mitglieds 
(in Form von »Breitengrad,Längengrad«) zur Verfügung.

{{% notice note %}}
Bei jeder Änderung der Datei »contao/dca/tl_member.php« muss der »Anwendungs-Cache« erneut aktualisiert werden.
{{% /notice %}}


### Ermittlung der Geo-Koordinaten

Die benötigten Koordinaten kannst du z. B. über [Nominatim/Openstreetmap](https://nominatim.openstreetmap.org/) oder auch 
[Google Maps](https://www.google.de/maps/preview) ermitteln. Für unser Beispiel ist die einmalige Ermittlung und manuelle 
Eingabe der Koordinaten bei der Neuaufnahme eines Mitglieds zumutbar. Bei großen Datenmengen könntest du, zwecks 
automatischer Koordinaten Ermittlung, eine der zahlreichen Contao [Erweiterungen](https://extensions.contao.org/?q=map&pages=1) 
einsetzen.

Eine weitere Alternative steht in Form der Erweiterung 
[netzmacht/contao-leaflet-geocode-widget](https://extensions.contao.org/?q=netzmacht&pages=1&p=netzmacht%2Fcontao-leaflet-geocode-widget) 
zur Verfügung.


### Erweiterung »netzmacht/contao-leaflet-geocode-widget«

Die Erweiterung stellt zwei Backend [Widgets](https://docs.contao.org/dev/framework/widgets/) zur Geokodierung von Adressen 
inkl. Umkreis zur Verfügung. Hinweise zur Einbindung findest du auf der [GitHub](https://github.com/netzmacht/contao-leaflet-geocode-widget)
Seite. Nach der [Installation](/de/installation/erweiterungen-installieren/) der Erweiterung kannst du die 
»contao/dca/tl_member.php« wie folgt anpassen:

```php
// contao/dca/tl_member.php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_member']['fields']['myGeoData'] = [
    'label'       => ['Koordinaten der Adresse', 'Breiten- und Längengrad mit Komma getrennt.'],
    'inputType'   => 'leaflet_geocode', 
    'eval'        => ['tl_class' => 'w50'],
    'sql'         => ['type' => 'string', 'length' => 255, 'notnull' => false],
];

PaletteManipulator::create()
    ->addLegend('Geo-Koordinaten', 'address_legend', PaletteManipulator::POSITION_AFTER)
    ->addField('myGeoData', 'Geo-Koordinaten', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_member')
;
```

Anstelle unseres bisherigen Text Feldes ändern wir lediglich den »inputType« auf »leaflet_geocode« entsprechend der
[GitHub-Dokumentation](https://github.com/netzmacht/contao-leaflet-geocode-widget). Anschließend muss der Contao
»Anwendungs-Cache« aktualisiert (s. o.) werden.

Auch wenn die Ermittlung der Geo-Koordinaten eines Mitglieds weiterhin nicht »automatisch« erfolgt, kannst du nun 
diese innerhalb des Contao Backends bequem(er) abfragen.


## Kartendarstellung

Die benötigten Voraussetzungen für eine Kartendarstellung liegen uns damit vor. Das Feld `myGeoData` muss im Modul 
»Auflistung« hinzugefügt werden:


| Feld                       | Wert                                                            |
|:---------------------------|:----------------------------------------------------------------|
| **Felder**                 | firstname, lastname, email, postal, street, city, **myGeoData** |


### JavaScript-Framework »leaflet.js«

Die Kartendarstellung erfolgt über [OpenStreetMap](https://www.openstreetmap.org/) und zur Erstellung der Karte benutzen 
wir das JavaScript-Framework [leaflet.js](https://leafletjs.com/). Über den 
[leaflet Download](https://github.com/Leaflet/Leaflet/tags) findest du im Anschluß in dem ZIP-Archiv (zur Zeit Version 1.7.1) 
das Verzeichnis »dist« mit den Dateien »leaflet.js«, »leaflet.css« und »images/marker-icon.png« vor. Basierend auf 
»leaflet.js« erstellen wir uns eine JavaScript-Datei `myMemberLeafletMap.js` mit folgendem Inhalt:

```js
// /files/myPathTo/myMemberLeafletMap.js

function createMemberMap(arrMemberData){

	const mapCssId = 'MYMEMBERMAP';
	const myMarkerIconURL = '/files/myPathTo/leaflet/images/marker-icon.png'; 
	
	const zoomDefault = 12;
	const zoomMin = 1;
	const zoomMax = 18;

	var myMarkerIcon = new L.icon({
	  iconUrl: myMarkerIconURL,
	  iconSize:     [25, 41],
	  iconAnchor:   [12, 41],
	  popupAnchor:  [0, -30]
	});

	var memberGroup = new L.featureGroup();
	
	for (var i = 0; i < arrMemberData.length; i++) {
		var current = arrMemberData[i];
		memberGroup.addLayer(L.marker(current.LatLong).bindPopup(current.markerPopupContent));
	}

	var mapProvider =
	new L.tileLayer('https://{s}.tile.openstreetmap.org/tiles/osmde/{z}/{x}/{y}.png', {
	  attribution: '&copy;<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	});

	var map = new L.Map(mapCssId, {
	  minZoom: zoomMin,
	  maxZoom: zoomMax,
	  scrollWheelZoom: false,
	  fadeAnimation: false,
	  layers: [mapProvider, memberGroup]
	});

	var bounds = L.latLngBounds(memberGroup.getBounds());
	map.fitBounds(bounds, {padding: [10, 10]});
    
	map.on("resize", function(e){ 
     map.fitBounds(bounds, {padding: [10, 10]}); 
   });
}
```

Die Verzeichnisangabe auf das Marker Symbol (s. o.: »myMarkerIconURL«) musst du entsprechend anpassen. Über `mapCssId` 
wird die CSS-ID für den HTML-Container definiert. Die JavaScript-Funktion erwatet als Argument ein Array mit den 
entsprechenden Informationen. Diese werden einer Gruppe `memberGroup`, zusammen mit `OpenStreeMap` als Kartenanbieter, 
zwecks Darstellung der Karte zugeordnet. Kopiere diese Dateien in ein öffentliches Verzeichnis deiner Contao 
Installation unterhalb von »files«.

{{% notice note %}}
Du musst weiterhin jQuery im [Seitenlayout](/de/layout/theme-manager/seitenlayouts-verwalten/#jquery) 
deines Themes aktivieren. Das Beispiel bezieht sich auf das Standard Leaflet-Marker-Symbol »images/marker-icon.png«. 
Wenn du hier ein anderes, eigenes Symbol nutzen möchtest, müssen die Angaben »iconSize«, »iconAnchor« und »popupAnchor« 
ebenfalls angepasst werden.
{{% /notice %}}


### Anpassungen Template »list_default_member.html5«

Das bisherige Template »list_default_member.html5« ergänzen wir wie folgt:

```html
// list_default_member.html5

<?
	$GLOBALS['TL_CSS'][] = '/files/myPathTo/leaflet.css|static';
	$GLOBALS['TL_JAVASCRIPT'][] = '/files/myPathTo/leaflet.js|static';
	$GLOBALS['TL_JAVASCRIPT'][] = '/files/myPathTo/myMemberLeafletMap.js|static';
?>

<style>
.mod_listing div.memberitem {
	border: 1px solid #dadada;
	margin: 4px 4px;
	display: block;
}
.mod_listing div p {
	padding: 10px 10px;
	margin: 0;
}	
</style>

<div class="<?= $this->class ?> ce_table listing block"<?= $this->cssID ?><?php if ($this->style): ?> style="<?= $this->style ?>"<?php endif; ?>>

<?php if ($this->headline): ?>
	<<?= $this->hl ?>><?= $this->headline ?></<?= $this->hl ?>>
<?php endif; ?>

<?php if ($this->searchable && $this->for && empty($this->tbody)): ?>
	<?= $this->no_results ?>
<?php else: ?>
	<div id="MYMEMBERMAP" class="block" style="height:40vh"></div>

	<?php foreach ($this->tbody as $class => $row): ?>
		<div class="block memberitem <?= $class ?>"><p>
		  <a href="mailto:<?= $row['email']['raw'] ?>">
		  <?= $row['firstname']['content'] ?> <?= $row['lastname']['content'] ?></a>
		  <span><?= $row['street']['content'] ?> - 
		  <?= $row['postal']['content'] ?> <?= $row['city']['content'] ?></span>
		</p></div>

		<? $tmpMemberMapData .= sprintf("{'markerPopupContent': '%s',  'LatLong': [%s]},", 
			$row['firstname']['content'].' '.$row['lastname']['content'], 
			$row['myGeoData']['content']);
		?>
	<?php endforeach; ?>
<?php endif; ?>

<script> 
	var arrMemberMapData = [<?= $tmpMemberMapData ?>];

	(function($){
		$(document).ready(function(){ createMemberMap(arrMemberMapData); });
	})(jQuery);
</script>  

<?= $this->pagination ?>
</div>
```

Zunächst referenzieren wir die benötigten CSS- und JS-Dateien (s. a.: 
[CSS- und JavaScript-Assets](/de/layout/templates/assets/)). Weiterhin definieren wir einen HTML-Container mit der CSS-ID
`MYMEMBERMAP` zur Kartendarstellung. In der PHP-Schleife erfassen wir über `tmpMemberMapData` u. a. die benötigten 
Koordinaten und erzeugen im Anschluß hierüber ein JavaScript-Array zwecks Aufruf unserer Funktion `createMemberMap(arrMemberMapData)`.

{{% notice note %}}
Der HTML-Container zur Kartendarstellung benötigt zwingend eine CSS-Height Angabe. Wir haben diese einfachheitshalber 
inline gesetzt.
{{% /notice %}}

{{% notice info %}}
Mit dem Abruf der Karte wird eine Kommunikation des Browsers und dem OpenStreetMap-Server angestossen. Diese Übermittlung 
ist bei der DSGVO oder ePrivacy zu beachten.
{{% /notice %}}


### Kartendarstellung nach Bestätigung {#kartendarstellung-nach-bestaetigung}

Die Erstellung und Darstellung der Karte soll erst nach Bestätigung durch den Anwender erfolgen. Hierbei könntest du
beispielsweise zunächst ein Bild der Karte zusammen mit entsprechenden Informationen anzeigen lassen. Nachdem der Anwender
diese Einverständniserklärung bestätigt wird die eigentliche Kartendarstellung eingeleitet.

Zunächst ergänzen wir hierzu in unserem Template den HTML-Container mit einer neuen CSS-Klasse »static» zusammen 
mit entsprechenden CSS-Definitionen:

```html
...
<style>
.static {
	background-color: rgba(0,0,0,0.2);
}
.static-info {
	text-align: center;
	position: relative;
	display: block;
	top: 50%;
	transform: translateY(-50%);
}
.js-static-info__close {
	display: inline-block;
	margin: 10px 0 0 0;
	background: #ffffff;
	padding: 6px 6px;
	cursor: pointer;
}
</style>

<div id="MYMEMBERMAP" class="block static" style="height:40vh"></div>
...
```

Für unser Beispiel haben wir lediglich einen Farbwert angegeben. Hier könntest du dann z. B. ein Hintergrund-Bild 
einsetzen. Den bisherigen JavaScript-Aufruf unserer Funktion ersetzen wir wie folgt:

```JS
<script> 
var arrMemberMapData = [<?= $tmpMemberMapData ?>];

(function($){
	$(document).ready(function(){ 
		if (localStorage) {
			if (localStorage.getItem('MapHide') !== 'true') {
    			var info = 
    			'<div class="static-info"><div>Ja, ich möchte Karten von OpenStreetMap angezeigt bekommen.<br>' +
    			'Weitere Informationen finden Sie in unseren Datenschutzhinweisen.</div>' +
    			'<div class="js-static-info__close">Karte einblenden</div></div>';
    			$('#MYMEMBERMAP').prepend(info);
			} else {
  				$('#MYMEMBERMAP').removeClass('static');
  				createMemberMap(arrMemberMapData);
			}
		}

		$('.js-static-info__close').click(function(){
    		$(this).parents('.static-info').remove();
    		$('#MYMEMBERMAP').removeClass('static');

    		createMemberMap(arrMemberMapData);
    		localStorage.setItem('MapHide', 'true');
		});
	});
})(jQuery);
</script>
```

Solange keine Bestätigung durch den Anwender vorliegt wird unsere »statische« Alternative angezeigt. Anderenfalls wird die Karte
erstellt und dargestellt. Anstelle eines [Cookie](https://developer.mozilla.org/de/docs/Web/HTTP/Headers/Cookie) 
verwenden wir hierbei die [localStorage](https://developer.mozilla.org/de/docs/Web/API/Window/localStorage) Funktionalität 
des Browsers (Du könntest hierzu auch die 
[sessionStorage](https://developer.mozilla.org/de/docs/Web/API/Window/sessionStorage) einsetzen). 


### Nützliche Leaflet Plugins {#nuetzliche-leaflet-plugins}

Das Leaflet-Framework kann man mit [Plugins](https://leafletjs.com/plugins.html) erweitern. Hier eine kleine Auswahl:

- [Leaflet.fullscreen](https://github.com/Leaflet/Leaflet.fullscreen): Erweitert die Karte mit einer FullScreen Ansicht.
- [Leaflet.TileLayer.Grayscale](https://github.com/Zverik/leaflet-grayscale): Manche Kartenanbieter verfügen über SW/Graustufen 
Tiles. Mit diesem Plugin kann man bel. Karten in Graustufen anzeigen lassen.
- [Leaflet.markercluster](https://github.com/Leaflet/Leaflet.markercluster): Bei zahlreichern Markern werden hierüber, 
abhängig vom Zoom-Level, mehrere Marker übersichtlich zusammengefasst 
und dargestellt.
