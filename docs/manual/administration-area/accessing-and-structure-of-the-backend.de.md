---
title: "Das Backend von Contao"
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

![Anmeldung im Contao-Backend]({{% asset "images/manual/administration-area/de/contao-backend-anmeldung.png" %}}?classes=shadow)

Die Backend-Anmeldung ist mit einem Zeitverzögerungsmechanismus gegen [Brute-Force-Attacken](https://de.wikipedia.org/wiki/Brute-Force-Methode) 
geschützt. Wenn du mehr als dreimal hintereinander ein falsches Passwort eingibst, wird dein Benutzerkonto automatisch 
für 5 Minuten gesperrt. Auf diese Weise wird verhindert, dass ein Hacker eine große Anzahl Passwörter nacheinander 
ausprobiert, bis er das richtige Passwort gefunden hat.


## Aufbau des Backends

Das Backend ist in drei Bereiche unterteilt. Oben befindet sich der Infobereich, auf der linken Seite die Navigation und
auf der rechten der Arbeitsbereich.

![Aufbau des Backends]({{% asset "images/manual/administration-area/de/aufbau-des-backends.png" %}}?classes=shadow)


### Der Infobereich

Der Infobereich zeigt einige wichtige Links an, die beim Arbeiten mit Contao immer wieder benötigt werden.

![Der Infobereich]({{% asset "images/manual/administration-area/de/hinweise.png" %}}?classes=shadow)

![Startseite]({{% asset "icons/logo.svg" %}}?classes=icon,backend) **Startseite:** Ein Klick auf das Contao-Logo führt 
zur Startseite des Backends zurück.

![Handbuch]({{% asset "icons/manual.svg" %}}?classes=icon,backend) **Handbuch:** Beim Klick auf diesen Link wird das 
Handbuch aufgerufen.

![Favorit speichern]({{% asset "icons/favorite.svg" %}}?classes=icon,backend)  **Favorit speichern:** Beim Klick auf 
diesen Link kannst du die aktuelle URL im Backend als Favorit Eintrag speichern. Vorhandene Favoriten-Links werden im 
Navigationsbereich aufgeführt. {{< version-tag "5.1" >}}

![Favoriten]({{% asset "images/manual/administration-area/de/favoriten.png" %}}?classes=shadow)

![Hinweise]({{% asset "icons/alert.svg" %}}?classes=icon,backend) **Hinweise:** Beim Klick auf diesen Link öffnet ein 
Modal und zeigt mögliche Hinweise (z. B. Wartungsmodus) an.

![Design]({{% asset "icons/color_scheme.svg" %}}?classes=icon,backend) **Design:** Du kannst zwischen hellen und dunklen 
Backend-Design wählen. {{< version-tag "5.1" >}}

![Dunkles Design]({{% asset "images/manual/administration-area/de/dunkles-design.png" %}}?classes=shadow)

**Debug-Modus:** Beim Klick auf diesen Link wird der [Debug-Modus](../../system/debug-modus/) eingeschaltet bzw. ausgeschaltet.

**Vorschau:** Dieser Link ruft das Frontend, also die eigentliche Webseite, in einem neuen Fenster auf. Wenn du eine 
bestimmte Seite oder einen Artikel im Backend bearbeitest, wirst du automatisch auf die entsprechende Seite im Frontend 
weitergeleitet.

**Benutzer:** Beim Klick auf Benutzer werden folgende Links angezeigt:
  + ![Profil]({{% asset "icons/profile_small.svg" %}}?classes=icon,backend) **Profil:** Dieser Link führt zu den 
  persönlichen Einstellungen deines Benutzerkontos. Du kannst dort z. B. dein Passwort ändern oder die Sprache wechseln.

  + ![Sicherheit]({{% asset "icons/shield_small.svg" %}}?classes=icon,backend) **Sicherheit:** Über diesen Link kann 
  die [Zwei-Faktor-Authentifizierung](https://de.wikipedia.org/wiki/Zwei-Faktor-Authentisierung) für die Anmeldung im Backend aktiviert werden.

  + ![Favoriten]({{% asset "icons/favorite.svg" %}}?classes=icon,backend) **Favoriten:** Über diesen Link erreichst du 
  die Verwaltung der Favoriten. {{< version-tag "5.1" >}}

  + ![Abmelden]({{% asset "icons/exit.svg" %}}?classes=icon,backend) **Abmelden:** Über diesen Link kannst du dich vom 
  Backend abmelden.

    
### Der Navigationsbereich

Der Navigationsbereich enthält Links zu den verschiedenen Backend-Modulen, von denen jedes eine bestimmte Aufgabe
erfüllt. Zur besseren Übersicht sind die Module in Gruppen zusammengefasst, die du je nach Bedarf ein- und ausklappen
kannst.

![Der Navigationsbereich]({{% asset "images/manual/administration-area/de/der-navigationsbereich.png" %}}?classes=shadow)

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

![Der Arbeitsbereich]({{% asset "images/manual/administration-area/de/der-arbeitsbereich.png" %}}?classes=shadow)

Direkt nach der Anmeldung wird dir auf der Startseite des Backends das Datum deiner letzten Anmeldung, eine Übersicht
der Backend-Tastaturkürzel sowie die Versionen der zuletzt bearbeiteten Inhalte an.


### Der Vorschaubereich

Die Frontend-Vorschau erreichst du über den Link »Vorschau« im [Infobereich](#der-infobereich).

Zu erkennen ist die Frontend-Vorschau zum einen an der Frontend-Preview-Bar und zum anderen am `preview.php` in der URL.

![Frontend-Vorschau]({{% asset "images/manual/administration-area/de/frontend-preview-bar.png" %}}?classes=shadow)

**URL kopieren:** Beim Klick auf den Link, wird die URL ohne `preview.php` in die Zwischenablage kopiert und kann an der 
gewünschten Stelle eingefügt werden.

**URL teilen:** Beim Klick auf den Link, wird das Backend in einem neuen Fenster geöffnet und du kannst den [Link 
aktivieren](../../system/preview-link/).

**Mitglied:** Wenn du einen Geschützen Bereich auf deiner Website eingerichtet hast und die Vorschau für ein bestimmtes 
Mitglied anzeigen möchtest, kannst du den Benutzernamen eingeben.

**Nicht veröffentlicht:** Hier kannst du auswählen, ob nicht veröffentlichte Elemente und Seiten angezeigt oder 
versteckt werden sollen.

