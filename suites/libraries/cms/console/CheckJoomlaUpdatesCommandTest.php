<?php
/**
 * @package	    Joomla.UnitTest
 * @subpackage  Version
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license	    GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Test class for CheckJoomlaUpdatesCommand.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Version
 * @since       3.0
 */

use Joomla\CMS\Console\CheckJoomlaUpdatesCommand;

class CheckJoomlaUpdatesCommandTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Object under test
	 *
	 * @var    CheckJoomlaUpdatesCommand
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
		$this->object = new CheckJoomlaUpdatesCommand;
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
	 * Check if Update Information Contains required information
	 *
	 * @since version 4.0
	 */
	public function testIfUpdateInformationContainsRequiredParameters()
	{
		$updateInfo = $this->object->getUpdateInformation();
		$this->assertArrayHasKey('installed', $updateInfo, 'The current version is not defined.');
		$this->assertArrayHasKey('latest', $updateInfo, 'The latest Version must be defined.');
		$this->assertArrayHasKey('object', $updateInfo, 'Update details information should be set.');
		$this->assertArrayHasKey('hasUpdate', $updateInfo);
	}

	/**
	 * Test if installed version returned from Update Information is JVersion
	 *
	 * @since version 4.0
	 */
	public function testIfJversionIsInstalledVersion()
	{
		$this->assertEquals(\JVERSION, $updateInfo['installed']);
	}

	/**
	 * Tests if the name of the command is 'check-updates'
	 *
	 * @since version 4.0
	 */
	public function testIfCommandNameIsSpecifiedProperly()
	{
		$this->assertEquals('check-updates', $this->object->getName(), 'The Command name should be check-updates');
	}

	/**
	 *  Tests if the name of the Command is set
	 *
	 * @since version 4.0
	 */
	public function testIfCommandHasName()
	{
		$this->assertNotNull($this->object->getName(), 'The command must contain a name');
	}

	/**
	 * Tests if the command has help information
	 *
	 * @since version 4.0
	 */
	public function testIfCommandHasHelp()
	{
		$this->assertNotNull($this->object->getProcessedHelp(), 'The command must contain a name');
	}

	/**
	 * Test if execute methood is implemented
	 *
	 * @since version 4.0
	 */
	public function testIfCommandImplementsExecutemethod()
	{
		$this->assertTrue(method_exists($this->object, 'execute'), 'The Command Class must Implement the execute method');
	}

	/**
	 * Tests if the Command class implements the initialise method
	 *
	 * @since version 4.0
	 */
	public function testIfCommandImplementsInitialiseMethod()
	{
		$this->assertTrue(method_exists($this->object, 'initialise'), 'The Command Class must Implement the initialise method');
	}

	/**
	 * Tests if the Command Class Extends Abstract Command
	 *
	 * @since version 4.0
	 */
	public function testIfCommandClassExtendsAbstractCommand()
	{
		$this->assertTrue(is_subclass_of($his->object, 'AbstractCommand'), 'Command Class must implement AbstractCommand');
	}
}
