---
title: "Installierbares Theme erstellen"
description: "Ein installierbares Theme für den Contao Manager erstellen."
aliases:
  - /de/anleitungen/manager-theme/
weight: 100
tags: 
  - "Theme"
---


Bei der Installation über den [Contao Manager](/de/installation/contao-manager/) kannst du optional ein verfügbares Theme angeben.
Wir zeigen dir hier, wie dieses Theme erstellt werden kann. Das ist nicht allein für Theme Anbieter interessant. Du kannst dabei 
grundsätzlich deine eigene Seitenstruktur, inkl. Erweiterungen und Layout, bei der [Neuinstallation](/de/installation/contao-installieren/) 
über den Manager anlegen lassen.

![Contao per Contao Manager installieren]({{% asset "images/manual/guides/de/manager-theme-de.png" %}}?classes=shadow)


## Theme-Manager

Über den »[Theme-Manager](/de/theme-manager/)« im Backend kannst du vorhandene Themes als `.cto` Datei 
[exportieren und importieren](/de/theme-manager/themes-verwalten/). Diese exportierte `.cto` ist so aber nicht für die Nutzung im Contao Manager
geeignet! Es erfordert hierzu weiterer Angaben. 


## Theme Struktur für den Manager

Neben den eigentlichen »`assets`« benötigt ein Theme für den Contao Manager eine »`theme.xml`« Datei, die jeweilige »`composer.json`« und einen
»`SQL-Dump`«. Diese Daten können als »`.zip`« Archiv zusammengefasst und dann im Contao Manager genutzt werden. Als Orientierung des Aufbaus 
ist das »`.zip`« [Archiv](https://github.com/contao/contao-demo/tags) der »Contao Demo« hilfreich.

```bash
>files
>templates
>var/backups
composer.json
theme.xml
```


### Assets und die »theme.xml«

Diese Daten deiner bestehenden Installation ehälst du über den »[Theme-Manager](/de/theme-manager/)« im Backend. Die exportierte
»`.cto`« Datei ist eigentlich ein »`.zip`« Archiv. Daher kannst du die Datei entsprechend umbenennen und entpacken. Im Anschluß
findest du hier die Verzeichnisse »files«, »templates« und die Datei »theme.xml«.


### SQL-Dump

Den aktuellen SQL-Dump deiner Theme Installation kannst du z. B. über den [Backup Befehl](/de/cli/datenbank-backups/) auf der Konsole erstellen. 
Das Verzeichnis »var/backups« mit deinem aktuellen SQL-Dump kopierst du anschließend in das obige, entpackte Verzeichnis.

```bash
php vendor/bin/contao-console contao:backup:create
```

{{% notice tip %}}
Über die [Konfigurationsmöglichkeiten](/de/cli/datenbank-backups/#konfigurationsmoeglichkeiten) kannst du hierbei auch versch. 
Datenbanktabellen wie z. B. »tl_log« ausschließen.
{{% /notice %}}


### Die »composer.json«

Abschließend kopierst du die aktuelle »composer.json« deiner Theme Installation ebenfalls in das entpackte Verzeichnis. Wenn du möchstest,
könntest du diese noch um optionale Angaben erweitern (s. a.: [Contao Demo](https://github.com/contao/contao-demo/blob/5.3.x/composer.json)).


## Dein Theme

Dein Theme Verzeichnis beinhaltet nun alle notwendigen Angaben. Du kannst das Verzeichnis jetzt als »`.zip`« Datei archivieren und 
bei einer Neuinstallation über den Contao Manager nutzen.

{{% notice tip %}}
Weitere Dateien wie z. B. eine »README.md« oder Lizenzangaben kannst du ohne weiteres hinzufügen.
{{% /notice %}}
