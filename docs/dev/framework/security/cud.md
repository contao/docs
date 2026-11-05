---
title: "CUD permissions"
description: "Configure create, update and delete permissions for DCA tables."
---

{{< version "5.7" >}}

CUD stands for **create**, **update** and **delete**. These permissions let you decide what non-admin users may do with
records in a table. For example, editors might be allowed to update existing records, while only their team leader
can create or delete them.

The DCA defines which operations appear in _Table permissions_ when editing a back end user or user group. You then
use those settings to grant the permissions. Adding `create` to the DCA makes that permission available; the user or
group still needs to be given it.


## Configuring a Table

Contao provides all three permission controls by default for tables using `Contao\DC_Table` with at least one input
field. You can choose which permissions to offer with the DCA's
[`permissions` configuration]({{% relref "reference/dca/config#permissions" %}}):

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['config']['permissions'] = ['create', 'update', 'delete'];
```

This makes all three permissions available for `tl_example`. It does not give any user access by itself.

To let a group edit existing records, select _Update_ for `tl_example` in the group's _Table permissions_. Leave
_Create_ and _Delete_ unselected if members of that group should not have those permissions. A user's own settings
and membership in other groups can also contribute to their permissions.

If you leave an operation out of the array, Contao does not check its CUD permission. For example,
`['create', 'delete']` lets you configure who may create or delete records; updating records does not need a CUD grant.
An empty array removes the table from the widget and skips its CUD checks entirely.

The usual access rules still apply: users need access to the back end module, the records and the fields they want
to edit. Administrators bypass CUD checks. Pages and articles keep their existing page permissions, with CUD checks
disabled by default for `tl_page` and `tl_article`.


## Checking Permissions in Your Code

In your own back end code, use the [security helper]({{% relref "reference/services#security-helper" %}}) to check
whether the current user has a table permission. Pass the table name and operation separated by `::`:

```php
// src/Controller/Backend/ExampleController.php
use Contao\CoreBundle\Security\ContaoCorePermissions;

// $security is an injected Symfony\Bundle\SecurityBundle\Security service.
$security->isGranted(ContaoCorePermissions::USER_CAN_OPERATE_ON_TABLE, 'tl_example::create');
$security->isGranted(ContaoCorePermissions::USER_CAN_OPERATE_ON_TABLE, 'tl_example::update');
$security->isGranted(ContaoCorePermissions::USER_CAN_OPERATE_ON_TABLE, 'tl_example::delete');
```

These calls check the table permission only. When working with a specific record, use a
[data container action]({{% relref "framework/security/data-container" %}}) to check the record's access rules as well:

```php
// src/Controller/Backend/ExampleController.php
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Contao\CoreBundle\Security\DataContainer\UpdateAction;

// $record contains the current database row as an array.
$security->isGranted(ContaoCorePermissions::DC_PREFIX.'tl_example', new UpdateAction('tl_example', $record));
```


## Custom Operations

You can also make custom operations available in the table permissions widget. For example, add `export` to the list:

```php
// contao/dca/tl_example.php
$GLOBALS['TL_DCA']['tl_example']['config']['permissions'] = ['create', 'update', 'delete', 'export'];
```

The widget shows this option in its _Additional permissions_ column. Add a label for it in your translations:

```yaml
# translations/contao_tl_user_group.en.yaml
tl_user:
    cud:
        tl_example:
            export: Export records
```

Contao checks the three standard operations automatically. For custom operations, check the permission in your own
code before performing the action:

```php
// src/Controller/Backend/ExportController.php
use Contao\CoreBundle\Security\ContaoCorePermissions;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

if (!$security->isGranted(ContaoCorePermissions::USER_CAN_OPERATE_ON_TABLE, 'tl_example::export')) {
    throw new AccessDeniedException('Not allowed to export records.');
}
```


## Updating Existing Code

When updating an extension for Contao 5.7, replace checks on old core permission fields such as `formp` and `newsp`
with `contao_user.cud` checks. For example, `contao_user.newsp.create` becomes
`contao_user.cud.tl_news_archive::create`. Contao migrates the existing core permissions during the update.
