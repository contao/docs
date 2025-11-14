---
title: "Template vererben"
description: "Die Template Vererbung."
url: "layout/templates/php/vererbung"
aliases:
    - /de/layout/templates/php/vererbung/
weight: 40
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

#### Beispiel 1
Das Template `fe_page.html5` ist in mehrere Blöcke aufgeteilt (u.&nbsp;a. `head`, `meta`, `body`, `footer`).
Wir möchten lediglich eine weitere Meta-Angabe hinzufügen – dazu schreiben wir unser Template wie folgt:

```php
<?php $this->extend('fe_page'); ?>

<?php $this->block('meta'); ?>
  <?php $this->parent(); ?>
  <meta name="author" content="Max Muster">
<?php $this->endblock(); ?>
```

#### Beispiel 2
Möchte man den [TinyMCE-Editor](../../anleitungen/tinymce-konfiguration/) grundlegend oder eigene Ableitungen
anpassen, so sollten nur die entsprechenden Blöcke überarbeitet werden werden. Um zu ermitteln, welche
Blöcke zur Verfügung stehen, sieht man sich am besten das Originaltemplate `be_tinyMCE.html5` an.
Folgend ein Beispiel für eine Anpassung als `be_tinyMCE_Redakteure.html5`:

```php
<?php $this->extend('be_tinyMCE'); ?>

<?php $this->block('valid_elements'); ?>
extended_valid_elements: 'q[cite|class|title]',
<?php $this->endblock(); ?>

<?php $this->block('menubar'); ?>
menubar: '',
<?php $this->endblock(); ?>

<?php $this->block('toolbar'); ?>
toolbar: 'code',
<?php $this->endblock(); ?>
```
