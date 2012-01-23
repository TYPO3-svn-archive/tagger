<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Tim Lochmüller <tl@hdnet.de>
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

class Tx_Tagger_Domain_Model_AbstractModel extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		
	}

	/**
	 * 
	 * @return array
	 */
	public function toArray() {
		$vars = array();
		$objectVars = array_keys(get_object_vars($this));
		foreach ($objectVars as $var) {
			if (method_exists($this, 'get' . ucfirst($var))) {
				$vars[$var] = call_user_func(array($this, 'get' . ucfirst($var)));
			}
		}
		return $vars;
	}

}