---
title: "Nachrichtenverwaltung"
description: "Die Nachrichtenverwaltung ist ein eigenes Modul im Backend, das du in der Gruppe »Inhalte« findest."
url: "core-erweiterung/nachrichten/nachrichtenverwaltung"
weight: 10
---

Die Nachrichtenverwaltung ist ein eigenes Modul im Backend, das du in der Gruppe »Inhalte« findest. 
Du kannst dort mehrere Archive anlegen, die wiederum die einzelnen News- bzw. Blog-Beiträge enthalten. Durch die 
Verwendung mehrerer Archive ist eine Kategorisierung der Beiträge möglich.


## Nachrichtenarchive

Archive werden zur Gruppierung und/oder Kategorisierung von Nachrichten verwendet. Jedes Archiv kann sich auf eine 
bestimmte Sprache oder ein bestimmtes Thema beziehen.

Um ein neues Nachrichtenarchiv anzulegen klicke auf 
![Ein neues Nachrichtenarchiv erstellen](/de/icons/new.svg?classes=icon "Ein neues Nachrichtenarchiv erstellen") 
**Neu**.


### Titel und Weiterleitung

**Titel:** Der Titel eines Nachrichtenarchivs wird in der Backend-Übersicht verwendet.

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Besucher beim Anklicken des Weiterlesen-Links eines 
Beitrags weitergeleitet wird. Die Zielseite sollte das Modul »Nachrichtenleser« enthalten, um den vollständigen Beitrag 
darzustellen.


### Zugriffsschutz

Genau wie Inhaltselemente können auch News- bzw. Blog-Beiträge geschützt werden. Die Beiträge des Archivs werden dann 
nur angemeldeten Mitgliedern angezeigt.

**Archiv schützen:** Hier aktivierst du den Zugriffsschutz.

**Erlaubte Mitgliedergruppen:** Hier legst du fest, welche Mitgliedergruppen nach der Anmeldung im Frontend Zugriff auf 
die Beiträge haben sollen.


### Kommentare

