---
title: "Core Concepts"
description: "An overview on the possibilities of customizing & extending Contao."
weight: 2
---


If you are still new to Contao, the [Contao manual][3] ist the best place to start
in order to familiarize yourself with the possibilities of _managing_ a web site 
using the Contao Content Management System.

The following section provides an overview on the possibilities of _customizing
& extending_ Contao in various ways for your web application.


## Data Container Arrays & Models

[_Data Container Arrays_][4] (_DCA_ for short) are a key concept of the Contao framework.
The management of any record within the Contao CMS is usually described via so called 
Data Container Arrays. It is possible to create custom DCAs as well as extending 
or altering existing ones.

[_Models_][6] are object representations of any DCA record, while _Collections_ 
are object representations of a collection of such Models. Models can be used to 
create, load and change these records. They usually also provide convenient functions 
for loading records according to a specific set of parameters.


## Front End Modules

[Front end modules][5] are used for any type of complex functionality on specific
pages or specific places on a page of your website managed by Contao. Simple examples
are login forms, displaying news entries, showing a navigation etc.


## Content Elements

While any data record can hold information for content to be displayed in the front
end, another key concept of Contao is the usage of [Content elements][7] for arbitrary
and more complex content. The content of regular static pages of Contao' site structure
is managed via individual content elements, as well as the detailed content of news
entries for example.


## Templating

Contao uses its own PHP [templating engine][8] with inheritance support. The output 
of any front end matter is usually generated via templates. Modules, entity elements,
sections, content elements, form fields, etc. all have their own template. Templates
can be overridden on an application level and often several different versions of
a template can be chosen.


## Assets & Images

Contao has full support for responsive images and supports a wide variety of image
processing techniques and libraries, including the basic GD lib for PHP as well as
Imagick and Gmagick.


## Hooks

Another important concept for customizing your Contao based web application are
so called [Hooks][9]. They allow you to modify certain aspects of the processes
within Contao. There are many different hooks placed throughout the Contao code 
base (see the [reference][10]).


## Extensions

Your web application's functionality can easily be extended by installing one or
more of the many [available extensions][12] for Contao. A Contao extension is basically
simply a Symfony bundle that you can load into your Symfony application - or will
be automatically loaded in the Contao Managed Edition. See the
[getting started article][13] on how to create an extension for Contao.


## Insert Tags

[Insert Tags][11] are special tokens that will be replaced with another content 
in the front end before it is sent to the client. They can be used anywhere and 
thus allow for dynamically generated content in any place. Contao brings its own 
set of available Insert Tags, however it is possible to register your own Insert
Tags as well.


[3]: https://docs.contao.org/manual
[4]: /framework/dca/
[5]: /framework/front-end-modules/
[6]: /framework/models/
[7]: /framework/content-elements/
[8]: /framework/templates/
[9]: /framework/hooks/
[10]: /reference/hooks/
[11]: /framework/insert-tags/
[12]: https://extensions.contao.org
[13]: /getting-started/extension/
