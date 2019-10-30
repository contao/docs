---
title: "Die Startseite anlegen"
description: "Anleitung zur Erstellung der Startseite nach der Installation."
url: "anleitungen/die-erste-startseite"
weight: 10
---

Du hast die [Contao Installation](../../installation) abgeschlossen und kannst jetzt deine Startseite erstellen. 
Hierzu werden lediglich drei Schritte benötigt: Ein [Theme](../../theme-manager/themes-verwalten) mit 
[Seitenlayout](../../theme-manager/seitenlayouts-verwalten) anlegen, den 
[Webseiten Startpunkt](../../seitenstruktur/seiten-als-zentrale-elemente/#seitentypen) mit deinem Seitenlayout 
verknüpfen und abschließend die Startseite mit Inhalten erstellen.

## Ein neues Theme anlegen

Zunächst benötigst du ein Contao Theme. Beim ersten Aufruf des [Theme-Manager](../../theme-manager) nach der Installation
sollten noch keine Themes existieren. Das Theme erstellst du über das Icon ![Neu](/de/icons/new.svg?classes=icon) `Neu`. 
Weitere Informationen hierzu findest du unter [Themes konfigurieren](../../theme-manager/themes-verwalten/#themes-konfigurieren). 

Für unser erstes Theme sind hier lediglich die Angaben `Theme-Titel` und `Autor` notwendig. Als Beispiel 
erstellen wir ein Theme mit Namen `Demo`. Im Anschluss kannst du hier jederzeit dein vorhandenes Theme 
[verwalten](../../theme-manager/themes-verwalten) und Änderungen vornehmen.

![Neues Theme im Theme-Manager](/de/guides/images/de/neues-theme-im-theme-manager.png)


## Ein neues Seitenlayout im Theme anlegen

Du musst nun ein [Seitenlayout](../../theme-manager/seitenlayouts-verwalten) innerhalb deines Themes anlegen. Die 
Einstellungen erreichst du über das Icon ![Die Seitenlayouts des Theme bearbeiten](/de/icons/layout.svg?classes=icon) für `Seitenlayouts`. 

![Die Seitenlayouts des Themes aufrufen](/de/guides/images/de/die-seitenlayouts-des-themes-aufrufen.png)

Ein Theme kann mehrere Seitenlayouts beinhalten. Dein erstes Seitenlayout erstellst du über das Icon ![Neu](/de/icons/new.svg?classes=icon) `Neu`.

![Neues Seitenlayout anlegen](/de/guides/images/de/neues-seitenlayout-anlegen.png)


## Das Seitenlayout konfigurieren

Du befindest dich jetzt in den Einstellungen für Seitenlayouts. Setze hier lediglich den `Titel` (z. B. auf `Standard`) 
und wähle jeweils im Bereich `Zeilen` und `Spalten` die erste Option aus (»Nur Hauptzeile« bzw. »Nur Hauptspalte«). 

Die weiteren Einstellungen kannst du einfach übernehmen und bestätigst deine Angaben
mit `Speichern und schließen`. Die Einstellungen eines Seitenlayouts kannst du nachträglich jederzeit ändern.

![Das Seitenlayout konfigurieren](/de/guides/images/de/das-seitenlayout-konfigurieren.png)


## Den Startpunkt einer Webseite anlegen

Wechsle im Bereich `Layout` zur `Seitenstruktur` und wähle das Icon ![Neu](/de/icons/new.svg?classes=icon) `Neu`. 
Im Anschluss fragt Contao dich nach der Position. Übernehme jetzt den Vorschlag, den Contao anbietet.

![Die Seitenstruktur konfigurieren](/de/guides/images/de/die-seitenstruktur-konfigurieren.png)

Du befindest dich jetzt in den Seiteneinstellungen. Setze hier lediglich folgende Angaben:

| Einstellung                | Wert                                |
|:---------------------------|:------------------------------------|
| **Seitenname**             | z. B. Meine Demo Webseite           |
| **Seitentyp**              | Auswahl »Startpunkt einer Webseite« |
| **Sprache**                | de                                  |
| **Sprachen-Fallback**      | Option aktivieren                   |
| **Ein Layout zuweisen**    | Option aktivieren                   |
| **Seite veröffentlichen**  | Option aktivieren                   |


### Das Seitenlayout im Startpunkt einer Webseite auswählen {#das-seitenlayout-im-startpunkt-einer-webseite-auswaehlen}

Wenn du die Option `Ein Layout zuweisen` aktivierst, erhältst du eine Auswahl der bestehenden Seitenlayouts per Theme.
In unserem Beispiel also das Seitenlayout `Standard` des Themes `Demo`.

![Ein Layout zuweisen](/de/guides/images/de/ein-layout-zuweisen.png)

Bestätige deine Angaben über die Schaltfläche `Speichern und schließen`. Deine Seitenstruktur sollte nun 
so aussehen:

![Die Seitenstruktur mit Startpunkt einer Webseite](/de/guides/images/de/die-seitenstruktur-mit-dem-neuen-startpunkt.png)

{{% notice info %}}
Du kannst mit Contao innerhalb einer Installation mehrere Webseiten erstellen und pflegen. Diese werden jeweils 
unter separaten Startpunkten gelistet. Auch wenn du nur eine einzelne Webseite pflegen möchtest, musst du dazu zunächst 
ein Seite vom Typ `Startpunkt einer Webseite` erstellen.
{{% /notice %}}


## Die Startseite anlegen

Du kannst dir nun in der Seitenstruktur deine eigentliche Startseite erstellen. Klicke hierzu auf das 
Icon ![Neu](/de/icons/new.svg?classes=icon) `Neu` in der Seitenstruktur. Contao fragt dich hier nach der Position, 
an welcher deine neue Seite hinzugefügt werden soll. Wir möchten die neue Seite »unterhalb« der bestehenden 
Seite vom Typ `Startpunkt einer Webseite` einfügen. 

![Position der Seite festlegen](/de/guides/images/de/position-der-seite-festlegen.png)

Anschließend befindest du dich wieder in den Einstellungen dieses Seitentyps. Wir setzen für unser Beispiel nur die 
relevanten Angaben. Wie immer kannst du diese zu jedem Zeitpunkt ändern.

| Einstellung                | Wert                                |
|:---------------------------|:------------------------------------|
| **Seitenname**             | Willkommen                          |
| **Seitenalias**            | index                               |
| **Seite veröffentlichen**  | Option aktivieren                   |

Die Liste in der Seitenstruktur sollte nun wie folgt aussehen:

![Liste der Seitenstruktur](/de/guides/images/de/liste-der-seitenstruktur.png)

{{% notice note %}}
Der Eintrag `index` für den `Seitenalias` sollte nur für deine eigentliche Startseite herangezogen werden. Deine weiteren
Seiten kannst du den Wünschen entsprechend benennen: z. B. »kontakt« oder »impressum«.
{{% /notice %}}


## Den Artikel der Startseite bearbeiten

Wähle in der linken Navigation im Bereich `Inhalte` den Link `Artikel`. Mit der Auswahl `Alle umschalten` erhältst du
die untere Darstellung. Contao hat unterhalb deiner Startseite einen [Artikel](../../artikelverwaltung/artikel) mit 
gleichem Namen erstellt. Wähle im Artikel das Icon ![Bearbeiten](/de/icons/edit.svg?classes=icon) für `Artikel bearbeiten` 
zur Erstellung neuer Inhalte aus.

![Den Artikel bearbeiten](/de/guides/images/de/den-artikel-bearbeiten.png)

{{% notice note %}}
In der obigen Listendarstellung wird der Artikel ausgegraut dargestellt, u. a. auch das `Augen` Symbol. Du könntest 
den Artikel bereits jetzt [veröffentlichen](#den-artikel-veroeffentlichen) oder zunächst mit den folgenden Schritte weiter machen.
{{% /notice %}}


## Neue Inhalte im Artikel erstellen

Du befindest dich nun im Bereich `Inhaltselemente` des `Artikels`. Wähle das Icon ![Neu](/de/icons/new.svg?classes=icon) `Neu`, 
um ein neues [Inhaltselement](../../artikelverwaltung/inhaltselemente) zu erstellen. Contao fragt dich nach der Position, 
an der das Inhaltselement eingefügt werden soll. Wähle hier die Auswahl, die Contao vorschlägt.

Über den `Elementtyp` können die verfügbaren Inhaltselemente selektiert werden. Die Voreinstellung ist vom Typ `Text`. 
Für unser Beispiel befülle hier lediglich die Angaben `Überschrift` und `Text` und bestätige mit `Speichern und zurück`.

![Das Inhaltselement Text](/de/guides/images/de/das-inhaltselement-text.png)


## Den Artikel veröffentlichen {#den-artikel-veroeffentlichen}

Ist der Artikel in der Listendarstellung noch ausgegraut (u. a. auch das `Augen` Icon), hast du den Artikel 
noch nicht veröffentlicht. In diesem Status werden die Inhalte des Artikels auf deiner Seite dann 
einfach nicht angezeigt. 

Zur Veröffentlichung des Artikels wähle das `Augen` Icon aus. Anschließend wird das 
Icon ![Veröffentlichen](/de/icons/published.svg?classes=icon) grün angezeigt. Jetzt kannst du deine Webseite im Browser aufrufen.

![Artikel veröffentlichen](/de/guides/images/de/artikel-veroeffentlichen.png)
