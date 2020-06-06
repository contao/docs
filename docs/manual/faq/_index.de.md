---
title: "Fragen und Antworten"
description: "Antworten zu den häufigsten Fragen."
url: "faq"
aliases:
    - /de/faq/
weight: 110
---

Hier findest du eine Sammlung der häufigsten Fragen mit enstprechenden Lösungen. 

{{% expand "Kein E-Mail Versand über Formular?" %}}
Überprpüfe in der `parameters.yml` die [SMTP-Angaben](/de/system/einstellungen/#smtp-versand) deines Hosters oder 
füge diese hinzu. 
{{% /expand %}}

{{% expand "Kann man die URL Suffix ».html« entfernen?" %}}
Du kannst in der [config.yml](/de/system/einstellungen/#config-yml) den Eintrag `url_suffix: ''` eintragen.
{{% /expand %}}

### Layout

{{% expand "Änderungen an meinen SCSS Einträgen werden nicht übernommen?" %}}
Bei Änderungen an einer [SCSS Partial-Datei](#) musst du im Anschluss in der »Systemwartung« den Scriptcache leeren.
{{% /expand %}}