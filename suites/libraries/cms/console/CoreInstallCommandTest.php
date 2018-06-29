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
	 * Tests isAlphanumeric Method
	 *
	 * @since 4.0
	 */
	public function testIsAlphanumeric()
	{
		$text = "06AbdgeJoomla";
		self::assertTrue($this->object->isAlphanumeric($text));

		$text = "Joomla%#5677";
		self::assertTrue(is_array($this->object->isAlphanumeric($text)));
	}

	/**
	 * Tests isEmail Method
	 *
	 * @since 4.0
	 */
	public function testIsEmail()
	{
		$text = "example@joomla.com";
		self::assertTrue($this->object->isEmail($text));

		$text = "example@j";
		self::assertTrue(is_array($this->object->isEmail($text)));
	}

	/**
	 * Tests minLength Method
	 *
	 * @since 4.0
	 */
	public function testMinLength()
	{
		$text = "Hello World!";
		self::assertTrue($this->object->minLength($text, 8));

		$text = "Hello World!";
		self::assertTrue(is_array($this->object->minLength($text, 13)));
	}

	/**
	 * Tests maxLength method
	 *
	 * @since 4.0
	 */
	public function testMaxLength()
	{
		$text = "Hello World!";
		self::assertTrue($this->object->maxLength($text, 13));

		$text = "Hello World!";
		self::assertTrue(is_array($this->object->maxLength($text, 8)));
	}


	/**
	 * Tests isInteger Method
	 *
	 * @since 4.0
	 */
	public function testIsInteger()
	{
		$integer = 2018;
		self::assertTrue($this->object->isInteger($integer));

		$integer = "Twenty eighteen";
		self::assertTrue(is_array($this->object->isInteger($integer)));
	}

	/**
	 * Tests validateInput method
	 *
	 * @since 4.0
	 *
	 * @dataProvider dataInputRules
	 */
	public function testValidateInput($input, $rule, $expected)
	{
		$outcome = $this->object->validateInput($input, $rule);
		self::assertEquals($expected, $outcome, 'Validation Fails');
	}

	/**
	 * Provides data for test testValidateInput method
	 *
	 * @return array
	 *
	 * @since 4.0
	 */
	public function dataInputRules()
	{
		return [
			[
				2018, 'isInteger|minLength:4|maxLength:6', true,
			],
			[
				206, 'isInteger|minLength:4|maxLength:6', ['message' => "The input cannot be lesser than 4 characters."],
			]
		];
	}
}
