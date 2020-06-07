---
title: "Newsletter-Verwaltung"
description: "Die Newsletter-Verwaltung ist ein eigenes Modul im Backend, das du in der Gruppe »Inhalte« findest."
url: "core-erweiterung/newsletter/newsletter-verwaltung"
aliases:
    - /de/core-erweiterung/newsletter/newsletter-verwaltung/
weight: 10
---

Die Newsletter-Verwaltung ist ein eigenes Modul im Backend, das du in der Gruppe »Inhalte« findest. 
Du kannst dort mehrere Verteiler anlegen, die wiederum die einzelnen Newsletter und Empfänger enthalten. Durch die 
Verwendung mehrerer Verteiler können die einzelnen Newsletter nach Thema oder Sprache sortiert werden.


## Verteiler

Um einen neuen Verteiler anzulegen klicke auf 
![Einen neuen Verteiler erstellen](/de/icons/new.svg?classes=icon "Einen neuen Verteiler erstellen") **Neu**.


### Titel und Weiterleitung

**Titel:** Der Titel eines Verteilers wird nur in der Backend-Übersicht verwendet.

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Besucher beim Anklicken eines Links im Frontend-Modul 
»Newsletterliste« weitergeleitet wird. Diese Zielseite sollte das Modul »Newsletterleser« enthalten.


### Template-Einstellungen

**E-Mail-Template:** Hier kannst du das E-Mail-Template überschreiben.


### Absendereinstellungen

**Absender-E-Mail-Adresse:** Hier musst du die E-Mail-Adresse des Absenders eingeben.

**Absendername:** Hier kannst du den Namen des Absenders eingeben.


### Eigener SMTP-Server

