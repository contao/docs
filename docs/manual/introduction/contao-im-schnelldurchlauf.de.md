---
title: "Contao im Schnelldurchlauf"
description: "In diesem Abschnitt werden dir die grundsätzlichen Zusammenhänge und Funktionsweisen von Contao in 
komprimierter Form vorgestellt."
url: "einleitung/contao-im-schnelldurchlauf"
weight: 3
---

In diesem Abschnitt stelle ich dir die grundsätzlichen Zusammenhänge und Funktionsweisen von Contao in komprimierter 
Form vor. Du brauchst dir als CMS-Einsteiger nichts dabei denken, wenn du den einen oder anderen Begriff noch nie 
gehört hast. Es wird alles in den nachfolgenden Texten noch einmal ausführlich erklärt.


## Backend und Frontend

Contao ist in zwei Bereiche unterteilt. Das »Backend« ist der Administrationsbereich, in dem die ganze Arbeit wie z. B. 
das Schreiben von Artikeln erfolgt. Das »Frontend« ist die eigentliche Webseite, auf der die geschriebenen Artikel 
anschließend von Besuchern gelesen werden können.

Der Zugriff auf das Backend, also den Administrationsbereich, ist grundsätzlich nur registrierten Benutzern möglich, 
die sich mit ihrem Benutzernamen und Passwort anmelden müssen, bevor sie Änderungen an der Webseite vornehmen können. 
Das Frontend, also die eigentliche Webseite, ist hingegen standardmäßig öffentlich erreichbar.

Das Backend rufst du auf, indem du `/contao` an die URL deiner Webseite anfügst.


## Benutzer und Mitglieder

Die Trennung zwischen Backend und Frontend setzt sich auch in der Benutzerverwaltung fort. In Contao unterscheidet man 
zwischen »Benutzern«, die Zugriff auf das Backend haben, und »Mitgliedern«, die Zugriff auf das Frontend haben. Da die 
Webseite wie schon gesagt standardmäßig öffentlich erreichbar ist, ist das Anlegen von Mitgliedern optional und nur 
dann notwendig, wenn du beispielsweise einen geschützten, nichtöffentlichen Bereich einrichten möchtest. In der 
Minimalkonfiguration kommst du mit einem einzigen Benutzer, nämlich dem Administrator, und ganz ohne Mitglieder aus.


## Alles dreht sich um die Seitenstruktur

Contao ist ein seitenbasiertes Content Management System, das heißt, die Seitenstruktur ist das zentrale Element deiner 
Webseite. Ein Besucher kann immer nur eine bestimmte Seite in seinem Browser aufrufen und nicht z. B. einen einzelnen 
Beitrag, wie es in anderen Systemen der Fall ist. Dieser Ansatz ist sehr flexibel, weil eine Seite beliebig viele 
Inhalte haben kann und du nicht auf einen einzigen Beitrag beschränkt bist.

Die Seitenstruktur ist hierarchisch organisiert, du kannst die einzelnen Seiten also ineinander verschachteln und so 
beliebig verzweigte Unterseiten erstellen. Contao erstellt im Frontend automatisch aus der hierarchischen Struktur die 
entsprechenden Navigationsmenüs mit allen Haupt- und Unterseiten. Wenn du eine neue Seite im Backend hinzufügst oder die
Reihenfolge der Seiten anpasst, wird diese Änderung sofort auf der Webseite sichtbar.

![Die Seitenstruktur](/introduction/images/de/die-seitenstruktur.png)


## Jede Seite hat ein Seitenlayout

Jede Seite ist mit einem Seitenlayout verknüpft, das ihren Aufbau festlegt und sie in sogenannte Layoutbereiche 
unterteilt. Der Seitenaufbau wird in Contao nämlich nicht durch statische Template-Dateien bestimmt, sondern durch 
beliebig per Mausklick zusammenstellbare Seitenlayouts, die dank des integrierten CSS-Frameworks dynamisch zur Laufzeit
zu einem »virtuellen Template« zusammengesetzt werden. Solange du also nicht mindestens ein Seitenlayout angelegt hast, 
weiß Contao nicht, wie es die Inhalte deiner Webseite ausgeben soll, und quittiert den Dienst daher mit einem kurzen 
»No layout specified«. Standardmäßig hast du die Auswahl aus folgenden Layoutbereichen:

- Kopfzeile
- linke Spalte
- Hauptspalte
- rechte Spalte
- Fußzeile

Darüber hinaus unterstützt Contao das Hinzufügen beliebiger eigener Layoutbereiche zur Umsetzung komplexerer Aufbauten 
und bei Bedarf sogar die Einbindung eines externen Layouts oder die Verwendung eines komplett anderen CSS-Frameworks.


## Jedes Seitenlayout besteht aus Modulen

