---
title: Insert tags
description: 'Insert tags are placeholders that are replaced by specific values when a page is output.'
aliases:
    - /en/article-management/insert-tags/
weight: 30
---

{{% notice warning %}}
This article is machine translated.
{{% /notice %}}

Insert tags are placeholders that are replaced by specific values when a page is output. With insert tags you can, for example, create a link to a page or an article, insert environment variables or read user properties. Insert tags can be used everywhere in Contao.

An insert tag always starts with two opening curly brackets, followed by a keyword and two closing curly brackets, e.g. `{{date}}`. Many insert tags require an additional argument that is written with two colons after the keyword, e.g. `{{link::12}}`.

## Link elements

With these insert tags you can create links to other pages or articles. You only need the ID or alias of the target page.

| Insert tag | Description |
| ---------- | ----------- |
| `{{link::*}}` | This tag is replaced with HTML code for a link. The parameter can be the ID or alias of an internal page or an absolute URL. |
| `{{link::back}}` | This tag is replaced with a link to the last page visited. Can also be used as `{{link_open::back}}`, `{{link_url::back}}`and `{{link_title::back}}`. |
| `{{link::login}}` | This tag is replaced with a link to the logon page of the current front-end user (if available). |
| `{{link_open::*}}` | Is replaced with the opening tag of a link. The parameter can be the ID or alias of an internal page or an absolute URL: `{{link_open::12}}Click here{{link_close}}`. |
| `{{link_url::*}}` | This tag is replaced with the URL of an internal page: `<a href="{{link_url::12}}">Click here</a>`. |
| `{{link_target::*}}` | This tag will be replaced with `target="_blank" rel="noreferrer noopener"` if the specified page is an external redirection page and it is set there that the link should open in a new window. |
| `{{link_title::*}}` | This tag is replaced with the title of an internal page: `<a title="{{link_title::12}}">Hier klicken</a>`. |
| `{{link_name::*}}` | This tag will be replaced with the name of an internal page: `<a>{{link_name::12}}</a>`. |
| `{{link_close}}` | Will be replaced with the closing tag of a link to an internal page: `{{link_open::12}}Hier klicken{{link_close}}`. |
| `{{article::*}}` | This tag is replaced with a link to an article (replace \* with the ID or alias). |
| `{{article_open::*}}` | Will be replaced with the opening tag of a link to an article: `{{article_open::12}}Hier klicken{{link_close}}`. |
| `{{article_url::*}}` | This tag is replaced with the URL of an article: `<a href="{{article_url::12}}">Hier klicken</a>`. |
| `{{article_title::*}}` | This day is replaced by the title of an article: `<a title="{{article_title::12}}">Hier klicken</a>`. |
| `{{news::*}}` | This tag is replaced with a link to a message (replace \* with the ID or alias). |
| `{{news_open::*}}` | Is replaced with the opening tag of a link to a message: `{{news_open::12}}Hier klicken{{link_close}}`. |
| `{{news_url::*}}` | This tag will be replaced with the URL of a message: `<a href="{{news_url::12}}">Hier klicken</a>`. |
| `{{news_title::*}}` | This tag is replaced with the title of a message: `<a title="{{news_title::12}}">Hier klicken</a>`. |
| `{{news_feed::*}}` | This tag will replace with the URL to a news feed (replace \* with the ID). |
| `{{event::*}}` | This tag will be replaced with a link to an event (replace \* with the ID or alias) |
| `{{event_open::*}}` | Is replaced with the opening tag of a link to an event: `{{event_open::12}}Hier klicken{{link_close}}`. |
| `{{event_url::*}}` | This tag is replaced with the URL of an event: `<a href="{{event_url::12}}">Hier klicken</a>`. |
| `{{event_title::*}}` | This tag is replaced with the title of an event: `<a title="{{event_title::12}}">Hier klicken</a>`. |
| `{{calendar_feed::*}}` | This tag is replaced with the URL to a calendar feed (replace \* with the ID). |
| `{{faq::*}}` | This tag will be replaced with a link to a frequently asked question (replace \* with the ID or alias) |
| `{{faq_open::*}}` | Will be replaced with the opening tag of a link to a question: `{{faq_open::12}}Hier klicken{{link_close}}`. |
| `{{faq_url::*}}` | This tag will be replaced with the URL of a question: `<a href="{{faq_url::12}}">Hier klicken</a>`. |
| `{{faq_title::*}}` | This tag will be replaced with the title of a question: `<a title="{{faq_title::12}}">Hier klicken</a>`. |

