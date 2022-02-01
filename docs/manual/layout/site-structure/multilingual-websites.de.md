---
title: "Mehrsprachige Webseiten"
description: "Mehrsprachige Webseiten werden in Contao ebenfalls über verschiedene Webseiten in der Seitenstruktur 
realisiert, die sich im Gegensatz zum Multidomain-Betrieb nicht anhand des Domainnamens unterscheiden, sondern anhand 
der Sprache."
url: "layout/seitenstruktur/mehrsprachige-webseiten"
aliases:
    - /de/seitenstruktur/mehrsprachige-webseiten/
    - /de/layout/seitenstruktur/mehrsprachige-webseiten/
weight: 40
---

Mehrsprachige Webseiten werden in Contao ebenfalls über verschiedene Webseiten in der Seitenstruktur realisiert, die 
sich im Gegensatz zum Multidomain-Betrieb nicht anhand des Domainnamens unterscheiden, sondern anhand der Sprache.

Generell gibt es zwei Möglichkeiten, mehrsprachige Webseiten abzubilden:

1. Pro Sprache wird eine separate Webseite innerhalb der Seitenstruktur angelegt. Die Struktur der Webseiten kann dabei 
vollkommen unterschiedlich sein. Es muss also z. B. auf der deutschen Webseite nicht dieselben Seiten und Menüpunkte 
geben wie auf der englischen Webseite.
2. Es gibt nur eine Webseite in der Seitenstruktur, deren Inhalte in verschiedenen Sprachen vorliegen. Dieser Ansatz 
kommt mit deutlich weniger Seiten in der Seitenstruktur aus, erfordert dafür aber eine zusätzliche Abstraktionsebene 
für die Verwaltung der mehrsprachigen Inhalte.
  
In Contao wird ausschließlich die erste Variante unterstützt (bis auf einige Third-Party-Erweiterungen, die für die 
Verwaltung eigener Inhalte von diesem Konzept abweichen).

Damit die Sprache der URL (z. B. `www.example.com/de/`) hinzugefügt wird, musst du folgende Zeilen in die `config.yml` 
im Ordner `config/` einfügen. Falls die Datei noch nicht vorhanden ist, muss diese angelegt werden.

```yaml
contao:
    prepend_locale: true
```

{{% notice info %}}
**Cache leeren**  
Damit die Änderungen aktiv werden muss der Anwendungs-Cache über den Contao Manager (»Systemwartung« > »Prod.-Cache 
erneuern«) oder alternativ über die Kommandozeile erneuert werden.

```bash
vendor/bin/contao-console cache:clear --env=prod --no-warmup
vendor/bin/contao-console cache:warmup --env=prod
```
{{% /notice %}}

Ab Contao **4.10** kann der URL-Präfix beliebig im Startpunkt der Website festgelegt werden. Dadurch ist es einerseits
möglich einen Präfix zu verwenden, der anders als die Sprache selbst lautet und andererseits ist es möglich einen Startpunkt
auch ohne Präfix zu benutzen, während die anderen Startpunkte der selben Domain weiterhin einen Präfix haben. Zum Beispiel
`example.com` für die Englische Version der Website und `example.com/de` für die Deutsche Version. Damit diese Einstellung
möglich wird, muss aber das »[Legacy Routing][LegacyRouting]« über die Konfiguration deaktiviert werden:

```yaml
# config/config.yml
contao:
    legacy_routing: false
```


## Auffinden des richtigen Startpunkts

Durch die Kombination von Domainname, Sprache und Sprachen-Fallback entstehen vier Möglichkeiten, die Contao bei jedem 
Frontend-Aufruf prüfen muss:

- Gibt es eine Seite, die zur Domain und zur Sprache des Besuchers passt?
- Gibt es eine Seite, die zur Domain passt und als Sprachen-Fallback markiert ist?
- Gibt es eine Seite ohne Domaineintrag, die zur Sprache des Besuchers passt?
- Gibt es eine Seite ohne Domaineintrag, die als Sprachen-Fallback markiert ist?

Die Prüfung erfolgt also vom speziellsten Fall, in dem sowohl die Domain als auch die Browsersprache übereinstimmen, 
bis hin zum allgemeinsten Fall, in dem weder die Domain noch die Browsersprache übereinstimmen und daher die 
Auffangseite geladen wird. Lass uns das an einem konkreten Beispielszenario nachvollziehen.

**Anwendungsbeispiel**

Nehmen wir an, du hast zwei Domains, eine geschäftliche und eine private:

- `www.firma.de`
- `www.privat.de`

Die geschäftliche Seite ist zweisprachig, daher benötigst du insgesamt drei Startpunkte:

**DNS-Einstellungen für die verschiedenen Startpunkte**

| Seite            | Domainname  | Sprache  | Sprachen-Fallback  |
|:-----------------|:------------|:---------|:-------------------|
| Firma deutsch    | -           | de       | -                  |
| Firma englisch   | -           | en       | ja                 |
| Privat           | privat.de   | de       | ja                 |

Besucher werden in Abhängigkeit von der aufgerufenen Domain und der im Browser eingestellten Sprache dann wie folgt 
weitergeleitet:

**Weiterleitung der Besucher auf die verschiedenen Startpunkte**

| Domain           | Browsersprache  | Ziel            | Übereinstimmung    |
|:-----------------|:----------------|:----------------|:-------------------|
| www.firma.de     | Deutsch         | Firma deutsch   | Sprache            |
| www.firma.de     | Englisch        | Firma englisch  | Sprache            |
| www.firma.de     | Spanisch        | Firma englisch  | -                  |
| www.privat.de    | (egal)          | Privat          | Domain             |

Die ersten drei Fälle führen alle zur Firmenseite, auch wenn die Domain `firma.de` gar nicht explizit in den 
DNS-Einstellungen hinterlegt ist. Das ist auch gar nicht notwendig, denn die Firmenseite ist in diesem Fall quasi die 
Auffangseite für unbekannte Domains.

Die ersten beiden Fälle konnten anhand der Browsersprache eindeutig einem Startpunkt zugeordnet werden, lediglich im 
dritten Fall musste die Sprachen-Fallback-Seite geladen werden. Der dritte Fall ist also der allgemeinste Fall, der 
alle Anfragen auffängt, die nicht eindeutig zugeordnet werden können.

Der vierte Fall gehört aufgrund der Domain ganz klar zur privaten Webseite, egal welche Sprache der Besucher spricht. 
Dank des Sprachen-Fallbacks haben Surfer auf der ganzen Welt Zugriff auf die Webseite. Und hier erkennst du auch die 
Wichtigkeit eines Sprachen-Fallbacks: ohne dieses wäre die private Webseite nur für deutschsprachige Besucher verfügbar!
Alle anderen sähen nur ein »No pages found«.


[LegacyRouting]: /de/layout/seitenstruktur/seiten-konfigurieren/#legacy-routing-modus
