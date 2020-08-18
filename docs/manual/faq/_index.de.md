---
title: "Fragen und Antworten"
description: "Antworten zu den häufigsten Fragen."
url: "faq"
aliases:
    - /de/faq/
weight: 90
---

Hier findest du eine Sammlung der häufigsten Fragen mit den passenden Antworten. 

Wenn du selbst einen Vorschlag für diesen Bereich hast, verwende den Link »Diese Seite bearbeiten« oben rechts. 
Besitzt du ein GitHub-Konto und bist angemeldet erstellt GitHub automatisch einen Fork in dem du 
deine Vorschläge hinzufügen kannst. Anschließend kannst du über GitHub einen Pull-Request erstellen.


## Allgemein

{{% expand "Ich habe mein Administrator-Passwort vergessen, wie kann ich es zurücksetzen?" %}}
Falls es in der Datenbank-Tabelle »tl_user« mehrere Datensätze gibt, bei denen das Admin-Flag gesetzt ist, kannst du den Wert 
zunächst bei allen zurücksetzen, um anschließend im Contao [Install-Tool](/de/installation/contao-installtool/) 
einen neuen Administrator anzulegen.
{{% /expand %}}

{{% expand "Ich habe das Install-Tool Passwort vergessen, wie kann ich es zurücksetzen?" %}}
Entferne in der Datei »system/config/localconfig.php« die Zeile beginnend mit `$GLOBALS['TL_CONFIG']['installPassword']`
vollständig. Anschließend kannst du über das [Install-Tool](/de/installation/contao-installtool/) ein neues Passwort vergeben.
{{% /expand %}}

{{% expand "Kann ich mit Contao mehrere Webseiten pflegen?" %}}
Ja. Contao unterstützt den [Multidomain-Betrieb](/de/layout/seitenstruktur/multidomain-betrieb/) und 
[Mehrsprachige Webseiten](/de/layout/seitenstruktur/mehrsprachige-webseiten/).
{{% /expand %}}

{{% expand "Kann ich mit Contao »Mehrsprachige Webseiten« pflegen?" %}}
Ja. Contao unterstützt [Mehrsprachige Webseiten](/de/layout/seitenstruktur/mehrsprachige-webseiten/).
{{% /expand %}}

{{% expand "Wie aktiviere ich den Contao Debug-Modus?" %}}
Du kannst den [Contao Debug-Modus](/de/system/debug-modus/) über das Backend aktivieren.
{{% /expand %}}

