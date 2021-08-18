---
title: "Collections"
description: "Read or edit multiple models"
---


A `Collection` is a wrapper class for [models](..). 
It always contains at least one `Model`. 

If no rows were found, the return value is `null` instead of an empty `Collection`.


## Fetching rows
If you want to fetch more than one row from the database, you can use the static method `findBy()` which returns a `Collection`.

`findBy()` expects two parameters. The first is the column of the table, the second is its value.
Like for models, you can use late static binding and add the column to the method name.

A third parameter for [options](../#configuration-options) is optional.

```php
// find all pages with language "de"
$pages = PageModel::findBy('language', 'de');

// optional way with late static binding
$pages = PageModel::findByLanguage('de');
```

For more complex conditions, optionally pass arrays as parameters:

```php
// find all pages with language "de" and pid 1
$pages = PageModel::findBy(['language = ?', 'pid = ?'], ['de', 1]);

// find all entries of a model with type "store" within a given array of ids
$foos = FoobarModel::findBy(['type = ?', 'id IN (?)'], ['store', implode(',', array_map('\intval', $ids))]);
```

## Collection specific methods


### findAll()

`findAll()` returns all rows of a table:

```php
// fetch all rows from tl_page
$pages = PageModel::findAll();
```


### findMultipleByIds()
You can create a collection by passing the IDs to this method:

```php
// fetch the rows with id 1, 2 and 3 from tl_page
$pages = PageModel::findMultipleByIds([1, 2, 3]);
```


## Data access
You can loop through a collection object using `foreach`.
In this example, `$page` is a `PageModel`.

```php
$pages = PageModel::findAll();

foreach ($pages as $page) {
    // read data / modify the page record
}
```
