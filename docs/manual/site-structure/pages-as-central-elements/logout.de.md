---
title: "Abmelden"
description: "Dieser Seitentyp erstellt einen Abmelde-Link für einen geschützten Bereich. Du kannst die Besucher nach 
dem Abmelden auf eine beliebige oder zur zuletzt besuchten Seite weiterleiten."
url: "seitenstruktur/abmelden"
aliases:
    - /de/seitenstruktur/seiten-als-zentrale-elemente/abmelden"
    - /de/layout/seitenstruktur/seiten-als-zentrale-elemente/abmelden"
weight: 50
---

Dieser Seitentyp erstellt einen Abmelde-Link für einen geschützten Bereich. Du kannst die Besucher nach dem Abmelden auf 
eine beliebige oder zur zuletzt besuchten Seite weiterleiten.


## Name und Typ

**Seitenname:** Der Seitenname wird in der Navigation angezeigt und als Fallback für den Seitentitel verwendet.

**Seitentyp:** Hier kannst du den Typ der Seite bestimmen.


## Routing

**Seitenaliase:** Der Alias einer Seite ist eine eindeutige und aussagekräftige Referenz, über die du eine Seite in
deinem Browser aufrufen kannst. Wenn du das Feld beim Anlegen leer lässt, vergibt Contao den Alias automatisch.

**Routen-Pfad:** Die Vorschau des endgültigen Pfads (möglicherweise mit Platzhaltern), der zu dieser Seite passt.

**Routenpriorität:** Optional kann die Priorität konfiguriert werden, um die Reihenfolge der Routen zu beeinflussen.


## Auto-Weiterleitung

**Weiterleitungsseite:** Hier kannst du die Seite auswählen, zu der das Mitglied nach der Abmeldung weitergeleitet wird. 
Wenn du keine Zielseite auswählst, wird automatisch zur ersten regulären Unterseite weitergeleitet.

**Zur zuletzt besuchten Seite:** Das Mitglied zurück zu der zuletzt besuchten Seiten anstatt der Weiterleitungsseite 
leiten.


## Zugriffsrechte

In den Zugriffsrechten legst du fest, welche Benutzer im **Backend** auf eine Seite zugreifen dürfen und was sie mit
dieser Seite und den darin enthaltenen Artikeln machen können. Jede Seite gehört ähnlich dem Unix-Rechtesystem einem
bestimmten Benutzer und einer bestimmten Benutzergruppe und unterscheidet drei Zugriffsebenen:

- Zugriff als Besitzer einer Seite
- Zugriff als Mitglied der Gruppe einer Seite
- Zugriff als sonstiger Backend-Benutzer

Die Seite »Unternehmen« ist beispielsweise mit Zugriffsrechten versehen und gehört dem Benutzer h.lewis sowie der
Benutzergruppe _Nachrichten_. Sowohl der Benutzer als auch alle Mitglieder der Benutzergruppe dürfen auf
dieser Seite Artikel bearbeiten, aber nur der Besitzer h.lewis – und du als Administrator natürlich – dürfen die Seite
an sich bearbeiten und z. B. den Seitentitel ändern.

![Zugriffsrechte zuweisen]({{% asset "images/manual/layout/site-structure/de/zugriffsrechte-zuweisen.png" %}}?classes=shadow)

**Zugriffsrechte zuweisen:** Hier kannst du einer Seite Zugriffsrechte zuweisen. Wenn du die Option nicht auswählst,
werden die Zugriffsrechte von einer übergeordneten Seite geerbt.

**Besitzer:** Hier legst du den Besitzer der Seite fest.

**Gruppe:** Hier legst du die Gruppe der Seite fest.

**Zugriffsrechte:** Hier weist du die Rechte den einzelnen Zugriffsebenen zu.

Weitere Informationen zum Rechtesystem und zur Konfiguration von Benutzern und Benutzergruppen erhältst du auf der
Seite [Systemverwaltung](/de/system/einstellungen/).


## Experten-Einstellungen

Unter Umständen gibt es innerhalb deiner Seitenstruktur Seiten, die zwar im Frontend verfügbar sein, aber nicht im Menü
auftauchen sollen. Oder es könnte Seiten geben, die nur so lange angezeigt werden sollen, bis sich ein Benutzer
angemeldet hat (z. B. die Registrierungsseite). Solche speziellen Wünsche kannst du in den Experten-Einstellungen
konfigurieren.

**CSS-Klasse:** Hier weist du der Seite eine CSS-Klasse zu, die sowohl im Body-Tag der HTML-Seite als auch in den
Navigationsmodulen verwendet wird. Auf diese Weise kannst du CSS-Formatierungen für eine spezielle Seite oder einen
bestimmten Menüpunkt erstellen.

**In der HTML-Sitemap zeigen:** Hier kannst du festlegen, ob die Seite in der HTML-Sitemap angezeigt wird. Standardmäßig 
sind darin alle öffentlichen und nicht im Menü versteckten Seiten enthalten. Bei Bedarf lässt sich dieses Verhalten pro Seite anpassen:

- **Standard:** Die Standard-Einstellungen verwenden.
- **Immer anzeigen:** Die Seite wird immer in der HTML-Sitemap angezeigt, auch wenn sie z. B. im Menü versteckt ist und
  somit normalerweise nicht angezeigt würde.
- **Nie anzeigen:** Die Seite ist von der HTML-Sitemap ausgenommen.

{{% notice info %}}
Verwechsle bitte nicht die HTML-Sitemap mit der XML-Sitemap: Die HTML-Sitemap ist ein Frontend-Modul, die XML-Sitemap 
kannst du z. B. bei Google einreichen.
{{% /notice %}}

**Im Menü verstecken:** Wenn du diese Option auswählst, wird die Seite nicht im Menü deiner Webseite angezeigt.
Du kannst die Seite – sofern sie veröffentlicht wurde – aber trotzdem über einen direkten Link oder in einem
Frontend-Modul aufrufen.


## Tastatur-Navigation

Aus Abschnitt [Backend-Tastaturkürzel](/de/administrationsbereich/backend-tastaturkuerzel/) weißt
du bereits, dass Contao die Navigation mittels Tastaturkürzel unterstützt. Das wirkt sich nicht nur positiv auf die
Barrierefreiheit aus, sondern beschleunigt auch den Arbeitsablauf. Aus diesem Grund ist das Feature auch im Frontend
verfügbar, und jede Seite kann optional mit einem Tastaturkürzel und einem Tab-Index versehen werden.

**Tastaturkürzel:** Ein Tastaturkürzel ist ein einzelnes Zeichen, das mit einer Seite verknüpft wird. Besucher deiner
Webseite können diese Seite dann über die Tastatur direkt aufrufen. Diese Funktion wird vor allem für barrierefreie
Webseiten gefordert.


## Veröffentlichung

Solange eine Seite nicht veröffentlicht wurde, existiert sie praktisch nicht im Frontend und kann auch nicht von
Besuchern aufgerufen werden. Contao bietet zusätzlich zur manuellen Veröffentlichung auch die Möglichkeit, Seiten
automatisch zu einem bestimmten Datum zu aktivieren. Auf diese Weise kannst du z. B. ein zeitlich begrenztes Angebot
bewerben.

**Seite veröffentlichen:** Hier kannst du eine Seite veröffentlichen.

**Anzeigen ab:** Hier aktivierst du eine Seite zu einem bestimmten Datum.

**Anzeigen bis:** Hier deaktivierst du eine Seite zu einem bestimmten Datum.