{{% expand "Wo finde ich weitere Contao-Ressourcen?" %}}
Weitere Contao-Ressourcen findest du auf der [Projektwebseite](https://contao.org/de/netzwerk.html).
{{% /expand %}}

{{% expand "Darf ich Contao für kommerzielle Projekte verwenden?" %}}
Ja, die [GNU Lesser General Public License](https://www.gnu.org/licenses/old-licenses/lgpl-2.1.html) (LGPL), unter der 
Contao seit der Version 2.5 lizenziert ist, erlaubt die Verwendung des Systems für kommerzielle Projekte. Beachte jedoch, 
dass die Copyright-Hinweise in den Contao-Dateien gemäß den Lizenzbedingungen nicht entfernt oder verändert werden dürfen.
{{% /expand %}}


## Template

{{% expand "Wie kann ich alle Variablen meines Templates anzeigen?" %}}
Die Information hierzu findest du unter [Template-Daten anzeigen](/de/layout/templates/data/).
{{% /expand %}}

{{% expand "Wie kann ich den TinyMCE-Editor konfigurieren?" %}}
Die Information hierzu findest du unter [TinyMCE-Editor Konfiguration](/de/anleitungen/tinymce-konfiguration/).
{{% /expand %}}


## Konfiguration und Einstellung

{{% expand "Es wird keine E-Mail über mein Formular versendet, was muss ich machen?" %}}
Überprüfe in der `parameters.yml` die [SMTP-Angaben](/de/system/einstellungen/#e-mail-versand-konfiguration) deines Hosters oder 
füge diese hinzu. Anschließend musst du über den Contao-Manager (»Systemwartung« > »Prod.-Cache erneuern«) oder über die 
Konsole einmalig den Anwendungs-Cache leeren.
{{% /expand %}}

{{% expand "Kann ich eine andere E-Mail-Adresse als Absender für Formulare benutzen?" %}}
Die im Bereich »Einstellungen > E-Mail-Adresse des Systemadministrators« gesetzte E-Mail-Adresse wird u. a. auch als
Absender für Formulare herangezogen. Du kannst im Bereich »Seitenstruktur« für den Seitentyp »Startpunkt einer Webseite«
eine zusätzliche E-Mail-Adresse eintragen. Anschließend wird diese dann als Absender genutzt.
Ab Contao 4.10 kannst du dies [konfigurieren](/de/system/einstellungen/#verschiedene-e-mail-konfigurationen-und-absenderadressen).
{{% /expand %}}

{{% expand "Wie kann ich das Sprachkürzel der URL hinzufügen?" %}}
Du kannst in der [config.yml](/de/system/einstellungen/#config-yml) den Eintrag `prepend_locale: true` hinzufügen.
Anschließend musst du über den Contao-Manager (»Systemwartung« > »Prod.-Cache erneuern«) oder über die Konsole 
einmalig den Anwendungs-Cache leeren.

```yml
# config/config.yml
contao:
    prepend_locale: true
```
{{% /expand %}}

{{% expand "Kann man die URL Suffix ».html« entfernen?" %}}
Du kannst in der [config.yml](/de/system/einstellungen/#config-yml) den Eintrag `url_suffix: ''` hinzufügen. 
Anschließend musst du über den Contao-Manager (»Systemwartung« > »Prod.-Cache erneuern«) oder über die Konsole 
einmalig den Anwendungs-Cache leeren.

```yml
# config/config.yml
contao:
    url_suffix: ''
```
{{% /expand %}}

{{% expand "Warum werden meine HTML-Angaben im TinyMCE-Editor nicht übernommen?" %}}
Antworten findest du im Bereich [TinyMCE-Editor Konfiguration](/de/anleitungen/tinymce-konfiguration/).
{{% /expand %}}

## Dateiverwaltung

{{% expand "Meine Bilder werden im Frontend nicht angezeigt, was kann ich machen?" %}}
Überprüfe in der [Dateiverwaltung](/de/dateiverwaltung/), ob das Verzeichnis mit deinen Bildern als »Öffentlich« 
gekennzeichnet ist.
Stelle außerdem sicher, dass sich keine veraltete `.htaccess` Datei im Order `/web` oder einem übergeordneten Ordner deiner Installation befindet
{{% /expand %}}


## Theme

{{% expand "Warum werden Änderungen an meinen SCSS-Dateien nicht übernommen?" %}}
Bei Änderungen an einer [SCSS Partial-Datei](/de/anleitungen/sass-less-integration#hinweis-i-umgang-mit-partials) musst 
du im Anschluss in der »Systemwartung« den Scriptcache leeren.
{{% /expand %}}


## Contao Manager

{{% expand "Wozu benötige ich den Contao Manager?" %}}
Du benötigst den Contao Manager um Contao und Erweiterung zu installieren/aktualisieren/deinstallieren. Weiterführende Informationen findest du unter [Über den Contao Manager](/de/installation/contao-manager/).
{{% /expand %}}

{{% expand "Kann ich den Contao Manager einer bestehenden Installation hinzufügen?" %}}
Ja, der [Contao Manager](/de/installation/contao-manager/#kann-der-contao-manager-zu-einer-bestehenden-installation-hinzugefuegt-werden) 
erkennt bei der Installation deine bestehende Contao Installation.
{{% /expand %}}

{{% expand "Wie kann man den Contao Manager aktualisieren?" %}}
Der [Contao Manager](/de/installation/contao-manager/#haeufige-fragen-zum-contao-manager) führt beim Aufruf automatisch 
im Hintergrund eine Prüfung durch. Sollte eine neue Version verfügbar sein, aktualisiert sich der Contao Manager selbst.
{{% /expand %}}

{{% expand "Was ist die Composer Resolver Cloud?" %}}
Die [Composer Resolver Cloud](https://composer-resolver.cloud/) erlaubt die Installation von Composer-Abhängigkeiten 
über den [Contao Manager](/de/installation/contao-manager/), selbst wenn dein Server nicht über genug Arbeitsspeicher verfügt.
{{% /expand %}}
