---
title: "Datensätze auflisten"
description: "Contao speichert alle Informationen rund um deine Webseite in der Datenbank. Dazu zählen sowohl 
Backend-Daten wie Benutzer, Module, Seiten oder Artikel als auch Frontend-Daten wie Gästebucheinträge oder Kommentare."
url: "de/administrationsbereich/datensaetze-auflisten"
weight: 3
---

Contao speichert alle Informationen rund um deine Webseite in der Datenbank. Dazu zählen sowohl Backend-Daten wie
Benutzer, Module, Seiten oder Artikel als auch Frontend-Daten wie Gästebucheinträge oder Kommentare. Alle diese Daten
werden in verschiedenen Tabellen gesammelt und können dann im Backend aufgelistet, durchsucht, kopiert, verschoben,
gelöscht oder bearbeitet werden.


## Die verschiedenen Ansichten

Die drei häufigsten Formen von Auflistungen, die nachfolgend Ansichten genannt werden, sind die einfache Liste
(»List View«), die nach der übergeordneten Tabelle gruppierte Liste (»Parent View«) sowie die Baumansicht
(»Tree View«).


### List View

Hierbei handelt es sich um Datensätze einer einzelnen Tabelle, die in einer bestimmten Reihenfolge aufgelistet werden. 
Die Sortierung ist meistens alphabetisch, und die einzelnen Zeilen sind nach Anfangsbuchstaben gruppiert.

![Der List View](/backend/images/de/der-list-view.png)


### Parent View

Hierbei handelt es sich um Datensätze, die mit den Datensätzen einer zweiten Tabelle in einer Eltern-Kind-Beziehung 
stehen. Stelle dir zwei Warenkörbe und die darin enthaltenen Produkte vor. In jedem Warenkorb, also Elternelement, 
können beliebig viele Produkte, also Kindelemente, liegen.

In Contao kommen solche Eltern-Kind-Beziehungen sehr häufig vor, z. B. bei

- Artikeln und Inhaltselementen,
- Archiven und Nachrichtenbeiträgen oder
- Bildgrößen und Media-Queries.

Wenn du nun den Inhalt eines Warenkorbs auflistest, willst du natürlich nur die Produkte dieses einen Warenkorbs sehen 
und nicht die Produkte des zweiten. Daher zeigt Contao dir im Parent View auch nur die Kindelemente des jeweils 
ausgewählten Elternelements an.

![Der Parent View](/backend/images/de/der-parent-view.png)


### Tree View

Hierbei handelt es sich um Datensätze, die in einer hierarchischen Abhängigkeit zueinander stehen und daher in einer
Baumstruktur dargestellt werden. Typischerweise ist das bei einem Dateisystem der Fall, in dem es Verzeichnisse und 
Unterverzeichnisse gibt, deshalb nutzt die Contao-Dateiverwaltung auch diese Ansicht. Hierarchische Strukturen können aber
auch innerhalb einer Tabelle abgebildet werden, wie es z. B. bei der Seitenstruktur deiner Webseite der Fall ist.

![Der Tree View](/backend/images/de/der-tree-view.png)


## Datensätze sortieren und filtern {#datensaetze-sortieren-und-filtern}

Damit du auch bei Tabellen mit sehr vielen Datensätzen immer den Überblick behältst, bietet Contao dir verschiedene 
Möglichkeiten, Auflistungen zu sortieren und durch Filter einzuschränken. Die meisten Auflistungen lassen sich durch 
gezieltes Filtern so einschränken, dass dir nur die Datensätze angezeigt werden, die du auch wirklich für eine 
bestimmte Aktion benötigst.

![Datensätze sortieren und filtern](/backend/images/de/datensaetze-sortieren-und-filtern.png)

**Filtern:** Hier kannst du einen oder mehrere Filter setzen und dir so z. B. nur die Mitglieder anzeigen lassen, 
die männlich sind und Deutsch sprechen.

**Sortieren:** Hier legst du fest, nach welchem Feld die Auflistung sortiert wird.

