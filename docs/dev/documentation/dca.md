---
title: Data Container Array
---

Data Container Arrays (DCAs) are used to store table meta data. Each DCA describes a particular table in terms of its configuration, its relations to other tables and its fields. The Contao core engine determines by this meta data how to list records, how to render back end forms and how to save data. The DCA files of all active module are loaded one after the other (according to the dependencies), so that every module can override the existing configuration.

## Registering callbacks

See the [reference][1] for all available callbacks in the DCA.

### Using service tagging

{{< version "4.7" >}}

Since Contao 4.7 DCA callbacks can be registered using the `contao.callback` service tag.
Callback listeners can be added to the service configuration in the following way:

```yml
services:
    App\EventListener\Dca\ContentListener:
        public: true
        tags:
            - { name: 'contao.callback', table: 'tl_content', target: 'config.onload', priority: -1 }
            - { name: 'contao.callback', table: 'tl_content', target: 'fields.module.options' }
```

Each tag can have the following options:

| Option   | Type      | Description                                                                                                           |
| -------- | --------- | --------------------------------------------------------------------------------------------------------------------- |
| name     | `string`  | Must be `contao.callback`.                                                                                            |
| table    | `string`  | The target table of the DCA.                                                                                          |
| target   | `string`  | The target callback within the DCA with the array positions separated by periods. The last element is the callback name - however the `_callback` suffix is optional |
| method   | `string`  | _Optional:_ the method name in the service. Otherwise the method name will be `onCallbacknameCallback` automatically. |
| priority | `integer` | _Optional:_ priority of the callback. By default it will be executed after all other callbacks according to the loading order of the bundles. Anything with lower than `0` will be executed before legacy callbacks. |




### Using the PHP array configuration

[1]: ../../reference/dca/callbacks/
