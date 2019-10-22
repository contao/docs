---
title: "Ein Suchformular erstellen"
description: "Du kannst den Formulargenerator dazu nutzen, um ein eigenes Suchformular zu erstellen und dieses 
beispielsweise in der Kopfzeile deiner Webseite einzubinden."
url: "de/formulargenerator/ein-suchformular-erstellen"
weight: 3
--- 

Wie schon im Abschnitt [Eigene Suchformulare](../../modulverwaltung/website-suche/#eigene-suchformulare) erwähnt, 
kannst du den Formulargenerator nutzen, um ein eigenes Suchformular zu erstellen und dieses beispielsweise in der 
Kopfzeile deiner Webseite einzubinden. Dazu sind folgende Schritte notwendig:

1. Öffne den Formulargenerator, und 
[erstelle ein neues Formular](../../formulargenerator/formulare/#formular-konfiguration). Gebe die Suchseite als 
Weiterleitungsziel an, und wähle *GET* als Übertragungsmethode.
2. Füge dem Formular ein [Textfeld](../../formulargenerator/formularfelder/#textfeld) hinzu, und gebe `keywords` als 
Feldname ein. Wenn du möchtest, kannst du das Feld zu einem Pflichtfeld machen, denn eine Suche ohne Suchbegriff wird 
voraussichtlich nicht besonders viele Ergebnisse bringen.
3. Füge dem Formular optional ein [Radio-Button-Menü](../../formulargenerator/formularfelder/#radio-button-menue) 
hinzu, wenn du möchtest, dass dein Besucher zwischen der UND- und der ODER-Suche wählen kannn. Der Feldname lautet in 
diesem Fall `query_type` und die Optionswerte `and` und `or`.
4. Füge dem Formular eine [Absende-Schaltfläche](../../formulargenerator/formularfelder/#absendefeld) hinzu.

Damit ist das Suchformular fertig, und du kannst es als Frontend-Modul im Seitenlayout in die Kopfzeile oder eine 
beliebige andere Spalte deiner Webseite einbinden.