Innerhalb der in einem Seitenlayout aktivierten Layoutbereiche kannst du beliebige Frontend-Module platzieren, die beim 
Aufruf einer Seite der Reihenfolge nach ausgeführt werden und den HTML-Code für das Frontend erzeugen.

![Die Frontend-Module](/introduction/images/de/die-frontend-module.png)

Genau wie Seitenlayouts können auch Frontend-Module per Mausklick angelegt und konfiguriert werden. Contao enthält 
bereits ab Werk etliche Modultypen, z. B. zur Erstellung von Navigationsmenüs, zur Verwaltung von Benutzern oder zum 
Einfügen von Formularen. Darüber hinaus kannst du über Erweiterungen beliebige weitere Frontend-Module hinzufügen.

Nun wirst du sicherlich anmerken, dass vorher gerade noch geschrieben wurde, dass du genau genommen nicht einmal 
HTML können musst, um Contao zu nutzen. Diese Aussage steht klar im Widerspruch zu dem Zitat. Oder doch nicht?

Tatsächlich kannst du Contao einsetzen, ohne HTML und CSS zu beherrschen. Wenn du z. B. als Redakteur Artikel für eine 
Webseite schreibst, muss dich das Thema CSS nicht interessieren. Gleiches gilt, wenn du ein Theme von einem dritten 
Designer installiert hast und nur die Seitenstruktur und die Inhalte selbst erstellst. In beiden Fällen kannst du das
vorgefertigte Design problemlos verwenden – solange du keine Änderungen daran vornehmen willst. Die Definition des 
Contao-Teams gilt also wirklich nur für Webmaster, die alle Bereiche der Webseite selbst bearbeiten, und nicht für 
Redakteure.


## Das Design kann als Theme exportiert werden

Wenn dein Design fertig ist, kannst du alle designrelevanten Elemente als sogenanntes Theme exportieren. Dazu gehören 
Stylesheets, Frontend-Module, Seitenlayouts, Dateien und eventuell angepasste Templates. Das Theme lässt sich dann in 
einer anderen Contao-Installation wieder importieren, sodass du dein Design problemlos wiederverwenden oder weitergeben 
kannst. Selbstverständlich kannst du auf diesem Weg auch Themes anderer Designer importieren und für deine Webseite 
verwenden.


## Inhalte werden als Artikel gespeichert

Die eigentlichen Inhalte – bisher ging es ja nur um den Seitenaufbau und das Design – werden in Contao als Artikel 
gespeichert. Jeder Artikel besteht wiederum aus Inhaltselementen, die für jeden Inhaltstyp wie z. B. Texte, Bilder oder 
Tabellen eine entsprechende Ein- und Ausgabefunktion bereitstellen.

![Das Inhaltselement »Auflistung« im Backend](/introduction/images/de/das-inhaltselement-auflistung-im-backend.png)

Das Konzept der Inhaltselemente hat viele Vorteile. Zum Beispiel reduziert sich das Risiko von redundantem oder sogar 
invalidem HTML-Code gegenüber der Verwendung eines Rich Text Editors, weil jedes Element separat generiert wird. 
Darüber hinaus ist es ein Leichtes, einzelne Elemente zwischen verschiedenen Artikeln zu verschieben oder die 
Reihenfolge der Elemente zu verändern. Letzteres geht dank Ajax sogar per Drag & Drop.


## Jeder Artikel ist einer Seite zugeordnet

Jeder Artikel ist fest mit einer bestimmten Seite verknüpft. Pro Seite können beliebig viele Artikel angelegt und 
verschiedenen Layoutbereichen zugewiesen werden. Du bist in Contao also nicht auf einen Artikel in der Hauptspalte 
beschränkt, sondern kannst beispielsweise fünf Artikel in der Hauptspalte und einen weiteren in der Seitenspalte 
anlegen. Der Besucher ruft ja letztendlich die Seite auf und nicht einen bestimmten Artikel (vgl. Abschnitt 
[Alles dreht sich um die Seitenstruktur](#alles-dreht-sich-um-die-seitenstruktur)).

Eine Ausnahme von diesem Konzept der statischen Artikel sind dynamische Beiträge wie z. B. Nachrichten oder Events. 
Diese werden in separaten Backend-Modulen verwaltet und mit speziellen Frontend-Modulen wie z. B. einer 
Nachrichtenliste oder einem Kalender ausgegeben. Ich erwähne das an dieser Stelle, weil du dich eventuell schon 
gefragt hast, ob du tatsächlich für jeden Blog-Beitrag eine eigene Seite plus einen Artikel anlegen musst. Dies ist 
aber natürlich nicht der Fall und wäre bei einem aktiven Blog oder einem Kalender mit vielen Einträgen auch sicherlich 
nicht praktikabel.
