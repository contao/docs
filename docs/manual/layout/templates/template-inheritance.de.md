---
title: "Template vererben"
description: "Die Template Vererbung."
url: "layout/templates/vererbung"
aliases:
    - /de/layout/templates/vererbung/
weight: 30
---

Contao erlaubt das Vererben von Templates. Dabei wird ein Template nicht komplett überschrieben, sondern nur gezielt
einzelne Teilbereiche (Blöcke) angepasst. 

### Blöcke anpassen
Zur Gliederung umschließen viele Templates ihre Inhalte bereits in `$this->block('name-des-blocks')` und
`$this->endblock()` Ausdrücke. Nur Inhalte, die in solchen Blöcken liegen, können angepasst werden.

Zunächst muss das Basis-Template mittels `$this->extend('name-des-templates')` angegeben werden. Anzupassende Blöcke
können dann, wie im originalen Template, durch Einschließen in `$this->block('name-des-blocks')` und `$this->endblock()`
angegeben und ihre Inhalte überschrieben werden.

Mittels `$this->parent()` lässt sich der originale Inhalt des Blocks ausgeben.

#### Beispiel
Das Template `fe_page.html5` ist in mehrere Blöcke aufgeteilt (u.&nbsp;a. `head`, `meta`, `body`, `footer`).
Wir möchten lediglich eine weitere Meta-Angabe hinzufügen – dazu schreiben wir unser Template wie folgt:

```php
<?php $this->extend('fe_page'); ?>

<?php $this->block('meta'); ?>
  <?php $this->parent(); ?>
  <meta name="author" content="Max Muster">
<?php $this->endblock(); ?>
```
