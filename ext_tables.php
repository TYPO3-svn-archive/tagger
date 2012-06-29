<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Register Plugin & FlexForm
$pluginName = 'PiTagger';
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, $pluginName, 'Tagger');
$pluginSignature = strtolower(t3lib_div::underscoredToUpperCamelCase($_EXTKEY) . '_' . $pluginName);
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/' . $pluginName . '.xml');

// Register Tag database
t3lib_extMgm::addLLrefForTCAdescr('tx_tagger_domain_model_tag', 'EXT:blogger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag');
t3lib_extMgm::allowTableOnStandardPages('tx_tagger_domain_model_tag');
$TCA['tx_tagger_domain_model_tag'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY title',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Tag.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/Tag.png'
	),
);

// Register BE AJAX Action
$GLOBALS['TYPO3_CONF_VARS']['BE']['AJAX']['Tag::createTag'] = t3lib_extMgm::extPath('tagger', 'Classes/Hooks/SuggestReceiverCall.php') . ':Tx_Tagger_Hooks_SuggestReceiverCall->createTag';
?>