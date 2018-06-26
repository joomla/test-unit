<?php
/**
 * @package	    Joomla.UnitTest
 * @subpackage  Version
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license	    GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Test class for UpdateCoreCommandTest
 *
 * @package     Joomla.UnitTest
 * @subpackage  Version
 * @since       3.0
 */



namespace Joomla\UnitTest\CMS\Console;

use Joomla\CMS\Application\ConsoleApplication;
use Joomla\Console\AbstractCommand;
use Joomla\Console\Application;
use Joomla\Input\Cli;
use Joomla\Registry\Registry;

/**
 * Class TestConsole
 *
 * This class of course belongs to its own file
 */
class TestConsole extends Application
{
	/**
	 * @var \Symfony\Component\Console\Output\BufferedOutput
	 */
	public $output;

	public function __construct(Cli $input = null, Registry $config = null)
	{
		parent::__construct($input, $config);

		$this->output = new \Symfony\Component\Console\Output\BufferedOutput();
		$this->setConsoleOutput($this->output);
	}
}


use Joomla\CMS\Console\UpdateCoreCommand;

class CoreUpdateCommandTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Object under test
	 *
	 * @var    UpdateCoreCommand
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
		$this->object = new UpdateCoreCommand;
		$a = new TestConsole(new Cli([]));
		$this->object->setApplication(new TestConsole(new Cli([])));
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

//	public function testGetUpdateModel()
//	{
//		$model = $this->object->getUpdateModel();
//
//		$this->assertNotNull($model, 'Update Model cannot be null.');
//	}

	public function testDownloadFile()
	{
		$url = 'https://github.com/joomla-extensions/patchtester/releases/download/3.0.0-beta3/com_patchtester.zip';
		$file = $this->object->downloadFile($url);
		$this->assertFileExists($this->object->getApplication()->get('tmp_path') . '/' . $file, 'File download failed.');
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

		$this->assertEquals($info, $this->object->updateInfo);
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
