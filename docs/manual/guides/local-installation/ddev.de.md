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

DDEV erstellt eine `config.yaml`, die alle Einstellungen für dein Projekt enthält. Diese kann mit GIT versioniert werden und unterstützt so kollaboratives Arbeiten in Teams oder mit Freelancern.

{{% notice info %}}
Um DDEV nutzen zu können, muss _Docker_ auf deinem System installiert sein. Falls das noch
nicht der Fall ist, kannst du dir die
[DDEV Dokumentation](https://ddev.readthedocs.io/en/stable/users/install/docker-installation/) für
mehr Informationen zur Installation dieser Programme durchlesen.
{{% /notice %}}


## DDEV installieren

DDEV ist für alle Plattformen verfügbar, für die Installation deiner Plattform schau bitte in der [DDEV Dokumentation](https://ddev.readthedocs.io/en/stable/users/install/ddev-installation/) nach.


## Projekt erstellen

{{% notice tip %}}
Die [Contao Demo Webseite](https://demo.contao.org/) wird für die aktuell unterstützten Contao-Versionen gepflegt und kann [optional 
installiert](https://github.com/contao/contao-demo) werden. Über den Contao Manager kannst du dazu, bei einer Erstinstalltion, einfach diese
Option auswählen.
{{% /notice %}}

{{< tabs groupid="ddev-contao-install">}}

{{% tab title="Composer" %}}
Öffne die Konsole deiner Wahl, erstelle das gewünschte Verzeichnis und wechsle danach in ebendieses. Der Verzeichnisname spiegelt den späteren Projekt Hostnamen. Du kannst dies jedoch zusätzlich [konfigurieren](https://ddev.readthedocs.io/en/latest/users/extend/additional-hostnames/).

```shell
mkdir contao && cd contao
```

DDEV-Konfiguration anlegen mit:

```shell
ddev config --project-type=php --docroot=public --webserver-type=apache-fpm --php-version=8.2
```

Contao 5.3 installieren:

```shell
ddev composer create contao/managed-edition:5.3
```

Nach der Installation müssen die Datenbankzugangsdaten in die `.env.local` eingetragen werden. In diesem Zug richten wir auch direkt 
[Mailpit](https://ddev.readthedocs.io/en/stable/users/usage/developer-tools/#email-capture-and-review-mailpit) ein.

```shell
ddev dotenv set .env.local --database-url=mysql://db:db@db:3306/db --mailer-dsn=smtp://localhost:1025
```

Im Anschluss die Datenbank anlegen:

```shell
ddev exec contao-console contao:migrate --no-interaction
```

Backend-User anlegen (Administrator):

```shell
ddev exec contao-console contao:user:create --username=admin --name=Administrator --email=admin@example.com --language=de --password=Password123 --admin
```

Die Contao Administration im Browser aufrufen:

```shell
ddev launch contao
```

{{% /tab %}}

{{% tab title="Contao Manager" %}}

Öffne die Konsole deiner Wahl, erstelle das gewünschte Verzeichnis und wechsle danach in ebendieses. Der Verzeichnisname spiegelt den späteren Projekt Hostnamen. Du kannst dies jedoch zusätzlich [konfigurieren](https://ddev.readthedocs.io/en/latest/users/extend/additional-hostnames/).

```shell
mkdir contao && cd contao
```

DDEV-Konfiguration anlegen mit:

```shell
ddev config --project-type=php --docroot=public --webserver-type=apache-fpm --php-version=8.2
```

Nach der Installation müssen die Datenbankzugangsdaten in die `.env.local` eingetragen werden. In diesem Zug richten wir auch direkt 
[Mailpit](https://ddev.readthedocs.io/en/stable/users/usage/developer-tools/#email-capture-and-review-mailpit) ein.

```shell
ddev dotenv set .env.local --database-url=mysql://db:db@db:3306/db --mailer-dsn=smtp://localhost:1025
```

Den Contao Manager herunterladen, umbenennen (.php) und in das `public` Verzeichnis kopieren. Du kannst dazu auch `wget` oder `curl` nutzen.

```shell
ddev start
ddev exec "wget -O public/contao-manager.phar.php https://download.contao.org/contao-manager/stable/contao-manager.phar"
```

Den Contao Manager aufrufen und den Anweisungen folgen.

```shell
ddev launch contao-manager.phar.php
```

{{% /tab %}}

{{< /tabs >}}


## Zusatz Informationen

Weitere Informationen bez. der Verwaltung von Projekten findest du [hier](https://ddev.readthedocs.io/en/stable/users/usage/managing-projects/#listing-project-information).

- `ddev start` startet das Projekt, `ddev stop` beendet es. Stelle vorher sicher, dass du in den Projektordner gewechselt hast.

- `ddev poweroff` kann aus jedem Verzeichnis heraus alle gestarteten Projekte/Container stoppen.

- Mit `ddev ssh` wechselst du in die Shell des Containers und kannst auf der Konsole arbeiten. Die `ddev` Binary steht im Container nicht zur Verfügung, also erst mit `exit` auf die Host-Konsole wechseln.

- `ddev describe` gibt eine Übersicht der Services, die im Projekt zur Verfügung stehen und wie du sie erreichst.

- `ddev xdebug on` startet XDebug. [Informationen zum IDE-Setup](https://ddev.readthedocs.io/en/latest/users/debugging-profiling/step-debugging/#ide-setup)

{{% notice info %}}
Falls du als Windows Anwender die »Git Bash« als Konsole benutzt, kann es, abhängig von deiner »Git für Windows« Konfiguration, notwendig sein das Kommando `winpty` voran zu stellen (z. B.: `winpty ddev ssh`).
{{% /notice %}}

## Angepasste PHP-Konfiguration

Mit DDEV können zusätzliche PHP-Konfigurationen für ein Projekt bereitgestellt werden. Du kannst eine beliebige Anzahl von `.ini` Dateien im Verzeichnis `.ddev/php/` hinzufügen. Änderungen erfordern einen Neustart mit `ddev restart`. Weitere Informationen in der [DDEV-Dokumentation](https://ddev.readthedocs.io/en/stable/users/extend/customization-extendibility/#custom-php-configuration-phpini).

Eine Beispieldatei in `.ddev/php/my-php.ini` könnte wie folgt aussehen:

```ini
[PHP]
memory_limit = -1
```


## Datenbank Tools

Wenn du beispielsweise einen Datenbank-Client wie `Adminer` oder `phpMyAdmin` verwenden möchtest, kannst du diese als 
[Addon](https://ddev.readthedocs.io/en/latest/users/extend/additional-services/) installieren.


### Beispiel: Adminer

```shell
ddev add-on get ddev/ddev-adminer && ddev restart
```

### Beispiel: phpMyAdmin

```shell
ddev add-on get ddev/ddev-phpmyadmin && ddev restart
```

Mit `ddev describe` erfährst du, wie du das jeweilige Datenbank Tool erreichst.


## DDEV Cronjob einrichten

{{< version-tag "5.5" >}} Die [Backend-Suche](https://docs.contao.org/manual/de/installation/systemvoraussetzungen/backend-suche/) kann durch die Einrichtung des [Contao Cronjob-Frameworks](https://docs.contao.org/manual/de/performance/cronjobs/) aktiviert werden.

Dazu in DDEV zunächst die [Cron-Erweiterung](https://github.com/ddev/ddev-cron) installieren:

```shell
ddev add-on get ddev/ddev-cron
```
{{% notice info %}}
Wenn du bereits länger mit DDEV entwickelt hast, kann es sein, dass du eine Fehlermeldung bei der Ausführung von `ddev add-on get ddev/ddev-cron` erhältst. Die Ursache dafür ist, dass das add-on erst ab der ddev-Version 1.24 unterstützt wird. Du musst also zuerst ddev updaten.
{{% /notice %}}

Erstelle dann die Datei `/.ddev/web-build/contao.cron` mit folgendem Inhalt:

```shell
* * * * * ddev exec vendor/bin/contao-console contao:cron
```
{{% notice info %}} 
Bitte beachte, dass es unter bestimmten Umständen nicht möglich ist, das contao-console-command außerhalb des ddev-containers zu referenzieren. Ein Aufruf von `* * * * * php /var/www/html/vendor/bin/contao-console contao:cron` ist daher nicht möglich. Bitte verwende stattdessen die Kommandos **ddev ssh** oder **ddev exec**, so wie es auch in den ddev Docs empfohlen wird.
{{% /notice %}}

Starte anschließend das DDEV-Projekt/ den Container neu:

```shell
ddev restart
```

Der Contao-Cronjob wird minütlich ausgeführt. Bei der erstmaligen Einrichtung kann es eventuell 1-2 Minuten dauern, bevor die Suchleiste im Backend verfügbar ist.

## Konfigurieren eines lokalen Pfades als ein shared repository für alle deine Bundles innerhalb des ddev containers

Wenn du einen Pfad konfigurieren möchtest, in dem alle deine Test-Bundles für deine lokalen Projekte abgelegt sind, so dass du diesen Pfad auch in deiner **composer.json** verwenden kannst, so ist das wie folgt möglich:

Erstelle eine Datei im Ordner **./ddev** innerhalb deines Projekt-Ordners. Verwende beispielsweise den Dateinamen **docker-compose.bundles.yaml**.

Der Inhalt der Datei kann wie folgt aussehen (passe die Pfade an deine Anforderungen an):
```
services:
  web:
    volumes:
    - /home/$USER/repository:/home/$USER/repository:rw
```

Starte den Container mit ```ddev restart``` neu.

Jetzt kannst du die im angegbenen Ordner abgelegten Bundles wie gewohnt als pfad-repository in deiner **composer.json** verwenden.
```
"repositories": [
  {
    "type": "path",
    "url": "~/repository/my-local-bundle"
  }
],
```

{{% notice info %}}
Wenn der Contao Manager die so konfigurierten repositories nicht finden kann, so hilft es, die Option **Composer Resolver Cloud** im Contao Manager zu deaktivieren.
{{% /notice %}}
