CWP Themes module
=================

This module comes with a githook you can install in your git repository, to keep your code linted.

Simply copy `githooks\pre-commit.php` to `.git\hooks\pre-commit` and it will lint your code on commit.

If any error is found, the commit will exit and you will have to fix the code.