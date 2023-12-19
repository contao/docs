---
title: "Hooks"
description: "Developer Reference for Contao Hooks."
---


This is the reference for [Hooks][HooksFramework] which describes all the available hooks of the Contao core and their 
parameters. The examples in this reference implement Hooks using _PHP Attributes_ and _Invokable Services_. These examples 
will work out of the box within a Contao **4.13** and **5.x** installation under PHP 8 and higher. For lower Contao or PHP
versions you need to use _Service Annotations_ instead. If you need to implement a Hook for Contao **4.4**, you still need 
to use the _PHP array configuration_. See [here][HooksRegistering] for more information on the topic of registering Hooks.

[HooksFramework]: /framework/hooks/
[HooksRegistering]: /framework/hooks/#registering-hooks

{{% children depth="999" %}}
