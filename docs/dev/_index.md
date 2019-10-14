---
title: "Contao Developer Documentation"
---


# Contao Developer Documentation

Welcome to the Contao manual for developers and the Contao ecosystem!
This introduction is meant to give you an overall idea of how things work in Contao and its ecosystem, people with assigned
roles, whom to talk to and where to get help.

This document is split into these chapters:

* **[Getting Started](getting-started)**<br>
  This chapter provides an overview over the capabilities of the Contao Open Source
  CMS and should help new developers with getting their web application project started
  with Contao more easily.

* **[Framework](framework)**<br>
  This chapter describes the ins and outs of the Contao ecosystem. It
  provides articles about Contao libraries, how to use and extend Contao
  and general articles about concepts unique to this CMS.
  
* **[Reference](reference)**<br>
  The reference is a goto guide for all available options in certain
  features, like say DCA configuration or Hooks.

* **[Guides](guides)**<br>
  This section contains a continuously growing collection of specific
  recipes and guides that explain how to correctly solve the most recurrent problems
  that Contao & Symfony developers face in their day to day work.

* **[Internals](internals)**<br>
  This section contains documentation about various internal procedures or articles
  about topics that do not fit into the regular documentation.


### History

To understand why things are the way they are in Contao it's very helpful to understand at least some of its history.
Contao's been on the market since 2006 and there never was any complete rewrite but the code base has evolved
step by step as the years passed by instead. In 2015 Contao 4 was released as a Symfony Bundle which can be installed
into your regular Symfony application just like any Symfony bundle you know.
This is still the case to this day.

For Contao and its community, the release of Contao 4 meant a huge technical leap, being confronted with Composer and Symfony
all of a sudden now.
The Core team decided that the project needs the ability to slowly transition from Contao 3 to Contao 4 as adoption would
never take place otherwise. That's why Contao 4 essentially still carries around code that's been there for years because
of backwards compatibility.
Most of this code resides in `core-bundle/Resources/contao` so it does not interfere with code that's been written later
on, put into namespaces properly and being unit tested as you'd expect it from any modern CMS.
Examples for legacy code that still works might be your typical library classes any CMS that's been on the market for
a while would provide such as file operations (`File`, `Folder`), request handling (`Environment`) and many more. Most
of which are not used anymore in new code as we have are better alternatives at hand using Composer.

Contao heavily relies on superglobals in older code which basically served as some sort of Dependency Injection Container
back in the days which is why you'll still come across loads of `$GLOBALS` usages all over the place.
However, there's a steady transition going on and with every new release there are new ways introduced as to how you can
e.g. register a new content element. The old code is just still floating around to make sure all the already existing
extensions/bundles still work. It will eventually be dropped once Contao 5 becomes a thing.


### Input encoding

One special thing to be aware of when working with Contao is that unfortunately we carry a very old burden with us which
is input encoding.

> User input must not be trusted, it must be encoded when output because that's the only place where you can encode
> correctly depending on the context.

Unfortunately, back when Contao was created, there was no such thing as `Twig`. `Smarty` was probably already on the market
but automated output encoding was likely less of an issue back then.
So when Contao decided to use plain old PHP as templates, one would have to call some special encode method on every
variable that was output. Instead of doing that it was decided to encode the input and store the data encoded in the
database already. Of course, you do have the option to disable this when you develop your own extensions to Contao but
it's just something to keep in mind. We all know it's wrong but migrating away from already encoded data is very hard
and likely will only become a thing when we switch to Contao 5.

So be aware of this. Don't just use e.g. Symfony's `Request` class to fetch user input, store it as is in the DB and
let Contao display it in the back end.


### Ecosystem

Everything related to Contao development happens in one of the repositories assigned to the ["Contao" organisation on
GitHub][1]. Here's a description of the most important repositories you should be familiar with:

* **contao/contao**<br>
  This is the Contao Monorepository where all of the active development of the `core-bundle` an additional bundles takes
  place. It's likely the most important repository you want to follow.

