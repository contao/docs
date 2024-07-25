---
title: "DDEV"
menuTitle : "Mit DDEV"
description: "DDEV ist ein Open-Source-Tool, mit dem sich in Minuten lokale PHP-Entwicklungsumgebungen einrichten lassen."
url: "anleitungen/lokale-installation/ddev"
aliases:
    - /de/anleitungen/lokale-installation/ddev/
weight: 10
tags:
   - "Installation"
---

DDEV ist ein Open-Source-Tool, mit dem sich in Minuten lokale PHP-Entwicklungsumgebungen einrichten lassen.

DDEV erstellt eine `config.yml`, die alle Einstellungen für dein Projekt enthält. Diese kann mit GIT versioniert werden und unterstützt so kollaboratives Arbeiten in Teams oder mit Freelancern.

{{% notice note %}}
Um DDEV nutzen zu können, muss _Docker_ auf deinem System installiert sein. Falls das noch
nicht der Fall ist, kannst du dir die
[DDEV Dokumentation](https://ddev.readthedocs.io/en/stable/users/install/docker-installation/) für
mehr Informationen zur Installation dieser Programme durchlesen.
{{% /notice %}}


## DDEV installieren

DDEV ist für alle Plattformen verfügbar, für die Installation deiner Plattform schau bitte in der [DDEV Dokumentation](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/) nach.

## Projekt erstellen

Öffne die Konsole deiner Wahl, erstelle das gewünschte Verzeichnis und wechsle danach in ebendieses. Der Verzeichnisname spiegelt den späteren Projekt Hostnamen. Du kannst dies jedoch zusätzlich [konfigurieren](https://ddev.readthedocs.io/en/latest/users/extend/additional-hostnames/).

```shell
mkdir -p  ~/Projekte/contao/contao-ddev && cd ~/Projekte/contao/contao-ddev
```

DDEV-Konfiguration anlegen mit:

```shell
ddev config --project-type=php --docroot=public --webserver-type=apache-fpm --php-version=8.2 --create-docroot --timezone=Europe/Berlin
```

Contao 5.3 installieren:

```shell
ddev composer create contao/managed-edition:5.3
```

Nach der Installation müssen die Datenbankzugangsdaten in die `.env.local` eingetragen werden. In diesem Zug richten wir auch direkt Mailpit ein.

```env
APP_ENV=prod
DATABASE_URL=mysql://db:db@db:3306/db
MAILER_DSN=smtp://localhost:1025
```

Im Anschluss die Datenbank anlegen:

```shell
ddev exec "bin/console contao:migrate"
```

Backend-User anlegen:

```shell
ddev exec "bin/console contao:user:create"
```

Projekt im Browser aufrufen:

```shell
ddev launch
```

{{% notice note %}}

Mit `ddev launch contao` kommst du direkt zur Administration.

{{% /notice %}}

## Zusatz Informationen

`ddev start` startet das Projekt, `ddev stop` beendet es. Stelle vorher sicher, dass du in den Projektordner gewechselt hast.

`ddev poweroff` kann aus jedem Verzeichnis heraus alle gestarteten Projekte/Container stoppen.

Mit `ddev ssh` wechselst du in die Shell des Containers und kannst auf der Konsole arbeiten. Die `ddev` Binary steht im Container nicht zur Verfügung, also erst mit `exit` auf die Host-Konsole wechseln.

`ddev describe` gibt eine Übersicht der Services, die im Projekt zur Verfügung stehen und wie du sie erreichst.

`ddev xdebug on` startet XDebug. [Informationen zum IDE-Setup](https://ddev.readthedocs.io/en/latest/users/debugging-profiling/step-debugging/#ide-setup)

{{% notice note %}}
Falls du als Windows Anwender die »Git Bash« als Konsole benutzt, kann es, abhängig von deiner »Git für Windows« Konfiguration, notwendig sein das Kommando `winpty` voran zu stellen (z. B.: `winpty ddev ssh`).
{{% /notice %}}

## Custom PHP Configuration

Mit DDEV können zusätzliche PHP-Konfigurationen für ein Projekt bereitgestellt werden. Du kannst eine beliebige Anzahl von `.ini` Dateien im Verzeichnis `.ddev/php/` hinzufügen. Änderungen erfordern einen Neustart mit `ddev restart`. Weitere Informationen in der [DDEV-Dokumentation](https://ddev.readthedocs.io/en/stable/users/extend/customization-extendibility/#custom-php-configuration-phpini).```

Eine Beispieldatei in `.ddev/php/my-php.ini` könnte wie folgt aussehen:

```ìni
[PHP]
memory_limit = -1
```


## DDEV Addons

DDEV bietet auch [Services als Addon](https://ddev.readthedocs.io/en/latest/users/extend/additional-services/).


### Beispiel: Adminer

```shell
ddev get ddev/ddev-adminer && ddev restart
```

Mit `ddev describe` erfährst du, wie du Adminer erreichst.
