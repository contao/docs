---
title: Content Security Policy
description: "Contao's Content Security Policy framework."
---

{{< version "5.3" >}}

Contao **5.3** introduced support for [Content Security Policies][CSPWebsite] ([MDN Web Docs][CSPMDN]) for its front
end. Implementing CSP directives is an important tool to secure your website against XSS attacks and unwanted external
resources. At the same time we want to specifically allow scripts and resources generated or added by your application.
In this article we will show you how to use Contao's CSP framework in order to adjust the generated 
`Content-Security-Policy` response header from within your templates, controllers and services.


## The `CspHandler`

Content Security Policies are applied via Contao's [Response Context][ResponseContext] concept. When CSP is enabled in
[the settings][CspPageSettings] of a website root a `CspHandler` instance will be added to the response context. You can 
access the `CspHandler` in your services like this for example:

```php
// src/ExampleService.php
namespace App;

use Contao\CoreBundle\Routing\ResponseContext\Csp\CspHandler;
use Contao\CoreBundle\Routing\ResponseContext\ResponseContextAccessor;

class ExampleService
{
    public function __construct(private readonly ResponseContextAccessor $responseContextAccessor)
    {
    }

    public function __invoke(): void
    {
        $responseContext = $this->responseContextAccessor->getResponseContext();

        if ($responseContext?->has(CspHandler::class)) {
            /** @var CspHandler $csp */
            $cspHandler = $responseContext->get(CspHandler::class);

            // Retrieve nonces, add sources, …
        }
    }
}
```

The following describes the most important methods of the `CspHandler`. In many cases you will want to make these
adjustments directly from your templates though, rather than from within your controller for example. The reason for it being that if you do it from within templates, you can provide a lot more flexibility to your users. If e.g. a part of the template is not output, it also does not need any CSP information for it. Consequently
there are also template helper methods that you can use.


### Adding Sources

Typically when employing CSP directives you want to only allow resources that come from the website itself, i.e. from
the same domain. This can be achieved via `default-src 'self'` for example. If the website would then contain references
to an external source - e.g. via an `<iframe>` or `<script src="…">` etc. - that resource will be blocked by the 
browser. However, your application might deliberately want to include external resources and thus it is necessary to allow this resource specifically (or at least the domain of that resource). This can be done via the `addSource` method:

{{< tabs groupId="csp-methods" >}}
{{% tab name="PHP" %}}
```php
$cspHandler->addSource('frame-src', 'https://www.youtube.com/embed/foobar123');
```
{{% /tab %}}
{{% tab name="Twig" %}}
```twig
{% do csp_source('frame-src', 'https://www.youtube.com/embed/foobar123') %}
```
{{% /tab %}}
{{% tab name="PHP Template" %}}
```php
<?php $this->addCspSource('frame-src', 'https://www.youtube.com/embed/foobar123') ?>
```
{{% /tab %}}
{{< /tabs >}}

{{% notice "note" %}}
The method will automatically not add the source, if no source list had been set yet for the given directive (or its
fallbacks). This behavior can be switched off via the `$autoIgnore` parameter.
{{% /notice %}}


### Retrieving a Nonce

When employing a CSP directive that affects JavaScript or CSS (`default-src`, `script-src`, `style-src`) inline scripts
will not be allowed anymore as it is recommended to _only_ integrate scripts via files. However, if your application
still wants to use inline script or style elements it can still be allowed through the usage of [nonces][CSPNonce], 
without having to resort to allowing `'unsafe-inline'` in your directives. Contao's default JavaScript templates for 
instance still use inline JavaScript and thus will add a nonce when used. You can retrieve a nonce for `script-src` or 
`style-src` like this:

{{< tabs groupId="csp-methods" >}}
{{% tab name="PHP" %}}
```php
$nonce = $cspHandler->getNonce('script-src');
```
{{% /tab %}}
{{% tab name="Twig" %}}
```twig
<script{{ attrs().setIfExists('nonce', csp_nonce('script-src')) }}>
```
{{% /tab %}}
{{% tab name="PHP Template" %}}
```php
<script<?= $this->attr()->setIfExists('nonce', $this->nonce('script-src')) ?>>
```
{{% /tab %}}
{{< /tabs >}}

{{% notice "note" %}}
The method will automatically not return a nonce, if no source list had been set yet for the given directive (or its
fallbacks).
{{% /notice %}}

