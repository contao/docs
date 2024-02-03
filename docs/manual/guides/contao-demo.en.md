---
title: "Customize the Contao Demo"
description: "Use and customize the Contao Demo."
aliases:
    - /en/guides/contao-demo/
weight: 11
tags: 
   - "Demo"
---


The [Contao demo](https://demo.contao.org/contao) represents a complete website for the purpose of demonstrating the Contao possibilities. 
You can view the demo on [contao.org](https://contao.org/) and test it including backend access or you can install the Contao demo and 
extend it according to your needs.

The following information is not a complete tutorial regarding a [local Contao installation](/en/guides/local-installation/), CSS 
or [SASS/SCSS](/en/guides/sass-less-integration/) usage. It only lists some of the numerous options you could use for further customization.


## Installation

You can easily install the Contao demo via the Contao Manager during a new installation. It is also possible to install 
via the console. Information on this can be found on the corresponding [GitHub page](https://github.com/contao/contao-demo). You can then 
follow the complete implementation of the Contao demo website in the Contao backend.


## Layout Adjustments

The Contao demo uses `.scss` files for the design. These (the `app.scss`) are used directly in the respective Contao theme settings and 
then compiled and provided as a final `.css` file via Contao.

{{% notice note %}} 
What you should consider here, is described in more detail in this article "[Sass/Less Integration](/en/guides/sass-less-integration/)". 
{{% /notice %}}


### Sample

With the knowledge of the above Contao options (via "[scssphp/scssphp](https://github.com/scssphp/scssphp)") you can edit the `.scss` files 
directly in the Contao backend. For example, if you want to adjust the color values of the demo, you can make and save changes via 
the Contao [file manager](/en/file-manager/) in the file "`contaodemo/theme/src/scss/variables/_colors.scss`". Further SASS variables can be 
found in the files "`_sizes.scss`", "`_fonts.scss`" and "`_animation.scss`".

However, in order for the changes to these ([SASS partial](https://sass-lang.com/guide/#partials)) files to be applied, you must then touch 
and save "`app.scss`" once (see also: "[Sass/Less Integration](/en/guides/sass-less-integration/)").


## Dart Sass

The "[scssphp/scssphp](https://github.com/scssphp/scssphp)" library used by Contao may not support current 
"[Dart Sass](https://sass-lang.com/dart-sass/)" features such as "[@use](https://sass-lang.com/documentation/at-rules/use/)", 
[@forward](https://sass-lang.com/documentation/at-rules/forward/) or other "Dart Sass" [modules](https://sass-lang.com/documentation/modules/).

{{% notice note %}}
This may also apply to existing SASS extensions, e.g. for the "[Visual Studio Code](https://code.visualstudio.com/)" editor etc.
{{% /notice %}}

In this case, in conjunction with a [local Contao installation](/en/guides/local-installation/) and a pure "Dart Sass" installation 
(see below), it is therefore more optimal to compile the `.scss` files locally according to the requirements and then only reference the 
final `.css` file (i.e. `app.css`) in Contao.


### Preparations

You can find the procedure for installing "Dart Sass" [here](https://sass-lang.com/install/). There are numerous instructions and tutorials 
available, so we will not go into them in detail here.

In conjunction with "[Node.js](https://nodejs.org/)", it is a good idea to create the "`package.json`" outside the Contao directories. 
This way, you could also serve other Contao installations later on and only have to adjust the respective paths of the SCSS and CSS 
directories relative to "`package.json`". There is also the helpful option of defining the 
"[SASS instructions](https://sass-lang.com/documentation/cli/dart-sass/)" once via "[nodescripts](https://docs.npmjs.com/cli/v10/using-npm/scripts)" 
and starting them conveniently.

If you use the generated "`app.css`" of the demo in the Contao theme settings, the references to the respective `.scss` sections are missing 
in the browser dev tools. Therefore, "[source maps](https://sass-lang.com/documentation/cli/dart-sass/#source-maps)" are required, which you 
can create automatically via SASS and use during local development. If the respective "source map" (`.map`) is available next to the 
"`app.css`", the browser dev tools then point directly to the corresponding entries in the `.scss` files.

{{% notice tip %}}
This is helpful for the next step. With the SASS flag "[--watch](https://sass-lang.com/documentation/cli/dart-sass/#watch)", the creation 
of a `.css` file is automatically triggered as soon as you save changes to the `.scss` files (including SASS partials), even via the browser 
dev tools (with workspace shares). Once activated, you can now directly track, change and save the effects of your `.scss` customizations 
in the browser dev tools.
{{% /notice %}}


## Local layout adjustments

For the example of the color adjustments, we only want to highlight the SASS variables to be changed for the sake of clarity. To do this, 
we create a new SASS partial file "`_custom.scss`" in the "`scss`" directory. In this file, we only copy the variables from 
"`variables/_colors.scss`" that we actually want to change or overwrite.

We change the color values in "`_custom.scss`" and include them as the first entry in "`app.scss`" using 
"[@import](https://sass-lang.com/documentation/at-rules/import/)". The new color specifications are now included but not yet taken into account!

In the "`variables/_colors.scss`" we still have to use the SASS flag "[!default](https://sass-lang.com/documentation/variables/#default-values)". 
This means that the existing values of the SASS variables are only used if there is not already a definition. However, this is given by 
our specifications from "`_custom.scss`" and therefore these color specifications are now taken into account.

The three files could now look like this in excerpts:

{{< tabs groupId="SASS-SAMPLE">}}

{{% tab name="_colors.scss" %}}
```scss
// global colors
$c-primary--50: hsla(30, 100%, 97%, 1)  !default;
$c-primary--500: hsla(30, 100%, 48%, 1) !default;
$c-primary--600: hsla(30, 100%, 42%, 1) !default;
$c-primary--700: hsla(30, 100%, 30%, 1) !default;

$c-secondary--700: hsla(207, 44%, 26%, 1) !default;
$c-secondary--800: hsla(207, 44%, 21%, 1) !default;
$c-secondary--900: hsla(207, 44%, 14%, 1) !default;

// background gradients
$gradient--1: radial-gradient(50% 50% at 50% 50%, hsla(207, 44%, 26%, 1) 0%, hsla(207, 44%, 21%, 1) 100%) !default;

...
```
{{% /tab %}}

{{% tab name="_custom.scss" %}}
```scss
// ### custom color variables

$c-primary--50: hsla(30, 100%, 97%, 1);
$c-primary--500: hsla(212, 100%, 48%, 1);
$c-primary--600: hsla(212, 100%, 42%, 1);
$c-primary--700: hsla(212, 100%, 30%, 1);

$c-secondary--700: hsla(242, 100%, 25%, 1);
$c-secondary--800: hsla(242, 100%, 21%, 1);
$c-secondary--900: hsla(242, 100%, 14%, 1);

$gradient--1: radial-gradient(50% 50% at 50% 50%, $c-primary--700 0%, $c-secondary--900 100%);
```
{{% /tab %}}

{{% tab name="app.scss" %}}
```scss
// ### custom variables
@import 'custom';

// ### general variables
...
```
{{% /tab %}}

{{< /tabs >}}


## Conclusion

You could easily use the above implementation directly in Contao. As mentioned, however, "Dart Sass" offers numerous other possibilities. 
Instead of explicitly defining the color specifications in "`_custom.scss`" via "CSS hsla()", you could also use 
[SASS modules](https://sass-lang.com/documentation/modules/color/) for color conversion.

Furthermore, the use of "[@use](https://sass-lang.com/documentation/at-rules/use/)" and "[@forward](https://sass-lang.com/documentation/at-rules/forward/)" 
instead of "[@import](https://sass-lang.com/documentation/at-rules/import/)" would be useful, especially for larger projects. Among other 
things, "namespaces" were introduced here, which enable clear and secure referencing.

If you would like to use these and future "Dart Sass" features, you can do so via a local workflow.

{{% notice tip %}}
Of course, you are not restricted, regardless of Contao versions. For example, you could also use established CSS variables 
("[custom properties](https://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties)") or other combinations in your workflow.
{{% /notice %}}

