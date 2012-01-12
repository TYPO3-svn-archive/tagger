<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Register Plugin
Tx_Extbase_Utility_Extension::configurePlugin($_EXTKEY, 'PiTagger', array('Tag' => 'list,textcloud'), array());
?>