This nonce can then be added as a `nonce="…"` attribute to your `<script>` or `<style>` tag respectively.


### Adding Hashes

As mentioned in the previous section, any directives that affect JavaScript or CSS will automatically disallow any
inline scripts or inline styles. This also includes inline scripts via HTML attributes, e.g. `onclick="…"` or
`style="…"`. It is highly recommended to move these styles and scripts into files instead. However, if for some reason
this is not possible such inline scripts can still be allowed through [hashes][CSPHash]. A hash can be generated and
added to a directive for a specific inline script or style like this:

{{< tabs groupId="csp-methods" >}}
{{% tab name="PHP" %}}
```php
$cspHandler->addHash('style-src', 'display:none');
```
{{% /tab %}}
{{% tab name="Twig" %}}
```twig
{% do csp_hash('display:none') %}
<div style="display:none">
```
{{% /tab %}}
{{% tab name="PHP Template" %}}
```php
<div style="<?= $this->cspInlineStyle('display:none') ?>">
```
{{% /tab %}}
{{< /tabs >}}

{{% notice "note" %}}
In order for inline styles to work in browsers that support CSP Level 3 you will also need to add `'unsafe-hashes'` to
the respective directive's source list The same applies to inline JavaScripts for event listeners. See also these
examples for allowing 
[inline styles](https://content-security-policy.com/examples/allow-inline-style/) and 
[inline scripts](https://content-security-policy.com/examples/allow-inline-script/). This is done automatically for you
when using the `cspInlineStyle()` and `cspInlineStyles()` helper method in PHP templates and the `csp_inline_styles`
filter in Twig templates (see also the [`WysiwygStyleProcessor`](#the-wysiwygstyleprocessor) below).
{{% /notice %}}


## The `WysiwygStyleProcessor`

Contao uses the WYSIWYG Editor TinyMCE which creates inline styles for certain formatting options. In Contao's default
templates these styles are automatically processed. The styles are extracted and filtered by the `WysiwygStyleProcessor`
and then their hashes are added via the `CspHandler`. The allowed inline style properties can be configured via the 
`contao.csp.allowed_inline_styles` [bundle configuration][BundleConfig].

The `'unsafe-hashes'` directive will also be added automatically by the template helpers for CSP Level 3 compliance.

{{< tabs groupId="csp-methods" >}}
{{% tab name="PHP" %}}
You can use the `WysiwygStyleProcessor` directly in your services if you want to. Though typically you will likely only
need it in your templates (see other methods).

```php
// src/ExampleService.php
namespace App;

use Contao\CoreBundle\Csp\WysiwygStyleProcessor;
use Contao\CoreBundle\Routing\ResponseContext\Csp\CspHandler;
use Contao\CoreBundle\Routing\ResponseContext\ResponseContextAccessor;

class ExampleService
{
    public function __construct(
        private readonly ResponseContextAccessor $responseContextAccessor,
        private readonly WysiwygStyleProcessor $wysiwygProcessor,
    ) {
    }

    public function processInlineStyles(string $html): void
    {
        $responseContext = $this->responseContextAccessor->getResponseContext();

        if (!$responseContext?->has(CspHandler::class)) {
            return;
        }

        if (!$styles = $this->wysiwygProcessor->extractStyles($html)) {
            return;
        }

        /** @var CspHandler $csp */
        $csp = $responseContext->get(CspHandler::class);

        foreach ($styles as $style) {
            $csp->addHash('style-src', $style);
        }

        $csp->addSource('style-src', 'unsafe-hashes');
    }
}
```
{{% /tab %}}
{{% tab name="Twig" %}}
In Twig you can use the filter `csp_inline_styles`. See the following example from Contao's `text.html.twig` template:
```twig
{{ text|csp_inline_styles|insert_tag|encode_email|raw }}
```
{{% /tab %}}
{{% tab name="PHP Template" %}}
```php
<?= $this->cspInlineStyles($this->text) ?>
```
{{% /tab %}}
{{< /tabs >}}


[CSPWebsite]: https://content-security-policy.com/
[CSPMDN]: https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP
[ResponseContext]: /framework/response-context/
[CSPNonce]: https://content-security-policy.com/nonce/
[CSPHash]: https://content-security-policy.com/hash/
[BundleConfig]: /reference/config/
[CspPageSettings]: https://docs.contao.org/manual/en/layout/site-structure/configure-pages/#content-security-policy
