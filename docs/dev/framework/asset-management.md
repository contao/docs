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
| `$GLOBALS['TL_CSS']` | Contains relative paths to CSS assets to be included in the `<head>` of the document. |
| `$GLOBALS['TL_FRAMEWORK_CSS']` | Contains relative paths to CSS assets to be included in the `<head>` of the document. |
| `$GLOBALS['TL_HEAD']` | Contains HTML code to be included in the `<head>` of the document. |
| `$GLOBALS['TL_JAVASCRIPT']` | Contains relative paths to JavaScripts assets to be included in the `<head>` of the document. |
| `$GLOBALS['TL_JQUERY']` | Contains HTML code to be included before `</body>`.<sup>1</sup> |
| `$GLOBALS['TL_MOOTOOLS']` | Contains HTML code to be included before `</body>`.<sup>1</sup> |
| `$GLOBALS['TL_USER_CSS']` | Contains relative paths to CSS assets to be included in the `<head>` of the document. |

{{% notice note %}}
<sup>1</sup> The order of HTML code for the end of the body in the front end is 
as follows: `TL_JQUERY`, `TL_MOOTOOLS`, `TL_BODY`. In the back end, only `TL_MOOTOOLS`
is used.
{{% /notice %}}

Out of this list, only `TL_BODY` (`TL_MOOTOOLS` in the back end), `TL_CSS`, `TL_HEAD`
and `TL_JAVASCRIPT` is usually relevant for app or extension development. The others
are used by Contao internally.


### Adding CSS

In order to add a new CSS file for the `<head>` to the document, add a new entry
to the `$GLOBALS['TL_CSS']` array, for example in your [content element][ContaoContentElement]
or [front end module][ContaoFrontEndModule].

```php
$GLOBALS['TL_CSS'][] = 'bundles/myextension/frontend.css';
```

Contao allows a few options to be set for each file. These options are appended
to the file path and separated by a pipe `|` character.


[ContaoContentElement]: /framework/content-elements
[ContaoFrontEndModule]: /framework/front-end-modules