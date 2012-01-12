<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$TCA['tx_tagger_domain_model_tag'] = array(
	'ctrl' => $TCA['tx_tagger_domain_model_tag']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title',
	),
	'types' => array(
		'1' => array('showitem' => 'title;;1,content,valuation,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime, sys_language_uid, l10n_parent, l10n_diffsource, hidden'),
	),
	'palettes' => array(
		'1' => array('showitem' => 'slug,link'),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_tagger_domain_model_tag',
				'foreign_table_where' => 'AND tx_tagger_domain_model_category.pid=###CURRENT_PID### AND tx_tagger_domain_model_category.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'slug' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag.slug',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'eval' => 'trim,required'
			),
		),
		'link' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag.link',
			'config' => array(
				'type' => 'input',
				'size' => 20,
				'checkbox' => '',
				'wizards' => array(
					'link' => array(
						'type' => 'popup',
						'title' => 'Link',
						'icon' => 'link_popup.gif',
						'script' => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
					)
				),
			),
		),
		'content' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag.content',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'allowed' => '*',
				'MM' => 'tx_tagger_tag_mm',
				'MM_hasUidField' => TRUE,
				'maxitems' => 999,
				'size' => 10,
			),
		),
		'valuation' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:tagger/Resources/Private/Language/locallang.xml:tx_tagger_domain_model_tag.valuation',
			'config' => array(
				'type' => 'input',
				'size' => 8,
				'eval' => 'double2',
				'defualt' => '1.0',
			),
		),
	),
);
?>