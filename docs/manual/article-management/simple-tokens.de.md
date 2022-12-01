---
title: "Simple Tokens"
description: "Simple Tokens sind Platzhalter, die ebenso wie Insert-Tags, Inhalte ausgeben können. "
url: "artikelverwaltung/simple-tokens"
aliases:
    - /de/artikelverwaltung/simple-tokens/
weight: 40
---

Simple Tokens sind Platzhalter, die ebenso wie Insert-Tags, Inhalte ausgeben können. Der Unterschied ist jedoch, dass Simple Tokens nicht nur Inhalte ausgeben können, sondern auch Werte mit Fallabfragen und regulären Ausdrücken analysiert werden können. Simple Tokens sind seit der Version Contao 2.x fester Bestandteil von Contao. Im Gegensatz zu Insert-Tags, die global eingesetzt werden können, entscheiden bei Simple Tokens die Entwickler*innen, welche Simple Tokens zur Verfügung stehen und wo diese eingesetzt werden können. Es empfiehlt sich in die jeweilige Dokumentation der Extension hineinzusehen. Ab Contao 4.10 nutzen Simple Tokens die Symfony Expression Language, mit der die Einsatzzwecke noch erweitert werden können.


## Wie verwende ich Simple Tokens?

Die Ausgabe von Simple Tokens erfolgt mit zwei umschließenden Rauten `##`. Welche Werte ausgegeben werden können, ist in dem jeweiligen Backend-Modul oder Extension zu finden. Innerhalb von Fallabfragen, werden die Rauten weggelassen.


## Welche Simple Tokens stehen zur Verfügung?

Simple Tokens können nur auf dafür vorgesehene Backend-Module bzw. Extensions verwendet werden. Sofern ein Simple Token nicht unterstützt wird, erfolgt eine leere Ausgabe und ein Log-Eintrag, dass ein Simple Token nicht ersetzt werden konnte.

Beispiel:

| Syntax              | Beschreibung                                              | Modul                       |
| --------------------| --------------------------------------------------------- | --------------------------- |
| `##tstamp##`        | Zeitstempel                                               |                             |
| `##flang##`         | Aktuell verwendete Sprache                                |                             |
| `##domain##`        | Aktuelle Domain                                           | Newsletter                  |
| `##link##`          | Link zum Newsletter                                       | Newsletter                  |
| `##channels##`      | Abonnierter News-Channel                                  | Newsletter                  |


## Wo können Simple Tokens eingesetzt werden?

- Benutzer: Modultyp 'Registrierung'
- Benutzer: Modultyp 'Passwort vergessen'
- Newsletter: ['Newsletterleser', 'Abonnieren' und 'Kündigen'](https://docs.contao.org/manual/de/core-erweiterung/newsletter/newsletter-verwaltung/#newsletter-personalisieren)
- Extensions z. B. Notification-Center, Isotope, Catalog-Manager, Meta-Models, Contao-Leads, MP_Forms
- Als Platzhalter in [Insert-Tags](https://docs.contao.org/manual/de/artikelverwaltung/insert-tags/#verschiedenes)


## Weitere Einsatzzwecke:

`datei_von_##tstamp##.pdf` für Dateien erzeugt datei_von_1650437899.pdf

`files/data/##form_broschuere##.pdf` Pfad zur PDF-Datei mit individuellen Dateinamen

Es ist ebenso möglich, Simple Tokens als Fallabfrage zu verwenden. Hierzu werden Simple Tokens nicht mehr mit `##` geschrieben, sondern mit öffnender und schließender Klammer `{}`

Beispiel für das Notification-Center:

```
Anfrage für: ##form_herkunft##
{if form_termine != ""}
   Termin: ##form_termine##
{endif}

{if form_formtyp != "erweitert"}
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
{if flang == "en"}
  Your language is English.
{elseif == "de"}
  Deine Sprache ist Deutsch.
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
| `!==`       | Nicht identisch               |
| `<`         | Kleiner als                   |
| `>`         | Größer als                    |
| `<=`        | Kleiner gleich                |
| `>=`        | Größer gleich                 |

Die Operatoren können mit oder ohne Leerzeichen gesetzt werden. Es funktioniert daher sowohl `{if form_name != ""}` als auch `{if form_name!=""}`.

Ab 4.13 können mittels `&&` und `||` auch mehrere Werte per AND/OR abgefragt werden:

`{if form_value == "foo" || form_value == "bar"}`

Es kann auch überprüft werden, ob ein gewisser Wert gesetzt ist:

```
{if form_value === true}
{if form_value === TRUE}
{if form_value === false}
{if form_value === FALSE}
{if form_value === null}
```
