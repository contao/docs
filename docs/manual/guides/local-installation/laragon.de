---
title: "Laragon"
menuTitle : "Mit Laragon"
description: "Mit Laragon können eine oder mehrere Contao-Installationen lokal installiert und gepflegt werden."
url: "anleitungen/lokale-installation/laragon"  
aliases:
    - /de/anleitungen/lokale-installation/laragon/
weight: 20
tags: 
   - "Installation"
---

In diesem Tutorial wird die Einrichtung einer lokalen Entwicklungsumgebung exemplarisch am Beispiel von [Laragon](https://laragon.org) beschrieben.  

Mit **Laragon WAMP** wird ein lokaler Software-Stack bestehend aus folgenden Serverkomponenten installiert:

+ Apache Webserver
+ MySQL
+ PHP

Das Installationspaket umfasst auch noch weitere nützliche Tools, auf die an dieser Stelle aber nicht näher eingegangen wird.  
Weitere Informationen zu Laragon (Installation, Features usw.) findet man ebenfalls in der [offiziellen Dokumentation](https://laragon.org/docs/).


## 1. Systemvoraussetzungen

Windows 7, 8, 8.1, 10

{{% notice note %}}
In dieser Anleitung wird die Installation von Laragon unter Windows 10 64 Bit beschrieben.
{{% /notice %}}


## 2. Vorbereitende Maßnahmen

Das Sicherheitskonzept aktueller Contao-Versionen (konkret ab Contao 4.x) sieht vor, dass für den ordnungsgemäßen Betrieb der Webapplikation u. a. auch _symbolische Links_ (sog. _Symlinks_) erstellt werden müssen. Allerdings sind für das Erstellen von Symlinks unter Windows normalerweise Administratorberechtigungen erforderlich. Es ist daher zweckmäßig, dem gewöhnlichen Windows-Benutzer ebenfalls das entsprechende Recht zum Erstellen von Symlinks zu erteilen. Am einfachsten geht das über das kostenlose Tool [Polsedit](https://www.southsoftware.com). Das ZIP-Archiv enthält sowohl eine 32 Bit als auch eine 64 Bit Version von Polsedit und kann ohne Installation direkt ausgeführt werden.

**ToDo: Berechtigung zum Erstellen symbolischer Links in den Gruppenrichtlinien konfigurieren**

+ Polsedit herunterladen: [https://www.southsoftware.com/polsedit.html](https://www.southsoftware.com/polsedit.html)
+ ZIP-Archiv entpacken
+ Für Windows 10 64 Bit: `polseditx64.exe` (64 Bit Version) ausführen
+ Im rechten Fensterbereich nach der Richtlinie »_Create symbolic links_« `(SE_CREATE_SYMBOLIC_LINK_NAME)` suchen:

![Screenshot](/de/guides/images/laragon/01_polsedit.png?width=800px)

+ Per Doppelklick auf den entsprechenden Eintrag das Eigenschaftsfenster der Richtlinie öffnen:

![Screenshot](/de/guides/images/laragon/02_polsedit_policy_properties.png?width=300px)

+ Über den Button »_Add User or Group..._« den eigenen (aktuellen) Windows-Benutzer in der Liste der Benutzerkonten auswählen und mittels "OK" die Auswahl bestätigen. Der Windows-Benutzer sollte nun in den Richtlinieneigenschaften ebenfalls gelistet sein (zusätzlich zu den bereits vorhandenen Benutzerkonten).
+ Das Eigenschaftsfenster schließen und Polsedit beenden.
+ Benutzer ab/-anmelden (bzw. das System neu starten), damit die Änderungen der Richtlinie wirksam werden.


## 3. Laragon herunterladen und installieren

Die Installation von Laragon ist über den geführten Installationsprozess durchgängig intuitiv und eigentlich weitgehend selbsterklärend. Das aktuellste Release des WAMP-Stacks kann direkt von GitHub in der jeweils passenden Version heruntergeladen werden.

**ToDo: Laragon herunterladen und installieren**

+ Das aktuellste Release im Laragon GitHub Repository [https://github.com/leokhoa/laragon/releases/latest](https://github.com/leokhoa/laragon/releases/latest) herunterladen
+ Für Windows 10 64 Bit: `laragon-wamp.exe` (64 Bit Version) herunterladen
+ Installationsdatei `laragon-wamp.exe` ausführen. Unter Umständen erscheint an dieser Stelle eine Meldung des Windows Defender SmartScreen mit dem Hinweis, dass der Start einer unbekannten App verhindert wurde. Über den Link »_Weitere Informationen_« kann das Laragon Setup jedoch »_Trotzdem ausgeführt_« werden.
+ Im ersten Schritt des Setup-Prozesses kann – falls gewünscht – die Sprache auf »_Deutsch_« umgestellt werden.
+ Der Setup-Assistent führt dann durch die weitere Installation.
+ Im Dialog »_Zielordner wählen_« wird festgelegt, wo Laragon installiert werden soll (z. B. auf einem anderen Laufwerk bzw. einer anderen Partition).
+ Im nächsten Dialogfenster können bereits einige Konfigurationseinstellungen festgelegt werden, darunter u. a. auch die Option, »_Virtuelle Hosts_« automatisch erzeugen" zu lassen.
+ Am Ende des Installationsprozesses besteht die Möglichkeit, Laragon automatisch zu starten.

In weiterer Folge (bzw. zukünftig) kann Laragon über den entsprechenden neuen Eintrag im Windows Startmenü oder über das Laragon Verknüpfungssymbol am Windows Desktop aufgerufen werden. Nach dem Start der Applikation erscheint im Windows Infobereich (System Tray) ein Programmicon, das ebenfalls den Status der Dienste (gestartet oder beendet) anzeigt und über welches das Laragon Verwaltungspanel geöffnet werden kann:

![Screenshot](/de/guides/images/laragon/03_laragon.png?width=500px)


## 4. Laragon konfigurieren

Laragon kann relativ leicht angepasst und konfiguriert werden. Über das »_Neue Website erstellen_« Feature lässt sich beispielsweise die Installation einer neuen Contao-Instanz vollständig automatisieren, sodass mit nur wenigen Klicks eine frische Contao-Installation aufgesetzt werden kann.

**ToDo: Einstellungen in Laragon festlegen und Apps konfigurieren**

+ Laragon starten (sofern das nicht bereits der Fall ist)
+ Im Laragon Verwaltungspanel auf »_Menü_« und dann »_Einstellungen_« klicken (das Menü lässt sich übrigens auch mittels Rechtsklick auf eine freie Fläche im Verwaltungspanel öffnen):

![Screenshot](/de/guides/images/laragon/04_laragon_menu.png?width=500px)

+ Im Reiter »_Allgemein_« der Laragon Einstellungen die Option »_Alle Dienste automatisch starten_« aktivieren und für die Option »_Virtuelle Hosts automatisch erzeugen_« das Schema des »_Hostnamens_« folgendermaßen ändern: `{name}.local`

![Screenshot](/de/guides/images/laragon/05_laragon_settings.png?width=500px)

+ Im Reiter »_Dienste/Ports_« der Laragon Einstellungen sicherstellen, dass die beiden Dienste »_Apache_« und »_MySQL_« ausgewählt sind. Sofern gewünscht, könnte man hier ebenfalls die SSL-Unterstützung via Port 443 aktivieren:

![Screenshot](/de/guides/images/laragon/06_laragon_services.png?width=500px)

{{% notice note %}}
Die Laragon Konfigurationseinstellungen werden in der `laragon\usr\laragon.ini` gespeichert und können selbstverständlich auch dort geändert werden.
{{% /notice %}}

+ Über »_Menü_« > »_Laragon_« > »_laragon.ini_« die Laragon Konfigurationsdatei zur Bearbeitung öffnen:

![Screenshot](/de/guides/images/laragon/07_laragon_ini.png?width=500px)

+ In der Sektion `[php]` die Werte des Schlüssels QuickSettings um die PHP-Variable `sys_temp_dir` ergänzen:

```
QuickSettings=xdebug, max_execution_time, upload_max_filesize, post_max_size, memory_limit, sys_temp_dir
```

+ Über »_Menü_« > »_PHP_« > »_Quick settings_« die PHP Schnelleinstellungen öffnen:

![Screenshot](/de/guides/images/laragon/08_laragon_php.png?width=500px)

+ Im Untermenü den Eintrag »_memory_limit = …_« auswählen und das PHP Memory Limit auf den Wert `-1` (oder `2G` bzw. `4G`) setzen:

![Screenshot](/de/guides/images/laragon/09_laragon_php_memory_limit.png?width=250px)

+ Im selben Untermenü den Eintrag »_sys_temp_dir = …_« auswählen und das temporäre Verzeichnis auf den Wert `C:\laragon\tmp` setzen (das Laragon Rootverzeichnis ggf. anpassen, sofern Laragon nicht unter dem Standardpfad auf Laufwerk `C:\` installiert wurde):

![Screenshot](/de/guides/images/laragon/10_laragon_php_sys_temp_dir.png?width=250px)

+ Über »_Menü_« > »_PHP_« > »_PHP-Erweiterungen_« können bei Bedarf weitere PHP-Erweiterungen bequem aktiviert oder deaktiviert werden.
+ Über den Button »_Alle Dienste..._« den Web- und Datenbankserver starten:

![Screenshot](/de/guides/images/laragon/11_laragon_servers.png?width=500px)

+ An dieser Stelle meldet sich ziemlich sicher die Windows Defender Firewall (oder ggf. auch eine andere System-Firewall) und fordert sowohl für den »_Apache HTTP Server_« als auch für den MySQL Server »_mysqld.exe_« dazu auf, den Zugriff auf das lokale Netzwerk zuzulassen. Diese beiden Zugriffe müssen für den weiteren Betrieb des Web- und Datenbankservers natürlich gewährt werden.
+ Wenn die Server erfolgreich auf die entsprechenden Ports zugreifen dürfen, sollte Laragon die beiden Dienste »_Apache_« und »_MySQL_« als »_gestartet_« anzeigen:

![Screenshot](/de/guides/images/laragon/12_laragon_running.png?width=500px)

+ Nun sollte der lokale Webserver laufen und die Laragon Indexseite bereits über den Webbrowser via [http://localhost/](http://localhost/) aufrufbar sein:

![Screenshot](/de/guides/images/laragon/13_laragon_localhost.png?width=500px)

+ Damit der Zugriff auf PHP (und alle anderen Laragon Tools/Programme) systemweit möglich ist, müssen die entsprechenden Laragon Pfade in der Windows Umgebungsvariable (PATH-Variable) ergänzt werden. Über das Laragon Verwaltungspanel können die Umgebungsvariablen automatisch aktualisiert werden: »_Menü_« > »_Tools_« > »_Umgebungsvariablen_« > »_Add Laragon to Path_«:

![Screenshot](/de/guides/images/laragon/14_laragon_path.png?width=500px)

Im selben Untermenü können die Laragon Umgebungsvariablen bei Bedarf auch wieder entfernt werden. Ebenfalls kann über den Menüpunkt »_Manage Path_« überprüft werden, ob die Pfadangaben korrekt in der PATH-Umgebungsvariable ergänzt wurden.

+ Über »_Menü_« > »_Neue Website erstellen_« > »_Konfiguration..._« können die bestehenden App-Konfigurationen geändert oder entsprechend ergänzt werden:

![Screenshot](/de/guides/images/laragon/15_laragon_app_config.png?width=500px)

{{% notice note %}}
Die App-Konfigurationen werden in der Datei `laragon\usr\sites.conf` gespeichert.
{{% /notice %}}

+ In der Konfigurationsdatei `laragon\usr\sites.conf` können nun die contaospezifischen Anpassungen ergänzt werden (siehe auch unten als Anhang):

```
# Options
AutoCreateDatabase=true
Cached=true

# Blank: an empty project
Blank=

------------------------------------------------------

# Contao 3.5
Contao 3.5 Website …=composer create-project contao/core %s 3.5.*

# Contao 4.4 LTS
Contao 4.4 Website …=composer create-project contao/managed-edition %s 4.4.* && curl https://download.contao.org/contao-manager/stable/contao-manager.phar -o %s/web/contao-manager.phar.php

# Contao 4.9 LTS
Contao 4.9 Website …=composer create-project contao/managed-edition %s 4.9.* && curl https://download.contao.org/contao-manager/stable/contao-manager.phar -o %s/web/contao-manager.phar.php

------------------------------------------------------

# Wordpress
Wordpress=https://wordpress.org/latest.tar.gz 

# Joomla
### Joomla=https://github.com/joomla/joomla-cms/releases/download/3.8.11/Joomla_3.8.11-Stable-Full_Package.tar.gz

# Prestashop
### Prestashop=https://github.com/PrestaShop/PrestaShop/releases/download/1.7.4.2/prestashop_1.7.4.2.zip

------------------------------------------------------

# Drupal
Drupal 8=https://ftp.drupal.org/files/projects/drupal-8.5.5.tar.gz
### Drupal 7=https://ftp.drupal.org/files/projects/drupal-7.59.tar.gz

------------------------------------------------------

# Laravel

Laravel=composer create-project laravel/laravel %s --prefer-dist
 
Laravel (zip)=https://github.com/leokhoa/quick-create-laravel/releases/download/5.6.21/laravel-5.6.21.7z

### Laravel dev-develop=composer create-project laravel/laravel %s dev-develop
### Laravel 4=composer create-project laravel/laravel  %s 4.2 --prefer-dist	
### Lumen=composer create-project laravel/lumen  %s --prefer-dist

------------------------------------------------------

# CakePHP
### CakePHP=composer create-project --prefer-dist cakephp/app %s

# Symfony 4
Symfony=composer create-project symfony/website-skeleton %s
```

Selbstverständlich können die App-Konfigurationen der anderen Webapplikationen auch entfernt oder auskommentiert werden, sofern diese nicht weiter benötigt werden.

Über den Parameter `AutoCreateDatabase` im Abschnitt Options kann konfiguriert werden, ob Datenbanken ebenfalls automatisch erstellt werden sollen oder nicht. Standardmäßig wird mit jedem neu erstellten Webprojekt gleichzeitig auch eine neue, leere Datenbank mit dem selben Namen angelegt.

{{% notice note %}}
Die Änderungen in der `laragon\usr\sites.conf` sind nach dem Speichern unmittelbar aktiv; Laragon muss also nicht neu gestartet werden.
{{% /notice %}}


## 5. Composer global installieren

Laragon bringt zwar Composer bereits mit, es kann aber dennoch opportun sein, sich den PHP Abhängigkeitsmanager zusätzlich auch noch global im System zu installieren.

**ToDo: Composer global installieren**

+ Composer Windows Installer herunterladen: [https://getcomposer.org/Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe)
+ Installationsdatei `Composer-Setup.exe` ausführen und dem geführten Installationsprozess im Setup-Assistenten folgen:

![Screenshot](/de/guides/images/laragon/16_composer_install.png?width=500px)

+ Den Pfad zur `php.exe` sollte der Composer Setup-Assistent automatisch ermitteln können, sofern die Laragon Pfade – wie oben bereits angegeben – in der Windows PATH-Umgebungsvariable ergänzt wurden.
+ Der Composer Windows Installer aktualisiert ebenfalls die Windows PATH-Umgebungsvariable, damit auch Composer systemweit verfügbar und aufrufbar ist.
+ Zum Testen könnte man etwa im Windows Explorer zum Laragon Verzeichnis `laragon\www` navigieren, dort per Rechtsklick die »_Konsole_« starten und beispielsweise `php -v` und  `composer -V` ausführen:

![Screenshot](/de/guides/images/laragon/17_laragon_console.png?width=800px)


## 6. Contao installieren

Wie bereits erwähnt, kann über das Laragon-Feature »_Neue Website erstellen_« relativ schnell und nur mit wenigen Klicks eine neue Website basierend auf einer beliebigen Contao-Version aufgesetzt werden. Laragon übernimmt dabei automatisch das Erstellen der leeren Datenbank sowie die Konfiguration des virtuellen Hosts.

**ToDo: Eine neue Contao-Installation aufsetzen**

+ Laragon starten (sofern das nicht bereits der Fall ist)
+ Ziel soll nun sein, eine Beispielwebsite »_mycompany_« aufzusetzen, welche mit Contao 4.9 läuft.
+ Im Laragon Verwaltungpanel »_Menü_« > »_Neue Website erstellen_« öffnen (oder als Alternative via Rechtsklick im Laragon Verwaltungspanel bzw. mittels Rechtsklick auf das Laragon Tray-Icon) und den Eintrag »_Contao 4.9 Website …_« auswählen:

![Screenshot](/de/guides/images/laragon/18_laragon_websiteproject.png?width=500px)

+ Im Eingabefeld den Projektnamen der Beispielwebsite `mycompany` eingeben (nach Möglichkeit sollte der Projektname keine Sonderzeichen enthalten, da dieser gleichzeitig auch als Datenbankname verwendet wird) und mit "OK" bestätigen:

![Screenshot](/de/guides/images/laragon/19_laragon_websiteproject_2.png?width=250px)

+ Es öffnet sich ein Konsolenfenster: Im Hintergrund wird zunächst Contao 4.9 (inklusive aller erforderlichen Pakete) via Composer installiert und im Anschluss das Skript des Contao Managers heruntergeladen und im Unterordner `web/` als `contao-manager.phar.php` gespeichert.
+ Laragon erstellt darüber hinaus automatisch eine gleichnamige Datenbank »_mycompany_« sowie einen virtuellen Host `mycompany.local`
+ Für den virtuellen Host muss außerdem die Windows Hosts-Datei aktualisiert werden. Je nach Konfiguration der Windows Benutzerkontensteuerung (UAC) wird man daher nach Abschluss der Installation aufgefordert, die Änderungen an der Systemdatei zu bestätigen. Darüber hinaus könnte an dieser Stelle ggf. auch eine Meldung der AntiViren-Software (oder einer anderen Sicherheitssoftware) darauf aufmerksam machen, dass der Zugriff auf die Windows Hosts-Datei aus Sicherheitsgründen blockiert wird. Sollte das tatsächlich der Fall sein, müsste man zunächst die entsprechende Einstellung in der Sicherheitssoftware temporär deaktivieren und anschließend den Eintrag in der Windows Hosts-Datei manuell ergänzen. Dazu öffnet man im Laragon Verwaltungspanel über »_Menü_« > »_Tools_« > »_Bearbeiten drivers\etc\hosts_« die Hosts-Datei im Editor und fügt eine neue Zeile

```
127.0.0.1      mycompany.local      #laragon magic!
```

hinzu:

![Screenshot](/de/guides/images/laragon/20_laragon_hosts.png?width=500px)

+ Wenn der neue virtuelle Host korrekt konfiguriert ist, sollte man jetzt das Contao Installtool über `http://mycompany.local/contao/install` aufrufen können.
+ Nach Bestätigung der Lizenzbedingungen setzt man zunächst wie gewohnt das Passwort des Contao Installtools und trägt im nächsten Schritt die Datenbankzugangsdaten in die entsprechenden Felder ein. Standardmäßig lautet der DB-Benutzername root, das DB-Passwortfeld bleibt leer (sofern kein Passwort gesetzt wurde) und für den Datenbanknamen wird der Projektname (also mycompany) eingetragen:

![Screenshot](/de/guides/images/laragon/21_contao_installtool.png?width=800px)

+ Sofern Contao erfolgreich eine Verbindung zur angegebenen Datenbank aufbauen kann, erfolgt unmittelbar danach die Aktualisierung der Datenbank, indem alle erforderlichen Tabellen und die Datenbankstruktur generiert werden.
+ Am Ende des Installationsprozesses wird schließlich noch ein Administratorkonto für das Contao Backend angelegt.
+ Das Contao Frontend und Backend, das Contao Installtool und der Contao Manager sollten nun über folgende URLs aufrufbar sein:

**Contao Frontend:** http://mycompany.local/  
**Contao Backend:** http://mycompany.local/contao (bzw. http://mycompany.local/contao/login)  
**Contao Installtool:** http://mycompany.local/contao/install  
**Contao Manager:** http://mycompany.local/contao-manager.phar.php  
(der Systemcheck des Contao Managers sollte den Pfad zur PHP-Binary automatisch erkennen, wenn in der Serverkonfiguration eine manuelle Konfiguration über »_Andere …_«  ausgewählt wird)


{{% notice note %}}
Falls die Browsersoftware bei Eingabe von beispielsweise `mycompany.local` wider Erwarten eine Websuche für dieses Keyword ausführt, sollte beim Aufruf zusätzlich das Schema bzw. Netzwerkprotokoll `http://` mit angegeben werden, also `http://mycompany.local/`.
{{% /notice %}}


## ADDENDUM

**Anhang mit weiterführenden Informationen/Tasks:**

### A Laragon aktualisieren

**ToDo: Die neueste Version von Laragon installieren**

  + Zunächst alle laufenden Dienste (Apache, MySQL) beenden und Laragon schließen.
  + Die aktuelle Version der Laragon Executable [https://github.com/leokhoa/laragon/r...er/laragon.exe](https://github.com/leokhoa/laragon/raw/master/laragon.exe) aus dem GitHub Master-Zweig herunterladen
  + Die bestehende `laragon.exe` im Laragon Installationsverzeichnis durch die zuvor heruntergeladene Executable ersetzen.
  + Laragon starten.


### B Projekt löschen

**ToDo: Ein vorhandenes Website-Projekt wieder entfernen**

+ Im Laragon Verwaltungpanel »_Menü_« > »_Tools_« > »_Delete project_« öffnen und im Untermenü jenes Website-Projekt auswählen, welches gelöscht werden soll:

![Screenshot](/de/guides/images/laragon/22_laragon_deleteproject.png?width=500px)

+ Im nächsten Dialogfenster weist Laragon darauf hin, dass sowohl der Projektordner als auch die dazugehörige Datenbank entfernt werden. Diese Aktionen können nicht rückgängig gemacht werden, d. h. die Daten werden unwiederbringlich gelöscht. Wenn man sich dessen bewusst ist, was man macht, bestätigt man den Löschvorgang.


### C Contao Official Demo (COD) installieren

**ToDo: Contao Official Demo installieren**

+ Im Laragon Verwaltungpanel über den Button »_WWW-Ordner_« den Laragon www-Ordner im Explorer öffnen:

![Screenshot](/de/guides/images/laragon/23_laragon_www.png?width=500px)

+ Im Kontextmenü des Projektordners der Website (entspricht dem Installationsverzeichnis der Contao-Installation) über »_Konsole_« ein neues Konsolenfenster öffnen.
+ Auf der Kommandozeile den folgenden Befehl ausführen, um die [Contao Official Demo (COD)](https://packagist.org/packages/contao/official-demo) via Composer zu installieren:

```
composer require contao/official-demo
```

Je nach Contao-Version kann es erforderlich sein, die jeweils passende Version der Contao Official Demo (COD) anzufordern. Für Contao 4.9 wäre das beispielsweise:

```
composer require contao/official-demo:4.4.0
```

+ Composer führt anschließend eine Abhängigkeitsauflösung aus. Ist diese erfolgreich, wird das Paket heruntergeladen und im System installiert.
+ Contao Installtool aufrufen und den SQL-Datenbankdump der Contao Official Demo (COD) importieren. Achtung: Alle bereits in der Datenbank vorhandenen Daten werden beim Import des COD-Dumps gelöscht.

{{% notice note %}}
Wie jedes andere Paket/Bundle auch, kann die Contao Official Demo (COD) selbstverständlich genauso via Contao Manager installiert werden.
{{% /notice %}}


### D Datenbankverwaltung mit phpMyAdmin

**ToDo: phpMyAdmin installieren**

+ phpMyAdmin von der offiziellen Website herunterladen: [https://www.phpmyadmin.net/downloads/](https://www.phpmyadmin.net/downloads/)
+ ZIP-Archiv entpacken und den Ordner `phpMyAdmin-x.x.x-all-languages` in phpMyAdmin umbenennen (Achtung: Groß- und Kleinschreibung des Ordnernamens beachten bzw. beibehalten!)
+ Den Ordner `phpMyAdmin` inklusive aller darin enthaltenen Dateien und Unterordner nach `laragon\etc\apps\` kopieren/verschieben.
Im Verzeichnis `laragon\etc\apps\phpMyAdmin\` die Beispielvorlage der phpMyAdmin Konfigurationsdatei `config.sample.inc.php` duplizieren und die Kopie in `config.inc.php` umbenennen.
Die Konfigurationsdatei `config.inc.php` editieren und die Einstellungen wie folgt anpassen:

```php
/* Authentication type */
$cfg['Servers'][$i]['auth_type'] = 'cookie';
/* Server parameters */
$cfg['Servers'][$i]['host'] = 'localhost';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['AllowNoPassword'] = true;
$cfg['Servers'][$i]['port'] = 3306;

$cfg['LoginCookieValidity'] = 36000;  
```

+ phpMyAdmin via `http://localhost/phpmyadmin` aufrufen
+ In phpMyAdmin einloggen:
    + Benutzername: `root`
    + Passwort: <leer>

{{% notice note %}}
Die Apache Alias-Konfiguration für phpMyAdmin befindet sich in `laragon\etc\apache2\alias\phpmyadmin.conf`
{{% /notice %}}


### E Zusätzliche PHP-Versionen

Mitunter braucht man für ältere Webprojekte auch noch PHP 5.6. Neue Features möchte man hingegen mit PHP 7.3 testen. Im Folgenden wird daher sowohl PHP 5.6 als auch PHP 7.3 in Laragon verfügbar gemacht.

**ToDo: Weitere PHP-Versionen hinzufügen und zwischen den verschiedenen PHP-Versionen wechseln**

+ Das jeweils aktuellste Release von PHP 5.6 und PHP 7.3 herunterladen (derzeit `php-5.6.40-Win32-VC11-x64.zip` und `php-7.3.2-Win32-VC15-x64.zip`): [https://windows.php.net/downloads/releases/](https://windows.php.net/downloads/releases/)
+ Die beiden ZIP-Archive von PHP 5.6 und PHP 7.3 im Ordner `laragon\bin\php` in die entsprechenden Ordner (`php-5.6.40-Win32-VC11-x64` bzw. `php-7.3.2-Win32-VC15-x64`) entpacken.
+ Nachdem für die beiden PHP-Versionen die Thread-Safe (TS) Variante gewählt wurde, muss sichergestellt werden, dass die Compiler-Versionen von Visual C++ (VCxx) für den Apache Webserver und PHP übereinstimmen:
    + PHP: `php-5.6.40-Win32-`**VC11**`-x64` --> Apache: `httpd-2.4.38-win64-`**VC11**
    + PHP: `php-7.3.2-Win32-`**VC15**`-x64` --> Apache: `httpd-2.4.35-win64-`**VC15**
+ Für PHP 7.3 liegt die passende Apache-Version bereits vor. Für PHP 5.6 muss hingegen die VC11-Version des Apache Webservers erst heruntergeladen werden.
+ Apache 2.4 VC11 Windows Binary herunterladen (`httpd-2.4.38-win64-VC11.zip`): [https://www.apachelounge.com/download/VC11/](https://www.apachelounge.com/download/VC11/)
+ Das ZIP-Archiv für Apache 2.4 VC11 im Ordner `laragon\bin\apache` in den entsprechenden Ordner (`httpd-2.4.38-win64-VC11`) entpacken. Die entpackten Dateien und Ordner müssen ggf. verschoben werden, um der vorgegebenen Ordnerstruktur (vgl. `httpd-2.4.35-win64-VC15`) zu entsprechen.
+ PHP-Version wechseln:  

![Screenshot](/de/guides/images/laragon/24_laragon_php_versions.png?width=500px)

+ Apache-Version wechseln:

![Screenshot](/de/guides/images/laragon/25_laragon_apache_version.png?width=500px)
