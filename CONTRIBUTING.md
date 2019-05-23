# Contributing


## Documented versions

Only major versions are documented (e.g. Contao 4 and later on Contao 5).


## General rules

* Only use ATX style headlines (e.g. `# H1` or `### H3`).
* See [learn.netlify.com/en/cont/markdown/](https://learn.netlify.com/en/cont/markdown/) and [learn.netlify.com/en/shortcodes/notice/](https://learn.netlify.com/en/shortcodes/) for available markdown and shortcode syntax.
* Always add two empty lines above each headline.
* Add line breaks after 80 characters in paragraphs.
* Code examples should follow the Symfony Best Practices Book, use PHP 7.1 and
put Contao related files to `app/Resources/contao` if not avoidable

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

{{< version "4.7" >}}
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

This part of the development documentation should explain features of the Contao framework and how to use them. e.g. Templates, Palette Manipulator, image generation, etc. with references to the cookbook.


#### Reference

This part of the development documentation should be a full reference of all available hooks, callbacks, DCA configuration, available config settings, etc.


#### Cookbook

This should contain specific examples and use cases on how to use and implement the previously mentioned topics.
