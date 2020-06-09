---
title: "Multidomain-Betrieb"
description: "Multidomain-Betrieb bedeutet, dass eine Contao-Installation unter mehreren Domains erreichbar ist und 
diese jeweils eine unterschiedliche Ausgabe bewirken."
url: "layout/seitenstruktur/multidomain-betrieb"
aliases:
    - /de/seitenstruktur/multidomain-betrieb/
    - /de/layout/seitenstruktur/multidomain-betrieb/
weight: 30
---

Multidomain-Betrieb bedeutet, dass eine Contao-Installation unter mehreren Domains erreichbar ist und diese jeweils 
eine unterschiedliche Ausgabe bewirken. Letzteres ist ein ganz entscheidendes Detail, denn du kannst theoretisch auch 
ein und dieselbe Webseite unter verschiedenen Domains verfügbar machen. Das ist aber weder eine gute Idee im Sinne
der Suchmaschinenoptimierung (Stichwort »Duplicate Content«) noch hat es etwas mit dem Multidomain-Betrieb von Contao 
zu tun.

Für einen echten Multidomain-Betrieb brauchst du neben mehreren Domains auch mehrere Startpunkte in deiner 
Contao-Seitenstruktur. Hast du hingegen nur einen Startpunkt, ist deine Installation einfach nur unter mehreren Domains 
erreichbar. In diesem Fall entscheidest du dich am besten für eine Hauptdomain und leitest die anderen Domains auf 
dies weiter. Eine solche Umleitung lässt sich in der Regel im Control Panel deines Servers oder auch in einer 
`.htaccess`-Datei einrichten.

**Umleitung von example.com auf example.org per .htaccess**

```apacheconf
RewriteEngine On
RewriteCond %{HTTP_HOST} ^www\.example\.com [NC]
RewriteRule (.*) http://www.example.org/$1 [R=301,L]
```

**Anwendungsbeispiel**

Nehmen wir an, eine Agentur betreut eine Firma mit mehreren Webseiten und möchte diese über eine zentrale 
Contao-Installation verwalten. Dazu wurden folgende Domains registriert:

- `firma.at`
- `firma.ch`
- `firma.de`

Alle Domains sind auf die zentrale Installation geroutet, das heißt, Contao ist unter allen drei Domains erreichbar. 
Damit im Frontend nun die jeweils zur Domain passende Webseite geladen wird, müssen in der Seitenstruktur drei 
Startpunkte einer Webseite angelegt und darin im Abschnitt **»DNS-Einstellungen«** die jeweilige Domain in das Feld 
`Domainname` eingetragen werden.

Danach wird Contao beim Aufruf von `firma.at` auch nur noch die Webseite für Österreich anzeigen. Das 
bedeutet beispielsweise auch, dass die URL 

`www.firma.at/produkte.html`

zu einem 404-Fehler führt (Seite nicht gefunden), wenn die Seite »Produkte« zwar in der Seitenstruktur existiert, aber 
der Webseite für die Schweiz zugeordnet ist.
