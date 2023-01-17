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
- `PHP_SERVER=8.2`
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

Wechsle nun in das Verzeichnis und starte die Devilbox mit Docker:

```bash
docker-compose up httpd php mysql
```

Erstmalig kann es etwas dauern, da zunächst die jeweiligen Docker Images geladen und die Container erstellt werden müssen. Ausserdem wird empfohlen, den ersten Start im Vordergrund auszuführen, damit etwaige Fehler besser sichtbar werden.

Erneute Starts sind dann wesentlich schneller und können im Hintergrund (Option `-d`) ausgeführt werden:

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


## Contao-Installation vorbereiten

Eine oder mehrere Contao-Installationen werden im Devilbox Verzeichnis **`data/www`** erstellt. Je Contao-Installation 
musst du hier ein separates Verzeichnis anlegen. Der Verzeichnisname entspricht dann dem späteren vhost Namen. Aus dem 
Verzeichnisnamen `contao4` resultiert dann `contao4.loc`.

Damit der Virtual Host Name aufgelöst werden kann, musst du noch in `/etc/hosts` den Eintrag
**`127.0.0.1 localhost`** in **`127.0.0.1 contao4.loc`** abändern. 

Du hast ein Verzeichnis (z. B. `contao4`) erstellt. Wechsle in dieses Verzeichnis und erstelle einen neuen Unterordner `web` bzw. `public`.
Kopiere in diesen Ordner die Contao Manager `.phar` Datei und benenne die Datei um in `contao-manager.phar.php`. 

