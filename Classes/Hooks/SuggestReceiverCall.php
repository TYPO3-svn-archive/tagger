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

class Tx_Tagger_Hooks_SuggestReceiverCall {
	const TAG = 'tx_tagger_domain_model_tag';
	const LLPATH = 'LLL:EXT:news/Resources/Private/Language/locallang_be.xml:tag_suggest_';

	/**
	 * Create a tag
	 *
	 * @param array $params
	 * @param TYPO3AJAX $ajaxObj
	 * @return void
	 */
	public function createTag(array $params, TYPO3AJAX $ajaxObj) {
		$request = t3lib_div::_POST();

		try {
			throw new Exception('asd');
			// check if a tag is submitted
			if (!isset($request['item']) || empty($request['item'])) {
				throw new Exception('error_no-tag');
			}

			$newsUid = $request['newsid'];
			if ((int) $newsUid === 0 && (strlen($newsUid) == 16 && !t3lib_div::isFirstPartOfStr($newsUid, 'NEW'))) {
				throw new Exception('error_no-newsid');
			}

			// get tag uid
			$newTagId = $this->getTagUid($request);

			$ajaxObj->setContentFormat('javascript');
			$ajaxObj->setContent('');
			$response = array(
				 $newTagId,
				 $request['item'],
				 'tx_tagger_domain_model_tag',
				 self::NEWS,
				 'tags',
				 'data[tx_news_domain_model_news][' . $newsUid . '][tags]',
				 $newsUid
			);
			$ajaxObj->setJavascriptCallbackWrap(implode('-', $response));
		} catch (Exception $e) {
			$errorMsg = $GLOBALS['LANG']->sL(self::LLPATH . $e->getMessage());
			$ajaxObj->setError($errorMsg);
		}
	}

	/**
	 * Get the uid of the tag, either bei inserting as new or get existing
	 *
	 * @param array $request ajax request
	 * @return integer
	 */
	protected function getTagUid(array $request) {
		$tagUid = 0;

		$record = $GLOBALS['TYPO3_DB']->exec_SELECTgetSingleRow(
				  '*', 'tx_tagger_domain_model_tag', 'deleted=0 AND title=' . $GLOBALS['TYPO3_DB']->fullQuoteStr($request['item'], 'tx_tagger_domain_model_tag')
		);
		if (isset($record['uid'])) {
			$tagUid = $record['uid'];
		} else {
			$tagUid = Tx_Tagger_Service_IntegrationService::createTagRecord($request['item']);
		}

		if ($tagUid == 0) {
			throw new Exception('error_no-tag-created');
		}

		return $tagUid;
	}

}
