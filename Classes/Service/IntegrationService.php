<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Tim Lochmüller
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

class Tx_Tagger_Service_IntegrationService {

	/**
	 * Get the field configuration for a Tag field
	 * 
	 * @param string $tableName
	 * @return array 
	 */
	public static function getTagFieldConfiguration($tableName) {
		$config = array(
			'type' => 'select',
			'foreign_table' => 'tx_tagger_domain_model_tag',
			'foreign_table_where' => 'ORDER BY tx_tagger_domain_model_tag.title',
			'MM' => 'tx_tagger_tag_mm',
			'MM_hasUidField' => TRUE,
			'multiple' => FALSE,
			'MM_opposite_field' => 'content',
			'MM_match_fields' => array(
				'tablenames' => $tableName
			),
			'size' => 5,
			'autoSizeMax' => 20,
			'minitems' => 0,
			'maxitems' => 30,
			'wizards' => array(
				'_PADDING' => 2,
				'_VERTICAL' => 1,
				'suggest' => array(
					'type' => 'suggest',
					'default' => array(
						'receiverClass' => 'Tx_Tagger_Hooks_SuggestReceiver'
					),
				),
			),
		);

		return $config;
	}

	/**
	 * Create a new Tag Record
	 * 
	 * @param string $title
	 * @return integer The ID of the New Tag 
	 */
	public static function createTagRecord($title) {
		$tcemainData = array(
			'tx_tagger_domain_model_tag' => array(
				'NEW' => array(
					'pid' => 0,
					'title' => $title
				)
			)
		);

		/**
		 * @var t3lib_TCEmain
		 */
		$tce = t3lib_div::makeInstance('t3lib_TCEmain');
		$tce->start($tcemainData, array());
		$tce->process_datamap();

		return $tce->substNEWwithIDs['NEW'];
	}

	/**
	 * Get related contents
	 * 
	 * @param string $table
	 * @param integer $uid
	 * @return array
	 * @TODO: implement
	 */
	public static function gerRelatedContent($table, $uid) {
		$records = array();
		/*
		  $GLOBALS['TSFE']->exec_SELECTgetRows('uid_foreign as uid, tablenames', 'tx_tagger_tag_mm',
		  ,
		  $ groupBy = '',
		  $ orderBy = '',
		  $ limit = '',
		  $ uidIndexField = ''
		  )
		 * Ü */

		return $records;
	}

	/**
	 * Get related by same tag
	 * 
	 * @param integer $uid
	 * @return array
	 */
	public static function gerRelatedByTag($uid) {
		return $GLOBALS['TSFE']->exec_SELECTgetRows('uid_foreign as uid, tablenames', 'tx_tagger_tag_mm', 'uid_local=' . $uid);
	}

}