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
<sup>1</sup> Contao uses "[semantic versioning](https://semver.org/)". A new "major"
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
candidate of Contao `4.9` will have a release tag called `4.9.0-RC1`. Usually Composer
will only install _stable_ versions by default and thus skip any such release candidates.

To allow the installation of release candidates, the `minimum-stability` needs to
be lowered to `RC` in the `composer.json`. Additionally, we instruct Composer to
always prefer _stable_ versions of each package, so that a stable release of Contao
`4.9` gets installed, once available. Finally the requested Contao, i.e. the `contao/manager-bundle` 
needs to be changed to `4.9.*`, as with any minor version update.

```json
{
    "require": {
        "contao/manager-bundle": "4.9.*"
    },
    "minimum-stability": "RC",
    "prefer-stable": true
}
```

Here is a full example for installing the latest Contao `4.9` version, _including_
its latest release candidates (if there are any):

```json
{
    "name": "contao/managed-edition",
    "type": "project",
    "description": "Contao Open Source CMS",
    "require": {
        "php": "^7.1",
        "contao/calendar-bundle": "^4.9",
        "contao/comments-bundle": "^4.9",
        "contao/conflicts": "@dev",
        "contao/core-bundle": "^4.9",
        "contao/faq-bundle": "^4.9",
        "contao/installation-bundle": "^4.9",
        "contao/listing-bundle": "^4.9",
        "contao/manager-bundle": "4.9.*",
        "contao/news-bundle": "^4.9",
        "contao/newsletter-bundle": "^4.9"
    },
    "minimum-stability": "RC",
    "prefer-stable": true,
    "conflict": {
        "contao-components/installer": "<1.3"
    },
    "extra": {
        "contao-component-dir": "assets",
        "symfony": {
            "require": "^4.4"
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

{{% notice tip %}}
The version requirement of the other bundles do not need to be changed from their
default value. For example, a version requirement of `^4.4` (like if you would update 
from the Contao 4.4 LTS version) also allows any `4.9` version. See Composer's documentation
on the [version requirement syntax](https://getcomposer.org/doc/articles/versions.md). 
Only the requested version of the `contao/manager-bundle` needs to be adjusted.
{{% /notice %}}


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
        "contao/manager-bundle": "4.9.*",
        "contao/news-bundle": "4.9.x-dev",
        "contao/newsletter-bundle": "4.9.x-dev"
    },
    "conflict": {
        "contao-components/installer": "<1.3"
    },
    "extra": {
        "contao-component-dir": "assets",
        "symfony": {
            "require": "^4.4"
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

Note that in this case we also need to require the `contao/core-bundle` and the
`contao/installation-bundle`, which we would usually not include in the project's
`composer.json`. This is necessary, since we want to tell Composer to specifically
install a development version, without lowering the `minimum-stability` to `dev`
(wich would drastically increase computation time and memory consumption during
a composer update).

Each time the packages are updated, the most recent code for this branch will be 
pulled from Contao's public Git repository.


## Contao Manager

These test versions can also be installed via the Contao Manager, without having
to manually change the `composer.json`. You can edit the required version of "Contao
Open Source CMS" to `4.9.*@RC` for example, in order to install release candidates.
Or you can enter `4.9.x-dev` or `dev-master` respectively, in order to install development
versions.

![Contao Manager Versionsangabe](/de/guides/images/en/contao-manager-enter-custom-version.gif?classes=shadow)

Instead of updating an existing Contao installation to a release candidate or development
version, you can also create a fresh installation with the Contao Manager.

To do so, go through the basic configuration as usual. At the step "Contao Installation",
enable the "Skip Installation (Expert Only!)" option and confirm with "Finish".

Then change to "Packages" and edit the required version of "Contao Open Source CMS"
as described above. Confirm again by clicking on "Apply Changes" and wait for the 
package update process to finish.


[releasePlan]: https://contao.org/en/release-plan.html
