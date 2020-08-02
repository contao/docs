---
title: 'Sass/Less Integration'
description: 'Instructions for the direct use of CSS preprocessors within Contao.'
aliases:
    - /en/guides/sass-less-integration/
weight: 30
tags:
    - Theme
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

The page layouts of your theme include the finished CSS stylesheets. CSS preprocessors such as [Sass or SCSS](https://sass-lang.com/) or [Less](http://lesscss.org/) are often used to create CSS files. For the following examples we use Sass/SCSS. The procedure for Less is otherwise identical, apart from the different language syntax.

## Implementation within Contao

The use of preprocessors usually requires a local installation. With Contao, you `.scss` can embed `.less` files directly in the page layout. The corresponding CSS files are then created automatically.

{{% notice note %}}
 Even if the direct use in Contao works, it is still recommended to use ready-to-use CSS files or create them locally using CSS preprocessors. 
{{% /notice %}}

For our simple example we create two files under the `files` folder: `theme.scss` and `_elements.scss` in any directory that is publicly accessible. The file `theme.scss` will contain only one variable with a color value and the file (sass `_elements.scss` part) via the [@import](https://sass-lang.com/documentation/at-rules/import) statement. In the file `_elements.scss` we set the color value for the H1 element via the variable `$main-color` and a separate color value for a paragraph.

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

Of course the CSS preprocessors offer much more possibilities. But for our example it is sufficient.

You can now include the file `theme.scss` in your page layout, analogous to the usual procedure with `.css` -files. You do not `_elements.scss` need to select the file additionally. Your website should then display red H1 headlines and blue text paragraphs.

You can now edit the file `theme.scss` directly using the Contao [file manager](../../dateiverwaltung). Set a different color value for the variable `$main-color` and save the changes. The H1 caption is printed with the changed color value.

### Note I - Handling of Partials

Now use the Contao [file manager](../../dateiverwaltung) to enter a different color value for the paragraph in the file `_elements.scss` and save the change. Unfortunately, this change is not immediately applied in the frontend!

For your changes to take effect in the Sass-Partial file you have to either `theme.scss` edit the file (just insert an empty line and save it) or in the "System Maintenance" the `Scriptcache` empty one.

### Note II - CSS preprocessor version

The Contao integration of the CSS preprocessors is done using independent, free PHP libraries. In the case of Sass, Contao uses [scssphp/scssphp](https://github.com/scssphp/scssphp) . Which version is currently used can be found in the respective Contao [composer.json](https://github.com/contao/contao/blob/master/composer.json#L78).

This is therefore an independent implementation with regard to the Sass functional scope, which does not necessarily always correspond to the actual [Sass version](https://sass-lang.com/install). So if you want to use functionality in your `.scss` files that is based on the current [Sass documentation](https://sass-lang.com/documentation), it might not be supported by Contao integration. In this case, the only thing that helps is to compare the files with the specifications of the [scssphp/scssphp developer](https://github.com/scssphp/scssphp/blob/master/tests/specs/sass-spec-exclude.txt).

## Conclusion

If you follow the instructions above, you can easily work with `.scss` or `.less` in Contao. This is especially true if you mainly use variables or partials. The advantage is that you can work directly with the Contao [file manager](../../dateiverwaltung) .

On the other hand, you may not have access to all the latest features of the CSS preprocessor versions. Troubleshooting is then time-consuming.

## Recommendation

As already mentioned at the beginning, local handling of CSS preprocessors would therefore be recommended. You are independent with regard to the use of the respective preprocessor versions. In Contao, you only include your final `.css` files.
