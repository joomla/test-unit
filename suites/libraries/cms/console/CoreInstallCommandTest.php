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
 * @since       3.0
 */


use Joomla\CMS\Console\CoreInstallCommand;



class CoreInstallCommandTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Object under test
	 *
	 * @var    CoreInstallCommandmmand
	 * @since  3.0
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	protected function setUp()
	{
		$this->object = new CoreInstallCommand;
	}

	/**
	 * Overrides the parent tearDown method.
	 *
	 * @return  void
	 *
	 * @see     \PHPUnit\Framework\TestCase::tearDown()
	 * @since   3.6
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
}
