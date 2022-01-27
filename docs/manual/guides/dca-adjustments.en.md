---
title: "DCA Adjustments"
description: "A list of practical DCA adjustments."
url: "/en/guides/dca"
aliases:
    - /en/guides/dca/
weight: 12
tags: 
    - "DCA"
---


The Contao "[Data Container Array](https://docs.contao.org/dev/reference/dca/)" (DCA) offers numerous, 
practical configuration options. Here you can find a selection of helpful examples.

Starting with Contao 4.9, the respective customizations are expected in the »contao/dca« directory. If the directories 
do not exist yet, you have to create them first. For each Contao table you need a separate file, 
for example »contao/dca/tl_content.php«. After that, you need to recreate the application cache via the 
[Contao Manager](/en/installation/contao-manager/) or via the console. This step is required after every change.


{{% notice note %}}
Do you know other practical examples? Then add your information to this collection. Detailed information how
you can contribute to the documentation [can be found here](/en/contributing/).
{{% /notice %}}


{{% expand "Allow HTML in headings" %}}
```php
// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['fields']['headline']['eval']['allowHtml'] = true;
```
{{% /expand %}}


{{% expand "Allow HTML in news headlines" %}}
```php
// contao/dca/tl_news.php
$GLOBALS['TL_DCA']['tl_news']['fields']['headline']['eval']['preserveTags'] = true;
```
{{% /expand %}}


{{% expand "Allow HTML in page name and page title" &}}
```php
// contao/dca/tl_page.php
// HTML in page names
$GLOBALS['TL_DCA']['tl_page']['fields']['title']['eval']['allowHtml'] = true;
// HTML in page title
$GLOBALS['TL_DCA']['tl_page']['fields']['pageTitle']['eval']['allowHtml'] = true;
```
{{% /expand %}}


{{% expand "Allow HTML in captions" &}}
```php
// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['fields']['caption']['eval']['allowHtml'] = true;
```
{{% /expand %}}


{{% expand "Hide a field in the back end" %}}
To hide the field, you change the palette and remove the field from the configuration settings of the
[module Personal data](/en/layout/module-management/user-modules/#personal-data):

```php
// contao/dca/tl_member.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->removeField('company')
    ->applyToPalette('default', 'tl_member')
;

unset($GLOBALS['TL_DCA']['tl_member']['fields']['company']['eval']['feEditable']);
unset($GLOBALS['TL_DCA']['tl_member']['fields']['company']['eval']['feViewable']);
unset($GLOBALS['TL_DCA']['tl_member']['fields']['company']['eval']['feGroup']);
```

You can also remove the field entirely:
```php
// contao/dca/tl_member.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->removeField('company')
    ->applyToPalette('default', 'tl_member')
;

unset($GLOBALS['TL_DCA']['tl_member']['fields']['company']);
```

Note: with this change, the column `company` will be suggested for deletion when you run
[Update tables](/en/installation/contao-installtool/#update-tables) in the Contao Install Tool!
{{% /expand %}}

{{% expand "Show IDs in page tree" %}}
```php
// contao/dca/tl_page.php
$GLOBALS['TL_DCA']['tl_page']['list']['label']['fields'][] = 'id';
$GLOBALS['TL_DCA']['tl_page']['list']['label']['format'] = '%s <span style="font-weight:normal; padding-left: 3px;">(IDp: %s)</span>';
```
{{% /expand %}}


{{% expand "Show IDs in the article tree" %}}
```php
// contao/dca/tl_article.php
$GLOBALS['TL_DCA']['tl_article']['list']['label']['fields'][] = 'id'; 
$GLOBALS['TL_DCA']['tl_article']['list']['label']['format'] = '%s <span style="font-weight:normal; padding-left: 3px;">(%s, IDa: %s)</span>';
```
{{% /expand %}}


{{% expand "Make company a mandatory field in the member table" %}}
```php
// contao/dca/tl_member.php
$GLOBALS['TL_DCA']['tl_member']['fields']['company']['eval']['mandatory'] = true;
```
{{% /expand %}}


{{% expand "Hide search in file manager" %}}
```php
// contao/dca/tl_files.php
unset($GLOBALS['TL_DCA']['tl_files']['list']['sorting']['panelLayout']);
```
{{% /expand %}}


{{% expand "Restrict H-tag in headings" %}}
```php
// contao/dca/tl_files.php
$GLOBALS['TL_DCA']['tl_content']['fields']['headline']['options']= ['h2','h3']; # Restrict example to h2 and h3
```
{{% /expand %}}


{{% expand "Presets player size" %}}
```php
// contao/dca/tl_content.php
$GLOBALS['TL_DCA']['tl_content']['fields']['playerSize']['default'] = [960,540];
```
{{% /expand %}}


{{% expand "Presets image setting" %}}
```php
// contao/dca/tl_content.php
// The presets are applied to all content with image elements. Image, gallery
// Thumbnails per row
$GLOBALS['TL_DCA']['tl_content']['fields']['perRow']['default'] = '4';
// Tick large view/new window
$GLOBALS['TL_DCA']['tl_content']['fields']['fullsize']['default'] = '1';
// Preselection image spacing in px
$GLOBALS['TL_DCA']['tl_content']['fields']['imagemargin']['default'] = serialize(['unit' => 'px']);
// Sort by individual order
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'custom'; 
// Sort by file name (ascending)
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'name_asc'; 
// Sort by file name (descending)
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'name_desc'; 
// Sort by date (ascending)
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'date_asc'; 
// Sort by date (descending)
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'date_desc'; 
// Sort by random order
$GLOBALS['TL_DCA']['tl_content']['fields']['sortBy']['default'] = 'random'; 
// Image size for example exact format center | center
$GLOBALS['TL_DCA']['tl_content']['fields']['size']['default'] = [500,500,'center_center'];
// other variables for Exact format:
// 'crop', 'left_top', 'left_center', 'left_bottom', 'center_top', 'center_bottom', 'right_top', 'right_center', 'right_bottom'
$GLOBALS['TL_DCA']['tl_content']['fields']['size']['default'] = [150]; # Image width of 150px
$GLOBALS['TL_DCA']['tl_content']['fields']['size']['default'] = [150,150]; # Image width and height of 150px
// Custom image sizes
$GLOBALS['TL_DCA']['tl_content']['fields']['size']['default'] = [0, 0, 2]; # the '2' is the ID of the image size
```
