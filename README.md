# test-unit
Unit Tests for Joomla

This repository collects and provides the automated tests, that can be **run on the source code directly without needing an installed Joomla CMS**. In short, these tests run with PHPUnit and do not rely on services like the database being available.

## Folder Structure

* `suites` - The actual test classes
* `tmp` - A temporary directory used for filesystem operations in the test suite
* `bootstrap.php` - The testing bootstrap called when PHPUnit is run
