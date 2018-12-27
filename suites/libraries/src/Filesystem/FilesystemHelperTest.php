<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Filesystem
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Tests\Joomla\CMS\Filesystem;

use Joomla\CMS\Filesystem\FilesystemHelper;

/**
 * Test class for FilesystemHelper.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Event
 * @since       1.7.0
 */
class FilesystemHelperTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * @var FilesystemHelper
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->object = new FilesystemHelper;
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
	 * Test...
	 *
	 * @covers  FilesystemHelper::getJStreams
	 *
	 * @return void
	 */
	public function testGetJStreams()
	{
		$streams = FilesystemHelper::getJStreams();

		$this->assertEquals(
			array('string'),
			$streams
		);
	}

	/**
	 * Test...
	 *
	 * @covers  FilesystemHelper::isJoomlaStream
	 *
	 * @return void
	 */
	public function testIsJoomlaStream()
	{
		$this->assertTrue(
			FilesystemHelper::isJoomlaStream('string')
		);

		$this->assertFalse(
			FilesystemHelper::isJoomlaStream('unknown')
		);
	}
}
