---
title: "Templates"
description: "Der Navigationsbereich Templates."
url: "layout/templates"
aliases:
    - /de/templates/
    - /de/theme-manager/templates-verwalten/
    - /de/layout/templates/    
weight: 40
---

Ein Template wird zur Ausgabe eines Moduls, Inhaltselements, Formulars oder einer anderen Komponente 
verwendet. Im 
[Navigationsbereich](../../administrationsbereich/aufruf-und-aufbau-des-backends/#der-navigationsbereich) »Layout« 
unter »Templates« können die Dateien erstellt, in Ordnern abgelegt und bearbeitet werden. Diese Anpassungen sind updatesicher.

{{% children %}}

{{% notice info %}}
Template Änderungen sind nicht notwendig, wenn du nur eine zusätzliche CSS-ID oder CSS-Klasse benötigst. Bei den meisten 
Contao-Komponenten kannst du diese im Bereich »Experten-Einstellungen« eintragen. Die entsprechenden Bezeichnungen 
werden von den Templates übernommen und im Quelltext ausgegeben.
{{% /notice %}}

{{% notice note %}}
Im [Debug-Modus](../../system/debug-modus/) werden die Template-Namen im HTML-Quellcode als Kommentare ausgegeben. 
Man kann hierüber nachvollziehen welches Template zum Einsatz kommt.
{{% /notice %}}


## Twig Unterstützung

{{< version "4.13" >}}

Die Ausgabe kann, neben PHP Templates, zusätzlich über Twig Templats erfolgen. Detaillierte Informationen hierzu 
werden über die »[Entwickler Dokumentation](https://docs.contao.org/dev/framework/templates/twig/)« bereit gestellt.

{{% taxonomylist context="tags" filter="Template" title="Anleitungen" description=true %}}