Ohne Angaben eines eigenen SMTP-Servers werden die Daten über [Sendmail](https://de.wikipedia.org/wiki/Sendmail) 
versendet, was zu Problemen führen kann.

{{% notice info %}}
Wir empfehlen den Versand über das [E-Mail-Transportprotkoll (SMTP)](../../../system/einstellungen/#smtp-versand).
{{% /notice %}}


## Newsletter

Newsletter werden grundsätzlich nach ihrem Versanddatum sortiert.

Um einen neuen Newsletter anzulegen klicke auf 
![Verteiler bearbeiten](/de/icons/edit.svg?classes=icon "Verteiler bearbeiten") und danach auf 
![Einen neuen Newsletter erstellen](/de/icons/new.svg?classes=icon "Einen neuen Newsletter erstellen") 
**Neu**.


### Betreff und Newsletteralias

**Betreff:** Hier kannst du den Betreff des Newsletters eingeben.

**Newsletteralias:** Der Alias eines Newsletters ist eine eindeutige und aussagekräftige Referenz, über die du ihn in 
deinem Browser aufrufen kannst.


### HTML- und Text-Inhalt

Eventuell wunderst du dich, warum du den Text des Newsletters zweimal eingeben musst. Das liegt daran, dass weder die 
HTML- noch die Text-Variante in der Praxis ohne Nachteile ist und man deshalb dazu übergegangen ist, beide in die Mail 
einzufügen. Das jeweilige Mail-Programm des Empfängers entscheidet dann selbstständig, welche Variante es anzeigen kann.

Ein reiner HTML-Newsletter hat folgende Nachteile:

- Nicht alle Mail-Clients können HTML korrekt darstellen.
- HTML-Mails werden eher als Spam eingestuft als reine Textmails.
- Extern eingebundene Bilder werden häufig geblockt.

Ein Text-Newsletter hat diese Probleme nicht, allerdings kannst du darin weder Bilder einbinden noch Einfluss auf die 
Textformatierung nehmen.

**HTML-Inhalt:** Gebe hier den HTML-Inhalt des Newsletters ein. Die Eingabe erfolgt wie beim Inhaltselement »Text« über 
den Rich Text Editor.

**Text-Inhalt:** Gebe hier den Textinhalt des Newsletters ein.


### Newsletter personalisieren

Wenn du Newsletter an registrierte Mitglieder verschickst, kannst du diese mithilfe der sogenannten »Simple Tokens« 
personalisieren. Simple Tokens funktionieren ähnlich wie Insert-Tags und können sowohl im HTML- als auch im Text-Inhalt 
eines Newsletters verwendet werden. Nachfolgend ein kleines Beispiel:

```text
Sehr geehrte(r) ##firstname## ##lastname##,

bitte prüfen und aktualisieren Sie Ihre Daten:

Anschrift:   ##street##
PLZ/Ort:     ##postal## ##city##
Telefon:     ##phone##
E-Mail:      ##email##

Ihr Administrator
```

Im Gegensatz zu Insert-Tags kannst du mit Simple Tokens nicht nur auf die Daten der Mitgliedertabelle `tl_member` 
zugreifen, sondern auch einfache If-Else-Abfragen realisieren und so beispielsweise die Anrede 
geschlechtsspezifisch präzisieren:

```text
{if gender=="male"}
Sehr geehrter Herr ##lastname##,
{elseif gender=="female"}
Sehr geehrte Frau ##lastname##,
{else}
Sehr geehrte Damen und Herren,
{endif}

[Inhalt des Newsletters]

{if phone==""}
Bitte aktualisieren Sie Ihre Daten und geben Sie Ihre Telefonnummer an.
{endif}

Ihr Administrator
```


### Dateianhänge {#dateianhaenge}

Du kannst jedem Newsletter eine oder mehrere Dateien hinzufügen, die dann als E-Mail-Anhänge versendet oder auf der 
Webseite zum Download angeboten werden.

**Dateien anhängen:** Hier aktivierst du die Funktion.

**Dateianhänge:** Hier wählst du die Dateianhänge aus.


### Template-Einstellungen

Zum E-Mail-Template musst du vor allem zwei Dinge wissen:

- Es wird nur bei HTML-Newslettern verwendet.
- Es ist primär für den Seitenaufbau und nicht für Inhalte gedacht.

HTML-Mails sind prinzipiell wie HTML-Webseiten aufgebaut, nur können die E-Mail-Programme leider bei Weitem nicht so 
gut mit HTML-Code umgehen wie die modernen Internetbrowser. Deswegen generiert das Template `mail_default` 
ein an sich veraltetes HTML 3.2-Dokument, das jedoch von den meisten E-Mail-Clients verarbeitet wird.

**E-Mail-Template:** Hier wählst du das Template für die HTML-Mail aus.


### Absendereinstellungen

Wenn du keine individuelle Absenderadresse vorgibst, wird die E-Mail-Adresse des Verteilers verwendet.

**Individuelle Absender-E-Mail-Adresse:** Hier kannst du die E-Mail-Adresse des Absenders vorgeben.

**Individueller Absendername:** Hier kannst du den Namen des Absenders vorgeben.


### Experten-Einstellungen

Um einen Newsletter als reine Text-Mail zu versenden, reicht es nicht, das Feld HTML-Inhalt einfach leer zu lassen. Du 
musst darüber hinaus in den Experten-Einstellungen die Option `Als Text senden` auswählen.

**Als Text senden:** Hier deaktivierst du die HTML-Versendung

**Externe Bilder:** Hier kannst du dafür sorgen, dass Bilder in HTML-Newslettern nicht eingebettet werden.


## Empfänger {#empfaenger}

In der Regel verwalten sich die Empfänger eines Newsletters über die entsprechenden Frontend-Module selbstständig, ohne 
dass du als Administrator in den Prozess eingreifen musst. Trotzdem hast du natürlich im Backend die Möglichkeit, 
Empfänger manuell zu ändern. Aus Gründen des Datenschutzes werden jeweils nur die E-Mail-Adresse und der
Aktivierungsstatus gespeichert.

![Einen Empfänger bearbeiten](/de/core-extensions/newsletter/images/de/einen-empfaenger-bearbeiten.png?classes=shadow)

Gemäß des [Double Opt-In-Verfahrens](https://de.wikipedia.org/wiki/Opt-In) erhält jeder Abonnent bei der Bestellung 
eine E-Mail mit einem Bestätigungslink, ohne den er sein Abonnement nicht abschließen kann. Damit wird den Bestimmungen 
des §7 Absatz 2 Nummer 2 und 3 des Gesetzes gegen den unlauteren Wettbewerb (UWG) hinreichend Genüge getan.

Um einen Abonnenten des Verteilers zu bearbeiten, klicke auf 
![Abonnenten des Verteilers bearbeiten](/de/icons/mgroup.svg?classes=icon "Abonnenten des Verteilers bearbeiten") 
und danach auf 
![Einen neuen Abonnenten erstellen](/de/icons/new.svg?classes=icon "Einen neuen Abonnenten erstellen") 
**Neu** oder ![Abonnent bearbeiten](/de/icons/edit.svg?classes=icon "Abonnent bearbeiten").

**E-Mail-Adresse:** Gebe hier die E-Mail-Adresse des Empfängers ein.

**Abonnenten aktivieren:** Hier kannst du die E-Mail-Adresse aktivieren. Solange eine E-Mail-Adresse nicht aktiviert 
ist, wird der Empfänger beim Versand des Newsletters nicht berücksichtigt. Die Aktivierung erfolgt normalerweise über 
das Anklicken des Links der Bestätigungsmail, kann hier aber auch manuell angestoßen werden.


### CSV -Import

Eventuell hast du schon vor Contao mit einem Newsletter-System gearbeitet und stehst jetzt vor der Aufgabe, die 
vorhandenen Empfänger in Contao einzufügen. Für diesen Fall bietet das Newsletter-Modul die Funktion `CSV-Import`.

Exportiere zunächst die vorhandenen Empfänger als CSV-Datei. Die meisten Programme wie z. B. phpMyAdmin oder Excel 
bieten eine entsprechende Option an, um Daten im CSV-Format zu speichern. Obwohl die Bezeichnung CSV-Datei suggeriert, 
dass nur kommagetrennte Daten verarbeitet werden könnten, akzeptiert Contao auch Strichpunkte, Tabulatoren und 
Zeilenumbrüche als Feldtrenner.

Wähle die Datei für den Import auf deinem Rechner aus.

![Newsletter-Empfänger importieren](/de/core-extensions/newsletter/images/de/newsletter-empfaenger-importieren.png?classes=shadow)

Starte den Import anschließend durch einen Klick auf die Schaltfläche `CSV-Import`.


## Newsletter versenden

Die Versendung eines Newsletters leitest du über das entsprechende Navigationssymbol 
![Newsletter versenden](/de/icons/send.svg?classes=icon "Newsletter versenden") in der Verteiler-Übersicht ein. 
Du gelangst zunächst zu einer Vorschauseite, auf der du die Konfiguration und den Inhalt des Newsletters noch einmal 
prüfen kannst. Es wird zudem empfohlen, regen Gebrauch von der Schaltfläche `Testsendung` zu machen. Die 
dazugehörige Empfängeradresse kannst du im Feld `Testsendung an` ändern.

![Einen Newsletter versenden](/de/core-extensions/newsletter/images/de/einen-newsletter-versenden.png?classes=shadow)


### Serverlimits einkalkulieren

Im Regelfall wirst du für deine Webseite keinen eigenen Server angemietet haben, sondern sich einen sogenannten 
Shared-Hosting-Server mit anderen Kunden teilen. Da die Systemressourcen im Shared-Hosting-Bereich allen Kunden 
gemeinschaftlich zur Verfügung stehen, gibt es normalerweise bestimmte Limits, die deren Nutzung einschränken.

Wenn du z. B. einen Newsletter an 500.000 Empfänger versendest, kann das den Mailserver schon mal eine Zeit lang 
beschäftigen, in der du den Dienst für alle Kunden quasi blockierst. Deswegen ist die Anzahl der E-Mails, die du pro 
Minute versenden kannst, normalerweise auf einen Wert zwischen 50 und 500 limitiert.

Um solchen Beschränkungen Rechnung zu tragen, versendet Contao nicht alle Newsletter auf einmal, sondern unterteilt 
den Versandprozess in mehrere Zyklen, die du exakt an die Vorgaben deines Mailservers anpassen kannst.

**Mails pro Zyklus:** Hier legst du die Anzahl der Mails pro Versandzyklus fest.

**Wartezeit in Sekunden:** Hier legst du die Wartezeit zwischen jedem Zyklus fest.

**Versatz:** Falls eine Versendung unterbrochen wurde, kannst du hier festlegen, ab welchem Empfänger diese 
weiterlaufen soll. 

Ausgehend von einem Serverlimit von 100 E-Mails pro Minute und einer Gesamtzahl von 10.000 Empfängern kannst du also 
beispielsweise alle 6 Sekunden 10 Mails verschicken. Der komplette Versandvorgang würde dann 100 Minuten dauern.


### Unterbrochene Versendungen wiederaufnehmen

Normalerweise erfolgt die Versendung eines Newsletters vollständig automatisiert, und du kannst währenddessen andere 
Arbeiten erledigen. Du darfst nur nicht das Contao-Browserfenster schließen oder den Rechner ausschalten. Falls dir das 
doch einmal versehentlich passiert, kannst du den Versand wie folgt wiederaufnehmen:

1. Filtere im Backend unter »System« > »System-Log« die Kategorie nach dem letzten Newsletter-Eintrag.
2. Stelle fest, wie viele Newsletter versendet wurden.
3. Gebe den gewünschten Versatz im Feld `Versatz` ein.

Die Log-Daten der Versendung findest du im Backend unter »System« > »System-Log«. Die Filter-Kategorie heißt 
NEWSLETTER_X, wobei das X für die ID des jeweiligen Newsletters steht. Die Gesamtzahl der versendeten E-Mail entnimmst 
du dem Feld <code>Anzeigen</code>. Waren es z. B. 120 Mails, gib "120" ein, um mit dem 121. Empfänger 
fortzufahren (die Zählung beginnt bei 0).

![Unterbrochene Versendungen wiederaufnehmen](/de/core-extensions/newsletter/images/de/unterbrochene-versendungen-wiederaufnehmen.png?classes=shadow)
