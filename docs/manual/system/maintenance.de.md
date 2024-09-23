---
title: "Systemwartung"
description: "Die meisten Wartungsaufgaben in Contao sind automatisiert, sodass du dich auf deine eigentliche Arbeit 
konzentrieren kannst."
url: "system/systemwartung"
aliases:
    - /de/system/systemwartung/
weight: 20
---

Die meisten Wartungsaufgaben in Contao sind automatisiert, sodass du dich auf deine eigentliche Arbeit konzentrieren 
kannst. Manchmal kann es jedoch notwendig sein, die sonst automatisch ausgeführten Aufgaben der Systemwartung manuell 
zu starten.


## Wartungsmodus

Mit dieser Funktion kann die gesamte Contao-Instanz in den »Wartungsmodus« versetzt werden. Während dieser Modus aktiv
ist, ist die Webseite für reguläre Besucher nicht erreichbar und statt dessen wird ein entsprechender Hinweis angezeigt.
Das Backend ist jedoch weiter normal erreichbar, angemeldete Backend-Benutzer können den Wartungsmodus über die 
Frontend-Vorschau umgehen.

Dieser Modus ist dann sinnvoll, wenn größere Umbauarbeiten im Backend vorgenommen werden müssen und die Auswirkungen
im Frontend nicht sofort sichtbar sein sollen.

Der Wartungsmodus wurde für die Contao-Version 4.13 neugeschrieben. Über die [Kommandozeile](/de/cli/maintenance-mode/) 
kann die komplette Contao-Installation (Back- und Frontend) in den Wartungsmodus versetzt werden. Diese Funktion ist 
sehr nützlich, wenn du eine Aktualisierung an deinem System vornehmen möchtest.

