<?php
/**
 * @package	    Joomla.UnitTest
 * @subpackage  Version
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license	    GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Test class for CoreInstallCommandTest
 *
 * @package     Joomla.UnitTest
 * @subpackage  Version
 * @since       4.0
 */


use Joomla\CMS\Console\CoreInstallCommand;



class CoreInstallCommandTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Object under test
	 *
	 * @var    CoreInstallCommandmmand
	 * @since  4.0
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   4.0
	 */
	protected function setUp()
	{
		$this->object = new CoreInstallCommand;
		JLoader::registerNamespace('Joomla\\CMS\\Installation', JPATH_INSTALLATION . '/src', false, false, 'psr4');
	}

	/**
	 * Overrides the parent tearDown method.
	 *
	 * @return  void
	 *
	 * @see     \PHPUnit\Framework\TestCase::tearDown()
	 * @since   4.0
	 */
	protected function tearDown()
	{
		unset($this->object);
		parent::tearDown();
	}

	/**
	 * TEsts the getDummyOptions methos
	 *
	 * @return void
	 *
	 * @since 4.0
	 */
	public function testGetDummyOption()
	{
		$options = $this->object->getDummyOptions();

		$this->assertNotEmpty($options, 'Default options cannot be empty');
	}

	/**
	 * Tests the getOptionsTemplate method
	 *
	 * @return void
	 *
	 * @since 4.0
	 */
	public function testGetOptionsTemplate()
	{
		$expectedKeys = [
			'language',
			'site_name',
			'admin_email',
			'admin_user',
			'admin_password',
			'db_type',
			'db_host',
			'db_user',
			'db_pass',
			'db_name',
			'db_prefix',
			'db_old',
			'helpurl',
		];
		$actualKeys = array_keys($this->object->getOptionsTemplate());

		$this->assertEquals($expectedKeys, $actualKeys);
	}

	/**
	 * Tests the parseIniFile method
	 *
	 * @return void
	 *
	 * @since 4.0
	 */
	public function testParseIniFile()
	{
		$content = "name=Joomla\nyear=2018";
		touch('config.ini');
		file_put_contents('config.ini', $content);

		$options = $this->object->parseIniFile('config.ini');

		self::assertEquals('Joomla', $options['name']);
		self::assertEquals('2018', $options['year']);

		\Joomla\Filesystem\File::delete('config.ini');
	}

	/**
	 * Tests the processUninteractiveInstallation method
	 *
	 * @return void
	 *
	 * @since 4.0
	 */
	public function testProcessUninteractiveInstallation()
	{
		$iniContent = "name=Joomla\nyear=2018";
		$jsonContent = '{"name":"Joomla", "year":"2018"}';

		touch('config.bat');
		touch('config.ini');

		$options = $this->object->processUninteractiveInstallation('config.joomla');
		self::assertEquals('Unable to locate file specified', $options);

		$options = $this->object->processUninteractiveInstallation('config.bat');
		self::assertEquals('The file type specified is not supported', $options);

		file_put_contents('config.ini', $iniContent);
		$options = $this->object->processUninteractiveInstallation('config.ini', false);
		self::assertEquals('Joomla', $options['name']);
		self::assertEquals('2018', $options['year']);

		file_put_contents('config.json', $jsonContent);
		$options = $this->object->processUninteractiveInstallation('config.json', false);
		self::assertEquals('Joomla', $options['name']);
		self::assertEquals('2018', $options['year']);

		\Joomla\Filesystem\File::delete('config.ini');
		\Joomla\Filesystem\File::delete('config.json');
		\Joomla\Filesystem\File::delete('config.bat');
	}
}
