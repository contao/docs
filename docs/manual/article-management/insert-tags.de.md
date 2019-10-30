---
title: "Insert-Tags"
description: "Insert-Tags sind Platzhalter, die bei der Ausgabe einer Seite durch bestimmte Werte ersetzt werden."
url: "artikelverwaltung/insert-tags"
weight: 30
---

Insert-Tags sind Platzhalter, die bei der Ausgabe einer Seite durch bestimmte Werte ersetzt werden. Mit Insert-Tags 
kannst du z. B. einen Link auf eine Seite oder einen Artikel erstellen, Umgebungsvariablen einfügen oder 
Benutzereigenschaften auslesen. Insert-Tags können überall in Contao verwendet werden.

Ein Insert-Tags beginnt immer mit zwei öffnenden geschweiften Klammern, gefolgt von einem Schlüsselwort und zwei 
schließenden geschweiften Klammern, also z. B. `{{date}}`. Viele Insert-Tags benötigen zusätzlich noch ein Argument, 
das mit zwei Doppelpunkten hinter das Schlüsselwort geschrieben wird, also z. B. `{{link::12}}`.


## Link-Elemente

Mit diesen Insert-Tags  kannst du Links auf andere Seiten oder Artikel erstellen. Du benötigst dazu lediglich die ID 
oder den Alias der Zielseite.

| Insert-Tag                | Beschreibung                                                                                                                 |
|:--------------------------|:-----------------------------------------------------------------------------------------------------------------------------|
| `{{link::*}}`             | Dieses Tag wird mit einem Link zu einer internen Seite ersetzt (ersetze * mit der ID oder dem Alias).                        |
| `{{link::back}}`          | Dieses Tag wird mit einem Link zur der zuletzt besuchte Seite ersetzt. Kann auch als `{{link_open::back}}`, `{{link_url::back}}` und `{{link_title::back}}` verwendet werden.    |
| `{{link::login}}`         | Dieses Tag wird mit einem Link zur Anmeldeseite des aktuellen Frontend-Benutzers (falls vorhanden) ersetzt.                  |
| `{{link_open::*}}`        | Wird mit dem öffnenden Tag eines Links zu einer internen Seite ersetzt: `{{link_open::12}}Hier klicken{{link_close}}`.       |
| `{{link_url::*}}`         | Dieses Tag wird mit der URL einer internen Seite ersetzt: `<a href="{{link_url::12}}">Hier klicken</a>`.                     |
| `{{link_title::*}}`       | Dieses Tag wird mit dem Titel einer internen Seite ersetzt: `<a title="{{link_title::12}}">Hier klicken</a>`.                |
| `{{link_name::*}}`        | Dieses Tag wird mit dem Namen einer internen Seite ersetzt: `<a>{{link_name::12}}</a>`.                                      |
| `{{link_close}}`          | Wird mit dem schließenden Tag eines Links zu einer internen Seite ersetzt: `{{link_open::12}}Hier klicken{{link_close}}`.    |
| `{{article::*}}`          | Dieses Tag wird mit einem Link zu einem Artikel ersetzt (ersetze * mit der ID oder dem Alias).                          |
| `{{article_open::*}}`     | Wird mit dem öffnenden Tag eines Links zu einem Artikel ersetzt: `{{article_open::12}}Hier klicken{{link_close}}`.           |
| `{{article_url::*}}`      | Dieses Tag wird mit der URL eines Artikels ersetzt: `<a href="{{article_url::12}}">Hier klicken</a>`.                        |
| `{{article_title::*}}`    | Dieses Tag wird mit dem Titel eines Artikels ersetzt: `<a title="{{article_title::12}}">Hier klicken</a>`.                   |
| `{{news::*}}`             | Dieses Tag wird mit einem Link zu einer Nachricht ersetzt (ersetze * mit der ID oder dem Alias).                        |
| `{{news_open::*}}`        | Wird mit dem öffnenden Tag eines Links zu einer Nachricht ersetzt: `{{news_open::12}}Hier klicken{{link_close}}`.            |
| `{{news_url::*}}`         | Dieses Tag wird mit der URL einer Nachricht ersetzt: `<a href="{{news_url::12}}">Hier klicken</a>`.                          |
| `{{news_title::*}}`       | Dieses Tag wird mit dem Titel einer Nachricht ersetzt: `<a title="{{news_title::12}}">Hier klicken</a>`.                     |
| `{{news_feed::*}}`        | Dieser Tag wird mit der URL zu einem News-Feed ersetzen (ersetze * mit der ID).                                         |
| `{{event::*}}`            | Dieses Tag wird mit einem Link zu einem Event ersetzt (ersetze * mit der ID oder dem Alias).                            |
| `{{event_open::*}}`       | Wird mit dem öffnenden Tag eines Links zu einem Event ersetzt: `{{event_open::12}}Hier klicken{{link_close}}`.               |
| `{{event_url::*}}`        | Dieses Tag wird mit der URL eines Events ersetzt: `<a href="{{event_url::12}}">Hier klicken</a>`.                            |
| `{{event_title::*}}`      | Dieses Tag wird mit dem Titel eines Events ersetzt: `<a title="{{event_title::12}}">Hier klicken</a>`.                       |
| `{{calendar_feed::*}}`    | Dieser Tag wird mit der URL zu einem Kalender-Feed ersetzen (ersetze * mit der ID).                                     |
| `{{faq::*}}`              | Dieses Tag wird mit einem Link zu einer häufig gestellten Frage ersetzt (ersetze * mit der ID oder dem Alias).          |
| `{{faq_open::*}}`         | Wird mit dem öffnenden Tag eines Links zu einer Frage ersetzt: `{{faq_open::12}}Hier klicken{{link_close}}`.                 |
| `{{faq_url::*}}`          | Dieses Tag wird mit der URL einer Frage ersetzt: `<a href="{{faq_url::12}}">Hier klicken</a>`.                               |
| `{{faq_title::*}}`        | Dieses Tag wird mit dem Titel einer Frage ersetzt: `<a title="{{faq_title::12}}">Hier klicken</a>`.                          |


