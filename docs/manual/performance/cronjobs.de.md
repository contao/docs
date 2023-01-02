---
title: 'Cronjob Framework'
description: 'Das Contao Cronjob Framework einrichten.'
url: "performance/cronjobs"
aliases:
    - /de/performance/cronjobs/
---

Contao wird von Haus aus mit einem Cronjob-Framework ausgeliefert. Kurz zusammengefasst ermöglicht dies
Entwickler*innen eine einfachere und einheitliche Registrierung von Cronjobs für ihre eigenen Erweiterungen.

Cronjobs werden standardmässig immer dann ausgeführt, wenn jemand die Webseite besucht. Dies kann die Performance 
deiner Webseite negativ beeinflussen, weshalb empfohlen wird, echte Cronjobs auf dem Server einzurichten.

Dies ist dank des Cronjob Frameworks von Contao sehr einfach zu erreichen. Alles, was dazu benötigt wird, ist ein
einziger minütlicher Cronjob, der das Framework initialisiert. Contao kümmert sich anschliessend automatisch darum, 
alle registrierten Cronjobs der Erweiterungen in den korrekten Intervallen auszuführen.

Wir erreichen also einen grossen Vorteil mit einem verhältnismässig geringen Aufwand.

Der Cronjob dafür muss wie folgt aussehen:

```
* * * * * <php-binary> <contao-verzeichnis>/vendor/bin/contao-console contao:cron
```

Ersetze dabei `<php-binary>` mit dem Pfad zum PHP CLI-Binary deiner aktuell eingesetzten Version. Ein komplettes
Beispiel könnte so aussehen:

```
* * * * * /opt/plesk/php/8.2/bin/php /var/www/vhosts/my.host.com/vendor/bin/contao-console contao:cron
```

{{% notice tip %}}
Zusätzliche Informationen findest du in [der englischen Entwickler-Dokumentation](https://docs.contao.org/dev/framework/cron/).
for more details.
