---
title: "Expand Demo"
description: "SHortcode expand."
url: "anleitungen/expand"
aliases:
    - /de/anleitungen/expand/
    - /anleitungen/expand/
weight: 60
---
<style>
/*
 * Shortcode expand
 */  
.expand { }

.expand-label {
  border: 1px solid rgb(218, 218, 218);
  height: auto;
  padding: 4px 0 4px 10px;
  margin: 0 0 1rem 0;
  color: var(--MAIN-TITLES-TEXT-color);
}
.expand-label:hover {
  background-color: rgba(218, 218, 218, 0.1);
}

.expand-label i { 
  font-size: 1rem !important;
  width: 1rem; 
  color: var(--MENU-SEARCH-BG-color);
}

.expand-label span { 
  display: inline-block;
  line-height: 1rem;
}

.expand-content {
  margin: 1rem 0 1rem 0;
}
</style>


## Expand Demo

Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore 
et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. 

Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. 


{{%expand "Is this learn theme rocks ?" %}}
Yes !.
{{% /expand%}}

{{%expand "My Quetsion A ?" %}}
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore 
magna aliqua. Ut enim ad [minim veniam](#), quis nostrud »exercitation ullamco« laboris nisi ut aliquip ex ea commodo
consequat. 

{{% notice note %}}
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore 
magna aliqua.
{{% /notice %}}
{{% /expand%}}

{{%expand "My Quetsion B" %}}
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore 
magna aliqua. Ut enim ad [minim veniam](#), quis nostrud »exercitation ullamco« laboris nisi ut aliquip ex ea commodo
consequat. 

![Grid Demo](/de/guides/images/de/grid/grid-structure.jpg?classes=shadow)

Duis aute irure dolor in `reprehenderit` in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
{{% /expand%}}