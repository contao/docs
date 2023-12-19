---
title: "FAQ-Verwaltung"
description: "Die FAQ-Verwaltung ist ein eigenes Modul im Backend, das du in der Gruppe »Inhalte« findest."
url: "core-erweiterung/faq/faq-verwaltung"
aliases:
    - /de/core-erweiterung/faq/faq-verwaltung/
weight: 10
---

Die FAQ-Verwaltung ist ein eigenes Modul im Backend, das du in der Gruppe »Inhalte« findest. Du 
kannst dort mehrere Kategorien anlegen, die wiederum die einzelnen Fragen enthalten. Durch die Verwendung mehrerer 
Kategorien kannst du FAQs thematisch, nach Sprache oder nach Webseite (Multidomain-Betrieb) zusammenfassen.


## Kategorien

Kategorien werden zur Gruppierung von FAQs verwendet. Jede Kategorie kann sich auf eine bestimmte Sprache oder ein 
bestimmtes Thema beziehen.

Um eine neue Kategorie anzulegen klicke auf 
![Eine neue Kategorie anlegen]({{% asset "icons/new.svg" %}}?classes=icon "Eine neue Kategorie anlegen") 
**Neu**.


### Titel und Weiterleitung

**Titel:** Der Titel einer Kategorie wird nur in der Backend-Übersicht verwendet.

**Überschrift:** Die Überschrift einer Kategorie wird dagegen im Frontend angezeigt.

**Weiterleitungsseite:** Hier legst du fest, auf welche Seite ein Besucher beim Anklicken einer FAQ weitergeleitet 
wird. Die Zielseite sollte das Modul »FAQ-Leser« enthalten, um die Antwort auf die Frage darzustellen.


### Kommentare

Die Contao-Kommentarfunktion kennst du bereits von der »News/Blog«-Erweiterung bzw. dem gleichnamigen 
[Inhaltselement (Kommentare)](../../../artikelverwaltung/inhaltselemente/#kommentare). Sie steht auch für FAQs zur 
Verfügung.

**Kommentare aktivieren:** Hier aktivierst du die Kommentarfunktion für die Kategorie..

**Benachrichtigung an:** Hier legst du fest, ob bei neuen Kommentaren der Systemadministrator, der Autor einer Frage 
oder beide benachrichtigt werden.

**Sortierung:** Hier legst du die Reihenfolge der Kommentare fest.

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

**Spam-Schutz deaktivieren:** Standardmäßig müssen Besucher beim Erstellen von Kommentaren eine Sicherheitsfrage 
beantworten, damit die Kommentarfunktion nicht zu Spam-Zwecken missbraucht werden kann. Falls du aber ohnehin nur 
angemeldeten Mitgliedern das Kommentieren erlauben möchtest, kannst du die Sicherheitsfrage hier deaktivieren.
Seit Contao 4.4 wird diese Frage nur noch den Spambots »angezeigt«.


## Fragen

In diesem Abschnitt wird dir erklärt, wie du eine Frage anlegst. Die Reihenfolge der Fragen innerhalb einer Kategorie 
kannst du per Drag-and-Drop mit den entsprechenden 
Navigationssymbol ![Frage verschieben]({{% asset "icons/drag.svg" %}}?classes=icon "Frage verschieben") festlegen.

Um eine neue Frage anzulegen, klicke auf 
![Eine neue Frage erstellen]({{% asset "icons/new.svg" %}}?classes=icon "Eine neue Frage erstellen") **Neu**.


### Titel und Autor

**Frage:** Hier kannst du die Frage eingeben.

**FAQ-Alias:** Der Alias einer Frage ist eine eindeutige und aussagekräftige Referenz, über die du diese in deinem 
Browser aufrufen kannst.

**Autor:** Hier kannst du den Autor der Frage ändern.


### Antwort

**Antwort:** Gebe hier die Antwort auf die Frage ein. Die Eingabe erfolgt wie beim Inhaltselement »Text« mit dem Rich 
Text Editor.


### Bildeinstellungen

**Ein Bild hinzufügen:** Bei Bedarf kannst du dem Beitrag ein Bild hinzufügen.

**Quelldatei:** Hier wählst du das einzufügende Bild aus. Wenn du das Bild noch nicht auf den Server übertragen hast, 
kannst du es direkt im Popup-Fenster nachholen, ohne die Eingabemaske zu verlassen.

![Einer FAQ ein Bild hinzufügen]({{% asset "images/manual/core-extensions/faq/de/einer-faq-ein-bild-hinzufuegen.png" %}}?classes=shadow)

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

**Bildausrichtung:** Hier legst du die Ausrichtung des Bildes fest. Wird es 
![oberhalb]({{% asset "icons/above.svg" %}}?classes=icon) **oberhalb**, 
![unterhalb]({{% asset "icons/below.svg" %}}?classes=icon) **unterhalb**, 
![linksbündig]({{% asset "icons/left.svg" %}}?classes=icon) **linksbündig** oder 
![rechtsbündig]({{% asset "icons/right.svg" %}}?classes=icon) **rechtsbündig** eingefügt. Bei **links-** oder **rechtsbündig** 
umfließt der Text das Bild (wie im Icon symbolisiert).

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

Anlagen sind Dateien, die mit einer FAQ verknüpft sind. Diese Dateien werden im Frontend-Modul »FAQ-Leser« zum 
Download angeboten.

**Anlagen hinzufügen:** Hier aktivierst du das Hinzufügen von Anlagen.

**Anlangen:** Hier wählst du die Dateien aus, die du mit der FAQ verknüpfen möchtest.


### Experteneinstellungen

**Kommentare deaktivieren:** Hier deaktivierst du die Kommentarfunktion für eine Frage.


### Veröffentlichung {#veroeffentlichung}

Solange eine FAQ nicht veröffentlicht ist, wird sie auch nicht im Frontend angezeigt.

**Frage veröffentlichen:** Hier kannst du die Frage veröffentlichen.
