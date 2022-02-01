---
title: "Insert-Tags"
description: "Insert-Tags sind Platzhalter, die bei der Ausgabe einer Seite durch bestimmte Werte ersetzt werden."
url: "artikelverwaltung/insert-tags"
aliases:
    - /de/artikelverwaltung/insert-tags/
weight: 30
---

Insert-Tags sind Platzhalter, die bei der Ausgabe einer Seite durch bestimmte Werte ersetzt werden. Mit Insert-Tags
kannst du z. B. einen Link auf eine Seite oder einen Artikel erstellen, Umgebungsvariablen einfügen oder
Benutzereigenschaften auslesen. Insert-Tags können überall in Contao verwendet werden.

Ein Insert-Tag beginnt immer mit zwei öffnenden geschweiften Klammern, gefolgt von einem Schlüsselwort und zwei
schließenden geschweiften Klammern, also z. B. `{{date}}`. Viele Insert-Tags benötigen zusätzlich noch ein Argument,
das mit zwei Doppelpunkten hinter das Schlüsselwort geschrieben wird, also z. B. `{{link::12}}`.


## Link-Elemente

Mit diesen Insert-Tags kannst du Links auf andere Seiten oder Artikel erstellen. Du benötigst dazu lediglich die ID
oder den Alias der Zielseite.

