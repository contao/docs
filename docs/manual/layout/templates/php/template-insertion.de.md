---
title: "Template mischen"
description: "Ein Template mischen."
url: "layout/templates/php/insertion"
aliases:
    - /de/layout/templates/php/insertion/
weight: 50
---

Mit Hilfe der `insert()`-Funktion kann ein Template in ein anderes Template eingefügt werden. Die Funktion akzeptiert 
die Übergabe von Variablen als optionalen zweiten Parameter.

```php
<?php $this->insert('template_name', array('key'=>'value')); ?>

// Übergibt alle Variablen aus dem aktuellen Template
<?php $this->insert('template_name', $this->getData()); ?>
```

#### Beispiel
Wir erstellen ein Template `image_copyright.html5` mit folgendem Inhalt:

```php
// image_copyright.html5
<small>Fotografiert von <?php echo $this->name; ?>, lizenziert als <?php echo $this->license; ?></small>
```

Dieses Template lässt sich nun an beliebiger Stelle wiederverwenden. Hier fügen wir z.&nbsp;B. dem `content` Block des
`ce_image.html5` Templates unseren Copyright-Hinweis (`image_copyright.html5`) hinzu:

```php
// ce_image_copyright.html5
<?php $this->extend('ce_image'); ?>

<?php $this->block('content'); ?>
  <?php $this->parent(); ?>
  
  <?php $this->insert('image_copyright', array('name'=>'Donna Evans', 'license'=>'Creative Commons')); ?>

<?php $this->endblock(); ?>
```

Wird das Template ausgegeben, erscheint nun unter dem Bild:
```html
Fotografiert von Donna Evans, lizenziert als Creative Commons
```
