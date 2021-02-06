---
title: Contao News Facebook Sync
menuTitle: News Facebook Sync
description: Contao News Facebook Sync is a commercial extension for synchronisation of Facebook posts with a news archive.
---

**[inspiredminds/contao-news-facebook](https://extensions.contao.org/?q=news%20face&pages=1&p=inspiredminds%2Fcontao-news-facebook)**

_by [inspiredminds](https://www.inspiredminds.at/)_

_Project web site: [Contao News Facebook Sync](https://www.inspiredminds.at/contao-news-facebook)_

This extension allows to automatically import Facebook page (or group) posts as news entries. It also enables you to 
automatically post news entries on a Facebook page. This allows you to keep a Facebook page in sync with a news archive.


## Installation

To install this extension, the `composer.json` of your Contao installation has to be modified first. Two adjustments have
to be done: adding the private repository & adding the dependency. 

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
        "inspiredminds/contao-news-facebook": "^6.0"
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
        "inspiredminds/contao-news-facebook": "^6.0"
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

After making this adjustment, run a `composer update` on the command line or update your packages via the Contao 
Manager. Then open the Contao Install Tool to update the database as usual.


## Configuration

To configure this extension, a "Facebook App" needs to created first prior to version **7.0** of this extension. The 
details of this app are then needed for the configuration in the back end.


### Creating a Facebook App

{{% notice tip %}}
Starting with version **7.0** of the extension this step can be skipped.
{{% /notice %}}

1. First you need to go to [developers.facebook.com](https://developers.facebook.com). If you do not have a Facebook 
developer account yet, you need to create one (or unlock your existing Facebook user as a developer account).
2. Under _My Apps_ click on _Create App_.
3. Type in a _Display Name_ for the App (e.g. the title of your website) and enter a contact email address.
4. On the next page, you can add _Products_ to your App. Add the _Facebook Login_ by clicking on _Set Up_.
5. On the next page, choose _Web_, then enter the URL of your website (including `https://`). Click on _Save_.
6. On the left, click on _Facebook Login_ » _Settings_. Under _Valid OAuth Redirect URIs_ enter the following URL: 
`https://example.org/system/modules/news_facebook/public/callback.php`. Replace `example.org` with the domain of your 
website. Then click on _Save Changes_.
7. On the left, click on _Settings_ » _Basic_ and enter your website's domain unter _App Domains_. Then click on
_Save Changes_.

{{% notice info %}}
The account under which you create this App must also have the rights to create timeline posts on
the Facebook page you wish to synchronize with (optional if you only want to fetch Facebook Page posts). Alternatively
you can also add further Administrator or Developers after you created the App in the _Roles_ section.
{{% /notice %}}


### Configure the App ID and App Secret in Contao

{{% notice tip %}}
Starting with version **7.0** of the extension this step can be skipped.
{{% /notice %}}

In Contao, go to _System - Settings_, scroll down to the _Facebook App_ section, enter the __App ID__ and __App Secret__ 
of your Facebook App. You can find this information in your Facebook App under _Settings_ » _Basic_.

![Facebook App settings](/de/extensions/images/en/contao-news-facebook_app_settings_en.png?classes=shadow)


### Configure the Contao News Archive

Go to the settings of your news archive. In the _Facebook sync_ section enable __Facebook sync__ and enter the _numeric_ 
ID of the Facebook Page you want to synchronize with. If you wish to automatically fetch the Facebook Page posts and add 
them to your news archive, enable the __Fetch page posts__ option. Optionally, also define a __Page post date limit__.

You can also do the same for a Facebook Group, if you want to fetch posts from that group. Note, however, that publishing
news entries as Facebook posts is only supported for Facebook Pages, not for Groups.

Lastly you need to fetch an __Access Token__. Click on the Facebook connect button next to the input field - this will 
log you into Facebook and it will request some permissions from your Facebook user. After you have confirmed the 
permissions a "Long Term Access Token" will be fetched from Facebook.

{{% notice info %}}
If you want to let Contao publish news posts to your Facebook page, you need to allow the Facebook App 
to post __publicly__ on your behalf, when granting permissions. The Facebook account under which you log in to fetch 
the Access Token also must have the rights to create timeline posts on the Facebook page.
{{% /notice %}}

![News archive settings](/de/extensions/images/en/contao-news-facebook_archive_settings_en.png?classes=shadow)

Any downloaded images will be saved to the folder configured in your news archive (`files/facebook_images` by default).
Like any other folder, this folder needs to be made public under Contao 4!


### Additional settings

Since version `3.0.0` you can also set the following settings in the system settings of Contao under _Facebook Sync_:

__No meta tags__: since version `3.0.0` the extension also automatically includes an `og:image` `meta` tag in the 
`<head>` wherever a news article is parsed, so that its teaser image will be displayed by Facebook automatically, 
whenever someone shares a link to a news entry. With this option you can disable this functionality.

__Post as photo__: since version `3.0.0` news entries are not posted as photo posts anymore, whenever the news entry 
has a teaser image. With this option you can re-enable this functionality.

![Back end settings](/de/extensions/images/en/contao-news-facebook_backend_settings_en.png?classes=shadow)

If you do not use a hook, the default headline length can be configured via

```php
$GLOBALS['FACEBOOK_TITLE_LENGTH'] = …;
```

in your own `config.php`.


## Usage


### Fetch Facebook Page/Group posts

Once you have configured the news archive and also enabled the __Fetch page posts__ or __Fetch group posts__ option the extension will check for new Facebook posts hourly via Contao's cronjob.


### Publish Facebook posts

Contao news entries will be published as Facebook page posts under two conditions:

- in the news entry's properties, under the _Facebook sync_ section, the __Post to Facebook page__ option must be enabled
- the news entry must be published

You can also define a custom message for the Facebook post. If no such message is defined, the news entry's teaser is used by default.

The extension will check for new news entries to be published minutely via Contao's cronjob.

![News settings](/de/extensions/images/en/contao-news-facebook_news_settings_en.png?classes=shadow)


### Manual sync trigger

There is a button to trigger a sync in the back end, within the global operations for news archives.

![News global operations](/de/extensions/images/en/contao-news-facebook_news_global_operations_en.png?classes=shadow)


## Hooks

### `processFacebookPost`

The extension processes a Facebook post and tries to convert it to a fitting Contao news entry as best as it can. If you want to customize the final data for a news entry of a Facebook post, you can use the `processFacebookPost` hook. It expects an array containing the final news entry data as the return value. If the return value equals to false, no news entry will be created.

#### Parameters

1. _array_ `$arrData` The already processed data which will be used for the new news entry.
2. _object_ `$objPost` The original Facebook post data.
3. _object_ `$objArchive` The news archive object.

### `changeFacebookMessage`

When posting a Contao news entry as a Facebook post, the extension either uses the teaser or the specified message of the news entry. If you want to automatically provide a different message, you can use the `changeFacebookMessage` hook. It expects the final message as the return value.

#### Parameters

1. _string_ `$message` The already prepared message.
2. _object_ `$objArticle` The original Contao news entry.
3. _object_ `$objArchive` The news archive object.


## Template data

There is additional data available in the news templates:

- _object_ `fbData` The original Facebook post data
- _string_ `fbPostId` The Facebook post ID of the linked Facebook post
- _char_ `fromFb` Indicates whether this news entry was fetched from Facebook
