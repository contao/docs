---
title: "Release procedure"
description: "Details about the release procedure"
---

The [Contao release plan][Release_Plan] defines when new Contao versions are released. This article explains when and
how a PR has to be submitted to be included in a new version.

## Stages

Before a new version is considered stable, it goes through three stages:

* **Dev**: About six months. The version is under active development. You can add new feature PRs at anytime.
* **Review**: About two weeks. Complete feature PRs will be reviewed and merged. Incomplete feature PRs will be moved
  to the next milestone.
* **RC**: Release candidate. About four weeks. Only bug fixes. New feature PRs will be moved to the next milestone.

Please note that there is no explicit beta phase. Experience has shown that hardly anyone installs and tests a beta
version, so a beta phase had no added value for us.

## When is a PR considered "complete"?

In order for your feature PR to be reviewed and merged, it must meet the following requirements:

1. The PR must no longer be a draft;
2. all functions must be implemented;
3. all unit tests must be in place;
4. the CI checks must not fail.

## Deadlines

The winter release is published around February 15 of each year, so your feature PR has to be completed by December 31.
The summer release is published around August 15 of each year, so your feature PR has to be completed by June 31.

[Release_Plan]: https://contao.org/en/release-plan.html
