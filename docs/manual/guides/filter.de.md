---
title: "Frontend-Filter Umsetzung"
description: "Optionen zur Umsetzung eines Frontend-Filters."
aliases:
    - /de/anleitungen/filter/
weight: 70
tags: 
    - "Theme"
    - "Template"    
---


Contao bietet zahlreiche Möglichkeiten zur Inhaltserstellung. Die jeweiligen Vor- und Nachteile können bei der 
Abwägung und Auswahl hilfreich sein. Als Beispiel hier anhand der Umsetzung eines »Frontend-Filters«:

Die animierte Filterung beliebiger Inhalte wird gerne bei der Darstellung von z. B. Referenzen herangezogen, 
ohne dass hierbei die Webseite neu geladen werden muss. Den zu filternden Inhalten müssen zunächst entsprechende 
Kategorien zugeordnet werden. Im Anschluss kann die Darstellung gezielt über diese Kategorien beeinflusst werden.


## Umsetzung über eine Erweiterung {#umsetzung-ueber-eine-erweiterung}

Für unsere Anforderung kannst du beispielsweise die Erweiterung 
[codefog/contao-elements-filter](https://extensions.contao.org/?q=filter&pages=1&p=codefog%2Fcontao-elements-filter) nutzen.
Weitere Informationen hierzu findest du dann auf der [GitHub](https://github.com/codefog/contao-elements-filter) 
Seite des Autors.

{{% notice info %}}
<strong>Vorteil:</strong>  
Eine [Contao Erweiterung](https://extensions.contao.org/) realisiert eine spezielle Aufgabe, ist zumeist kostenfrei und 
kann leicht installiert werden. Du musst dir dabei keine Gedanken um die eigentliche technische Umsetzung machen. Die 
Bearbeitung für dich oder weitere Redakteure erfolgt bequem über die bekannten Contao-Eingabemöglichkeiten. Eine 
Dokumentation, gerade bei kostenfreien Erweiterungen, erfolgt zumeist über die entsprechenden GitHub-Seiten. Als
Alternative findest du hilfreiche Unterstützung über die Community im [Contao Forum](https://community.contao.org/de/).
<br><br><strong>Nachteil:</strong>  
Bei einem Contao-Update oder Wechsel der PHP-Version kann es vorkommen, dass die Erweiterung hierfür noch nicht ausgelegt 
ist. In diesem Fall bist du auf die Anpassungen des Autors angewiesen. Gerade bei kostenfreien Angeboten erhältst du aber 
auch dann zeitnah Hilfe mit Unterstützung der [Contao Community](https://community.contao.org/de/).
{{% /notice %}}


## Umsetzung ohne Erweiterung

Bekannte JavaScript Lösungen für unsere Anforderung sind z. B. [Isotope](https://isotope.metafizzy.co/) 
oder [MixItUp](https://github.com/patrickkunka/mixitup). Bei einer kommerziellen Nutzung ist hierbei der Erwerb von Lizenzen 
notwendig. Für unser Beispiel nutzen wir die Open Source Lösung [Filterizr](https://yiotis.net/filterizr/#/). 


### Nutzung von »Filterizr«

Beispiele und Dokumentation findest du auf der [Filterizr Website](https://yiotis.net/filterizr/#/tutorials/quickstart) 
und auf [GitHub](https://github.com/giotiskl/filterizr). Die Lösung kann wahlweise als »jQuery-Plugin« oder als 
»Vanilla JS« implementiert werden. Wir verwenden im folgenden Beispiel Letzteres. 

Über den [Download](https://github.com/giotiskl/filterizr/tags) findest du im Anschluss in dem ZIP-Archiv das 
Verzeichnis »dist« mit der Datei »vanilla.filterizr.min.js« vor. Kopiere diese Datei in ein öffentliches Verzeichnis 
deiner Contao Installation unterhalb von »files«.

Für das »Filterizr« Script müssen die zu filternden Inhalte mit der CSS-Klasse `filtr-item` deklariert werden. Die
Kategorie Zuordnung erfolgt über ein HTML5 Data-Attribut `data-category`. Ein beispielhafter HTML-Aufbau könnte demnach
wie folgt aussehen und muss dann innerhalb von Contao abgebildet werden:

```html
<ul>
  <li data-filter="all">Alle Tiere</li>
  <li data-filter="Hund">Nur Hunde</li>
  <li data-filter="Katze">Nur Katzen</li>
</ul>

<div class="filter-container">

  <div class="filtr-item" data-category="Hund">
    <img src="sample1.jpg" />
  </div>
  <div class="filtr-item" data-category="Katze">
    <img src="sample2.jpg" />
  </div>

</div>

<script type="text/javascript" src="files/MyPathToFile/vanilla.filterizr.min.js"></script>
<script>const filterizr = new Filterizr('.filter-container');</script>
```

Die obige HTML-Struktur kann mit den Contao eigenen [Inhaltselementen](/de/artikelverwaltung/inhaltselemente/) erstellt 
werden. Hierbei verwenden wir für die HTML-Blöcke das Inhaltselement vom Typ »HTML« und für die eigentlichen Inhalte 
ein oder mehrere Element(e) vom Typ »Text«. Die Umsetzung im Contao Backend wäre daher:

{{% expand "Inhaltselement vom Typ »HTML«" %}}
```html
<ul>
  <li data-filter="all">Alle Tiere</li>
  <li data-filter="Hund">Nur Hunde</li>
  <li data-filter="Katze">Nur Katzen</li>
</ul>
```
{{% /expand %}}


{{% expand "Inhaltselement vom Typ »HTML«" %}}
```html
<div class="filter-container">
```
{{% /expand %}}


{{% expand "Ein o. mehrere Inhaltselement(e) vom Typ »Text«" %}}
Trage hier wie gewohnt deine Texte/Fotos ein. Im Bereich »Experteneinstellungen CSS-ID/Klasse« setzt du die 
benötigte CSS-Klasse `filtr-item`.
{{% /expand %}}


{{% expand "Inhaltselement vom Typ »HTML«" %}}
```html
</div>

<script type="text/javascript" src="files/MyPathToFile/vanilla.filterizr.min.js"></script>
<script>const filterizr = new Filterizr('.filter-container');</script>
```
{{% /expand %}}


### Mit Template-Anpassung

Es fehlt nur noch die Zuordnung unserer Kategorien über das HTML5 Data-Attribut. Im Inhaltselement vom Typ »Text« 
fehlt diese Eingabemöglichkeit. Wir können dies über angepasste [Contao Templates](/de/templates/) realisieren. 

Bei Eingabe von bestimmten, per Konvention festgelegten, Angaben im Bereich »Experteneinstellungen CSS-ID/Klasse« 
sollen diese über das Template als HTML5 Data-Attribut ausgegeben werden. Bei Eingabe von `filtr-item DATA-Hund` im Bereich 
CSS-Klasse möchten wir folgende Ausgabe erzielen:

```html
...
<div class="ce_text filtr-item block" data-category="Hund">
...
```

Erstelle dir hierzu in dem von dir unter »Themes« vorgegebenen [Template-Verzeichnis](/de/layout/templates/verwaltung/) 
zwei neue Templates basierend auf »ce_text.html5« und »block_searchable.html5«. 

Beispielsweise als »ce_text_filter.html5« und »block_searchable_filter.html5« und benutze das neue 
Template »ce_text_filter.html5« in deinen zu filternden Inhaltselementen vom Typ »Text«.


```html
// ce_text_filter.html5

<?php $this->extend('block_searchable_filter'); ?>

<?php $this->block('content'); ?>

  <?php if (!$this->addBefore): ?>
    <?= $this->text ?>
  <?php endif; ?>

  <?php if ($this->addImage): ?>
    <?php $this->insert('image', $this->arrData); ?>
  <?php endif; ?>

  <?php if ($this->addBefore): ?>
    <?= $this->text ?>
  <?php endif; ?>

<?php $this->endblock(); ?>
```


```html
// block_searchable_filter.html5

<?php
$strDelimiter = "DATA-";
$strPattern = '/'.$strDelimiter.'(.+?)\b/i';  
$strDataAttr = "data-category"; 
$strCSS = $this->class; 

if ( substr_count($strCSS, $strDelimiter) > 0 ) {

  preg_match_all($strPattern, $strCSS, $arrMatches, PREG_PATTERN_ORDER, 0);

  for( $i = 0; $i <= count($arrMatches); $i++) {
    $strCSS = str_replace($arrMatches[0][$i], "", $strCSS);          
    $arrMatchedValues[] = $arrMatches[1][$i];      
  }    
  $strData = $strDataAttr.'="'.rtrim(implode(", ", $arrMatchedValues), ", ").'"';
}
?>

<div class="<?= $strCSS ?> block"<?= $strData ?><?= $this->cssID ?><?php if ($this->style): ?> style="<?= $this->style ?>"<?php endif; ?>>

  <?php $this->block('headline'); ?>
    <?php if ($this->headline): ?>
      <<?= $this->hl ?>><?= $this->headline ?></<?= $this->hl ?>>
    <?php endif; ?>
  <?php $this->endblock(); ?>

  <?php $this->block('content'); ?>
  <?php $this->endblock(); ?>

</div>
```

{{% notice tip %}}
Das Script erwartet die Inhalte innerhalb eines HTML-Blocks `<div class="filter-container">...</div>`. Zur 
übersichtlicheren Backend-Darstellung könntest du die Contao [Accordeon](/de/artikelverwaltung/inhaltselemente/#akkordeon) 
Elemente »Umschlag Anfang« und »Umschlag Ende« zweckentfremden. Im Element »Umschlag Anfang« setzt du dann die 
CSS-Klasse `filter-container` ein.<br><br>
Weiterhin haben wir einfachheitshalber die JavaScript-Referenzen direkt im Inhaltselement eingetragen. Alternativ
könntest du diese auch als [JavaScript Asset im Template](/de/layout/templates/assets/) hinterlegen.
{{% /notice %}}

{{% notice info %}}
<strong>Vorteil:</strong>  
Du bist nicht auf Erweiterungen angewiesen und du hast die vollständige Kontrolle hinsichtlich der Umsetzung 
und der Pflege. Bei Contao Updates müssen u. U. lediglich mögliche Änderungen der Core Templates berücksichtigt werden.
<br><br>
<strong>Nachteil:</strong>  
Für Template-Anpassungen in dieser Form sind zumindest rudimentäre PHP-Kenntnisse notwendig. Die 
[Contao Community](https://community.contao.org/de/) steht dir bei derartigen Fragen hilfreich zur Seite. Die Nutzung 
der HTML5 Data-Attribute ist für Redakteure nicht offensichtlich und bedarf entsprechender Dokumentation.
{{% /notice %}}


### Mit Anpassung des »Data Container Arrays«

Für das nächste Beispiel übernehmen wir die bisherige Umsetzung über die Inhaltselemente. Zur Eingabe der HTML5 Data-Attribute 
werden wir für das Inhaltselement vom Typ »Text« allerdings ein neues, zusätzliches Eingabefeld erstellen und erweitern hierzu
das Contao [Data Container Array](https://docs.contao.org/dev/reference/dca/) (DCA).

In der Developer Documentation findest du [ein Beispiel](https://docs.contao.org/dev/getting-started/dca/) zur
Contao [DCA](https://docs.contao.org/dev/framework/dca/) Manipulation. In Zusammenhang mit Inhaltselementen ist hierbei 
die Contao-Datei [tl_content.php](https://github.com/contao/core-bundle/blob/master/src/Resources/contao/dca/tl_content.php) 
und die entsprechende Datenbanktabelle `tl_content` verantwortlich die wir wie folgt erweitern:

Sofern noch nicht vorhanden, erstellst du dir in deinem Contao-Hauptverzeichnis ein neues Verzeichns `contao/dca` mit 
einer Datei `tl_content.php`:

```php
// contao/dca/tl_content.php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_content']['fields']['myCustomDataAttributes'] = [
  'label'     => ['Data-Attribut', 'Hier können Sie Data-Attribute vergeben.'],
  'inputType' => 'keyValueWizard',
  'default'   => serialize([['key' => 'data-category']]),
  'eval'      => ['tl_class' => 'w50'],
  'exclude'   => true,
  'sql'       => "text NULL",
];

PaletteManipulator::create()
  ->addLegend('Einstellungen Data-Attribute', 'expert_legend', PaletteManipulator::POSITION_AFTER)
  ->addField('myCustomDataAttributes', 'Einstellungen Data-Attribute', PaletteManipulator::POSITION_APPEND)
  ->applyToPalette('text', 'tl_content')
;

```

Damit Contao diese Angaben übernimmt musst du im Anschluss über den [Contao Manager](/de/installation/contao-manager/) 
im Bereich »Systemwartung« den »Anwendungs-Cache« aktualisieren. Rufe dann das [Contao-Installtool](/de/installation/contao-installtool/) auf. Dieses erkennt 
das neue Feld und bietet dir die Erstellung in der Datenbanktabelle »tl_content« an. Bei jeder Änderung der Datei 
»contao/dca/tl_content.php« wird dies dann erneut notwendig.

Das Inhaltselement vom Typ »Text« enthält nun ein neues Eingabefeld (als Schlüssel/Wert-Paar) für unsere 
HTML5 Data-Attribute unterhalb der »Experteneinstellungen«. Beispielsweise zur Angabe von `data-category` im Feld 
»Schlüssel« und einem Eintrag `Hund` im Feld »Wert«.

Zur Ausgabe auf der Webseite müssen wir auch hier wieder die Template-Dateien anpassen. Analog zum vorherigen Beispiel 
verwenden wir hierzu wieder die beiden Template Dateien »ce_text_filter.html5« und »block_searchable_filter.html5«. 

```html
// ce_text_filter.html5

<?php $this->extend('block_searchable_filter'); ?>

<?php $this->block('content'); ?>

  <?php if (!$this->addBefore): ?>
    <?= $this->text ?>
  <?php endif; ?>

  <?php if ($this->addImage): ?>
    <?php $this->insert('image', $this->arrData); ?>
  <?php endif; ?>

  <?php if ($this->addBefore): ?>
    <?= $this->text ?>
  <?php endif; ?>

<?php $this->endblock(); ?>
```


```html
// block_searchable_filter.html5

<?php if ($this->myCustomDataAttributes) {
  $dataAttributesString = "";
  $dataAttributes = \StringUtil::deserialize($this->myCustomDataAttributes); 
  $parsedDataAttributes = [];

  foreach ($dataAttributes as $index=>$dataAttribute) {
    $parsedDataAttributes[] = 'data-' . str_replace('data-', '', $dataAttribute['key']) 
    . '="' . $dataAttribute['value'] 
    . '"';
  }
  $dataAttributesString = implode(' ' , $parsedDataAttributes);
}
?>

<div class="<?= $this->class ?> block"<?= $this->cssID ?><?php if ($this->style): ?> style="<?= $this->style ?>"<?php endif; ?> <?= $dataAttributesString ?>>

  <?php $this->block('headline'); ?>
    <?php if ($this->headline): ?>
      <<?= $this->hl ?>><?= $this->headline ?></<?= $this->hl ?>>
    <?php endif; ?>
  <?php $this->endblock(); ?>

  <?php $this->block('content'); ?>
  <?php $this->endblock(); ?>

</div>
```

{{% notice info %}}
<strong>Vorteil:</strong>  
Du hast die vollständige Kontrolle hinsichtlich der Umsetzung und der Pflege. Die erforderlichen Angaben können von dir 
und deinen Redakteuren bequem über Eingabefelder gesetzt werden.<br><br>
<strong>Nachteil:</strong>  
Rudimentäre Kenntnisse in PHP und zum gut [dokumentierten Contao DCA](https://docs.contao.org/dev/reference/dca/) 
sind notwendig. Die [Contao Community](https://community.contao.org/de/) steht dir auch bei derartigen Fragen 
hilfreich zur Seite. 
{{% /notice %}}


### Mit »RockSolid Custom Elements«

Bei den »[RockSolid Custom Elements](https://extensions.contao.org/?q=rocksolid&pages=1&p=madeyourday%2Fcontao-rocksolid-custom-elements)« 
(RSCE) handelt es sich um eine Contao Erweiterung die dir die Erstellung 
[individueller Inhaltselemente](https://rocksolidthemes.com/de/contao/plugins/custom-content-elements/dokumentation) und
Frontend-Module mit bequemen Eingabemöglichkeiten und deren Ausgabe in Contao ermöglicht. 

Falls du dich fragen solltest, warum in diesem Kontext wieder eine Erweiterung vorgestellt wird:

{{% notice info %}}
<strong>Vorteil:</strong>  
Du nutzt drei unterschiedliche Erweiterungen von verschiedenen Autoren z. B. einen »Frontend-Filter«, einen 
alternativen »Content-Slider« und deine favorisierte »Foto-Gallerie». Je mehr Erweiterungen zum Einsatz kommen, desto 
höher ist möglicherweise dein Aufwand bei kommenden Contao Updates.<br><br>
Mit Einsatz von »RSCE« beschränkst du diesen Umstand auf eine einzige Erweiterung 
und du kannst dir und den Redakteuren für alle drei Anforderungen dennoch eine bequeme Bearbeitung innerhalb von Contao 
ermöglichen. Darüber hinaus wird die Erweiterung vom Autor Martin Auswöger ([@ausi](https://github.com/ausi) / 
Mitglied im Contao Core-Team) gepflegt und aktuell gehalten.<br><br>
<strong>Nachteil:</strong>  
Kenntnisse zum gut [dokumentierten Contao DCA](https://docs.contao.org/dev/reference/dca/) 
sind notwendig. Die [Contao Community](https://community.contao.org/de/) steht dir auch bei derartigen Fragen 
hilfreich zur Seite. 
{{% /notice %}}

Die »RSCE« Erweiterung orientiert sich an den bestehenden Contao-Konventionen. Du benötigst lediglich zwei Dateien, die
im angegebenen Template-Verzeichnis deines Themes angelegt werden.

Dabei handelt es sich einerseits um eine ».php« Konfigurationsdatei mit Contao 
[DCA Informationen](https://docs.contao.org/dev/reference/dca/) und einer ».html5« [Template-Datei](/de/layout/templates/) 
zur Ausgabe. Bei den Dateinamen musst du folgende Konvention berücksichtigen:

Der Name der Template-Datei muss mit »rsce_« beginnen, die Konfigurationsdatei muss den selben Namen wie das Template 
und zusätzlich das Suffix »_config« beinhalten: Beispielsweise »rsce_my_filter.html5« und »rsce_my_filter_config.php».

```php
// rsce_my_filter_config.php

return array(
  'label' => array('Filter-Element', 'Inhalte für Frontend-Filter'),
  'types' => array('content'),
  'contentCategory' => 'texts',
  'standardFields' => array('headline', 'text', 'image', 'cssID'),
  'wrapper' => array(
    'type' => 'none',
  ),
  'fields' => array(
  'description' => array(
    'label' => array('Data-Attribut', 'Angabe eines o. mehrerer HTML Data-Attribut(e)'),
    'inputType' => 'group',
  ),
  'data' => array(
    'label'     => ['Data-Attribut:', 'Attribut-Bezeichnung / Attribut-Wert'],
    'inputType' => 'keyValueWizard',
    'default'   => serialize([['key' => 'data-category']]),
    'eval'      => ['tl_class' => 'w50'],
    ),
  ),
);

```

```html
// rsce_my_filter.html5

<?php if ($this->data){

  $dataAttributesString = "";
  $dataAttributes = $this->data; 
  $parsedDataAttributes = [];

    foreach ($dataAttributes as $index=>$dataAttribute) {
      $parsedDataAttributes[] = 'data-' . str_replace('data-', '', $dataAttribute['key']) 
      . '="' . $dataAttribute['value'] 
      . '"';
    }
    $dataAttributesString = implode(' ' , $parsedDataAttributes);
}
?>

<div class="<?= $this->class ?> block" <?= $this->cssID ?> <?= $dataAttributesString ?>>
  <?php if ($this->headline): ?>
    <<?= $this->hl ?>><?= $this->headline ?></<?= $this->hl ?>>
  <?php endif; ?>

  <?php if ($this->addBefore): ?>
    <?= $this->text ?>
  <?php endif; ?>

  <?php if ($this->addImage): ?>
    <?php $this->insert('image', $this->arrData); ?>
  <?php endif; ?>

  <?php if (!$this->addBefore): ?>
    <?= $this->text ?>
  <?php endif; ?>
</div>
```

Hierüber erhältst du ein neues, eigenes Inhaltselement unter der Bezeichnug »Filter-Element» zur Auswahl. Dieses kannst
du im Anschluss für die zu filternden Inhalte in Kombination mit den Inhaltselementen vom Typ »HTML« (s. o.) einsetzen. 

{{% notice tip %}}
Mit der »RSCE« Erweiterung könntest du dir auch eigene 
[Umschlags-Elemente](https://rocksolidthemes.com/de/contao/plugins/custom-content-elements/dokumentation) erstellen 
und diese statt der bisherigen Inhaltselemente vom Typ »HTML« verwenden.
{{% /notice %}}

{{% notice note %}}
Die Erweiterung »[MetaModels](/de/erweiterungen/metamodels/)« verfolgt einen ähnlichen Ansatz und konfrontiert dich 
dabei nicht mit einer direkten Contao »DCA Konfiguration«. Allerdings geht diese Erweiterung weit über die hier 
erfoderlichen Anforderungen hinaus. Die Lernkurve (s. [Dokumentation](https://metamodels.readthedocs.io/de/latest/)) 
ist entsprechend höher.
{{% /notice %}}


## Fazit

Contao bietet zahlreiche Möglichkeiten zur Umsetzung deiner Anforderungen. Die Art der Umsetzung ist immer eine
Abwägung zwischen Komfort und späterem Update Aufwand. Gerade bei clientseitigen Lösungen, die lediglich auf ein 
Zusammenspiel von HTML, CSS und JavaScript beruhen, liefert Contao vielfältige Lösungen unabhängig von 
existierenden Erweiterungen.