## Member properties

With the following insert tags you can read certain properties of a logged in frontend user and address him e.g. with his name. In principle, you can pass all field names of the table `tl_member`as arguments.

| Insert tag | Description |
| ---------- | ----------- |
| `{{user::*}}` | This tag will be replaced with the content of a field of `tl_member`the logged in member (replace \* with the field name). |
| `{{user::firstname}}` | This tag is replaced with the first name of the registered member. |
| `{{user::lastname}}` | This tag will be replaced with the surname of the registered member. |
| `{{user::company}}` | This tag will be replaced with the company name of the logged in member. |
| `{{user::phone}}` | This tag will be replaced with the phone number of the logged in member. |
| `{{user::mobile}}` | This tag will be replaced with the mobile phone number of the logged in member. |
| `{{user::fax}}` | This tag will be replaced with the fax number of the registered member. |
| `{{user::email}}` | This tag will be replaced with the email address of the logged in member. |
| `{{user::website}}` | This tag is replaced with the Internet address of the logged-in member. |
| `{{user::street}}` | This tag will be replaced with the street name of the registered member. |
| `{{user::postal}}` | This tag will be replaced with the postal code of the registered member. |
| `{{user::city}}` | This tag will be replaced with the city of the registered member. |
| `{{user::country}}` | This tag will be replaced with the country of the logged in member. |
| `{{user::username}}` | This tag is replaced with the username of the logged in member. |

## Page properties

The following insert tags can be used to output page properties such as the page name.

| Insert tag | Description |
| ---------- | ----------- |
| `{{page::*}}` | This tag is replaced with the content of a field from `tl_page`the current page (replace \* with the field name). |
| `{{page::id}}` | This tag is replaced with the ID of the current page. |
| `{{page::alias}}` | This tag is replaced with the alias of the current page. |
| `{{page::title}}` | This tag is replaced with the name of the current page. |
| `{{page::pageTitle}}` | This tag is replaced with the title of the current page. |
| `{{page::description}}` | This tag is replaced with the description of the current page. |
| `{{page::language}}` | This tag is replaced with the language of the current page. |
| `{{page::parentAlias}}` | This tag will be replaced with the alias of the parent page. |
| `{{page::parentTitle}}` | This tag is replaced with the name of the parent page. |
| `{{page::parentPageTitle}}` | This tag is replaced with the title of the parent page. |
| `{{page::mainAlias}}` | This tag is replaced with the alias of the parent main page. |
| `{{page::mainTitle}}` | This tag is replaced with the name of the parent main page. |
| `{{page::mainPageTitle}}` | This tag will be replaced with the title of the parent main page. |
| `{{page::rootTitle}}` | This tag is replaced with the name of the website. |
| `{{page::rootPageTitle}}` | This tag is replaced with the title of the web page. |

## Environment Variables

The following insert tags can be used to output environment variables such as the page name or the request string.

