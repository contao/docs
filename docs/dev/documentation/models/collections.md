---
title: "Collections"
description: "Read or edit multiple models"
---

## Collection

`Collection` is a wrapper for [models](..). 

### findBy()
If you want to fetch more than one record from the database, you can use the static `findBy()` method.

The first parameter is the column, the second parameter is the value.

```php
// find all pages with language "de"
$pages = PageModel::findBy('language', 'de');
```

### findMultipleByIds()
You can create a collection by passing the IDs to this method:

```php
$pages = PageModel::findMultipleByIds([1, 2, 3]);
```

### Data access
You can loop through a collection object using `foreach`:
```php
foreach ($pages as $page) {
    ...
}
```