## Mitgliedereigenschaften

Mit den folgenden Insert-Tags kannst du bestimmte Eigenschaften eines angemeldeten Frontend-Benutzers auslesen und ihn 
so z. B. mit seinem Namen ansprechen. Prinzipiell kannst du alle Feldnamen der Tabelle `tl_member` als Argument übergeben.

| Insert-Tag                | Beschreibung                                                                                                                             |
|:--------------------------|:-----------------------------------------------------------------------------------------------------------------------------------------|
| `{{user::*}}`             | Dieses Tag wird mit dem Inhalt eines Feldes von `tl_member` des angemeldeten Mitglieds ersetzt (ersetze * mit dem Feldnamen).            |
| `{{user::firstname}}`     | Dieses Tag wird mit dem Vornamen des angemeldeten Mitglieds ersetzt.                                                                     |
| `{{user::lastname}}`      | Dieses Tag wird mit dem Nachnamen des angemeldeten Mitglieds ersetzt.                                                                    |
| `{{user::company}}`       | Dieses Tag wird mit dem Firmennamen des angemeldeten Mitglieds ersetzt.                                                                  |
| `{{user::phone}}`         | Dieses Tag wird mit der Telefonnummer des angemeldeten Mitglieds ersetzt.                                                                |
| `{{user::mobile}}`        | Dieses Tag wird mit der Handynummer des angemeldeten Mitglieds ersetzt.                                                                  |
| `{{user::fax}}`           | Dieses Tag wird mit der Faxnummer des angemeldeten Mitglieds ersetzt.                                                                    |
| `{{user::email}}`         | Dieses Tag wird mit der E-Mail-Adresse des angemeldeten Mitglieds ersetzt.                                                               |
| `{{user::website}}`       | Dieses Tag wird mit der Internetadresse des angemeldeten Mitglieds ersetzt.                                                              |
| `{{user::street}}`        | Dieses Tag wird mit dem Staßennamen des angemeldeten Mitglieds ersetzt.                                                                  |
| `{{user::postal}}`        | Dieses Tag wird mit der Postleitzahl des angemeldeten Mitglieds ersetzt.                                                                 |
| `{{user::city}}`          | Dieses Tag wird mit der Stadt des angemeldeten Mitglieds ersetzt.                                                                        |
| `{{user::country}}`       | Dieses Tag wird mit dem Land des angemeldeten Mitglieds ersetzt.                                                                         |
| `{{user::username}}`      | Dieses Tag wird mit dem Benutzernamen des angemeldeten Mitglieds ersetzt.                                                                |


## Seiteneigenschaften

Mit den folgenden Insert-Tags können Seiteneigenschaften wie z. B. der Seitenname ausgegeben werden.