| Insert tag | Description |
| ---------- | ----------- |
| `{{env::host}}` | This tag is replaced with the current host name. (for example, example.com) |
| `{{env::url}}` | This tag is replaced with the host name and protocol. (for example, <http://www.example.com>) |
| `{{env::path}}` | This tag is replaced with the current base URL and the path to the Contao directory. |
| `{{env::request}}` | This tag is replaced with the current request string. (for example news/items/welcome.html) |
| `{{env::ip}}` | This tag is replaced with the IP address of the current visitor. |
| `{{env::referer}}` | This tag will be replaced with the URL of the last visited page. |
| `{{env::files_url}}` | This tag is replaced with the static URL of the upload directory. |
| `{{env::assets_url}}` | This tag is replaced with the static URL of the assets directory. |

## Include Elements

The following insert tags can be used to include resources such as articles, modules or files from the `templates`directory.

| Insert tag | Description |
| ---------- | ----------- |
| `{{insert_article::*}}` | This tag is replaced with the referenced article (replace \* with the ID or alias). |
| `{{insert_content::*}}` | This tag is replaced with the referenced content element (replace \* with the element's ID). |
| `{{insert_module::*}}` | This tag will be replaced with the referenced module (replace \* with the module ID). |
| `{{insert_form::*}}` | This tag is replaced with the referenced form (replace \* with the ID of the form) |
| `{{article_teaser::*}}` | This tag will be replaced with the teaser of an article (replace \* with the ID of the article). |
| `{{news_teaser::*}}` | This tag is replaced with the teaser of a message (replace \* with the ID of the message). |
| `{{event_teaser::*}}` | This tag is replaced with the teaser of an event (replace \* with the ID of the event). |
| `{{file::*}}` | This tag is replaced with the content of a .php or .html5 file from the `templates`directory (replace \* with the name). If necessary, you can pass arguments: `{{file::file.php?arg1=val}}`. You can also use UUID to get the path of a file from the database: `{{file::6939a448-9b30-11e4-bcba-079af1e9baea}}`. |

## Miscellaneous

The following insert tags allow you to perform various tasks, such as inserting the current date or a Lightbox image.

| Insert tag | Description |
| ---------- | ----------- |
| `{{date}}` | This tag will be replaced with the current date according to the global date format. |
| `{{date::*}}` | This tag will be replaced with the current date according to an individual date format. Contao supports all date and time formats that can be parsed with the [PHP function date](https://www.php.net/manual/de/function.date.php). `{{date::d.m.Y}}` |
| `{{format_date::*::*}}` | {{< version-tag "4.10" >}} This tag can be used to format a UNIX timestamp or a *standardized date*. The first parameter is the timestamp or date. The second parameter is the date format (see `{{date::*}}`) and is optional. If the date format is not specified, the date is output according to the global date format. This tag makes sense in combination with other tags or simple tokens to (re)format the output date or timestamp. Examples: `{{format_date::{{user::tstamp}}::d.m.Y}}`, `{{format_date::##member_dateAdded##}}`. If the date format cannot be recognized automatically, it can be used instead `{{convert_date::*::*::*}}`. |
| `{{convert_date::*::*::*}}` | {{< version-tag "4.10" >}} This tag can be used to reformat a date. The first parameter is the date, the second parameter is its date format (see `{{date::*}}`). The third parameter is the new date format (see `{{date::*}}`) and is optional. If the date format is not specified, the date is output according to the global date format. This tag is useful in combination with other tags or simple tokens to reformat the output date. Example: `{{convert_date::##some_date##::Y, j.n.::j. F Y}}` (converts `2020, 12.7.`to `12. Juli 2020`), for example. |
| `{{last_update}}` | This tag will be replaced with the date of last update according to the global date format. |
| `{{last_update::*}}` | This tag will be replaced with the date of the last update according to an individual date format. Contao supports all date and time formats that can be parsed with the [PHP function date](https://www.php.net/manual/de/function.date.php). `{{last_update::d.m.Y}}` |
| `{{email::*}}` | This tag is replaced with an encrypted link to an e-mail address. |
| `{{email_open::*}}` | This tag will be replaced with an encrypted link to an e-mail address. However, the closing `</a>`one is not added. |
| `{{email_close}}` | This tag is replaced with `</a>`. Example: `{{email_open::foo@example.org}}E-Mail Kontakt{{email_close}}`. |
| `{{email_url::*}}` | This tag is replaced only by the encrypted e-mail address. |
| `{{post::*}}` | This tag can be used to read and display a specified post variable. Can be used, for example, to access individual fields of a sent form. |
| `{{lang::*}}` | With this tag foreign words in a text can be marked: `{{lang::fr}}Au revoir{{lang}}`. This is replaced with `<span lang="fr">Au revoir</span>`. |
| `{{abbr::*}}` | Mark abbreviations in a text: `{{abbr::World Wide Web}}WWW{{abbr}}`. This is replaced with `<abbr title="World Wide Web">WWW</abbr>`. |
| `{{acronym::*}}` | Select acronyms in a text: `{{acronym::Multipurpose Internet Mail Extensions}}MIME{{acronym}}`. This will be replaced with `<acronym title="Multipurpose Internet Mail Extensions">MIME</acronym>`. |
| `{{ua::*}}` | Output properties of the browser (User Agent): `{{ua::browser}}`. This will be replaced with "chrome" for example. |
| `{{iflng::*}}` | This tag is completely removed if the language of the page does not match the tag language. You can create language specific tags: `{{iflng::en}}Your name{{iflng::de}}Ihr Name{{iflng}}` |
| `{{ifnlng::*}}` | This tag will be removed completely if the language of the page matches the tag language. You can create language specific tags this way: `{{ifnlng::de}}Your name{{ifnlng}}{{iflng::de}}Ihr Name{{iflng}}` |
| `{{image::*}}` | This tag is replaced with the preview of an image (where \* can be a database ID, a UUID, or a path from the file system): `{{image::58ca4a90-2d30-11e4-8c21-0800200c9a66?width=200&height=150}}`**width**: Width of the preview image **,height**: Height of the preview image, **alt**: Alternative text, **class**: CSS class, **rel**: rel attribute (e.g. "lightbox"),mode:  **Mode ("**proportional", "crop" or "box"). |
| `{{picture::*}}` | This tag will be replaced with a `<picture>`-element and different image sizes, depending on the used image size configuration (where \* can be a database ID, a UUID or a path from the file system): <br>`{{picture::58ca4a90-2d30-11e4-8c21-0800200c9a66?size=1&template=picture_default}}`. <br>**width**: width of the preview image, <br>**height**: height of the preview image, <br>**alt**: alternative text, <br>**class**: CSS class, <br>**rel**: rel attribute (z. lightbox"), <br>**mode**: Mode ("proportional", "crop" or "box"), <br>**size**: ID of an image size (see Themes  -&gt; Image sizes) ({{< version-tag "4.8" >}}**size** supports the predefined image sizes from the `config.yml`), <br>**template**: Template to use (picture\_default). |
| `{{label::*}}` | This tag is replaced with a translation. The first parameter is the name of a language file or an acronym ( `CNT`for example, for countries or `LNG`for languages). Examples: `{{label::CNT:au}}`becomes "Australia" and `{{label::tl_article:title:0}}`becomes "Title". Note that only single colons are used within the path for the name. |
| `{{version}}` | This tag will be replaced with the used Contao version (e.g. 4.8.2). |
| `{{request_token}}` | This tag will be replaced with the request token of the current session. |
| `{{toggle_view}}` | This tag will be replaced with a link that switches between mobile and desktop layout. The mobile page layout is no longer part of the core distribution **since Contao 4.8**. If you need this feature, you have to install the package `contao/mobile-page-layout-bundle`. |
| `{{br}}` | This tag is replaced with an HTML `<br>`element (line break). |
| `{{asset::*::*}}` | This tag can be used to include paths to CSS and JavaScript files from packages. See the [developer documentation](https://docs.contao.org/dev/framework/asset-management/#accessing-assets-in-templates). |
| `{{trans::*::*::*}}` | This tag can be used to output translations. In contrast to the `{{label::*}}`insert tag, all translations from the Symfony system can be output. Example: `{{trans::MSC.updateVersion::contao_default::4.10}}`. See also the [developer documentation](https://docs.contao.org/dev/framework/translations/#accessing-translations). |

## Insert tag flags

With flags you can process insert tags further. The value can be passed to a PHP function, for example. Any number of flags can be combined with each other:

```
{{ua::browser|uncached}}
{{page::title|standardize|strtoupper}}
```

Available Flags:

| Flag | Description | Further Information |
| ---- | ----------- | ------------------- |
| `uncached` | Receives the tag when writing the cache file. |  |
| `refresh` | Rebuilds the output on each request. |  |
| `addslashes` | Prepends certain characters in a string ( `\`). | [PHP function](https://php.net/addslashes) |
| `standardize` | Standardizes the output (for example, the alias in the page structure). |  |
| `absolute` | Generates an absolute path including host name and protocol | Available in Contao **4.5** and later |
| `ampersand` | Converts `&`characters into entities. |  |
| `specialchars` | Converts special characters into entities. |  |
| `nl2br` | Inserts HTML line breaks before all line breaks in a string. | [PHP function](https://php.net/nl2br) |
| `nl2br_pre` | Keeps the line breaks within `<pre>`-tags. |  |
| `strtolower` | Converts the output to lower case. | [PHP function](https://php.net/strtolower) |
| `utf8_strtolower` | Unicode-conscious conversion to lower case. |  |
| `strtoupper` | Converts the output to capital letters. | [PHP function](https://php.net/strtoupper) |
| `utf8_strtoupper` | Unicode-conscious conversion to upper case. |  |
| `ucfirst` | Converts the first character to an uppercase letter. | [PHP function](https://php.net/ucfirst) |
| `lcfirst` | Converts the first character to a lowercase letter. | [PHP function](https://php.net/lcfirst) |
| `ucwords` | Converts the first character of each word to an uppercase letter. | [PHP function](https://php.net/ucwords) |
| `trim` | Removes spaces from the beginning and end of the output. | [PHP function](https://php.net/trim) |
| `rtrim` | Removes spaces from the beginning of the output. | [PHP function](https://php.net/rtrim) |
| `ltrim` | Removes spaces from the end of the output. | [PHP function](https://php.net/ltrim) |
| `utf8_romanize` | Romance the issue. |  |
| `encodeEmail` | Encodes e-mail addresses in the output. | See `StringUtil::encodeEmail()` |
| `number_format` | Formats a number (no decimal places). | see `System::getFormattedNumber()` |
| `currency_format` | Formats a currency (two decimal places). | see `System::getFormattedNumber()` |
| `readable_size` | Converts the output into a human readable format. | see `System::getReadableSize()` |
| `urlencode` | URL encodes a string. | [PHP function](https://php.net/urlencode) |
| `rawurlencode` | URL encoding according to RFC 3986. | [PHP function](https://php.net/rawurlencode) |
| `flatten` | Converts an array into a comma-separated list of keys and values. Example: `0: value1, 1: value2, 2: value3`or `key1: value, key2.subkey: value` |

## Basic Entities

The following "Basic Enities" are converted back into the respective HTML entities by Contao:

| basic entities | HTML entities |
| -------------- | ------------- |
| `[&]` | `&amp;` = ampersand ( `&`) |
| `[lt]` | `&lt;` = less than ( `<`) |
| `[gt]` | `&gt;` = greater than ( `>`) |
| `[nbsp]` | `&nbsp;` = non-breaking spaceIf you want to prevent the break between two words, a protected space must be inserted. e.g. `Contao[nbsp]CMS` |
| `[-]` | `&shy;` = soft hyphenThe word is wrapped if there is not enough space. The separation is done with a hyphen. e.g. `Donau[-]dampf[-]schiff[-]fahrts[-]gesell[-]schaft` |
| `[{]`, `[}]` | Replaced in the frontend with `{{` bzw. `}}`. This enables you to display insert tags in the frontend, for example, to explain them. |
