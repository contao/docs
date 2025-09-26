---
title: "Reguläre Seite"
description: "Reguläre Seiten sind Seiten, auf denen Inhalte ausgegeben werden. Eine reguläre Seite ist vergleichbar 
mit einer statischen HTML-Datei, die du auf deinen Server lädst und in deinem Browser aufrufst."
url: "seitenstruktur/regulaere-seite"
aliases:
    - /de/seitenstruktur/seiten-als-zentrale-elemente/regulaere-seite
    - /de/layout/seitenstruktur/seiten-als-zentrale-elemente/regulaere-seite
weight: 20
---

Reguläre Seiten sind Seiten, auf denen Inhalte ausgegeben werden. Eine reguläre Seite ist vergleichbar mit einer 
statischen HTML-Datei, die du auf deinen Server lädst und in deinem Browser aufrufst.


## Name und Typ

**Seitenname:** Der Seitenname wird in der Navigation angezeigt und als Fallback für den Seitentitel verwendet.

**Seitentyp:** Hier kannst du den Typ der Seite bestimmen.


## Routing

**Seitenaliase:** Der Alias einer Seite ist eine eindeutige und aussagekräftige Referenz, über die du eine Seite in
deinem Browser aufrufen kannst. Wenn du das Feld beim Anlegen leer lässt, vergibt Contao den Alias automatisch.

{{% notice warning %}}
Der Alias der Startseite sollte immer auf `index` lauten. Nur dann wird die erzeugte URL für diese Seite auch ein
leerer Request sein.
{{% /notice %}}

Wenn du eine Seite für die News-Liste mit dem Alias `news` erstellst, kannst du die Seite für den News-Leser mit dem 
gleichen Alias anlegen, sofern du zusätzlich »Element erforderlich« aktivierst.

**Element erforderlich:** Wenn du diese Option auswählst, wird bei dieser Seite die Fehlerseite 404 gezeigt, wenn die 
URL kein Alias zu einem Element enthält.

**Routen-Pfad:** Die Vorschau des endgültigen Pfads (möglicherweise mit Platzhaltern), der zu dieser Seite passt.

**Routenpriorität:** Optional kann die Priorität konfiguriert werden, um die Reihenfolge der Routen zu beeinflussen.

**Routenkonflikte:** Sobald Seiten einen ähnlichen Alias haben, wirst du darauf hingewiesen.


## Metadaten

