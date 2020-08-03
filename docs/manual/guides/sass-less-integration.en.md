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

In the page layouts of your theme, the finished CSS stylesheets are included. CSS preprocessors like [Sass, SCSS or](https://sass-lang.com/) [Less](http://lesscss.org/) are often used to create CSS files. For the following examples we use Sass/SCSS. The Less procedure is otherwise identical, apart from the different language syntax.

## Implementation within Contao

Using the preprocessors usually requires a local installation. With Contao you can embed `.scss``.less`files directly in the page layout. The corresponding CSS files are then created automatically.

{{% notice note %}}
Even though the direct use in Contao works, it is still recommended to use ready-to-use CSS files or create them locally using CSS preprocessors.

For our simple example, we will create two files under the `files`folder: `theme.scss`and in `_elements.scss`any directory that is publicly accessible. The `theme.scss`file contains only one variable with a color value and the file (sass `_elements.scss`part) via the@import statement. In the file we set `_elements.scss`the color value for the H1 element using the variable `$main-color`and a separate color value for a paragraph.

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

You can now include the file `theme.scss`in your page layout, similar to the usual procedure with`.css` files. The file does not `_elements.scss`need to be selected additionally. Your website should display red H1 headlines and blue text paragraphs.

You can now edit the file `theme.scss`directly using the Contao [file manager](../../dateiverwaltung), set a different color value for the variable `$main-color`and save the changes. The H1 caption is printed with the changed color value.

### Note I - Handling of Partials

Use the Contao [file manager](../../dateiverwaltung) to enter a different color value for the paragraph in the file `_elements.scss`and save the changes. Unfortunately, this change is not immediately applied in the frontend!

To make your change effective in the Sass-Partial file, you have to `theme.scss`edit the file (just insert a blank line and save it) or in the "System Maintenance" you have to `Scriptcache`empty the empty line.

### Note II - CSS preprocessor version

The Contao integration of the CSS preprocessors is done using independent, free PHP libraries. In the case of Sassnut Contao [scssphp/scssphp](https://github.com/scssphp/scssphp). Which version is currently used can be found in the respective Contao [composer.json](https://github.com/contao/contao/blob/master/composer.json#L78).

This is an independent implementation with regard to the Sass functions which does not necessarily correspond to the actual [Sass version](https://sass-lang.com/install). So if you want to use Sass functionality in your `.scss`files according to the current [Sass documentation](https://sass-lang.com/documentation), it might not be supported by the Contao integration. In this case, the only thing that helps is to compare them with the information provided by the [scssphp/scssphp developer](https://github.com/scssphp/scssphp/blob/master/tests/specs/sass-spec-exclude.txt).

## Conclusion

If you follow the instructions above, you can easily work with `.scss`or `.less`in Contao. This is especially true if you mainly use variables or parts. The advantage is that you can work directly with the Contao [file manager](../../dateiverwaltung).

On the other hand, you may not have access to all the current functions of the CSS preprocessor versions, which makes troubleshooting difficult.

## Recommendation

As mentioned in the beginning, it is recommended to use CSS preprocessors locally. You are independent of the preprocessor version you are using. In Contao, you only include your final `.css`files.
