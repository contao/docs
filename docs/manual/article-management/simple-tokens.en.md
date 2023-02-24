---
title: "Simple tokens"
description: "Simple tokens are placeholders that can output content just like insert tags."
aliases:
    - /en/article-management/simple-tokens/
weight: 40
---

Simple tokens are placeholders that can output content just like insert tags. The difference is that simple tokens can not only output content, but also parse values with case queries and regular expressions. Simple tokens have been an integral part of Contao since version 2.x. Unlike insert tags, which can be used globally, simple tokens allow developers to decide which simple tokens are available and where they can be used. It is recommended to consult the documentation of the extension. Starting with Contao 4.10, simple tokens use the Symfony Expression Language, which can be used to extend the range of applications.

## How do I use simple tokens?

The output of simple tokens is done with two enclosing hashes `##`. Which values can be output can be found in the respective backend module or extension. Within case queries, the diamonds are omitted.

## Which simple tokens are available?

Simple tokens can only be used on designated backend modules or extensions. If a simple token is not supported, an empty output and a log entry that a simple token could not be replaced are generated.

Example:

| Syntax              | Description                                               | Module                       |
| --------------------| --------------------------------------------------------- | --------------------------- |
| `##tstamp##`        | Timestamp                                                 |                             |
| `##flang##`         | Currently used language                                   |                             |
| `##domain##`        | Current domain                                            | Newsletter                  |
| `##link##`          | Link to the newsletter                                    | Newsletter                  |
| `##channels##`      | Subscribed news channel                                   | Newsletter                  |


## Where can simple tokens be used?

- User: Module type 'Registration'
- User: Module type 'Lost password'
- Newsletter: ['Newsletter reader', 'Subscribe' and 'Unsubscribe'](https://docs.contao.org/manual/en/core-extensions/newsletter/newsletter-management/#personalizing-the-newsletter)
- Extensions e.g. Notification Center, Isotope eCommerce, Catalog Manager, MetaModels, Leads, Multiple pages forms
- As placeholder in [insert tags](https://docs.contao.org/manual/en/article-management/insert-tags/#miscellaneous)


## Other purposes:

`file_from_##tstamp##.pdf` for files creates file_from_1650437899.pdf

`files/data/##form_brochure##.pdf` Path to PDF file with individual file name

It is also possible to use simple tokens as case queries. This simple tokens are no longer written with `##` but with opening and closing brackets `{}`.

Example for the Notification Center:

```
Request for: ##form_origin##
{if form_appointments != ""}
   Appointment: ##form_appointments##
{endif}

{if form_formtype != "extended"}
  Name: ##form_name##
  Email: ##form_email##
  Phone: ##form_phone##
{else}
  First name: ##form_firstname##
  Name: ##form_name##
  Street: ##form_street##
  Zip code: ##form_zipcode##
  City: ##form_location##
{endif}
```

Example for the newsletter module:

```
{if flang == "en"}
  Your language is English.
{elseif == "de"}
  Deine Sprache ist Deutsch.
{else}
  Couldn't assign a language.
{endif}
```


## Which operators can be set for conditions?

| Syntax      | Description                   |
| ----------- | ------------------------------|
| `==`        | Explicit comparison           |
| `!=`        | Unequal                       |
| `===`       | Strict with type conversion   |
| `!==`       | Not identical                 |
| `<`         | Smaller than                  |
| `>`         | Greater than                  |
| `<=`        | Smaller equal                 |
| `>=`        | Greater equal                 |

The operators can be set with or without spaces. Therefore both `{if form_name != ""}` and `{if form_name!=""}` work.

## Improved Simple Tokens

As of Contao 4.10, Simple Tokens have been improved and now support the entire Symfony Expression Language.
This means that you can combine statements with AND/OR statements using `&&` and `||`:

`{if form_value == "foo" || form_value == "bar"}`

Moreover, you can now work with literals and arithmetic operators:

```
{if form_value === true}
{if form_value === (42 + 15 + form_other_value)}
```

This is extremely handy when working with the additional operators now supported:

| Syntax        | Description                                                  |
|---------------|--------------------------------------------------------------|
| `in`          | Array comparison (e.g. `form_value in ['value1', 'value2']`) |
| `not in`      | Same as `in` but negated                                     |
| `contains`    | `form_value contains 'foobar'`                               |
| `starts with` | `form_value starts with 'foobar'`                            |
| `ends with`   | `form_value ends with 'foobar'`                              |
| `matches`     | Regular expression (e.g. `form_value matches '^https?://'` ) |

There's more!

Check the Symfony documentation for more information on the [Expression Language Syntax][Expression_Language_Syntax].

[Expression_Language_Syntax]: https://symfony.com/doc/current/components/expression_language/syntax.html