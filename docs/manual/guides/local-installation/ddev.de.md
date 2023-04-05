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

{{% notice note %}}
DDEV empfiehlt unter macOS, Mutagen zu aktivieren, um die beste Leistung zu erzielen.

```shell
ddev config global --mutagen-enabled
```
{{% /notice %}}


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
ddev config
```

DDEV-Einstellungen vornehmen, als __Project Type__ auf jeden fall `php` auswählen. Die __Docroot Location__ erstmal leer lassen, da es bei Neuinstallationen noch keinen `public` Ordner gibt und DDEV dann nicht starten kann.

```shell
ddev start
```

Zur Installation via Konsole ist es am einfachsten, sich via SSH mit dem Container zu verbinden.

```shell
ddev ssh
```

```shell
composer create-project contao/managed-edition contao 4.13
```

In der `.ddev/config.yml` nun das Docroot anpassen und ddev neu starten.

```yml
docroot: "contao/public"
```

Um Apache anstatt NGINX zu verwenden, den Eintrag `webserver_type: nginx-fpm` in `apache-fpm` ändern.

```yml
webserver_type: apache-fpm
```

Die `ddev` Binary steht im Container nicht zur Verfügung, also erst mit `exit` auf die Host-Konsole wechseln.

```shell
ddev restart
```

Eine Datenbank gibt es schon in DDEV. Die Verbindungsdaten für die Installation lauten:

| Eintrag             | Wert                  |
|:--------------------|:----------------------|
| **Host**            | db                 |
| **Benutzername**    | db                  |
| **Passwort**        | db |
| **Datenbank**       | db |

Auf die Datenbank des aktuellen Projektes kann über das bereits integrierte phpMyAdmin zugegriffen werden. Mit folgenden Befehl öffnet sich nach Eingabe automatisch ein Browsertab:

```shell
ddev launch -p
```

{{% notice note %}}
Mit `ddev describe` erhältst du eine Übersicht über Services, die im Projekt zur Verfügung stehen und wie du sie erreichst. Mit `ddev poweroff` kannst du aus jedem Verzeichnis heraus alle gestarteten Projekte/Container stoppen.

{{% /notice %}}


## DDEV Addons

DDEV bietet nun auch [Services als Addon](https://ddev.readthedocs.io/en/latest/users/extend/additional-services/).


### Beispiel: Adminer

```shell
ddev get ddev/ddev-adminer && ddev restart
```

Zudem kann man phpMyAdmin in der `.ddev/config.yml` auch deaktivieren:

```yml
omit_containers: [dba]
```

```shell
ddev restart
```


