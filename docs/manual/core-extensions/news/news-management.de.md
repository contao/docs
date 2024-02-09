---
title: "Nachrichtenverwaltung"
description: "Die Nachrichtenverwaltung ist ein eigenes Modul im Backend, das du in der Gruppe »Inhalte« findest."
url: "core-erweiterung/nachrichten/nachrichtenverwaltung"
aliases:
    - /de/core-erweiterung/nachrichten/nachrichtenverwaltung/
weight: 10
---

Die Nachrichtenverwaltung ist ein eigenes Modul im Backend, das du in der Gruppe »Inhalte« findest. 
Du kannst dort mehrere Archive anlegen, die wiederum die einzelnen News- bzw. Blog-Beiträge enthalten. Durch die 
Verwendung mehrerer Archive ist eine Kategorisierung der Beiträge möglich.


## Nachrichtenarchive

Archive werden zur Gruppierung und/oder Kategorisierung von Nachrichten verwendet. Jedes Archiv kann sich auf eine 
bestimmte Sprache oder ein bestimmtes Thema beziehen.

Um ein neues Nachrichtenarchiv anzulegen klicke auf 
![Ein neues Nachrichtenarchiv erstellen]({{% asset "icons/new.svg" %}}?classes=icon "Ein neues Nachrichtenarchiv erstellen") 
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
[Include-Element (Kommentare)](/de/artikelverwaltung/inhaltselemente/include-elemente/#kommentare). Sie steht auch für 
News- bzw. Blog-Beiträge zur Verfügung und sollte auf jeden Fall aktiviert werden, wenn du die Erweiterungen als Blog 
nutzt.

**Kommentare aktivieren:** Hier aktivierst du die Kommentarfunktion für das Archiv.

**Benachrichtigung an:** Hier legst du fest, ob bei neuen Kommentaren der Systemadministrator, der Autor eines Beitrags 
oder beide benachrichtigt werden.

**Sortierreihenfolge:** Hier legst du die Reihenfolge der Kommentare fest. Normalerweise wird in einem Blog der älteste 
Kommentar zuerst angezeigt (aufsteigend). 

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
| `[img][/img]`                        | Bild einfügen                              |
| `[code][/code]`                      | Programmcode einfügen                      |
| `[color=#f00][/color]`               | Farbiger Text                               |
| `[quote][/quote]`                    | Zitat einfügen                             |
| `[quote=Tim][/quote]`                | Zitat mit Nennung des Urhebers einfügen    |
| `[url][/url]`                        | Link einfügen                              |
| `[url=http://example.com][/url]`     | Link mit Linktitel einfügen                |
| `[email][email]`                     | E-Mail-Adresse einfügen                    |
| `[email=info@example.com][/email]`   | E-Mail-Adresse mit Titel einfügen          |

**Login zum Kommentieren benötigt:** Wenn du diese Option auswählst, können nur angemeldete Mitglieder Kommentare 
hinzufügen. Die bereits abgegebenen Kommentare sind aber weiterhin für alle Besucher der Webseite sichtbar.

**Spam-Schutz deaktivieren:** Standardmäßig müssen Besucher beim Erstellen von Kommentaren eine Sicherheitsfrage 
beantworten, damit die Kommentarfunktion nicht zu Spam-Zwecken missbraucht werden kann. Falls du aber ohnehin nur 
angemeldeten Mitgliedern das Kommentieren erlauben möchtest, kannst du die Sicherheitsfrage hier deaktivieren.
Seit Contao 4.4 wird diese Frage nur noch den Spambots »angezeigt«.


## RSS-Feeds

{{< tabs groupId="contaoVersion">}}
{{% tab name="Contao  4" %}}
Jedes News- bzw. Blog-Archiv kann auf Wunsch als RSS/Atom-Feed exportiert werden. RSS-Feeds sind XML-Dateien mit deinen
Beiträgen, die mit einem RSS-Reader abonniert und z. B. in eine andere Webseite eingebunden werden können.

Die Feeds können über das [Seitenlayout](/de/layout/theme-manager/seitenlayouts-verwalten/#rss-atom-feeds) im Kopfbereich
der Seite eingebaut werden. Mit »Kopfbereich« ist dabei nicht die Kopfzeile deines Seitenlayouts gemeint, sondern das
`head`-Tag des HTML-Quelltextes.

Um einen neuen Feed anzulegen klicke auf ![RSS-Feeds verwalten]({{% asset "icons/rss.svg" %}}?classes=icon "RSS-Feeds verwalten")
**RSS-Feeds** und danach auf ![Einen neuen Feed erstellen]({{% asset "icons/new.svg" %}}?classes=icon "Einen neuen Feed erstellen")
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


### Bildeinstellungen

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben. Dabei kannst du zwischen folgenden Skalierungsmodi
auswählen:

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |

{{% /tab %}}
{{% tab name="Contao 5" %}}
Jedes News- bzw. Blog-Archiv kann auf Wunsch als RSS-, Atom- oder JSON-Feed exportiert werden. Feeds sind XML- und 
JSON-Dateien mit deinen Beiträgen, die mit einem RSS-Reader abonniert und z. B. in eine andere Webseite eingebunden 
werden können.

Um einen News-Feed zu erstellen, wähle im Bereich »Seiten« den Seitentyp »[News-Feed](/de/seitenstruktur/news-feed/)« 
aus und nehme die gewünschten Einstellungen für deinen Feed vor.

Die Feeds können über das [Seitenlayout](/de/layout/theme-manager/seitenlayouts-verwalten/#rss-atom-feeds) im Kopfbereich
der Seite eingebaut werden. Mit »Kopfbereich« ist dabei nicht die Kopfzeile deines Seitenlayouts gemeint, sondern das
`head`-Tag des HTML-Quelltextes.
{{% /tab %}}
{{< /tabs >}}


## Nachrichtenbeiträge {#nachrichtenbeitraege}

In diesem Abschnitt wird dir erklärt, wie du einen Nachrichtenbeitrag erstellst. Nachrichtenbeiträge werden 
grundsätzlich nach ihrem Datum sortiert, daher gibt es hier keine Icons, mit denen du die Reihenfolge ändern kannst.

Die Nachrichtenbeiträge bestehen aus den Einstellungen für die Beiträge (»Nachrichtenliste«) und aus deren Inhalten 
(»Nachrichtenleser«).

Um einen neuen Beitrag zu erstellen, klicke im gewünschten Archiv auf 
![Nachrichtenarchiv bearbeiten]({{% asset "icons/edit.svg" %}}?classes=icon "Nachrichtenarchiv bearbeiten") bzw.
![Nachrichtenarchiv bearbeiten]({{% asset "icons/children.svg" %}}?classes=icon "Nachrichtenarchiv bearbeiten") und danach auf 
![Einen neuen Beitrag erstellen]({{% asset "icons/new.svg" %}}?classes=icon "Einen neuen Beitrag erstellen") **Neu**.


### Titel und Autor

**Titel:** Hier kannst du den Titel der Nachricht eingeben.

**Beitrag hervorheben:** Hier kannst du den Beitrag in einer Liste mit hervorgehobener Nachrichten anzeigen.

**Nachrichtenalias:** Der Alias eines Beitrags ist eine eindeutige und aussagekräftige Referenz, über die du ihn
in deinem Browser aufrufen kannst.

**Autor:** Hier kannst du den Autor des Beitrags ändern.


### Datum und Zeit

**Datum:** Gebe hier das Datum des Beitrags ein.

**Uhrzeit:** Gebe hier die Uhrzeit des Beitrags ein.


### Weiterleitungsziel

Das Weiterleitungsziel bestimmt, auf welche Seite ein Besucher beim Anklicken eines Beitrags weitergeleitet wird.
Normalerweise ist das die Seite, auf der das Frontend-Modul »Nachrichtenleser« zur Darstellung des kompletten Beitrags
eingebunden ist.

**Weiterleitungsziel:** Hier legst du das Weiterleitungsziel fest.

| Weiterleitungsziel            | Erklärung                                                                                                                                                                      |
|:------------------------------|:-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Standard  <sup>1</sup>        | Die Weiterleitung erfolgt auf die Seite, die du in den Archiv-Einstellungen festgelegt hast. Auf dieser Seite sollte das Frontend-Modul »Nachrichtenleser« eingebunden sein.   |
| Seite <sup>2</sup>            | Die Weiterleitung erfolgt zu einer bestimmten Seite in der Seitenstruktur.                                                                                                     |
| Artikel <sup>3</sup>          | Die Weiterleitung erfolgt zu einem bestimmten Artikel.                                                                                                                         |
| Individuelle URL <sup>4</sup> | Die Weiterleitung erfolgt zu einer individuellen URL.                                                                                                                          |

**Link-Text:** Hier kannst du den Standard-Text des "Weiterlesen…"-Links überschreiben. <sup>1</sup> <sup>2</sup> <sup>3</sup> <sup>4</sup>

{{< version-tag "5.3" >}} **Kanonische URL:** Hier kannst du eine individuelle kanonische URL wie z. B. https://www.example.com/ festlegen. <sup>1</sup>

**Weiterleitungsseite:** Hier wählst du die Zielseite aus der Seitenstruktur aus. <sup>2</sup>

**Artikel:** Hier wählst du den Zielartikel aus. <sup>3</sup>

**Link-Adresse:** Hier gibst du die URL der externen Zielseite ein. <sup>4</sup>

**In neuem Fenster öffnen:** Lege fest, ob die externe Zielseite in einem neuen Browserfenster geöffnet werden soll. <sup>4</sup>


### Metadaten

**Meta-Titel:** Hier kannst du einen individuellen Meta-Titel eingeben, um den Standard-Seitentitel zu überschreiben.

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
*noindex,nofollow* von der Indexierung ausgenommen werden.

**Ausgabe im Quellcode:**
```html
<meta name="robots" content="index,follow">
``` 

**Meta-Beschreibung:** Hier kannst du eine individuelle Meta-Beschreibung eingeben, um die Standard-Seitenbeschreibung 
zu überschreiben.

**Ausgabe im Quellcode:**
```html
<meta name="description" content="Beschreibung der Seite (150 und 300 Zeichen).">
```

**Google Suchergebnis-Vorschau:** Hier kannst du sehen wie Google die Metadaten in den Suchergebnissen anzeigt. Andere
Suchmaschinen zeigen gegebenenfalls längere Texte an oder beschneiden diese an einer anderen Position.

![Google Suchergebnis-Vorschau]({{% asset "images/manual/layout/site-structure/de/google-suchergebnis-vorschau.png" %}}?classes=shadow)


### Unterüberschrift und Teaser {#unterueberschrift-und-teaser}

**Unterüberschrift:** Hier kannst du eine optionale Unterüberschrift eingeben.

**Teasertext:** Hier kannst du eine kurze Zusammenfassung des Nachrichtenbeitrags (Teaser) eingeben, die dann 
beispielsweise mit dem Modul »Nachrichtenliste«, gefolgt von einem Weiterlesen-Link zum eigentlichen Beitrag, 
dargestellt werden kann.


### Bildeinstellungen

**Ein Bild hinzufügen:** Bei Bedarf kannst du dem Beitrag ein Bild hinzufügen.

**Quelldatei:** Hier wählst du das einzufügende Bild aus. Wenn du das Bild noch nicht auf den Server übertragen hast, 
kannst du es direkt im Popup-Fenster nachholen, ohne die Eingabemaske zu verlassen.

**Großansicht/Neues Fenster:** Ist diese Option gewählt, wird das Bild beim Anklicken in seiner Originalgröße
geöffnet. Diese Option steht bei verlinkten Bildern nicht zur Verfügung.

![Einem Beitrag ein Bild hinzufügen]({{% asset "images/manual/core-extensions/news/de/einem-beitrag-ein-bild-hinzufuegen.png" %}}?classes=shadow)

**Bildgröße:** Hier kannst du die gewünschte Bildgröße angeben. Dabei kannst du zwischen folgenden Skalierungsmodi 
auswählen:

| Eigene Größen                                  |                                                                                                                           |
|:-----------------------------------------------|:--------------------------------------------------------------------------------------------------------------------------|
| Exaktes&nbsp;Format&nbsp;(wichtiger&nbsp;Teil) | Erhält den wichtigen Teil des Bildes wie in der Dateiverwaltung angegeben. Falls erforderlich, wird das Bild beschnitten. |
| Proportional                                   | Die längere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |
| An&nbsp;Rahmen&nbsp;anpassen                   | Die kürzere Seite des Bildes wird an die vorgegebenen Abmessungen angepasst und das Bild proportional verkleinert.        |

**Bildausrichtung:** Hier legst du die Ausrichtung des Bildes fest. Wird es  
![oberhalb]({{% asset "icons/above.svg" %}}?classes=icon) **oberhalb**, 
![unterhalb]({{% asset "icons/below.svg" %}}?classes=icon) **unterhalb**, 
![linksbündig]({{% asset "icons/left.svg" %}}?classes=icon) **linksbündig** oder 
![rechtsbündig]({{% asset "icons/right.svg" %}}?classes=icon) **rechtsbündig** eingefügt. Bei **links-** oder **rechtsbündig** 
umfließt der Text das Bild (wie im Icon symbolisiert).

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


### Experteneinstellungen

In diesem Abschnitt ist vor allem das Hervorheben von Beiträgen interessant. Hervorgehobene Beiträge ermöglichen das 
Erstellen eines »virtuellen Archivs«, das aus den verschiedenen Archiven jeweils nur die hervorgehobenen Beiträge 
enthält. Dadurch kannst du z. B. eine übergreifende Liste wichtiger Nachrichten auf der Startseite ausgeben.

**CSS-Klasse:** Hier kannst du dem Beitrag eine CSS-Klasse hinzufügen.

**Kommentare deaktivieren:** Hier deaktivierst du die Kommentarfunktion für einen Beitrag.


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
![Beitrag bearbeiten]({{% asset "icons/edit.svg" %}}?classes=icon "Beitrag bearbeiten") bzw.
![Beitrag bearbeiten]({{% asset "icons/children.svg" %}}?classes=icon "Beitrag bearbeiten") und danach auf 
![Ein neues Inhaltselement erstellen]({{% asset "icons/new.svg" %}}?classes=icon "Ein neues Inhaltselement erstellen") **Neu**.

In den Nachrichtenbeiträgen stehen dir alle [Inhaltselemente](../../../artikelverwaltung/inhaltselemente/) von Contao 
zur Verfügung.
