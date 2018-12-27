<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  Image
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Tests\Joomla\CMS\Image;

use Joomla\CMS\Image\Filter\Brightness;


/**
 * Test class for JImage.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Image
 * @since       2.5.0
 */
class ImageFilterTest extends \TestCase
{
	/**
	 * Setup for testing.
	 *
	 * @return  void
	 *
	 * @since   2.5.0
	 */
	protected function setUp()
	{
		// Verify that GD support for PHP is available.
		if (!extension_loaded('gd'))
		{
			$this->markTestSkipped('No GD support so skipping JImage tests.');
		}

		parent::setUp();
	}

	/**
	 * Tests the JImage::__construct method - with an invalid argument.
	 *
	 * @return  void
	 *
	 * @since   2.5.0
	 *
	 * @expectedException  InvalidArgumentException
	 */
	public function testConstructorInvalidArgument()
	{
		new Brightness('test');
	}

	/**
	 * Tests the JImage::__construct method.
	 *
	 * @return  void
	 *
	 * @since   2.5.0
	 */
	public function testConstructor()
	{
		// Create an image handle of the correct size.
		$imageHandle = imagecreatetruecolor(100, 100);

		$filter = new Brightness($imageHandle);

		$this->assertEquals(\TestReflection::getValue($filter, 'handle'), $imageHandle);
	}
}
