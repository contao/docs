---
title: "Hooks"
description: "Developer Reference for Contao Hooks."
---


This is the reference for [Hooks](HooksFramework) explaining all the available hooks 
of the Contao core and their parameters. The examples in this reference implement 
Hooks using [_Service Annotation_][HooksServiceAnnotation] and [_Invokable Services_][HooksInvokableServices]. 
These examples will work out of the box within a Contao **4.9+** installation. 

However, if you need to implement a Hook for Contao **4.4**, you still need to use the 
[PHP Array Configuration][HooksArrayConfig]. In case you want to use an invokable
service here as well, you can still reference the `__invoke` function:

```php
// app/Resources/contao/config/config.php
use App\EventListener\GetArticlesListener;

$GLOBALS['TL_HOOKS']['getArticles'][] = [GetArticlesListener::class, '__invoke'];
```


[HooksFramework]: /framework/hooks/
[HooksServiceAnnotation]: /framework/hooks/#using-annotations
[HooksInvokableServices]: /framework/hooks/#invokable-services
[HooksArrayConfig]: /framework/hooks/#using-the-php-array-configuration


{{% children depth="999" %}}
