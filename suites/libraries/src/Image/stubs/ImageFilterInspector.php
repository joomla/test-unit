<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Image
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_PLATFORM') or die;

namespace Joomla\CMS\Image\Filter;

use Joomla\CMS\Image\ImageFilter;

/**
 * Image Filter class inspector for testing purposes.
 *
 * @package     Joomla.UnitTest
 * @subpackage  Image
 * @since       1.7.3
 */
class ImageFilterInspector extends ImageFilter
{
	/**
	 * Method to apply a filter to an image resource.
	 *
	 * @param   array  $options  An array of options for the filter.
	 *
	 * @return  void
	 *
	 * @since   1.7.3
	 */
	public function execute(array $options = array())
	{
	}
}
