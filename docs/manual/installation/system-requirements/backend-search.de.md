---
title: "Backend-Suche"
description: "Hier lernst du alles, was du für die Nutzung der Backend-Suche von Contao wissen musst."
url: "installation/systemvoraussetzungen/backend-suche"
aliases:
    - /de/installation/systemvoraussetzungen/backend-suche/
---

{{< version "5.5.0" >}}

Die Backend-Suche in Contao basiert auf einem Projekt namens »SEAL« der PHP-CMSIG. SEAL steht für »Search Engine 
Abstraction Layer« und hat das gleiche Ziel wie Doctrine DBAL (das für »Database Abstraction Layer« steht). Bei 
Doctrine DBAL geht es um die Abstraktion der verschiedenen Datenbankserver. Bei PHP-CMSIG SEAL dagegen, werden 
verschiedene Suchmaschinen abstrahiert. Der Vorteil in beiden Fällen: Im Idealfall kannst du dadurch Contao mit 
verschiedenen Datenbanken und Suchmaschinen einsetzen und von deren jeweiligen Vorteilen profitieren.

Mehr über die PHP-CMSIG das Projekt SEAL erfährst du [hier][PHP-CMSIG] und [hier][SEAL].

## Grundvoraussetzungen

Jede Suchmaschine funktioniert am Ende des Tages relativ ähnlich. Man gibt ihr einen gewissen Inhalt (meistens 
»Document« genannt), dieses wird dann so aufbereitet, dass es effizient durchsucht werden kann. Dabei gibt es 
verschiedenste Techniken welche die unterschiedlichsten Anforderungen abdecken. Beispiele:

* Schön wäre, wenn bei der Suche nach »Systeme« auch »System« gefunden würde (Stemming)
* Cool wäre, wenn bei der Suche nach »Markdwon« auch »Markdown« gefunden würde (Typo Tolerance)
* Super spannend wird es, wenn bei der Suche nach »warme Kleidung« auch »Handschuhe« gefunden wird (AI Embeddings)

Nicht alle Suchmaschinen unterstützen alle Funktionen. Manche sind schneller, dafür ungenauer. Andere wiederum haben 
spezielle Systemanforderungen etc. pp.

### Grundvoraussetzung 1: Das Cronjob-Framework

Alle Suchmaschinen aber haben eines gemeinsam: Das Aufbereiten der Dokumente kann sehr lange dauern. Ein ganzes 
Contao-Backend mit allen Inhalten durchsuchbar zu machen kann je nach Grösse des Systems einige Minuten dauern. Die 
genaue Dauer hängt natürlich auch wieder von der Menge des Inhalts und der eingesetzten Suchmaschine ab, aber es dauert. 

Deswegen braucht Contao für die Suche zwingend die Möglichkeit, deine Inhalte im Hintergrund auf der Kommandozeile zu 
indexieren, wo keine typischen Limits von 30 Sekunden wie bei einem Webserver existieren.

Die einfachste Möglichkeit für dich, diese Grundvoraussetzung zu schaffen, ist die [Einrichtung des Contao 
Cronjob-Frameworks]({{% relref "cronjobs.de.md" %}}).

### Grundvoraussetzung 2: Eine Suchmaschine

Mit der Einrichtung des Cronjob-Frameworks haben wir nun die Voraussetzungen zum regelmässigen Indexieren deines Inhalts
geschaffen. Jetzt fehlt noch das Gegenstück: die Suchmaschine selbst.

SEAL unterstützt eine Vielzahl an Suchmaschinen. Damit du die jeweilige Suchmaschine einsetzen kannst, brauchst du 
den passenden Adapter, den man sich per Composer installieren kann.

| Suchmaschine  | Erforderliches Composer-Paket    | Beispiel DSN                                | Bemerkungen                                                                                                                                                                                                                       |
|---------------|----------------------------------|---------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Elasticsearch | `cmsig/seal-elasticsearch-adapter` | elasticsearch://127.0.0.1:9200              |                                                                                                                                                                                                                                   |
| Opensearch    | `cmsig/seal-opensearch-adapter`    | opensearch://127.0.0.1:9200                 |                                                                                                                                                                                                                                   |
| Meilisearch   | `cmsig/seal-meilisearch-adapter`   | meilisearch://apiKey@127.0.0.1:7700         |                                                                                                                                                                                                                                   |
| Algolia       | `cmsig/seal-algolia-adapter`       | algolia://YourApplicationID:YourAdminAPIKey |                                                                                                                                                                                                                                   |
| Solr          | `cmsig/seal-solr-adapter`          | solr://solr:SolrRocks@127.0.0.1:8983        |                                                                                                                                                                                                                                   |
| Redisearch    | `cmsig/seal-redisearch-adapter`    | redis://phpredis:phpredis@127.0.0.1:6379    |                                                                                                                                                                                                                                   |
| Typesense     | `cmsig/seal-typesense-adapter`     | typesense://S3CR3T@127.0.0.1:8108           |                                                                                                                                                                                                                                   |
| Loupe         | `cmsig/seal-loupe-adapter`         | loupe://var/indexes/                        | Loupe läuft auf deinem lokalen Filesystem und erfordert nur PHP und eine SQLite-Datenbank. Entsprechend ist die Minimal-Anforderung, dass entweder `sqlite3` oder `pdo_sqlite` in deinem PHP-Setup zur Verfügung steht. |

Konfiguriert wird die Backend-Suche per DSN in deiner `config.yaml`:

```yaml
# config/config.yaml
contao:
    backend_search:
        enabled: true # Kann weggelassen werden, wenn DSN gesetzt wird. Aber mit "false" lässt sie sich deaktivieren.
        dsn: '...' # Siehe Tabelle
        index_name: 'mein_index' # Optional, "contao_backend" ist der Default
```

## Integration in der Contao Managed Edition

Solltest du die Contao Managed Edition nutzen, so brauchst du ggf. keine explizite Konfiguration vorzunehmen. Die Contao
ME liefert `cmsig/seal-loupe-adapter` bereits mit und konfiguriert diesen auf `var/loupe`. Dabei prüft sie selber, ob
die Systemvoraussetzungen (die SQLite-Anforderungen) gegeben sind. Wenn ja, ist also eine lokale Suchmaschine für 
dich bereits vorkonfiguriert. Du brauchst keinen extra Suchmaschinenserver. Du musst lediglich das Cronjob-Framework 
konfigurieren und damit Grundvoraussetzung 1 schaffen.


[PHP-CMSIG]: https://github.com/PHP-CMSIG
[SEAL]: https://github.com/php-cmsig/search