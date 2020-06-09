---
title: "Mitglieder (Frontend)"
description: "Die Verwaltung von Frontend-Benutzern ist deutlich einfacher als die Verwaltung von Backend-Benutzern, da 
hier nicht mit Mounts und einzelnen Eingabefeldern gearbeitet werden muss."
url: "benutzerverwaltung/mitglieder"
aliases:
    - /de/benutzerverwaltung/mitglieder/
weight: 20
---

Die Verwaltung von Frontend-Benutzern ist deutlich einfacher als die Verwaltung von Backend-Benutzern, da hier nicht 
mit Mounts und einzelnen Eingabefeldern gearbeitet werden muss. Bei der Mitgliederverwaltung geht es hauptsächlich um 
den Zugriff auf geschützte Unterseiten und das Ändern der persönlichen Daten.

Die Bezeichnung »Mitglieder« stammt noch aus den Anfängen von Contao, in denen die Software vorwiegend für 
Community-Seiten verwendet wurde. Mittlerweile werden auch viele kommerzielle Webseiten damit umgesetzt, sodass man 
auch »Kunden« sagen könnte.


## Mitgliedergruppen

Auch Mitglieder werden in Gruppen organisiert und erben von diesen die Zugriffsrechte auf geschützte Seiten.

### Weiterleitung

Im Frontend-Modul »Login« kannst du festlegen, zu welcher Seite Mitglieder nach der Anmeldung weitergeleitet werden. In 
den Gruppeneinstellungen kannst du diese Standardseite mit einer individuellen Zielseite pro Gruppe überschreiben. 

**Weiterleiten bei Anmeldung:** Hier aktivierst du die individuelle Weiterleitung.

**Weiterleitungsseite:** Hier wählst du die Zielseite aus.


### Kontoeinstellungen

Auch Mitgliedergruppen können manuell oder automatisch deaktiviert werden.

**Deaktivieren:** Hier kannst du die Gruppe deaktivieren.

**Aktivieren am:** Hier aktivierst du die Gruppe zu einem bestimmten Tag um 0:00 Uhr.

**Deaktivieren am:** Hier deaktivierst du die Gruppe zu einem bestimmten Tag um 0:00 Uhr.


## Mitglieder

Im Gegensatz zu Benutzern geht es bei Mitgliedern nicht so sehr um Zugriffsrechte, als vielmehr um persönliche Daten 
wie z. B. Name, Adresse oder Telefonnummer.

{{% notice note %}}
Der Benutzernamen und die E-Mail-Adresse müssen eindeutig sein, das heißt, sie dürfen nur einmal vergeben werden.
{{% /notice %}}


### Personendaten

**Vorname:** Hier gibst du den Vornamen des Mitglieds ein.

**Nachname:** Hier gibst du den Nachnamen des Mitglieds ein.

**Geburtsdatum:** Hier kannst du das Geburtsdatum eingeben. Ein Klick auf das grüne Symbol neben dem Eingabefeld öffnet 
einen JavaScript-Kalender.

**Geschlecht:** Hier wählst du das Geschlecht des Mitglieds aus.


### Adressdaten

**Firma:** Hier kannst du den Firmennamen des Mitglieds eingeben.

**Strasse:** Hier kannst du die Adresse des Mitglieds eingeben.

**Postleitzahl:** Hier kannst du die Postleitzahl des Mitglieds eingeben.

**Ort:** Hier kannst du den Wohnort des Mitglieds eingeben.

**Staat:** Hier kannst du den Staat bzw. das Bundesland eingeben, in dem das Mitglied ansässig ist.

**Land:** Hier kannst du das Land auswählen, in dem das Mitglied lebt.


### Kontaktdaten

**Telefonnummer:** Hier kannst du die Telefonnummer des Mitglieds eingeben.

**Handynummer:** Hier kannst du die Handynummer des Mitglieds eingeben.

**Faxnummer:** Hier kannst du die Faxnummer des Mitglieds eingeben.

**E-Mail-Adresse:** Gebe hier die E-Mail-Adresse des Mitglieds ein. 

**Webseite:** Hier kannst du die Webseite des Mitglieds eingeben.

**Sprache:** Hier wählst du die Sprache des Mitglieds aus.


### Mitgliedergruppen

Hier legst du die Gruppenzugehörigkeit des Mitglieds fest. Die erste Gruppe, also die ganz oben im Auswahlmenü, ist die 
Hauptgruppe, die z. B. bei der automatischen Weiterleitung nach dem Login berücksichtigt wird.

**Mitgliedergruppen:** Hier legen du die Gruppenzugehörigkeit des Mitglieds fest.


### Zugangsdaten

In dieser Sektion kannst du dem Mitglied einen Benutzernamen und ein Passwort zuweisen, mit dem es sich im Frontend 
anmelden kann. Dazu sollte es mindestens einer Mitgliedergruppe angehören.

**Login erlauben:** Hier aktivierst du die Frontend-Anmeldung.

**Benutzername:** Hier legst du einen eindeutigen Benutzernamen fest.

**Passwort:** Hier weist du dem Mitglied ein Passwort zu.


### Home-Verzeichnis

Hier kannst du dem Mitglied ein eigenes Home-Verzeichnis zuweisen und dort z. B. mit der Dateiverwaltung bestimmte Dateien 
bereitstellen. Sowohl das Modul »Bildergalerie« als auch das Modul »Downloads« bieten die Möglichkeit, das 
Benutzerverzeichnis eines Mitglieds als Datenquelle zu verwenden.

**Ein Home-Verzeichnis festlegen:** Hier aktivierst du ein eigenes Home-Verzeichnis.

**Home-Verzeichnis:** Hier legst du den Ordner des Mitglieds fest.


### Abonnements

**Abonnements:** Hier kannst du die Newsletter-Abonnements des Mitglieds bearbeiten.


### Kontoeinstellungen

Genau wie Benutzer können auch Mitglieder manuell oder automatisch deaktiviert werden. Ein deaktiviertes Mitglied kann 
sich nicht mehr im Frontend anmelden.

**Deaktivieren:** Hier kannst du das Mitglied deaktivieren.

**Aktivieren am:** Hier aktivierst du das Mitglied zu einem bestimmten Tag um 0:00 Uhr.

**Deaktivieren am:** Hier deaktivierst du das Mitglied zu einem bestimmten Tag um 0:00 Uhr.
