---
title: "Frontend-Filter implementation"
description: "Options for implementing a frontend-filter"
aliases:
  - /en/guides/filter/
weight: 70
tags: 
    - "Theme"
    - "Template"    
---


Translation here ...


## With an Extension

Translation here ...

{{% notice info %}}
<strong>Pro:</strong><br>
Translation here ...
<br><br><strong>Contra:</strong><br>
Translation here ...
{{% /notice %}}


## Without extension

Translation here ...


### Use of »Filterizr«

Translation here ...

```html
<ul>
  <li data-filter="all">All animals</li>
  <li data-filter="Dog">Dogs only</li>
  <li data-filter="Cat">Cats only</li>
</ul>

<div class="filter-container">

  <div class="filtr-item" data-category="Dog">
    <img src="sample1.jpg" />
  </div>
  <div class="filtr-item" data-category="Cat">
    <img src="sample2.jpg" />
  </div>

</div>

<script type="text/javascript" src="files/MyPathToFile/vanilla.filterizr.min.js"></script>
<script>const filterizr = new Filterizr('.filter-container');</script>
```


### With template adaptation

Translation here ...

{{% expand "Content element of type »HTML«" %}}
```html
<ul>
  <li data-filter="all">All animals</li>
  <li data-filter="Dog">Dogs only</li>
  <li data-filter="Cat">Cats only</li>
</ul>
```
{{% /expand %}}


{{% expand "Content element of type »HTML«" %}}
```html
<div class="filter-container">
```
{{% /expand %}}


{{% expand "One or more content element(s) of type »Text«" %}}
Translation here ...
{{% /expand %}}


{{% expand "Content element of type »HTML«" %}}
```html
</div>

<script type="text/javascript" src="files/MyPathToFile/vanilla.filterizr.min.js"></script>
<script>const filterizr = new Filterizr('.filter-container');</script>
```
{{% /expand %}}

Translation here ...

```html
...
<div class="ce_text filtr-item block" data-category="Dog">
...
```

Translation here ...


```php
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


```php
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
Translation here ...
{{% /notice %}}

{{% notice info %}}
<strong>Pro:</strong><br>
Translation here ...
<br><br>
<strong>Contra:</strong><br>
Translation here ...
{{% /notice %}}


### Manipulation of »Data Container Arrays«

Translation here ...

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

Translation here ...

```php
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


```php
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
<strong>Pro:</strong><br>
Translation here ...<br><br>
<strong>Contra:</strong><br>
Translation here ...
{{% /notice %}}


### With »RockSolid Custom Elements«

Translation here ...

{{% notice info %}}
<strong>Pro:</strong><br>
Translation here ...<br><br>
<strong>Contra:</strong><br>
Translation here ...
{{% /notice %}}

Translation here ...

```php
// rsce_my_filter_config.php

return array(
  'label' => array('Filter-Element', 'Frontend-Filter Content'),
  'types' => array('content'),
  'contentCategory' => 'texts',
  'standardFields' => array('headline', 'text', 'image', 'cssID'),
  'wrapper' => array(
    'type' => 'none',
  ),
  'fields' => array(
  'description' => array(
    'label' => array('Data-Attribut', 'Specification of one or more HTML Data attribute(s)'),
    'inputType' => 'group',
  ),
  'data' => array(
    'label'     => ['Data-Attribut:', 'Attribut-Name / Attribut-Value'],
    'inputType' => 'keyValueWizard',
    'default'   => serialize([['key' => 'data-category']]),
    'eval'      => ['tl_class' => 'w50'],
    ),
  ),
);
```

```php
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

{{% notice tip %}}
Translation here ...
{{% /notice %}}

{{% notice note %}}
Translation here ...
{{% /notice %}}


## Conclusion

Translation here ...