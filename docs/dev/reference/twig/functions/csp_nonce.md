---
title: csp_nonce - Twig Function
linkTitle: csp_nonce
description: Adds CSP nonces for inline styles and scripts.
tags: [Twig]
---

{{< version "5.3" >}}

This allows you to add [CSP nonces](https://content-security-policy.com/nonce/) for inline styles and scripts.

```twig
{# Generate nonce for inline JavaScript #}
<script{{ attrs().setIfExists('nonce', csp_nonce('script-src')) }}>
    alert('foo');
</script>

{# Generate nonce for inline styles #}
<style{{ attrs().setIfExists('nonce', csp_nonce('style-src')) }}>
    body {
        background-color: magenta;
    }
</style>
```

## Arguments

* `directive`: The CSP directive the nonce will be generated for.

{{% notice "note" %}}
Contao overwrites the `csp_nonce` method from `nelmio/security-bundle` to which the call will also be forwarded to, if
Contao's CSP functionality is not active for the current request.
{{% /notice %}}
