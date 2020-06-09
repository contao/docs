---
title: "Template vererben"
description: "Die Template Vererbung."
url: "layout/templates/vererbung"
aliases:
    - /de/layout/templates/vererbung/
weight: 30
---

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
(Block-)Inhalt. Wenn wir dieses Template einsetzen werden alle Seiten mit der zusätzlichen Meta-Angabe ausgeliefert.

