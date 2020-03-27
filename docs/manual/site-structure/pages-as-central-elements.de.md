---
title: "Seiten als zentrale Elemente"
description: "Contao gehört zur Gruppe der seitenbasierten Content Management Systeme, das heißt, die Seitenstruktur 
ist das zentrale Element deiner Webseite."
url: "seitenstruktur/seiten-als-zentrale-elemente"
weight: 10
---

Contao gehört zur Gruppe der seitenbasierten Content Management Systeme, das heißt, die Seitenstruktur ist das zentrale 
Element deiner Webseite. Du kannst die darin enthaltenen Seiten über deren ID bzw. Namen (Alias) im Frontend aufrufen 
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
![Bereich öffnen](/de/icons/folPlus.svg?classes=icon) Plus- bzw. 
![Bereich schließen](/de/icons/folMinus.svg?classes=icon) Minuszeichen links neben den Seitennamen, um Unterseiten 
aus- oder einzuklappen.

![Unterseiten aus- und einklappen](/de/site-structure/images/de/unterseiten-aus-und-einklappen.png?classes=shadow)

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
dazu findest du auf der Seite [Theme-Manager](../../theme-manager/).

In der Seitenstruktur kommen außerdem die designrelevanten Elemente, die in einem Content Management System per 
Definition vom Inhalt getrennt sind, mit den eigentlichen Inhalten aus der Artikelverwaltung zusammen. Jeder Artikel 
besteht wiederum aus Inhaltselementen, die für jeden Inhaltstyp wie z. B. Texte, Bilder oder Tabellen eine 
entsprechende Ein- und Ausgabefunktion bereitstellen. Pro Seite können beliebig viele Artikel angelegt werden. Weitere 
Informationen dazu findest du auf der Seite [Artikelverwaltung](../../artikelverwaltung).

In ihrer zentralen Rolle haben Seiten aber noch weit mehr Aufgaben, als nur das Design und die Inhalte zusammenzuführen. 
Auch die Zugriffsrechte für Backend-Benutzer auf Seiten und Artikel werden beispielsweise in der Seitenstruktur 
festgelegt. Schauen wir uns daher die verschiedenen Seitentypen und deren Funktionsweise genauer an.


## Seitentypen

Nicht alle Seiten einer Webseite dienen ausschließlich der Ausgabe von Inhalten. Wenn sich z. B. URLs nach einem 
Relaunch ändern, benötigst du eine Möglichkeit, Besucher auf die neuen Seiten weiterzuleiten. Speziell wenn die alten 
URLs bereits im Google-Index gelistet sind, solltest du auf eine korrekte Weiterleitung mit entsprechendem Header 
achten, um den Page Rank deiner Webseite nicht zu gefährden.

Es gibt in Contao acht verschiedene Seitentypen mit unterschiedlichen Funktionen, die jeweils für einen ganz bestimmten 
Einsatzzweck konzipiert wurden.

| Seitentyp                   | Erklärung                                                                                |
|:----------------------------|:-----------------------------------------------------------------------------------------|
| Reguläre Seite              | Reguläre Seiten sind Seiten, auf denen Inhalte ausgegeben werden. Eine reguläre Seite ist vergleichbar mit einer statischen HTML-Datei, die du auf deinen Server lädst und in deinem Browser aufrufst. |
| Interne Weiterleitung       | Dieser Seitentyp leitet Besucher zu einer anderen Seite in der Seitenstruktur weiter. Die Zielseite muss unter derselben Domain erreichbar sein wie die Weiterleitungsseite, andernfalls muss eine externe Weiterleitung verwendet werden. |
| Externe Weiterleitung       | Dieser Seitentyp leitet Besucher zu einer externen Seite weiter. Das kann sowohl eine Seite außerhalb deines Servers sein als auch eine Seite innerhalb der Contao-Seitenstruktur, die jedoch unter einer anderen Domain als die Weiterleitungsseite läuft. |
| Startpunkt einer Webseite   | Dieser Seitentyp markiert den Startpunkt einer Webseite innerhalb der Seitenstruktur. Contao unterstützt die Verwaltung mehrerer Webseiten mit einer Installation. Diese Webseiten können sich z. B. durch verschiedene Sprachen unterscheiden oder auch völlig unabhängig voneinander unter verschiedenen Domains laufen (Multidomain-Betrieb). |
| Abmelden                    | Dieser Seitentyp erstellt einen Abmelde-Link für einem geschützten Bereich. Du kannst die Besucher nachdem Abmelden auf eine beliebige oder zur zuletzt besuchten Seite weiterleiten. |
| 401 Nicht authentifiziert   | Diese Seite wird aufgerufen, wenn ein Mitglied nicht angemeldet ist und deshalb nicht auf eine geschützte Seite zuzugreifen darf. Du kannst die Seite wahlweise als reguläre Seite nutzen und einen entsprechenden Hinweis ausgeben oder den Besucher automatisch z. B. auf die Anmeldeseite weiterleiten.<sup>1</sup> {{< version "4.6" >}} |
| 403 Zugriff verweigert      | Diese Seite wird aufgerufen, wenn ein Mitglied angemeldet ist aber nicht über die notwendigen Zugriffsrechte verfügt, um auf eine geschützte Seite zuzugreifen. Du kannst die Seite wahlweise als reguläre Seite nutzen und einen entsprechenden Hinweis ausgeben oder den Besucher automatisch auf eine andere Seite weiterleiten.<sup>1</sup> |
| 404 Seite nicht gefunden    | Diese Seite wird aufgerufen, wenn ein Besucher eine nicht vorhandene Seite anfragt. Du kannst die Seite wahlweise als reguläre Seite nutzen und dort z. B. eine Sitemap einbinden oder den Benutzer automatisch auf eine andere Seite weiterleiten. |

{{% notice note %}}
<sup>1</sup> Vor Contao 4.6 gab es nur den Seitentyp "403 Zugriff verweigert", der beide Situationen "nicht authentifiziert"
(401) und "nicht autorisiert" (403) behandelt hat. Dort konnte es sinnvoll sein, ein Login-Modul anzuzeigen oder zum Login 
weiterzuleiten. Ab Contao 4.6 ergibt das nur noch auf der 401-Seite Sinn.
{{% /notice %}}
