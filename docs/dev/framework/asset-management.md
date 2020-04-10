---
title: "Asset Management"
description: Managing assets (JavaScript, CSS) in the front end.
---


When building a site, administrator and developers can add CSS and JavaScript assets
to their site via Contao's page layouts. However, as an application or extension
developer, you might want to add your own assets to a page, whenever necessary.


## Gobal Arrays

Contao utilises global arrays to store references for later inclusion into the page
layout.


| Array | Description |
| --- | --- |
| `$GLOBALS['TL_BODY']` | Contains HTML code to be included before `</body>`.<sup>1</sup> |
| `$GLOBALS['TL_CSS']` | Contains relative or absolute paths to CSS assets to be included in the `<head>` of the document. |
| `$GLOBALS['TL_HEAD']` | Contains HTML code to be included in the `<head>` of the document. |
| `$GLOBALS['TL_JAVASCRIPT']` | Contains relative or absolute paths to JavaScripts assets to be included in the `<head>` of the document. |
| `$GLOBALS['TL_MOOTOOLS']` | Contains HTML code to be included before `</body>`.<sup>1</sup> |

{{% notice note %}}
<sup>1</sup> In the back end, only `TL_MOOTOOLS` is used for adding HTML code at
the end of the `<body>`.
{{% /notice %}}


## Adding CSS & JavaScript Assets

In order to add a new CSS or JavaScript file for the `<head>` to the document, add 
a new entry to the `$GLOBALS['TL_CSS']` or `$GLOBALS['TL_JAVASCRIPT'] array respectively, 
for example in your [content element][ContaoContentElement] or [front end module][ContaoFrontEndModule]. 
The entry can contain a path relative to the Contao installation directory, or an 
absolute path for an external asset.

```php
$GLOBALS['TL_CSS'][] = 'bundles/myextension/frontend.css';
$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/myextension/scripts.js';
```


### Options

Contao allows a few options to be set for each file. These options are appended
to the file path and separated by a pipe `|` character.

| Option | Example | Description |
| --- | --- | --- |
| Static | `|static` | Defines the asset as "static". |
| Media | `|print` | Defines the `media` attribute of the `<link>` tag (CSS only). |
| Media | `|asnyc` | Defines the `async` attribute of the `<script>` tag (JavaScript only). |
| Version | `|1` | Appends a `?v=…` parameter. Can be a version number or also a timestamp. |

All options can be combined in no particular order.

```php
$GLOBALS['TL_CSS'][] = 'files/theme/css/print.css|print|static|1';
$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/myextension/scripts.js|2|async|static';
```


#### Static

By appending `|static` you can define the asset as being "static", meaning that 
it can be combined with other static assets into one file (if enabled in Contao's 
page layout). Without the `static` option, the stylesheet is always included separately. 
A stylesheet should be defined as `static`, if it will occur on every or most pages 
of a website, as it is more advantageous then for it to be combined with other static 
assets.

```php
$GLOBALS['TL_CSS'][] = 'bundles/myextension/frontend.css|static';
$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/myextension/scripts.js|static';
```


#### Media

In case of stylesheets, you can also define its _media_ property the same ways as
defining it as "static". For instance, if a stylesheet is only to be included for
the `print` media, append `|print` to the stylesheet path.

```php
$GLOBALS['TL_CSS'][] = 'files/theme/css/print.css|print';
```

This results in the following HTML code in the front end:

```html
<link rel="stylesheet" href="files/theme/css/print.css?v=da0d4373" media="print">
```


#### Async

You can load JavaScript assets asynchronously by adding the option `|async`, which
enables the `async` attribute of the `<script>` tag:

```php
$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/myextension/scripts.js|async';
```

When using both the `async` and `static` option and combining is enabled in the 
page layout, all JavaScript assets that are `static` _and_ `async` will be combined 
into one file.


#### Version

This option is used for cache busting, to ensure that clients receive the latest
version of the asset, when it changes. It can either be a simple version number
or also an automated timestamp.

```php
$cssTimestamp = filemtime($this->rootDir.'/bundles/myextension/frontend.css');
$GLOBALS['TL_CSS'][] = 'bundles/myextension/frontend.css|'.$cssTimestamp;

