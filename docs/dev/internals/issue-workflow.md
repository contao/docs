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

## Handling new issues

New issues do not get an assignee by default.

If you can reproduce a newly reported bug, please remove the <span class="label-status">unconfirmed</span> label and
assign the issue to the milestone of the version in which the bug needs to be fixed (e.g. `4.9`). Otherwise, please
leave the <span class="label-status">unconfirmed</span> label in place and add a short comment.

Do not assign feature requests to a milestone. 

## Handling new PRs

Please assign new PRs to their creator.

After reading a new PR, please label it either as <span class="label-bug">bug</span> or as
<span class="label-feature">feature</span>.

If the PR is targeted against an active version branch (e.g. `4.9`), please assign it to the corresponding milestone.
Do not assign PRs targeted against the main branch (currently `5.x`) to a milestone.

## Reviewing bug reports

If you can reproduce the bug, please remove the <span class="label-status">unconfirmed</span> label. If it is unclear
how to fix the bug, please add the <span class="label-discuss">up for discussion</span> label.

If you want to work on the bug yourself, self-assign the ticket.

If nobody assigns themselves a ticket, it will get the <span class="label-help">help wanted</span> label to indicate
that we are looking for volunteers to complete it.

If the bug cannot be fixed without breaking backwards compatibility, please add the
<span class="label-status">incompatible</span> label. 
 
## Reviewing feature requests

If it is unclear how to implement the feature, please add the <span class="label-discuss">up for discussion</span>
label to the ticket. If the feature cannot be implemented without breaking backwards compatibility, please add the
<span class="label-status">incompatible</span> label. 
