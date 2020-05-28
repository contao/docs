---
title: "Templates verwalten"
description: "Templates werden zur Ausgabe eines Moduls oder Inhaltelements verwendet."
url: "theme-manager/templates-verwalten"
weight: 40
---

Ein Template wird zur Ausgabe eines Moduls, Inhaltselements, Formulars oder einer anderen Komponente 
verwendet und beinhaltet HTML- und PHP-Code. Im Navigationsbereich "Layout" unter "Templates" können die Dateien erstellt, 
in Ordnern abgelegt und bearbeitet werden. Diese Anpassungen sind updatesicher.

{{% notice note %}}
Im [Debug-Modus](../../system/debug-modus/) werden die Template-Namen im HTML-Quellcode als Kommentare ausgegeben. 
Man kann hierüber nachvollziehen welches Template zum Einsatz kommt.
{{% /notice %}}


## Ordnerstruktur

Ein Template kann im Hauptverzeichnis abgelegt werden. Das entsprechende Template wird dann z. B. 
in einem Inhaltselement zur Auswahl angeboten und als `global` gekennzeichnet.

Im [Theme-Manager](../../theme-manager/themes-verwalten) kannst du einen vorhandenen Template-Ordner mit dem Theme 
verknüpfen. Die Template-Dateien in diesem Ordner werden bei der Auswahl dann mit dem jeweiligen `Theme-Namen` gekennzeichnet.

{{% notice note %}}
Template-Dateien in weiteren Unterodnern werden bei der Auswahl nicht berücksichtigt.
{{% /notice %}}


## Dateinamen

Die Template-Dateien werden zur Erkennung mit einem Präfix versehen. Beispielsweise deutet `ce_` auf ein
Inhaltselement hin. Möchte man z. B. die Ausgabe des Inhaltselement vom Typ "Text" ändern kann man das 
Template `ce_text.html5` hierzu verwenden. 

In diesem Fall haben die Template Änderungen Auswirkung auf alle Inhaltselemente vom Typ "Text". Dies ist nicht immer
erwünscht. Zur gezielten Nutzung kann man das Template individuell bezeichnen. Hierbei muss die jeweils vorgegebene
Template Bezeichnung beibehalten und lediglich erweitert werden. Also z. B. `ce_text.html5` 
umbenennen nach  `ce_text_individuell.html5`.

Dieses Template kann dann gezielt zur Ausgabe für ein (o. mehrere) Inhaltselement(e) vom Typ "Text" genutzt werden.


## CSS und JavaScript Assets

Oft werden zu einem individuellen Template zusätzliche Assets wie CSS- oder JavaScript-Dateien benötigt. Man kann diese 
Dateien grundsätzlich über das Seitenlayout eines Themes einbinden. Allerdings werden die Assets dann immer geladen 
auch wenn diese auf verschiedenen Seiten gar nicht benötigt werden. Es ist daher sinnvoll diese Dateien im Template 
selbst anzugeben. Hierbei stehen verschiedene Möglichkeiten zur Verfügung. 

Am einfachsten ist es die Dateien in einem öffentlichen Verzeichnis unterhalb von `files` anzulegen 
und dann im Template zu referenzieren:

```php
<link href="files/myfolder/custom.css" rel="stylesheet">
<script src="files/myfolder/custom.js"></script>
```

Alternativ kann man die Assets im Template auch so hinterlegen, das diese z. B. im HTML-Header oder -Footer 
der Seite ausgegeben werden:

```php
$GLOBALS['TL_CSS'][] = 'files/myfolder/custom.css|static';
$GLOBALS['TL_JAVASCRIPT'][] = 'files/myfolder/custom.js|static';
```

Diese Umsetzung bietet weitere Optionen. Mit Angabe von `static` werden die Dateien z. B. zu den bestehenden Assets
eines Seitenlayouts hinzugefügt bzw. diese zusammengefasst. Eine detaillierte Beschreibung aller Optionen findest du 
in der Entwickler-Dokumentation unter [Adding CSS & JavaScript Assets](https://docs.contao.org/dev/framework/asset-management/).


## Vererbung

Der Aufbau eines Templates kann von einfachen bis komplexen Inhalten variieren. Die meisten Templates werden über 
benannte Block Funktionen (`block()` und `endblock()`) in Bereiche gegliedert. Über die Template-Vererbung kann man 
gezielt auf diese Bereiche zugreifen. Individuelle Template-Änderungen werden hiermit übersichtlicher.

Das Template `fe_page.html` ist in mehrere Blöcke aufgeteilt (u. a. `head`, `meta`, `body`, `footer` usw.). Wir möchten
lediglich eine zusätzliche Meta-Angabe hinzufügen. 

Hierzu erstellen wir ein neues Template `fe_page_meta.html5` mit folgenden Inhalt:

```php
<?php $this->extend('fe_page'); ?>

<?php $this->block('meta'); ?>
  <?php $this->parent(); ?>

  <meta name="author" content="John Doe">
<?php $this->endblock(); ?>
```

Die Funktion `extend()` definiert das übergeordnete Template und die Funktion `parent()` übernimmt den originalen 
(Block-) Inhalt. Wenn wir dieses Template einsetzen werden alle Seiten mit der zusätzlichen Meta-Angabe ausgeliefert.


## Templates mischen

Mit Hilfe der `insert()` Funktion kann ein Template in ein anderes Template eingefügt werden. Die Funktion akzeptiert 
auch die Übergabe von zusätzlichen Variablen als zweiten Parameter.

```php
<?php $this->insert('template_name', array('key'=>'value')); ?>

// Übergibt alle Variablen aus dem aktuellen Template
<?php $this->insert('template_name', $this->getData()); ?>
```

Wir erstellen ein Template `image_copyright.html5` mit folgenden Inhalt:

```php
// image_copyright.html5
<small>Fotografiert von <?php echo $this->name; ?>, lizenziert als <?php echo $this->license; ?></small>
```

Das Template `ce_image.html5` beinhaltet den Block `content`. Über die Vererbung überschreiben wir diesen Block Inhalt
und mischen bzw. fügen den Inhalt aus dem eigenen Copyright-Template (`image_copyright.html5`) hinzu:

```php
// ce_image_copyright.html5
<?php $this->extend('ce_image'); ?>

<?php $this->block('content'); ?>
  <?php $this->parent(); ?>
  
  <?php $this->insert('image_copyright', array('name'=>'Donna Evans', 'license'=>'Creative Commons')); ?>

<?php $this->endblock(); ?>
```

Wird das Template in einem Inhaltselement vom Typ "Bild" herangezogen werden unsere Copyright-Angaben zusätzlich 
zur eigentlichen Bild Ausgabe ausgegeben:

- Fotografiert von Donna Evans, lizenziert als Creative Commons