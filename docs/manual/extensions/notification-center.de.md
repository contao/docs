---
title: "Notification Center"
menuTitle: Notification Center
description: "Das Notification Center ist eine Erweiterung für Benachrichtigungen."
url: erweiterungen/notification-center
---

**[terminal42/contao-notification_center](https://github.com/terminal42/contao-notification_center)**

_von [terminal42](https://terminal42.ch)_


## Integration in den Contao-Newsletter

Um diese Erweiterung im Rahmen der Newsletter-Verwaltung zu verwenden, müssen die Module `Newsletter abonnieren` und `Newsletter kündigen` durch die korrespondierenden Module `Newsletter abonnieren (Notification Center)` und `Newsletter kündigen (Notification Center)` ausgetauscht werden.

Ausserdem muss das Modul `Newsletter aktivieren (Notification Center)` vorzugsweise auf derselben Seite wie schon das Modul `Newsletter abonnieren (Notification Center)` eingebunden werden. Dieses Modul erzeugt keinen sichtbaren Inhalt. Während das Modul `Newsletter abonnieren (Notification Center)` das angeforderte Abonnement aufnimmt und das double-opt-in einleitet, reagiert das Modul `Newsletter aktivieren (Notification Center)` auf den vom Benutzer versendeten Aktivierungslink und aktiviert das  Newsletter-Abonnement. 
Damit das funktionieren kann, muss im Modul `Newsletter abonnieren (Notification Center)` die Weiterleitungsseite auf die Seite verweisen, auf welcher sich das Aktivieren-Modul befindet. 

Wenn du ein Modul vom Typ `Abonnieren (Notification Center)` verwendest, wird dir statt der E-Mail-Einstellungen die Möglichkeit geboten, eine Benachrichtigung einzubinden. Diese sollte dann u.A. die Aufgabe der "Abonnementsbestätigung" (double-opt-in) übernehmen. 

Entsprechend kannst du im Modul `Newsletter kündigen (Notification Center)` eine Benachrichtigung einstellen, etwa um dem Benutzer die erfolgreiche Beendigung eines Abonnements zu bestätigen. 

Last not least magst du vielleicht den Benutzer über die erfolgreiche Aktivierung der angeforderten Newsletter mittels einer Benachrichtigung informieren, die du im Modul `Newsletter aktivieren (Notification Center)` einstellst.

Da dir das Notification Center die Möglichkeit bietet flexible Benachrichtigungen einzustellen, kannst du Benachrichtigungen in `BCC` z. B. zu Nachweiszwecken an ein E-Mail-Archiv adressieren.    


### Modul-Konfiguration

Es gelten die gleichen Optionen wie bei den Contao Modulen mit wenigen Unterschieden.

Die E-Mail-Einstellungen entfallen, statt dessen kannst du eine zuvor angelegte Benachrichtigung auswählen.

Das Feld »Eigener Text« ist nicht mehr verfügbar. 

Beim Modul `Newsletter aktivieren (Notification Center)` benötigst du die Felder `Verteiler`und `Verteilermenü ausblenden` nicht, da durch die Dunkelverarbeitung keine Benutzereingabe während der Laufzeit möglich und auch nicht notwendig ist.
