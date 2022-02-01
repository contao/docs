---
title: "Translations"
description: How to create translations within the Contao framework.
aliases:
    - /framework/translations/
---


Since the development of Contao started without the Symfony framework (see also 
the [history][ContaoHistory]), it provides its own translation framework. While
you are free to utilize Symfony's [translation component][SymfonyTranslations],
you will still have to provide translations within Contao's framework for certain
aspects, mostly in the back end (e.g. translations for managing your own data records 
via the [Data Container Array][dca]).

Translations for Contao are managed within the `contao/languages/` folder of your
application, or the `Resources/contao/languages/` folder of your extension respectively.
Each language for which you want to provide translations, or customize existing
translations, will have its own subdirectory containing the translation files. The
name of the subdirectory will be the language code of each language. The translation 
files themselves can be implemented either in XLIFF (`.xlf`) or as PHP arrays (`.php`).


## Supported Languages

For the _front end_, any standardized language can be used. The name of the subdirectory
for each language has to be either the ISO 639 language code (e.g. `de` for _German_), 
or the ISO 15897 POSIX locale for regions (e.g. `de_AT` for _German (Austria)_).
No further configuration is necessary, other than the translations being present.

{{% notice note %}}
In the site structure, the _IETF Language Tag_ format is used for the site's language 
in the website root (e.g. `de-AT`).
{{% /notice %}}

For the _back end_, only the languages configured in the Contao Core Bundle can
be selected for each back end user. However, you can adjust this configuration in
your own application:

```yaml
# config/config.yaml
contao:
    locales:
        - en
        - de_AT
```

This example configuration will reduce the available back end languages to two languages
and will also make _German (Austria)_ available as a back end language, which it 
would not be by default. Keep in mind that the Contao Core only provides the translations 
for specific languages for the front and back end.

{{% notice note %}}
_English_ (`en`) will always serve as the fallback in all cases, if a translation 
string is not available in the current language.
{{% /notice %}}


## Structure

In general, Contao's translations are organized as follows:

_**Language** » **Domain** » **Category** » **Key** » **Label** / **Description**_

The _language_ is of course denoted by the directory of each individiual language. 
The _domain_ is represented by individual files within the language. These files
contain the actual translation definitions, where each translation ID always consists
of a _category_ and a _key_.

In the end, Contao's translations will actually be stored in the `$GLOBALS['TL_LANG']`
array within PHP. So for example the translation for the _Go back_ link in the front
end will be defined within the `default` domain of the English (`en`) language and 
then resides in

```php
$GLOBALS['TL_LANG']['MSC']['goBack'] = 'Go back';
```

Here, the category is `MSC` (short for _miscellaneous_), the translation key is
`goBack` and the actual translation label is `Go back`. 

In various places Contao actually expects the translation to be an array with two
values, e.g. for [DCA][dca] fields or back end modules. The first value being the 
actual label while the second value is a description.

```php
$GLOBALS['TL_LANG']['tl_module']['headline'] = [
    'Text',
    'You can use HTML tags to format the text.',
];
```

### Domains

Contao uses the following domains for translations:

| Domain      | Description                                                                |
| ----------- | -------------------------------------------------------------------------- |
| `countries` | Translations of country names.                                             |
| `default`   | Various translations for the front and back end.                           |
| `exception` | Translation of error message that might be shown in the front or back end. |
| `explain`   | Translated content for the help wizard within a Data Container.            |
| `languages` | Translation of language names.                                             |
| `modules`   | Back end module labels and descriptions.                                   |

There is also a domain for each Data Container. The domain's name is the same as 
the Data Container's name. For example, for `tl_content` the translation's domain 
name is also `tl_content`.


### Categories

Contao uses the following categories in various domains:

| Category   | Domain          | Description                                                        |
| ---------- | --------------- | ------------------------------------------------------------------ |
| `CNT`      | `countries`     | _Country_.                                                         |
| `ERR`      | `default`       | Error messages.                                                    |
| `SEC`      | `default`       | Security questions (captcha).                                      |
| `CTE`      | `default`       | _Content Element_.                                                 |
| `PTY`      | `default`       | _Page type_ (site structure).                                      |
| `FOP`      | `default`       | _File operation permissions_.                                      |
| `CHMOD`    | `default`       | Translations for the access rights widget (`ChmodTable`).          |
| `DATE`     | `default`       | Date format definitions.                                           |
| `DAYS`     | `default`       | Translations for weekdays.                                         |
| `MONTHS`   | `default`       | Translations for month names.                                      |
| `MSC`      | `default`       | _Miscellaneous_.                                                   |
| `UNITS`    | `default`       | Binary units like _KiB_.                                           |
| `CONFIRM`  | `default`       | Translations for the invalid request token notice in the back end. |
| `DP`       | `default`       | Date picker.                                                       |
| `COLS`     | `default`       | Layout section names.                                              |
| `SECTIONS` | `default`       | Layout section positions.                                          |
| `DCA`      | `default`       | Various data container view translations.                          |
| `XPT`      | `exception`     | Error messages for the front and back end.                         |
| `XPL`      | `explain`       | Help wizard content.                                               |
| `LNG`      | `languages`     | Translation of language names.                                     |
| `MOD`      | `modules`       | Back end module labels and descriptions.                           |
| `FMD`      | `modules`       | Front end module labels and descriptions.                          |
| `FFL`      | `tl_form_field` | Translations for form generator form fields.                       |
| `CACHE`    | `tl_page`       | Labels for the different cache time page settings.                 |
| `CRAWL`    | `default`       | Translations for the crawler interface in the back end.            |

