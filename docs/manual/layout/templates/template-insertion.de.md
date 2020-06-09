---
title: "Template mischen"
description: "Ein Template mischen."
url: "layout/templates/insertion"
aliases:
    - /de/layout/templates/insertion/
weight: 40
---

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

Das Template `ce_image.html5` beinhaltet den Block `content`. Über die Vererbung überschreiben wir diesen Block-Inhalt
und mischen bzw. fügen den Inhalt aus dem eigenen Copyright-Template (`image_copyright.html5`) hinzu:

```php
// ce_image_copyright.html5
<?php $this->extend('ce_image'); ?>

<?php $this->block('content'); ?>
  <?php $this->parent(); ?>
  
  <?php $this->insert('image_copyright', array('name'=>'Donna Evans', 'license'=>'Creative Commons')); ?>

<?php $this->endblock(); ?>
```

Wird das Template in einem Inhaltselement vom Typ »Bild« herangezogen werden unsere Copyright-Angaben zusätzlich 
zur eigentlichen Bild Ausgabe ausgegeben:

- Fotografiert von Donna Evans, lizenziert als Creative Commons
