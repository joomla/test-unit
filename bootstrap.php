<?php
/**
 * Prepares a minimalist framework for unit testing.
 *
 * @package    Joomla.UnitTest
 *
 * @copyright  Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       http://www.phpunit.de/manual/current/en/installation.html
 */

define('_JEXEC', 1);

// Fix magic quotes.
ini_set('magic_quotes_runtime', 0);

// Maximise error reporting.
ini_set('zend.ze1_compatibility_mode', '0');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set fixed precision value to avoid round related issues
ini_set('precision', 14);

/*
 * Ensure that required path constants are defined.  These can be overridden within the phpunit.xml file
 * if you chose to create a custom version of that file.
 */
if (!defined('JPATH_TESTS')) {
    define('JPATH_TESTS', realpath(__DIR__));
}
if (!defined('JPATH_TEST_DATABASE')) {
    define('JPATH_TEST_DATABASE', JPATH_TESTS . '/stubs/database');
}
if (!defined('JPATH_TEST_STUBS')) {
    define('JPATH_TEST_STUBS', JPATH_TESTS . '/stubs');
}

$rootDirectory = getcwd();

if (!defined('JPATH_BASE')) {
    define('JPATH_BASE', $rootDirectory);
}
if (!defined('JPATH_ROOT')) {
    define('JPATH_ROOT', JPATH_BASE);
}
if (!defined('JPATH_PLATFORM'))
{
	define('JPATH_PLATFORM', JPATH_BASE . '/libraries');
}
if (!defined('JPATH_LIBRARIES'))
{
	define('JPATH_LIBRARIES', JPATH_BASE . '/libraries');
}
if (!defined('JPATH_CACHE'))
{
	define('JPATH_CACHE', JPATH_BASE . '/cache');
}
if (!defined('JPATH_CONFIGURATION'))
{
	define('JPATH_CONFIGURATION', JPATH_BASE);
}
if (!defined('JPATH_SITE'))
{
	define('JPATH_SITE', JPATH_ROOT);
}
if (!defined('JPATH_ADMINISTRATOR'))
{
	define('JPATH_ADMINISTRATOR', JPATH_ROOT . '/administrator');
}
if (!defined('JPATH_INSTALLATION'))
{
	define('JPATH_INSTALLATION', JPATH_ROOT . '/installation');
}
if (!defined('JPATH_MANIFESTS'))
{
	define('JPATH_MANIFESTS', JPATH_ADMINISTRATOR . '/manifests');
}
if (!defined('JPATH_PLUGINS'))
{
	define('JPATH_PLUGINS', JPATH_BASE . '/plugins');
}
if (!defined('JPATH_THEMES'))
{
	define('JPATH_THEMES', JPATH_BASE . '/templates');
}
if (!defined('JDEBUG'))
{
	define('JDEBUG', false);
}

// Import the library loader if necessary.
if (!class_exists('JLoader'))
{
	require_once JPATH_PLATFORM . '/loader.php';

	// If JLoader still does not exist panic.
	if (!class_exists('JLoader'))
	{
		throw new RuntimeException('Joomla Platform not loaded.');
	}
}

// Setup the autoloaders.
JLoader::setup();

// Register the library base path for CMS libraries.
JLoader::registerPrefix('J', JPATH_PLATFORM . '/cms', false, true);

// Create the Composer autoloader
/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require JPATH_LIBRARIES . '/vendor/autoload.php';
$loader->unregister();

// Decorate Composer autoloader
spl_autoload_register([new JClassLoader($loader), 'loadClass'], true, true);

// Register the class aliases for Framework classes that have replaced their Platform equivilents
require_once JPATH_LIBRARIES . '/classmap.php';

// Define the Joomla version if not already defined.
defined('JVERSION') or define('JVERSION', (new JVersion)->getShortVersion());

JLoader::registerPrefix('Test', __DIR__ . '/core');
