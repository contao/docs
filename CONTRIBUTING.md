# Contributing


## Documented versions

Only major versions are documented (e.g. Contao 4 and later on Contao 5).


## General rules

* Only use ATX style headlines (e.g. `# H1` or `### H3`).
* See [learn.netlify.com/en/cont/markdown/](https://learn.netlify.com/en/cont/markdown/) 
  and [learn.netlify.com/en/shortcodes/notice/](https://learn.netlify.com/en/shortcodes/) 
  for available markdown and shortcode syntax.
* Always add two empty lines above each headline.
* Add line breaks after 80 characters in paragraphs.
* Code examples should follow the Symfony Best Practices Book, use PHP 7.1 and
  put Contao related files to `contao`.
* When using examples for PHP code or YAML configurations etc., include the example
  path to the file as a comment as the very first line. Do not use the `<?php` open
  tag and also do not use the `declare()` statement.

Example for link references:
```
Lorem ipsum dolor [sit amet](https://contao.org/) consectetuer adipiscing elitr. Aenean massa. 
Cum sociis [natoque](https://www.google.com/) penatibus et magnis dis.
```


## New features

Since we will not maintain different versions of the documentation for each minor 
Contao version, some features will be documented which are only available in newer 
Contao version. In such a case, document the _old_ way first (if applicable), then 
show the new way with a notice of the minimum Contao version required.

You can use the following short code to automatically add a note for features of a 
specific Contao version:

```
{{< version "4.7" >}}
```


### Example:

```markdown
## DCA callbacks

### PHP array configuration 

…

### Service tag

{{< version "4.8" >}}
```


## Structure


### Manual

TBD


### Development documentation

The development documentation is split into three parts:

* Documentation
* Reference
* Cookbook


#### Documentation

This part of the development documentation should explain features of the Contao framework and how to use them.
E.g. Templates, Palette Manipulator, image generation, etc. with references to the cookbook.


#### Reference

This part of the development documentation should be a full reference of all available hooks, callbacks,
DCA configuration, available config settings, etc.


#### Cookbook

This should contain specific examples and use cases on how to use and implement the previously mentioned topics.


## Some notes about your markdown contribution

* All paths and filenames should be in English.
* Consider that all markdown headings are added to the navigation. Write your headings accordingly.
* Do not try to embed external images or reuse already existing images from other articles. External images might
  be removed over time and the same applies for images of other articles.
* Avoid belittling words: People read documentation because they know very little about a specific topic or are even
  completely new to it. Things that seem "obvious" or "simple" for the person documenting it, can be the exact opposite
  for the reader. To make sure everybody feels comfortable when reading the documentation, try to avoid words like:
  
    * basically
    * clearly
    * easy/easily
    * just
    * logically
    * merely
    * obviously
    * of course
    * quick/quickly
    * simply
    * trivial


## The Hugo front matter variables

Every file needs at least the following [Hugo front matter](https://gohugo.io/content-management/front-matter/)
variables on top of your markdown content:

* `title`: A title for the file (language specific). The title will be used in the main left navigation as well.
* `description`: The content description (language specific).
* `url` (optional): The URL path (language specific). This should only be used if you want the URL to be different from
  the effective file path.
  E.g. for the German translation.
* `weight` (optional): Used for the sorting order in the left main navigation of the documentation.
  The weight might not be necessary everywhere. It's only necessary, when files need to be sorted according to something
  different from the default sorting (= different from the filename).
* `menuTitle` (optional): The optional menuTitle reflects an alternative label in the main left navigation.
  This is especially helpful if the original title is too long to look nice in the navigation.


## Applying changes

If you want to contribute changes to a page, simply use the "Edit this page" link 
at the top right of the documentation. Given that you have a GitHub account and 
are logged in, GitHub will automatically create a fork where you can create your 
changes in the respective markdown file. After committing your changes, GitHub will 
offer you to create a Pull Request. 

When changes to your Pull Request are requested, you can directly edit the files 
within the Pull Request.
