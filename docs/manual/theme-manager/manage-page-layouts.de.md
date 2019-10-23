---
title: "Seitenlayouts verwalten"
description: "Das Seitenlayout bestimmt den Aufbau einer Seite und teilt diese in verschiedene Layoutbereiche ein."
url: "theme-manager/seitenlayouts-verwalten"
weight: 30
---

Das Seitenlayout bestimmt den Aufbau einer Seite und teilt diese in verschiedene Layoutbereiche ein. Innerhalb dieser 
Layoutbereiche kannst du beliebige Frontend-Module platzieren, die beim Aufruf der Seite der Reihe nach ausgeführt 
werden und den HTML-Code der Webseite generieren. Auch das Einfügen der Artikel, also der Inhalte, erfolgt mithilfe 
eines Frontend-Moduls.

Sofern einer Seite kein Seitenlayout zugewiesen wird, erbt sie das Seitenlayout von einer übergeordneten Seite. Ist 
auch dort kein Seitenlayout verknüpft, beschränkt sich die Frontend-Ausgabe lediglich auf ein kurzes »No layout 
specified«.


## Aufbau des Frontends

Damit sich individuell per Mausklick zusammengestellte Seitenlayouts im Frontend in eine sauber aufgeteilte und vor 
allem browserübergreifend funktionsfähige Webseite umwandeln lassen, bedarf es eines leistungsfähigen CSS-Frameworks, 
das auf alle Eventualitäten vorbereitet ist. Das Contao CSS-Framework erfüllt diese Aufgabe sehr gut und ist dabei noch 
ziemlich kompakt. Es generiert anhand eines Seitenlayouts automatisch das Grundgerüst der Webseite, das standardmäßig 
aus bis zu drei Spalten sowie einer optionalen Kopf- und Fußzeile besteht.


## Kopf- und Fußzeile

Jedes Seitenlayout kann eine Kopf- und eine Fußzeile haben. Üblicherweise befinden sich in der Kopfzeile unter 
anderem das Firmenlogo und in der Fußzeile Informationen zum Copyright und ein Link zum Impressum und Datenschutz.

**Zeilen**: Hier fügst du dem Layout eine Kopfzeile und Fusszeile hinzu.

![Keine Kopf- und Fusszeile](/de/icons/1rw.svg?classes=icon "Keine Kopf- und Fusszeile")
![Kopfzeile hinzufügen](/de/icons/2rwh.svg?classes=icon "Kopfzeile hinzufügen")
![Fusszeile hinzufügen](/de/icons/2rwf.svg?classes=icon "Fusszeile hinzufügen")
![Kopf- und Fusszeile hinzufügen](/de/icons/3rw.svg?classes=icon "Kopf- und Fusszeile hinzufügen")

**Höhe der Kopfzeile**: Hier kannst du die Höhe der Kopfzeile festlegen.

**Höhe der Fusszeile**: Hier kannst du die Höhe der Fußzeile festlegen.


## Spaltenkonfiguration

Standardmäßig stehen dir bis zu drei Spalten zur Verfügung. Die Breite der linken bzw. der rechten Spalte kannst du 
vorgeben, die Hauptspalte passt sich jeweils automatisch an.

**Spalten**: Hier wählst du die Anzahl der Spalten deines Seitenlayouts aus.

![Keine Spalten](/de/icons/1cl.svg?classes=icon "Keine Spalten")
![Linke Spalte hinzufügen](/de/icons/2cll.svg?classes=icon "Linke Spalte hinzufügen")
![Rechte Spalte hinzufügen](/de/icons/2clr.svg?classes=icon "Rechte Spalte hinzufügen")
![Linke und rechte Spalte hinzufügen](/de/icons/3cl.svg?classes=icon "Linke und rechte Spalte hinzufügen")

**Breite der linken Spalte**: Hier legst du die Breite der linken Spalte fest.

**Breite der rechten Spalte**: Hier legst du die Breite der rechten Spalte fest.


## Eigene Layoutbereiche

Standardmäßig definiert das Contao CSS-Framework folgende Layoutbereiche:

- Kopfzeile
- Linke Spalte
- Rechte Spalte
- Hauptspalte
- Fußzeile

