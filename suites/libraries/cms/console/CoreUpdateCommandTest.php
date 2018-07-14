<?php
/**
 * @package	    Joomla.UnitTest
 * @subpackage  Version
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license	    GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
 * Test class for UpdateCoreCommandTest
 *
 * @package     Joomla.UnitTest
 * @subpackage  Version
 * @since       4.0
 */


use Joomla\CMS\Application\ConsoleApplication;
use Joomla\Input\Cli;
use Joomla\CMS\Factory;
use Joomla\CMS\Console\UpdateCoreCommand;



class CoreUpdateCommandTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Object under test
	 *
	 * @var    UpdateCoreCommand
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
		// This is all I had to do to fix the error and all test case ran fine
		// Is this really worth it?
		$dispatcher = new \Joomla\Event\Dispatcher;
		$conf = Factory::getConfig();
		$app = new ConsoleApplication(new Cli([]), $conf, $dispatcher);
		Factory::$application = $app;

		$this->object = new UpdateCoreCommand;
		$this->object->setApplication($app);
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
	 * Tests if Downloading of file works
	 *
	 * @since 4.0
	 */
	public function testDownloadFile()
	{
		$url = 'https://github.com/joomla-extensions/patchtester/releases/download/3.0.0-beta3/com_patchtester.zip';
		$file = $this->object->downloadFile($url);
		$this->assertFileExists($this->object->getApplication()->get('tmp_path') . '/' . $file, 'File download failed.');

		// Delete test files
		\Joomla\Filesystem\File::delete($this->object->getApplication()->get('tmp_path') . '/' . $file);
	}

	/**
	 * Test copying of file
	 *
	 * @since 4.0
	 */
	public function testCopyFileTo()
	{
		$fileDir = JPATH_BASE . '/tmp/testDir/';

		// Create a temporary Directory
		exec("mkdir $fileDir");

		// Create a file inside the directory
		$file = $fileDir . 'testFile.txt';
		file_put_contents($file, 'Test Data');

		// Copy filr to
		$fileCopy = JPATH_BASE;
		$this->object->copyFileTo($fileDir, JPATH_BASE);

		$this->assertFileExists( JPATH_BASE . '/testFile.txt', 'File download failed.');

		// Delete Test files and folder
		unlink(JPATH_BASE . '/testFile.txt');
		exec("rm -rf $fileDir");
	}

	/**
	 * Tests runCheck Method
	 *
	 * @since 4.0
	 *
	 * @throws Exception
	 */
	public function testRunChecks()
	{
		$updated = JVERSION === $this->object->getUpdateModel()->getUpdateInformation()['latest'];

		$this->assertEquals($updated, $this->object->runChecks(), 'runChecks Method failed');
	}

	/**
	 * Tests if update model is returned
	 *
	 * @since 4.0
	 * @throws \Exception
	 */
	public function testGetUpdateModel()
	{
		$model = $this->object->getUpdateModel();

		$this->assertNotNull($model, 'Update Model cannot be null.');
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