| Insert-Tag                    | Beschreibung                                                                                                               |
|:------------------------------|:---------------------------------------------------------------------------------------------------------------------------|
| `{{page::*}}`                 | Dieses Tag wird mit dem Inhalt eines Feldes von `tl_page` der aktuellen Seite ersetzt (ersetze * mit dem Feldnamen).       |
| `{{page::id}}`                | Dieses Tag wird mit der ID der aktuellen Seite ersetzt.                                                                    |
| `{{page::alias}}`             | Dieses Tag wird mit dem Alias der aktuellen Seite ersetzt.                                                                 |
| `{{page::title}}`             | Dieses Tag wird mit dem Namen der aktuellen Seite ersetzt.                                                                 |
| `{{page::pageTitle}}`         | Dieses Tag wird mit dem Titel der aktuellen Seite ersetzt.                                                                 |
| `{{page::language}}`          | Dieses Tag wird mit der Sprache der aktuellen Seite ersetzt.                                                               |
| `{{page::parentAlias}}`       | Dieses Tag wird mit dem Alias der übergeordneten Seite ersetzt.                                                            |
| `{{page::parentTitle}}`       | Dieses Tag wird mit dem Namen der übergeordneten Seite ersetzt.                                                            |
| `{{page::parentPageTitle}}`   | Dieses Tag wird mit dem Titel der übergeordneten Seite ersetzt.                                                            |
| `{{page::mainAlias}}`         | Dieses Tag wird mit dem Alias der übergeordneten Hauptseite ersetzt.                                                       |
| `{{page::mainTitle}}`         | Dieses Tag wird mit dem Namen der übergeordneten Hauptseite ersetzt.                                                       |
| `{{page::mainPageTitle}}`     | Dieses Tag wird mit dem Titel der übergeordneten Hauptseite ersetzt.                                                       |
| `{{page::rootTitle}}`         | Dieses Tag wird mit dem Namen der Webseite ersetzt.                                                                        |
| `{{page::rootPageTitle}}`     | Dieses Tag wird mit dem Titel der Webseite ersetzt.                                                                        |


## Umgebungsvariablen

Mit den folgenden Insert-Tags können Umgebungsvariablen wie z. B. der Seitenname oder der Request-String ausgegeben 
werden.

