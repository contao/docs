---
title: "EasyThemes"
description: "Einfacheres Verwalten von Themes mit EasyThemes."
url: "erweiterungen/contao-easy_themes"
---

**[terminal42/contao-easy_themes](https://packagist.org/packages/terminal42/contao-easy_themes)**

_von [terminal42 gmbh](https://www.terminal42.ch/de/)_

Ermöglicht den direkten Zugriff auf Stylesheets, Module, Seitenlayouts und Bildgrößen.  
Nicht nur bei mehreren Themes ein Klickzahlreduzierer.

Melde dich, nach erfolgreicher Installation, im Backend an und rufe in der »Benutzerverwaltung« den Reiter »Benutzer« 
auf. Wähle aus der Benutzerliste den Benutzer der in den Genuss von EasyThemes kommen soll. Klicke auf das 
![Benutzer bearbeiten](/de/icons/edit.svg?classes=icon "Benutzer bearbeiten") Bearbeiten-Symbol, um dann im letzten 
Abschnitt der Benutzerverwaltung den Haken bei **EasyTheme aktivieren** zu setzen.

![EasyTheme aktivieren]({{% asset "images/manual/extensions/de/contao-easy_themes-aktivieren.png" %}}?classes=shadow)

Unter **Aktive Module** bestimmst du, welche Module angezeigt werden sollen.

Es stehen folgende Module zur Verfügung:

- **Theme bearbeiten:** Hier kannst du die Einstellungen des Themes bearbeiten.
- **Stylesheets:** Hier kannst du neue Stylesheets anlegen und bestehende bearbeiten.
- **Frontend-Module:** Hier kannst du neue Frontend-Module anlegen und bestehende bearbeiten.
- **Seitenlayouts:** Hier kannst du neue Seitenlayouts anlegen und bestehende bearbeiten.
- **Bildgrößen:** Hier kannst du neue Bildgrößen anlegen und bestehende bearbeiten.

{{% notice note %}}
Der interne CSS-Editor ist veraltet und wird in einer der nächsten Contao-Versionen entfernt!
{{% /notice %}}

Im **EasyTheme Modus** musst du dich für eine von vier Anzeige-Arten entscheiden.

**Kontextmenü:** Das Auswahlmenü erscheint beim Rechtsklick auf Themes.

![EasyTheme Modus: Kontextmenü]({{% asset "images/manual/layout/extensions/de/contao-easy_themes-modus-kontextmenue.png" %}}?classes=shadow)

**Mouseover:** Das Auswahlmenü erscheint beim Mouseover von Themes.

![EasyTheme Modus: Mouseover]({{% asset "images/manual/layout/extensions/de/contao-easy_themes-modus-mouseover.png" %}}?classes=shadow)

**DOM-Inject:** Das Auswahlmenü wird direkt unter Themes angezeigt.

![EasyTheme Modus: DOM-Inject]({{% asset "images/manual/layout/extensions/de/contao-easy_themes-modus-dom-inject.png" %}}?classes=shadow)

**Backend Module (ohne Auswahl einer Referenz-Gruppe):**
Erstellt ein zusätzliches Backend-Modul über dem Abschnitt »Inhalte«.

![EasyTheme Modus: Backend Module (ohne Auswahl einer Referenz-Gruppe)]({{% asset "images/manual/layout/extensions/de/contao-easy_themes-modus-backend-module-ohne-referenz.png" %}}?classes=shadow)

**Backend Module (mit Auswahl einer Referenz-Gruppe):**
Erstellt ein zusätzliches Backend-Modul unter dem gewähltem Abschnitt.
Im Beispiel wird es unter »Inhalte« platziert.

![EasyTheme Modus: Backend Module (mit Auswahl einer Referenz-Gruppe)]({{% asset "images/manual/layout/extensions/de/contao-easy_themes-modus-backend-module-mit-referenz.png" %}}?classes=shadow)

Nimm dir Zeit und sei trotzdem schneller.
