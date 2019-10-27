---
title: "Die erste Startseite anlegen"
menuTitle: "Die erste Startseite anlegen"
description: "Anleitung zur Erstellung der ersten Startseite nach der Installation."
url: "anleitungen/die-erste-startseite"
weight: 10
---

Du hast die [Contao Installation](../../installation) abgeschlossen und kannst jetzt deine Startseite erstellen. 
Hierzu werden lediglich drei Schritte benötigt: Ein [Theme](../../theme-manager/themes-verwalten) mit 
[Seitenlayout](../../theme-manager/seitenlayouts-verwalten) anlegen, den 
[Webseiten Startpunkt](../../seitenstruktur/seiten-als-zentrale-elemente/#seitentypen) mit deinem Seitenlayout 
verknüpfen und abschließend die Startseite mit Inhalten erstellen.

## Ein neues Theme anlegen

> ![Ein neues Theme anlegen](/de/guides/images/de/new.svg?classes=icon&width=auto&height=1.8em)

Zunächst benötigst du ein Contao Theme. Beim ersten Aufruf des [Theme-Manager](../../theme-manager) nach der Installation
sollten noch keine Themes existieren. Das Theme erstellt du über den Link `Neu`. Weitere Informationen hierzu findest du
unter [Themes konfigurieren](../../theme-manager/themes-verwalten/#themes-konfigurieren). 

Für unser erstes Theme sind hier lediglich die Angaben `Theme-Titel` und `Autor` notwendig. Als Beispiel 
erstellen wir ein Theme mit Namen `Demo`. Im Anschluß kannst du hier jederzeit dein vorhandenes Themes 
[verwalten](../../theme-manager/themes-verwalten) und Änderungen vornehmen.

![Neues Theme im Theme-Manager](/de/guides/images/de/theme-new.png)


## Ein neues Seitenlayout im Theme anlegen

> ![Die Seitenlayouts des Theme bearbeiten](/de/guides//images/de/layout.svg?classes=icon&width=auto&height=1.8em)

Du mußt nun ein [Seitenlayout](../../theme-manager/seitenlayouts-verwalten) innerhalb deines Themes anlegen. Die 
Einstellungen erreichst du über das Symbol für `Seitenlayouts`. 

![Die Seitenlayouts des Themes aufrufen](/de/guides/images/de/theme-list.png)

> ![Ein neues Seitenlayout erstellen](/de/guides/images/de/new.svg?classes=icon&width=auto&height=1.8em)

Ein Theme kann mehrere Seitenlayouts beinhalten. Dein erstes Seitenlayout erstellt du über den Link `Neu`.

![Neues Seitenlayout anlegen](/de/guides/images/de/layout-list.png)


## Das Seitenlayout konfigurieren

Du befindest dich jetzt in den Einstellungen für Seitenlayouts. Setzte hier lediglich den `Titel` (z. B. auf `Standard`) 
und wähle jeweils im Bereich `Zeilen` und `Spalten` die erste Option aus ("Nur Hauptzeile bzw. "Nur Hauptspalte"). 

Die weiteren Einstellungen kannst du einfach übernehmen und bestätigst deine Angaben
mit `Speichern und schließen`. Die Einstellungen eines Seitenlayouts kannst du nachträglich jederzeit ändern.

![Das Seitenlayout konfigurieren](/de/guides/images/de/layout-conf.png)


## Den Webseiten Startpunkt anlegen

> ![Den neuen Webseiten Startpunkt anlegen](/de/guides/images/de/new.svg?classes=icon&width=auto&height=1.8em)

Wechsle im Bereich `Layout` zur `Seitenstruktur` und wähle den Link `Neu`. Im Anschluß fragt Contao dich nach der Position. 
Übernehme jetzt den Vorschlag den Contao anbietet.

![Das Seitenstruktur konfigurieren](/de/guides/images/de/page-position.png)

Du befindest dich jetzt in den Seiteninstellungen. Setze hier lediglich folgende Angaben:

| Einstellung                | Wert                                |
|:---------------------------|:------------------------------------|
| **Seitenname**             | z. B. Meine Demo Webseite           |
| **Seitentyp**              | Auswahl "Startpunkt einer Webseite" |
| **Sprache**                | de                                  |
| **Sprachen-Fallback**      | Option aktivieren                   |
| **Ein Layout zuweisen**    | Option aktivieren                   |
| **Seite veröffentlichen**  | Option aktivieren                   |


### Das Seitenlayout im Webseiten Startpunkt auswählen

Wenn du die Option `Ein Layout zuweisen` aktivierst, erhälst du eine Auswahl der bestehenden Seitenlayouts per Theme.
In unserem Beispiel also das Seitenlayout `Standard` des Themes `Demo`.

![Das Seitenlayout konfigurieren](/de/guides/images/de/page-select-layout.png)

Bestätige deine Angaben über die Schaltfläche `Speichern und schließen`. Die Liste deiner Seitenstruktur sollte nun 
so aussehen:

![Das Seitenlayout konfigurieren](/de/guides/images/de/page-list-starttype.png)

{{% notice info %}}
Du kannst mit Contao innerhalb einer Installation mehrere Webseiten erstellen und pflegen. Diese werden jeweils 
unter separaten Startpunkten gelistet. Auch wenn du nur eine einzelne Webseite pflegen möchtest, mußt du dazu zunächst 
ein Seite vom Typ Startpunkt erstellen.
{{% /notice %}}


## Die Startseite anlegen

> ![Eine neue Seite erstellen](/de/guides/images/de/new.svg?classes=icon&width=auto&height=1.8em)

Du kannst dir nun in der Seitentrsuktur deine eigentliche Startseite erstellen. Klicke hierzu auf den Link `Neu` in der
Seitenstruktur. Contao fragt dich hier nach der Position an welcher deine neue Seite hinzugefügt werden soll. Wir möchten 
die neue Seite "unterhalb" der bestehenden Startpunkt Seite einfügen. 

![Position der Seite festlegen](/de/guides/images/de/page-position-index.png)

Anschließend befindest du dich wieder in den Seitenstruktur Einstellungen. Wir setzen für unser Beispiel nur die 
relevanten Angaben. Wie immer kannst du diese zu jedem Zeitpunkt ändern.

| Einstellung                | Wert                                |
|:---------------------------|:------------------------------------|
| **Seitenname**             | Willkommen                          |
| **Seitenalias**            | index                               |
| **Seite veröffentlichen**  | Option aktivieren                   |

Die Liste in der Seitenstruktur sollte nun wie folgt aussehen:

![Liste der Seitenstruktur](/de/guides/images/de/page-list-index.png)

{{% notice note %}}
Der Eintrag `index` für den `Seitenalias` sollte nur für deine eigentliche Startseite herangezogen werden. Deine weiteren
Seiten kannst du den Wünschen entsprechend benennen: z.B. "kontakt" o. "impressum".
{{% /notice %}}


## Den Artikel der Startseite bearbeiten

> ![Den Artikel bearbeiten](/de/guides//images/de/edit.svg?classes=icon&width=auto&height=1.8em)

Wähle in der linken Navigation im Bereich `Inhalte` den Link `Artikel`. Mit der Auswahl `Alle umschalten` erhälst du
die untere Darstellung. Contao hat unterhalb deiner Startseite einen [Artikel](../../artikelverwaltung/artikel) mit 
gleichen Namen erstellt. Wähle im Artikel das Symbol für `Artikel bearbeiten` zur Erstellung neuer Inhalte aus.

![Liste der Seitenstruktur](/de/guides/images/de/article-edit.png)

{{% notice note %}}
In der obigen Listendarstellung wird der Artikel ausgegraut dargestellt, u.a. auch das `Augen` Symbol. Du könntest 
den Artikel bereits jetzt [veröffentlichen](#den-artikel-veröffentlichen) oder zunächst mit den folgenden Schritte weiter machen.
{{% /notice %}}


## Neue Inhalte im Artikel erstellen

> ![Ein neues Inhaltselement anlegen](/de/guides/images/de/new.svg?classes=icon&width=auto&height=1.8em)

Du befindest dich nun im Bereich `Inhaltselemente` des `Artikels`. Wähle das Symbol `Neu` um ein neues 
[Inhaltselement](../../artikelverwaltung/inhaltselemente) zu erstellen. Contao fragt dich nach der Position an der das 
Inhaltselement eingefügt werden soll. Wähle hier die Auswahl die Contao vorschlägt.

Über den `Elementtyp` können die verfügbaren Inhaltselemte selektiert werden. Die Voreinstellung ist vom Typ `Text`. 
Für unser Beispiel befülle hier lediglich die Angaben `Überschrift` und `Text` und bestätige mit `Speichern und zurück`.

![Das Inhaltselement Text](/de/guides/images/de/content-ce-text.png)


## Den Artikel veröffentlichen

> ![Den Artikel veröffentlichen](/de/guides//images/de/published.svg?classes=icon&width=auto&height=1.8em)

Ist der Artikel in der Listendarstellung noch ausgegraut (u.a. auch das `Augen` Symbol), hast du den Artikel 
noch nicht veröffentlicht. In diesem Status werden die Inhalte des Artikels auf deiner Seite dann 
einfach nicht angezeigt. 

Zur Veröffentlichung des Artikel wähle das `Augen` Symbol aus. Anschließend wird das Symbol grün angezeigt. 
Jetzt kannst Du deine Webseite im Browser aufrufen.

![Artikel veröffentlichen](/de/guides/images/de/article-publish.png)