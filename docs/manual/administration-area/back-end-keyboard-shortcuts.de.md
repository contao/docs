---
title: "Backend-Tastaturkürzel"
description: "Um den Workflow bei der Arbeit mit Contao zu beschleunigen, gibt es im Backend etliche Tastaturkürzel, 
mit denen sich bestimmte Befehle direkt aufrufen lassen."
url: "administrationsbereich/backend-tastaturkuerzel"
aliases:
    - /de/administrationsbereich/backend-tastaturkuerzel/
weight: 20
---

Um den Workflow bei der Arbeit mit Contao zu beschleunigen, gibt es im Backend etliche Tastaturkürzel, mit denen sich
bestimmte Befehle direkt aufrufen lassen. Zum Beispiel befindet sich die Schaltfläche `Speichern` grundsätzlich am Ende 
eines Eingabeformulars, sodass sie erst mit der Maus angeklickt werden kann, wenn die Seite ganz 
nach unten gescrollt wurde.

Normalerweise ist das kein Problem, denn während des Ausfüllen eines Formulars arbeitet man sich ja sowieso von oben
nach unten durch die Seite. Will man aber später nur einen einzelnen Wert am Anfang des Formulars ändern, ist die
Schaltfläche nicht ohne Scrollaufwand erreichbar. In diesem Fall gelangt der geübte Contao-Benutzer mit dem
Tastaturkürzel {{< accesskey "s" >}} auch ohne zu scrollen ans Ziel.


## Allgemeine Tastaturkürzel {#allgemeine-tastaturkuerzel}

Folgende Tastaturkürzel stehen in Contao zur Verfügung:

| Tastaturkürzel        | Schaltfläche            | Erklärung                                                                           |
|:----------------------|:------------------------|:------------------------------------------------------------------------------------|
| {{< accesskey "h" >}} | Startseite              | Führt zur Startseite des Backend (**H**ome).                                        |
| {{< accesskey "q" >}} | Abmelden                | Beendet die aktuelle Backend-Sitzung (**Q**uit).                                    |
| {{< accesskey "b" >}} | Zurück                  | Zurück zur vorherigen Seite (**B**ack).                                             |
| {{< accesskey "n" >}} | Neuer Datensatz         | Legt einen neuen Datensatz an (**N**ew).                                            |
| {{< accesskey "e" >}} | Mehrere bearbeiten      | Wechselt in den »mehrere bearbeiten«-Modus (**E**dit multiple).                     |
| {{< accesskey "f" >}} | Frontend-Vorschau       | Öffnet die Frontend-Vorschau in einem neuen Fenster (**F**ront end preview).        |


## Tastaturkürzel im Bearbeitungsmodus {#tastaturkuerzel-im-bearbeitungsmodus}

Im Bearbeitungsmodus stehen zusätzlich folgende Kürzel zur Verfügung:

| Tastaturkürzel        | Schaltfläche                          | Erklärung                                                                                                                                                                                |
|:----------------------|:--------------------------------------|:-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| {{< accesskey "s" >}} | Speichern                             | Speichert das aktuelle Eingabeformular (**S**ave).                                                                                                                                       |
| {{< accesskey "c" >}} | Speichern und schließen               | Speichert und schließt das aktuelle Eingabeformular (Save and **c**lose). Du gelangst zurück zur vorherigen Seite.                                                                      |
| {{< accesskey "n" >}} | Speichern und neu                     | Speichert das aktuelle Eingabeformular und legt einen neuen Datensatz an (Save and **n**ew).                                                                                             |
| {{< accesskey "d" >}} | Speichern&nbsp;und&nbsp;duplizieren   | Speichert das aktuelle Eingabeformular und dupliziert den Datensatz (Save and **d**uplicate).                                                                                            |
| {{< accesskey "e" >}} | Speichern und bearbeiten              | Speichert das aktuelle Eingabeformular (Save and **e**dit) und wechselt zur Ansicht der Kind-Datensätze, z. B. beim Anlegen von Stylesheets.                                             |
| {{< accesskey "g" >}} | Speichern und zurück                  | Speichert und schließt das aktuelle Eingabeformular (Save and **g**o back). Du gelangst zurück zur übergeordneten Seite, z. B. von einem Inhaltselement direkt zur Artikelübersicht.    |


## Tastaturkürzel im Modus »Mehrere bearbeiten« {#tastaturkuerzel-im-modus-mehrere-bearbeiten}

Im Modus »Mehrere bearbeiten« kommen weitere Kürzel hinzu:

| Tastaturkürzel        | Schaltfläche                             | Erklärung                                                                               |
|:----------------------|:-----------------------------------------|:----------------------------------------------------------------------------------------|
| {{< accesskey "s" >}} | Bearbeiten                               | Bearbeitet alle ausgewählten Felder im Modus »mehrere bearbeiten«.                      |
| {{< accesskey "d" >}} | Löschen                                  | Löscht alle ausgewählten Datensätze im Modus »mehrere bearbeiten« (**D**elete).         |
| {{< accesskey "c" >}} | Kopieren                                 | Kopiert alle ausgewählten Datensätze im Modus »mehrere bearbeiten« (**C**opy).          |
| {{< accesskey "x" >}} | Verschieben                              | Verschiebt alle ausgewählten Datensätze im Modus »mehrere bearbeiten«.                  |
| {{< accesskey "v" >}} | Überschreiben                            | Überschreibt alle ausgewählten Datensätze im Modus »mehrere bearbeiten«.                |
| {{< accesskey "a" >}} | Aliase generieren                        | Generiert den Alias aller ausgewählten Datensätze im Modus »mehrere bearbeiten« neu.    |
| `[Shift]`             | Mehrere&nbsp;Checkboxen&nbsp;auswählen   | Wählt mehrere Checkboxen aus wenn die Shift-Taste gedrückt wird.                        |


## Klicken und Bearbeiten

Elemente können durch Anklicken in den Bearbeitungsmodus geschaltet werden, ohne dass dazu das Bearbeiten-Icon
verwendet werden muss. Folgende Aktionen werden unterstützt:

{{< tabs >}}
{{% tab name="Contao 5+" %}}
Windows:
- `[Ctrl] + Klick`: das Element bearbeiten
- `[Ctrl] + [Shift] + Klick`: die Kinder-Elemente bearbeiten

macOS:

- `[Cmd] + Klick`: das Element bearbeiten
- `[Cmd] + [Shift] + Klick`: die Kinder-Elemente bearbeiten
{{% /tab %}}

{{% tab name="Contao 4" %}}
Windows:
- `[Ctrl] + Klick`: das Element bearbeiten
- `[Ctrl] + [Shift] + Klick`: die Elementeinstellungen bearbeiten

macOS:

- `[Cmd] + Klick`: das Element bearbeiten
- `[Cmd] + [Shift] + Klick`: die Elementeinstellungen bearbeiten
{{% /tab %}}
{{< /tabs >}}


## Tastaturkürzel unter Windows, Linux und Mac {#tastaturkuerzel-unter-windows-linux-und-mac}

Die beschriebenen Tastaturkürzel funktionieren in deinem aktuellen Browser, können aber auf anderen Betriebssystemen oder
Browsern unterschiedlich sein. Eine Übersicht, welche Tastenkombination unter welchem Betriebssystem und Browser benutzt werden muss, bietet
[dieser Artikel][MozillaAccesskey].


[MozillaAccesskey]: https://developer.mozilla.org/en-US/docs/Web/HTML/Global_attributes/accesskey