$jsTimestamp = filemtime($this->rootDir.'/bundles/myextension/scripts.js');
$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/myextension/scripts.js|'.$jsTimestamp;
```


## Generating Style and Script Tags

As mentioned in the introduction, it is also possible to add custom HTML to either
the `<head>` or the end of the `<body>` element. Often this is used to add assets
manually, by adding the apropriate `<link>`, `<style>` or `<script>` HTML tags.

Contao offers a few static utility functions for this purpose via the `\Contao\Template`
class.

### `Template::generateStyleTag($href, $media, $mtime)`
  
This returns a `<link rel="stylesheet" …>` tag and takes three arguments: the
path to the stylesheet (absolute or relative to the _base_), an optional _media_
attribute and an optional modification time, which Contao will use to append a
query parameter to the file for cache busting. The latter can also be set to
`null` in order to automatically use the file's modification time for cache busting
(if it is a relative file path).

```php
$GLOBALS['TL_HEAD'][] = \Contao\Template::generateStyleTag('bundles/myextension/print.css', 'print', null);
```


### `Template::generateInlineStyle($script)`

This wraps the given CSS with `<style>…</style>`.

```php
$GLOBALS['TL_HEAD'][] = \Contao\Template::generateInlineStyle($this->generateCss());
```


### `Template::generateScriptTag(…)`
  
This returns a `<script src="…" …>` tag and takes six arguments: 

* `$href`: the path to the stylesheet (absolute or relative to the _base_)
* `$async`: whether the `async` attribute should be added to the tag (default `false`)
* `$mtime`: an optional modification time, which Contao will use to append a query 
  parameter to the file for cache busting. This can also be set to `null` in order 
  to automatically use the file's modification time for cache busting.
* `$hash`: optional hash for an `integrity` attribute.
* `$crossorigin`: optional `crossorigin` attribute.
* `$referrerpolicy`: optional `referrerpolicy` attribute.

{{% notice note %}}
Some of these parameters are only available in newer Contao versions.
{{% /notice %}}

```php
$GLOBALS['TL_BODY'][] = \Contao\Template::generateScriptTag('bundles/myextension/scripts.js', false, null);
```


### `Template::generateInlineScript($script)`

This wraps the given JavaScript with `<script>…</script>`.

```php
$GLOBALS['TL_BODY'][] = \Contao\Template::generateInlineScript($this->generateJavaScript());
```


### `Template::generateFeedTag($href, $format, $title)`

This generates a `<link type="application/…" rel="alternate" href="…" title="…">` 
tag for RSS feeds. It takes three arguments: the URL to the feed, its format and 
the title of the feed.

```php
$GLOBALS['TL_HEAD'][] = \Contao\Template::generateFeedTag('share/myfeed.xml', 'rss', 'My Feed');
```


## Accessing Assets in Templates

{{< version "4.5" >}}

Within [Contao Templates][ContaoTemplates] you can access the helper function `$this->asset(…)`
in order to automatically link to specific assets of either a "Contao Component"
or a bundle. It takes two arguments: the path of the asset within the bundle or
component, and the bundle or component name.

For example, in order to integrate the tablesorter component (which Contao installs
as a dependency through `contao-components/tablesort`) within a template, the following
can be used:

```php
<script src="<?= $this->asset('js/tablesort.min.js', 'contao-components/tablesort') ?>"></script>
```

The same can be used for assets of a bundle. Suppose you have a package with a bundle
called `SomeExampleBundle`. In order to access its public assets in a Contao template the 
following can be used:

```php
<script src="<?= $this->asset('js/foo.js', 'some_example') ?>"></script>
```

This would result in the following HTML code:

```html
<script src="bundles/someexample/js/foo.js"></script>
```


[ContaoContentElement]: /framework/content-elements/
[ContaoFrontEndModule]: /framework/front-end-modules/
[ContaoTemplates]: /framework/templates/
