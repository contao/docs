---
title: "Dateien und Ordner verwalten"
description: "Die Dateiverwaltung bildet die Verzeichnisstruktur in einem hierarchischen Baum ab."
url: "dateiverwaltung/dateien-und-ordner-verwalten"
aliases:
    - /de/dateiverwaltung/dateien-und-ordner-verwalten/
weight: 10
---

Die Dateiverwaltung bildet die Verzeichnisstruktur in einem hierarchischen Baum ab. Jeder Unterordner ist ein eigener 
Knoten, den du über das ![Plussymbol]({{% asset "icons/fol" %}}Plus.svg?classes=icon) Plus- und 
![Minussymbol]({{% asset "icons/fol" %}}Minus.svg?classes=icon) Minussymbol aus- bzw. einklappen kannst. Innerhalb jedes 
Unterordners werden die darin enthaltenen Dateien aufgelistet. Handelt es sich dabei um Bilder, wird automatisch eine 
Voransicht angezeigt. Bei einer großen Menge an Bildern kannst du die Voransicht in deinem Benutzerprofil deaktivieren,
damit die Seite schneller lädt.


## Die Navigationssymbole

Die Navigation erfolgt wie überall in Contao mithilfe von Navigationssymbolen. Die Optionen sind dabei für Ordner und 
Dateien unterschiedlich.

![Die Dateiverwaltung]({{% asset "images/manual/file-manager/de/der-dateimanager.png" %}}?classes=shadow)

**![Datei oder Verzeichnis bearbeiten]({{% asset "icons/edit.svg" %}}?classes=icon) Bearbeiten:** Öffnet eine Eingabemaske zum 
Umbenennen einer Datei bzw. eines Ordners. Außerdem können Metadaten von Dateien in der passenden Sprache eingepflegt 
oder Ordner veröffentlicht bzw. vor der Synchronisation ausgeschlossen werden.

**![Datei oder Verzeichnis duplizieren]({{% asset "icons/copy.svg" %}}?classes=icon) Duplizieren:** Kopiert eine Datei bzw. 
einen Ordner.

**![Datei oder Verzeichnis verschieben]({{% asset "icons/cut.svg" %}}?classes=icon) Verschieben:** Verschiebt eine Datei bzw. 
einen Ordner.

**![Datei oder Verzeichnis löschen]({{% asset "icons/delete.svg" %}}?classes=icon) Löschen:** Löscht eine Datei bzw. einen 
Ordner.

**![Details der Datei bzw. des Ordners anzeigen]({{% asset "icons/show.svg" %}}?classes=icon) Informationen:** Details der 
Datei bzw. des Ordners anzeigen.

**![Dateien in den Ordner hochladen]({{% asset "icons/new.svg" %}}?classes=icon) Hochladen:** Dateien in den Ordner hochladen.

**![Datei bearbeiten]({{% asset "icons/editor.svg" %}}?classes=icon) Datei bearbeiten:** Öffnet eine Eingabemaske zur 
Bearbeitung des Inhalts einer Datei mit einem Texteditor. Welche Dateien editiert werden dürfen, kannst du in der
Konfigurationsdatei [`config/config.yml`](../../system/einstellungen/#config-yml) unter dem Schlüssel `editable_files`
festlegen<sup>1</sup>.

{{% notice note %}}
<sup>1</sup>Bis zur Version 4.6 von Contao konnte dies in den System-Einstellungen unter »Dateien und Bilder 
-&gt; Editierbare Dateien« festlegt werden.
{{% /notice %}}

**![Datei oder Verzeichnis verschieben]({{% asset "icons/drag.svg" %}}?classes=icon) Verschieben:** Eine Datei bzw. einen Ordner per Drag & Drop verschieben.


## Dateien übertragen {#dateien-uebertragen}

Rufe die Dateiverwaltung auf, und klicke auf den Link 
**![Dateien auf den Server hochladen]({{% asset "icons/new.svg" %}}?classes=icon) Datei-Upload**, um Dateien auf den Server zu 
übertragen. Über das Navigationssymbol **![In den Ordner einfügen]({{% asset "icons/pasteinto.svg" %}}?classes=icon) Einfügen 
in** kannst du das Zielverzeichnis auswählen. Alternativ kannst du direkt beim gewünschten Ordner auf das 
Navigationssymbol ![Dateien auf den Server hochladen]({{% asset "icons/new.svg" %}}?classes=icon) klicken.

In den Benutzereinstellungen kannst du darüber hinaus [DropZone](https://www.dropzonejs.com/) aktivieren.

![Dateien übertragen]({{% asset "images/manual/layout/file-manager/de/dateien-uebertragen.png" %}}?classes=shadow)

In beiden Fällen prüft die Dateiverwaltung beim Upload die Größe der zu übertragenden Datei, und – falls es sich dabei um 
ein Bild handelt – auch dessen Abmessungen. Standardmäßig werden Dateien bis zu 2 MB und Bilder bis zu 3000x3000 Pixel 
akzeptiert. Ist eine Datei zu groß bzw. ein Bild zu breit oder zu hoch, verweigert Contao den Upload bzw. verkleinert 
das Bild automatisch auf die maximal zulässigen Abmessungen.

Beachte, dass nur die Dateitypen hochgeladen werden können, die du in den Backend-Einstellungen unter »Erlaubte 
Upload-Dateitypen« festgelegt hast.

Wenn du eine Datei in einen Ordner hochlädst, wo bereits eine Datei mit dem gleichen Namen liegt, wird diese Datei aktualisiert 
und die bestehende UUID bleibt erhalten. So kannst du eine existierende Datei überschreiben, ohne bestehende Verknüpfungen in 
Inhaltselementen o.ä. neu zuweisen zu müssen.

## Dateien per FTP übertragen {#dateien-per-ftp-uebertragen}

Contao kann sowohl Dateien verarbeiten, die mit der Dateiverwaltung auf den Server übertragen wurden, als auch Dateien 
bzw. Ordner, die du mit einem FTP-Programm hochgeladen hast. Damit die Ressourcen im datenbankgestützten Dateisystem 
von Contao hinterlegt werden, musst du auf den Link 
**![Dateisystem und Datenbank synchronisieren]({{% asset "icons/sync.svg" %}}?classes=icon) Synchronisieren** klicken.

Beim Upload über FTP gibt es allerdings eine kleine Einschränkung: Die Dateinamen sollten keine Sonderzeichen 
enthalten. Viele Server bzw. FTP-Programme verwenden intern eine andere Zeichenkodierung als Contao, daher kann es beim 
FTP-Upload von Dateien mit Sonderzeichen im Dateinamen zu Problemen kommen. Folgendermaßen solltest du deine Dateien 
also lieber **nicht** benennen:

`Wies'n-Festzug München (Sonnenstraße).jpg`

`Hend'l + Maß im Schützenfestzelt.jpg`

Für das Web ist es generell besser, auf Sonderzeichen in Dateinamen ganz zu verzichten. Dadurch vermeidest du 
eventuelle Kompatibilitätsprobleme sowie unschön kodierte URLs und kryptische Dateinamen. Folgende Bezeichnungen sind 
optimal:

`Wiesn-Festzug-Muenchen-Sonnenstrasse.jpg`

`Hendl-und-Mass-im-Schuetzenfestzelt.jpg`

Beim Upload über die Dateiverwaltung überprüft Contao die Dateinamen und passt sie gegebenenfalls automatisch an, sodass 
Probleme mit falsch kodierten Sonderzeichen in der Bezeichnung von vornherein vermieden werden.
