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
	 * Tests if the name of the command is 'check-updates'
	 *
	 * @since version 4.0
	 */
	public function testIfCommandNameIsSpecifiedProperly()
	{
		$this->assertEquals('check-updates', $this->object->getName(), 'The Command name should be check-updates');
	}

	/**
	 * Tests SetUpdateInfo method
	 *
	 * @since 4.0
	 *
	 * @dataProvider dataTestSetUpdateInfo
	 */
	public function testSetUpdateInfo($info)
	{
		$this->object->setUpdateInfo($info);
		$this->assertEquals($info, $this->object->getUpdateInfo());
	}

	/**
	 * Provides data for test SetUpdateInfo method
	 *
	 * @return array
	 *
	 * @since 4.0
	 */
	public function dataTestSetUpdateInfo()
	{
		return [
			[
					'installed' => \JVERSION,
					'latest'    => null,
					'object'    => null,
					'hasUpdate' => false,
			]
		];
	}
}
