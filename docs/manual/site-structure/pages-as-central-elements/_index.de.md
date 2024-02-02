---
title: "Seiten als zentrale Elemente"
description: "Contao gehört zur Gruppe der seitenbasierten Content Management Systeme, das heißt, die Seitenstruktur 
ist das zentrale Element deiner Webseite."
url: "seitenstruktur/seiten-als-zentrale-elemente"
aliases:
    - /de/seitenstruktur/seiten-als-zentrale-elemente/
    - /de/layout/seitenstruktur/seiten-als-zentrale-elemente/
weight: 10
---

Contao gehört zur Gruppe der seitenbasierten Content Management Systeme, das heißt, die Seitenstruktur ist das zentrale 
Element deiner Webseite. Du kannst die darin enthaltenen Seiten über deren Alias im Frontend aufrufen 
und so die Inhalte ansehen, die sich auf der jeweiligen Seite befinden.

Stelle dir eine Seite wie eine Sendung im Fernsehen vor, für die Redakteure verschiedene Beiträge (Inhalte) erstellen. 
Am Ende entscheidet ein Chefredakteur, welche dieser Beiträge auch tatsächlich im Rahmen der Sendung ausgestrahlt 
(veröffentlicht) werden. Die übrigen Beiträge wurden zwar erstellt, finden aber nie den Weg in dein Wohnzimmer. Genauso 
funktioniert es auch in Contao. Du kannst beliebig viele Inhalte im Backend erstellen, die aber niemals auf deiner 
Webseite erscheinen werden, wenn sie nicht mit einer Seite (Sendung) verknüpft werden.


## Hierarchische Anordnung

Die Seitenstruktur ist hierarchisch organisiert. Du kannst die einzelnen Seiten ineinander verschachteln und so 
beliebig verzweigte Unterseiten erstellen, aus denen Contao im Frontend automatisch die entsprechenden Navigationsmenüs 
mit allen Haupt- und Unterseiten erstellt. Benutze die grauen Icons mit dem 
![Bereich öffnen]({{% asset "icons/folPlus.svg" %}}?classes=icon) Plus- bzw. 
![Bereich schließen]({{% asset "icons/folMinus.svg" %}}?classes=icon) Minuszeichen links neben den Seitennamen, um Unterseiten 
aus- oder einzuklappen.

![Unterseiten aus- und einklappen]({{% asset "images/manual/layout/site-structure/de/unterseiten-aus-und-einklappen.png" %}}?classes=shadow)

Dank der hierarchischen Seitenstruktur ist es möglich, Eigenschaften einer übergeordneten Seite an ihre Unterseiten zu 
vererben. Für deine Arbeit bedeutet das, dass du ein bestimmtes Seitenlayout oder eine bestimmte Zugriffsberechtigung 
nur einmal festlegen musst und diese Eigenschaften automatisch weitergegeben werden.

## Bestandteile einer Seite

Eine Seite als zentrales Element muss nicht nur wissen, welche Artikel mit ihr verknüpft sind. Sie muss beispielsweise 
auch wissen, welches Seitenlayout sie zur Darstellung im Frontend verwenden soll, ob sie im Cache zwischengespeichert 
werden kann oder welche Benutzer überhaupt auf sie zugreifen dürfen.

Wie du siehst, ist jede Seite mit einem Seitenlayout verknüpft, das deren Aufbau festlegt und sie in verschiedene 
Layoutbereiche unterteilt. Innerhalb dieser Layoutbereiche kannst du beliebige Frontend-Module platzieren, die beim 
Aufruf der Seite der Reihe nach ausgeführt werden und den HTML-Code der Webseite generieren. Dessen Formatierung 
erfolgt über Cascading Stylesheets, kurz CSS, die ebenfalls im Seitenlayout eingebunden werden. Weitere Informationen 
dazu findest du auf der Seite [Theme-Manager](/de/layout/theme-manager/).

In der Seitenstruktur kommen außerdem die designrelevanten Elemente, die in einem Content Management System per 
Definition vom Inhalt getrennt sind, mit den eigentlichen Inhalten aus der Artikelverwaltung zusammen. Jeder Artikel 
besteht wiederum aus Inhaltselementen, die für jeden Inhaltstyp wie z. B. Texte, Bilder oder Tabellen eine 
entsprechende Ein- und Ausgabefunktion bereitstellen. Pro Seite können beliebig viele Artikel angelegt werden. Weitere 
Informationen dazu findest du auf der Seite [Artikelverwaltung](/de/artikelverwaltung/).

In ihrer zentralen Rolle haben Seiten aber noch weit mehr Aufgaben, als nur das Design und die Inhalte zusammenzuführen. 
Auch die Zugriffsrechte für Backend-Benutzer auf Seiten und Artikel werden beispielsweise in der Seitenstruktur 
festgelegt. Schauen wir uns daher die verschiedenen Seitentypen und deren Funktionsweise genauer an.


## Seitentypen

Nicht alle Seiten einer Webseite dienen ausschließlich der Ausgabe von Inhalten. Wenn sich z. B. URLs nach einem 
Relaunch ändern, benötigst du eine Möglichkeit, Besucher auf die neuen Seiten weiterzuleiten. Speziell wenn die alten 
URLs bereits im Google-Index gelistet sind, solltest du auf eine korrekte Weiterleitung mit entsprechendem Header 
achten, um den Page Rank deiner Webseite nicht zu gefährden.

Es gibt in Contao verschiedene Seitentypen mit unterschiedlichen Funktionen, die jeweils für einen ganz bestimmten 
Einsatzzweck konzipiert wurden.

{{% children showhidden="true" description="true" %}}
