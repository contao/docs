---
title: "Using web fonts"
description: "Information on the integration of web fonts."
aliases:
    - /en/guides/web-font/
weight: 80
tags: 
    - "Theme"
---


Analogous to the printing sector, you can use fonts to emphasize statements, transport emotions and in keeping with 
the industry or to the appearance of your company to individualize the presentation of the website. 


## Commercial or Open Source?

Besides commercial service providers like »[Adobe-Fonts](https://fonts.adobe.com/)« or 
»[fonts.com](https://www.fonts.com/)« there are Open Source alternatives available. With the most commercial providers the 
web fonts are "rented" and hosted on their own servers. Only few offer the web fonts for download.

The probably most well-known, free offerer is Google with the »[Google Fonts](https://fonts.google.com/)«. You will find 
alternatives on [GitHub](https://github.com/adobe-fonts/) too. With the Open Source offers you should 
make sure that they contain special characters. Also there are possibly only a few or even no further typefaces available.


## File formats

For historical reasons there are different file formats such as »[.eot](https://caniuse.com/?search=eot)«, »[.ttf](https://caniuse.com/?search=ttf)«, »[.woff](https://caniuse.com/?search=woff)« or »[.woff2](https://caniuse.com/?search=woff2)«. In the meantime
the formats ».woff« or ».woff2« can be used 
in current browser versions. 

If you want to support older browsers you can also use the other file formats.


## Contao Integration

<style>
/* vollkorn-600 - latin */
@font-face {
  font-family: 'Vollkorn';
  font-style: normal;
  font-weight: 600;
  font-display: swap;
  src: url('src-webfont/vollkorn-v12-latin-600.eot'); /* IE9 Compat Modes */
  src: local(''),
       url('src-webfont/vollkorn-v12-latin-600.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('src-webfont/vollkorn-v12-latin-600.woff2') format('woff2'), /* Super Modern Browsers */
       url('src-webfont/vollkorn-v12-latin-600.woff') format('woff'), /* Modern Browsers */
       url('src-webfont/vollkorn-v12-latin-600.ttf') format('truetype'), /* Safari, Android, iOS */
       url('src-webfont/vollkorn-v12-latin-600.svg#Vollkorn') format('svg'); /* Legacy iOS */
}
/* vollkorn-700italic - latin */
@font-face {
  font-family: 'Vollkorn';
  font-style: italic;
  font-weight: 700;
  font-display: swap;
  src: url('src-webfont/vollkorn-v12-latin-700italic.eot'); /* IE9 Compat Modes */
  src: local(''),
       url('src-webfont/vollkorn-v12-latin-700italic.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
       url('src-webfont/vollkorn-v12-latin-700italic.woff2') format('woff2'), /* Super Modern Browsers */
       url('src-webfont/vollkorn-v12-latin-700italic.woff') format('woff'), /* Modern Browsers */
       url('src-webfont/vollkorn-v12-latin-700italic.ttf') format('truetype'), /* Safari, Android, iOS */
       url('src-webfont/vollkorn-v12-latin-700italic.svg#Vollkorn') format('svg'); /* Legacy iOS */
}

.fontDemoLyric {
  font-family: 'Vollkorn', serif;
  background-color: #F0B37E;
  border-radius: 8px;
  color: #ffffff;
  font-style: italic;
  font-weight: 700;
  font-size: 40px;
  line-height: 30px;
  padding: 20px 20px;
  margin: 10px 0 10px 0;
}

.fontDemoAuthor {
  font-family: 'Vollkorn', serif;
  color: #666666;
  font-style: normal;
  font-weight: 600;
  font-size: 20px;
  padding: 0;
  margin: 0;
}
</style>

In the following we use the Google Font »[Vollkorn](https://fonts.google.com/specimen/Vollkorn)«.<br>
Here for example with the typefaces »Bold 700 italic« and »Semi-bold 600«:

<p class="fontDemoLyric">"Life is a journey, not a destination."<br>
<span class="fontDemoAuthor">Ralph Waldo Emerson</span></p>


### Via external Google hosting

Via »[Google Fonts](https://fonts.google.com/specimen/Vollkorn)« you can select the required font styles 
of the font "Vollkorn" and you will receive an "embed" instruction for integration. 
This could look as follows:

```html
<link href="https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,600;1,700&display=swap" rel="stylesheet">
```

Write this instruction in the »Expert Settings -> Additional `<head>`-Tags« within the 
[Page Layouts](/en/layout/theme-manager/manage-page-layouts/) of your 
[Theme](/en/layout/theme-manager/). Google provides the information required by the respective browser 
and there is no need for further action on your part. You can then use the selected »fonts« in your CSS information:

```CSS
h1, h2 {
  font-family: 'Vollkorn', serif;
  font-style: italic;
  font-weight: 700;
}
```

{{% notice note %}}
In the [Page layouts](/en/layout/theme-manager/manage-page-layouts/) you may find direct 
Input options for the Google web fonts. This option will no longer be available in future versions of Contao. 
Therefore the described procedure is recommended.
{{% /notice %}}

{{% notice warning %}}
The retrieval of the web fonts triggers a communication between the browser displaying the website and the Google server.
In the process, data about the browser or the IP are also transmitted. This transmission is to be considered with the GDPR or ePrivacy.  
It is recommended to install the fonts via a local integration.
{{% /notice %}}


### Local integration

You can also integrate web fonts «locally». In the sense of: Via your own hosting.  
You need the respective files (see above) and place them in a publicly accessible directory 
of your Contao installation under »files«.

In the case of »Google Fonts« you will be offered a download option, but this download includes only files in the ».ttf« format. 

Web applications like »[Google Webfonts Helper](https://google-webfonts-helper.herokuapp.com/fonts)« or »[Web Font Loader](https://webfontloader.altmann.de/)« 
provides the Google web fonts in various file formats. Furthermore, depending on your selection, the appropriate CSS information via `@font-face` is supplied. This CSS information must be added to your own CSS file. It doesn't matter if you work directly with CSS files or if you use these 
via [Preprocessors](/en/guides/sass-less-integration/) such as »Sass/Less«. 

You then include the CSS file as an external stylesheet in the »Expert settings -> Stylesheets« within the 
[page layout](/en/layout/theme-manager/manage-page-layouts/) section of your [theme](/en/layout/theme-manager/).

{{% notice note %}}
The paths provided in `url()` regarding the web font files within the CSS `@font-face` directive are relative to the
position of the CSS file. This depends on your directory structure.
{{% /notice  %}}

Assuming you have copied the web font files into a directory »files/theme/fonts« and your CSS file is in the 
directory »files/theme/css«. The correct, relative paths to the web font files would be:

```CSS
/* vollkorn-600 - latin */
@font-face {
  font-family: 'Vollkorn';
  font-style: normal;
  font-weight: 600;
  src: url('../fonts/vollkorn-v12-latin-600.eot');
  src: local(''),
       url('../fonts/vollkorn-v12-latin-600.eot?#iefix') format('embedded-opentype'),
       url('../fonts/vollkorn-v12-latin-600.woff2') format('woff2'),
       url('../fonts/vollkorn-v12-latin-600.woff') format('woff'),
       url('../fonts/vollkorn-v12-latin-600.ttf') format('truetype'),
       url('../fonts/vollkorn-v12-latin-600.svg#Vollkorn') format('svg');
}
```

{{% notice info %}}
In [Page Layout](/en/layout/theme-manager/manage-page-layouts/), you can activate the »Combine Scripts« option. All 
CSS information of the selected internal and external CSS files will be combined into a single, new file and stored 
by Contao in the directory »assets/css«.<br><br>
Since the new CSS file is now located in the directory »assets/css«, the paths to the web fonts must be adapted. Contao 
does this automatically during this process:
`... url('../../files/theme/fonts/vollkorn-v12-latin-600.woff2') format('woff2'), ...`.
{{% /notice  %}}


## The CSS "font-display" property

A web font file, if it is not already in the browser cache, must first be completely downloaded from the browser 
before it can be used. During page load the browser must react accordingly. Possibilities would be:

* As long as a web font file is not completely available, the browser hides it. After the complete loading 
the web font will be used: »Flash Of Invisible Text Effect (FOIT)«.

* If a longer loading time is required, a fallback font will be used first.

For a while, attempts were made to counteract this with client-side JavaScript solutions. Meanwhile you can control 
at least the browser behaviour via the CSS property [`font-display`](https://www.w3.org/TR/css-fonts-4/#font-display-desc) 
(see also [developer.mozilla.org](https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display)). You can 
use the `font-display` property within a CSS `@font-face` declaration with four values: 
»auto«, »swap«, »fallback« and »optional«.

The value `swap` is used in most cases and you can also find this value in the Google Fonts Embed 
instructions (see above). Accordingly, you can extend your CSS information for local use:

```CSS
@font-face {
  font-display: swap;
...
}
```


