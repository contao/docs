---
title: "Models"
description: "Read objects from and write them to the database"
aliases:
    - /framework/models/
---


Models are objects for creating new records and reading or modifying existing records from the database - you can compare them to Doctrine's Entities.

In Contao, each database table has a corresponding model class:

| Table      | Model class  |
|------------|--------------|
| tl_article | ArticleModel |
| tl_news    | NewsModel    |
| tl_page    | PageModel    |
| …          | …            |


## Fetching a row

Each class extending `Model` has some *static* methods you can use:

```php
use Contao\PageModel;

// get a record by its primary key
$page = PageModel::findByPk(2);

// find a record by ID or alias (the parameter you pass can be both)
$page = PageModel::findByIdOrAlias('index');

// find the record where adminEmail is "admin@example.com"
$page = PageModel::findOneBy('adminEmail', 'admin@example.com');

// count the records where language is "de"
$total = PageModel::countBy('language', 'de');
```

If no row in the table matches your query, the return value is `null`.

Also, `Model` implements the `__callStatic()` method from PHP. This way you can attach the field name of the table to the method name and omit the first parameter.

At the moment, the methods `findOneBy()`, `findBy()` and `countBy()` are supported:

```php
// find a record by ID or alias (the parameter you pass can be both)
$page = PageModel::findById(5);

// find the record where adminEmail is "admin@example.com"
$page = PageModel::findOneByAdminEmail('admin@example.com');

// count the records where language is "de"
$page = PageModel::countByLanguage('de');
```


## Modifying records

After you fetched the record, you can read or edit its data:
```php
// get the page ID
$id = $page->id;

// set the alias
$page->alias = 'index';

// update the record in the database
$page->save();
```

## Configuration options
You can add a third (or if you use the static binded methods with the field name, second) parameter to the Model method.
This is an array containing configuration which then will be added to the SQL query in the background.

The following options are available:

| Option | What does it do?                                   | SQL Equivalent | Example value         |
|--------|----------------------------------------------------|----------------|-----------------------|
| limit  | Limit the total records                            | LIMIT          | 3                     |
| offset | skip the first n records of the result             | OFFSET         | 10                    |
| order  | Order the models by a certain field                | ORDER BY       | 'id DESC'             |
| return | Define the return value as `Model` or `Collection` | -              | 'Model', 'Collection' |

```php
$options = [
    'limit' => 5,
    'offset' => 10
];

// get subpages of page 1 with findBy()
$pages = PageModel::findBy('pid', 1, $options);

// get subpages of page 1 with late static binding
$pages = PageModel::findByPid(1, $options);
```


## Special cases

By default, `findOneBy()` always returns a `Model` object, `findBy()` always returns a `Collection` object.

A few exceptions are `findByPk()`, `findById()` and `findByIdOrAlias()`. These methods always return a Model.

For more information, please have a look into the respective Model classes on [GitHub](https://github.com/contao/contao/tree/master/core-bundle/src/Resources/contao/models).


## Creating your own Model
For documentation on creating your own model, [click here](customization).

## Collections
If you want to fetch multiple records from the database, have a look into [Collections](collections).
