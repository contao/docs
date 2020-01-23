---
title: "Installing test versions"
description: "Guide on how to install development versions and release candidates of Contao."
weight: 20
---


The development team of Contao adheres to a specific [release plan][releasePlan]
when developing new versions of Contao (and maintaining current versions). Before
each planned "major" and "minor"<sup>1</sup> version release there will be a specific 
timeframe for developing this new version. New features will be added until a deadline 
is reached, after which the first release candidates will be published. If no further 
issues are found during testing of the developer version and the release candidates, 
the stable version of the new version will be released.

{{% notice note %}}
<sup>1</sup> Contao uses "[semantic versioning]](https://semver.org/)". A new "major"
version is signified by the first part of the version string. These are versions
with new features or structural changes, that can be incompatible with previous 
versions. A new "minor" version on the other hand is signified by the second part
of the version string. These are versions with added new features, which are still
compatible with previous versions.
{{% /notice %}}

Even though Contao uses thousands of automatic tests, unforeseen issues can always 
occur after implementing new features or changing existing ones. Thus, testing still 
needs to be done by actual users. Since Contao is an open source software it can 
benefit from community engagement for such tests.

The following explains how you can participate in testing, by installing either
a release candidate of Contao during its release candidate phase, or even a development
version of Contao.

When updating packages via Composer (either directly via the command line or via
the Contao Manager), usually only _stable_ packages will be installed, at least
with the default setup of the _Contao Managed Edition_ for example. Therefore, we
only need to make a few adjustments to the `composer.json` of your project, in order
for Composer to install the release candidate or development version. After changing
the `composer.json`, a full package update needs to be executed of course.


## Installing Release Candidates

Release candidates use a specific release version tag. For example the first release
candidate of Contao `4.9` will have a release tag called `4.9.0-RC1`. Using Composer's
[version requirement syntax][composerVersions], we can instruct Composer to install 
not only the stable  versions of Contao `4.9`, but also the prior release candidates,
by using `4.9@RC`. This needs to be applied to _all_ of the Contao core bundles,
_including_ the `contao/core-bundle` itself, and the `contao/installation-bundle`,
which you usually do not require directly yourself.

Here is a full example for installing the latest Contao `4.9` version, _including_
its latest release candidates (if there are any):

```json
{
    "name": "contao/managed-edition",
    "type": "project",
    "description": "Contao Open Source CMS",
    "require": {
        "php": "^7.1",
        "contao/calendar-bundle": "^4.9@RC",
        "contao/comments-bundle": "^4.9@RC",
        "contao/conflicts": "@dev",
        "contao/core-bundle": "^4.9@RC",
        "contao/faq-bundle": "^4.9@RC",
        "contao/installation-bundle": "^4.9@RC",
        "contao/listing-bundle": "^4.9@RC",
        "contao/manager-bundle": "4.9.*@RC",
        "contao/news-bundle": "^4.9@RC",
        "contao/newsletter-bundle": "^4.9@RC"
    },
    "conflict": {
        "contao-components/installer": "<1.3"
    },
    "extra": {
        "contao-component-dir": "assets",
        "symfony": {
            "require": "^4.2"
        }
    },
    "scripts": {
        "post-install-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ],
        "post-update-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ]
    }
}
```

Note that once Contao `4.9` has stable releases (e.g. `4.9.0`, `4.9.1` etc.), those 
will be installed when running a package update.


## Installing Developer Versions

During the release candidate and development phase of a Contao version, you can
also install the development version for testing purposes instead of just the already
defined release candidates. This way you can test the latest changes without having
to wait for a new release candidate. Though this might of course also contain some
unstable code.

In this case, instead of requiring a specific _version_ of Contao, a specific _branch_
of Contao's public Git repository will be required. Each minor version of Contao
has its own development branch, e.g. `4.9.x-dev` for Contao `4.9` for instance. 
The branch of a _future_ Contao version currently in development will always be the
`dev-master` branch.

Here is a full `composer.json` example, requiring the development branch of Contao's
`4.9` version:

```json
{
    "name": "contao/managed-edition",
    "type": "project",
    "description": "Contao Open Source CMS",
    "require": {
        "php": "^7.1",
        "contao/calendar-bundle": "4.9.x-dev",
        "contao/comments-bundle": "4.9.x-dev",
        "contao/conflicts": "@dev",
        "contao/core-bundle": "4.9.x-dev",
        "contao/faq-bundle": "4.9.x-dev",
        "contao/installation-bundle": "4.9.x-dev",
        "contao/listing-bundle": "4.9.x-dev",
        "contao/manager-bundle": "4.9.x-dev",
        "contao/news-bundle": "4.9.x-dev",
        "contao/newsletter-bundle": "4.9.x-dev"
    },
    "conflict": {
        "contao-components/installer": "<1.3"
    },
    "extra": {
        "contao-component-dir": "assets",
        "symfony": {
            "require": "^4.2"
        }
    },
    "scripts": {
        "post-install-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ],
        "post-update-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ]
    }
}
```

Each time the packages are updated, the most recent code for this branch will be 
pulled from Contao's public Git repository.


[releasePlan]: https://contao.org/en/release-plan.html
[composerVersions]: https://getcomposer.org/doc/articles/versions.md