Ausserdem hast du die Möglichkeit das Frontend für jeden 
[Startpunkt einer Website](/de/seitenstruktur/website-startseite/#website-einstellungen) in den Wartungsmodus zu 
versetzen.


## Crawler

Seiten werden automatisch beim Aufruf im Frontend indiziert (es sei denn du bist parallel im Backend angemeldet), daher 
musst du dich um den Suchindex normalerweise keine Gedanken machen. Wenn du allerdings viele Seiten auf einmal 
aktualisiert hast, ist es bequemer, den Suchindex manuell neu aufzubauen, als alle geänderten Seiten einzeln im Browser 
aufzurufen.

Der Crawler kann außerdem auf defekte Links überprüfen, wenn das aktiviert wurde.

{{% notice note %}}
In Contao Versionen vor **4.9** heißt diese Sektion **Suchindex neu aufbauen**. Die Funktion zum Überprüfen auf defekte
Links steht dort nicht zur Verfügung.
{{% /notice %}}

![Den Suchindex automatisch aufbauen]({{% asset "images/manual/system/de/den-suchindex-automatisch-aufbauen.png" %}}?classes=shadow)

{{< version "4.9" >}}

Der Crawler kann auch direkt über die Konsole ausgeführt werden:

```sh
$ vendor/bin/contao-console contao:crawl
```

Da über die Konsole aber ein HTTP-Request-Kontext fehlt, muss zwingend eine Domain angegeben werden. Daher sollte die 
jeweilige Domain immer im Startpunkt der Website eingetragen werden, auch wenn man nur eine Domain betreibt. Alternativ
kann die Default-Domain für die Konsole auch über Konfigurations-Parameter angegeben werden:

```yaml
# config/parameters.yaml
parameters:
    router.request_context.host: 'example.org'
    router.request_context.scheme: 'https'
```

Nähere Informationen dazu findet man in der [Symfony Routing Dokumentation][SymfonyUrlCommands].

### Geschützte Seiten indizieren

Um das Durchsuchen von geschützten Seiten zu erlauben, musst du die Funktion zunächst in den [Backend-Einstellungen][BackendSettings] 
aktivieren. Benutze dieses Feature sehr sorgfältig, und schließe personalisierte Seiten immer von der Suche aus!

{{% notice note %}}
Ab Contao **4.9** wird dies in der Applikations-Konfiguration aktiviert:

```yaml
# config/config.yaml
contao:
    search:
        # Enable indexing of protected pages.
        index_protected: true
```
{{% /notice %}}

Lege danach einen neuen Frontend-Benutzer an, und erlaube ihm den Zugriff auf die zu indizierenden geschützten Seiten. 
Beim Aufbauen des Suchindexes wird dieser Benutzer dann automatisch angemeldet.

Später bei der Suche erscheinen die geschützten Seiten natürlich nur in den Ergebnissen, wenn der angemeldete 
Frontend-Benutzer auch auf sie zugreifen darf.


### Den Prozess beschleunigen

Die Dauer des Crawl-Prozesses hängt primär von zwei Faktoren ab:

1. Anzahl der Seiten die gecrawlet werden
2. Anzahl gleichzeitiger Requests, die der Server verarbeiten kann

#### Die Anzahl der gecrawlten Seiten reduzieren

Ersteres lässt sich beeinflussen, indem beispielsweise URLs die gar nicht relevant sind, vom Crawl-Prozess 
ausgeschlossen werden. Welche URLs genau gecrawlt werden, kannst du bequem über das Debug-Log in Erfahrung bringen.
Im Backend kann dies während der Crawl-Prozess läuft, direkt heruntergeladen werden. Auf der Kommandozeile kannst 
du das Debug-Log wie folgt aktivieren:

```sh
$ vendor/bin/contao-console contao:crawl --enable-debug-csv
```

Du findest das Log als `crawl_debug_log.csv` dann im Hauptverzeichnis deines Contao-Projekts. Den Pfad könntest du 
mit `--debug-csv-path` übrigens auch noch anpassen, sollte das gewünscht sein.

Um ungewünschte Seiten vom Crawl-Prozess auszuschliessen gibt es mehrere Möglichkeiten:

1. Gewisse Seiten über die `robots.txt` komplett von Crawlern ausschliessen.

   Die Konfiguration findet in der Rootseite statt und folgt [einem Standard][Google_Robots_Txt], womit du auch den 
   Contao-Crawler beeinflussen kannst. Solltest du gewisse Anweisungen nur auf den Contao-Crawler beschränken wollen,
   kannst du das mit `User-Agent: contao/crawler` tun.

2. Gewisse Links komplett von allen Crawl-Aktivitäten ausschliessen.

   Den Crawler den Contao nutzt, nennt sich "Escargot" und entsprechend kannst du mit `<a href="..." 
   data-escargot-ignore>...</a>` Links von jeglichen Crawl-Aktivitäten ausschliessen. Wenn Escargot diese Links 
   findet, wird es sie immer ignorieren.

3. Gewisse Links nur vom Suchindex-Subscriber ausschliessen.

   Möchtest du, dass ein Link zwar grundsätzlich von anderen Subscribern beachtet wird, aber vom 
   Suchindex-Subscriber ausgeschlossen werden sollen, kannst du das mit `<a href="..." data-skip-search-index>...</a>`tun.

Ausserdem kommt es darauf an, wie tief der Crawler nach weiteren URLs suchen soll. Die erste Ebene ist die Rootseite,
also bspw. `https://example.com`. Die zweite Ebene sind alle Seiten, die auf `https://example.com` gefunden wurden 
und so weiter. Je höher also die Tiefe, desto mehr Links können gefunden werden und desto länger dauert der 
Crawl-Prozess. Die Tiefe kannst du auf der Kommandozeile über das `--max-depth` Argument steuern.
Im Backend ist die Tiefe auf `3` festgelegt.

{{< version-tag "5.3" >}} Ab Contao 5.3 kannst du die Tiefe auch im Backend auswählen.

#### Die Anzahl der gleichzeitigen Requests beeinflussen

Die Anzahl der gleichzeitigen Requests kannst du ebenfalls erhöhen. Allerdings musst du dann darauf achten, dass du 
dabei den Server nicht überlastest. 

Auf der Kommandozeile steht dir dafür die Option `--concurrency` (oder der Shortcut `-c`) zur Verfügung. Im Backend 
ist die "Concurrency" auf `5` festgelegt.

{{< version-tag "5.3" >}} Ab Contao 5.3 kannst du diesen Wert über die `config.yaml` festlegen:

```yaml
# config/config.yaml
contao:
    backend:
        crawl_concurrency: 10
```

{{% notice "tip" %}}
Falls du dich fragst, warum es konfigurierbar aber nicht im Backend auswählbar ist: Dieser Wert ändert sich 
grundsätzlich nie. Langsamer - also eine tiefere Concurrency - soll der Prozess ja nie dauern und die maximale 
Anzahl hängt davon ab, was dein Server leisten kann. Das ändert sich immer nur dann, wenn du mehr oder weniger 
Ressourcen zur Verfügung stellst.
{{% /notice %}}


### Basic Authentication

Oft wird eine Webseite vor der Veröffentlichung per »Basic Authentication« in der Produktiv- oder Staging-Umgebung geschützt. Damit der
Crawler auch in diesem Fall weiterhin auf alle Seiten zugreifen kann, muss Benutzername und Passwort dafür in der Konfiguration hinterlegt
werden. Dabei wird Benutzername und Passwort mit einem Doppelpunkt getrennt folgendermaßen definiert:

```yaml
# config/config.yaml
contao:
    crawl:
        default_http_client_options:
            auth_basic: 'benutzername:passwort'
```

Weitere Konfigurationsmöglichkeiten für den HTTP-Client des Crawlers findet man in der [Symfony Dokumentation][HttpClientOptions].


## Daten bereinigen

Neben den benutzergenerierten Inhalten speichert Contao verschiedene Systemdaten, die für die Suche oder das 
Wiederherstellen gelöschter Datensätze oder früherer Versionen verwendet werden. Du kannst diese Daten manuell 
bereinigen, um z. B. alte Vorschaubilder zu entfernen oder die XML-Sitemaps nach einer Änderung an der Seitenstruktur 
zu aktualisieren.

![Daten manuell bereinigen]({{% asset "images/manual/system/de/daten-manuell-bereinigen.png" %}}?classes=shadow)


[BackendSettings]: /de/system/einstellungen/
[SymfonyUrlCommands]: https://symfony.com/doc/4.4/routing.html#generating-urls-in-commands
[HttpClientOptions]: https://symfony.com/doc/current/reference/configuration/framework.html#reference-http-client
[Google_Robots_Txt]: https://developers.google.com/search/docs/crawling-indexing/robots/intro