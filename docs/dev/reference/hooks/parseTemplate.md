---
title: "parseTemplate"
description: "parseTemplate hook"
tags: ["hook-template"]
aliases:
    - /reference/hooks/parseTemplate/
    - /reference/hooks/parsetemplate/
---


The `parseTemplate` hook is triggered before parsing a template. It passes the template object and does not expect a return value. This hook
is useful to transform existing template data or to enrich the template with additional variables or even functions.


## Parameters

1. *\Contao\Template* `$template`

    The front end or back end template instance.


## Examples

The following example will provide an additional variable called `foobar` in any `fe_page` template:

```php
// src/EventListener/ParseTemplateListener.php
namespace App\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\Template;

/**
 * @Hook("parseTemplate")
 */
class ParseTemplateListener
{
    public function __invoke(Template $template): void
    {
        if ('fe_page' === $template->getName() || 0 === strpos($template->getName(), 'fe_page_')) {
            $template->foobar = 'foobar';
        }
    }
}
```

The following example provides an additional `isMemberOf` function in any front end template, which will check whether the currently logged
in member is a member of the given group ID (or IDs):

```php
// src/EventListener/ParseTemplateListener.php
namespace App\EventListener;

use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\FrontendTemplate;
use Contao\Template;
use Symfony\Component\Security\Core\Security;

/**
 * @Hook("parseTemplate")
 */
class ParseTemplateListener
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function __invoke(Template $template): void
    {
        if (!$template instanceof FrontendTemplate) {
            return;
        }

        $template->isMemberOf = function ($groupId): bool {
            return $this->security->isGranted(ContaoCorePermissions::MEMBER_IN_GROUPS, $groupId);
        };
    }
}
```

```html
<!-- templates/my_template.html5 -->
<?php if ($this->isMemberOf(1)): ?>
  <p>Member belongs to group ID 1!</p>
<?php endif; ?>

<?php if ($this->isMemberOf([1, 2])): ?>
  <p>Member belongs to group IDs 1 or 2!</p>
<?php endif; ?>
```

{{% notice note %}}
The [`ContaoCorePermissions::MEMBER_IN_GROUPS` check](/framework/security/#voters) is only available in Contao **4.12** or higher.
{{% /notice %}}


## References

* [\Contao\Template#L258-L266](https://github.com/contao/contao/blob/4.12.4/core-bundle/src/Resources/contao/library/Contao/Template.php#L290-L298)
