---
title: "Aufruf und Aufbau des Backends"
description: "Im Administrationsbereich, dem sogenannten Backend, kannst du alle Arbeiten im Zusammenhang mit der 
Verwaltung deiner Webseite erledigen. "
url: "administrationsbereich/aufruf-und-aufbau-des-backends"
aliases:
    - /de/administrationsbereich/aufruf-und-aufbau-des-backends/
weight: 10
---

## Aufruf des Backends

Du erreichst das Backend deiner Contao-Installation, indem du `/contao` an die URL deiner Webseite anhängst. Die 
vollständige Adresse sieht dann so aus:

`https://www.example.com/contao/`

Gebe deinen `Benutzernamen` un dein `Passwort` ein. Die im Internetbrowser voreingestellte Sprache wird auch fürs
Backend verwendet. Bestätige deine Eingaben mit einem Klick auf die Schaltfläche `Weiter`. 

![Anmeldung im Contao-Backend](/de/administration-area/images/de/contao-backend-anmeldung.png?classes=shadow)

Die Backend-Anmeldung ist mit einem Zeitverzögerungsmechanismus gegen [Brute-Force-Attacken](https://de.wikipedia.org/wiki/Brute-Force-Methode) 
geschützt. Wenn du mehr als dreimal hintereinander ein falsches Passwort eingibst, wird dein Benutzerkonto automatisch 
für 5 Minuten gesperrt. Auf diese Weise wird verhindert, dass ein Hacker eine große Anzahl Passwörter nacheinander 
ausprobiert, bis er das richtige Passwort gefunden hat.


## Aufbau des Backends

Das Backend ist in drei Bereiche unterteilt. Oben befindet sich der Infobereich, auf der linken Seite die Navigation und
auf der rechten der Arbeitsbereich.

![Aufteilung des Contao-Backends](/de/administration-area/images/de/contao-backend-aufteilung.png?classes=shadow)


### Der Infobereich

Der Infobereich zeigt einige wichtige Links an, die beim Arbeiten mit Contao immer wieder benötigt werden.

**Startseite:** Ein Klick auf das Contao-Logo führt zur Startseite des Backends zurück.

**Handbuch:** Beim Klick auf diesen Link wird das Handbuch aufgerufen.

**Favorit speichern:** {{< version-tag "5.1" >}} Beim Klick auf diesen Link kannst du die aktuelle URL im Backend als Favorit Eintrag 
speichern. Vorhandene Favoriten Links werden im Navigationsbereich aufgeführt.

**Hinweise:** Beim Klick auf diesen Link öffnet ein Modal und zeigt mögliche Hinweise (z. B. Wartungsmodus) an.

**Design:** {{< version-tag "5.1" >}} Du kannst zwischen hellen und dunklen Backend Design wählen.

**Debug-Modus:** {{< version-tag "4.8" >}} Beim Klick auf diesen Link wird der [Debug-Modus](../../system/debug-modus/) eingeschaltet bzw. ausgeschaltet.

**Vorschau:** Dieser Link ruft das Frontend, also die eigentliche Webseite, in einem neuen Fenster auf. Wenn du eine bestimmte Seite 
oder einen Artikel im Backend bearbeitest, wirst du automatisch auf die entsprechende Seite im Frontend weitergeleitet.

**Benutzer:** Beim Klick auf Benutzer werden folgende Links angezeigt:
  + **Profil:** Dieser Link führt zu den persönlichen Einstellungen deines Benutzerkontos. Du kannst dort z. B. dein Passwort ändern oder 
  die Sprache wechseln.

  + **Sicherheit:** {{< version-tag "4.6" >}} Über diesen Link kann die [Zwei-Faktor-Authentifizierung](https://de.wikipedia.org/wiki/Zwei-Faktor-Authentisierung) 
  für dein Backend aktiviert werden.

  + **Favoriten:** {{< version-tag "5.1" >}} Über diesen Link erreichst du die Verwaltung der Favoriten.

  + **Abmelden:** Über diesen Link kannst du dich vom Backend abmelden.

  

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


### Der Vorschaubereich

Die Frontend-Vorschau erreichst du über den Link »Vorschau« im [Infobereich](#der-infobereich).

Zu erkennen ist die Frontend-Vorschau zum einen an der Frontend-Preview-Bar und zum anderen am `preview.php` in der URL.

![Frontend-Vorschau](/de/administration-area/images/de/frontend-preview-bar.png?classes=shadow)

{{< version-tag "4.13" >}} **URL kopieren:** Beim Klick auf den Link, wird die URL ohne `preview.php` in die Zwischenablage kopiert und kann an der 
gewünschten Stelle eingefügt werden.

{{< version-tag "4.13" >}}  **URL teilen:** Beim Klick auf den Link, wird das Backend in einem neuen Fenster geöffnet und du kannst den [Link 
aktivieren](../../system/preview-link/).

**Mitglied:** Wenn du einen Geschützen Bereich auf deiner Website eingerichtet hast und die Vorschau für ein bestimmtes 
Mitglied anzeigen möchtest, kannst du den Benutzernamen eingeben.

**Nicht veröffentlicht:** Hier kannst du auswählen, ob nicht veröffentlichte Elemente und Seiten angezeigt oder 
versteckt werden sollen.

