---
title: "Namespaces"
description: "Recommendations for namespaces."
---


The following is a list of recommended namespaces for various classes when
developing within the Contao framework. None of these are mandatory though.

| Namespace                       | Resource                                                                | Parent class                                                                   |
|:--------------------------------|:------------------------------------------------------------------------|:-------------------------------------------------------------------------------|
| `App\ContaoManager `            | Contao&nbsp;Manager related classes (e.g. the [Manager&nbsp;Plugin][1]) |                                                                                |
| `App\ContentElement `           | Content&nbsp;elements (old&nbsp;version)                                | `Contao\ContentElement`                                                        |
| `App\Controller\ContentElement` | Content elements (new&nbsp;version)                                     | `Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController` |
| `App\Controller\FrontendModule` | Front end modules (new&nbsp;version)                                    | `Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController` |
| `App\DataContainer`             | DCA callbacks                                                           |                                                                                |
| `App\EventListener`             | Symfony&nbsp;event&nbsp;listeners, Contao&nbsp;hook&nbsp;callbacks      |                                                                                |
| `App\FrontendModule`            | Front end modules (old&nbsp;version)                                    | `Contao\Module`                                                                |
| `App\Model`                     | Database models                                                         | `Contao\Model`                                                                 |
| `App\Widget`                    | Form widgets                                                            | `Contao\Widget`                                                                |

[1]: ../../documentation/managed-edition/manager-plugin/