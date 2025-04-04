---
title: "Turbo-compatible Stimulus controllers"
description: "How to write Stimulus controllers for a Turbo application (that don't suck)"
---

**Lifecycle callback cheatsheet**

```js
import {Controller} from '@hotwired/stimulus';

export default class extends Controller {
    // Run once, when this controller class is registered (rarely needed)
    static afterLoad(identifier, application) {
    }

    // Run once, when the current controller instance is created
    initialize() {
    }

    // Run each time the controller element is added to the DOM
    connect() {
    }

    // Run each time the controller element is removed from the DOM
    disconnect() {
    }

    // Run before Turbo creates a cache snapshot (Contao-only)
    beforeCache(event) {
    }
}

```

## 1) Use idempotent transformations

If you need to make changes to the DOM make sure these are idempotent. That means, applying the code multiple times does
not do any harm. Why is this important? Because cache entries are made before the DOM gets removed, so any cleanup in a
`disconnect()` method has no effect.

### Example

```html
<div data-controller="add-foo"></div>
```

```js
/* add-foo controller */
connect()
{
    const div = document.createElement('div');
    div.innerText = 'foo';
    this.element.appendChild(div);
}
```

After connecting, this is what the DOM looks like and what will get cached:

```html
<div data-controller="add-foo">
    <div>foo</div>
</div>
```

When a cache entry is restored, the connect function will run again, producing unwanted output:

```html
<div data-controller="add-foo">
    <div>foo</div>
    <div>foo</div>
</div>
```

### Detect or guard transformations

To prevent transformations, that were applied multiple times, …

1) … the change can be detected (in the above example: test for the existence of the `foo` div)
2) … an attribute is set in the DOM (for instance a `data-initialized` attribute) and checked for
3) … the element is restored to its original state before a cache entry is made
4) … the element is completely removed before a cache entry is made

**CAVEAT:** If you are using 1) or 2) and you detect an already transformed state, it is important to note, that the DOM
you are looking at is basically dead. It was restored from cache, so there are no event listeners or live objects. If
your controller uses these, you still need to attach them. This is especially tricky with 3rd party code that enhances
the DOM (choices, ace, tinyMCE, …) - for these cases it might be necessary to use 3) or 4).

### Cleanup before caching

Turbo dispatches the `turbo:before-cache` event right before creating the DOM copy that is stored in cache. Here we can
perform some cleanup. In Contao, we are calling the `beforeCache` method on any Stimulus controller, that implements it.

```js
beforeCache()
{
    // Create a clean slate before the page is cached.

    // After that, Turbo will for instance exchange the document's HTML - and
    // that is when the disconnect() methods will get called. If you are already
    // removing things here, make sure you do not rely on their existence during
    // disconnect().
}
```

Alternatively, a resource that is 'temporary in nature' like a flash message, can be annotated with the
`data-turbo-temporary` attribute. Then, on `turbo:before-cache` this element will be removed completely.

## 2) Restore resources after removal

Whenever an element gets removed from the DOM, the `disconnect()` method will run. Always assume that this can happen at
any time. Cleanup CSS classes on parent elements, created sibling elements, etc.

```js
disconnect()
{
    // The element is gone after this, so no need to remove event listeners on
    // the element itself. Any other resource, however, must be restored/removed.
}
```

### Prevent memory leaks

Make sure you are not creating any memory leaks. These could come in the form of event listeners on anything outside the
element or resources such as class instances to which you or the DOM is still holding a reference after this method has
run!

### Be resilient

If you are cleaning up objects or elements, try to think of scenarios where these do not exist anymore at this point. In
that case you might want to introduce checks or use the `?.` operator instead of `.` to access properties.

Here are some considerations:

* Do you perform cleanup in a `beforeCache` method? If so, this could have run before.
* Could the DOM have been altered in the meantime by another controller or 3rd party code?
* Was a resource optional (i.e. not instantiated at all) because the DOM was already transformed and you skipped
  evaluation in the `connect()` method?

## 3) Conventions

### Method naming

In JS, there aren't any private methods. To differentiate between what is API (for example a Stimulus action) and what
is used internally, prefix the "private" methods with an underscore:

```js
/**
 * API; this is for instance called by a `data-action="click->my-controller#open"`.
 */
open()
{
    this._performStuff();
}

_performStuff()
{
    // internal stuff, not meant to be called from outside
}
```

### Events

* Avoid registering events by calling `addEventListener`, use the `data-action` notation instead. This way
  adding/deleting is handled by Stimulus.
* If you still need to register events manually (for example if they are on dynamically created elements), make sure to
  remove them again in the `disconnect()` method. This step can be omitted if the target is the controller element
  itself or a child of it (because it will be removed from the DOM anyway) and you do not hold a reference that would
  prevent garbage collection.
* Bindings on the `window` will not go out of scope as Turbo Drive only replaces/morphs the `body` and `head`.

