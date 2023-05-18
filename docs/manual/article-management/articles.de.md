---
title: "Artikel"
description: "Jeder Artikel ist einer bestimmten Seite und einem bestimmten Layoutbereich zugeordnet."
url: "artikelverwaltung/artikel"
aliases:
    - /de/artikelverwaltung/artikel/
weight: 10
---

Die Artikelverwaltung ist ein eigenes Modul in Contao, das du in der Navigation ganz oben in der Gruppe *Inhalte* 
findest. Jeder Artikel ist einer bestimmten Seite und einem bestimmten Layoutbereich zugeordnet. Im Gegensatz zu 
vielen anderen CMS ist das Einbinden von Artikeln in Contao nicht auf die Hauptspalte beschränkt, sodass du deine 
Webseite flexibel gestalten kannst.

![Die Artikelverwaltung]({{% asset "images/manual/article-management/de/die-artikelverwaltung.png" %}}?classes=shadow)

Jede Seite kann beliebig viele Artikel enthalten, die innerhalb ihres Layoutbereichs untereinander in der von dir 
festgelegten Reihenfolge dargestellt werden. Contao erkennt selbstständig, ob jeweils der ganze Artikel oder nur der 
Teasertext, gefolgt von einem `Weiterlesen`-Link, angezeigt werden soll.

![Mehrere Artikel mit Teasertext]({{% asset "images/manual/article-management/de/mehrere-artikel-mit-teasertext.png" %}}?classes=shadow)

Die Zuweisung eines Artikels zu einem Layoutbereich erfolgt in den Artikeleinstellungen im Feld Anzeigen in. Die 
Artikeleinstellungen erreichst du am schnellsten, über das Navigationssymbol
![Die Artikeleinstellungen bearbeiten]({{% asset "icons/header.svg" %}}?classes=icon) **Die Artikeleinstellungen bearbeiten**.


## Artikelaliase

Der Alias eines Artikels ist eine eindeutige und aussagekräftige Referenz, über die du einen Artikel in deinem Browser 
aufrufen kannst. Der Alias ermöglicht es, folgende URL zu verwenden:

`unternehmen/articles/unser-team.html`

Eventuell wunderst du dich jetzt, dass es offenbar doch möglich ist, einen Artikel im Frontend direkt aufzurufen. Im 
Einführungskapitel wurde ja erwähnt, dass Besucher im Frontend immer nur Seiten und niemals bestimmte Inhalte abrufen 
können.

Wenn du jedoch genau hinsiehst, wirst du feststellen, dass die Seite nach wie vor Teil der URL ist. Genau genommen 
wird hier also die Seite aufgerufen und zusätzlich die Darstellung des Artikelmoduls in der Hauptspalte verändert. 
Alle anderen Artikel, die nicht in der Hauptspalte eingebunden sind, werden nach wie vor ganz normal angezeigt.


## Teasertext

Ein Teasertext ist eine kurze Zusammenfassung eines Artikels, die anstatt des eigentlichen Artikels in einer Übersicht 
angezeigt werden kann. Contao erkennt selbstständig, ob jeweils der ganze Artikel oder nur der Teasertext angezeigt 
werden soll.

**Teaser-CSS-ID/Klasse:** Hier kannst du dem Teaser eine CSS-ID und -Klasse zuweisen.

**Teasertext anzeigen:** Ist diese Option ausgewählt, zeigt Contao automatisch den Teasertext des Artikels an, sobald 
mehr als ein Artikel pro Layoutbereich vorhanden ist.

**Teasertext:** Hier gibst du den Teasertext mithilfe des Rich Text Editors ein.


## Syndikation

Unter Syndikation legst du fest, wie ein Artikel syndiziert werden kann. Als 
»[Content-Syndication](https://de.wikipedia.org/wiki/Content-Syndication)« bezeichnet man die Mehrfachverwendung 
medialer Inhalte, womit im Online-Bereich vor allem die Verknüpfung von Inhalten verschiedener Webseiten gemeint ist. 
Folgende Möglichkeiten stehen zur Auswahl:

| Name                            | Erklärung                                                                                                                                                                                                           |
|:--------------------------------|:--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Seite drucken                   | Diese Schaltfläche ruft die Druckfunktion des Browsers auf. Du kannst den Artikel damit zu Papier bringen.                                                                                                          |
| Auf&nbsp;Facebook&nbsp;teilen   | Diese Schaltfläche öffnet ein Popup-Fenster, in dem du den Artikel direkt auf Facebook teilen kannst. Du benötigst dazu ein Facebook-Konto.                                                                         |
| Auf Twitter teilen              | Diese Schaltfläche öffnet ein Popup-Fenster, in dem du den Artikel direkt auf Twitter teilen kannst. Die Verkürzung der URL mithilfe von [tinyurl.com/app](https://tinyurl.com/app) nimmt Contao dabei automatisch vor.    |

**Syndikation:** Hier wählst du die Syndikationsmöglichkeiten aus, die im Frontend angezeigt werden sollen.


## Template-Einstellungen

**Individuelles Template:** Hier kannst du das Standard-Template `mod_article` überschreiben.


## Zugriffsschutz

Mit dem Zugriffsschutz kann der Zugriff auf einen Artikel auf bestimmte Mitgliedergruppen eingeschränkt werden.

**Artikel schützen:** Hier kannst du Artikel nur bestimmten Gruppen anzeigen lassen.

**Erlaubte Mitgliedergruppen:** Wähle aus welche Gruppen den Artikel sehen dürfen.


## Experten-Einstellungen

In den Experten-Einstellungen kannst du dem Artikel eine CSS-ID und -Klasse zuweisen

**CSS-ID/Klasse:** Hier kannst du dem Artikel eine CSS-ID und -Klasse zuweisen.

**Nur Gästen anzeigen:** Der Artikel ist standardmäßig sichtbar und wird ausgeblendet, sobald sich ein Mitglied im 
Frontend angemeldet hat.


## Veröffentlichen {#veroeffentlichen}

Genau wie Seiten sind auch Artikel im Frontend nicht verfügbar, solange sie nicht veröffentlicht wurden. Contao bietet 
zusätzlich zur manuellen Veröffentlichung auch die Möglichkeit, Artikel automatisch zu einem bestimmten Datum zu 
aktivieren. Auf diese Weise kannst du z. B. ein zeitlich begrenztes Angebot bewerben.

**Veröffentlicht:** Hier kannst du einen Artikel veröffentlichen.

**Anzeigen ab:** Hier aktivierst du einen Artikel zu einem bestimmten Datum.

**Anzeigen bis:** Hier deaktivierst du einen Artikel zu einem bestimmten Datum.
