---
title: "Asset Management"
description: Managing assets (JavaSCript, CSS) in the front end.
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


### Adding CSS

In order to add a new CSS file for the `<head>` to the document, add a new entry
to the `$GLOBALS['TL_CSS']` array, for example in your [content element][ContaoContentElement]
or [front end module][ContaoFrontEndModule].

```php
$GLOBALS['TL_CSS'][] = 'bundles/myextension/frontend.css';
```

Contao allows a few options to be set for each file. These options are appended
to the file path and separated by a pipe `|` character.

By appending `|static` you can define the stylesheet as being "static", meaning 
that it can be combined with other static stylesheets into one file (if enabled
in Contao's page layout). Without the `static` option, the stylesheet is always 
included separately. A stylesheet should be defined as `static`, if it will occur 
on every or most pages of a website, as it is more advantageous then for it to be 
combined with other static stylesheets.

```php
$GLOBALS['TL_CSS'][] = 'bundles/myextension/frontend.css|static';
```

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

Both options can be combined, in no particular order:

```php
$GLOBALS['TL_CSS'][] = 'files/theme/css/print.css|print|static';
```


### Adding JavaScript

Adding JavaScript to the `<head>` of a document works the same ways as [adding CSS](#adding-css).
This time, the paths to the script files are added to the `$GLOBALS['TL_JAVASCRIPT']`
array.

```php
$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/myextension/scripts.js';
```

As with CSS, JavaScript assets in the `<head>` of a document can be combined with
others (if enabled in the page layout) if they are defined as "static":

```php
$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/myextension/scripts.js|static';
```

Additionally, you can load JavaScript assets asynchronously by adding the option
`|async`:

```php
$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/myextension/scripts.js|async';
```

You can use both options in no particular order:

```php
$GLOBALS['TL_JAVASCRIPT'][] = 'bundles/myextension/scripts.js|async|static';
```

When using both options and combining is enabled in the page layout, all `static` 
and `async` JavaScript assets will be combined in one file.


## Generating Style and Script Tags

As mentioned in the introduction, it is also possible to add custom HTML to either
the `<head>` or the end of the `<body>` element. Often this is used to add assets
manually, by adding the apropriate `<link>`, `<style>` or `<script>` HTML tags.

Contao offers a few static utility functions for this purpose via the `\Contao\Template`
class.

* __`\Contao\Template::generateStyleTag($href, $media, $mtime)`__ 
  
  This returns a `<link rel="stylesheet" …>` tag and takes three arguments: the
  path to the stylesheet (absolute or relative to the _base_), an optional _media_
  attribute and an optional modification time, which Contao will use to append a
  query parameter to the file for cache busting. The latter can also be set to
  `null` in order to automatically use the file's modification time for cache busting
  (if it is a relative file path).

  ```php
  $GLOBALS['TL_HEAD'][] = \Contao\Template::generateStyleTag('bundles/myextension/print.css', 'print', null);
  ```
* __`\Contao\Template::generateInlineStyle($script)`__

  This wraps the given CSS with `<style>…</style>`.

  ```php
  $GLOBALS['TL_HEAD'][] = \Contao\Template::generateInlineStyle($this->generateCss());
  ```
* __`\Contao\Template::generateScriptTag($href, $async, $mtime, $hash, $crossorigin, $referrerpolicy)`__ 
  
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
* __`\Contao\Template::generateInlineScript($script)`__

  This wraps the given JavaScript with `<script>…</script>`.

  ```php
  $GLOBALS['TL_BODY'][] = \Contao\Template::generateInlineScript($this->generateJavaScript());
  ```
* __`\Contao\Template::generateFeedTag($href, $format, $title)`__

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
