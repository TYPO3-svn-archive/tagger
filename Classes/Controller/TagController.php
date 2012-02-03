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
	 * Render the textcloud
	 * @return void
	 */
	public function textcloudAction() {
		$tags = $this->getTags();
		$this->view->assign('tags', $tags);
	}

	/**
	 * Render a simple list
	 * @return void
	 */
	public function listAction() {
		$tags = $this->getTags();
		$this->view->assign('tags', $tags);
	}

	/**
	 * Get the Tags by the current configuration
	 * 
	 * @return Tx_Extbase_Persistence_QueryResultInterface|array
	 * @todo Move the link to a pseudo field
	 * @todo Sort the preparation
	 * @todo weightscale
	 */
	protected function getTags() {
		// Get the tags
		$tags = $this->tagRepository->findByConfiguration($this->settings['selection']['relation'], $this->settings['selection']['sorting'], $this->settings['selection']['ordering'], $this->settings['selection']['amount'])->toArray();

		// Data preperation (link)
		foreach ($tags as $tag) {
			if (trim($tag->getLink()) == '')
				$tag->setLink($this->getLink($tag));
		}

		// Data preperation (weightscale)
		#echo "<pre>";
		#print_r($tags);
		// Data preperation (sorting)
		switch ($this->settings['preperation']['sorting']) {
			case 'random':
				shuffle($tags);
				break;
			case 'weight':
				shuffle($tags);
				break;
			case 'alphabethicaly':
				shuffle($tags);
				break;
			default:
				throw new Tx_Tagger_Exception('No valid preperation->sorting: ' . $this->settings['preperation']['sorting'], 241724618941);
				break;
		}

		// Data preperation (ordering)
		if ($this->settings['preperation']['ordering'] == 'desc')
			$tags = array_reverse($tags);

		return $tags;
	}

	/**
	 * @param Tx_Tagger_Domain_Model_Tag $tag 
	 * @return string
	 */
	protected function getLink(Tx_Tagger_Domain_Model_Tag $tag) {
		$configuration = $this->settings['preperation']['linkconfiguration'];

		$parser = t3lib_div::makeInstance('t3lib_TSparser');
		$parser->parse($configuration);
		$configuration = $parser->setup;

		$configuration = array(
			 'value' => '',
			 'typolink.' => $parser->setup
		);
		$configuration['typolink.']['returnLast'] = 'url';

		return $this->renderSingle($tag->toArray(), $configuration);
	}

	/**
	 * Parses data through typoscript.
	 *
	 * @param array $data
	 * @param array $configuation
	 * @return string
	 */
	protected function renderSingle(array $data, $configuration, $type = 'TEXT') {
		$cObj = t3lib_div::makeInstance('tslib_cObj');
		$cObj->data = $data;
		return $cObj->cObjGetSingle($type, $configuration);
	}

}

