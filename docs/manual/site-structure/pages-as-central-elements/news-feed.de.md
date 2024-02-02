---
title: "News-Feed"
description: "This page type creates an RSS, Atom or JSON feed from your news archives."
url: "seitenstruktur/news-feed"
aliases:
    - /de/seitenstruktur/seiten-als-zentrale-elemente/news-feed
    - /de/layout/seitenstruktur/seiten-als-zentrale-elemente/news-feed
weight: 100
---

{{< version "5.3" >}}

Dieser Seitentyp erstellt dir einen RSS-, Atom- oder JSON-Feed aus deinen Nachrichtenarchiven.

Jedes News- bzw. Blog-Archiv kann auf Wunsch als RSS-, Atom- oder JSON-Feed exportiert werden. Feeds sind XML- und 
JSON-Dateien mit deinen Beiträgen, die mit einem RSS-Reader abonniert und z. B. in eine andere Webseite eingebunden 
werden können.

Die Feeds können über das [Seitenlayout](/de/layout/theme-manager/seitenlayouts-verwalten/#rss-atom-feeds) im Kopfbereich
der Seite eingebaut werden. Mit »Kopfbereich« ist dabei nicht die Kopfzeile deines Seitenlayouts gemeint, sondern das
`head`-Tag des HTML-Quelltextes.


## Name und Typ

**Seitenname:** Der Seitenname wird in der Navigation angezeigt und als Fallback für den Seitentitel verwendet.

**Seitentyp:** Hier kannst du den Typ der Seite bestimmen.


## Routing

**Seitenaliase:** Der Alias einer Seite ist eine eindeutige und aussagekräftige Referenz, über die du eine Seite in
deinem Browser aufrufen kannst. Wenn du das Feld beim Anlegen leer lässt, vergibt Contao den Alias automatisch.


## Nachrichtenarchive

**Nachrichtenarchive:** Hier legst du fest, welche Nachrichtenarchive in dem Feed enthalten sind.


## Feed-Einstellungen

**Feed-Format:** Hier legst du das Format des Feeds fest. Contao unterstützt folgende Formate: RSS 2.0, Atom, und JSON.

**Export-Einstellungen:** Hier legst du fest, ob lediglich die Teasertexte der Beiträge oder die kompletten Beiträge
als Feed exportiert werden.

**Maximale Anzahl an Beiträgen:** Hier kannst du die Anzahl der Beiträge des Feeds beschränken. In der Regel reichen um
die 25 Beiträge pro Feed vollkommen aus. Meistens werden ohnehin nur die ersten drei bis fünf tatsächlich verwendet.

**Hervorgehobene Beiträge:** Hier legst du fest, ob alle, nur hervorgehobene oder nur nicht hervorgehobene Beiträge der
ausgewählten Archive angezeigt werden.

**Feed-Beschreibung:** Hier kannst du eine Beschreibung des Feeds eingeben.


## Bildeinstellungen


**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben. Dabei kannst du zwischen folgenden Skalierungsmodi
auswählen:

| Relatives Format               |                                                                                                                    |
|:-------------------------------|:-------------------------------------------------------------------------------------------------------------------|
| Proportional                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert. |
| An&nbsp;Rahmen&nbsp;anpassen   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert. |

&nbsp;

| Exaktes Format    |                                                                                                    |
|:------------------|:---------------------------------------------------------------------------------------------------|
| Wichtiger Teil    | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben.                         |
| Links / Oben      | Erhält den linken Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.        |
| Mitte / Oben      | Erhält den mittleren Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.     |
| Rechts / Oben     | Erhält den rechten Teil eines Querformat-Bildes und den oberen Teil eines Hochformat-Bildes.       |
| Links / Mitte     | Erhält den linken Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.     |
| Mitte / Mitte     | Erhält den mittleren Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.  |
| Rechts / Mitte    | Erhält den rechten Teil eines Querformat-Bildes und den mittleren Teil eines Hochformat-Bildes.    |
| Links / Unten     | Erhält den linken Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.       |
| Mitte / Unten     | Erhält den mittleren Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.    |
| Rechts / Unten    | Erhält den rechten Teil eines Querformat-Bildes und den unteren Teil eines Hochformat-Bildes.      |


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


## Experten-Einstellungen

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

Contao indiziert die fertigen Seiten deiner Webseite und erstellt daraus einen Suchindex, den du mit dem Frontend-Modul
»Suchmaschine« durchsuchen kannst. Mit dieser Einstellungen kannst du bestimmte Seiten gezielt von der Indizierung
ausnehmen. In den Backend-Einstellungen lässt sich die Suchfunktion darüber hinaus komplett deaktivieren.

**Nicht durchsuchen:** Hier kannst du eine Seite von der Suche ausnehmen.


## Veröffentlichung

Solange eine Seite nicht veröffentlicht wurde, existiert sie praktisch nicht im Frontend und kann auch nicht von
Besuchern aufgerufen werden. Contao bietet zusätzlich zur manuellen Veröffentlichung auch die Möglichkeit, Seiten
automatisch zu einem bestimmten Datum zu aktivieren. Auf diese Weise kannst du z. B. ein zeitlich begrenztes Angebot
bewerben.

**Seite veröffentlichen:** Hier kannst du eine Seite veröffentlichen.

**Anzeigen ab:** Hier aktivierst du eine Seite zu einem bestimmten Datum.

**Anzeigen bis:** Hier deaktivierst du eine Seite zu einem bestimmten Datum.
