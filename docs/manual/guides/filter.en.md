---
title: "Front end filter implementation"
description: "Options for implementing a front end filter"
aliases:
  - /en/guides/filter/
weight: 70
tags: 
    - "Theme"
    - "Template"    
---


Contao offers numerous possibilities for content creation. The respective advantages and disadvantages can be helpful 
when weighing and selecting. As an example here is the implementation of a »front end filter«:

The animated filtering of arbitrary contents is often used to display e.g. references without having to reload the 
website. The contents to be filtered must first be assigned to appropriate categories. Subsequently, the presentation 
can be influenced specifically via these categories.


## With an Extension

For our request you can use the extension [codefog/contao-elements-filter](https://extensions.contao.org/?q=filter&pages=1&p=codefog%2Fcontao-elements-filter) for example. You can find more information 
on the author's [GitHub](https://github.com/codefog/contao-elements-filter) page.

{{% notice info %}}
<strong>Pro:</strong>  
A Contao [extension](https://extensions.contao.org/) performs a special task, is mostly free of charge and can be easily 
installed. You do not have to worry about the actual technical implementation. The editing for you or other editors is 
easily done using the well-known Contao input options. Documentation, especially for free extensions, is usually done 
via the corresponding GitHub pages. Alternatively, you can find helpful support via the community in the 
[Contao forum](https://community.contao.org/en/).<br><br>
<strong>Contra:</strong>  
If you update Contao or change the PHP version, it might happen that the extension is not yet ready for this. In this 
case you have to rely on the author's modifications. Especially if you get a free offer, you will get help from the 
Contao [community](https://community.contao.org/en/) too.
{{% /notice %}}


## Without extension

Known JavaScript solutions for our requirements are e.g. [Isotopes](https://isotope.metafizzy.co/) or 
[MixItUp](https://www.kunkalabs.com/mixitup/). In case of a commercial use the purchase of licenses is necessary. 
For our example we use the open source solution [Filterizr](https://yiotis.net/filterizr/#/).


### Use of »Filterizr«

Examples and documentation can be found on the [Filterizr website](https://yiotis.net/filterizr/#/tutorials/quickstart) 
and on [GitHub](https://github.com/giotiskl/filterizr). The solution can be implemented either 
as »jQuery Plugin« or as »Vanilla JS«. We use the latter in the following.

After the [download](https://github.com/giotiskl/filterizr/tags) you will find the directory »dist« with the 
file »vanilla.filterizr.min.js« in the zip archive. Copy this file into a public directory of your Contao installation 
below »files«.

For the »Filterizr« script, the content to be filtered must be declared with the CSS class `filtr-item`. The category 
assignment is done via a HTML5 data attribute `data-category`. An exemplary HTML structure could look like the following 
and must be mapped within Contao:

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

The above HTMl structure can be created with Contao's own content elements. We use the content element of type »HTML« 
for the HTML blocks and one or more elements of type »Text« for the actual content. The implementation in the Contao 
backend would therefore be:

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
Enter your texts/photos here as usual. In the section »Expert settings CSS-ID/Class« you set the required 
CSS class `filtr-item`.
{{% /expand %}}


{{% expand "Content element of type »HTML«" %}}
```html
</div>

<script type="text/javascript" src="files/MyPathToFile/vanilla.filterizr.min.js"></script>
<script>const filterizr = new Filterizr('.filter-container');</script>
```
{{% /expand %}}


### With template adaptation

The only thing missing is the assignment of our categories via the HTML5 data attribute. In the content element of 
type »Text« this input option is missing. We can realize this by using customized Contao templates.

When certain conventionally defined specifications are entered in the »Expert settings CSS-ID/Class« section, these 
are to be output as HTML5 data attributes via the template. When entering `filtr-item DATA dog` in the CSS class area, we 
want to achieve the following output:

```html
...
<div class="ce_text filtr-item block" data-category="Dog">
...
```

Create two new templates based on »ce_text.html5« and »block_searchable.html5« in the template directory you 
specified under »Themes«.

For example as »ce_text_filter.html5« and »block_searchable_filter.html5« and use the new template 
»ce_text_filter.html5« in your content elements of type »text« to be filtered.

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
The script expects the contents within a HTML block `<div class="filter-container">...</div>`. For a clearer backend 
display, you could use the Contao [Accordeon elements](/en/article-management/content-elements/#accordion) 
»Envelope start« and »Envelope end« for other purposes. In the element »Envelope start« you then use the CSS class 
»filter-container«.<br><br>
Furthermore, for simplicity's sake, we have entered the JavaScript references directly in the content element. 
Alternatively, you could also store them as [JavaScript Asset](/en/layout/templates/template-assets/) in the template.
{{% /notice %}}

{{% notice info %}}
<strong>Pro:</strong>  
You don't have to rely on extensions and you have complete control over the implementation and maintenance. For Contao 
updates, you might only have to consider possible changes to the core templates.
<br><br>
<strong>Contra:</strong>  
For template adjustments in this form, at least rudimentary PHP knowledge is required. The 
[Contao community](https://community.contao.org/en/) will help you with these questions. The use of HTML5 data attributes 
is not obvious to editors and requires documentation.
{{% /notice %}}


### Manipulation of »Data Container Arrays«

For the next example, we take over the previous implementation via the content elements. For the input of the 
HTML5 data attributes, however, we will create a new, additional input field for the content element of type »Text« and 
extend the Contao [Data Container Array](https://docs.contao.org/dev/reference/dca/) (DCA) for this purpose.

In the developer documentation you can find an [example](https://docs.contao.org/dev/getting-started/dca/) of Contao 
DCA manipulation. The Contao file »[tl_content.php](https://github.com/contao/core-bundle/blob/master/src/Resources/contao/dca/tl_content.php)« and the corresponding database table `tl_content` is responsible for the content elements:

If not already there, create a new directory »contao/dca« in your Contao root directory with a file »tl_content.php«:

```php
// contao/dca/tl_content.php

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_content']['fields']['myCustomDataAttributes'] = [
  'label'     => ['Data-Attribut', 'Set your Html Data-Attribut.'],
  'inputType' => 'keyValueWizard',
  'default'   => serialize([['key' => 'data-category']]),
  'eval'      => ['tl_class' => 'w50'],
  'exclude'   => true,
  'sql'       => "text NULL",
];

PaletteManipulator::create()
  ->addLegend('Settings Data-Attribut', 'expert_legend', PaletteManipulator::POSITION_AFTER)
  ->addField('myCustomDataAttributes', 'Settings Data-Attribut', PaletteManipulator::POSITION_APPEND)
  ->applyToPalette('text', 'tl_content')
;

```

In order for Contao to take over this information, you have to update the »application cache« in the 
»System maintenance« section of the [Contao Manager](/en/installation/contao-manager/). Then call the 
[Contao installation tool](/en/installation/contao-installtool/). The tool recognizes the new field and offers you to create it in the database table 
»tl_content«. Every time you change the file »contao/dca/tl_content.php« this will be necessary again.

The content element of type »`Text`« now contains a new input field (As key/value pair) for our data-attributes below 
the »Expert settings«. For example to specify »`data-category`« in the field »Key« and an entry »`Dog`« in the field »Value«.

For the output on the website we have to adapt the template files again. Analogous to the previous example we use the 
two template files »`ce_text_filter.html5`« and »`block_searchable_filter.html5`«.

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
<strong>Pro:</strong>  
You have complete control over the implementation and maintenance. You and your editors can easily enter the required 
information in input fields.<br><br>
<strong>Contra:</strong>  
Rudimentary knowledge of PHP and the well [documented Contao DCA](https://docs.contao.org/dev/reference/dca/) is required. 
The Contao [community](https://community.contao.org/en/) will also help you with such questions.
{{% /notice %}}


### With »RockSolid Custom Elements«

The »[RockSolid Custom Elements](https://extensions.contao.org/?q=rocksolid&pages=1&p=madeyourday%2Fcontao-rocksolid-custom-elements)« 
(RSCE) is a Contao extension that allows you to create 
[individual content elements](https://rocksolidthemes.com/de/contao/plugins/custom-content-elements/dokumentation) 
and frontend modules with convenient input and output in Contao.

If you are wondering why another extension is presented in this context:

{{% notice info %}}
<strong>Pro:</strong>  
You use three different extensions from different authors e.g. a »frontend filter«, an alternative »content slider« and 
your favourite »photo gallery«. The more extensions you use, the more work you might have to do for future Contao updates.<br><br>
By using »RSCE«, you limit this to one single extension and you can still allow yourself and your editors to easily 
edit all three within Contao. Furthermore, the extension is maintained and kept up-to-date by 
Martin Auswöger ([@ausi](https://github.com/ausi) / member of the Contao core team).<br><br>
<strong>Contra:</strong>  
Knowledge of the well [documented Contao DCA](https://docs.contao.org/dev/reference/dca/) is necessary. The Contao 
[community](https://community.contao.org/en/) is also there to help you with such questions.
{{% /notice %}}

The »RSCE« extension is based on the existing Contao conventions. You only need two files that are created in the 
specified template directory of your theme. You can then edit and maintain them within Contao.

These files are a ».php« configuration file with [Contao DCA](https://docs.contao.org/dev/reference/dca/) information 
and a «.html5« [template file](/en/layout/templates/) for output. You have to consider the following convention for the file names:

The name of the template file must start with »rsce_«, the configuration file must have the same name as the template 
and additionally the suffix »_config«: For example »rsce_my_filter.html5« and »rsce_my_filter_config.php«.

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

Here you can choose a new, own content element under the name »Filter-Element«. You can then use this for the 
content to be filtered in combination with the content elements of the type »HTML« (see above).

{{% notice tip %}}
With the »RSCE« extension you could also create your own 
[Envelope elements](https://rocksolidthemes.com/de/contao/plugins/custom-content-elements/dokumentation) and use them 
instead of the previous content elements of type »HTML«.
{{% /notice %}}

{{% notice note %}}
The extension »[MetaModels](/en/extensions/metamodels/)« follows a similar approach and does not confront you with a direct Contao 
»DCA configuration«. However, this extension goes far beyond the requirements that are necessary here. The learning 
curve (see [documentation](https://metamodels.readthedocs.io/de/latest/)) is accordingly higher.
{{% /notice %}}


## Conclusion

Contao offers many possibilities to meet your requirements. The way of implementation is always a balance between 
comfort and later update effort. Especially for client-side solutions that are only based on the interaction of HTML, 
CSS and Javascript, Contao provides a variety of solutions independent of existing extensions.
