---
title: "Inhaltselemente"
description: "Um das Anlegen von Inhalten möglichst intuitiv zu gestalten, gibt es in Contao für jeden Inhaltstyp ein 
Inhaltselement, das genau auf dessen Anforderungen abgestimmt ist."
url: "artikelverwaltung/inhaltselemente"
aliases:
    - /de/artikelverwaltung/inhaltselemente/
weight: 20
---


Um das Anlegen von Inhalten möglichst intuitiv zu gestalten, gibt es in Contao für jeden Inhaltstyp ein Inhaltselement, 
das genau auf dessen Anforderungen abgestimmt ist. Du kannst unbegrenzt viele Inhaltselemente pro Artikel anlegen und 
den Zugriff auf einzelne Elemente bei Bedarf einschränken.


## Übersicht

{{% children %}}


## Zugriffsschutz

![Den Zugriff auf ein Inhaltselement einschränken]({{% asset "images/manual/article-management/de/den-zugriff-auf-ein-modul-einschraenken.png" %}}?classes=shadow)

| Info                                  |                                                                 |
|---------------------------------------|-----------------------------------------------------------------|
| **Element schützen:**                | Das Inhaltselement nur bestimmten Mitgliedergruppen anzeigen.   |
| **Erlaubte&nbsp;Mitgliedergruppen:**  | Diese Gruppen können das Inhaltselement sehen.                  |


## Verschachtelte Inhaltselemente

{{< version "5.3" >}}

Wenn du einer dieser Elementtypen [Akkordeon](/de/artikelverwaltung/inhaltselemente/verschiedenes/#akkordeon), 
[Elementgruppe ](/de/artikelverwaltung/inhaltselemente/verschiedenes/#elementgruppe) und 
[Content-Slider](/de/artikelverwaltung/inhaltselemente/verschiedenes/#content-slider) auswählst, erstellst du ein verschachteltes Inhaltselement. Früher musstest du ein
Umschlag Anfang und ein Umschlag Ende erstellen und darin wurde dann der Inhalt platziert.

![Die Zeit vor den verschachtelten Elementen]({{% asset "images/manual/article-management/de/die-zeit-vor-den-verschachtelten-elementen.png" %}}?classes=shadow)

Das konnte sehr schnell unübersichtlich werden und wenn du z. B. aus Versehen nur eines der Elemente versteckt bzw.
gelöscht hast, konnte es passieren, dass es Auswirkungen auf die Darstellung im Frontend hatte. Doch das gehört mit der
Einführung der verschachtelten Inhaltselemente der Vergangenheit an.

![Die verschachtelten Inhaltselemente sind da]({{% asset "images/manual/article-management/de/die-verschachtelten-inhaltselemente-sind-da.png" %}}?classes=shadow)

Bei den neuen verschachtelten Inhaltselementen erstellst du ein Element, in welchem du dann Kindelemente unterbringen
kannst. Du erkennst verschachtelte Inhaltselemente an dem Icon ![Kindelement]({{% asset "icons/children.svg" %}}?classes=icon).
