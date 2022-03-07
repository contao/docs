---
title: Insert tags
description: 'Insert tags are placeholders that are replaced by specific values when a page is rendered.'
aliases:
    - /en/article-management/insert-tags/
weight: 30
---

Insert tags are placeholders that are replaced by specific values when a page is rendered. With insert tags you can e.g. create a link to a page or an article, insert page variables or read user properties. Insert tags can be used everywhere in Contao.

An insert tag always starts with two opening curly brackets, followed by arbitrary content and two closing curly brackets, e.g. `{{date}}`. Many insert tags require additional arguments which are usually separated by two colons after the insert tag name, e.g. `{{link::12}}`.


## Link elements

With these insert tags you can create links to other pages or articles. You only need the ID or alias of the target page.

| Insert tag | Description                                                                                                                                                                                                       |
| ---------- |-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `{{link::*}}` | This tag is replaced with HTML code for a link. The parameter can be the ID or alias of an internal page or an absolute URL. <sup>[[1]](#parameter-absolute)</sup><sup>,</sup> <sup>[[2]](#parameter-blank)</sup> |
| `{{link::back}}` | This tag is replaced with a link to the last page visited. Can also be used as `{{link_open::back}}`, `{{link_url::back}}`and `{{link_title::back}}`.                                                             |
| `{{link::login}}` | This tag is replaced with a link to the logon page of the current front end user (if available).                                                                                                                  |
| `{{link_open::*}}` | Is replaced with the opening tag of a link. The parameter can be the ID or alias of an internal page or an absolute URL: `{{link_open::12}}Click here{{link_close}}`.                                             |
| `{{link_url::*}}` | This tag is replaced with the URL of an internal page: `<a href="{{link_url::12}}">Click here</a>`.                                                                                                               |
| `{{link_target::*}}` | This tag will be replaced with `target="_blank" rel="noreferrer noopener"` if the specified page is an external redirection page and it is set there that the link should open in a new window.                   |
| `{{link_title::*}}` | This tag is replaced with the title of an internal page: `<a title="{{link_title::12}}">Click here</a>`.                                                                                                          |
| `{{link_name::*}}` | This tag will be replaced with the name of an internal page: `<a>{{link_name::12}}</a>`.                                                                                                                          |
| `{{link_close}}` | Will be replaced with the closing tag of a link to an internal page: `{{link_open::12}}Click here{{link_close}}`.                                                                                                 |
| `{{article::*}}` | This tag is replaced with a link to an article (replace \* with the ID or alias). <sup>[[1]](#parameter-absolute)</sup><sup>,</sup> <sup>[[2]](#parameter-blank)</sup>                                            |
| `{{article_open::*}}` | Will be replaced with the opening tag of a link to an article: `{{article_open::12}}Click here{{link_close}}`.                                                                                                    |
| `{{article_url::*}}` | This tag is replaced with the URL of an article: `<a href="{{article_url::12}}">Click here</a>`.                                                                                                                  |
| `{{article_title::*}}` | This tag is replaced by the title of an article: `<a title="{{article_title::12}}">Click here</a>`.                                                                                                               |
| `{{news::*}}` | This tag is replaced with a link to a message (replace \* with the ID or alias). <sup>[[1]](#parameter-absolute)</sup><sup>,</sup> <sup>[[2]](#parameter-blank)</sup>                                             |
| `{{news_open::*}}` | Is replaced with the opening tag of a link to a message: `{{news_open::12}}Click here{{link_close}}`.                                                                                                             |
| `{{news_url::*}}` | This tag will be replaced with the URL of a message: `<a href="{{news_url::12}}">Click here</a>`.                                                                                                                 |
| `{{news_title::*}}` | This tag is replaced with the title of a message: `<a title="{{news_title::12}}">Click here</a>`.                                                                                                                 |
| `{{news_feed::*}}` | This tag will be replaced with the URL to a news feed (replace \* with the ID).                                                                                                                                   |
| `{{event::*}}` | This tag will be replaced with a link to an event (replace \* with the ID or alias). <sup>[[1]](#parameter-absolute)</sup><sup>,</sup> <sup>[[2]](#parameter-blank)</sup>                                         |
| `{{event_open::*}}` | Is replaced with the opening tag of a link to an event: `{{event_open::12}}Click here{{link_close}}`.                                                                                                             |
| `{{event_url::*}}` | This tag is replaced with the URL of an event: `<a href="{{event_url::12}}">Click here</a>`.                                                                                                                      |
| `{{event_title::*}}` | This tag is replaced with the title of an event: `<a title="{{event_title::12}}">Click here</a>`.                                                                                                                 |
| `{{calendar_feed::*}}` | This tag is replaced with the URL to a calendar feed (replace \* with the ID).                                                                                                                                    |
| `{{faq::*}}` | This tag will be replaced with a link to a frequently asked question (replace \* with the ID or alias). <sup>[[1]](#parameter-absolute)</sup><sup>,</sup> <sup>[[2]](#parameter-blank)</sup>                      |
| `{{faq_open::*}}` | Will be replaced with the opening tag of a link to a question: `{{faq_open::12}}Click here{{link_close}}`.                                                                                                        |
| `{{faq_url::*}}` | This tag will be replaced with the URL of a question: `<a href="{{faq_url::12}}">Click here</a>`.                                                                                                                 |
| `{{faq_title::*}}` | This tag will be replaced with the title of a question: `<a title="{{faq_title::12}}">Click here</a>`.                                                                                                            |


### Link parameters

{{< version "4.13" >}}

#### Parameter ::absolute

`{{link::*`**`::absolute`**`}}`: The parameter allows to output an insert tag link as an absolute URL.

**The HTML Output**  
The insert tag link with parameter generates the following HTML code:

```html
<a href="https://www.example.com/news.html" title="…">…</a>
```


#### Parameter ::blank

`{{link::*`**`::blank`**`}}`: The parameter allows to open an insert tag link in a new window.

**HThe HTML Output**  
The insert tag link with parameter generates the following HTML code:

```html
<a href="news.html" title="…" target="_blank" rel="noreferrer noopener">…</a>
```


## Member properties

With the following insert tags you can read certain properties of a logged in front end user and address them with their name. You can pass all field names of the table `tl_member` as arguments.

| Insert tag | Description |
| ---------- | ----------- |
| `{{user::*}}` | This tag will be replaced with the content of a field of `tl_member` of the logged in member (replace \* with the field name). |
| `{{user::firstname}}` | This tag is replaced with the first name of the registered member. |
| `{{user::lastname}}` | This tag will be replaced with the last name of the registered member. |
| `{{user::company}}` | This tag will be replaced with the company name of the logged in member. |
| `{{user::phone}}` | This tag will be replaced with the phone number of the logged in member. |
| `{{user::mobile}}` | This tag will be replaced with the mobile phone number of the logged in member. |
| `{{user::fax}}` | This tag will be replaced with the fax number of the registered member. |
| `{{user::email}}` | This tag will be replaced with the email address of the logged in member. |
| `{{user::website}}` | This tag is replaced with the internet address of the logged in member. |
| `{{user::street}}` | This tag will be replaced with the street name of the registered member. |
| `{{user::postal}}` | This tag will be replaced with the postal code of the registered member. |
| `{{user::city}}` | This tag will be replaced with the city of the registered member. |
| `{{user::country}}` | This tag will be replaced with the country of the logged in member. |
| `{{user::username}}` | This tag is replaced with the username of the logged in member. |


## Page properties

The following insert tags can be used to output page properties such as the page name.

| Insert tag | Description |
| ---------- | ----------- |
| `{{page::*}}` | This tag is replaced with the content of a field from `tl_page` of the current page (replace \* with the field name). |
| `{{page::id}}` | This tag is replaced with the ID of the current page. |
| `{{page::alias}}` | This tag is replaced with the alias of the current page. |
| `{{page::title}}` | This tag is replaced with the name of the current page. |
| `{{page::pageTitle}}` | This tag is replaced with the title of the current page. |
| `{{page::description}}` | This tag is replaced with the description of the current page. |
| `{{page::language}}` | This tag is replaced with the language of the current page. |
| `{{page::parentAlias}}` | This tag will be replaced with the alias of the parent page. |
| `{{page::parentTitle}}` | This tag is replaced with the name of the parent page. |
| `{{page::parentPageTitle}}` | This tag is replaced with the page title of the parent page. |
| `{{page::mainAlias}}` | This tag is replaced with the alias of the parent main page. |
| `{{page::mainTitle}}` | This tag is replaced with the name of the parent main page. |
| `{{page::mainPageTitle}}` | This tag will be replaced with the page title of the parent main page. |
| `{{page::rootTitle}}` | This tag is replaced with the name of the root page. |
| `{{page::rootPageTitle}}` | This tag is replaced with the page title of the root page. |


## Environment variables

The following insert tags can be used to output environment variables such as the page name, or the request string.

| Insert tag | Description |
| ---------- | ----------- |
| `{{env::host}}` | This tag is replaced with the current host name (for example, example.com). |
| `{{env::url}}` | This tag is replaced with the host name and protocol (for example, <https://www.example.com>). |
| `{{env::path}}` | This tag is replaced with the current base URL and the path to the Contao directory. |
| `{{env::request}}` | This tag is replaced with the current request string (for example news/items/welcome.html). |
| `{{env::ip}}` | This tag is replaced with the IP address of the current visitor. |
| `{{env::referer}}` | This tag will be replaced with the URL of the last visited page. |
| `{{env::files_url}}` | This tag is replaced with the static URL of the upload directory. |
| `{{env::assets_url}}` | This tag is replaced with the static URL of the assets directory. |


## Include elements

The following insert tags can be used to include resources such as articles, modules or files from the `templates` directory.

| Insert tag | Description |
| ---------- | ----------- |
| `{{insert_article::*}}` | This tag is replaced with the referenced article (replace \* with the ID or alias). |
| `{{insert_content::*}}` | This tag is replaced with the referenced content element (replace \* with the element's ID). |
| `{{insert_module::*}}` | This tag will be replaced with the referenced module (replace \* with the module ID). |
| `{{insert_form::*}}` | This tag is replaced with the referenced form (replace \* with the ID of the form). |
| `{{article_teaser::*}}` | This tag will be replaced with the teaser of an article (replace \* with the ID of the article). |
| `{{news_teaser::*}}` | This tag is replaced with the teaser of a message (replace \* with the ID of the message). |
| `{{event_teaser::*}}` | This tag is replaced with the teaser of an event (replace \* with the ID of the event). |
| `{{file::*}}` | This tag is replaced with the content of a .php or .html5 file from the `templates` directory (replace \* with the name). If necessary, you can pass arguments: `{{file::file.php?arg1=val}}`. You can also use a UUID to get the path of a file from the database: `{{file::6939a448-9b30-11e4-bcba-079af1e9baea}}`. |


## Miscellaneous

The following insert tags allow you to perform various tasks, such as inserting the current date, or a lightbox image.

| Insert tag | Description |
| ---------- | ----------- |
| `{{date}}` | This tag will be replaced with the current date according to the global date format. |
| `{{date::*}}` | This tag will be replaced with the current date according to an individual date format. Contao supports all date and time formats that can be parsed with the [PHP function date](https://www.php.net/manual/en/function.date.php). `{{date::d.m.Y}}` |
| `{{format_date::*::*}}` | {{< version-tag "4.10" >}} This tag can be used to format a UNIX timestamp or a *standardized date*. The first parameter is the timestamp or date. The second parameter is the date format (see `{{date::*}}`) and is optional. If the date format is not specified, the date is output according to the global date format. This tag makes sense in combination with other tags or simple tokens to (re)format the output date or timestamp. Examples: `{{format_date::{{user::tstamp}}::d.m.Y}}`, `{{format_date::##member_dateAdded##}}`. If the date format cannot be recognized automatically, it can be used instead `{{convert_date::*::*::*}}`. |
| `{{convert_date::*::*::*}}` | {{< version-tag "4.10" >}} This tag can be used to reformat a date. The first parameter is the date, the second parameter is its date format (see `{{date::*}}`). The third parameter is the new date format (see `{{date::*}}`) and is optional. If the date format is not specified, the date is output according to the global date format. This tag is useful in combination with other tags or simple tokens to reformat the output date. Example: `{{convert_date::##some_date##::Y, j.n.::F j, Y}}` (converts `2020, 12.7.`to `July 12, 2020`), for example. |
| `{{last_update}}` | This tag will be replaced with the date of last update according to the global date format. |
| `{{last_update::*}}` | This tag will be replaced with the date of the last update according to an individual date format. Contao supports all date and time formats that can be parsed with the [PHP function date](https://www.php.net/manual/en/function.date.php). `{{last_update::d.m.Y}}` |
| `{{email::*}}` | This tag is replaced with an encoded link to an email address. |
| `{{email_open::*}}` | This tag will be replaced with an encoded link to an email address. However, the closing `</a>` is not added. |
| `{{email_close}}` | This tag is replaced with `</a>`. Example: `{{email_open::foo@example.org}}Contact us{{email_close}}`. |
| `{{email_url::*}}` | This tag is replaced only by the encoded email address. |
| `{{post::*}}` | This tag can be used to read and display a specified post variable. Can be used, for example, to access individual fields of a sent form. |
| `{{lang::*}}` | With this tag foreign words in a text can be marked: `{{lang::fr}}Au revoir{{lang}}`. This is replaced with `<span lang="fr">Au revoir</span>`. |
| `{{abbr::*}}` | Mark abbreviations in a text: `{{abbr::World Wide Web}}WWW{{abbr}}`. This is replaced with `<abbr title="World Wide Web">WWW</abbr>`. |
| `{{acronym::*}}` | Select acronyms in a text: `{{acronym::Multipurpose Internet Mail Extensions}}MIME{{acronym}}`. This will be replaced with `<acronym title="Multipurpose Internet Mail Extensions">MIME</acronym>`. |
| `{{ua::*}}` | Output properties of the browser (User Agent): `{{ua::browser}}`. This will be replaced with "chrome" for example. |
| `{{iflng::*}}` | This tag is completely removed if the language of the page does not match the tag language. You can create language specific tags: `{{iflng::en}}Your name{{iflng::de}}Ihr Name{{iflng}}` {{% notice tip %}}
With `en,de,fr` you can test for multiple instead of just one language. On top of that, you can use `*` as wildcard which can be especially handy when working with dialects (e.g. `de*` then matches both, `de_CH` as well as `de_AT`).
{{% /notice %}} |
| `{{ifnlng::*}}` | This tag will be removed completely if the language of the page (for other options see tip in `{{iflng}}`) matches the tag language. You can create language specific tags this way: `{{iflng::de}}Ihr Name{{iflng}}{{ifnlng::de}}Your name{{ifnlng}}` |
| `{{image::*}}` | This tag is replaced with the preview of an image (where \* can be a database ID, a UUID, or a path from the file system): `{{image::58ca4a90-2d30-11e4-8c21-0800200c9a66?width=200&height=150}}`**width**: width of the preview image,<br>**height**: height of the preview image,<br>**alt**: alternative text,<br>**class**: CSS class,<br>**rel**: rel attribute (e.g. "lightbox"),<br>**mode**: mode ("proportional", "crop" or "box"). |
| `{{picture::*}}` | This tag will be replaced with a `<picture>` element and different image sizes, depending on the used image size configuration (where \* can be a database ID, a UUID or a path from the file system):<br>`{{picture::58ca4a90-2d30-11e4-8c21-0800200c9a66?size=1&template=picture_default}}`.<br>**width**: width of the preview image,<br>**height**: height of the preview image,<br>**alt**: alternative text,<br>**class**: CSS class,<br>**rel**: rel attribute (e.g. "lightbox"),<br>**mode**: mode ("proportional", "crop" or "box"),<br>**size**: ID of an image size (see Themes -&gt; Image sizes) ({{< version-tag "4.8" >}}**size** supports the predefined image sizes from the `config.yml`, the name must be preceded by an underscore e.g. `_foo`.),<br>**template**: template to use (`picture_default`). |
| `{{figure::*}}` | {{< version-tag "4.11" >}} This tag will be replaced with a `<figure>` element containing the appropriate `<picture>` element plus a `<figcaption>` if applicable. As with `{{picture::*}}` the parameter can be a database ID, UUID or a path from the file system. Additionally, all the methods supported by the  [`FigureBuilder`][DevFigureBuilder] can be used as URL parameters:<br><br>`{{figure::58ca4a90-2d30-11e4-8c21-0800200c9a66?`<br><div style="padding-left: 2em">`size=1&`<br>`metadata[title]=My%20image&`<br>`enableLightbox=1&`<br>`options[attr][class]=main_figure&`<br>`template=image`</div>`}}`.<br><br>**size**: ID of an image size (see Themes -&gt; Image sizes) or predefined image sizes from the `config.yml`, the name must be preceded by an underscore e.g. `_foo`,<br>**metadata**: allows overwriting metadata (such as "alt", "title", "caption"),<br>**enableLightbox**: generates a second image in lightbox size (see Themes -&gt; Lightbox) und adds a link to the `<figure>` element,<br>**options**: an array of options, that will be passed on to the template (can be used to set HTML attributes in case of the default template),<br>**template**: Twig- or Contao-Template to use (e.g. `@FooBundle/figure.html.twig` / `image`).<br><br>All parameters must be URL encoded. See the [FigureBuilder reference][DevFigureBuilder] from the developer documentation for the full list of configuration options. |
| `{{label::*}}` | This tag is replaced with a translation. The first parameter is the name of a language file or an acronym ( `CNT`for example, for countries or `LNG`for languages). Examples: `{{label::CNT:au}}`becomes "Australia" and `{{label::tl_article:title:0}}`becomes "Title". Note that only single colons are used within the path for the name. |
| `{{version}}` | This tag will be replaced with the used Contao version (e.g. 4.8.2). |
| `{{request_token}}` | This tag will be replaced with the request token of the current session. |
| `{{toggle_view}}` | This tag will be replaced with a link that switches between mobile and desktop layout. The mobile page layout is no longer part of the core distribution **since Contao 4.8**. If you need this feature, you have to install the package `contao/mobile-page-layout-bundle`. |
| `{{br}}` | This tag is replaced with an HTML `<br>` element (line break). |
| `{{asset::*::*}}` | This tag can be used to include paths to CSS and JavaScript files from packages. See the [developer documentation](https://docs.contao.org/dev/framework/asset-management/#accessing-assets-in-templates). |
| `{{trans::*::*::*}}` | This tag can be used to output translations. In contrast to the `{{label::*}}`insert tag, all translations from the Symfony system can be output. Example: `{{trans::MSC.updateVersion::contao_default::4.10}}`. See also the [developer documentation](https://docs.contao.org/dev/framework/translations/#accessing-translations). |


## Nested insert tags

Insert tags that have an ID or alias as output can generally be nested.

| Insert tag | Description |
|:---------- |:------------|
| `{{link::{{page::id}}\|absolute}}` | Generates a link with the absolute URL to the currently viewed page. |
| `{{link_url::{{page::id}}}}#anchor` | Generates a relative link with a jump mark (anchor) to an area in the current page (useful for onepagers). |

{{% notice info %}}
You should be careful not to generate endless loops such as those generated by `{{insert_article::{{page::alias}}}}`. This can cause the page to crash.
{{% /notice %}}


## Insert tag flags

With flags, you can process insert tags further. The value can be passed to a PHP function, for example. Any number of flags can be combined with each other:

```
{{ua::browser|uncached}}
{{page::title|standardize|strtoupper}}
```

Available flags:

| Flag | Description | Further Information |
| ---- | ----------- | ------------------- |
| `uncached` | Receives the tag when writing the cache file. |  |
| `refresh` | Rebuilds the output on each request. |  |
| `attr` | Converts special characters into entities to make usage of the insert tag possible inside HTML attributes (like `title=""`) | see&nbsp;`StringUtil::specialcharsAttribute()` |
| `urlattr` | Converts special characters into entities, same as `attr`. Additionally, colons get URL encoded to disable disallowed protocols like `javascript:`. | see&nbsp;`StringUtil::specialcharsUrl()` |
| `addslashes` | Prepends certain characters in a string (`\`). | [PHP function](https://php.net/addslashes) |
| `standardize` | Standardizes the output (for example, the alias in the page structure). |  |
| `absolute` | Generates an absolute path including host name and protocol | Available in Contao **4.5** and later |
| `ampersand` | Converts `&` characters into entities. |  |
| `specialchars` | Converts special characters into entities. |  |
| `nl2br` | Inserts HTML line breaks before all line breaks in a string. | [PHP function](https://php.net/nl2br) |
| `nl2br_pre` | Keeps the line breaks within `<pre>` tags. |  |
| `strtolower` | Converts the output to lower case. | [PHP function](https://php.net/strtolower) |
| `utf8_strtolower` | Unicode-conscious conversion to lower case. |  |
| `strtoupper` | Converts the output to capital letters. | [PHP function](https://php.net/strtoupper) |
| `utf8_strtoupper` | Unicode-conscious conversion to upper case. |  |
| `ucfirst` | Converts the first character to an uppercase letter. | [PHP function](https://php.net/ucfirst) |
| `lcfirst` | Converts the first character to a lowercase letter. | [PHP function](https://php.net/lcfirst) |
| `ucwords` | Converts the first character of each word to an uppercase letter. | [PHP function](https://php.net/ucwords) |
| `trim` | Removes spaces from the beginning and end of the output string. | [PHP function](https://php.net/trim) |
| `ltrim` | Removes spaces from the beginning of the output string. | [PHP function](https://php.net/ltrim) |
| `rtrim` | Removes spaces from the end of the output string. | [PHP function](https://php.net/rtrim) |
| `utf8_romanize` | Romanize the output. |  |
| `encodeEmail` | Encodes email addresses in the output. | See `StringUtil::encodeEmail()` |
| `number_format` | Formats a number (no decimal places). | see `System::getFormattedNumber()` |
| `currency_format` | Formats a currency (two decimal places). | see `System::getFormattedNumber()` |
| `readable_size` | Converts the output into a human readable format. | see `System::getReadableSize()` |
| `urlencode` | URL encodes a string. | [PHP function](https://php.net/urlencode) |
| `rawurlencode` | URL encoding according to RFC 3986. | [PHP function](https://php.net/rawurlencode) |
| `flatten` | Converts an array into a comma-separated list of keys and values. Example: `0: value1, 1: value2, 2: value3` or `key1: value, key2.subkey: value` |


## Basic entities

The following "basic entities" are converted back into the respective HTML entities by Contao:

| basic entities | HTML entities |
| -------------- | ------------- |
| `[&]` | `&amp;` = ampersand (`&`) |
| `[lt]` | `&lt;` = less than (`<`) |
| `[gt]` | `&gt;` = greater than (`>`) |
| `[nbsp]` | `&nbsp;` = non-breaking space. If you want to prevent the break between two words, a protected space must be inserted (e.g. `Contao[nbsp]CMS`). |
| `[-]` | `&shy;` = soft hyphen. The word is wrapped if there is not enough space. The separation is done with a hyphen, e.g. if you want to separate the typical German compound words like `Donau[-]dampf[-]schiff[-]fahrts[-]gesell[-]schaft` |
| `[{]`, `[}]` | Replaced in the front end with `{{` or `}}`, respectively. This enables you to display insert tags in the front end. For example, to explain them. |


[DevFigureBuilder]: https://docs.contao.org/dev/framework/image-processing/image-studio/#setting-options
