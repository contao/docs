---
title: "Namespaces & Class Names"
description: "Recommendations for namespaces & class names."
aliases:
    - /guides/namespaces/
---


## Namespaces

The following is a list of recommended namespaces for various classes when
developing within the Contao framework. None of these are mandatory though.

| Namespace                       | Resource                                                                                 |
|:--------------------------------|:-----------------------------------------------------------------------------------------|
| `App\ContaoManager `            | Contao&nbsp;Manager related classes (e.g. the [Manager&nbsp;Plugin][1])                  |
| `App\Controller\ContentElement` | [Content element][2] fragment controllers                                                |
| `App\Controller\FrontendModule` | [Front end module][3] fragment controllres                                               |
| `App\Cron`                      | [Cron jobs][4]                                                                           |
| `App\EventListener`             | Symfony&nbsp;event&nbsp;listeners, Contao&nbsp;[hooks][5]&nbsp;&amp;&nbsp;[callbacks][6] |
| `App\Model`                     | Database [models][7]                                                                     |
| `App\Widget`                    | Form widgets                                                                             |


## Class Names

As it is customary within the Symfony environment, classes of certain namespaces
should also be named with a namespace specific suffix:

| Namespace           | Suffix       | Example                            |
|:--------------------|--------------|------------------------------------|
| `App\Controller`    | `Controller` | `App\Controller\ExampleController` |
| `App\Cron`          | `Cron`       | `App\Cron\ExampleCron`             |
| `App\EventListener` | `Listener`   | `App\EventListener\ExampleListener`|
| `App\Model`         | `Model`      | `App\Model\ExampleModel`           |
| …                   | …            | …                                  |


[1]: /framework/managed-edition/manager-plugin/
[2]: /framework/content-elements/
[3]: /framework/front-end-modules/
[4]: /framework/cron/
[5]: /framework/hooks/
[6]: /framework/dca/#registering-callbacks
[7]: /framework/models/
