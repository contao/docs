---
title: "Adjusting the DCA"
description: "Creating your first DCA adjustment."
weight: 400
---


[Data Container Arrays][1] are one of the key concepts within Contao. They can easily
be adjusted to quickly add new fields to content elements, front end modules & news 
entries etc., change some of their properties for your specific needs and to set up
new database tables for your own custom records.

Any DCA adjustments go into the `contao/dca/` folder. There, you have to create
individual files for each Data Container. For example, if you want to adjust the
DCA for news entries, whose Data Container is called `tl_news`, then you need to
create a file called `tl_news.php` there.

The following example adds a new field to news entries called `location`. When adding 
a new field you will also have to add it to a so called [_palette_][2], otherwise
the field will not show in the edit form of the news entry. The easiest way to adjust
a palette is through the [Palette Manipulator][3]. The example adds our new field
to the _Title_ section of a news entry for the palettes `default` and `internal`.
You might want to look up the `palettes` section of the `tl_news`-DCA (e.g. with the `debug:dca` command) to determine 
which of the palettes you want to adjust.

```php
// contao/dca/tl_news.php
use Contao\CoreBundle\DataContainer\PaletteManipulator;

$GLOBALS['TL_DCA']['tl_news']['fields']['location'] = [
    'label' => ['Location', 'Location of the news entry, if applicable.'],
    'inputType' => 'text',
    'eval' => ['tl_class' => 'w50', 'maxlength' => 255],
    'sql' => ['type' => 'string', 'length' => 255, 'default' => ''],
];

PaletteManipulator::create()
    ->addField('location', 'title_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_news')
    ->applyToPalette('internal', 'tl_news')
;
```

{{% notice info %}}
Just like with Symfony's configuration files, after adjusting any Contao related
configurations, the Symfony Application Cache needs to be rebuilt for the production
environment. Any Contao related configuration changes are immediately visible in
the developer environment though.
{{% /notice %}}

Now the field will be available when editing a news entry:

![](../images/tl_news.png?classes=shadow)

The field can also be accessed directly in the `news_*` templates:

```diff
 <!-- templates/news_short.html5 -->
 <div class="layout_short arc_<?= $this->archive->id ?> block<?= $this->class ?>" itemscope itemtype="http://schema.org/Article">
 
   <?php if ($this->hasMetaFields): ?>
     <p class="info"><time datetime="<?= $this->datetime ?>" itemprop="datePublished"><?= $this->date ?></time> <?= $this->author ?> <?= $this->commentCount ?></p>
   <?php endif; ?>
+
+  <?php if ($this->location): ?>
+    <p class="location"><?= $this->location ?></p>
+  <?php endif; ?>
 
   <h2 itemprop="name"><?= $this->linkHeadline ?></h2>
 
   <div class="ce_text block" itemprop="description">
     <?= $this->teaser ?>
   </div>
 
   <?php if ($this->hasText || $this->hasTeaser): ?>
     <p class="more"><?= $this->more ?></p>
   <?php endif; ?>
 
 </div>
```

If you want to learn more about the ins & outs of the Contao Data Container Array,
have a look at the [framework documentation][1], [the reference][4] and [a guide][5]
showing a more complex example of building a new Data Container.

Next: [changing translations][6].




[1]: /framework/dca/
[2]: /reference/dca/palettes/
[3]: /framework/dca/palettemanipulator/
[4]: /reference/dca/
[5]: /guides/dca/
[6]: /getting-started/translations/
