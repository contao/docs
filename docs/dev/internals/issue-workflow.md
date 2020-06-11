---
title: "Issue/PR workflow"
description: "How Contao developers are supposed to handle issues and PRs on GitHub"
---
<style>
    span[class^="label-"] {
      padding: 0 3px 2px;
      border-radius: 3px;
    }
    .label-bug {
      background-color: #bd2c00;
      color: #fff;
    }
    .label-feature {
      background-color: #3364b7;
      color: #fff;
    }
    .label-discuss {
      background-color: #86c60d;
    }
    .label-help {
      background-color: #c4dcfc;
    }
    .label-status {
      background-color: #fbca04;
    }
</style>

This article describes the issue workflow used on the [official monorepository of Contao on GitHub](https://github.com/contao/contao).

## Handling of new issues

After you have submitted a new issue, one of the maintainers will label it either as <span class="label-bug">bug</span> or as
<span class="label-feature">feature</span>.

If it is a bug, they will assign your issue to the milestone of the minor version in which the bug needs to be fixed (e.g.
`4.4`). Maintainers will not assign feature requests to any milestone.

New issues do not get an assignee by default.

## Handling of new Pull Requests

After you have submitted a new Pull Request, one of the maintainers will label it either as <span class="label-bug">bug</span> or as
<span class="label-feature">feature</span>.

If the Pull Request targets a currently actively supported version branch (e.g. `4.4`) (bugs only), the maintainer will assign
it to the corresponding milestone.
For Pull Requests that target the `master` branch (usually features), the maintainers will not assign any milestone.

If you are the creator of a Pull Request, the maintainer will assign it to you.

## Reviewing bug reports

If a maintainer cannot reproduce the bug, they will add the <span class="label-status">unconfirmed</span> label to the issue.
If it is unclear how to fix the bug, they will add the <span class="label-discuss">up for discussion</span> label which
means they will discuss possible solutions during periodical phone calls on Mumble which is often a lot more efficient.

If any maintainer wants to work on a bug, they self-assign the issue.

If no maintainer assigns themselves an issue, it will get the <span class="label-help">help wanted</span> label to indicate
that we are looking for volunteers to complete it.

If the bug cannot be fixed without breaking backwards compatibility, it becomes a "known limitation" for the current
version, and it gets the <span class="label-status">incompatible</span> label. These issues will be addressed in the
next major version.
 
## Reviewing feature requests

If it is unclear how to implement the feature, a maintainer adds the <span class="label-discuss">up for discussion</span>
label to the issue. If the feature cannot be implemented without breaking backwards compatibility, they add the
<span class="label-status">incompatible</span> label. 

## Stale issues

Issues will turn stale after 60 days if they

* have no label or
* are labeled as <span class="label-bug">bug</span> and are not labeled as
  <span class="label-discuss">up for discussion</span>, <span class="label-help">help wanted</span> or
  <span class="label-status">incompatible</span>.

Stale issues will be automatically closed after another 7 days of no activity in order to help the maintainers keep
the number of issues to a comprehensible level.