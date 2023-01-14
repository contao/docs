---
title: "Die Docker Devilbox"
menuTitle : "Mit der Docker Devilbox"
description: "Mit der Docker Devilbox können eine oder mehrere Contao-Installationen lokal installiert und gepflegt werden."
url: "anleitungen/lokale-installation/devilbox"
aliases:
    - /de/anleitungen/lokale-installation/devilbox/
weight: 10
tags: 
   - "Installation"
---

Das [Devilbox Project](http://devilbox.org/) ist ein fertiges LAMP Stack für [Docker](https://www.docker.com/). 
Wenn du die Docker-Toolbox einsetzt, sind [diese Angaben](https://devilbox.readthedocs.io/en/latest/howto/docker-toolbox/docker-toolbox-and-the-devilbox.html#howto-docker-toolbox-and-the-devilbox "Docker Toolbox and the Devilbox") der Dokumentation lesenswert.

{{% notice note %}}
Um die Devilbox nutzen zu können muss _Docker_ und _Docker Compose_ auf deinem System installiert sein. Falls das noch
nicht der Fall ist, kannst du dir die 
[Devilbox Prerequisites Dokumentation](https://devilbox.readthedocs.io/en/latest/getting-started/prerequisites.html) für 
mehr Informationen zur Installation dieser Programme durchlesen.
{{% /notice %}}


## Devilbox installieren und konfigurieren

Es ist keine Installation im eigentlichen Sinne notwendig. Du musst dir nur die Dateien von der 
Devilbox [GitHub Seite](https://github.com/cytopia/devilbox) in ein leeres Verzeichnis herunterladen. Die Konfiguration 
erfolgt über eine einzelne Datei. In deinem Verzeichnis findest du die Datei `env-example`. Kopiere diese und benenne 
die Datei anschließend um in `.env`. In der neuen Datei kannst du jetzt deine Konfigurationen vornehmen. Notwendig sind Änderungen der folgende Einträge:

* [NEW_UID](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#new-uid)
* [NEW_GID](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#new-gid)
* [HTTPD_DOCROOT_DIR](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#httpd-docroot-dir)
* [HTTPD_SERVER](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#httpd-server)
* [PHP_SERVER](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#php-server)
* [MYSQL_SERVER](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#mysql-server)

Die einzelnen Schritte (gerade auch für die Einträge `NEW_UID` und `NEW_GID`) sind in der [Devilbox Dokumentation](https://devilbox.readthedocs.io/en/latest/getting-started/install-the-devilbox.html#set-uid-and-gid) gut beschrieben. Für Contao selbst sollten die weiteren Einträge etwa so gesetzt werden:

- `HTTPD_DOCROOT_DIR=DOCUMENT-ROOT` (DOCUMENT-ROOT = `web` bzw. `public`, siehe auch [Hosting-Konfiguration](https://docs.contao.org/manual/de/installation/systemvoraussetzungen/#hosting-konfiguration))
- `HTTPD_SERVER=apache-2.4`
- `PHP_SERVER=7.3`
- `MYSQL_SERVER=mariadb-10.3`

{{% notice note %}}
Nach jeder Änderung der Konfiguration über die `.env` Datei muss die Devilbox neu gestartet werden.
{{% /notice %}}

{{% notice warning %}}
**Lösche keine Einträge in der .env Datei!** Zum Beispiel ist standardmäßig der Eintrag `HTTPD_SERVER=nginx-stable` 
gesetzt und `#HTTPD_SERVER=apache-2.4` ist auskommentiert (s. **`#`** am Anfang der Zeile). Zur Änderung derartiger 
Einträge musst du diese kommentieren bzw. auskommentieren. Ändere unbedingt auf `HTTPD_SERVER=apache-2.4`. Als Webserver 
könnte nginx genutzt werden. Für Contao sind dann allerdings weitere Konfigurationen des Webservers notwendig.
{{% /notice %}}


## Die Devilbox starten

Wechsle nun in das Verzeichnis und starte die Devilbox mit Docker.

```bash
docker-compose up httpd php mysql
```

Erstmalig kann es etwas dauern, da zunächst die jeweiligen Docker Images geladen und die Container erstellt werden müssen. Ausserdem wird empfohlen, den ersten Start im vordergrund auszuführen, damit etwaige Fehler besser sichtbar werden.

Erneute Starts sind dann wesentlich schneller und können im Hintergrund (Option `-d`) ausgeführt werden .

```bash
docker-compose up -d httpd php mysql
```

## Die Devilbox beenden 

Die Devilbox sollte durch den Stop aller Container und anschliessendem Löschen aller Container beendet werden.

```bash
docker-compose stop
docker-compose rm -f
```


## Das Devilbox Dashboard im Browser

Ist die Devilbox gestartet, kannst du nun deinen Browser aufrufen. Mit Eingabe von **`http://127.0.0.1`** erreichst du 
das Devilbox Dashboard. Über die Navigation erhältst du Zugriff auf die verschiedenen Funktionen.

{{% notice note %}}
Die zu verwendende IP-Adresse ist abhängig von deiner Docker-Umgebung. Wenn du die Docker-Toolbox installiert hast, lautet 
deine IP-Adresse möglicherweise anders. Die IP-Adresse kann über den Befehl `docker-machine ip` ermittelt werden.
{{% /notice %}}

| Navigation          | Beschreibung                               |
|:--------------------|:-------------------------------------------|
| **Home**            | Status-Informationen                       |
| **Virtual Hosts**   | Liste vorhandender vhosts bzw. Webseiten   |
| **C&C**             | Command and Control                        |
| **Emails**          | E-Mail Catch Service                       |
| **Configs**         | Eigene PHP und HTTPD Konfiguration         |
| **Databases**       | Infos zu den Datenbanken                   |
| **Info**            | Weitere Informationen                      |
| **Tools**           | Zugriff auf Tools wie z. B. `phpMyAdmin`   |


## Contao-Installation vorbereiten (Step 1)

### php Konfiguration

Erstelle in `cfg\php-ini-x.y` (für jede php-Version `x.y` die du benutzst) eine Datei mit der Endung `.ini`, also z.B. `cfg\php-ini-8.1\contao.ini`, und trage hier alle [im Contao Handbuch empfohlenen Einstellungen](https://docs.contao.org/manual/de/installation/systemvoraussetzungen/#php-konfiguration-php-ini) ein. Diese Einstellungen überschreiben die default-Einstellungen. 

Eine oder mehrere Contao-Installationen werden im Devilbox Verzeichnis **`data\www`** erstellt. Je Contao-Installation (Projekt)
musst du hier ein separates Verzeichnis `PROJEKTNAME` anlegen, z.B. `contao4`.


## Top Level Domain konfigurieren

Der spätere vhost hat diese URL

`PROJEKTNAME.TLD-Suffix`

Für das `TLD-Suffix` hast du 3 Optionen:

1. Nutze die Voreinstellung `loc`.
Damit der Virtual Host Name aufgelöst werden kann, musst du für jedes Projekt in `/etc/hosts` einen neuen Eintrag
**`127.0.0.1 PROJEKTNAME.loc`** anlegen. 

2. Nutze die [Auto DNS](https://devilbox.readthedocs.io/en/latest/intermediate/setup-auto-dns.html) Funktionalität.

3. {{< ab devilbox version "3" (Betaversion) >}} (empfohlen:) Verwende das TLD-Suffix `dvl.to` (ändere dazu in der .env das `TLD_SUFFIX`). Hintergrund-Infos dazu findest du in den [Release-Notes](https://github.com/cytopia/devilbox/releases/tag/v3.0.0-beta-0.3). 

Tip
{{% notice tip %}}
Falls bei dir URLs mit dem Suffix `dvl.to`nicht aufgelöst werden können, dann kann das an den DNS Server Einstellungen in deinem Netzwerk liegen. Diese kannst du in deinem Router ändern auf z.B. die DNS Server von Cloudfare:

--- Hier screenshot Fritz!Box einfügen ---

Daneben kann es erforderlich sein, auch die Netzwerkeinstellungen auf deinem Gerät anzupassen. Für Linux siehe dazu z.B. [hier](https://github.com/cytopia/devilbox/issues/948#issuecomment-1374912138).

{{% /notice %}}

Dein Vhost hat dann also z.B. die URL `contao4.loc`.


## Contao-Installation vorbereiten (Step 2)

Wechsle in das Projektverzeichnis und erstelle einen neuen Unterordner `web` bzw. `public`. Kopiere in diesen Ordner die Contao Manager `.phar` Datei und benenne die Datei um in `contao-manager.phar.php`. 


## Installation über den Contao Manager

Starte `phpMyAdmin` im Devilbox Dashboard im Bereich `Tools\phpMyAdmin` und lege eine neue Datenbank an. Wechsle dann 
in der Navigation auf die Seite `Virtual Hosts`. Hier solltest du nun eine Liste deiner vorhandenen Web-Projekte sehen 
und auch gleich aufrufen können. Du kannst jetzt die Contao-Installation über den Contao Manager einleiten. In unserem 
Beispiel also über: `contao4.loc/contao-manager.phar.php`. 

Die weitere Vorgehensweise ist dann identisch wie in [Contao installieren](../../../installation/contao-installieren/) beschrieben.


## Installation über die Kommandozeile

Im Devilbox Hauptverzeichnis liegen die Dateien `shell.sh` bzw. `shell.bat`. 
Damit kannst du dich in den laufenden Devilbox PHP Container (die `Devilbox-shell`) einklinken. Hier sind bereits [zahlreiche Tools](https://devilbox.readthedocs.io/en/latest/readings/available-tools.html) vorinstalliert. Auch `Composer`. Nach Aufruf befindest du dich im Container im Verzeichnis `shared\http`. Zur Installation von z. B. Contao 4.8 in ein Verzeichnis `contao4` musst du lediglich eingeben:

```bash
composer create-project contao/managed-edition contao4 4.8
```

Lege dir eine neue Datenbank an:

```bash
mysql -u root -h mysql -p -e 'CREATE DATABASE db_contao4;'
```

{{% notice tip %}}
Halte die Devilbox-Shell in einem separaten Ternminalfenster während deiner Arbeit offen. Contao-Kommandos, z.B. ein

```bash
vendor/bin/contao-console cache:warmup --env=dev -v
```

geben in der Devilbox-Shell u.U. mehr Informationen preis als wenn sie unter dem Host ausgeführt werden.  
{{% /notice %}} 


## Angaben im Contao-Installtool

Die Angaben im [Contao-Installtool](/de/installation/contao-installtool/) sind grundsätzlich identisch. Du musst lediglich 
bei `Datenbankverbindung` auf folgende Einträge achten:

| Eintrag             | Wert                  |
|:--------------------|:----------------------|
| **Host**            | mysql                 |
| **Benutzername**    | root                  |
| **Passwort**        | Keinen Wert eintragen |

{{% notice note %}}
Der Benutzer `root` mit leerem Passwort ist die Devilbox Standard Einstellung. Dies kann über 
die [Konfiguration](https://devilbox.readthedocs.io/en/latest/support/faq.html#can-i-change-the-mysql-root-password) geändert werden. 
In diesem Fall musst du im Contao-Installtool deine Werte entsprechend eintragen.
{{% /notice %}}
