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


{{% expand "Hide a field in the backend" %}}
```php
// for example: contao/dca/tl_member.php
unset($GLOBALS['TL_DCA']['tl_member']['fields']['dateOfBirth']);
```
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

