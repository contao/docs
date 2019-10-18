---
title: "Die Docker Devilbox"
menuTitle : "Mit der Docker Devilbox"
description: "Mit der Docker Devilbox können eine oder mehrere Contao Installation lokal installiert und gepflegt werden."
weight: 100
---

Das [Devilbox Project](http://devilbox.org/) ist ein fertiges LAMP Stack für [Docker](https://www.docker.com/). 
Wenn Du die Docker-Toolbox einsetzt sind [diese Angaben](https://devilbox.readthedocs.io/en/latest/howto/docker-toolbox/docker-toolbox-and-the-devilbox.html#howto-docker-toolbox-and-the-devilbox "Docker Toolbox and the Devilbox") der Dokumentation lesenswert.


## Devilbox installieren und konfigurieren

Es ist keine Installation im eigentlichen Sinne notwendig. Du mußt Dir nur die Dateien von der 
Devilbox [GitHub Seite](https://github.com/cytopia/devilbox) in ein leeres Verzeichnis herunterladen. Die Konfiguration 
erfolgt über eine einzelne Datei. In Deinem Verzeichnis findest Du die Datei `env-example`. Kopiere diese und benenne 
die Datei anschließend um in `.env`. In der neuen Datei kannst Du jetzt Deine Konfigurationen vornehmen. Notwendig sind Änderungen der folgende Einträge:

* [NEW_UID](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#new-uid)
* [NEW_GID](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#new-gid)
* [HTTPD_DOCROOT](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#httpd-docroot-dir)
* [HTTPD_SERVER](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#httpd-server)
* [PHP_SERVER](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#php-server)
* [MYSQL_SERVER](https://devilbox.readthedocs.io/en/latest/configuration-files/env-file.html#mysql-server)

Die einzelnen Schritte ( gerade auch für die Einträge `NEW_UID` und `NEW_GID` ) sind in der [Devilbox Dokuemtation](https://devilbox.readthedocs.io/en/latest/getting-started/install-the-devilbox.html#set-uid-and-gid) gut beschrieben. Für Contao selbst sollten die weiteren Einträge etwa so gesetzt werden:

- `HTTPD_DOCROOT_DIR=web`
- `HTTPD_SERVER=apache-2.4`
- `PHP_SERVER=7.3`
- `MYSQL_SERVER=mariadb-10.3`

{{% notice note %}}
Nach jeder Änderung der Konfiguration über die `.env` Datei muß die Devilbox neu gestartet werden.
{{% /notice %}}

{{% notice warning %}}
**Lösche keine Einträge in der .env Datei!** Zum Beispiel ist standardmäßig der Eintrag `HTTPD_SERVER=nginx-stable` 
gesetzt und `#HTTPD_SERVER=apache-2.4` ist auskommentiert ( s. **`#`** am Anfang der Zeile ). Zur Änderung derartiger 
Einträge mußt Du diese kommentieren bzw auskommentieren. Ändere unbedingt auf `HTTPD_SERVER=apache-2.4`. Als Webserver 
könnte nginx genutzt werden. Für Contao sind dann allerdings weitere Konfigurationen des Webservers notwendig.
{{% /notice %}}


## Die Devilbox starten

Wechsle nun in das Verzeichnis und starte die Devilbox mit Docker. Erstmalig kann es etwas dauern, da zunächst die 
jeweiligen Docker Images geladen und die Container erstellt werden müssen. Erneute Starts sind dann wesentlich schneller.


```bash
docker-compose up -d httpd php mysql
```


## Die Devilbox beenden

```bash
docker-compose stop
```


## Das Devilbox Dashboard im Browser

Ist die Devilbox gestartet kannst Du nun Deinen Browser aufrufen. Mit Eingabe von **`http://127.0.0.1`** erreichst Du 
das Devilbox Dashboard. Über die Navigation erhälst Du Zugriff auf die verschiedenen Funktionen.

{{% notice note %}}
Die zu verwendene IP-Adresse ist abhängig von Deiner Docker Umgebung. Wenn Du die Docker-Toolbox installiert hast lautet 
Deine IP-Adresse möglicherweise anders. Die IP-Adresse kann über den Befehl `docker-machine ip` ermittelt werden.
{{% /notice %}}

| Navigation          | Beschreibung                               |
|:--------------------|:-------------------------------------------|
| **Home**            | Status Informationen                       |
| **Virtual Hosts**   | Liste vorhandender vhosts bzw. Webseiten   |
| **Emails**          | E-Mail Catch Service                       |
| **Databases**       | Infos zu den Datenbanken                   |
| **Info**            | Weitere Informationen                      |
| **Tools**           | Zugriff auf Tools wie z.B. `phpMyAdmin`    |


## Contao Installation vorbereiten

Eine oder mehrere Contao Installationen werden im Devilbox Verzeichnis **`data\www`** erstellt. Je Contao Installation 
mußt Du hier ein separates Verzeichnis anlegen. Der Verzeichnisname entspricht dann dem späteren vhost Namen. Aus dem 
Verzeichnisnamen `contao4` resultiert dann `contao4.loc`.

Du hast ein Verzeichnis ( z.B. `contao4` ) erstellt. Wechsle in dieses Verzeichnis und erstelle einen neuen 
Unterordner `web`. Kopiere in diesen Ordner die Contao Manager .phar Datei und benenne die Datei um in `contao-manager.phar.php`. 

{{% notice note %}}
Die Domain Suffix `.loc` ist voreingestellt. Dies kann aber in der `.env` Datei über den Eintrag `TLD_SUFFIX` geändert werden.
{{% /notice %}}


## Installation über den Contao Manager

Starte `phpMyAdmin` im Devilbox Dashboard im Bereich `Tools\phpMyAdmin` und lege eine neue Datenbank an. Wechsle dann 
in der Navigation auf die Seite `Virtual Hosts`. Hier solltest Du nun eine Liste Deiner vorhandenen Web-Projekte sehen 
und auch gleich aufrufen können. Du kannst jetzt die Contao Installation über den Contao Manager einleiten. In unserem 
Beispiel also über: `contao4.loc/contao-manager.phar.php`. 

Die weitere Vorhehensweise ist dann identisch wie in [Contao installieren](../../contao-installieren/) beschrieben.


## Installation über die Kommandozeile

Das PHP Memory Limit für die PHP Container der Devilbox ist standardmäßig zu niedrig und muß daher zur Composer Nutzung 
zuvor konfiguriert werden. Wechsle dazu in das Verzeichnis `cfg`. Hast Du die Devilbox mit PHP 7.3 in der `.env` konfiguriert 
mache die folgenden Änderungen dann entsprechend im Verzeichnis `cfg\php-ini-7-3`. Erstelle hier eine Datei `memory_limit.ini` mit folgenden Eintrag:

```bash
[PHP]
memory_limit = -1
```

Im Anschluß mußt Du die Devilbox neu starten. Im Devilbox Hauptverzeichnis liegen die Dateien `shell.sh` bzw. `shell.bat`. 
Damit kannst Du Dich in den laufenden Devilbox PHP Container einklinken. Hier sind bereits [zahlreiche Tools](https://devilbox.readthedocs.io/en/latest/readings/available-tools.html) vorinstalliert. Auch `Composer`. Nach Aufruf befindest Du Dich im Container im 
Verzeichnis `shared\http`. Zur Installation von z.B. Contao 4.8 in ein Verzeichnis `contao48` mußt Du lediglich eingeben:

```bash
composer create-project contao/managed-edition contao48 4.8
```

Lege Dir eine neue Datenbank an:

```bash
mysql -u root -h mysql -p -e 'CREATE DATABASE db_contao48;'
```

Im Anschluß kannst Du den Container über `exit` verlassen und das Contao-Installtool aufrufen.


## Angaben im Contao-Installtool

Die Angaben im [Contao-Installtool](../../contao-installtool/) sind grundsätzlich identisch. Du mußt lediglich 
bei `Datenbankverbindung` auf folgende Einträge achten:

| Eintrag             | Wert                  |
|:--------------------|:----------------------|
| **Host**            | mysql                 |
| **Benutzername**    | root                  |
| **Passwort**        | Keinen Wert eintragen |

{{% notice note %}}
Der Benutzer `root` mit leeren Passwort ist die Devilbox Standard Einstellung. Dies kann über 
die [Konfiguration](https://devilbox.readthedocs.io/en/latest/support/faq.html#can-i-change-the-mysql-root-password) geändert werden. 
In diesem Fall mußt Du im Contao-Installtool Deine Werte entsprechend eintragen.
{{% /notice %}}
