---
title: "Seiten konfigurieren"
description: "Nachdem du die richtigen Seitentypen für deine Seiten ausgewählt hast, kannst du diese deinen 
Anforderungen entsprechend konfigurieren. Die Einstellungsmöglichkeiten variieren dabei je nach Seitentyp."
url: "seitenstruktur/seiten-konfigurieren"
weight: 20
---

Nachdem du die richtigen Seitentypen für deine Seiten ausgewählt hast, kannst du diese deinen Anforderungen 
entsprechend konfigurieren. Die Einstellungsmöglichkeiten variieren dabei je nach Seitentyp.


## Seitenaliase

Der **Alias** einer Seite ist eine eindeutige und aussagekräftige Referenz, über die du eine Seite in deinem 
Browser aufrufen kannst. Wenn du das Feld beim Anlegen leer lässt, vergibt Contao den Alias automatisch. Jeder Alias 
muss innerhalb der verwendeten Domain eindeutig sein, darf also nur ein einziges Mal vorkommen.

{{% notice warning %}}
Der Alias der Startseite sollte immer auf `index` lauten. Nur dann wird die erzeugte URL für diese Seite auch ein 
leerer Request sein.
{{% /notice %}}


## Metadaten

Die Metadaten einer Seite beziehen sich größtenteils auf die entsprechenden 
[Meta-Tags](https://de.wikipedia.org/wiki/Meta-Element) im Kopfbereich der HTML-Seite. Du kannst darüber unter anderem 
den Titel und die Beschreibung einer Seite definieren.

**Seitentitel:** Der Seitentitel wird im `<title>`-Tag der Webseite verwendet und taucht häufig auch 
in den Suchergebnissen von Google und Co. auf. Er sollte nicht mehr als 65 Zeichen enthalten, da viele Suchmaschinen 
längere Titel einfach abschneiden.

**Ausgabe im Quellcode:**
```html
<title>Seitentitel</title>
```

**Robots-Tag:** Das Robots-Tag legt fest, wie Suchmaschinen eine Seite behandeln.

- *index:* die Seite in den Suchindex aufnehmen
- *follow:* den Links auf der Seite folgen
- *noindex:* die Seite nicht in den Suchindex aufnehmen
- *nofollow:* den Links auf der Seite nicht folgen

Der Standardfall ist *index,follow*, da wir ja wollen, dass Google unsere Seiten möglichst umfassend in den Suchindex 
aufnimmt. Bestimmte Seiten wie z. B. das Impressum oder die Registrierungsseite können jedoch mithilfe der Anweisung 
*noindex,follow* von der Indizierung ausgenommen werden.

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
<meta name="description" content="Beschreibung der Seite (150 und 300 Zeichen).">
```


## Weitere Einstellungen bei Startpunkten

Bei Seiten vom Typ »Startpunkt einer Webseite« stehen weitere Eingabefelder zur Verfügung, mit denen du bestimmte 
globale Einstellungen pro Webseite überschreiben kannst.

**E-Mail-Adresse des Webseiten-Administrators:** Hier kannst du die in den Backend-Einstellungen festgelegte 
E-Mail-Adresse des Systemadministrators für eine bestimmte Webseite überschreiben. An diese Adresse werden z. B. 
Benachrichtigungen über gesperrte Konten oder neu registrierte Benutzer geschickt. Wenn du mehrere Webseiten innerhalb 
der Seitenstruktur betreibst, kann es sinnvoll sein, für jede Webseite einen eigenen Administrator festzulegen, der 
dann nur die Meldungen seiner Webseite erhält. Du kannst auch folgende Notation verwenden, um einen Namen zur 
E-Mail-Adresse hinzuzufügen:

```text
Kevin Jones [kevin.jones@example.com]
```

**Datumsformat:** Hier kannst du das in den Backend-Einstellungen festgelegte Datumsformat überschreiben. Im Gegensatz 
zum Backend, das nur numerische Formate unterstützt, kannst du im Frontend auch Textformate verwenden.

**Zeitformat:** Hier kannst du das in den Backend-Einstellungen festgelegte Zeitformat überschreiben. Im Frontend 
werden auch Textformate unterstützt.

**Datums- und Zeitformat:** Hier kannst du das in den Backend-Einstellungen festgelegte Datums-
und Zeitformat überschreiben. Textformate werden unterstützt.

Contao unterstützt alle Datums- und Zeitformate, die mit der 
[PHP-Funktion date](https://www.php.net/manual/de/function.date.php) geparst werden können. Um alle Eingaben in einen 
UNIX-Zeitstempel umwandeln zu können, sind im Backend jedoch ausschließlich numerische Formate 
(j, d, m, n, y, Y, g, G, h, H, i, s) erlaubt.

Hier sind einige Beispiele gültiger Datums- und Zeitangaben:


| Angaben  | Erklärung                                                     |
|:---------|:--------------------------------------------------------------|
| Y-m-d    | JJJJ-MM-TT, international ISO-8601, z. B. `2005-01-28`        |
| m/d/Y    | MM/TT/JJJJ, Englisches Format, z. B. `01/28/2005`             |
| d.m.Y    | TT.MM.JJJJ, Deutsches Format, z. B. `28.01.2005`              |
| y-n-j    | JJ-M-T, ohne führende Nullen, z. B. `05-1-28`                 |
| Ymd      | JJJJMMTT, Zeitstempel, z. B. `20050128`                       |
| H:i:s    | 24 Stunden, Minuten und Sekunden, z. B. `20:36:59`            |
| g:i      | 12 Stunden ohne führende Nullen sowie Minuten, z. B. `8:36`   |


{{< version "4.5" >}}

**Alias-Einstellungen:** Der Slug-Generator ermöglicht es einen individuellen Zeichensatz für automatisch erstellte 
Aliase auszuwählen.

| Alias-Einstellungen                  | Erklärung                                                            |
|:-------------------------------------|:---------------------------------------------------------------------|
| Unicode-Zahlen und -Kleinbuchstaben  | Aus dem Seitennamen »Über uns« wird das Alias `über-uns` generiert.  |
| Unicode-Zahlen und -Buchstaben       | Aus dem Seitennamen »Über uns« wird das Alias `Über-uns` generiert.  |
| ASCII-Zahlen und -Kleinbuchstaben    | Aus dem Seitennamen »Über uns« wird das Alias `ueber-uns` generiert. |
| ASCII-Zahlen und -Buchstaben         | Aus dem Seitennamen »Über uns« wird das Alias `Ueber-uns` generiert. |

Für die Erzeugung des Aliases ist in Einzelfällen auch die eingestellte Sprache relevant. So wir ein Deutsches »Über« 
zu »ueber« jedoch ein Finnisches »eläinkö« zu »elainko« konvertiert.

{{< version "4.8" >}}

**Zwei-Faktor-Authentifizierung:** Hier kannst du die Zwei-Faktor-Authentifizierung für alle Mitglieder (Frontend) 
erzwingen. Wähle eine Seite aus, auf die die Besucher weitergeleitet werden, wenn sie die 
Zwei-Faktor-Authentifizierung einrichten.


## Layout-Einstellungen

Ein Seitenlayout ist Voraussetzung dafür, dass Contao eine Seite überhaupt im Frontend anzeigen kann. Ist kein 
Seitenlayout zugewiesen oder vererbt worden, wird stattdessen das Standardlayout geladen. Ist auch kein Standardlayout 
verfügbar, quittiert Contao mit einem kurzen »No layout specified« den Dienst.

**Ein Layout zuweisen:** Hier kannst du einer Seite ein Seitenlayout zuweisen. Die Zuweisung gilt automatisch auch für 
alle untergeordneten Seiten ohne eigenes Seitenlayout.

**Seitenlayout:** Hier werden dir alle verfügbaren Seitenlayouts nach Themes gruppiert angezeigt. Die Aktivierung eines 
Themes erfolgt durch Zuweisung eines Seitenlayouts.


## Cache-Einstellungen

In den Cache-Einstellungen legst du fest, ob und wie lange eine Seite im Cache zwischengespeichert werden soll. Eine 
zwischengespeicherte Seite lädt deutlich schneller, da sie zum einen nicht erst von Contao generiert werden muss und 
zum anderen für ihre Auslieferung keine Verbindung zur Datenbank notwendig ist.

**Cache zeit festlegen:** Hier kannst du einer Seite eine Cachezeit zuweisen. Wenn du die Option nicht auswählst, wird 
die Cachezeit von einer übergeordneten Seite geerbt.

**Private Cache (Client-Cachezeit):** Hier kannst du einer Seite eine Cachezeit zuweisen. Damit legst du den 
Zeitraum in Sekunden fest, nach dem die Seite vom Browser als veraltet eingestuft werden soll.

**Shared Cache (Server-Cachezeit):** Hier kannst du einer Seite eine Cachezeit zuweisen. Damit legst du den 
Zeitraum in Sekunden fest, nach dem die Seite von einem gemeinsam genutzten Cache als veraltet eingestuft werden soll.

Beachte, dass Seiten aus Sicherheitsgründen nur zwischengespeichert werden, wenn sie nicht geschützt sind und kein 
Benutzer im Backend angemeldet ist. Ansonsten bestünde die Gefahr, dass vertrauliche Daten in den Cache geschrieben und 
versehentlich im Frontend angezeigt würden. Wundere dich also nicht, wenn deine passwortgeschützten Seiten trotz 
zugewiesener Verfallszeit nicht im Cache auftauchen.

{{< version "4.8" >}}

**Immer aus dem gemeinsam genutzten Cache laden:** Lade diese Seite immer aus dem gemeinsam genutzten Cache, auch wenn 
ein Mitglied angemeldet ist. Beachte, dass du in diesem Fall die Seite für eingeloggte Mitglieder nicht mehr 
personalisieren kannst.


## Zugriffsrechte

In den Zugriffsrechten legst du fest, welche Benutzer im Backend (!) auf eine Seite zugreifen dürfen und was sie mit 
dieser Seite und den darin enthaltenen Artikeln machen können. Jede Seite gehört ähnlich dem Unix-Rechtesystem einem 
bestimmten Benutzer und einer bestimmten Benutzergruppe und unterscheidet drei Zugriffsebenen:

- Zugriff als Besitzer einer Seite
- Zugriff als Mitglied der Gruppe einer Seite
- Zugriff als sonstiger Backend-Benutzer

Die Seite »Unternehmen« ist beispielsweise mit Zugriffsrechten versehen und gehört dem Benutzer h.lewis sowie der 
Benutzergruppe Nachrichten. Sowohl der Benutzer als auch alle Mitglieder der Benutzergruppe dürfen auf 
dieser Seite Artikel bearbeiten, aber nur der Besitzer h.lewis – und du als Administrator natürlich – dürfen die Seite 
an sich bearbeiten und z. B. den Seitentitel ändern.

![Zugriffsrechte zuweisen](/de/site-structure/images/de/zugriffsrechte-zuweisen.png)

**Zugriffsrechte zuweisen:** Hier kannst du einer Seite Zugriffsrechte zuweisen. Wenn du die Option nicht auswählst, 
werden die Zugriffsrechte von einer übergeordneten Seite geerbt.

**Besitzer:** Hier legst du den Besitzer der Seite fest.

**Gruppe:** Hier legst du die Gruppe der Seite fest.

**Zugriffsrechte:** Hier weist du die Rechte den einzelnen Zugriffsebenen zu.

Weitere Informationen zum Rechtesystem und zur Konfiguration von Benutzern und Benutzergruppen erhältst du auf der 
Seite [Systemverwaltung](../../systemverwaltung).


## Zugriffsschutz

Im Gegensatz zu den Zugriffsrechten, die die Rechte im Backend festlegen, bezieht sich der Zugriffsschutz auf den 
Schutz einer Seiten vor dem Zugriff im Frontend. Besucher müssen sich dann zuerst mit ihrem Benutzernamen und Passwort 
anmelden, bevor sie die Seite aufrufen können. Andernfalls sähen sie nur eine Fehlerseite.

**Seite schützen:** Hier kannst du den Zugriff auf eine Seite beschränken. Wenn du die Option nicht auswählst, wird der 
Zugriffsschutz von einer übergeordneten Seite geerbt.

**Erlaubte Mitgliedergruppen:** Hier kannst du festlegen, welche Mitgliedergruppen auf die Seite zugreifen dürfen. Wie 
man Mitglieder und Mitgliedergruppen konfiguriert, erfährst du auf der Seite 
[Systemverwaltung](../../systemverwaltung).


## Experten-Einstellungen

Unter Umständen gibt es innerhalb deiner Seitenstruktur Seiten, die zwar im Frontend verfügbar sein, aber nicht im Menü 
auftauchen sollen. Oder es könnte Seiten geben, die nur so lange angezeigt werden sollen, bis sich ein Benutzer 
angemeldet hat (z. B. die Registrierungsseite). Solche speziellen Wünsche kannst du in den Experten-Einstellungen 
konfigurieren.

**CSS-Klasse:** Hier weist du der Seite eine CSS-Klasse zu, die sowohl im Body-Tag der HTML-Seite als auch in den 
Navigationsmodulen verwendet wird. Auf diese Weise kannst du CSS-Formatierungen für eine spezielle Seite oder einen 
bestimmten Menüpunkt erstellen.

**In der Sitemap zeigen:** Auf Wunsch legt Contao pro Webseite eine XML-Sitemap an, die du z. B. bei Google einreichen 
kannst ([XML-Sitemap](#xml-sitemap)). Standardmäßig sind darin alle öffentlichen und nicht im Menü 
versteckten Seiten enthalten. Bei Bedarf lässt sich dieses Verhalten pro Seite anpassen:

- **Standard:** Die Standard-Einstellungen verwenden.
- **Immer anzeigen:** Die Seite wird immer in der XML-Sitemap angezeigt, auch wenn sie z. B. im Menü versteckt ist und 
somit normalerweise nicht angezeigt würde.
- **Nie anzeigen:** Die Seite ist von der XML-Sitemap ausgenommen.

**Im Menü verstecken:** Wenn du diese Option auswählst, wird die Seite nicht im Menü deiner Webseite angezeigt. 
Du kannst die Seite – sofern sie veröffentlicht wurde – aber trotzdem über einen direkten Link oder in einem 
Frontend-Modul aufrufen.

Contao indiziert die fertigen Seiten deiner Webseite und erstellt daraus einen Suchindex, den du mit dem Frontend-Modul 
»Suchmaschine« durchsuchen kannst. Mit dieser Einstellungen kannst du bestimmte Seiten gezielt von der Indizierung 
ausnehmen. In den Backend-Einstellungen lässt sich die Suchfunktion darüber hinaus komplett deaktivieren.

**Nicht durchsuchen:** Hier kannst du eine Seite von der Suche ausnehmen.

**Nur Gästen anzeigen:** Wenn du diese Option auswählst, wird der Link zu der Seite automatisch aus dem Navigationsmenü 
der Webseite ausgeblendet, sobald sich ein Mitglied angemeldet hat. Dies ist z. B. für die Seiten »Anmeldung« und 
»Registrierung« sinnvoll.

{{< version "4.5" >}}

**Element erforderlich:** Wenn du diese Option auswählst, wird bei dieser Seite die Fehlerseite 404 gezeigt, wenn die 
URL kein Alias zu einem Element enthält.


## Tastatur-Navigation

Aus Abschnitt, 
[Backend-Tastaturkürzel](../administrationsbereich/backend-tastaturkuerzel/), weißt 
du bereits, dass Contao die Navigation mittels Tastaturkürzel unterstützt. Das wirkt sich nicht nur positiv auf die 
Barrierefreiheit aus, sondern beschleunigt auch den Arbeitsablauf. Aus diesem Grund ist das Feature auch im Frontend 
verfügbar, und jede Seite kann optional mit einem Tastaturkürzel und einem Tab-Index versehen werden.

**Tab-Index:** Standardmäßig springst du mit der Tabulator-Taste von oben nach unten durch das Navigationsmenü. Du 
kannst jedoch eine individuelle Reihenfolge festlegen, indem du jeder Seite eine Zahl zwischen 1 und 32.767 zuweist. 
Der Tabulator folgt dann aufsteigend deiner Sortierung statt der Standardreihenfolge.

**Tastaturkürzel:** Ein Tastaturkürzel ist ein einzelnes Zeichen, das mit einer Seite verknüpft wird. Besucher deiner 
Webseite können diese Seite dann über die Tastatur direkt aufrufen. Diese Funktion wird vor allem für barrierefreie 
Webseiten gefordert.


## DNS-Einstellungen

DNS-Einstellungen sind nur bei Seiten vom Typ »Startpunkt einer Webseite« verfügbar. Sie bestimmen, welchen Startpunkt 
Contao in Abhängigkeit von der aufgerufenen Domain und der im Browser des Besuchers eingestellten Sprache lädt.

**Domainname:** Wenn du möchtest, dass eine Webseite in deiner Seitenstruktur unter einer bestimmten Domain wie z. B. 
»firma.de« erreichbar ist, kannst du diese hier eingeben. Ruft ein Besucher dann »firma.de« in seinem Browser auf, wird 
er automatisch zu dem entsprechenden Startpunkt einer Webseite weitergeleitet.

**HTTPS verwenden:** Aktiviere diese Checkbox wenn deine Webseite über HTTPS verfügbar ist.

**Sprache:** Hier kannst du die Sprache des Startpunkts festlegen. Sprachen werden über ihr primäres 
[Subtag](http://ssgfix.sub.uni-goettingen.de/projekt/doku/sprachcode.html) nach ISO 639-1 erfasst, also z. B. über 
`de` für Deutsch oder `en` für Englisch.

**Sprachen-Fallback:** Contao sucht grundsätzlich nach einem Startpunkt in der Sprache, die ein Besucher in seinem 
Browser voreingestellt hat. Gibt es nur einen deutschen Startpunkt, bekäme ein englischer Besucher lediglich die 
Fehlermeldung »No pages found« zu sehen, da in seiner Sprache ja keine Webseite existiert.

Um das zu vermeiden, kannst du einen bestimmten Startpunkt als Fallback definieren, was frei übersetzt so viel wie 
»Auffangseite« oder »Ausweichseite« bedeutet. Diese Auffangseite fängt dann quasi alle Besucher auf, die aufgrund ihrer 
Spracheinstellungen eigentlich keinem Startpunkt zugeordnet werden können.


Achte also darauf, immer einen Startpunkt als Sprachen-Fallback zu definieren. Deine Webseite kann sonst nur von 
deutschen Besuchern aufgerufen werden! Auch die Robots der Suchmaschinen, die deine Webseite indizieren, sprechen in 
der Regel Englisch und wären ohne Sprachen-Fallback ebenfalls ausgeschlossen. Deine Seiten würden dann trotz 
sorgfältiger Optimierung niemals bei Google auftauchen.


## XML-Sitemap

Contao erstellt bei Bedarf automatisch eine XML-Sitemap aus der Seitenstruktur der Webseite, die 
[Google](https://support.google.com/webmasters/answer/156184?visit_id=636994052832330821-1485667470&rd=2&ref_topic=4581190) 
lesen und auswerten kann. Um die Sitemap bei Google anzumelden, benötigst du einen Google-Account.

**Eine XML-Sitemap erstellen:** Hier aktivierst du die Erstellung der XML-Sitemap.

**Dateiname:** Gebe hier den Namen der Sitemap-Datei ohne Dateiendung `.xml` ein. Die Dateiendung wird von Contao beim 
Speichern automatisch ergänzt.

Die Einstellungen sind nur bei Seiten vom Typ »Startpunkt einer Webseite« verfügbar.


## Weiterleitung

Die folgenden Einstellungen sind nur bei Weiterleitungsseiten verfügbar. In Contao unterscheidet man interne und 
externe Weiterleitungen ([Seitentypen](../seiten-als-zentrale-elemente/#seitentypen)).

**Weiterleitungstyp:** Hier kannst du angeben, ob es sich um eine temporäre (HTTP 302) oder eine permanente (HTTP 301) 
Weiterleitung handelt. Der Weiterleitungstyp spielt vor allem bei der Suchmaschinenoptimierung eine Rolle.

**Weiterleitungsseite:** Hier legst du die Zielseite bei einer internen Weiterleitung fest.

**Link-Adresse:** Hier kannst du die Ziel-URL bei einer externen Weiterleitung eingeben. Für die Weiterleitung zu einer 
anderen Internetseite musst du das Protokoll `https://` verwenden, für die Verlinkung einer E-Mail-Adresse das 
Protokoll `mailto:` und für die Verlinkung einer Telefonnummer das Protokoll `tel:`.

**In neuem Fenster öffnen:** Die Zielseite wird in einem neuen Browserfenster geöffnet.

**Weitere Einstellung bei Fehlerseiten**

Mit Fehlerseiten kannst du Besucher optional auf eine andere Seite umleiten, anstatt einen Hinweis auszugeben. Kommt z. 
B. ein nicht angemeldeter Besucher beim Versuch, eine geschützte Seite aufzurufen, auf die Fehler 403-Seite, könntest
du ihn direkt zur Anmeldung weiterleiten.

**Zu einer anderen Seite weiterleiten:** Hier aktivierst du die Auto-Weiterleitung.


## Veröffentlichung

Solange eine Seite nicht veröffentlicht wurde, existiert sie praktisch nicht im Frontend und kann auch nicht von 
Besuchern aufgerufen werden. Contao bietet zusätzlich zur manuellen Veröffentlichung auch die Möglichkeit, Seiten 
automatisch zu einem bestimmten Datum zu aktivieren. Auf diese Weise kannst du z. B. ein zeitlich begrenztes Angebot 
bewerben.

**Seite veröffentlichen:** Hier kannst du eine Seite veröffentlichen.

**Anzeigen ab:** Hier aktivierst du eine Seite zu einem bestimmten Datum.

**Anzeigen bis:** Hier deaktivierst du eine Seite zu einem bestimmten Datum.
