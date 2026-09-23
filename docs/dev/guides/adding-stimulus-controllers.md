---
title: "Adding Stimulus Controllers"
description: "How to add custom Stimulus controllers for the back end."
aliases:
  - /guides/adding-stimulus-controllers/
---

Since Contao 5 now uses Turbo and Stimulus for the backend, sometimes it might not be enough to register JS assets for the backend as described under [Adding Backend assets][AddingBackendAssets], especially when listening for the `DOMContentLoaded` event.

In this case it might be necessary to add a custom Stimulus controller.

The following example assumes:
- You're using [Webpack Encore][SymfonyWebpackEncore] for asset management.
- You want to add code for a custom widget.

{{% notice info %}}
This guide is meant for bundle development.
{{% /notice %}}

### Adding a custom Stimulus controller

```js
// assets/controllers/my-custom-widget-controller.js
import { Controller } from "@hotwired/stimulus";

export default class MyCustomWidgetController extends Controller {
    connect() {
        // do your stuff
    }
    
    disconnect() {
        this.#cleanup();
    }
    
    beforeCache() {
        this.#cleanup();
    }
    
    #cleanup() {
        // revert the markup before caching and when disconnecting
    }
    
    
}
```

### Adding your Stimulus application

```js
// assets/backend.js
import { Application } from "@hotwired/stimulus";
import MyCustomWidgetController from "./controllers/my-custom-widget-controller";

const application = Application.start();
application.register("my-vendor-prefix--my-custom-widget", MyCustomWidgetController);

// Call the beforeCache() function on all controllers implementing it. This
// allows controllers to tear down things before the page gets put into cache.
// Note that Stimulus' disconnect() function will not fire at this point and
// thus cannot be used for this task.
document.documentElement.addEventListener('turbo:before-cache', (e) => {
    for (const controller of application.controllers) {
        if ('function' === typeof controller.beforeCache) {
            controller.beforeCache(e);
        }
    }
});
```

### Registering your Stimulus application

```json
// package.json
{
  …
  "devDependencies": {
    "@hotwired/stimulus": "^3.2",
    // any other dependencies you need for your controller/application
  },
  …
}
```

Read more about developing Stimulus controllers [here][StimulusControllers].

Regarding `#cleanup()` and `beforeCache()`, also check the notes on idempotency under [Turbo-compatible Stimulus controllers][StimulusBackend]

[AddingBackendAssets]: /guides/adding-back-end-assets
[SymfonyWebpackEncore]: https://symfony.com/doc/current/frontend/encore
[StimulusControllers]: https://stimulus.hotwired.dev/handbook/introduction
[StimulusBackend]: /internals/_stimulus-backend