---
title: "Datensätze bearbeiten"
description: "Das komfortable Bearbeiten von Daten zu ermöglichen, ist eine der Hauptaufgaben eines CMS – zumindest 
sollte es so sein."
url: "administrationsbereich/datensaetze-bearbeiten"
aliases:
    - /de/administrationsbereich/datensaetze-bearbeiten/
weight: 40
---

Das komfortable Bearbeiten von Daten zu ermöglichen, ist eine der Hauptaufgaben eines CMS. Folgende Möglichkeiten in 
Contao erleichtern dir die Datenpflege und bringen dich schneller ans Ziel.


## Die Sticky-Tab-Navigationsliste

{{< version "5.3" >}}

Wenn der zu bearbeitende Datensatz sehr lang und in einzelne Abschnitte durch Legenden unterteilt ist, musste man bis 
jetzt endlos nach unten Scrollen (z. B. beim Einrichten einer Benutzergruppe). Damit ist nun Schluss, denn es gibt die 
Sticky-Tab-Navigationsliste. Diese Navigationsliste wird automatisch aus allen Legenden in einem Datensatz erstellt.

![Die Sticky-Tab-Navigationsliste]({{% asset "images/manual/administration-area/de/die-sticky-tab-navigationsliste.png" %}}?classes=shadow)


## Der Picker

Der Picker wird an vielen verschiedenen Orten eingesetz und ist deshalb zu einem unersetzbaren Werkzeug in Contao 
geworden.

Im Folgenden einige Beispiele:

**Beim Einfügen bzw. Bearbeiten eines Links in einem Inhaltselement**

![Link einfügen bzw. bearbeiten]({{% asset "images/manual/administration-area/de/link-einfuegen-bzw-bearbeiten.png" %}}?classes=shadow)

{{< version-tag "5.3" >}} **Beim Bearbeiten einer Bildgröße in einem Inhaltselement**

![Bildgröße bearbeiten]({{% asset "images/manual/administration-area/de/bildgroesse-bearbeiten.png" %}}?classes=shadow)

**Beim Bearbeiten eines Quellelementes in einem Inhaltselement**

![Quellelement bearbeiten]({{% asset "images/manual/administration-area/de/quellelement-bearbeiten.png" %}}?classes=shadow)

{{< version-tag "5.3" >}} **Beim Bearbeiten eines Weiterleitungszieles in einer News oder einem Event vom Typ »Seite« 
oder »Artikel«**

![Weiterleitungsziel bearbeiten]({{% asset "images/manual/administration-area/de/weiterleitungsziel-bearbeiten.png" %}}?classes=shadow)


## Optionen beim Speichern

Contao bietet dir immer mehrere Schaltflächen zum Speichern deiner Eingaben an. Jede Schaltfläche bringt dich nach dem 
Speichern an einen anderen Ort, je nachdem, was du als Nächstes erledigen möchtest.

**Speichern:** Beim Klick auf diese Schaltfläche werden deine Eingaben gespeichert, und die Eingabemaske neu geladen. 
Du kannst den Datensatz weiter bearbeiten.

**Speichern und schließen:** Beim Klick auf diese Schaltfläche werden deine Eingaben gespeichert und das Formular 
geschlossen. Du gelangst zurück zur vorherigen Seite.

**Speichern und neu:** Beim Klick auf diese Schaltfläche werden deine Eingaben gespeichert, und ein neues Element wird 
nach dem gerade bearbeiteten Element eingefügt. Du gelangst direkt zur Bearbeitungsmaske des neuen Datensatzes.

**Speichern und duplizieren:** Beim Klick auf diese Schaltfläche werden deine Eingaben gespeichert, das 
gespeicherte Element wird dupliziert und nach dem gerade bearbeiteten Element eingefügt. Du gelangst direkt zur 
Bearbeitungsmaske des neuen Datensatzes.

**Speichern und bearbeiten:** Diese Schaltfläche steht dir nur beim Erstellen neuer Elemente zur Verfügung. Beim 
Anklicken werden deine Eingaben gespeichert, und die gelangst direkt zur Bearbeitungsansicht der Kind-Datensätze 
(Parent View).

**Speichern und zurück:** Beim Klick auf diese Schaltfläche werden deine Eingaben gespeichert, und das Formular 
geschlossen. Du wirst auf die übergeordnete Seite weitergeleitet, also z. B. von einem Inhaltselement direkt zur 
Artikelübersicht.