| Insert-Tag                | Beschreibung                                                                                                                 |
|:--------------------------|:-----------------------------------------------------------------------------------------------------------------------------|
| `{{link::*}}`             | Dieses Tag wird mit dem HTML-Code für einen Link ersetzt. Der Parameter kann entweder die ID oder der Alias einer Seite sein, auch eine absolute URL ist möglich. |
| `{{link::back}}`          | Dieses Tag wird mit einem Link zur der zuletzt besuchte Seite ersetzt. Kann auch als `{{link_open::back}}`, `{{link_url::back}}` und `{{link_title::back}}` verwendet werden.    |
| `{{link::login}}`         | Dieses Tag wird mit einem Link zur Anmeldeseite des aktuellen Frontend-Benutzers (falls vorhanden) ersetzt.                  |
| `{{link_open::*}}`        | Wird mit dem öffnenden Tag eines Links ersetzt. Der Parameter kann entweder die ID oder der Alias einer Seite sein, auch eine absolute URL ist möglich: `{{link_open::12}}Hier klicken{{link_close}}`.       |
| `{{link_url::*}}`         | Dieses Tag wird mit der URL einer internen Seite ersetzt: `<a href="{{link_url::12}}">Hier klicken</a>`.                     |
| `{{link_target::*}}`      | Dieses Tag wird mit ` target="_blank" rel="noreferrer noopener"` ersetzt, wenn es sich bei der angegebenen Seite um eine externe Weiterleitungsseite handelt, und dort eingestellt ist, dass sich der Link in einem neuen Fenster öffnen soll. |
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
| `{{news_feed::*}}`        | Dieser Tag wird mit der URL zu einem News-Feed ersetzt (ersetze * mit der ID).                                         |
| `{{event::*}}`            | Dieses Tag wird mit einem Link zu einem Event ersetzt (ersetze * mit der ID oder dem Alias).                            |
| `{{event_open::*}}`       | Wird mit dem öffnenden Tag eines Links zu einem Event ersetzt: `{{event_open::12}}Hier klicken{{link_close}}`.               |
| `{{event_url::*}}`        | Dieses Tag wird mit der URL eines Events ersetzt: `<a href="{{event_url::12}}">Hier klicken</a>`.                            |
| `{{event_title::*}}`      | Dieses Tag wird mit dem Titel eines Events ersetzt: `<a title="{{event_title::12}}">Hier klicken</a>`.                       |
| `{{calendar_feed::*}}`    | Dieser Tag wird mit der URL zu einem Kalender-Feed ersetzt (ersetze * mit der ID).                                     |
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
| `{{page::description}}`       | Dieses Tag wird mit der Beschreibung der aktuellen Seite ersetzt.                                                                 |
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
| `{{env::host}}`               | Dieses Tag wird mit dem aktuellen Hostnamen ersetzt (z. B. example.com).                         |
| `{{env::url}}`                | Dieses Tag wird mit dem Hostnamen und dem Protokoll ersetzt (z. B. https://www.example.com).      |
| `{{env::path}}`               | Dieses Tag wird mit der aktuellen Basis-URL samt Pfad zum Contao-Verzeichnis ersetzt.            |
| `{{env::request}}`            | Dieses Tag wird mit dem aktuellen Request-String ersetzt (z. B. news/items/willkommen.html).     |
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
| `{{date::*}}`            | Dieses Tag wird mit dem aktuellen Datum gemäß eines individuellen Datumsformats ersetzt. Contao unterstützt alle Datums- und Zeitformate, die mit der [PHP-Funktion date](https://www.php.net/manual/de/function.date.php) geparst werden können (z. B. `{{date::d.m.Y}}`). |
| `{{format_date::*::*}}`  | {{< version-tag "4.10" >}} Mit diesem Tag kann ein UNIX Timestamp oder eine _standardisierte Datumsangabe_ formatiert werden. Der erste Parameter ist der Timestamp bzw. das Datum. Der zweite Parameter ist das Datumsformat (siehe `{{date::*}}`) und optional. Ohne Angabe des Datumsformates wird das Datum gemäß dem globalen Datumsformat ausgegeben. Dieses Tag macht in Kombination mit anderen Tags oder auch Simple Tokens Sinn, um das jeweils ausgegebene Datum bzw. einen ausgegebenen Timestamp (neu) zu formatieren. <br>Beispiele: `{{format_date::{{user::tstamp}}::d.m.Y}}`, `{{format_date::##member_dateAdded##}}`. <br>Kann das Datumsformat nicht automatisch erkannt werden, kann stattdessen `{{convert_date::*::*::*}}` benutzt werden. |
| `{{convert_date::*::*::*}}` | {{< version-tag "4.10" >}} Mit diesem Tag kann ein Datum neu formatiert werden. Der erste Parameter ist das Datum, der zweite Parameter ist dessen Datumsformat (siehe `{{date::*}}`). Der dritte Parameter ist das neue Datumsformat (siehe `{{date::*}}`) und optional. Ohne Angabe des Datumsformates wird das Datum gemäß dem globalen Datumsformat ausgegeben. Dieses Tag macht in Kombination mit anderen Tags oder auch Simple Tokens Sinn, um das jeweils ausgegebene Datum neu zu formatieren. <br>Beispiel: `{{convert_date::##some_date##::Y, j.n.::j. F Y}}` (konvertiert bspw. `2020, 12.7.` zu `12. Juli 2020`). |
| `{{last_update}}`        | Dieses Tag wird mit dem Datum der letzten Aktualisierung gemäß des globalen Datumsformats ersetzt.   |
| `{{last_update::*}}`     | Dieses Tag wird mit Datum der letzten Aktualisierung gemäß eines individuellen Datumsformats ersetzt. Contao unterstützt alle Datums- und Zeitformate, die mit der [PHP-Funktion date](https://www.php.net/manual/de/function.date.php) geparst werden können (z. B. `{{last_update::d.m.Y}}`). |
| `{{email::*}}`           | Dieses Tag wird mit einem kodierten Link zu einer E-Mail-Adresse ersetzt.                      |
| `{{email_open::*}}`      | Dieses Tag wird mit einem kodierten Link zu einer E-Mail-Adresse ersetzt. Allerdings wird das schließende `</a>` nicht angefügt. |
| `{{email_close}}`        | Dieses Tag wird mit `</a>` ersetzt. Beispiel: `{{email_open::foo@example.org}}E-Mail Kontakt{{email_close}}`. |
| `{{email_url::*}}`       | Dieses Tag wird nur durch die kodierte E-Mail-Adresse ersetzt.                                 |
| `{{post::*}}`            | Mit diesem Tag kann eine angegebene Post-Variable ausgelesen und angezeigt werden. Kann z. B. genutzt werden, um auf einzelne Felder eines gesendeten Formulars zuzugreifen. |
| `{{lang::*}}`            | Mit diesem Tag können fremdsprachige Wörter in einem Text markiert werden: `{{lang::fr}}Au revoir{{lang}}`. Dies wird ersetzt mit `<span lang="fr">Au revoir</span>`. |
| `{{abbr::*}}`            | Abkürzungen in einem Text markieren: `{{abbr::World Wide Web}}WWW{{abbr}}`. Dies wird ersetzt mit `<abbr title="World Wide Web">WWW</abbr>`. |
| `{{acronym::*}}`         | Akronyme in einem Text markieren: `{{acronym::Multipurpose Internet Mail Extensions}}MIME{{acronym}}`. Dies wird ersetzt mit `<acronym title="Multipurpose Internet Mail Extensions">MIME</acronym>`. |
| `{{ua::*}}`              | Eigenschaften des Browsers (User Agent) ausgeben: `{{ua::browser}}`. Dies wird beispielsweise ersetzt mit "chrome". |
| `{{iflng::*}}`           | Dieses Tag wird komplett entfernt, wenn die Sprache der Seite nicht mit der Tag-Sprache übereinstimmt. Du kannst so sprachspezifische Bezeichnungen erstellen: `{{iflng::en}}Your name{{iflng::de}}Ihr Name{{iflng}}` {{% notice tip %}}
Du kannst mit `en,de,fr` statt nur auf eine auch auf mehrere Sprachen testen. Zusätzlich kannst du auch `*` als Wildcard verwenden, was insbesondere bei Dialekten nützlich ist (bspw. gilt `de*` dann sowohl für `de_CH` als auch `de_AT`).
{{% /notice %}} |
| `{{ifnlng::*}}`          | Dieses Tag wird komplett entfernt, wenn die Sprache der Seite mit der Tag-Sprache (siehe auch Tipp bei `{{iflng}}` für weitere Optionen) übereinstimmt. Du kannst so sprachspezifische Bezeichnungen erstellen: `{{ifnlng::de}}Your name{{ifnlng}}{{iflng::de}}Ihr Name{{iflng}}` |
| `{{image::*}}`           | Dieses Tag wird mit der Vorschauansicht eines Bildes ersetzt (wobei * eine Datenbank ID, eine UUID oder ein Pfad aus dem Dateisystem sein kann):<br>`{{image::58ca4a90-2d30-11e4-8c21-0800200c9a66?width=200&height=150}}`<br>**width**: Breite des Vorschaubildes,<br>**height**: Höhe des Vorschaubildes,<br>**alt**: Alternativer Text,<br>**class**: CSS-Klasse,<br>**rel**: rel-Attribut (z. B. "lightbox"),<br>**mode**: Modus ("proportional", "crop" oder "box"). |
| `{{picture::*}}`         | Dieses Tag wird mit einem `<picture>`-Element und verschiedenen Bildgrößen ersetzt, abhängig von der verwendeten Bildgrößen-Konfiguration (wobei * eine Datenbank ID, eine UUID oder ein Pfad aus dem Dateisystem sein kann):<br>`{{picture::58ca4a90-2d30-11e4-8c21-0800200c9a66?size=1&template=picture_default}}`.<br>**width**: Breite des Vorschaubildes,<br>**height**: Höhe des Vorschaubildes,<br>**alt**: Alternativer Text,<br>**class**: CSS-Klasse,<br>**rel**: rel-Attribut (z. B. "lightbox"),<br>**mode**: Modus ("proportional", "crop" oder "box"),<br>**size**: ID einer Bildgröße (siehe Themes -&gt; Bildgrößen) (**size** unterstützt die vordefinierten Bildgrößen aus `config.yml`, der Bezeichnung muss ein Unterstrich vorangestellt werden z.B. `_foo`),<br>**template**: Zu verwendendes Template (`picture_default`). |
| `{{figure::*}}`          | {{< version-tag "4.11" >}} Dieses Tag wird mit einem `<figure>`-Element ersetzt, welches ein entsprechendes `<picture>`- und `<figcaption>`-Element (falls anwendbar) enthält. Wie bei `{{picture::*}}` kann der Parameter eine Datenbank ID, eine UUID oder ein Pfad aus dem Dateisystem sein. Als weitere URL-Parameter können alle vom [`FigureBuilder`][DevFigureBuilder] unterstützten Methoden eingesetzt werden:<br><br>`{{figure::58ca4a90-2d30-11e4-8c21-0800200c9a66?`<br><div style="padding-left: 2em">`size=1&`<br>`metadata[title]=Mein%20Bild&`<br>`enableLightbox=1&`<br>`options[attr][class]=main_figure&`<br>`template=image`</div>`}}`.<br><br>**size**: ID einer Bildgröße (siehe Themes -> Bildgrößen) oder vordefinierten Bildgrößen aus `config.yml`, der Bezeichnung muss ein Unterstrich vorangestellt werden z.B. `_foo`,<br>**metadata**: Erlaubt das Überschreiben von Metadaten (z. B. "alt", "title", "caption"),<br>**enableLightbox**: Generiert ein zweites Bild in Lightbox-Größe (siehe Themes -&gt; Lightbox) und fügt dem `<figure>`-Element einen Link hinzu,<br>**options**: Ein Array an Optionen, das ans Template übergeben wird und im Fall des Standard-Templates zum Setzen von HTML-Attributen genutzt werden kann,<br>**template**: Zu verwendendes Twig- oder Contao-Template (z.B. `@FooBundle/figure.html.twig` / `image`).<br><br>Alle Parameter müssen URL-kodiert angegeben werden. Siehe die  [FigureBuilder-Referenz][DevFigureBuilder] aus der Entwickler-Dokumentation für die vollständige Liste an Konfigurationsmöglichkeiten. |
| `{{label::*}}`           | Dieses Tag wird mit einer Übersetzung ersetzt. Der erste Parameter ist der Name einer Sprachdatei oder einem Akronym (z. B. `CNT` für Länder oder `LNG` für Sprachen). Beispiele: `{{label::CNT:au}}` wird zu »Australien« und `{{label::tl_article:title:0}}` wird zu »Titel«. Beachte, dass innerhalb des Pfads zur Bezeichnung nur einfache Doppelpunkte verwendet werden. |
| `{{version}}`            | Dieses Tag wird mit der verwendeten Contao-Version (z. B. 4.13.2) ersetzt.                            |
| `{{request_token}}`      | Dieses Tag wird mit dem zur aktuellen Session gehörenden Request-Token ersetzt.                      |
| `{{br}}`                 | Dieses Tag wird mit einem HTML <code>&lt;br&gt;</code> Element (Zeilenumbruch) ersetzt.              |
| `{{asset::*::*}}`        | Mit diesem Tag können Pfade zu CSS und JavaScript Dateien aus Paketen eingebunden werden. Siehe die [Entwickler-Dokumentation][DevAssets]. |
| `{{trans::*::*::*}}`     | Mit diesem Tag können Übersetzungen ausgegeben werden. Im Gegensatz zum `{{label::*}}` Insert-Tag können damit alle Übersetzungen aus dem Symfony System ausgegeben werden. Beispiel: `{{trans::MSC.updateVersion::contao_default::4.10}}`. Siehe auch die [Entwickler-Dokumentation][Translations]. |


## Verschachtelte Insert-Tags

Insert-Tags, die als Ausgabe eine ID oder Alias haben, können grundsätzlich verschachtelt werden.

| Insert-Tag                       | Ausgabe                |
|:---------------------------------|:-----------------------|
| `{{link::{{page::id}}|absolute}}`| Generiert einen Link mit einer absoluten Ausgabe der aktuell aufgerufenen Seite.   |
| `{{link_url::{{page::id}}}}#sprungmarke`| Generiert einen relativen Link zur aktuellen Seite (nützlich für Onepager). |

{{% notice info %}}
Man sollte darauf achten, keine endlosen Loops wie z. B. durch `{{insert_article::{{page::alias}}}}` zu generieren. Dies kann zum Absturz der Seite führen.
{{% /notice %}}


## Insert-Tag-Flags

Mittels Flags kannst du Insert-Tags weiter verarbeiten. Der Wert kann damit z. B. einer PHP-Funktion übergeben werden.
Beliebig viele Flags können miteinander kombiniert werden:

```
{{ua::browser|uncached}}
{{page::title|standardize|strtoupper}}
```

Verfügbare Flags:

| Flag                | Beschreibung                                                             | Weitere Informationen                             |
|:--------------------|:-------------------------------------------------------------------------|:--------------------------------------------------|
| `uncached`          | Erhält das Tag beim Schreiben der Cache-Datei.                           |                                                   |
| `refresh`           | Erstellt die Ausgabe bei jeder Anfrage neu.                              |                                                   |
| `attr`              | Wandelt Sonderzeichen in Entities um, damit der Insert-Tag in einem HTML-Attribut (z. B. `title="…"`) verwendet werden kann. | siehe&nbsp;`StringUtil::specialcharsAttribute()` |
| `urlattr`           | Wandelt Sonderzeichen in Entities um, gleich wie `attr`. Zusätzlich werden Doppelpunkte URL-enkodiert, um unerlaubte Protokolle wie `javascript:` zu verhindern. | siehe&nbsp;`StringUtil::specialcharsUrl()` |
| `addslashes`        | Stellt bestimmten Zeichen eines Strings ein (<code>\\</code>) voran.     | [PHP-Funktion](https://php.net/addslashes)        |
| `standardize`       | Standardisiert die Ausgabe (z. B. das Alias bei der Seitenstruktur).     |                                                   |
| `absolute`          | Generiert einen absoluten Pfad inkl. Hostnamen und Protokoll             |                        |
| `ampersand`         | Wandelt `&`-Zeichen in Entities um.                                      |                                                   |
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
| `trim`              | Entfernt Leerzeichen vom Anfang und Ende des Ausgabestrings.             | [PHP-Funktion](https://php.net/trim)              |
| `ltrim`             | Entfernt Leerzeichen vom Anfang des Ausgabestrings.                      | [PHP-Funktion](https://php.net/ltrim)             |
| `rtrim`             | Entfernt Leerzeichen vom Ende des Ausgabestrings.                        | [PHP-Funktion](https://php.net/rtrim)             |
| `utf8_romanize`     | Romanisiert die Ausgabe.                                                 |                                                   |
| `encodeEmail`       | Kodiert E-Mail-Adressen in der Ausgabe.                                  | siehe&nbsp;`StringUtil::encodeEmail()`            |
| `number_format`     | Formatiert eine Zahl (keine Dezimalstellen).                             | siehe&nbsp;`System::getFormattedNumber()`         |
| `currency_format`   | Formatiert eine Währung (zwei Dezimalstellen).                           | siehe&nbsp;`System::getFormattedNumber()`         |
| `readable_size`     | Wandelt die Ausgabe in ein menschenlesbares Format um.                   | siehe&nbsp;`System::getReadableSize()`            |
| `urlencode`         | URL-kodiert einen String.                                                | [PHP-Funktion](https://php.net/urlencode)         |
| `rawurlencode`      | URL-Kodierung nach RFC 3986.                                             | [PHP-Funktion](https://php.net/rawurlencode)      |
| `flatten`           | Wandelt ein Array in eine durch Kommas separierte Liste mit Schlüsseln und Werten um. Beispiel: `0: value1, 1: value2, 2: value3` oder `key1: value, key2.subkey: value` |


## Basic Entities

Folgende »Basic Enities« werden von Contao in die jeweiligen HTML Entities zurück umgewandelt:

| Basic Entities | HTML Entities          |
|:---------------|:-----------------------|
| `[&]`          | `&amp;` = ampersand (`&`)    |
| `[lt]`         | `&lt;` = less than (`<`)     |
| `[gt]`         | `&gt;` = greater than (`>`)  |
| `[nbsp]`       | `&nbsp;` = non-breaking space<br>Wenn der Umbruch zwischen zwei Wörtern verhindert werden soll, muss ein geschütztes Leerzeichen eingefügt werden (z. B. `Contao[nbsp]CMS`). |
| `[-]`          | `&shy;` = soft hyphen<br>Das Wort wird umgebrochen, wenn nicht ausreichend Platz zur Verfügung steht. Die Trennung erfolgt mit Trennstrich (z. B. `Donau[-]dampf[-]schiff[-]fahrts[-]gesell[-]schaft`). |
| `[{]`, `[}]`   | Wird im Frontend jeweils mit `{{` bzw. `}}` ersetzt. Damit kann man Insert-Tags im Frontend anzeigen, um sie z. B. zu erklären. |


[DevAssets]: https://docs.contao.org/dev/framework/asset-management/#accessing-assets-in-templates
[DevFigureBuilder]: https://docs.contao.org/dev/framework/image-processing/image-studio/#setting-options
[Translations]: https://docs.contao.org/dev/framework/translations/#accessing-translations
