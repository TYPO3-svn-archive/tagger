<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Register Plugin
Tx_Extbase_Utility_Extension::configurePlugin($_EXTKEY, 'PiTagger', array('Tag' => 'list,textcloud'), array());

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = t3lib_extMgm::extPath('tagger', 'Classes/UserFunction/ProcessDatamap.php') . ':user_Tagger_UserFunction_ProcessDatamap';
?>