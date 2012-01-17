<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Tim Lochmüller
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

class Tx_Tagger_Service_FlexformSelection {

	public function addReleations(&$config, &$obj) {
		$rows = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows('tablenames', 'tx_tagger_tag_mm', '1=1', 'tablenames', 'tablenames DESC');
		foreach ($rows as $row) {
			$table = $row['tablenames'];
			$icon = t3lib_iconWorks::getIcon($table);
			if (substr($icon, 0, 4) == 'gfx/')
				$icon = str_replace('gfx/', '', $icon);
			$config['items'][] = array($table, $table, $icon);
		}
	}

}