Die Metadaten einer Seite beziehen sich größtenteils auf die entsprechenden
[Meta-Tags](https://de.wikipedia.org/wiki/Meta-Element) im Kopfbereich der HTML-Seite. Du kannst darüber unter anderem den Titel und die Beschreibung einer 
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
verfügbar ist. Die empfohlene Länge einer Beschreibung liegt zwischen 150 und 300 Zeichen. Die Meta-Beschreibung einer
Seite ist ein wichtiges Instrument zur Suchmaschinenoptimierung, daher solltest du dir die Zeit nehmen, jede Seite mit
einer eindeutigen Beschreibung zu versehen.

**Ausgabe im Quellcode:**
```html
<meta name="description" content="Contao ist ein leistungsstarkes Open Source CMS, mit dem du professionelle Webseiten und skalierbare Webanwendungen erstellen kannst.">
```

**Google Suchergebnis-Vorschau:** Hier kannst du sehen wie Google die Metadaten in den Suchergebnissen anzeigt. Andere
Suchmaschinen zeigen gegebenenfalls längere Texte an oder beschneiden diese an einer anderen Position.

![Google Suchergebnis-Vorschau]({{% asset "images/manual/layout/site-structure/de/google-suchergebnis-vorschau.png" %}}?classes=shadow)


## Kanonische URL

Du kannst hier eine [kanonische URL](https://developers.google.com/search/docs/advanced/crawling/consolidate-duplicate-urls?hl=de) eintragen oder auswählen.

**Individuelle URL:** Hier kannst du eine individuelle kanonische URL setzen.

**Query-Parameter:** Standardmäßig entfernt Contao die Query-Parameter in der kanonischen URL. Hier kannst du eine
kommagetrennte Liste von Query-Parametern hinzufügen, die erhalten bleiben sollen. Verwende dabei "*" als Platzhalter.

{{% notice info %}}
Zur Ausgabe muß im Seitentyp »Website-Startseite« die Einstellung rel="canonical" aktiviert sein (Standard).
{{% /notice %}}


## Zugriffsschutz

Im Gegensatz zu den Zugriffsrechten, die die Rechte im Backend festlegen, bezieht sich der Zugriffsschutz auf den
Schutz einer Seiten vor dem Zugriff im Frontend. Besucher müssen sich dann zuerst mit ihrem Benutzernamen und Passwort
anmelden, bevor sie die Seite aufrufen können. Andernfalls sähen sie nur eine Fehlerseite.

**Seite schützen:** Hier kannst du den Zugriff auf eine Seite beschränken. Wenn du die Option nicht auswählst, wird der
Zugriffsschutz von einer übergeordneten Seite geerbt.

**Erlaubte Mitgliedergruppen:** Hier kannst du festlegen, welche Mitgliedergruppen auf die Seite zugreifen dürfen. Wie
man Mitglieder und Mitgliedergruppen konfiguriert, erfährst du auf der Seite
[Systemverwaltung](/de/system/einstellungen/).


## Layout-Einstellungen

Ein Seitenlayout ist Voraussetzung dafür, dass Contao eine Seite überhaupt im Frontend anzeigen kann. Ist kein
Seitenlayout zugewiesen oder vererbt worden, quittiert Contao mit einem kurzen »No layout specified« den Dienst.

**Ein Layout zuweisen:** Hier kannst du einer Seite ein Seitenlayout zuweisen. Die Zuweisung des Seitenlayouts
gilt automatisch auch für alle untergeordneten Seiten ohne eigenes Seitenlayout.

**Seitenlayout:** Hier werden dir alle verfügbaren Seitenlayouts nach Themes gruppiert angezeigt. Die Aktivierung eines
Themes erfolgt durch Zuweisung eines Seitenlayouts.

**Unterseitenlayout:** Mit der Auswahl »Seitenlayout vererben« (Standard) gilt die Zuweisung
des Seitenlayout auch für alle untergeordneten Seiten ohne eigenes Seitenlayout. Alternativ kann hier ein separates,
abweichendes Seitenlayout für untergeordnete Seiten zugewiesen werden.


## Cache-Einstellungen

In den Cache-Einstellungen legst du fest, ob und wie lange eine Seite im Cache zwischengespeichert werden soll. Eine
zwischengespeicherte Seite lädt deutlich schneller, da sie zum einen nicht erst von Contao generiert werden muss und
zum anderen für ihre Auslieferung keine Verbindung zur Datenbank notwendig ist.

**Cachezeit festlegen:** Hier kannst du einer Seite eine Cachezeit zuweisen. Wenn du die Option nicht auswählst, werden
die Cache-Einstellungen von einer übergeordneten Seite geerbt.

**Private Cache (Client-Cachezeit):** Hier kannst du einer Seite eine Cachezeit zuweisen. Damit legst du den
Zeitraum in Sekunden fest, nach dem die Seite vom Browser als veraltet eingestuft werden soll.

**Shared Cache (Server-Cachezeit):** Hier kannst du einer Seite eine Cachezeit zuweisen. Damit legst du den
Zeitraum in Sekunden fest, nach dem die Seite von einem gemeinsam genutzten Cache als veraltet eingestuft werden soll.

Beachte, dass Seiten aus Sicherheitsgründen nur zwischengespeichert werden, wenn sie nicht geschützt sind und kein
Benutzer im Backend angemeldet ist. Ansonsten bestünde die Gefahr, dass vertrauliche Daten in den Cache geschrieben und
versehentlich im Frontend angezeigt würden. Wundere dich also nicht, wenn deine passwortgeschützten Seiten trotz
zugewiesener Verfallszeit nicht im Cache auftauchen.

**Immer aus dem gemeinsam genutzten Cache laden:** Lade diese Seite immer aus dem gemeinsam genutzten Cache, auch wenn
ein Mitglied angemeldet ist. Beachte, dass du in diesem Fall die Seite für eingeloggte Mitglieder nicht mehr
personalisieren kannst.


## Zugriffsrechte

In den Zugriffsrechten legst du fest, welche Benutzer im **Backend** auf eine Seite zugreifen dürfen und was sie mit
dieser Seite und den darin enthaltenen Artikeln machen können. Jede Seite gehört ähnlich dem Unix-Rechtesystem einem
bestimmten Benutzer und einer bestimmten Benutzergruppe und unterscheidet drei Zugriffsebenen:

- Zugriff als Besitzer einer Seite
- Zugriff als Mitglied der Gruppe einer Seite
- Zugriff als sonstiger Backend-Benutzer

Die Seite »Unternehmen« ist beispielsweise mit Zugriffsrechten versehen und gehört dem Benutzer h.lewis sowie der
Benutzergruppe _Nachrichten_. Sowohl der Benutzer als auch alle Mitglieder der Benutzergruppe dürfen auf
dieser Seite Artikel bearbeiten, aber nur der Besitzer h.lewis – und du als Administrator natürlich – dürfen die Seite
an sich bearbeiten und z. B. den Seitentitel ändern.

![Zugriffsrechte zuweisen]({{% asset "images/manual/layout/site-structure/de/zugriffsrechte-zuweisen.png" %}}?classes=shadow)

**Zugriffsrechte zuweisen:** Hier kannst du einer Seite Zugriffsrechte zuweisen. Wenn du die Option nicht auswählst,
werden die Zugriffsrechte von einer übergeordneten Seite geerbt.

**Besitzer:** Hier legst du den Besitzer der Seite fest.

**Gruppe:** Hier legst du die Gruppe der Seite fest.

**Zugriffsrechte:** Hier weist du die Rechte den einzelnen Zugriffsebenen zu.

Weitere Informationen zum Rechtesystem und zur Konfiguration von Benutzern und Benutzergruppen erhältst du auf der
Seite [Systemverwaltung](/de/system/einstellungen/).


## Experten-Einstellungen

**CSS-Klasse:** Hier weist du der Seite eine CSS-Klasse zu, die sowohl im Body-Tag der HTML-Seite als auch in den
Navigationsmodulen verwendet wird. Auf diese Weise kannst du CSS-Formatierungen für eine spezielle Seite oder einen
bestimmten Menüpunkt erstellen.

**In der HTML-Sitemap zeigen:** Hier kannst du festlegen, ob die Seite in der HTML-Sitemap angezeigt wird. Standardmäßig 
sind darin alle öffentlichen und nicht im Menü versteckten Seiten enthalten. Bei Bedarf lässt sich dieses Verhalten pro Seite anpassen:

- **Standard:** Die Standard-Einstellungen verwenden.
- **Immer anzeigen:** Die Seite wird immer in der HTML-Sitemap angezeigt, auch wenn sie z. B. im Menü versteckt ist und
  somit normalerweise nicht angezeigt würde.
- **Nie anzeigen:** Die Seite ist von der HTML-Sitemap ausgenommen.

{{% notice note %}}
Verwechsle bitte nicht die HTML-Sitemap mit der XML-Sitemap: Die HTML-Sitemap ist ein Frontend-Modul, die XML-Sitemap 
kannst du z. B. bei Google einreichen.
{{% /notice %}}

**Im Menü verstecken:** Wenn du diese Option auswählst, wird die Seite nicht im Menü deiner Webseite angezeigt.
Du kannst die Seite – sofern sie veröffentlicht wurde – aber trotzdem über einen direkten Link oder in einem
Frontend-Modul aufrufen.

Contao indiziert die fertigen Seiten deiner Webseite und erstellt daraus einen Suchindex, den du mit dem Frontend-Modul
»Suchmaschine« durchsuchen kannst. Mit dieser Einstellungen kannst du bestimmte Seiten gezielt von der Indizierung
ausnehmen. In den Backend-Einstellungen lässt sich die Suchfunktion darüber hinaus komplett deaktivieren.

**Nicht durchsuchen:** Hier kannst du eine Seite von der Suche ausnehmen.


## Tastatur-Navigation

Aus Abschnitt [Backend-Tastaturkürzel](/de/administrationsbereich/backend-tastaturkuerzel/) weißt
du bereits, dass Contao die Navigation mittels Tastaturkürzel unterstützt. Das wirkt sich nicht nur positiv auf die
Barrierefreiheit aus, sondern beschleunigt auch den Arbeitsablauf. Aus diesem Grund ist das Feature auch im Frontend
verfügbar, und jede Seite kann optional mit einem Tastaturkürzel und einem Tab-Index versehen werden.

**Tastaturkürzel:** Ein Tastaturkürzel ist ein einzelnes Zeichen, das mit einer Seite verknüpft wird. Besucher deiner
Webseite können diese Seite dann über die Tastatur direkt aufrufen. Diese Funktion wird vor allem für barrierefreie
Webseiten gefordert.


## Veröffentlichung

Solange eine Seite nicht veröffentlicht wurde, existiert sie praktisch nicht im Frontend und kann auch nicht von
Besuchern aufgerufen werden. Contao bietet zusätzlich zur manuellen Veröffentlichung auch die Möglichkeit, Seiten
automatisch zu einem bestimmten Datum zu aktivieren. Auf diese Weise kannst du z. B. ein zeitlich begrenztes Angebot
bewerben.

**Seite veröffentlichen:** Hier kannst du eine Seite veröffentlichen.

**Anzeigen ab:** Hier aktivierst du eine Seite zu einem bestimmten Datum.

**Anzeigen bis:** Hier deaktivierst du eine Seite zu einem bestimmten Datum.