| Insert-Tag                    | Beschreibung                                                                                     |
|:------------------------------|:-------------------------------------------------------------------------------------------------|
| `{{env::host}}`               | Dieses Tag wird mit dem aktuellen Hostnamen ersetzt. (z. B. example.com)                         |
| `{{env::url}}`                | Dieses Tag wird mit dem Hostnamen und dem Protokoll ersetzt. (z. B. http://www.example.com)      |
| `{{env::path}}`               | Dieses Tag wird mit der aktuellen Basis-URL samt Pfad zum Contao-Verzeichnis ersetzt.            |
| `{{env::request}}`            | Dieses Tag wird mit dem aktuellen Request-String ersetzt. (z. B. news/items/willkommen.html)     |
| `{{env::ip}}`                 | Dieses Tag wird mit der IP-Adresse des aktuellen Besuchers ersetzt.                              |
| `{{env::referer}}`            | Dieses Tag wird mit der URL der zuletzt besuchten Seite ersetzt.                                 |
| `{{env::files_url}}`          | Dieses Tag wird mit der statischen URL des Uploadverzeichnis ersetzt.                            |
| `{{env::assets_url}}`         | Dieses Tag wird mit der statischen URL des Assets-Verzeichnis ersetzt.                           |


## Include-Elemente

Mit den folgenden Insert-Tags können Ressourcen wie z. B. Artikel, Module oder Dateien aus dem `templates`-Verzeichnis 
eingebunden werden.

| Insert-Tag                    | Beschreibung                                                                                         |
|:------------------------------|:-----------------------------------------------------------------------------------------------------|
| `{{insert_article::*}}`       | Dieses Tag wird mit dem referenzierten Artikel ersetzt (ersetze * mit der ID oder dem Alias).        |
| `{{insert_content::*}}`       | Dieses Tag wird mit dem referenzierten Inhaltselement ersetzt (ersetze * mit der ID des Elements).   |
| `{{insert_module::*}}`        | Dieses Tag wird mit dem referenzierten Modul ersetzt (ersetze * mit der ID des Moduls).              |
| `{{insert_form::*}}`          | Dieses Tag wird mit dem referenzierten Formular ersetzt (ersetze * mit der ID des Formulars).        |
| `{{article_teaser::*}}`       | Dieses Tag wird mit dem Teaser eines Artikels ersetzt (ersetze * mit der ID des Artikels).           |
| `{{news_teaser::*}}`          | Dieses Tag wird mit dem Teaser einer Nachricht ersetzt (ersetze * mit der ID der Nachricht).         |
| `{{event_teaser::*}}`         | Dieses Tag wird mit dem Teaser eines Events ersetzt (ersetze * mit der ID des Events).               |
| `{{file::*}}`                 | Dieses Tag wird mit dem Inhalt einer .php- oder .html5-Datei aus dem `templates`-Verzeichnis ersetzt (ersetze * mit dem Namen). Bei Bedarf kannst du Argumente übergeben: `{{file::file.php?arg1=val}}`. Mittels UUID kann außerdem der Pfad einer Datei aus der Datenbank abgefragt werden: `{{file::6939a448-9b30-11e4-bcba-079af1e9baea}}`. |


## Verschiedenes

Mit den folgenden Insert-Tags kannst du verschiedene Aufgaben erledigen und z. B. das aktuelle Datum oder ein 
Lightbox-Bild einfügen.

| Insert-Tag               | Beschreibung                                                                                         |
|:-------------------------|:-----------------------------------------------------------------------------------------------------|
| `{{date}}`               | Dieses Tag wird mit dem aktuellen Datum gemäß des globalen Datumsformats ersetzt.                    |
| `{{date::*}}`            | Dieses Tag wird mit dem aktuellen Datum gemäß eines individuellen Datumsformats ersetzt. Contao unterstützt alle Datums- und Zeitformate, die mit der [PHP-Funktion date](https://www.php.net/manual/de/function.date.php) geparst werden können. z. B. `{{date::d.m.Y}}` |
| `{{last_update}}`        | Dieses Tag wird mit dem Datum der letzten Aktualisierung gemäß des globalen Datumsformats ersetzt.   |
| `{{last_update::*}}`     | Dieses Tag wird mit Datum der letzten Aktualisierung gemäß eines individuellen Datumsformats ersetzt. Contao unterstützt alle Datums- und Zeitformate, die mit der [PHP-Funktion date](https://www.php.net/manual/de/function.date.php) geparst werden können. z. B. `{{last_update::d.m.Y}}` |
| `{{email::*}}`           | Dieses Tag wird mit einem verschlüsselten Link zu einer E-Mail-Adresse ersetzt.                      |
| `{{email_open::*}}`      | Dieses Tag wird mit einem verschlüsselten Link zu einer E-Mail-Adresse ersetzt. Allerdings wird das schließende `</a>` nicht angefügt. |
| `{{email_url::*}}`       | Dieses Tag wird nur durch die verschlüsselte E-Mail-Adresse ersetzt.                                 |
| `{{post::*}}`            | Mit diesem Tag kann eine angegebene Post-Variable ausgelesen und angezeigt werden. Kann z. B. genutzt werden, um auf einzelne Felder eines gesendeten Formulars zuzugreifen. |
| `{{lang::*}}`            | Mit diesem Tag können fremdsprachige Wörter in einem Text markiert werden: `{{lang::fr}}Au revoir{{lang}}`. Dies wird ersetzt mit `<span lang="fr">Au revoir</span>`. |
| `{{abbr::*}}`            | Abkürzungen in einem Text markieren: `{{abbr::World Wide Web}}WWW{{abbr}}`. Dies wird ersetzt mit `<abbr title="World Wide Web">WWW</abbr>`. |
| `{{acronym::*}}`         | Akronyme in einem Text markieren: `{{acronym::Multipurpose Internet Mail Extensions}}MIME{{acronym}}`. Dies wird ersetzt mit `<acronym title="Multipurpose Internet Mail Extensions">MIME</acronym>`. |
| `{{ua::*}}`              | Eigenschaften des Browsers (User Agent) ausgeben: `{{ua::browser}}`. Dies wird beispielsweise ersetzt mit "chrome". |
| `{{iflng::*}}`           | Dieses Tag wird komplett entfernt, wenn die Sprache der Seite nicht mit der Tag-Sprache übereinstimmt. Du kannst so sprachspezifische Bezeichnungen erstellen: `{{iflng::en}}Your name{{iflng::de}}Ihr Name{{iflng}}` |
| `{{ifnlng::*}}`          | Dieses Tag wird komplett entfernt, wenn die Sprache der Seite mit der Tag-Sprache übereinstimmt. Du kannst so sprachspezifische Bezeichnungen erstellen: `{{ifnlng::de}}Your name{{ifnlng}}{{iflng::de}}Ihr Name{{iflng}}` |
| `{{image::*}}`           | Dieses Tag wird mit der Vorschauansicht eines Bildes ersetzt (wobei * eine Datenbank ID, eine UUID oder ein Pfad aus dem Dateisystem sein kann):<br>`{{image::58ca4a90-2d30-11e4-8c21-0800200c9a66?width=200&amp;height=150}}`<br>**width**: Breite des Vorschaubildes,<br>**height**: Höhe des Vorschaubildes,<br>**alt**: Alternativer Text,<br>**class**: CSS-Klasse,<br>**rel**: rel-Attribut (z. B. "lightbox"),<br>**mode**: Modus ("proportional", "crop" oder "box"). |
| `{{picture::*}}`         | Dieses Tag wird mit einem `<picture>`-Element und verschiedenen Bildgrößen ersetzt, abhängig von der verwendeten Bildgrößen-Konfiguration (wobei * eine Datenbank ID, eine UUID oder ein Pfad aus dem Dateisystem sein kann):<br>`{{picture::58ca4a90-2d30-11e4-8c21-0800200c9a66?size=1&amp;template=picture_default}}`.<br>**width**: Breite des Vorschaubildes,<br>**height**: Höhe des Vorschaubildes,<br>**alt**: Alternativer Text,<br>**class**: CSS-Klasse,<br>**rel**: rel-Attribut (z. B. "lightbox"),<br>**mode**: Modus ("proportional", "crop" oder "box"),<br>**size**: ID einer Bildgröße (siehe Themes -&gt; Bildgrößen),<br>**template**: Zu verwendendes Template (picture_default).{{< version "4.8" >}}<strong>size</strong> unterstützt die vordefinierten Bildgrößen aus `config.yml`. |
| `{{label::*}}`           | Dieses Tag wird mit einer Übersetzung ersetzt. Der erste Parameter ist der Name einer Sprachdatei oder einem Akronym (z. B. `CNT` für Länder oder `LNG` für Sprachen). Beispiele: `{{label::CNT:au}}` wird zu »Australien« und `{{label::tl_article:title:0}}` wird zu »Titel«. Beachte, dass innerhalb des Pfads zur Bezeichnung nur einfache Doppelpunkte verwendet werden. |
| `{{version}}`            | Dieses Tag wird mit der verwendeten Contao-Version (z. B. 4.8.2) ersetzt.                            |
| `{{request_token}}`      | Dieses Tag wird mit dem zur aktuellen Session gehörenden Request-Token ersetzt.                      |
| `{{toggle_view}}`        | Dieses Tag wird mit einem Link ersetzt, welcher zwischen Mobile- und Desktop-Layout wechselt. Das mobile Seitenlayout ist **ab Contao 4.8** nicht mehr Teil der Core-Distribution. Wenn du die Funktion benötigst, muss du das Paket `contao/mobile-page-layout-bundle` installieren. |
| `{{br}}`                 | Dieses Tag wird mit einem HTML <code>&lt;br&gt;</code> Element (Zeilenumbruch) ersetzt.              |


## Insert-Tag-Flags

Mittels Flags kannst du Insert-Tags weiter verarbeiten. Der Wert kann damit z. B. einer PHP-Funktion übergeben werden. 
Beliebig viele Flags können miteinander kombiniert werden:

```
{{ua::browser|uncached}}
{{page::title|decodeEntities|strtoupper}}
```
Verfügbare Flags:

| Flag                | Beschreibung                                                             | Weitere Informationen                             |
|:--------------------|:-------------------------------------------------------------------------|:--------------------------------------------------|
| `uncached`          | Erhält das Tag beim Schreiben der Cache-Datei.                           |                                                   |
| `refresh`           | Erstellt die Ausgabe bei jeder Anfrage neu.                              |                                                   |
| `addslashes`        | Stellt bestimmten Zeichen eines Strings ein "\" voran.                   | [PHP-Funktion](https://php.net/addslashes)        |
| `stripslashes`      | Entfernt das "\" vor bestimmten Zeichen eines Strings.                   | [PHP-Funktion](https://php.net/stripslashes)      |
| `standardize`       | Standardisiert die Ausgabe (z. B. das Alias bei der Seitenstruktur).     |                                                   |
| `ampersand`         | Wandelt Und-Zeichen in Entities um.                                      |                                                   |
| `specialchars`      | Wandelt Sonderzeichen in Entities um.                                    |                                                   |
| `nl2br`             | Fügt vor allen Zeilenumbrüchen eines Strings HTML-Zeilenumbrüche ein.    | [PHP-Funktion](https://php.net/nl2br)             |
| `nl2br_pre`         | Erhält die Zeilenumbrüche innerhalb von `<pre>`-Tags.                    |                                                   |
| `strtolower`        | Wandelt die Ausgabe in Kleinbuchstaben um.                               | [PHP-Funktion](https://php.net/strtolower)        |
| `utf8_strtolower`   | Unicode-bewusste Umwandlung in Kleinbuchstaben.                          |                                                   |
| `strtoupper`        | Wandelt die Ausgabe in Großbuchstaben um.                                | [PHP-Funktion](https://php.net/strtoupper)        |
| `utf8_strtoupper`   | Unicode-bewusste Umwandlung in Großbuchstaben.                           |                                                   |
| `ucfirst`           | Wandelt das erste Zeichen in einen Großbuchstaben um.                    | [PHP-Funktion](https://php.net/ucfirst)           |
| `lcfirst`           | Wandelt das erste Zeichen in einen Kleinbuchstaben um.                   | [PHP-Funktion](https://php.net/lcfirst)           |
| `ucwords`           | Wandelt das erste Zeichen jedes Wortes in einen Großbuchstaben um.       | [PHP-Funktion](https://php.net/ucwords)           |
| `trim`              | Entfernt Leerzeichen vom Anfang und Ende der Ausgabe.                    | [PHP-Funktion](https://php.net/trim)              |
| `rtrim`             | Entfernt Leerzeichen vom Anfang der Ausgabe.                             | [PHP-Funktion](https://php.net/rtrim)             |
| `ltrim`             | Entfernt Leerzeichen vom Ende der Ausgabe.                               | [PHP-Funktion](https://php.net/ltrim)             |
| `utf8_romanize`     | Romanisiert die Ausgabe.                                                 |                                                   |
| `strrev`            | Dreht die Ausgabe um.                                                    | [PHP-Funktion](https://php.net/strrev)            |
| `encodeEmail`       | Kodiert E-Mail-Adressen in der Ausgabe.                                  | siehe `String::encodeEmail`                       |
| `decodeEntities`    | Dekodiert Entities in der Ausgabe.                                       | siehe `String::decodeEntities()`                  |
| `number_format`     | Formatiert eine Zahl (keine Dezimalstellen).                             | siehe `System::getFormattedNumber()`              |
| `currency_format`   | Formatiert eine Währung (zwei Dezimalstellen).                           | siehe `System::getFormattedNumber()`              |
| `readable_size`     | Wandelt die Ausgabe in ein menschenlesbares Format um.                   | siehe `System::getReadableSize()`                 |
| `urlencode`         | URL-kodiert einen String.                                                | [PHP-Funktion](https://php.net/urlencode)         |
| `rawurlencode`      | URL-Kodierung nach RFC 3986.                                             | [PHP-Funktion](https://php.net/rawurlencode)      |


## Basic Entities

Folgende »Basic Enities« werden von Contao in die jeweiligen HTML Entities zurück umgewandelt:

| Basic Entities | HTML Entities          |
|:---------------|:-----------------------|
| `[&]`          | `&amp;` = ampersand    |
| `[lt]`         | `&lt;` = less than     |
| `[gt]`         | `&gt;` = greater than  |
| `[nbsp]`       | `&nbsp;` = non-breaking space<br>Wenn der Umbruch zwischen zwei Wörtern verhindert werden soll, muss ein geschütztes Leerzeichen eingefügt werden. z. B. `Contao[nbsp]CMS` |
| `[-]`          | `&shy;` = soft hyphen<br>Das Wort wird umgebrochen, wenn nicht ausreichend Platz zur Verfügung steht. Die Trennung erfolgt mit Trennstrich. z. B. `Donau[-]dampf[-]schiff[-]fahrts[-]gesell[-]schaft` |
