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


### Beispiel: Die Installation unter macOS mit __brew__ durchführen

```shell
brew install ddev/ddev/ddev
```

Nach der Installation noch die lokalen SSL-Zertifikate installieren (im Anschluss Browser neu starten).

```shell
mkcert -install
```

Seine Installation sollte man auch regelmäßig updaten.

```shell
brew upgrade ddev
```


### Beispiel: Installation unter Debian/Ubuntu

```shell
curl -fsSL https://apt.fury.io/drud/gpg.key | gpg --dearmor | sudo tee /etc/apt/trusted.gpg.d/ddev.gpg > /dev/null

echo "deb [signed-by=/etc/apt/trusted.gpg.d/ddev.gpg] https://apt.fury.io/drud/ * *" | sudo tee /etc/apt/sources.list.d/ddev.list

sudo apt update && sudo apt install -y ddev
```

Evtl. nach der Installation noch die lokalen SSL-Zertifikate installieren (im Anschluss Browser neu starten).

```shell
mkcert -install
```

Installation updaten

```shell
sudo apt update && sudo apt upgrade
```


## Projekt erstellen

Öffne die Konsole deiner Wahl, erstelle das gewünschte Verzeichnis und wechsle danach in ebendieses.

```shell
mkdir -p  ~/Projekte/contao/contao-ddev && cd ~/Projekte/contao/contao-ddev
```

DDEV-Konfiguration anlegen mit:

```shell
ddev config --project-type=php --docroot=public --webserver-type=apache-fpm --php-version=8.2 --create-docroot
```

Contao 5.3 installieren:

```shell
ddev composer create contao/managed-edition:5.3
```

Nach der Installation müssen die Datenbankzugangsdaten in die `.env` eingetragen werden. In diesem Zug richten wir auch direkt Mailpit ein.

```env
APP_ENV=prod
DATABASE_URL="mysql://db:db@db:3306/db"
MAILER_DSN="smtp://localhost:1025?encryption=&auth_mode="
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

`ddev xdebug on` startet Xdedug. [Informationen zum IDE-Setup](https://ddev.readthedocs.io/en/latest/users/debugging-profiling/step-debugging/#ide-setup)

Eine Datenbank gibt es schon in DDEV. Die Verbindungsdaten für die Installation lauten:

| Eintrag             | Wert                  |
|:--------------------|:----------------------|
| **Host**            | db                 |
| **Benutzername**    | db                  |
| **Passwort**        | db |
| **Datenbank**       | db |

## DDEV Addons

DDEV bietet auch [Services als Addon](https://ddev.readthedocs.io/en/latest/users/extend/additional-services/).


### Beispiel: Adminer

```shell
ddev get ddev/ddev-adminer && ddev restart
```

Mit `ddev describe` erfährst du, wie du Adminer erreichst.
