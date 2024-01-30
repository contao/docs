---
title: "503 Dienst nicht verfügbar"
description: "Diese Seite wird aufgerufen, wenn sich eine Root-Seite im Wartungsmodus befindet. Der Wartungsmodus kann 
im Startpunkt einer Website aktiviert werden."
url: "seitenstruktur/dienst-nicht-verfuegbar"
aliases:
    - /de/seitenstruktur/seiten-als-zentrale-elemente/dienst-nicht-verfuegbar"
    - /de/layout/seitenstruktur/seiten-als-zentrale-elemente/dienst-nicht-verfuegbar"
weight: 90
---

Diese Seite wird aufgerufen, wenn sich eine Root-Seite im Wartungsmodus befindet. Der Wartungsmodus kann im 
[Startpunkt einer Website](/de/seitenstruktur/website-startseite/#website-einstellungen) aktiviert werden.


## Name und Typ

**Seitenname:** Der Seitenname wird in der Navigation angezeigt und als Fallback für den Seitentitel verwendet.

**Seitentyp:** Hier kannst du den Typ der Seite bestimmen.


## Metadaten

Die Metadaten einer Seite beziehen sich größtenteils auf die entsprechenden
[Meta-Tags](https://de.wikipedia.org/wiki/Meta-Element) im Kopfbereich der HTML-Seite. Du kannst darüber unter anderem den Titel und die Beschreibung einer 
Seite definieren.

**Seitentitel:** Der Seitentitel wird im `<title>`-Tag der Webseite verwendet und taucht häufig auch
in den Suchergebnissen von Google und Co. auf. Er sollte nicht mehr als 65 Zeichen enthalten, da viele Suchmaschinen
längere Titel einfach abschneiden. Wenn kein Seitentitel angegeben wird, wird als Fallback der Name der Seite benutzt.

**Ausgabe im Quellcode:**
```html
<title>Contao Open Source CMS</title>
```
**Robots-Tag:** Das Robots-Tag legt fest, wie Suchmaschinen eine Seite behandeln.

- *index:* die Seite in den Suchindex aufnehmen
- *follow:* den Links auf der Seite folgen
- *noindex:* die Seite nicht in den Suchindex aufnehmen
- *nofollow:* den Links auf der Seite nicht folgen

Der Standardfall ist *index,follow*, da wir ja wollen, dass Google unsere Seiten möglichst umfassend in den Suchindex
aufnimmt. Bestimmte Seiten wie z. B. das Impressum oder die Registrierungsseite können jedoch mithilfe der Anweisung
*noindex,nofollow* von der Indexierung ausgenommen werden.

**Ausgabe im Quellcode:**
```html
<meta name="robots" content="index,follow">
```

**Beschreibung der Seite:** Die Beschreibung einer Seite wird genau wie der Seitentitel von allen gängigen Suchmaschinen
indiziert und beispielsweise in den Suchergebnissen angezeigt, wenn keine Kontextinformation zum gesuchten Begriff
verfügbar ist. Die empfohlene Länge einer Beschreibung liegt zwischen 150 und 300 Zeichen. Die Meta-Beschreibung einer
Seite ist ein wichtiges Instrument zur Suchmaschinenoptimierung, daher solltest du dir die Zeit nehmen, jede Seite mit
einer eindeutigen Beschreibung zu versehen.

**Ausgabe im Quellcode:**
```html
<meta name="description" content="Contao ist ein leistungsstarkes Open Source CMS, mit dem du professionelle Webseiten und skalierbare Webanwendungen erstellen kannst.">
```


## Auto-Weiterleitung

**Zu einer anderen Seite weiterleiten:** Den Besucher zu einer anderen Seite weiterleiten.

**Weiterleitungsseite:** Wähle die Seite aus, zu der der Besucher weitergeleitet werden soll. Wenn du keine Zielseite 
auswählst, wird automatisch zur ersten regulären Unterseite weitergeleitet.



## Layout-Einstellungen

Ein Seitenlayout ist Voraussetzung dafür, dass Contao eine Seite überhaupt im Frontend anzeigen kann. Ist kein
Seitenlayout zugewiesen oder vererbt worden, quittiert Contao mit einem kurzen »No layout specified« den Dienst.

**Ein Layout zuweisen:** Hier kannst du einer Seite ein Seitenlayout zuweisen. Die Zuweisung des Seitenlayouts
gilt automatisch auch für alle untergeordneten Seiten ohne eigenes Seitenlayout.

**Seitenlayout:** Hier werden dir alle verfügbaren Seitenlayouts nach Themes gruppiert angezeigt. Die Aktivierung eines
Themes erfolgt durch Zuweisung eines Seitenlayouts.

**Unterseitenlayout:** Mit der Auswahl »Seitenlayout vererben« (Standard) gilt die Zuweisung
des Seitenlayout auch für alle untergeordneten Seiten ohne eigenes Seitenlayout. Alternativ kann hier ein separates,
abweichendes Seitenlayout für untergeordnete Seiten zugewiesen werden.


## Cache-Einstellungen

In den Cache-Einstellungen legst du fest, ob und wie lange eine Seite im Cache zwischengespeichert werden soll. Eine
zwischengespeicherte Seite lädt deutlich schneller, da sie zum einen nicht erst von Contao generiert werden muss und
zum anderen für ihre Auslieferung keine Verbindung zur Datenbank notwendig ist.

**Cachezeit festlegen:** Hier kannst du einer Seite eine Cachezeit zuweisen. Wenn du die Option nicht auswählst, werden
die Cache-Einstellungen von einer übergeordneten Seite geerbt.

**Private Cache (Client-Cachezeit):** Hier kannst du einer Seite eine Cachezeit zuweisen. Damit legst du den
Zeitraum in Sekunden fest, nach dem die Seite vom Browser als veraltet eingestuft werden soll.

**Shared Cache (Server-Cachezeit):** Hier kannst du einer Seite eine Cachezeit zuweisen. Damit legst du den
Zeitraum in Sekunden fest, nach dem die Seite von einem gemeinsam genutzten Cache als veraltet eingestuft werden soll.

Beachte, dass Seiten aus Sicherheitsgründen nur zwischengespeichert werden, wenn sie nicht geschützt sind und kein
Benutzer im Backend angemeldet ist. Ansonsten bestünde die Gefahr, dass vertrauliche Daten in den Cache geschrieben und
versehentlich im Frontend angezeigt würden. Wundere dich also nicht, wenn deine passwortgeschützten Seiten trotz
zugewiesener Verfallszeit nicht im Cache auftauchen.

**Immer aus dem gemeinsam genutzten Cache laden:** Lade diese Seite immer aus dem gemeinsam genutzten Cache, auch wenn
ein Mitglied angemeldet ist. Beachte, dass du in diesem Fall die Seite für eingeloggte Mitglieder nicht mehr
personalisieren kannst.


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

**CSS-Klasse:** Hier weist du der Seite eine CSS-Klasse zu, die sowohl im Body-Tag der HTML-Seite als auch in den
Navigationsmodulen verwendet wird. Auf diese Weise kannst du CSS-Formatierungen für eine spezielle Seite oder einen
bestimmten Menüpunkt erstellen.


## Veröffentlichung

Solange eine Seite nicht veröffentlicht wurde, existiert sie praktisch nicht im Frontend und kann auch nicht von
Besuchern aufgerufen werden. Contao bietet zusätzlich zur manuellen Veröffentlichung auch die Möglichkeit, Seiten
automatisch zu einem bestimmten Datum zu aktivieren. Auf diese Weise kannst du z. B. ein zeitlich begrenztes Angebot
bewerben.

**Seite veröffentlichen:** Hier kannst du eine Seite veröffentlichen.

**Anzeigen ab:** Hier aktivierst du eine Seite zu einem bestimmten Datum.

**Anzeigen bis:** Hier deaktivierst du eine Seite zu einem bestimmten Datum.
