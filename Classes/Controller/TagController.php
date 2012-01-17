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

class Tx_Tagger_Controller_TagController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_Tagger_Domain_Model_Tag 
	 */
	protected $tagRepository;

	/**
	 * @param Tx_Tagger_Domain_Repository_TagRepository $tagRepository 
	 */
	public function injectTagRepository(Tx_Tagger_Domain_Repository_TagRepository $tagRepository) {
		$this->tagRepository = $tagRepository;
	}

	/**
	 * 
	 */
	public function textcloudAction() {
		
		#throw new Tx_Tagger_Exception('Das ist die Fehlermeldung', 12345);
		
		$this->view->assign('tags', $this->tagRepository->findAll());
	}

	/**
	 * 
	 */
	public function listAction() {
		
	}

}

