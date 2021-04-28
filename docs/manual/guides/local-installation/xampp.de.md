---
title: "XAMPP"
menuTitle : "Mit XAMPP"
description: "Lokale Contao Installation mit XAMPP"
weight: 30
aliases:
    - /de/anleitungen/lokale-installation/xampp/
tags: 
   - "Installation"
---


In diesem Tutorial wird die lokale Contao Nutzung mit [XAMPP](https://www.apachefriends.org/) für Windows beschrieben. 
Wir verwenden hierbei eine »XAMPP Portable Version«, die lediglich kopiert werden muß. Du wählst hierzu das 
passende [Windows .zip Archiv](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.16/), 
z. B. [xampp-portable-windows-x64-7.4.16-0-VC15.zip](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.16/xampp-portable-windows-x64-7.4.16-0-VC15.zip/download), aus. 

Anschließend entpackst du das Archiv nach z. B. `D:\xampp` und startest einmalig die Datei `setup_xampp.bat`. Die 
»XAMPP Installation« ist damit abgeschlossen.


## XAMPP starten

Im deinem Verzeichnis findest du die Datei »xampp-control.exe«. Mit einem Rechts-Klick startest du diese mit der
Option »Als Administrator ausführen«. Im »XAMPP Control-Panel« aktivierst du die Module »Apache« und »MySQL«. 

Weiterhin klickst du einmalig auf die Schaltfläche `Shell`. Im Anschluss wird in deinem Verzeichnis die Datei 
»xampp_shell.bat« erstellt und eine entsprechende »XAMPP Konsole« geöffnet. Zwecks Überprüfung gibts du in dieser 
Konsole den Befehl `php -v` ein. Als Ausgabe solltest du die entsprechende PHP (CLI) Version erhalten und kannst
die Konsole dann schliessen. 

In deinem Browser erreichst du über die Eingabe von `http://localhost` das 
»XAMPP Dashboard« mit generellen Informationen. Hier findest du im oberen Menü u. a. einen Link `PHPInfo` mit 
Informationen zur aktuellen PHP-Konfiguration.

{{% notice info %}}
Du solltest das »XAMPP Control-Panel« (xampp-control.exe) und die »XAMPP Konsole« (xampp_shell.bat) immer mit 
Administrator Rechten starten.
{{% /notice %}}


## Die PHP-Konfiguration

Entsprechend den [Contao Systemvoraussetzungen](/de/installation/systemvoraussetzungen/) müssen wir die 
PHP-Konfiguration einmalig anpassen. Hierzu stoppst du zunächst im »XAMPP Control-Panel« die Module »Apache« und »MySQL«.

In der Datei `D:\xampp\apache\php.ini` suchst du die Zeilen »memory_limit« und »extension=intl« und änderst diese wie folgt:

| Eintrag                 | Änderung                   |
|:------------------------|:---------------------------|
| **memory_limit = 512M** | **memory_limit = -1**      |
| **;extension=intl**     | **extension=intl**         |

{{% notice tip %}}
Die genannten Änderungen sind für die Installation über den [PHP-Composer](https://getcomposer.org/) oder über den 
[Contao-Manager](/de/installation/contao-manager/) zwingend notwendig. 
Darüber hinaus könntest du optional auch die Einträge »allow_url_fopen«, »max_execution_time« 
oder »file_uploads« überprüfen und anpassen.
{{% /notice %}}

**Herzlichen Glückwunsch!** 
Du hast alle Vorbereitungen für eine lokale Installation von Contao abgeschlossen.


## Lokale PHP-Composer Installation

Wir haben keine »XAMPP» Installation unter Windows im eigentlichen Sinne durchgeführt. Daher werden wir die benötigte 
PHP-Composer-Datei ebenfalls lediglich kopieren. 

Starte über das »XAMPP Control-Panel« mit Administrator-Berechtigung die 
Module »Apache« und »MySQL«. Öffne ebenfalls die »XAMPP-Konsole« (xampp_shell.bat) mit Administrator-Berechtigung und 
wechsle in dein aktuelles XAMPP-Verzeichnis. 

Im Anschluss führst du [folgende Angaben](https://getcomposer.org/download/) schrittweise aus:

```php
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

In deinem XAMPP-Verzeichnis befindet sich nun die Datei `composer.phar`. Mit Eingabe von `php composer.phar -V` solltest 
du eine entsprechende Rückmeldung erhalten.


### Contao mit PHP-Composer installieren

Ohne weitere vHost-Konfiguration (s. u.) erwartet XAMPP die Dateien deiner Webseite im XAMPP-Verzeichnis `htdocs`. 
In der »XAMPP-Konsole« wechselst du daher in dieses Unterverzeichnis und installierst eine Contao-Version 
mit Eingabe von z. B.:

```php
php ../composer.phar create-project contao/managed-edition demo 4.9
```

Deine Contao-Installation befindet sich im Anschluss im XAMPP-Verzeichnis `htdocs\demo`.

{{% notice note %}}
Optional könntest du die Installation von Contao auch direkt über den Contao-Manager ausführen.
Erstelle dir hierzu besipielsweise im XAMPP-Verzeichnis `htdocs` die Verzeichnisse `demo\web`. Kopiere den 
[Contao-Manager](https://contao.org/de/download.html) in das Verzeichnis `demo\web` und benenne die Datei danach 
in »contao-manager.phar.php« um.
{{% /notice %}}


## Contao Aufrufe (ohne eigenen vHost)

Im »XAMPP Control-Panel« kannst du im Bereich »MySql« über die Schaltfläche »Admin« `phpMyAdmin` ausführen und wie 
gewohnt eine Datenbank anlegen. Sofern noch nicht geschehen kopierst du den 
[Contao-Manager](https://contao.org/de/download.html) z. B. in das Verzeichnis `demo\web` und benennst die Datei danach 
in »contao-manager.phar.php« um. 

Deine Installation kann jetzt abgeschlossen werden. Allerdings unterscheiden sich die Contao-Aufrufe, ohne
weitere vHost-Konfiguration (s. u.), von den bekannten Möglichkeiten. Zum aktuellen Zeitpunkt steht dir nur die lokale,
interne Domain `localhost` zur Verfügung und diese zeigt in XAMPP standardmäßig auf das Verzeichnis `htdocs`.

Die Contao Aufrufe für unsere Beispiel Installation im Verzeichnis `htdocs\demo` wären daher:

| Ziel            | Aufruf                                                                                                       |
|:----------------|:-------------------------------------------------------------------------------------------------------------|
| Install-Tool    | http://localhost/demo/web/contao/install                                                                     |
| Contao-Backend  | http://localhost/demo/web/contao                                                                             |
| Contao-Frontend | http://localhost/demo/web                                                                                    |
| Contao-Manager  | http://localhost/demo/web/contao-manager.phar.php/ <br/>**Der Schrägstrich am Ende ist zwingend notwendig!** |

{{% notice warning %}}
Du kannst demnach ohne eigene »XAMPP vHost-Konfiguration« (s. u.) mit Contao arbeiten, solange du die obigen Aufrufe
berücksichtigst. Innerhalb der Contao eigenen Verlinkung (z. B.: Den Contao-Manager über das Backend starten usw.) 
erhälst du weiterhin Fehlermeldungen, da diese von einer »korrekten« Umgebung ausgehen. Empfehlenswert wäre daher die
weitere, einmalige XAMPP-Konfiguration über einen eigenen vHost.
{{% /notice %}}


## Eigene vHost-Konfiguration

Eine einmalige, eigene XAMPP vHost-Konfiguration bietet zahlreiche Vorteile. Einerseits kannst du hierüber deine 
Contao Installation(en) außerhalb des XAMPP-Verzeichnisses pflegen und andererseits diese mit eigenen, lokalen
Domain Namen verknüpfen. 

Erstelle dir ein neues Verzeichnis z. B. `D:\vhost\demo\web`. Kopiere den [Contao-Manager](https://contao.org/de/download.html) 
in dieses Verzeichnis und benenne die Datei danach in »contao-manager.phar.php« um. 

### Domain Namen erstellen

Wir möchten unsere Contao Installation über die Domain `demo.local` erreichen. Im Windows Verzeichnis `System32/drivers/etc`
fügst du hierzu in der Datei `hosts` den Eintrag `127.0.0.1 demo.local` hinzu. Grundsätzlich könntest du nun diese 
Domain nutzen. Allerdings macht es zur bisherigen Vorgehensweise noch keinen Unterschied. Wir müssen XAMPP zur 
Nutzung unseres neuen Verzeichnisses erst konfigurieren.


### Die vHost Konfiguration

Öffne die Datei `\apache\conf\httpd.conf` in deinem XAMPP-Verzeichnis und suche die Zeile 
`#LoadModule vhost_alias_module modules/mod_vhost_alias.so`. Entferne hier den Hashtag `#` und speichere deine Änderung. 
Füge in der Datei `\apache\conf\extra\httpd-vhosts.conf` folgende Angaben hinzu:

```php
<VirtualHost *:80>
  ServerAdmin webmaster@demo.local
  DocumentRoot "D:\vhost\demo\web"
  ServerName demo.local
  ServerAlias www.demo.local
  <Directory D:\vhost\demo>
    Options +FollowSymlinks
    AllowOverride All
    Require all granted
  </Directory>

  ErrorLog "D:\xampp\apache\logs\demo.local_error.log"
  CustomLog "D:\xampp\apache\logs\demo.local_access.log" combined
</VirtualHost>
```

Passe hier nötigenfalls die Pfadangaben deinen aktuellen Verzeichnisse entsprechend an. Im »XAMPP Control-Panel« 
musst du die Module »Apache« und »MySQL« neu starten. Anschließend kannst du den Contao-Manager über den Aufruf
`http://demo.local/contao-manager.phar.php` erreichen.


{{% notice tip %}}
Mit dieser Vorgehensweise könntest du auch mehrere Contao-Installationen über verschiedene, lokale Domain-Namen mit 
separaten vHost-Einträgen pflegen.
{{% /notice %}}


## SSL-Zertifikat erstellen

Über den Aufruf von z. B.: `http://demo.local/contao-manager.phar.php` erhälst du im Contao-Manager einen Hinweis 
das es sich um eine »Unsichere Verbindung« handelt. Dies ist korrekt, da XAMPP kein SSL-Zertifikat für unsere Domain
`demo.local` ausliefert bzw. dieses nicht existiert.

Im XAMPP-Verzeichnis `\apache` findest du die Datei »makecert.bat«, über die du dir ein neues, lokales V1-Zertifikat 
erstellen kannst. Starte in der »XAMPP-Konsole» diese Datei und folge den Anweisungen. Deine Angaben sind hier 
grundsätzlich beliebig. Lediglich die Angabe bei `Common Name` muss dem aktuellen, lokalen Domain-Namen entsprechen. 
Für unser Beispiel also zwingend `demo.local`.

In den Dateien `apache\conf\ssl.crt`, `apache\conf\ssl.csr` und `apache\conf\ssl.key` wurden den Angaben 
entsprechend neue Zertifikat Informationen generiert. In der XAMPP vHost-Konfiguration müssen diese Informationen 
hinterlegt werden. Füge dazu in der Datei `\apache\conf\extra\httpd-vhosts.conf` folgende Angaben hinzu:

```php
<VirtualHost *:443>
  ServerAdmin webmaster@demo.local
  DocumentRoot "D:\vhost\demo\web"
  ServerName demo.local
  ServerAlias www.demo.local

  SSLEngine on
  SSLCertificateFile "D:\xampp\apache\conf\ssl.crt\server.crt"
  SSLCertificateKeyFile "D:\xampp\apache\conf\ssl.key\server.key"

  <Directory D:\vhost\demo>
    Options +FollowSymlinks
    AllowOverride All
    Require all granted
  </Directory>

  ErrorLog "D:\xampp\apache\logs\demo.local_error.log"
  CustomLog "D:\xampp\apache\logs\demo.local_access.log" combined
</VirtualHost>
```

Ändere auch hier wieder die Pfade entsprechend deiner aktuellen Umsetzung und starte im »XAMPP Control-Panel« 
die Module »Apache« und »MySQL« erneut. Anschließend kannst du den Contao Manager über `https://demo.local/contao-manager.phar.php`
erreichen.

Dein Browser wird dir einen Warnhinweis ausgeben, da dieser unser lokal erstelltes Zertifikat zwar erkennt aber 
zunächst nicht vertraut. Dies kannst du aber ohne weiteres ignorieren und im Browser die Domain `demo.local` 
als Ausnahme bestätigen.

Im Contao-Manager selbst wird fortan der vorherige Hinweis auf eine »Unsichere Verbindung« nicht mehr erfolgen.