Mit diesen fünf Bereichen lassen sich bestimmt 90 % aller gängigen Seitenlayouts problemlos umsetzen, sodass du in der 
Regel damit auskommen wirst. Es gibt aber durchaus auch Layouts, die von dieser klassischen Einteilung abweichen. 
Solche Entwürfe haben beispielsweise einen zusätzlichen Bereich unter der Kopfzeile oder eine zweigeteilte Hauptspalte.

Um solche »exotischen« Seitenlayouts in Contao zu realisieren, kannst du in den Backend-Einstellungen zusätzliche 
Layoutbereiche definieren und mittels eines Stylesheets anordnen. Deine eigenen Layoutbereiche lassen sich im 
Seitenlayout genauso verwenden wie die Standard-Bereiche.

**Eigene Layoutbereiche**: Hier aktivierst du deine eigenen Layoutbereiche.

**Position der Layoutbereiche**: In Verbindung mit dem Standard-Seitentemplate `fe_page` können eigene 
Layoutbereiche wie folgt positioniert werden:

- Vor dem umschließenden Element <code>top</code>
- Unterhalb der Kopfzeile <code>before</code>
- In der Hauptspalte <code>main</code>
- Oberhalb der Fußzeile <code>after</code>
- Nach dem umschließenden Element <code>bottom</code>
- Manuelle Ausgabe <code>manual</code>

Informationen dazu erhältst du in [Eigene Seitenlayouts](../../eigene-seitenlayouts/).


## Webfonts

