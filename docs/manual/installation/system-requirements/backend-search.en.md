---
title: "Backend Search"
description: "Here you will learn everything you need to know to use the Contao backend search."
aliases:
    - /en/installation/system-requirements/backend-search
---

{{< version "5.5.0" >}}

The backend search in Contao is based on a project called "SEAL" by PHP-CMSIG. SEAL stands for "Search Engine Abstraction Layer" and has the same goal as Doctrine DBAL (which stands for "Database Abstraction Layer"). While Doctrine DBAL focuses on abstracting various database servers, PHP-CMSIG SEAL abstracts different search engines. The advantage in both cases: Ideally, this allows you to use Contao with different databases and search engines and benefit from their respective advantages.

Learn more about PHP-CMSIG and the SEAL project [here][PHP-CMSIG] and [here][SEAL].

## Basic Requirements

At the end of the day, every search engine works in a relatively similar way. You provide it with some content (usually 
called a "document"), which is then processed so that it can be efficiently searched. There are various techniques to meet different requirements. Examples:

* It would be nice if searching for "systems" also found "system" (Stemming).
* It would be cool if searching for "Markdwon" also found "Markdown" (Typo Tolerance).
* It gets really interesting if searching for "warm clothing" also finds "gloves" (AI Embeddings).

Not all search engines support all functions. Some are faster but less accurate. Others have specific system requirements, etc.

### Basic Requirement 1: The Cronjob Framework

All search engines have one thing in common: processing documents can take a long time. Making an entire Contao back end searchable, including all its content, can take several minutes depending on the system's size. The exact duration, of course, depends on the amount of content and the search engine used, but it takes time.

For this reason, Contao requires the ability to index your content in the background via the command line, where typical 30-second limits, as with a web server, do not exist.

The simplest way to meet this requirement is to [set up the Contao Cronjob Framework]({{% ref "cronjobs.en.md" %}}).

### Basic Requirement 2: A Search Engine

With the setup of the Cronjob Framework, we have now ensured the prerequisites for regularly indexing your content. Now, we need the counterpart: the search engine itself.

SEAL supports a variety of search engines. To use a specific search engine, you need the appropriate adapter, which can be installed via Composer.

| Search Engine  | Required Composer Package    | Example DSN                                | Notes                                                                                                                                                                                                                     |
|---------------|----------------------------------|---------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Elasticsearch | `cmsig/seal-elasticsearch-adapter` | elasticsearch://127.0.0.1:9200              |                                                                                                                                                                                                                           |
| Opensearch    | `cmsig/seal-opensearch-adapter`    | opensearch://127.0.0.1:9200                 |                                                                                                                                                                                                                           |
| Meilisearch   | `cmsig/seal-meilisearch-adapter`   | meilisearch://apiKey@127.0.0.1:7700         |                                                                                                                                                                                                                           |
| Algolia       | `cmsig/seal-algolia-adapter`       | algolia://YourApplicationID:YourAdminAPIKey |                                                                                                                                                                                                                           |
| Solr          | `cmsig/seal-solr-adapter`          | solr://solr:SolrRocks@127.0.0.1:8983        |                                                                                                                                                                                                                           |
| Redisearch    | `cmsig/seal-redisearch-adapter`    | redis://phpredis:phpredis@127.0.0.1:6379    |                                                                                                                                                                                                                           |
| Typesense     | `cmsig/seal-typesense-adapter`     | typesense://S3CR3T@127.0.0.1:8108           |                                                                                                                                                                                                                           |
| Loupe         | `cmsig/seal-loupe-adapter`         | loupe://var/indexes/                        | Loupe runs on <br/>your local filesystem and only requires PHP and an SQLite database. The minimal requirement is that either <br/>`sqlite3` or `pdo_sqlite` is available in your PHP setup. |

The backend search is configured via DSN in your `config.yaml`:

```yaml
# config/config.yaml
contao:
    backend_search:
        enabled: true # Can be omitted if DSN is set. But can be disabled with "false".
        dsn: '...' # See table above
        index_name: 'my_index' # Optional, "contao_backend" is the default
```

## Integration in the Contao Managed Edition

If you are using the Contao Managed Edition, you may not need to configure anything explicitly. Contao ME already includes `cmsig/seal-loupe-adapter` and configures it at `var/loupe`. It automatically checks whether the system requirements (SQLite requirements) are met. If so, a local search engine is already preconfigured for you. You do not need an additional search engine server. You only need to configure the Cronjob Framework to fulfill Basic Requirement 1.

[PHP-CMSIG]: https://github.com/PHP-CMSIG
[SEAL]: https://github.com/php-cmsig/search