**Suchen:** Hier kannst du ein Feld nach einem bestimmten Wert durchsuchen, sodass nur die Datensätze angezeigt werden, 
die den gesuchten Begriff enthalten. Die Abfrage unterstützt sogenannte 
[reguläre Ausdrücke](https://wiki.selfhtml.org/wiki/Perl/Regul%C3%A4re_Ausdr%C3%BCcke#zeichen), das heißt du kannst 
z. B. mit `^a` alle Datensätze abrufen, die mit dem Buchstaben A beginnen, oder analog mit `a$` alle diejenigen, die 
mit dem Buchstaben A enden. Äußerst hilfreich ist auch die Suche nach `meier|schmidt`, die sowohl den Account von 
Herrn Meier als auch den von Herrn Schmidt findet.

**Anzeigen:** Hier kannst du die Anzahl der Datensätze pro Seite begrenzen. Dieser Filter ist standardmäßig immer aktiv 
und auf 30 Datensätze eingestellt, da das Auflisten von mehreren Hundert Datensätzen eine ganze Zeit lang dauern kann.

Alle Filter können beliebig miteinander kombiniert werden. Aktive Filter werden gelb hinterlegt, sodass du auf einen
Blick erkennen kannst, welche Filter du gesetzt hast. Um einen Filter zu deaktivieren, wähle den obersten Eintrag aus
dem Drop-Down-Menü bzw. löschen den Suchbegriff aus dem Suchfeld.

Durch Klick auf folgende Icons können die Filter angewendet bzw. zurückgesetzt werden:

![Filter anwenden](/icons/filter-apply.svg?classes=icon) **Filter anwenden:** die Filter setzen und danach 
anwenden.

![Filter zurücksetzen](/icons/filter-reset.svg?classes=icon) **Filter zurücksetzen:** die Filter-Auswahl 
zurücksetzen.


## Die Navigationssymbole

Bestimmt sind dir die bunten Icons aufgefallen, die sich in jeder Ansicht rechts neben den einzelnen Datensätzen 
befinden. Mit diesen Navigationssymbolen kannst du einzelne Datensätze bearbeiten, kopieren, verschieben oder löschen. 
Je nach Modul kommen unter Umständen noch weitere Funktionen hinzu.


### Standard-Icons

Die folgenden Navigationssymbole kommen in fast allen Ansichten vor. Aus Gründen der Übersichtlichkeit sind sie nicht 
zusätzlich mit einem Text versehen. Wenn du aber den Zeiger deiner Maus über einem Icon positionierst, wird dir die 
entsprechende Beschreibung dazu angezeigt.

![Bearbeiten](/icons/edit.svg?classes=icon) **Bearbeiten:** ruft einen bestimmten Datensatz im Bearbeitungsmodus 
auf.

![Duplizieren](/icons/copy.svg?classes=icon) **Duplizieren:** erstellt eine Kopie eines vorhandenen Datensatzes.

![Löschen](/icons/delete.svg?classes=icon) **Löschen:** löscht einen Datensatz. 
([Dieser Vorgang kann widerrufen werden.](#geloeschte-datensaetze-wiederherstellen))

![Veröffentlichen/unveröffentlichen](/icons/visible.svg?classes=icon) **Veröffentlichen/unveröffentlichen:** im 
Frontend anzeigen bzw. ausblenden

![Info](/icons/show.svg?classes=icon) **Info:** zeigt Informationen zu einem Datensatz.


### Icons im List View

Der List View kann neben den grundlegenden Befehlen, noch folgende zusätzlichen Befehle anbieten.

![Icons im List View](/backend/images/de/icons-im-list-view.png)

![Einstellungen bearbeiten](/icons/header.svg?classes=icon) **Einstellungen bearbeiten:** die Einstellungen für 
das Eltern-Element anpassen.


### Icons im Parent View

Der Parent View bietet zwei zusätzliche Icons, um die Reihenfolge der Datensätze festlegen zu können. Die Reihenfolge 
kann auch mittels Drag & Drop geändert werden. Dazu einfach auf das Drag & Drop-Icon 
![Verschieben](/icons/drag.svg?classes=icon) klicken und an die neue Position bewegen.

![Icons im Parent View](/backend/images/de/icons-im-parent-view.png)

![Verschieben](/icons/cut.svg?classes=icon) **Verschieben:** verschiebt einen Datensatz an eine andere Position.

![Neues Element](/icons/new.svg?classes=icon) **Neues Element:** erstellt einen neuen Datensatz nach dem 
aktuellen Datensatz.

![Einfügen](/icons/pasteafter.svg?classes=icon) **Einfügen:** fügt einen Datensatz nach dem aktuellen Datensatz 
ein.

**![Datei oder Verzeichnis verschieben](/icons/drag.svg?classes=icon) Verschieben:** Eine Datei bzw. einen 
Ordner per Drag & Drop verschieben.


### Icons im Tree View

Im Tree View, der Baumansicht, gibt es noch weitere Icons, die aufgrund der hierarchischen Beziehungen der Datensätze 
untereinander notwendig sind. Du brauchst beispielsweise eine Möglichkeit, beim Verschieben oder Duplizieren von 
Datensätzen festzulegen, ob diese nach einem Datensatz in derselben Ebene oder unterhalb eines Datensatzes in einer 
neuen Ebene eingefügt werden sollen.

![Icons im Tree View](/backend/images/de/icons-im-tree-view.png)

![Unterseiten duplizieren](/icons/copychilds.svg?classes=icon) **Unterseiten duplizieren:** dupliziert eine 
Seite inklusive aller Unterseiten.

![Seite bearbeiten](/icons/article.svg?classes=icon) **Seite bearbeiten:**  die Seite bearbeiten.

![Dahinter einfügen](/icons/pasteafter.svg?classes=icon) **Dahinter einfügen:** fügt eine Seite nach der 
aktuellen Seite ein.

![Darunter einfügen](/icons/pasteinto.svg?classes=icon) **Darunter einfügen:** fügt eine Seite unterhalb der 
aktuellen Seite ein.

![Artikel bearbeiten](/icons/article.svg?classes=icon) **Artikel bearbeiten:** den Artikel der Seite bearbeiten.


## Das Klemmbrett

Das Klemmbrett ist keine eigene Anwendung, die du irgendwo aufrufen und anschauen kannst. Es ist automatisch im 
Hintergrund aktiv und merkt sich die Datensätze, die du duplizieren oder verschieben möchtest. Auf diese Weise ist es 
möglich, Datensätze auch über die Grenzen eines Elternelements hinaus zu bewegen.

Du kannst dir das Klemmbrett wie die Zwischenablage auf deinem Rechner vorstellen, in die du mit `[Ctrl]+[c]` bestimmte 
Daten kopieren und mit `[Ctrl]+[v]` an einer anderen Stelle wieder einfügen kannst. In Contao kannst du so z. B. 
Inhaltselemente von einem Artikel in einen anderen verschieben.

![Inhaltselemente mittels Klemmbrett verschieben](/backend/images/de/inhaltselemente-mittels-klemmbrett-verschieben.png)


## Gelöschte Datensätze wiederherstellen {#geloeschte-datensaetze-wiederherstellen}

Wann immer du einen oder mehrere Datensätze löschst, werden diese nicht sofort aus der Datenbank entfernt, sondern in 
einen virtuellen Papierkorb verschoben. Aus diesem Papierkorb kannst du die Daten jederzeit wieder hervorholen und an 
der ursprünglichen Stelle wiederherstellen.

Du findest den »Papierkorb« im Navigationsbereich in der Gruppe System unter dem Punkt Wiederherstellen. Dort siehst du 
eine Liste aller gelöschten Datensätze, die du entweder nach dem Datum der Löschung oder dem Ursprung des Datensatzes 
sortieren kannst. Mit einem Klick auf das entsprechende Navigationssymbol 
![Eintrag wiederherstellen](/icons/undo.svg?classes=icon) 
kannst du einen Löschvorgang rückgängig machen.

![Einen Löschvorgang rückgängig machen](/backend/images/de/einen-loeschvorgang-rueckgaengig-machen.png)