{{% notice note %}}
Die Domain-Suffix `.loc` ist voreingestellt. Dies kann aber in der `.env` Datei über den Eintrag `TLD_SUFFIX` geändert werden.
Die manuelle Bearbeitung der »`/etc/hosts`« kann u. U. vernachlässigt werden. Die »Devilbox« bietet hierzu eine 
»[Auto DNS](https://devilbox.readthedocs.io/en/latest/intermediate/setup-auto-dns.html) Funktionalität an.
{{% /notice %}}

{{< Ab devilbox version "3" >}}
kannst du auch das TLD-Suffix `dvl.to` verwenden.
Damit werden automatisch alle *.dvl.to auf 127.0.0.1 geleitet.


## Installation über den Contao Manager

Starte `phpMyAdmin` im Devilbox Dashboard im Bereich `Tools/phpMyAdmin` und lege eine neue Datenbank an. Wechsle dann 
in der Navigation auf die Seite `Virtual Hosts`. Hier solltest du nun eine Liste deiner vorhandenen Web-Projekte sehen 
und auch gleich aufrufen können. Du kannst jetzt die Contao-Installation über den Contao Manager einleiten. In unserem 
Beispiel also über: `contao4.loc/contao-manager.phar.php`. 

Die weitere Vorgehensweise ist dann identisch wie in [Contao installieren](../../../installation/contao-installieren/) beschrieben.


## Installation über die Kommandozeile

Das PHP Memory Limit für die PHP Container der Devilbox ist standardmäßig zu niedrig und muss daher zur Composer Nutzung 
zuvor konfiguriert werden. Wechsle dazu in das Verzeichnis `cfg`. Hast du die Devilbox mit PHP 8.2 in der `.env` konfiguriert, 
mache die folgenden Änderungen dann entsprechend im Verzeichnis `cfg/php-ini-8.2`. Erstelle hier eine Datei `memory_limit.ini` mit folgendem Eintrag:

```bash
[PHP]
memory_limit = -1
```

Im Anschluss musst du die Devilbox neu starten. Im Devilbox Hauptverzeichnis liegen die Dateien `shell.sh` bzw. `shell.bat`. 
Damit kannst du dich in den laufenden Devilbox PHP Container (die `Devilbox-shell`) einklinken. Hier sind bereits [zahlreiche Tools](https://devilbox.readthedocs.io/en/latest/readings/available-tools.html) vorinstalliert. Auch `Composer`. Nach Aufruf befindest du dich im Container im
Verzeichnis `shared/http`. Zur Installation von z. B. Contao 4.13 in ein Verzeichnis `contao4` musst du lediglich eingeben:

```bash
composer create-project contao/managed-edition contao4 4.13
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
{{% /notice %}}
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


## Nützliche Informationen: Mehrere php Versionen parallel betreiben {{< ab devilbox version "3" >}} 

Die Grundeinstellung nimmst du im devilbox Verzeichnis vor.
Im Verzeichnis `compose` findest du die Datei `docker-compose.override.yml-php-multi.yml`. Kopiere die Datei in das devilbox Hautpverzeichnis und ändere den Dateinamen nach »docker-compose.override.yml«. 

Du hast ein Projekt <project>, das abweichend von der in der .env eingestellten php-Version (in unserem Beispiel 8.2) mit einer anderen php-Version - sagen wir 7.4 - laufen soll?
Lege in diesem Projektverzeichnis ein Verzeichnis `.devilbox` und darin eine Datei `backend.cfg` an mit diesem Inhalt:

```bash
conf:phpfpm:tcp:php74:9000  
```

Starte devilbox wie folgt:

```bash
docker-compose up php httpd bind php74
```

{{% notice note %}}
Ein Beispiel:
<table>
  <tr>
    <th>Projekt</th>
    <th>.env php-Version</th>
    <th>backend.cfg vorhanden?</th>
    <th>bind Option</th>
    <th>Projekt läuft unter<th>
  </tr>
  <tr>
    <td>contao5</td>
    <td>8.2</td>
    <td>Nein</td>
    <td>-</td>
    <td>8.2</td>
  </tr>
  <tr>
    <td>contao4</td>
    <td>8.2</td>
    <td>Ja</td>
    <td>php74</td>
    <td>7.4</td>
  </tr>
</table>

{{% notice tip %}}
Du kannst in jedem Projektverzeichnis prophylaktisch die backend.cfg anlegen und den Inhalt auskommentieren, wenn das Projekt nicht gesondert behandelt werden soll. 
{{% /notice %}}

{{% notice tip %}}
Im devilbox Dashboard siehst du unter `Virtual Hosts` in der Spalte `Backend', welche php-Version tatsächlich für ein Projekt im Einsatz ist. (Noch gibt es dort einen kleinen Fehler: Auskommentierte Konfigurationen werden nicht als passiv erkannt.)
{{% /notice %}}


## Nützliche Informationen: PHP Xdebug

Im [Devilbox-Handbuch](https://devilbox.readthedocs.io/en/latest/intermediate/configure-php-xdebug.html?highlight=xdebug#configure-php-xdebug-1) findest du eine nicht ganz aktuelle Dokumentation, die aber das grundsätzliche Vorgehen gut aufzeigt.

Für Vscode funktioniert diese Konfiguration sehr gut:

{{< tabs >}}
{{% tab name="launch.json" %}}
```
{
  //
  "version": "0.2.0",
  "configurations": [
    {
      "name": "Listen for Xdebug",
      "type": "php",
      "request": "launch",
      "port": 9003,
      "pathMappings": {
        "/shared/httpd/": "${workspaceFolder}/projects/"
      },
      "log": true,
      "stopOnEntry": true
    },
    .
    .
    .

  ]
}
```
{{% /tab %}}
{{% tab name="xdebug.ini" %}}
Erstelle eine xdebug.ini im jeweiligen Verzeichnis devilbox/cfg/php-ini-x.y mit diesem Inhalt
```
; PHP.ini configuration
;  
[PHP]
; Defaults
xdebug.mode                 = debug
xdebug.remote_handler       = dbgp
xdebug.start_with_request   = yes

; How to connect
xdebug.client_port          = 9003
xdebug.client_host          = host.docker.internal
xdebug.discover_client_host = false

; Logging
xdebug.log                  = /shared/httpd/xdebug.log
xdebug.log_level            = 7

; IDE Configuration
xdebug.idekey               = VSCODE
```
{{% /tab %}}
{{< /tabs >}}
