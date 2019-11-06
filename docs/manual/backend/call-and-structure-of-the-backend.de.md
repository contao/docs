---
title: "Aufruf und Aufbau des Backends"
description: "Im Administrationsbereich, dem sogenannten Backend, kannst du alle Arbeiten im Zusammenhang mit der 
Verwaltung deiner Webseite erledigen. "
url: "administrationsbereich/aufruf-und-aufbau-des-backends"
weight: 10
---


## Aufruf des Backends

Du erreichst das Backend deiner Contao-Installation, indem du `/contao` an die URL deiner Webseite anhängst. Die 
vollständige Adresse sieht dann so aus:

`https://www.example.com/contao/`

Gebe deinen `Benutzernamen` un dein `Passwort` ein. Die im Internetbrowser voreingestellte Sprache wird auch fürs
Backend verwendet. Bestätige deine Eingaben mit einem Klick auf die Schaltfläche `Weiter`. 

![Anmeldung im Contao-Backend](/de/backend/images/de/contao-backend-anmeldung.png)

Die Backend-Anmeldung ist mit einem Zeitverzögerungsmechanismus gegen [Brute-Force-
Attacken](https://de.wikipedia.org/wiki/Brute-Force-Methode) geschützt. Wenn du mehr als dreimal hintereinander ein
falsches Passwort eingibst, wird dein Benutzerkonto automatisch für 5 Minuten gesperrt. Auf diese Weise wird
verhindert, dass ein Hacker eine große Anzahl Passwörter nacheinander ausprobiert, bis er das richtige Passwort
gefunden hat.


## Aufbau des Backends

Das Backend ist in drei Bereiche unterteilt. Oben befindet sich der Infobereich, auf der linken Seite die Navigation und
auf der rechten der Arbeitsbereich.

![Aufteilung des Contao-Backends](/de/backend/images/de/contao-backend-aufteilung.png)


### Der Infobereich

Der Infobereich zeigt einige wichtige Links an, die beim Arbeiten mit Contao immer wieder benötigt werden.

**Startseite:** Ein Klick auf das Contao-Logo führt zur Startseite des Backends zurück.

**Hinweise:** Beim Klick auf diesen Link öffnet ein Modal und zeigt mögliche Hinweise (z. B. Wartungsmodus) an.

**Debug-Modus:** Beim Klick auf diesen Link wird der [Debug-Modus](../../system/debug-modus/) eingeschaltet bzw. ausgeschaltet.
{{< version "4.8" >}}

**Vorschau:** Dieser Link ruft das Frontend, also die eigentliche Webseite, in einem neuen Fenster auf. Wenn du eine
bestimmte Seite oder einen Artikel im Backend bearbeitest, wirst du automatisch auf die entsprechende Seite im Frontend
weitergeleitet.

**Benutzer:** Beim Klick auf Benutzer werden folgende Links angezeigt:

**Profil:** Dieser Link führt zu den persönlichen Einstellungen deines Benutzerkontos. Du kannst dort z. B. dein
Passwort ändern oder die Sprache wechseln.

**Abmelden:** Über diesen Link kannst du dich vom Backend abmelden.

**Sicherheit:** Über diesen Link kann die 
[Zwei-Faktor-Authentifizierung](https://de.wikipedia.org/wiki/Zwei-Faktor-Authentisierung) für dein Backend aktiviert 
werden.
{{< version "4.6" >}}


### Der Navigationsbereich

Der Navigationsbereich enthält Links zu den verschiedenen Backend-Modulen, von denen jedes eine bestimmte Aufgabe
erfüllt. Zur besseren Übersicht sind die Module in Gruppen zusammengefasst, die du je nach Bedarf ein- und ausklappen
kannst.

**Inhalte:** In dieser Gruppe befinden sich alle Module, die irgendeine Art von Inhalt verwalten. Zu den Inhalten zählen
in Contao nicht nur Artikel, sondern z. B. auch Nachrichtenbeiträge, Termine, Kommentare oder Formulare.

**Layout:** In dieser Gruppe befinden sich alle designrelevanten Module, mit denen du das Aussehen und die Struktur
deiner Webseite festlegen kannst.

**Benutzerverwaltung:** In dieser Gruppe befinden sich alle Module, die mit der Verwaltung von Benutzern und
Benutzergruppen zu tun haben. In Contao unterscheidet man zwischen »Benutzern« (Backend-Benutzer) und »Mitgliedern«
(Frontend-Benutzer).

**System:** In dieser Gruppe befinden sich verschiedene Module zur Konfiguration und Wartung deiner Contao-Installation.
Auch die Dateiverwaltung ist hier eingeordnet.


### Der Arbeitsbereich

Im Arbeitsbereich führst du alle Arbeiten innerhalb von Contao durch. Je nach Modul stehen dir dabei unterschiedliche
Funktionen zur Verfügung.

Direkt nach der Anmeldung wird dir auf der Startseite des Backends das Datum deiner letzten Anmeldung, eine Übersicht
der Backend-Tastaturkürzel sowie die Versionen der zuletzt bearbeiteten Inhalte an.
