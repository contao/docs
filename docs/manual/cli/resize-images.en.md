---
title: "contao:resize-images"
description: "Process deferred images that were not resized."
aliases:
    - /en/cli/resize-images/
weight: 30
---


{{< version "4.8" >}}

With this command you can process all deferred images that were not yet resized.

```sh
 php vendor/bin/contao-console contao:resize-images [options]
```

| Option             | Description |
|--------------------|-------------|
| `--concurrent`     | Run multiple processes concurrently with a value larger than 1 or pause between resizes to limit CPU utilization with values lower than 1.0. On a shared hosting environment it might make sense to use a value lower than `0.5` to limit the CPU consumption to 50%.|
| `--time-limit`     | Time limit in seconds after which the command should stop execution.|
| `--image=IMAGE`    | Pass an image path like `1/foobar-f6eac395d.jpg` (without the `assets/images` prefix) to resize one specific image only.|
| `--no-sub-process` | Disables the use of a sub process for each image resize. Use with caution, this could result in an extremely high memory consumption.|