Die Contao-Kommentarfunktion kennst du bereits von dem gleichnamigen 
[Inhaltselement (Kommentare)](../../../artikelverwaltung/inhaltselemente/#kommentare). Sie steht auch für News- bzw. 
Blog-Beiträge zur Verfügung und sollte auf jeden Fall aktiviert werden, wenn du die Erweiterungen als Blog nutzt.

**Kommentare aktivieren:** Hier aktivierst du die Kommentarfunktion für das Archiv.

**Benachrichtigung an:** Hier legst du fest, ob bei neuen Kommentaren der Systemadministrator, der Autor eines Beitrags 
oder beide benachrichtigt werden.

**Sortierung:** Hier legst du die Reihenfolge der Kommentare fest. Normalerweise wird in einem Blog der älteste 
Kommentar zuerst angezeigt (aufsteigende Sortierung). 

**Kommentare pro Seite:** Hier kannst du die Anzahl der Kommentare pro Seite festlegen. Contao erzeugt bei Bedarf 
automatisch einen Seitenumbruch.

**Kommentare moderieren:** Wenn du diese Option wählst, erscheinen Kommentare nicht sofort auf der Webseite, sondern 
erst, nachdem du sie im Backend freigegeben hast.

**BBCode erlauben:** Wenn du diese Option wählst, können deine Besucher [BBCode](https://de.wikipedia.org/wiki/BBCode) 
zur Formatierung ihrer Kommentare verwenden. Folgende Tags werden unterstützt:

| Tag                                  | Erklärung                                   |
|:-------------------------------------|:--------------------------------------------|
| `[b][/b]`                            | Fettschrift                                 |
| `[i][/i]`                            | Kursivschrift                               |
| `[u][/u]`                            | Unterstrichen                               |
| `[img][/img]`                        | Bild einfügen                               |
| `[code][/code]`                      | Programmcode einfügen                       |
| `[color=#f00][/color]`               | Farbiger Text                               |
| `[quote][/quote]`                    | Zitat einfügen                              |
| `[quote=Tim][/quote]`                | Zitat mit Nennung des Urhebers einfügen     |
| `[url][/url]`                        | Link einfügen                               |
| `[url=http://example.com][/url]`     | Link mit Linktitel einfügen                 |
| `[email][email]`                     | E-Mail-Adresse einfügen                     |
| `[email=info@example.com][/email]`   | E-Mail-Adresse mit Titel einfügen           |

**Login zum Kommentieren benötigt:** Wenn du diese Option auswählst, können nur angemeldete Mitglieder Kommentare 
hinzufügen. Die bereits abgegebenen Kommentare sind aber weiterhin für alle Besucher der Webseite sichtbar.

**Sicherheitsfrage deaktivieren:** Standardmäßig müssen Besucher beim Erstellen von Kommentaren eine Sicherheitsfrage 
beantworten, damit die Kommentarfunktion nicht zu Spam-Zwecken missbraucht werden kann. Falls du aber ohnehin nur 
angemeldeten Mitgliedern das Kommentieren erlauben möchtest, kannst du die Sicherheitsfrage hier deaktivieren.


## RSS-Feeds

Jedes News- bzw. Blog-Archiv kann auf Wunsch als RSS/Atom-Feed exportiert werden. RSSFeeds sind XML-Dateien mit deinen 
Beiträgen, die mit einem RSS-Reader abonniert und z. B. in eine andere Webseite eingebunden werden können.

Die Feeds können über das [Seitenlayout](../../../theme-manager/seitenlayouts-verwalten/#rss-atom-feeds) im Kopfbereich 
der Seite eingebaut werden. Mit »Kopfbereich« ist dabei nicht die Kopfzeile deines Seitenlayouts gemeint, sondern das 
`head`-Tag des HTML-Quelltextes.

Des Weiteren kann die XML-Datei auch direkt im Browser geöffnet werden.

Die URL lautet:

`www.example.com/share/feed-alias.xml`

**Die XML-Datei des Feeds besteht aus folgenden Angaben:**

```rss
<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0" xmlns:media="http://search.yahoo.com/mrss/" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>Feed-Titel</title>
        <description>Feed-Beschreibung</description>
        <link>http://www.domain.de/</link>
        <language>Feed-Sprache</language>
        <pubDate>…</pubDate>
        <generator>Contao Open Source CMS</generator>
        <atom:link href="https://www.domain.de/share/feed-alias.xml" rel="self" type="application/rss+xml" />
        <item>
            <title>Titel der Nachricht</title>
            <description><![CDATA[<p>Beschreibung der Nachricht.</p>]]></description>
            <link>https://www.domain.de/nachricht/alias-der-nachricht.html</link>
            <pubDate>…</pubDate>
            <guid>https://www.domain.de/nachricht/alias-der-nachricht.html</guid>
        </item>
        …
     </channel>
</rss>
```

Um einen neuen Feed anzulegen klicke auf ![RSS-Feeds verwalten](/de/icons/rss.svg?classes=icon "RSS-Feeds verwalten") 
**RSS-Feeds** und danach auf ![Einen neuen Feed erstellen](/de/icons/new.svg?classes=icon "Einen neuen Feed erstellen") 
**Neu**.


### Titel und Sprache

**Titel:** Der Titel wird als Feed-Titel in der XML-Datei ausgeben.

**Feed-Alias:** Der Alias eines Feeds wird als Dateiname verwendet.

**Feed-Sprache:** Hier kanst du die Sprache des [Feeds](http://www.rssboard.org/rss-language-codes#table) eingeben.


### Nachrichtenarchive

**Nachrichtenarchive:** Hier legst du fest, welche Nachrichtenarchive in dem Feed enthalten sind.


### Feed-Einstellungen

**Feed-Format:** Hier legst du das Format des Feeds fest. Contao unterstützt RSS 2.0 und Atom, die beiden am weitesten 
verbreiteten Formate.

**Export-Einstellungen:** Hier legst du fest, ob lediglich die Teasertexte der Beiträge oder die kompletten Beiträge 
als Feed exportiert werden.

**Maximale Anzahl an Beiträgen:** Hier kannst du die Anzahl der Beiträge des Feeds beschränken. In der Regel reichen um 
die 25 Beiträge pro Feed vollkommen aus. Meistens werden ohnehin nur die ersten drei bis fünf tatsächlich verwendet.

**Basis-URL:** Die Basis-URL ist vor allem im Multidomain-Betrieb wichtig, wenn du mehrere Webseiten mit einer 
Contao-Installation betreibst. Damit der Feed auf die richtige Domain verlinkt, kannst du diese hier eingeben.

**Feed-Beschreibung:** Hier kannst du eine Beschreibung des Feeds eingeben.


## Nachrichtenbeiträge {#nachrichtenbeitraege}

In diesem Abschnitt wird dir erklärt, wie du einen Nachrichtenbeitrag erstellst. Nachrichtenbeiträge werden 
grundsätzlich nach ihrem Datum sortiert, daher gibt es hier keine Icons, mit denen du die Reihenfolge ändern kannst.

Die Nachrichtenbeiträge bestehen aus den Einstellungen für die Beiträge (»Nachrichtenliste«) und aus deren Inhalten 
(»Nachrichtenleser«).

Um einen neuen Beitrag zu erstellen, klicke im gewünschten Archiv auf 
![Nachrichtenarchiv bearbeiten](/de/icons/edit.svg?classes=icon "Nachrichtenarchiv bearbeiten") und danach auf 
![Einen neuen Beitrag erstellen](/de/icons/new.svg?classes=icon "Einen neuen Beitrag erstellen") **Neu**.


### Titel und Autor

**Titel:** Hier kannst du den Titel der Nachricht eingeben.

**Nachrichtenalias:** Der Alias eines Beitrags ist eine eindeutige und aussagekräftige Referenz, über die du ihn
in deinem Browser aufrufen kannst.

**Autor:** Hier kannst du den Autor des Beitrags ändern.


### Datum und Zeit

**Datum:** Gebe hier das Datum des Beitrags ein.

**Uhrzeit:** Gebe hier die Uhrzeit des Beitrags ein.


### Metadaten

{{< version "4.7" >}}

**Meta-Titel:** Hier kannst du einen individuellen Meta-Titel eingeben, um den Standard-Seitentitel zu überschreiben.

**Meta-Beschreibung:** Hier kannst du eine individuelle Meta-Beschreibung eingeben, um die Standard-Seitenbeschreibung 
zu überschreiben.


### Unterüberschrift und Teaser {#unterueberschrift-und-teaser}

**Unterüberschrift:** Hier kannst du eine optionale Unterüberschrift eingeben.

**Teasertext:** Hier kannst du eine kurze Zusammenfassung des Nachrichtenbeitrags (Teaser) eingeben, die dann 
beispielsweise mit dem Modul »Nachrichtenliste«, gefolgt von einem Weiterlesen-Link zum eigentlichen Beitrag, 
dargestellt werden kann.


### Bildeinstellungen

**Ein Bild hinzufügen:** Bei Bedarf kannst du dem Beitrag ein Bild hinzufügen.

**Quelldatei:** Hier wählst du das einzufügende Bild aus. Wenn du das Bild noch nicht auf den Server übertragen hast, 
kannst du es direkt im Popup-Fenster nachholen, ohne die Eingabemaske zu verlassen.

![Einem Beitrag ein Bild hinzufügen](/de/core-extensions/news/images/de/einem-beitrag-ein-bild-hinzufuegen.png?classes=shadow)

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

**Bildausrichtung:** Hier legst du die Ausrichtung des Bildes fest. Wird er 
![oberhalb](/de/icons/above.svg?classes=icon) **oberhalb**, 
![unterhalb](/de/icons/below.svg?classes=icon) **unterhalb**, 
![linksbündig](/de/icons/left.svg?classes=icon) **linksbündig** oder 
![rechtsbündig](/de/icons/right.svg?classes=icon) **rechtsbündig** eingefügt der Text umfließt das Bild.

**Bildabstand:** Hier legst du den Abstand des Bilds zum Text fest. Die Reihenfolge der Eingabefelder lautet im 
Uhrzeigersinn »oben, rechts, unten, links«.

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße 
geöffnet. Diese Option steht bei verlinkten Bildern nicht zur Verfügung.

**Metadaten überschreiben:**  Hier kannst du die Metadaten aus der Dateiverwaltung überschreiben.

**Alternativer Text:** Hier kannst du einen alternativen Text für das Bild eingeben *(alt-Attribut)*. Eine 
barrierefreie Webseite sollte für jedes Objekt eine kurze Beschreibung enthalten, die angezeigt wird, wenn das Objekt 
selbst nicht dargestellt werden kann. Alternative Texte werden außerdem von Suchmaschinen ausgewertet und sind daher 
ein wichtiges Instrument der Onpage-Optimierung.

**Bildtitel:** Hier kannst du den Titel des Bildes eingeben *(title-Attribut)*.

**Bildlink-Adresse:** Bei einem Klick auf ein verlinktes Bild wirst du direkt zu der angegebenen Zielseite 
weitergeleitet (entspricht einem Bildlink). Beachte, dass für ein verlinktes Bild keine Lightbox-Großansicht mehr 
möglich ist.

**Bildunterschrift:** Hier kannst du eine Bildunterschrift eingeben.


### Anlagen

Anlagen, im Zusammenhang mit RSS-Feeds auch »Enclosures« genannt, sind Dateien, die mit einem Beitrag verknüpft sind. 
Diese Dateien werden sowohl im RSS-Feed exportiert als auch auf der Webseite zum Download angeboten.

**Anlagen hinzufügen:** Hier aktivierst du das Hinzufügen von Anlagen.

**Anlangen:** Hier wählst du die Dateien aus, die du mit dem Beitrag verknüpfen möchtest.


### Weiterleitungsziel

Das Weiterleitungsziel bestimmt, auf welche Seite ein Besucher beim Anklicken eines Beitrags weitergeleitet wird. 
Normalerweise ist das die Seite, auf der das Frontend-Modul »Nachrichtenleser« zur Darstellung des kompletten Beitrags 
eingebunden ist.

**Weiterleitungsziel:** Hier legst du das Weiterleitungsziel fest.

**Weiterleitungsseite:** Hier wählst du die Zielseite aus der Seitenstruktur aus.

**Artikel:** Hier wählst du den Zielartikel aus.

**Link-Adresse:** Hier gibst du die URL der externen Zielseite ein.

**In neuem Fenster öffnen:** Hier kannst du festlegen, ob die externe Zielseite in einem neuen Browserfenster geöffnet 
wird oder nicht.

| Weiterleitungsziel   | Erklärung                                                                                    |
|:---------------------|:---------------------------------------------------------------------------------------------|
| Standard             | Die Weiterleitung erfolgt auf die Seite, die du in den Archiv-Einstellungen festgelegt hast. Auf dieser Seite sollte das Frontend-Modul »Nachrichtenleser« eingebunden sein. |
| Seite                | Die Weiterleitung erfolgt zu einer bestimmten Seite in der Seitenstruktur.                   |
| Artikel              | Die Weiterleitung erfolgt zu einem bestimmten Artikel.                                       |
| Individuelle URL     | Die Weiterleitung erfolgt zu einer individuellen URL.                                        |


### Experteneinstellungen

In diesem Abschnitt ist vor allem das Hervorheben von Beiträgen interessant. Hervorgehobene Beiträge ermöglichen das 
Erstellen eines »virtuellen Archivs«, das aus den verschiedenen Archiven jeweils nur die hervorgehobenen Beiträge 
enthält. Dadurch kannst du z. B. eine übergreifende Liste wichtiger Nachrichten auf der Startseite ausgeben.

**CSS-Klasse:** Hier kannst du dem Beitrag eine CSS-Klasse hinzufügen.

**Kommentare deaktivieren:** Hier deaktivierst du die Kommentarfunktion für einen Beitrag.

**Beitrag hervorheben:** Hier markierst du einen Beitrag als hervorgehoben.


### Veröffentlichung {#veroeffentlichung}

Solange ein Beitrag nicht veröffentlicht ist, wird er auch nicht im Frontend angezeigt. Du kennst dieses Verhalten ja 
bereits von Seiten und Artikeln und wir werden ihm noch an etlichen weiteren Stellen in Contao begegnen. Zusätzlich zur 
manuellen Veröffentlichung hast du wie immer auch die Möglichkeit, Beiträge automatisch zu einem bestimmten Datum zu 
aktivieren.

**Beitrag veröffentlichen:** Hier kannst du den Beitrag veröffentlichen.

**Anzeigen ab:** Hier aktivierst du einen Beitrag zu einem bestimmten Datum.

**Anzeigen bis:** Hier deaktivierst du einen Beitrag zu einem bestimmten Datum.


## Inhalt für Nachrichtenbeiträge {#inhalt-fuer-nachrichtenbeitraege}

Nachdem wir die Einstellungen für den Beitrag vorgenommen haben, können wir diesem Inhaltselemente für die 
Ausgabe im »Produktleser« mitgeben, klicke dazu beim gewünschten Beitrag auf 
![Beitrag bearbeiten](/de/icons/edit.svg?classes=icon "Beitrag bearbeiten")  und danach auf 
![Ein neues Inhaltselement erstellen](/de/icons/new.svg?classes=icon "Ein neues Inhaltselement erstellen") **Neu**.

In den Nachrichtenbeiträgen stehen dir alle [Inhaltselemente](../../../artikelverwaltung/inhaltselemente/) von Contao 
zur Verfügung.
