---
title: Contao News Facebook Sync
linkTitle: News Facebook Sync
description: Contao News Facebook Sync is a commercial extension for synchronisation of Facebook posts with a news archive.
---

**[inspiredminds/contao-news-facebook](https://extensions.contao.org/?q=news%20face&pages=1&p=inspiredminds%2Fcontao-news-facebook)**

_by [INSPIRED MINDS](https://www.inspiredminds.at/)_

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
            "url": "https://<YOUR_USERNAME>:<YOUR_TOKEN>@packeton.inspiredminds.at"
        }
    ]
}
```

Replace `<YOUR_USERNAME>` and `<YOUR_TOKEN>` with the credentials you received from INSPIRED MINDS.

To add the dependency, add the following to your `composer.json`:

```json
{
    "require": {
        "inspiredminds/contao-news-facebook": "^9.0"
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
        "contao/conflicts": "@dev",
        "contao/manager-bundle": "5.3.*",
        "inspiredminds/contao-news-facebook": "^9.0"
    },
    "conflict": {
        "contao-components/installer": "<1.3"
    },
    "extra": {
        "contao-component-dir": "assets",
    },
    "scripts": {
        "post-install-cmd": [
            "@php vendor/bin/contao-setup"
        ],
        "post-update-cmd": [
            "@php vendor/bin/contao-setup"
        ]
    },
    "repositories": [
        {
            "type": "composer",
            "url": "https://<YOUR_USERNAME>:<YOUR_TOKEN>@packeton.inspiredminds.at"
        }
    ]
}
```
{{% /expand %}}

After making this adjustment, run a `composer update` on the command line or update your packages via the Contao 
Manager. Then update the database as usual.


## Configuration

To configure this extension, a "Facebook App" needs to created firs. The  details of this app are then needed for the
configuration in the back end.

{{% notice "tip" %}}
You can skip this step if your Facebook page is _not_ associated with a Meta Business account. Then the extension will
use its own Facebook app, which has approval to fetch and write data to your Facebook page.

Facebook does not allow access to pages connected to a Meta Business account anymore, without the `business_management`
permission for which the Facebook app the extension comes with does not have approval for.
{{% /notice %}}


### Creating a Facebook App

1. First you need to go to [developers.facebook.com](https://developers.facebook.com). If you do not have a Facebook 
developer account yet, you need to create one (or unlock your existing Facebook user as a developer account).
2. Under _My Apps_ click on _Create App_.
3. Type in an _App name_ for the App (e.g. the title of your website) and enter an _App contact email_.
4. Next you define a use case for the app. Choose _Other_ at the bottom.
5. Next you define an app type. Choose _Business_.
6. On the next page click on _Create app_.
7. Next you can add "products" to your app. At the bottom click on _Set up_ for _Facebook Login for Business_.
8. Under **Client OAuth settings** you need to enter _Valid OAuth Redirect URIs_. Here enter the following URL:
`https://example.org/_facebook/callback`. Replace `example.org` with the domain of your website. Then click on _Save Changes_.

{{% notice note %}}
The account under which you create this App must also have the rights to create timeline posts on
the Facebook page you wish to synchronize with (optional if you only want to fetch Facebook Page posts). Alternatively
you can also add further Administrator or Developers after you created the App in the _Roles_ section.
{{% /notice %}}


### Configure the App ID and App Secret in Contao

In your Facebook app, go to _App settings_ » _Basic_. Copy the _App ID_ and _App secret_ and configure it in your
`config/config.yaml`:

```yaml
# config/config.yaml
contao_news_facebook:
    app_id: '123456789123456'
    app_secret: 'abc123abc123abc123abc123abc123ab'
```

However, since these are secrets, it is recommended not to store them directly in your `config.yaml` and thus possibly
push them to the Git repository of your project. Instead you should use environment variables:

```env
# .env
# Define empty defaults
FACEBOOK_APP_ID=
FACEBOOK_APP_SECRET=
```

```env
# .env.local
# Set the actual values
FACEBOOK_APP_ID=123456789123456
FACEBOOK_APP_SECRET=abc123abc123abc123abc123abc123ab
```

```yaml
# config/config.yaml
# Reference the environment variables
contao_news_facebook:
    app_id: '%env(FACEBOOK_APP_ID)%'
    app_secret: '%env(FACEBOOK_APP_SECRET)%'
```


### Configure the Contao News Archive