* **contao/managed-edition**<br>
  The Contao bundles are designed in such a way that you can add them to your very own Symfony application but most of
  the setups of Contao are using the "Managed Edition". The Managed Edition basically consists of the `contao/manager-bundle`
  which itself provides the skeleton of a full Symfony application. Using a Composer script it will build a complete
  Symfony application around your `composer.json`. The Managed Edition was a thing before "Symfony Flex" appeared on the
  market. If you install the Contao Managed Edition you have the advantage that updates of Contao will be easier as you
  don't have to update your `config.yaml` to the latest settings with every release.
  The idea is that bundles can register themselves to the kernel when it is installed, similar to what Symfony Flex does
  with its recipes. For that matter, we use the "Manager Plugin".
  
* **contao/manager-plugin**<br>
  The Contao Manager Plugin is a Composer plugin that provides access to bundles to register themselves to the kernel,
  configuring the DI container, adding routes and much more.

So far, everything you got to know from Contao's ecosystem still requires you to work on command line. Thanks to the
Contao Managed Edition a lot of tedious work is automated for you but to set it all up and manage it, you still need to
feel comfortable with the CLI, Composer and much more. As a developer that should not be much of an issue for you so you
might probably stop here but to get a complete picture of the Contao ecosystem, please continue reading.
  
* **contao/contao-manager**<br>
  The majority of Contao's users want to be able to install Contao on their web server and manage it there.
  The Contao Manager is Contao's answer to this need. It's a GUI that's compiled to a single PHAR file which is distributed
  on contao.org and provides self update functionality. You can install it on your web server and start managing your
  setup using a nice GUI.

* **contao/package-metadata**<br>
  Composer packages usually don't contain extensive descriptions and they are managed in English only which is why
  Contao provides a repository where additional metadata and translations for these packages can be provided. They
  are then used within the Contao Manager so if you want people to not just install your Contao bundle on CLI but also
  from the Contao Manager you might want to contribute additional information here.
  
* **contao/docs**<br>
  This is the repository where the documentation you're reading is being managed. The more contributors the better the
  documentation. Thus, we're counting on your contribution!


### People

Sometimes it's helpful if you know the people involved in Contao development. Of course, as an Open Source project
it is what people make it, so please, [contribute][2]!

In any case, the current core team members consist of (in alphabetical order)

* [Auswöger, Martin (@ausi)](https://github.com/ausi) 
* [Feyer, Leo (@leofeyer)](https://github.com/leofeyer), Project Lead 
* [Greminger, David (@bytehead)](https://github.com/bytehead) 
* [Schempp, Andreas (@aschempp)](https://github.com/aschempp) 
* [Schmid, Jim (@sheeep)](https://github.com/sheeep) 
* [Witschi, Yanick (@toflar)](https://github.com/toflar) 

In addition, there's a core team for the documentation:

* [Ammann, Bjarke (@netzarbeiter)](https://github.com/netzarbeiter) 
* [Gschwantner, Fritz Michael (@fritzmg)](https://github.com/fritzmg) 


### Where to get help

Contao people are active on multiple channels. Of course, if you find a bug or want to request a feature (or ideally
prepare a pull request) please do so on the respective repository (most likely the `contao/contao` mono repository).
Other than that there are the following channels:

* **Slack:** [Join the Contao workspace][Slack]

* **IRC**<br>
  Server: freenode.net<br>
  Channels: #contao (English), contao.de (German), #contao.dev (Developers)
  
* **Forums**<br>
  English: https://community.contao.org/en/<br>
  German: https://community.contao.org/de/


[1]: https://github.com/contao
[2]: https://github.com/contao/contao/blob/master/.github/CONTRIBUTING.md
[Slack]: https://contao.slack.com/join/shared_invite/enQtNjUzMjY4MDU0ODM3LWVjYWMzODVkZjM5NjdlNDRiZjk2OTI3OWVkMmQ1YjA0MTQ3YTljMjFjODkwYTllN2NkMDcxMThiNzMzZjZlOGU
