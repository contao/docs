---
title: "Die eigene Contao Website in einem <iframe> auf einer anderen Domain anzeigen."
description: "Das nelmio/NelmioSecurityBundle anpassen."
url: "display-your-website-in-iframe"
aliases:
    - /de/display-your-website-in-iframe/
    - /en/display-your-website-in-iframe/
weight: 100
---

Du möchtest die Inhalte deiner Contao Website auf einer andernen Domain über ein <iframe> Tag einbinden?
Dann kannst du folgende Einstellungen in der config.yml hinzufügen.

{{% notice note %}}
Sollte die Datei /config/config.yml noch nicht vorhanden sein, kannst du diese einfach anlegen.
{{% /notice %}}

## Eine bestimmte Domain erlauben

```
nelmio_cors:
    defaults:
        origin_regex: true
        allow_origin: ['theme-preview.org']
        allow_methods: ['GET', 'OPTIONS', 'POST', 'PUT', 'PATCH', 'DELETE']
        allow_headers: ['Content-Type', 'Authorization']
        max_age: 3600
```

Über `allow_methods` kannst du definieren, mit welchen Methoden ein Aufruf möglich ist.
`allow_origin` und `allow_headers` können auf `*` gesetzt werden, um jeden Wert zu akzeptieren,
die erlaubten Methoden müssen jedoch explizit aufgeführt werden.

## Mehrere Domains erlauben

```
nelmio_cors:
    defaults:
        origin_regex: true
        allow_origin: ['^http://localhost:[0-9]+','contao-themes.net','theme-preview.org']
```

## Eine bestimmte Seite für eine Domain freigeben

```
nelmio_cors:
    paths:
        '^/meine-iframe-seite.html':
            allow_origin: ['theme-preview.org']
```

`paths` muss mindestens ein Element enthalten.

## Eine bestimmte Seite für alle Domains erlauben

```
nelmio_cors:
    paths:
        '^/meine-iframe-seite.html':
            allow_origin: ['*']
```

Mehr Informationen zur Konfiguration des [Nelmio Cors Bundle][.1] findest du unter 

[1]: https://github.com/nelmio/NelmioCorsBundle#configuration
