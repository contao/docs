---
title: "Modulverwaltung"
description: "Frontend-Module generieren den HTML-Code der Webseite. Sie gehören zu den designrelevanten Elementen und 
sind deswegen dem Theme-Manager untergeordnet."
url: "modulverwaltung"
weight: 8
---

Auf den vorangegangenen Seiten hast du gelernt, dass der Aufbau einer Seite durch das ihr zugewiesene Seitenlayout 
bestimmt wird. Darin werden unter anderem verschiedene Layoutbereiche definiert, in denen du beliebige Frontend-Module 
platzieren kannst, die wiederum den HTML-Code deiner Webseite generiert.

Auf diesem Seite geht es nun um die Erstellung und Konfiguration dieser Frontend-Module, die als Teil des Designs dem 
Theme-Manager untergeordnet sind. Jedes Modul, das du anlegst, ist also automatisch einem bestimmten Theme zugeordnet 
und kann mit diesem exportiert und in einer anderen Installation wiederverwendet werden.

Die Modulverwaltung rufst du demzufolge über den Theme-Manager wie im Abschnitt 
[Themes konfigurieren](../../theme-manager/themes-verwalten/#themes-konfigurieren) beschrieben auf.

{{% children %}}

Genau wie bei den Inhaltselementen kannst du unter **Zugriffsschutz** auch den Zugriff auf ein Frontend-Modul auf bestimmte 
Mitgliedergruppen beschränken.

![Den Zugriff auf ein Modul einschränken](/module-management/images/de/den-zugriff-auf-ein-modul-einschraenken.png)

**Modul schützen:** Das Modul ist standardmäßig unsichtbar und wird erst eingeblendet, nachdem sich ein Mitglied im 
Frontend angemeldet hat.

**Erlaubte Mitgliedergruppen**: Hier legst du fest, wer Zugriff auf das Modul hat.

In der **Experten-Einstellungen** kann das Modul nur für Gäste angezeigt werden.

**Nur Gästen anzeigen:** Das Modul ist standardmäßig sichtbar und wird ausgeblendet, sobald sich ein Mitglied im 
Frontend angemeldet hat.
