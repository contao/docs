---
title: "TinyMCE Editor Configuration"
description: "Configure the TinyMCE editor for different areas."
aliases:
    - /en/guides/tinymce-configuration/
weight: 40
tags:
    - "Template"
---

The [TinyMCE editor](https://www.tiny.cloud/) is used to edit most content with individual formatting and is 
preconfigured for Contao. A custom configuration is optional.


## The `be_tinyMCE.html5` template 

Your individual configuration is done via the template `be_tinyMCE.html5`. Here you can find the configuration set 
by Contao and you can change the settings in an update proof way.

Create a new [template](/en/layout/templates/) from  "Layout > Templates" in the 
[navigation area](/en/administration-area/call-and-structure-of-the-backend/#the-navigation-area) and
select the template `be_tinyMCE.html5`.

{{% notice note %}}
The template **must** be placed in the root directory (`templates/be_tinyMCE.html5`) because the Contao backend 
will only find the template there. All lines within the template `<script>...</script>` except the last line must 
be closed with a comma. After saving the template, your changes are applied immediately. 
{{% /notice %}}

{{% notice tip %}}
Starting with Contao **4.10** you can use [template inheritance](/en/layout/templates/php/template-inheritance/) in order to
only adjust parts of the default `be_tinyMCE` template to your needs.
{{% /notice %}}


## Various Editor Configurations

If you keep the template name `be_tinyMCE.html5` your changes will be globally affected. This applies 
at least to the Contao components.

You want to create an editor configuration for the content element "Text" only? You can rename the template as 
you like: e.g. to `be_myTinyMCE.html5`.

Next, we need to get Contao to use this template. To do this, we need to add the following 
to the `contao/dca/tl_content.php`:

```php
// contao/dca/tl_content.php

// Custom RTE-Configuration for Content Text
$GLOBALS['TL_DCA']['tl_content']['fields']['text']['eval']['rte'] = 'myTinyMCE';
```

The last entry corresponds to the template name (without be_ prefix). In our case `myTinyMCE`. Then you have to empty 
the application cache once via Contao Manager (“Maintenance” > “Application Cache” > “Rebuild Production Cache”) or via the console.

The procedure would be similar for your messages texts with a template `be_myTinyMCENews` and a `tl_news.php`:

```php
// contao/dca/tl_news.php

// Custom RTE-Configuration for News Text
$GLOBALS['TL_DCA']['tl_news']['fields']['text']['eval']['rte'] = 'myTinyMCENews';
```

For an introduction to the Contao `Data Container Array`, 
see [Adjusting the DCA](https://docs.contao.org/dev/getting-started/dca/) and the detailed reference 
in the [Data Container Array](https://docs.contao.org/dev/reference/dca/) section of the developer documentation.


## Examples

Which version of the editor is used can be found in the current 
Contao [composer.json](https://github.com/contao/contao/blob/master/composer.json#). Depending on the TinyMCE version, 
you can find information about further configuration in the TinyMCE documentation.

If something should not work after your changes, remove it first. You can also delete the template. 
Then the Contao default configuration of the editor will be used again.


### The TinyMCE "extended_valid_elements" definition

In the "`Settings > Security`" section you can define 
[allowed HTML tags](/en/system/settings/#security-settings). It might happen that this information 
alone is not sufficient.

For example, if you use the [Contao logo](https://fontawesome.com/icons/contao?s=&f=brands) in a content element of 
type "Enumeration" with available "Font Awesome" as follows, your entries will not be applied after "Save".

```html
<i class="fa fa-contao" aria-hidden="true">Contao Logo</i>
```

Even if the HTML element `<i>` is already included in the area 
[Allowed HTML tags](/en/system/settings/#security-settings), you have to enable this for the TinyMCE. 
For this, add "extended_valid_elements" to the beginning of the line in the template:

```js
// be_tinyMCE.html5

extended_valid_elements: 'q[cite|class|title],article,section,hgroup,figure,figcaption,i[class]/em',
```

Then you have to empty the application cache once via Contao Manager 
(“Maintenance” > “Application Cache” > “Rebuild Production Cache”) or via the console. Re-enter your HTML 
in the content element and "Save".


### Activate the function "Insert as text" by default

In the editor, you can paste text from the clipboard via the menu `edit` or a key combination, which may not 
only include the text but also other formatting (e.g. from a Word file). To insert only raw text you can select 
the option `edit > insert as text` manually from the menu.

In the configuration we will enable this option by default. This function of the editor is done by the plugin `Paste` 
and the possible settings can be found in the documentation. So we have to add the information `paste_as_text` in the template:

```js
// be_tinyMCE.html5
...

toolbar: 'link unlink | image | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code',

// activate paste_as_text option
paste_as_text: true
```

In the example, we entered this using a new line below the existing line (toolbar: ...). 
Since our new line is the last line, we do not need to put a comma here.

However, you must be aware that the existing line (toolbar: ...) must now be additionally terminated with a comma. 
The option `edit > insert as text` is now always activated in the editor.


### Change the toolbar

The toolbar of the editor offers among other things the possibility of paragraph alignment. If you want to disable 
this for your editors, remove the entries `alignleft aligncenter alignright alignjustify` in the `toolbar` definition:

```js
// be_tinyMCE.html5
...

// custom toolbar settings
toolbar: 'link unlink | image | formatselect | bold italic | bullist numlist outdent indent | code',

// activate paste_as_text option
paste_as_text: true
```

{{< version-tag "5.0" >}} Starting with Contao **5**, Contao uses the [TinyMCE editor](https://www.tiny.cloud/) in version 6. 
Some terms for displaying elements in the toolbar hav changed. For example, use `blocks` instead of `formatselect` and `styles` 
instead of `styleselect`. A complete list of the changed terms can be found in the 
[migration notes of the TinyMCE documentation](https://www.tiny.cloud/docs/tinymce/6/migration-from-5x/#things-we-renamed]).


### Change the menu

Similar to the toolbar you can also configure the menu. If you want to remove the menu item `table` completely, 
delete the entry `table` in the line of the menu bar Definition (`menubar:...`).

The `menu` definition is available for the specific control of individual menu items. You can find detailed 
information in the [TinyMCE documentation](https://www.tiny.cloud/docs-4x/configure/editor-appearance/#menu).

We have removed the paragraph alignment in the toolbar. However, it is still available in the menu. 
We want to remove this menu item and keep the other menu items. You can use the 
entry [removed_menuitems](https://www.tiny.cloud/docs-4x/configure/editor-appearance/#removed_menuitems) for this purpose.

For a complete list of toolbar items and menu items, see the TinyMCE documentation.

{{< version-tag "5.0" >}} Starting with Contao **5**, Contao uses the [TinyMCE editor](https://www.tiny.cloud/) in version 6. 
Some terms for displaying elements in the toolbar hav changed. For example, use `blocks` instead of `formatselect` and `styles` 
instead of `styleselect`. A complete list of the changed terms can be found in the 
[migration notes of the TinyMCE documentation](https://www.tiny.cloud/docs/tinymce/6/migration-from-5x/#things-we-renamed]).

```js
// be_tinyMCE.html5
...

// removed table menu
menubar: 'file edit insert view format',

// remove align settings from format menu
removed_menuitems: "align",

// custom toolbar settings
toolbar: 'link unlink | image | formatselect | bold italic | bullist numlist outdent indent | code',

// activate paste_as_text option
paste_as_text: true

```

### Custom format definition

You want to offer your own format definitions for selection? The TinyMCE editor offers the option `style_formats` 
to do so. You can limit your definition to certain HTML selectors, add inline style specifications or pass certain CSS classes.

You extend the toolbar with the entry `styleselect`. Using the toolbar, you can then select your own 
entries from the `style_formats` definitions:

```js
// be_tinyMCE.html5
...

// removed table menu
menubar: 'file edit insert view format',

// remove align settings from format menu
removed_menuitems: "align",

// custom toolbar settings
toolbar: 'link unlink | image | formatselect | styleselect | bold italic | bullist numlist outdent indent | code',

// custom styles
style_formats: [
  {title: 'Red Text - Inline Style', inline: 'span', styles: {color: '#ff0000'}},
  {title: 'Blue Text - Inline Class', inline: 'span', classes: 'myCssClassA'},
  {title: 'Div - Block Class', block: 'div', classes: 'myCssClassB', exact: true, wrapper: true},
  {title: 'Table row - Restrict Selector', selector: 'tr', classes: 'myCssClassC'}
],

// activate paste_as_text option
paste_as_text: true
```

You can find all details about the `style_formats` possibilities in the TinyMCE documentation, 
including [information](https://www.tiny.cloud/docs-4x/configure/content-formatting/#formatparameters) about the 
format parameters such as `exact` or `wrapper`.


### The custom TinyMCE.css

In our `style_formats` example above, we defined the color value in the first entry using an inline CSS specification, 
which you should avoid if possible and prefer to work with CSS-KLassen. If you want to change the style later, 
you can do this globally via your CSS class.

The disadvantage is that you or your editors can not see the styles in the editor. For this you can provide 
the editor with your own CSS file via the `content_css` specification.

We create the file `myCustomTiny.css` below the `files` folder in a public directory:

```css
// files/myfolder/myCustomTiny.css

.myCssClassA {
  color: #0000ff;
}

.myCssClassB {
  color: #ffffff;
  background-color: #ff0000;
}
```

The CSS classes specified here correspond to the `style_formats` definitions. The specification `content_css` 
already exists in the template. You can completely replace the existing entry with your own CSS file or add your own CSS file:

```js
// be_tinyMCE.html5
...

//content_css: 'system/themes/<?= Backend::getTheme() ?>/tinymce.min.css',

// add new custom css file
content_css: [
    'system/themes/<?= Backend::getTheme() ?>/tinymce.min.css',
    'files/myfolder/myCustomTiny.css'
],
```

If you select your format definition in the editor, it will be displayed like this. However, our CSS classes from 
the CSS file are now also listed in the toolbar. This is not desired. With a little trick we can prevent this.

This option `importcss_selector_filter` is actually intended to limit the display to certain names. 
You can find the information in the [TinyMCE documentation](https://www.tiny.cloud/docs/plugins/importcss/#importcss_selector_filter), 
we use this in our sense and give a filter that does not exist:

```js
// be_tinyMCE.html5
...

//content_css: 'system/themes/<?= Backend::getTheme() ?>/tinymce.min.css',

// add new custom css file
content_css: [
    'system/themes/<?= Backend::getTheme() ?>/tinymce.min.css',
    'files/myfolder/myCustomTiny.css'
],

// do not import all css-classes from custom .css, only classes starts with prefix
importcss_selector_filter: ".myDummyPrefix-",
```

In the toolbar, only our own format definitions are displayed again according to the `style_formats` specifications.

If you provide your own format definitions in the editor, you should also include your own CSS file, 
which can also contain other styles that you use for the actual layout of your website.

However, this can become very quickly complicated. With this procedure you have to consider 
what you want to provide and in what scope.


## Further information

The official documentation can be found at [www.tiny.cloud](https://www.tiny.cloud/docs/) - please choose the appropriate version
from the left navigation. In Contao 4 up to 4.9, version 4 of the TinyMCE is included by default and from 4.10 on, version 5.

Nicky Hoff gave a presentation on the topic at the Contao Conference 2018 - there are [slides](https://contao.org/files/conference/2018/papers/ContaoKonferenz18_So-klitzeklein-ist-der-TinyMCE-gar-nicht.pdf) and a [video](https://www.youtube.com/watch?v=mjsT8J3-UDw).

There are some packages in the Contao extension list that allow you to easily add more features [extensions.contao.org](https://extensions.contao.org/?q=tiny).
