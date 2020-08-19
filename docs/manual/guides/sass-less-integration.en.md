---
title: "Sass/Less Integration"
description: "Instructions for the direct use of CSS preprocessors within Contao."
aliases:
    - /en/guides/sass-less-integration/
weight: 30
tags:
    - "Theme"
---

In the page layouts of your theme, the finished CSS stylesheets are included. CSS preprocessors like 
[Sass, SCSS](https://sass-lang.com/) or [Less](http://lesscss.org/) are often used to create CSS files. For the following 
examples we use Sass/SCSS. The Less procedure is otherwise identical, apart from the different language syntax.


## Implementation within Contao

Using the preprocessors usually requires a local installation. With Contao you can embed `.scss` or `.less` files 
directly in the page layout. The corresponding CSS files are then created automatically.

{{% notice note %}}
Even though the direct use in Contao works, it is still recommended to use ready-to-use CSS files or create them 
locally using CSS preprocessors.
{{% /notice %}}

For our simple example, we will create two files under the `files` folder: `theme.scss` and `_elements.scss` in any 
directory that is publicly accessible. The `theme.scss` file contains only one variable with a color value and the 
`_elements.scss` file (Sass-partial) via the@import statement. In the `_elements.scss` file we set the color value for 
the H1 element using the variable `$main-color` and a separate color value for a paragraph.

```css
// theme.scss

$mainCol: rgb(255, 0, 0) !default;

@import '_elements';
```

```css
// _elements.scss

h1 { color: $mainCol; }

p { color: rgb(0, 255, 0); }
```

Of course, the CSS preprocessors offer much more possibilities. But for our example it is sufficient.

You can now include the file `theme.scss` in your page layout, similar to the usual procedure with `.css` files. 
The file `_elements.scss` does not need to be selected additionally. Your website should display red H1 headlines 
and blue text paragraphs.

You can now edit the file `theme.scss` directly using the Contao [file manager](/en/file-manager/), set a 
different color value for the variable `$main-color` and save the changes. 
The H1 caption is printed with the changed color value.


### Note I - Handling of Partials

Use the Contao [file manager](/en/file-manager/) to enter a different color value for the paragraph in the 
file `_elements.scss` and save the changes. Unfortunately, this change is not immediately applied in the frontend!

To make your change effective in the Sass partial file, you have to edit the file `theme.scss` (just insert a blank 
line and save it) or in the "System Maintenance" you have to empty the `Scriptcache`.


### Note II - CSS preprocessor version

The Contao integration of the CSS preprocessors is done using independent, free PHP libraries. In the case of 
Sass [scssphp/scssphp](https://github.com/scssphp/scssphp). Which version is currently used can be found in 
the respective Contao [composer.json](https://github.com/contao/contao/blob/master/composer.json).

This is an independent implementation with regard to the Sass functions which does not necessarily correspond to the 
actual [Sass version](https://sass-lang.com/install). So if you want to use Sass functionality in your `.scss` files 
according to the current [Sass documentation](https://sass-lang.com/documentation), it might not be supported by the 
Contao integration. In this case, the only thing that helps is to compare them with the information provided 
by the [scssphp/scssphp developer](https://github.com/scssphp/scssphp/blob/master/tests/specs/sass-spec-exclude.txt).


## Conclusion

If you follow the instructions above, you can easily work with `.scss` or `.less` in Contao. This is especially true 
if you mainly use variables or Sass partials. The advantage is that you can work directly with the 
Contao [file manager](/en/file-manager/).

On the other hand, you may not have access to all the current functions of the CSS preprocessor versions, 
which makes troubleshooting difficult.


## Recommendation

As mentioned in the beginning, it is recommended to use CSS preprocessors locally. 
You are independent of the preprocessor version you are using. In Contao, you only include your final `.css` files.
