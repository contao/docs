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
Das Backend ist jedoch weiter normal erreichbar und eingeloggte Backend-Benutzer können auch das Frontend regulär
aufrufen.

Dieser Modus ist dann sinnvoll, wenn größere Umbauarbeiten im Backend vorgenommen werden müssen und die Auswirkungen
im Frontend nicht sofort sichtbar sein sollen.


## Crawler

Seiten werden automatisch beim Aufruf im Frontend indiziert (es sei denn du bist parallel im Backend angemeldet), daher 
musst du dich um den Suchindex normalerweise keine Gedanken machen. Wenn du allerdings viele Seiten auf einmal 
aktualisiert hast, ist es bequemer, den Suchindex manuell neu aufzubauen, als alle geänderten Seiten einzeln im Browser 
aufzurufen.

Der Crawler kann außerdem auf defekte Links überprüfen, wenn das aktiviert wurde.

![Den Suchindex automatisch aufbauen](/de/system/images/de/den-suchindex-automatisch-aufbauen.png?classes=shadow)

Der Crawler kann auch direkt über die Konsole ausgeführt werden:

```sh
$ vendor/bin/contao-console contao:crawl
```

Da über die Konsole aber ein HTTP-Request-Kontext fehlt, muss zwingend eine Domain angegeben werden. Daher sollte die 
jeweilige Domain immer im Startpunkt der Website eingetragen werden, auch wenn man nur eine Domain betreibt. Alternativ
kann die Default-Domain für die Konsole auch über Konfigurations-Parameter angegeben werden:

```yml
# config/parameters.yml
parameters:
    router.request_context.host: 'example.org'
    router.request_context.scheme: 'https'
```

Nähere Informationen dazu findet man in der [Symfony Routing Dokumentation][SymfonyUrlCommands].


### Geschützte Seiten indizieren

Um das Durchsuchen von geschützten Seiten zu erlauben, musst du die Funktion zunächst in den [Backend-Einstellungen][BackendSettings] 
aktivieren. Benutze dieses Feature sehr sorgfältig, und schließe personalisierte Seiten immer von der Suche aus!

{{% notice note %}}
Dies wird in der Applikations-Konfiguration aktiviert:

```yml
# config/config.yml
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


### Basic Authentication

Oft wird eine Webseite vor der Veröffentlichung per »Basic Authentication« in der Produktiv- oder Staging-Umgebung geschützt. Damit der
Crawler auch in diesem Fall weiterhin auf alle Seiten zugreifen kann, muss Benutzername und Passwort dafür in der Konfiguration hinterlegt
werden. Dabei wird Benutzername und Passwort mit einem Doppelpunkt getrennt folgendermaßen definiert:

```yml
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

![Daten manuell bereinigen](/de/system/images/de/daten-manuell-bereinigen.png?classes=shadow)


[BackendSettings]: /de/system/einstellungen/
[SymfonyUrlCommands]: https://symfony.com/doc/4.4/routing.html#generating-urls-in-commands
[HttpClientOptions]: https://symfony.com/doc/current/reference/configuration/framework.html#reference-http-client