Hier kannst du eine oder mehrere [Google-Webfonts](https://fonts.google.com/) zu deiner Webseite hinzufügen.

Sobald du eine Webfont ausgewählt hast, kannst du diesen in das dafür vorgesehene Feld `Roboto:400,700` einfügen.

**Ausgabe im Quellcode:**
```html
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
```

Danach kannst du die Webfont über deine CSS-Datei ansprechen.

```css
body {
    font-family: 'Roboto', sans-serif;
}
```


## Bildgrößen

{{< version "4.8" >}}

Mit dieser Einstellungen kannst du die Bildgröße für die Lightbox im Seitenlayout festlegen.

**Bildgröße für die Lightbox:** Hier kannst du die Abmessungen des Bildes und den Skalierungsmodus für die Lightbox 
festlegen.

**Pixeldichten für das Standardbild:** Die Bildgrößen werden automatisch angepasst. z. B. generiert der Eintrag 
`1x, 1.5x, 2x` folgenden HTML-Code:
```html
<img srcset="img-a.jpg 1x, img-b.jpg 1.5x, img-c.jpg 2x">
```


## Stylesheets

Hier legst du fest, welche Stylesheets in welcher Reihenfolge in das Seitenlayout eingebunden werden.

Es stehen die Komponenten des Contao **CSS-Framework**, **Interne Stylesheets** und **Externe Stylesheets** zur 
Verfügung.

**Komponenten des Contao CSS-Framework:** Hier kannst du die Komponenten des Contao CSS-Framework aktivieren.

| Komponenten              | Erklärung                                                                                                                                        |
|:-------------------------|:-------------------------------------------------------------------------------------------------------------------------------------------------|
| Layout-Builder           | Erstellt das CSS-Layout auf Basis der Seitenlayout-Einstellungen. Diese Komponente muss aktiv sein, damit der Seitengenerator korrekt arbeitet!  |
| Responsives&nbsp;Layout  | Fügt der Kopfzeile ein Viewport-Tag hinzu und skaliert das CSS-Layout basierend auf der Breite des Endgerätes.                                   |
| 12-Spalten Grid          | Erzeugt ein responsives 12-Spalten Grid, das mittels der CSS-Klassen `grid1` bis `grid12` sowie `offset1` bis `offset12` gesteuert wird.         |
| CSS-Reset                | Entfernt die inkonsistente Standardformatierung der HTML-Elemente in verschiedenen Browsern.                                                     |
| Formulare                | Grundlegende Formatierung von Formular-Elementen und Schaltflächen.                                                                              |
| Icons                    | Grundlegende Icons for Downloads und Dateianhänge.                                                                                               |

**Interne Stylesheets:** Hier kannst du dem Layout [interne Stylesheets](../stylesheets-verwalten/) hinzufügen.
 
**Externe Stylesheets:** Hier kannst du externe CSS-, SCSS- oder LESS-Dateien aus dem Dateisystem hinzufügen.

**Ladereihenfolge:** Hier kannst du die Ladereihenfolge der internen und externen Stylesheets festlegen.

**Skripte zusammenfassen:** Hier kannst du bestimmen ob die .css- und .js-Dateien zusammengefasst werden sollen.


## RSS/Atom-Feeds

In ein Seitenlayout eingebundene Feeds werden im Kopfbereich der Seite verlinkt und können in den meisten modernen 
Webbrowsern direkt in der Adresszeile abonniert werden. Mit »Kopfbereich« ist dabei nicht die Kopfzeile deines 
Seitenlayouts gemeint, sondern das `<head>`-Tag des HTML-Quelltextes.

**News-Feeds:** Hier wählst du die Feeds der Nachrichtenarchive aus.

**Kalender-Feeds:** Hier wählst du die Feeds der Kalender aus.


## Frontend-Module

In dieser Sektion weist du den einzelnen Layoutbereichen die Frontend-Module zu, die auf der Seite dargestellt werden 
sollen. Die Module jedes Layoutbereichs werden in der von dir festgelegten Reihenfolge untereinander angeordnet.

![Frontend-Module der Contao Official Demo](/de/theme-manager/images/de/frontend-module-der-contao-official-demo.png)

**Eingebundene Module:** Hier wählst du die Module für das Seitenlayout aus.


## JavaScript

Es stehen die **JavaScript-Templates**, **Analytics-Templates**, **Externe JavaScripts** und 
**Eigener JavaScript-Code** zur Verfügung.

**JavaScript-Templates:** Hier kannst du eines oder mehrere JavaScript-Templates auswählen.

| Template     | Erklärung                                                                   |
|:-------------|:----------------------------------------------------------------------------|
| js_autofocus | Wenn z. B. ein Feld in einem Formular falsch ausgefüllt wurde, erhält dieses Feld nach dem Absenden eine <p>-Tag mit der Klasse »error«. Das JavaScript sorgt dafür, dass automatisch zu dieser Klasse gescrollt wird. |
| js_highlight | Dabei handelt es sich um einen Syntax-Highlighter für Scriptsprachen, er wird für das Inhaltselement »Code« benötigt. |
| js_nocookie  | Damit Contao dich vor CSRF-Attacken schützen kann, musst du zwingend Cookies erlauben. Das Template generiert dynamisch einen entsprechenden Hinweis beim Formular, wenn du es im Browser deaktiviert hast. {{< version "4.8" >}} |
| js_slider    | Stellt JavaScript für das Inhaltselement »Content Slider« zur Verfügung.    |

**Analytics-Templates:** Hier kannst du das Analytics-Templates von Google Analytics und/oder Matomo (Piwik) auswählen.

Dazu muss eines der gewünschten Templates im Templates-Ordner des Theme abgelegt und mit der Google Analytics-ID bzw. 
Piwik-ID und Piwik-URL versehen werden.

```php
/* Template: analytics_google.html5 */
$GoogleAnalyticsId = 'UA-XXXXX-X';

/* Template: analytics_piwik.html5 */
$PiwikSite = 0;
$PiwikPath = '//www.example.com/piwik/';
```

**Externe JavaScripts:** Hier kannst du externe JS-Dateien aus dem Dateisystem hinzufügen.

**Eigener JavaScript-Code:** Hier kannst du eigenen JavaScript-Code einfügen, dieser wird am Ende der Seite ausgegeben.


## jQuery

**jQuery laden:** Dem Layout die jQuery-Bibliothek hinzufügen.

**jQuery-Templates:** Hier kannst du eines oder mehrere jQuery-Templates auswählen.

| Template     | Erklärung                                                                                           |
|:-------------|:----------------------------------------------------------------------------------------------------|
| j_accordion  | Stellt das jQuery-Plugin für das Inhaltselement »Akkordeon« zur Verfügung.                          |
| j_colorbox   | Stellt das jQuery-Plugin zum Anzeigen von Bildern in Großansicht (Lightbox-Effekt) zur Verfügung.  |
| j_tablesort  | Stellt jQuery-Plugin für die Sortieroption des Inhaltselementes »Tabelle« zur Verfügung.            |

**jQuery-Quelle:** Hier kannst du auswählen, von wo das jQuery-Skript geladen werden soll. Es stehen folgende drei 
Möglichkeiten zur Verfügung:

- Lokale Datei
- CDN (code.jquery.com)
- CDN mit lokalem Fallback


## MooTools

**MooTools laden:** Dem Layout die MooTools-Bibliothek hinzufügen.

**MooTools-Templates:** Hier kannst du eines oder mehrere MooTools-Templates auswählen.

| Template      | Erklärung                                                                                            |
|:--------------|:-----------------------------------------------------------------------------------------------------|
| moo_accordion | Stellt das MooTools-Plugin für das Inhaltselement »Akkordeon« zur Verfügung.                         |
| moo_chosen    | Mit diesem MooTools-Plugin kannst du lange Select-Menüs übersichtlicher und benutzerfreundlicher gestalten. Dem Select-Menü muss die CSS-Klasse »tl_chosen« mitgegeben werden. |
| moo_mediabox  | Stellt das MooTools-Plugin zum Anzeigen von Bildern in Großansicht (Lightbox-Effekt) zur Verfügung. |
| moo_tablesort | Stellt MooTools-Plugin für die Sortieroption des Inhaltselementes »Tabelle« zur Verfügung.           |

**MooTools-Quelle:** Hier kannst du auswählen, von wo das MooTools-Skript geladen werden soll. Es stehen folgende drei 
Möglichkeiten zur Verfügung:

- Lokale Datei
- CDN (googleapis.com)
- CDN mit lokalem Fallback


## Statisches Layout

Das CSS-Framework passt das Seitenlayout standardmäßig an die Breite des Browserfensters an, was im Englischen auch als 
»Liquid Layout« bezeichnet wird. Im Gegensatz dazu hat ein statisches Layout eine feste Breite und wird im Fenster 
deines Browsers z. B. zentriert dargestellt. In Contao werden beide Layout-Typen unterstützt.

**Statisches Layout:** Hier definierst du ein Seitenlayout als statisch.

**Gesamtbreite:** Hier kannst du die Gesamtbreite der Webseite eingeben.

**Ausrichtung:** Hier kannst du die Ausrichtung (linksbündig, rechtsbündig oder zentriert) der Webseite festlegen.


## Experten-Einstellungen

In den Experten-Einstellungen kannst du unter anderem das Seitentemplate ändern, die dem Seitenlayout zugrunde liegen. 
Das solltest du nur dann erwägen, wenn die Bordmittel von Contao tatsächlich nicht ausreichen oder du z. B. ein 
externes CSS-Framework verwenden möchtest. In den meisten Fällen solltest du jedoch mit den Standard-Möglichkeiten 
problemlos ans Ziel kommen.

**Seitentemplate:** Hier kannst du das Seitentemplate auswählen.

**Markup komprimieren:** Hier kannst du bestimmen ob das HTML-Markup vor dem Senden an den Browser komprimiert werden 
soll.

**Viewport-Tag:** Hier kannst du ein individuelles Viewport-Tag setzen.

**Ausgabe im Quellcode:**
```html
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
```

**Title-Tag:** Hier kannst du das Title-Tag überschreiben.

**Body-Klasse:** Hier kannst du dem Body-Tag der HTML-Seite eine CSS-Klasse zuweisen und so Formatdefinitionen für ein 
bestimmtes Seitenlayout erstellen.

**Body onload:** Einige JavaScripts erfordern einen sogenannten »Body Onload Event«, um das Script beim Laden der Seite 
zu initialisieren. Solltest du ein solches JavaScript verwenden wollen, kannst du hier den benötigten Code eingeben.

**Zusätzliche `<head>`-Tags:** Im Kopfbereich deiner Webseite werden die Meta-Informationen der Seite 
ausgegeben und die eingebundenen Stylesheets und JavaScripts verlinkt. Du kannst hier beliebige Ergänzungen vornehmen 
und z. B. weitere Stylesheets einfügen.
