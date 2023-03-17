---
title: "Formulare"
description: "Mit dem Formulargenerator kannst du Formulare erstellen und deren Daten entweder per E-Mail verschicken 
oder in die Datenbank schreiben."
url: "formulargenerator/formulare"
aliases:
    - /de/formulargenerator/formulare/
weight: 10
---

Mit dem Formulargenerator kannst du Formulare erstellen und deren Daten entweder per E-Mail verschicken oder in die 
Datenbank schreiben. Contao prüft die Formulareingaben automatisch anhand den von dir vorgegebenen Regeln. Übertragene 
Dateien können als Anhang versendet oder auf dem Server gespeichert werden.


## Eigener SMTP-Server

Ohne Angaben eines eigenen SMTP-Servers werden die Daten über [Sendmail](https://de.wikipedia.org/wiki/Sendmail) 
versendet, was zu Problemen führen kann.

{{% notice info %}}
Wir empfehlen den Versand über das [E-Mail-Transportprotkoll (SMTP)](../../system/einstellungen/#smtp-versand).
{{% /notice %}}


## Formular-Konfiguration

Den Formulargenerator findest du in der Backend-Navigation in der Gruppe »Inhalte«.

Um ein neues Formular anzulegen klicke auf 
![Ein neues Formular anlegen](/de/icons/new.svg?classes=icon "Ein neues Formular anlegen") **Neu**.


### Titel und Weiterleitung

**Titel:** Der Titel eines Formulars wird ausschließlich im Backend verwendet.

**Formalias:** Der Formalias ist eine eindeutige Referenz, die anstelle der numerischen Form-ID aufgerufen werden kann.

**Weiterleitungsseite:** Hier kannst du festlegen, auf welche Seite ein Besucher nach dem Absenden eines Formulars 
weitergeleitet wird (Bestätigungsseite).


### Formular-Konfiguration

**HTML-Tags erlauben:** Wenn du diese Option auswählst, können deine Besucher HTML-Code in den Formularfeldern 
verwenden. In den Backend-Einstellungen unter »Erlaubte HTML-Tags« legst du fest, welche HTML-Tags zulässig sind.

{{< version-tag "5.1" >}}**Per Ajax senden:** Wenn du diese Option auswählst, benötigst du keine weitere Weiterleitungsseite 
und du kannst zusätzlich einen Text als Bestätigungsmeldung setzen. Die übermittelten Formulardaten können als Simple-Tokens verwendet werden, 
z. B. ##field_name##.


## Formulardaten versenden

Auf Wunsch verschickt Contao die Formulardaten per E-Mail an einen oder mehrere Empfänger. Falls ein Formular ein Feld 
für die Übertragung einer Datei enthält, wird diese als Attachment an die E-Mail angehängt.

**Per E-Mail versenden:** Hier aktivierst du den E-Mail-Versand.

**Empfänger-Adresse:** Hier kannst du eine oder mehrere durch Kommata getrennte E-Mail-Adressen erfassen, an die die 
Formulardaten verschickt werden.

**Betreff:** Hier gibst du den Betreff der E-Mail ein.

**Datenformat:** Hier legst du fest, in welchem Format die Formulardaten übermittelt werden. Übertragene Dateien werden 
immer als Attachment angehängt.

| Datenformat              | Erklärung                                                                                |
|:-------------------------|:-----------------------------------------------------------------------------------------|
| Rohdaten                 | Die E-Mail enthält die unbearbeiteten Daten, das heißt, die Inhalte der einzelnen Formularfelder werden einfach untereinander aufgelistet. |
| XML-Datei                | Der E-Mail ist eine XML-Datei mit den Formulardaten angehängt. |
| CSV-Datei                | Der E-Mail ist eine CSV-Datei mit den Formulardaten angehängt. |
| CSV-Datei (Microsoft Excel) | {{< version "4.10" >}} Der E-Mail ist eine CSV-Datei im Microsoft-Excel-Format mit den Formulardaten angehängt. |
| E-Mail                   | Die Formulardaten werden so formatiert, als hätte der Absender eine E-Mail mit seinem E-Mail-Programm geschrieben. In diesem Fall verarbeitet der Formulargenerator ausschließlich die Felder `name`, `email`, `subject` und `message` und ignoriert alle anderen Formularfelder. |

**Leere Felder auslassen:** Wenn du diese Option auswählst, werden nur ausgefüllte Felder per E-Mail versendet. Felder 
ohne eine Eingabe werden übersprungen.


## Formulardaten speichern

Zusätzlich zum bzw. anstatt des Versands per E-Mail können Formulareingaben auch in einer Tabelle in der Datenbank 
gespeichert werden. Dazu musst du für jedes Formularfeld ein entsprechendes Feld in der Zieltabelle anlegen und darauf 
achten, dass die Feldnamen jeweils übereinstimmen.

**Eingaben speichern:** Hier aktivierst du das Speichern der Daten in der Datenbank.

**Zieltabelle:** Hier wählst du die Tabelle aus, in die die Daten geschrieben werden sollen. Die Tabelle muss vorher 
z. B. über phpMyAdmin oder als [DCA](../../../../dev/reference/dca/) angelegt worden sein. Die SQL-Zieltabelle muss für jedes Formularfeld eine gleichnamige Spalte enthalten. Sonderzeichen wie Bindestriche im Feldnamen können zu Problemen führen.

Beispiel-SQL-Code um eine neue Tabelle `prefix_beispielname` in der Datenbank `##DB-NAME##` für ein Formular mit den (Text-)Feldern `Feld1` , `Feld2` , `Feld3` anzulegen:
```SQL
CREATE TABLE `##DB-NAME##`.`prefix_beispielname` ( `ID` INT NOT NULL AUTO_INCREMENT , `Feld1` TEXT NOT NULL , `Feld2` TEXT NOT NULL , `Feld3` TEXT NOT NULL , INDEX (`ID`)) ENGINE = InnoDB;
```


## Template-Einstellungen

**Individuelles Template:** Hier kannst du das Standard-Template überschreiben.


## Experten-Einstellungen

In den Experten-Einstellungen kannst du unter anderem die Übertragungsmethode eines Formulars ändern. Standardmäßig 
werden Formulare als POST-Request gesendet, da damit auch größere Datenmengen wie z. B. Dateien übertragen werden 
können. In speziellen Fällen, wenn du beispielsweise ein Suchformular zur Ansteuerung der Contao-Suchmaschine erstellen 
möchtest, ist es jedoch notwendig, stattdessen einen GET-Request zu senden, bei dem die Formulardaten an die URL der 
Seite angehängt werden.

**Übertragungsmethode:** Hier legst du die Übertragungsmethode fest.

**HTML5-Validierung deaktivieren:** Hier fügst du dem Formular das `novalidate`-Attribut hinzu.

**CSS-ID/-Klasse:** Um ein bestimmtes Formular gezielt in einem Stylesheet anzusprechen, kannst du ihm hier eine CSS-ID 
bzw. CSS-Klasse zuweisen.

**Formular-ID:** Die meisten Frontend-Module, die Benutzereingaben entgegennehmen, haben eine Formular-ID, anhand der 
sie eindeutig identifiziert werden können. Solltest du ein solches Modul mit einem eigenen Formular ansteuern wollen, 
musst du diese Formular-ID hier angeben.
