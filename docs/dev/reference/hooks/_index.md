---
title: "Hooks"
description: "Developer Reference for Contao Hooks."
---


This is the reference for [Hooks][HooksFramework] explaining all the available hooks 
of the Contao core and their parameters. The examples in this reference implement 
Hooks using _Service Annotation_ and _Invokable Services_. These examples will work out of the box within a Contao **4.9** and **5.x**
installation as well as in PHP 7 and PHP 8. If your application or extension has a minimum requirement of Contao **4.13** and PHP 8 then
you can exchange the annotations with PHP attributes. However, if you need to implement a Hook for Contao **4.4**, you still need to use the 
_PHP array configuration_. See [here][HooksRegistering] for more information on the topic of registering Hooks.


[HooksFramework]: /framework/hooks/
[HooksRegistering]: /framework/hooks/#registering-hooks

{{% children depth="999" %}}
