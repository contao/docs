---
title: Contao News Twitter Sync
menuTitle: News Twitter Sync
description: Contao News Twitter Sync is a commercial extension for synchronisation of Twitter tweets with a news archive.
---

**[inspiredminds/contao-news-twitter](https://extensions.contao.org/?p=inspiredminds%2Fcontao-news-twitter)**

_by [inspiredminds](https://www.inspiredminds.at/)_

_Project web site: [Contao News Twitter Sync](https://www.inspiredminds.at/contao-news-twitter)_

This extension allows to automatically import Twitter tweets as news entries. It 
also enables you to automatically post news entries on a Twitter profile as a tweet. 
This allows you to keep a Twitter profile in sync with a news archive.


## Installation

To install this extension, the `composer.json` of your Contao installation has to 
be modified first. Two adjustments have to be done: adding the private repository 
& adding the dependency. 

To add the repository, add the following to your `composer.json`:

```json
{
    "repositories": [
        {
            "type": "composer",
            "url": "https://token:<YOUR_TOKEN>@packdis.inspiredminds.at/r"
        }
    ]
}
```

Replace `<YOUR_TOKEN>` with the repository token you received from inspiredminds.

To add the dependency, add the following to your `composer.json`:

```json
{
    "require": {
        "inspiredminds/contao-news-twitter": "^2.0"
    }
}
```

{{% expand "View a full example" %}}
```json
{
    "name": "contao/managed-edition",
    "type": "project",
    "description": "Contao Open Source CMS",
    "license": "LGPL-3.0-or-later",
    "authors": [
        {
            "name": "Leo Feyer",
            "homepage": "https://github.com/leofeyer"
        }
    ],
    "require": {
        "php": "^7.1",
        "contao/conflicts": "@dev",
        "contao/manager-bundle": "4.9.*",
        "inspiredminds/contao-news-twitter": "^2.0"
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
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "scripts": {
        "post-install-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ],
        "post-update-cmd": [
            "Contao\\ManagerBundle\\Composer\\ScriptHandler::initializeApplication"
        ]
    },
    "repositories": [
        {
            "type": "composer",
            "url": "https://token:<YOUR_TOKEN>@packdis.inspiredminds.at/r"
        }
    ]
}
```
{{% /expand %}}

After making this adjustment, run a `composer update` on the command line or update 
your packages via the Contao Manager. Then open the Contao Install Tool to update the database as usual.


## Configuration

To configure this extension, a "Twitter App" needs to created first. The details 
of this app are then needed for the configuration in the back end.


### Creating a Twitter App

1. First you need to go to [apps.twitter.com](https://apps.twitter.com/).
2. Click on _Create New App_.
3. Fill out the basic information.
4. Fill out the _Callback URL_ with the Contao back end URL, e.g. `https://www.example.org/contao`.
5. Click on _Create your Twitter application_.


### Configure the Consumer Key and Consumer Secret in Contao

In Contao, go to _System_ » _Settings_, scroll down to the _Twitter App_ section, 
enter the __Consumer Key__ and __Consumer Secret__. You can find both in the settings
of your Twitter App under _Keys and tokens_.


### Configure the Contao News Archive

Go to the settings of your news archive. In the _Twitter sync_ section enable __Twitter sync__. 
Now you have the following options:

__Authentication__: by clicking on the profile picture (or question mark), you can 
(re-)authenticate with your Twitter account. This is necessary if you want to tweet 
your news entries to your profile automatically. It is _not_ necessary to authenticate, 
if you only want to fetch tweets from hashtags or Twitter profiles.

__Profile__: the Twitter profile where tweets should either be fetched from or posted 
to.

__Hasthtags__: space or comma separated list of hashtags that should be fetched 
from Twitter. _Note:_ if you have also defined a _Profile_ this lists acts as a filter 
for that _Profile_ only. Without a _Profile_ _any_ public tweets with that hashtag 
will be fetched.

__Fetch tweets__: tweets will only be fetched from the given profile (or globally 
from the hashtags) if this options is active.

__Publish tweets__: any tweets that are fetched as news entries will be automatically 
be set to _published_.


## Usage

### Fetch Tweets

Once you have configured the news archive and also enabled the __Fetch tweets__ 
option the extension will check for new Tweets hourly via Contao's cronjob.


### Publish Tweets

Contao news entries will be published as tweets under two conditions:

- in the news entry's properties, under the _Twitter sync_ section, the __Post to Twitter profile__ 
  option must be enabled
- the news entry must be published

You can also define a custom message for the tweet. If no such message is defined, 
the news entry's headline is used by default.

If the news entry has a teaser image, that image will also be attached to the tweet.

The extension will check for new news entries to be published minutely via Contao's 
cronjob.


### Manual Sync Trigger

There is a link in the news archive overview to manually trigger the synchronisation.


## Hooks

### `processTweet`

The extension processes a tweet and tries to convert it to a fitting Contao news 
entry as best as it can. If you want to customize the final data for a news entry 
of a tweet, you can use the `processTweet` hook. It expects an array containing 
the final news entry data as the return value. If the return value equals to false, 
no news entry will be created.


#### Parameters

1. _array_ `$arrData` The already processed data which will be used for the new 
   news entry.
2. _object_ `$objTweet` The original tweet data.
3. _object_ `$objArchive` The news archive object.


### `changeTwitterMessage`

When posting a Contao news entry as a tweet, the extension either uses the teaser 
or the specified message of the news entry. If you want to automatically provide 
a different message, you can use the `changeTwitterMessage` hook. It expects the final message as the return value.


#### Parameters

1. _string_ `$message` The already prepared message.
2. _object_ `$objArticle` The original Contao news entry.
3. _object_ `$objArchive` The news archive object.


## Template data

There is additional data available in the news templates:

- _object_ `twitterData` The original tweet data
- _string_ `tweetId` The tweet ID of the linked tweet
- _char_ `fromTwitter` Indicates whether this news entry was fetched from Twitter
