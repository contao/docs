Simple Tokens sind Platzhalter, die ebenso wie Insert-Tags, Inhalte ausgeben können. Der Unterschied ist jedoch, dass Simple Tokens nicht nur Inhalte ausgeben können, sondern auch Werte mit Fallabfragen und reguläre Ausdrücke überprüft und ausgegeben werden können. Die Entwickler entscheiden, welche Simple Tokens zur Verfügung stehen. Ab Contao 4.12 sind Simple Tokens teil der Symfony Expression Language können die Einsatzzwecke noch erweitert werden. Simple Tokens sind seit der Version Contao 2.x fester Bestandteil von Contao.


## Wie verwende ich Simple Tokens?
Simple Tokens beginnen und enden mit zwei Rauten `##`. Welche Werte ausgegeben werden können, steht in der jeweiligen Datenbank-Spalte.


## Welche Simple Tokens stehen zur Verfügung?
Simple Tokens können jedoch nur auf dafür vorgesehene Backend-Module bzw. Extensions verwendet werden. Sofern ein Simple Token nicht unterstützt wird, erfolgt eine leere Ausgabe und ein Log-Eintrag, dass ein Simple Token nicht ersetzt werden konnte.

Beispiel:

| Syntax              | Beschreibung                                              | Modul                       |
| --------------------| --------------------------------------------------------- | --------------------------- |
| `##tstamp##`        | Zeitstempel                                               |                             |
| `##flang##`         | Aktuell verwendete Sprache                                |                             |
| `##domain##`        | Aktuelle Domain                                           | Newsletter                  |
| `##link##`          | Link zum Newsletter                                       | Newsletter                  |
| `##channels##`      | Abonnierter News-Channel                                   | Newsletter                  |

## Wo können Simple Tokens eingesetzt werden?
- Benutzer: Modultyp 'Registrierung'
- Benutzer: Modultyp 'Passwort vergessen'
- Newsletter: 'Newsletterleser', 'Abonnieren' und 'Kündigen' (https://docs.contao.org/manual/de/core-erweiterung/newsletter/newsletter-verwaltung/#newsletter-personalisieren)
- Extensions z. B. Notification-Center, Isotope, Catalog-Manager, Meta-Models, Contao-Leads
- Als Platzhalter in Insert-Tags: https://docs.contao.org/manual/de/artikelverwaltung/insert-tags/#verschiedenes



## Weitere Einsatzzwecke:
`datei_von_##tstamp##.pdf` für Dateien erzeugt datei_von_1650437899.pdf

`files/data/##form_broschuere##.pdf` Pfad zur PDF-Datei

Es ist ebenso möglich, Simple Tokens als Fallabfrage zu verwenden. Hierzu werden Simple Tokens nicht mehr mit `##` geschrieben, sondern mit öffnender und schließender Klammer `{}`

Beispiel für das Notification-Center:

```
Anfrage für: ##form_herkunft##
{if form_termine!=""}
   Termin: ##form_termine##
{endif}

{if form_formtyp!="erweitert"}
  Name: ##form_name##
  E-Mail: ##form_email##
  Telefon: ##form_telefon##
  {else}
  Vorname: ##form_vorname##
  Name: ##form_name##
  Straße: ##form_strasse##
  PLZ: ##form_plz##
  Ort: ##form_ort##
{endif}
```

Beispiel für das Newsletter-Modul:
```
{if flang==en}
  Your language is English.
{elseif==de}
  Deine Sprache ist deutsch
{else}
  Couldn't assign a language.
{endif}
```





## Welche Operatoren können bei Bedingungen gesetzt werden?

| Syntax      | Beschreibung                  |
| ----------- | ------------------------------|
| `==`        | Expliziter Vergleich          |
| `!=`        | Ungleich                      |
| `===`       | Strikt mit Typ-Konvertierung  |
| `<`         | Kleiner als                   |
| `>`         | Größer als                    |
| `<=`        | Kleiner gleich                |
| `>=`        | Größer gleich                 |

Generell empfiehlt es sich, keine Leerzeichen vor den Operatoren zu setzen. Mittels `||` und `&&` können auch mehrere Werte per AND/OR abgefragt werden:

`{if value=="foo" || value=="bar"}`

Es kann auch überprüft werden, ob ein gewisser Wert gesetzt ist:
```
{if foo===true}
{if foo===TRUE}
{if foo===false}
{if foo===FALSE}
{if foo===null}
```
