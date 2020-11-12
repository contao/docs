---
title: "Module Listing"
description: "Create a list of members with a Map via the module Listing"
aliases:
  - /en/guides/module-listing/
weight: 90
tags: 
  - "Theme"
  - "Template"    
---


We would like to realise a list of members together with a map display via the service provider 
[OpenStreetMap](https://www.openstreetmap.de/) for a fictitious club site. For this we need corresponding 
Contao [members](/en/user-management/members/) who can be assigned to one or more Contao 
[member groups](/en/user-management/members/) (e.g. »tournament riders« or »board«).

These details are stored in the database table `tl_member` and can then be queried via the module of the »Type« 
[listing](/en/layout/module-management/applications/).

{{% notice info %}}
For list display of existing members you could also install the extension 
[contao-memberlist](https://extensions.contao.org/?q=memberlkist&pages=1&p=friends-of-contao%2Fcontao-memberlist). By 
using the module »Listing« we can implement this without any extension.
{{% /notice %}}


## Module type »Listing«

The Contao frontend module of the »type« [listing](/en/layout/module-management/applications/) is underestimated. 
From any database table you can retrieve records that can then be output to the frontend using 
[template](/en/layout/templates/_index/) files.

The module realizes a comfortable input of simple SQL queries. The results are then displayed by default, among other 
things to display a list (template: `list_default.html5`) with optional links to detail pages (template: `info_default.html5`).

For the sake of simplicity, we will concentrate on the list display for our example. The respective field names can be 
found in the database table tl_member. Without specifying a condition, all specified data records are listed in 
the »Fields« area. Set the following specifications in the module:

| Field                      | Value                                            |
|:---------------------------|:-------------------------------------------------|
| **Table**                  | tl_member                                        |
| **Fields**                 | firstname, lastname, email, postal, street, city |
| **Condition**              | disable != 1                                     |
| **Items per page**         | 0                                                |


### Condition

The condition `disable != 1` filters the result of the query so that only members declared as »active« are 
displayed (in the sense of: No deactivated members).

For our club page we could imagine two fictitious member groups: »tournament riders« and »board«. Member groups are 
listed in the database table `tl_member_group`. We assume, that e.g. the group »board« is present here with an »id« 
of »2«. The reference of the group membership of a member is made in the table `tl_member` via the data set `groups`.

If you want to limit the member list to all »active« members of the group »board« you can enter the following 
condition: `disable != 1 AND groups LIKE '%2%'`.


### Template »list_default.html5«

The template »list_default.html5« is extensive, because it considers all eventualities of the representation in interaction 
with the module. For our example, together with the following information regarding the map display, we simplify the template.

Create a new template »list_default_member.html5« in the [template directory](/en/layout/templates/manage-template/) you 
have specified under »Themes« and then use this in your module »Listing«:

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
For simplicity's sake, we have entered rudimentary CSS information here directly in the template. Alternatively, 
you could also store them as [CSS assets](/en/layout/templates/template-assets/).
{{% /notice %}}


## New field for geo-coordinates

For the map display, we require the corresponding geo-coordinates of the address in the form of latitude and longitude 
for each member. If you do not already have them, create a new folder »contao/dca« in your Contao main directory 
with a file »tl_member.php«:

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

For Contao to accept this information, you have to update the »application cache« in the »System maintenance« section 
of the console or the Contao Manager.

Then call the Contao installation tool (or from Contao **4.9** on also via the console: 
`vendor/bin/contao-console contao:migrate`). The new field `myGeoData` is then created in the database table 
»tl_member«. In the Contao backend you can now use the field to enter the geo-coordinates of a member 
(in the form of "latitude,longitude").

{{% notice note %}}
Each time the file »contao/dca/tl_member.php« is changed, the »application cache« must be updated again.
{{% /notice %}}


### Determination of the geo-coordinates

You can find the required coordinates e.g. via [Nominatim/Openstreetmap](https://nominatim.openstreetmap.org/) or 
[Google Maps](https://www.google.com/maps/preview). For our example, the one-time determination and manual entry of the 
coordinates is reasonable for the new admission of a member. If you have a lot of data, you could use one of the numerous 
Contao [extensions](https://extensions.contao.org/?q=map&pages=1) to automatically determine the coordinates.

Another alternative is the extension [netzmacht/contao-leaflet-geocode-widget](https://extensions.contao.org/?q=netzmacht&pages=1&p=netzmacht%2Fcontao-leaflet-geocode-widget).


### Extension »netzmacht/contao-leaflet-geocode-widget«

The extension provides two backend [widgets](https://docs.contao.org/dev/framework/widgets/) for geocoding of addresses 
including the perimeter. Please see the [GitHub](https://github.com/netzmacht/contao-leaflet-geocode-widget) page for 
integration instructions. After [installing](/en/installation/install-extensions/) the extension you can customize 
»contao/dca/tl_member.php« as follows:

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

Instead of our previous text field we just change the »inputType« to »leaflet_geocode« according to the GitHub documentation. 
Afterwards, the Contao »application cache« needs to be updated (see above).

Even if the geo-coordinates of a member are still not »automatically« determined, you can now easily get them 
from within the Contao backend.


## Map display

The necessary prerequisites for a map display are thus available to us. The field `myGeoData` can be added in the module 
»Listing«:


| Field                      | Value                                                           |
|:---------------------------|:----------------------------------------------------------------|
| **Fileds**                 | firstname, lastname, email, postal, street, city, **myGeoData** |


### JavaScript Framework »leaflet.js«

The map is displayed via [OpenStreetMap](https://www.openstreetmap.de/) and to create the map we use the JavaScript 
framework [leaflet.js](https://leafletjs.com/). With the leaflet [download](https://github.com/Leaflet/Leaflet/tags) you 
will find the directory »dist« with the files »leaflet.js«, »leaflet.css« and »images/marker-icon.png« in the ZIP 
archive (currently v.1.7.1). Based on »leaflet.js« we create a JavaScript file `myMemberLeafletMap.js` with the following content

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
	new L.tileLayer('https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png', {
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

You have to adjust the directory information on the marker symbol (see: »myMarkerIconURL«) accordingly. Via `mapCssId` 
you define the CSS-ID for the HTML-container. The JavaScript function expects as argument an array with the corresponding 
information. This information is assigned to a group `memberGroup`, together with `OpenStreeMap` as map provider, for 
the purpose of displaying the map. Copy these files into a public directory of your Contao installation below »files«.

{{% notice note %}}
You still need to enable jQuery in the [page layout](/en/layout/theme-manager/manage-page-layouts/) of your theme. The 
example refers to the standard leaflet marker icon »images/marker-icon.png«. If you want to use a different, own symbol 
here, the specifications »iconSize«, »iconAnchor« and »popupAnchor« must also be adapted.
{{% /notice %}}


### Template adjustments »list_default_member.html5«

We supplement the existing template »list_default_member.html5« as follows:

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

First we reference the required CSS and JS files (see also: [CSS- AND JAVASCRIPT-ASSETS](/en/layout/templates/template-assets/)). 
Furthermore we define a HTML container with the CSS-ID `MYMEMBERMAP` for map display. In the PHP loop we collect the 
required coordinates via `tmpMemberMapData` and generate a JavaScript array zewcks call of our function `createMemberMap(arrMemberMapData)`.

{{% notice note %}}
The HTML container for map display requires a CSS height specification. We have created this for simplicity's sake 
set inline.
{{% /notice %}}

{{% notice info %}}
When the map is retrieved, communication between the browser and the OpenStreetMap server is initiated. This 
transmission must be observed in the DSGVO or ePrivacy.
{{% /notice %}}


### Map display after confirmation

The creation and display of the map should only take place after confirmation by the user. You could, for example, 
first display a picture of the map together with corresponding information. After the user confirms this declaration 
of consent, the actual map display is initiated. 

First we add a new CSS class "static" to the HTML container in our template together with the corresponding CSS definitions:

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

For our example we have only given a colour value here. Here you could use a background image for example. We replace 
the JavaScript call of our function as follows:

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

As long as there is no confirmation from the user, our »static« alternative is displayed. Otherwise the map will be 
created and displayed. Instead of a [cookie](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Cookie) we use 
the [localStorage](https://developer.mozilla.org/en-US/docs/Web/API/Window/localStorage) functionality of the 
browser (you could also use the [sessionStorage](https://developer.mozilla.org/de/docs/Web/API/Window/sessionStorage)).


### Useful leaflet plugins

The leaflet framework can be extended with [plug-ins](https://leafletjs.com/plugins.html). Here is a small selection:

- [Leaflet.fullscreen](https://github.com/Leaflet/Leaflet.fullscreen): Expands the map with a fullscreen view.
- [leaflet-grayscale](https://github.com/Zverik/leaflet-grayscale): Some map providers have SW/grayscale tiles. With 
this PlugIn you can display bel. maps in greyscale.
- [Leaflet.markercluster](https://github.com/Leaflet/Leaflet.markercluster): With numerous markers, depending on the 
zoom level, several markers are clearly summarised and displayed.