Zu den [Tastaturkürzel im Bearbeitungsmodus](../backend-tastaturkuerzel/#tastaturkuerzel-im-bearbeitungsmodus).


## Mehrere Datensätze auf einmal bearbeiten {#mehrere-datensaetze-auf-einmal-bearbeiten}

In Contao kannst du sehr komfortabel mehrere Datensätze auf einmal bearbeiten, anstatt jeden Datensatz einzeln aufrufen 
und ändern zu müssen. Klicke dazu auf den Link `Mehrere bearbeiten`. Wie du siehst, werden die Navigationssymbole
automatisch durch Checkboxen ersetzt, mit denen du die zu bearbeitenden Datensätze auswählen kannst.

![Mehrere Datensätze bearbeiten]({{% asset "images/manual/administration-area/de/mehrere-datensaetze-bearbeiten.png" %}}?classes=shadow)

**Bearbeiten:** Die ausgewählten Datensätze können bearbeitet werden.

**Löschen:** Die ausgewählten Datensätze werden gelöscht.

**Kopieren:** Die ausgewählten Datensätze werden mithilfe des Klemmbretts dupliziert.

**Verschieben:** Die ausgewählten Datensätze werden mithilfe des Klemmbretts verschoben.

**Überschreiben:** Die ausgewählten Datensätze können überschrieben werden.

**Aliase generieren:** Die Aliase der ausgewählten Datensätze werden neu generiert.

Zu den [Tastaturkürzel im Modus »Mehrere bearbeiten«](../backend-tastaturkuerzel/#tastaturkuerzel-im-modus-mehrere-bearbeiten).

Nutze die Überschreiben-Funktion mit Bedacht, denn hier werden tatsächlich alle bereits vorhandenen Werte der 
ausgewählten Datensätze durch den neuen Wert ersetzt!

Ein Klick auf `Überschreiben` oder `Bearbeiten` führt dich zur Übersicht der Felder, die in der Tabelle vorhanden sind. 
Wähle dort gezielt die Eingabefelder aus, die du überschreiben bzw. bearbeiten möchtest, und klicke auf `Weiter`.

![Die zu bearbeitenden Eingabefelder auswählen]({{% asset "images/manual/administration-area/de/die-zu-bearbeitenden-eingabefelder-auswaehlen.png" %}}?classes=shadow)

Du siehst jetzt die ausgewählten Eingabefelder der selektierten Datensätze und kannst diese bequem in einem einzigen 
Arbeitsschritt ändern. Auch bei der Bearbeitung mehrerer Datensätze werden dir natürlich nur die Eingabefelder 
angezeigt, die du auch tatsächlich für dein Vorhaben benötigst.

![Nur die ausgewählten Eingabefelder werden angezeigt]({{% asset "images/manual/administration-area/de/nur-die-ausgewaehlten-eingabefelder-werden-angezeigt.png" %}}?classes=shadow)

Analog zu diesem Beispiel hättest du mit der Funktion »Überschreiben« die Sprache aller Seiten in einem Rutsch mit
einem neuen Wert überschreiben können. Und die Funktion kann noch mehr: Eventuell kommst du irgendwann in die
Verlegenheit, dass du eine neue Mitgliedergruppe angelegt hast und diese nun bei den Zugriffsrechten mehrerer Seiten
ergänzen möchtest, ohne dabei die bestehende Zuordnung zu löschen. Auch das kannst du mit der »Überschreiben«-Funktion 
erledigen, indem du den passenden Update-Modus auswählst.

![Auswahl des Update-Modus beim Überschreiben von Datensätzen]({{% asset "images/manual/administration-area/de/auswahl-des-update-modus-beim-ueberschreiben-von-datensaetzen.png" %}}?classes=shadow)

**Ausgewählte Werte hinzufügen:** Die bestehenden Werte bleiben erhalten und werden durch die neu ausgewählten Werte 
ergänzt. Eine Seite, der bereits die Gruppe *Piano Students* zugewiesen ist, hätte also nach dem Speichern die Gruppen 
*Piano Students* und *Violin Students*.

**Ausgewählte Werte entfernen:** Von den bestehenden Werten werden die neu ausgewählten Werte (soweit vorhanden) 
entfernt. Unsere Seite mit den Gruppen *Piano Students* und *Violin Students* hätte also nach dem Speichern nur noch 
die Gruppe *Piano Students*.

**Bestehende Einträge überschreiben:** Die bestehenden Werte werden gelöscht und durch die neu ausgewählten Werte 
ersetzt. Unsere Seite hätte also nach dem Speichern nur die Gruppe *Violin Students*, egal welche Gruppen vorher 
zugewiesen waren.


## Verschiedene Versionen eines Datensatzes

Contao legt bei jedem Speichervorgang automatisch eine neue Version des bearbeiteten Datensatzes an, sodass du 
Änderungen jederzeit rückgängig machen kannst. Sobald mehr als eine Version vorhanden ist, erscheint oberhalb der 
Eingabemaske ein Drop-Down-Menü, in dem die verschiedenen Versionen sowie deren Datum und Ersteller aufgelistet
sind. Mit einem Klick auf `Wiederherstellen` kannst du eine frühere Version wiederherstellen.

![Frühere Versionen eines Datensatzes wiederherstellen]({{% asset "images/manual/administration-area/de/fruehere-versionen-eines-datensatzes-wiederherstellen.png" %}}?classes=shadow)

Durch Klick auf das Icon ![Unterschiede anzeigen]({{% asset "icons/diff.svg" %}}?classes=icon) neben dem Drop-Down-Menüs werden 
die Unterschiede zwischen der aktuellen und der gewählten Version angezeigt.

![Unterschiede zwischen den gewählten Versionen]({{% asset "images/manual/administration-area/de/unterschiede-zwischen-den-gewaehlten-versionen.png" %}}?classes=shadow)
