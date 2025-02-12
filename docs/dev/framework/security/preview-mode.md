---
title: "Preview Mode"
description: Explanation of the preview mode of Contao.
aliases:
    - /framework/security/preview-mode/
---


The Contao Managed Edition comes with an additional `preview.php` entry point. This entry point is either accessible via
a back end login, or a valid preview link.

When this entry point is accessed with a back end login, it offers features like logging in as a front end member or 
showing hidden elements.

To check whether code (content element, front end module, etc.) is currently executed within the preview entry
point you can check for the `_preview` request attribute.

```php
class FoobarController extends AbstractContentElementController
{
    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        if ($request->attributes->get('_preview')) {
            // Execute some code within the preview entry point
        }

        return $template->getResponse();
    }
}
```

```twig
{% if app.request.attributes._preview|default %}
    {# Show some content within the preview entry point #}
{% endif %}
```

This however, does not check for the actual _preview mode_, which is activated by selecting _Unpublished: show_ in the
preview toolbar - or by accessing the preview entry with a valid preview link that has this feature enabled. To check
for this, you can use the [`TokenChecker`][TokenChecker] service.

```php
use Contao\CoreBundle\Security\Authentication\Token\TokenChecker;

class FoobarController extends AbstractContentElementController
{
    public function __construct(private readonly TokenChecker $tokenChecker)
    {
    }

    protected function getResponse(Template $template, ContentModel $model, Request $request): Response
    {
        if ($this->tokenChecker->isPreviewMode()) {
            // Execute some code when the preview mode is active
        }

        return $template->getResponse();
    }
}
```

{{< version-tag "5.3" >}} This is also available via the `contao` global Twig variable:

```twig
{% if contao.is_preview_mode %}
    {# Show some content only available in the preview mode #}
{% endif %}
```

{{% notice "note" %}}
In previous Contao versions, the `BE_USER_LOGGED_IN` constant was used for this. This constant was `true` whenever a
valid back end login session is present and the _Unpublished: show_ option was enabled. However, with the introduction of
the preview link feature of Contao **4.13** this is not necessarily the case anymore, i.e. this constant can be `true`
even without a back end login. The constant is deprecated in Contao 4.13 and has been removed in Contao 5, the aforementioned
`contao.security.token_checker` should be used instead.
{{% /notice %}}


[TokenChecker]: /reference/services#tokenchecker