There is also a category for each Data Container. The category's name is the same 
as the Data Container's name. For example, for `tl_content` the translation's category
is also `tl_content`.


## Customizing and Extending Translations

As already mentioned, translations are managed either via PHP or XLIFF files. These
can be extended or customized using your translation files (see 
[Contao Configuration & Translations][contaoConfig]). Let
us first look at the PHP implementation of changing or extending Contao's translations.
We will take the previous example and change the _Go back_ link in the front end 
to let it say _Back_ instead. Since the original translation is contained within
the `default` domain of the English (`en`) language, we also need to override it 
there by creating the following file:

```php
// contao/languages/en/default.php
$GLOBALS['TL_LANG']['MSC']['goBack'] = 'Back';
```

When creating or adjusting translations with **XLIFF** files instead, we need to
note one particular thing: _category_ and _key_ (and _index_ of translations with 
a label/description pair) are combined into _one_ translation ID. However, we still
create one file for each domain as before:

```xml
<!-- contao/languages/en/default.xlf -->
<?xml version="1.0" encoding="UTF-8"?>
<xliff version="1.1">
  <file>
    <body>
      <trans-unit id="MSC.goBack">
        <target>Back</target>
      </trans-unit>
    </body>
  </file>
</xliff>
```

Adjusting the label and description of a DCA field for the back end with XLIFF files 
would look like this:

```xml
<!-- contao/languages/de/tl_content.xlf -->
<?xml version="1.0" encoding="UTF-8"?>
<xliff version="1.1">
  <file>
    <body>
      <trans-unit id="tl_content.text.0">
        <target>Text-Inhalt</target>
      </trans-unit>
      <trans-unit id="tl_content.text.1">
        <target>Geben Sie hier den Text-Inhalt ein.</target>
      </trans-unit>
    </body>
  </file>
</xliff>
```

When extending translations, only the choice of the translation domain is relevant. 
Categories and keys for new translations can be chosen at your own discretion. 
For example, if you create a translation that might be used across different places 
in the system, use the `default` domain. You can choose to use the `MSC` category, 
but you do not have to.


## Accessing Translations

Within the Contao context, all translations can be accessed via the `$GLOBALS['TL_LANG']`
array as seen above. This array is populated with the translations of the language
of the current request context. Keep in mind however, that the Data Container translations
(`tl_*`) are not loaded on every request, but only when needed in the back end.
You can load translations by using the following legacy function:

```php
\Contao\System::loadLanguageFile('tl_content', 'de');
```

The first parameter is the domain ("language file") while the second parameter is the language you want to load.

You can also use Symfony's Translator service instead:

```php
// src/Controller/ExampleController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/app/test", name=ExampleController::class)
 */
class ExampleController
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function __invoke(): Response
    {
        return new Response($this->translator->trans('MSC.goBack', [], 'contao_default'));
    }
}
```

To access a specific Contao translation domain, simply prepend it with `contao_`. This also takes care of loading the respective language
file automatically. You do not need to call `System::loadLanguageFile` when using the translator service.


### Translations within Contao PHP Templates

The `trans` method of the translator is available within Contao's PHP templates:

```php
// templates/my_template.html5
<?= $this->trans('MSC.goBack') ?>
```

_Note:_ in this example the second and third argument was ommitted and the default 
values `[]` and `contao_default` are used. The following example shows how to access
a translation from domain other than `default`:

```php
// templates/my_template.html5
<?= $this->trans('XPT.error', [], 'contao_exception') ?>
```


### Translations within Twig Templates

Contao's translations can also be accessed just as any other Symfony translation
using Twig tags and filters:

```twig
{# templates/my_template.html5.twig #}
{{ 'MSC.goBack'|trans({}, 'contao_default') }}
```

See Symfony's documentation on [translations in templates](https://symfony.com/doc/current/translation/templates.html)
for more details.


[ContaoHistory]: /#history
[SymfonyTranslations]: https://symfony.com/doc/current/translation.html
[dca]: /framework/dca/
[TwigTranslations]: https://symfony.com/doc/current/translation/templates.html
[contaoConfig]: /getting-started/starting-development/#contao-configuration-translations
