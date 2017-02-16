CWP Themes module
=================

This module comes with a githook you can install in your git repository, to keep your code linted.

Simply copy `githooks\pre-commit.php` to `.git\hooks\pre-commit` and it will lint your code on commit.

If any error is found, the commit will exit and you will have to fix the code.

CWP Search
==========

Search has it's own form and search index. To override the search index used, you can create your own and add the following to your config.yml:
```
Injector:
  CWPIndexer:
    class: CWPModuleSearchIndex
```
And replace CWPModuleSearchIndex with your own Index


To change the amount of search results per page, add the following to your config:
```
CWPSearchController:
  page_limit: 10

```

Where the limit is changeable to whatever limit you prefer.