Go to the settings of your news archive. In the _Facebook sync_ section enable __Facebook sync__ and enter the _numeric_ 
ID of the Facebook Page you want to synchronize with. If you wish to automatically fetch the Facebook Page posts and add 
them to your news archive, enable the __Fetch page posts__ option. Optionally, also define a __Page post date limit__.

You can also do the same for a Facebook Group, if you want to fetch posts from that group. Note, however, that publishing
news entries as Facebook posts is only supported for Facebook Pages, not for Groups.

Lastly you need to fetch an __Access Token__. Click on the Facebook connect button next to the input field - this will 
log you into Facebook and it will request some permissions from your Facebook user. After you have confirmed the 
permissions a "Long Term Access Token" will be fetched from Facebook.

{{% notice note %}}
If you want to let Contao publish news posts to your Facebook page, you need to allow the Facebook App 
to post __publicly__ on your behalf, when granting permissions. The Facebook account under which you log in to fetch 
the Access Token also must have the rights to create timeline posts on the Facebook page.
{{% /notice %}}

![News archive settings]({{% asset "images/manual/extensions/en/contao-news-facebook_archive_settings_en.png" %}}?classes=shadow)

Any downloaded images will be saved to the folder configured in your news archive (`files/facebook_images` by default).
Like any other folder, this folder needs to be made public under Contao 4!


### Additional settings

Since version `3.0.0` you can also set the following settings in the system settings of Contao under _Facebook Sync_:

__No meta tags__: since version `3.0.0` the extension also automatically includes an `og:image` `meta` tag in the 
`<head>` wherever a news article is parsed, so that its teaser image will be displayed by Facebook automatically, 
whenever someone shares a link to a news entry. With this option you can disable this functionality.

__Post as photo__: since version `3.0.0` news entries are not posted as photo posts anymore, whenever the news entry 
has a teaser image. With this option you can re-enable this functionality.

![Back end settings]({{% asset "images/manual/extensions/en/contao-news-facebook_backend_settings_en.png" %}}?classes=shadow)

If you do not use a hook, the default headline length can be configured via

```yaml
# config/config.yaml
contao_news_facebook:
    headline_length: 64
```


## Usage


### Fetch Facebook Page/Group posts

Once you have configured the news archive and also enabled the __Fetch page posts__ or __Fetch group posts__ option the extension will check for new Facebook posts hourly via Contao's cronjob.


### Publish Facebook posts

Contao news entries will be published as Facebook page posts under two conditions:

- in the news entry's properties, under the _Facebook sync_ section, the __Post to Facebook page__ option must be enabled
- the news entry must be published

You can also define a custom message for the Facebook post. If no such message is defined, the news entry's teaser is used by default.

The extension will check for new news entries to be published minutely via Contao's cronjob.

![News settings]({{% asset "images/manual/extensions/en/contao-news-facebook_news_settings_en.png" %}}?classes=shadow)


### Manual sync trigger

There is a button to trigger a sync in the back end, within the global operations for news archives.

![News global operations]({{% asset "images/manual/extensions/en/contao-news-facebook_news_global_operations_en.png" %}}?classes=shadow)


## Hooks

The extension provides some [Hooks][Hooks] which allow you to alter the behavior when posting to Facebook or fetching Facebook posts.

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


#### Example

The following example appends the news article's URL to any photo post:

```php
namespace App\EventListener;

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Contao\CoreBundle\Routing\ContentUrlGenerator;
use Contao\NewsArchiveModel;
use Contao\NewsModel;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AsHook('changeFacebookMessage')]
class ChangeFacebookMessageListener
{
    public function __construct(private readonly ContentUrlGenerator $contentUrlGenerator)
    {
    }

    public function __invoke(string $message, NewsModel $news, NewsArchiveModel $archive): string
    {
        // Append the URL to photo posts
        if ($news->addImage && $news->fbPostAsPhoto) {
            $message .= "\n\n".$this->contentUrlGenerator->generate($news, [], UrlGeneratorInterface::ABSOLUTE_URL);
        }

        return $message;
    }
}
```


## Template data

There is additional data available in the news templates:

- _object_ `fbData` The original Facebook post data
- _string_ `fbPostId` The Facebook post ID of the linked Facebook post
- _char_ `fromFb` Indicates whether this news entry was fetched from Facebook


[Hooks]: https://docs.contao.org/dev/framework/hooks/
