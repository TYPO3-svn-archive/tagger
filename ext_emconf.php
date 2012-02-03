<?php

########################################################################
# Extension Manager/Repository config file for ext "tagger".
#
# Auto generated 17-01-2012 15:36
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	 'title' => 'Tagger',
	 'description' => 'Complex but easy tag system with extbase / fluid base and many output possibilities',
	 'category' => 'plugin',
	 'author' => 'Tim Lochmüller',
	 'author_email' => 'tl@hdnet.de',
	 'author_company' => 'HDNET',
	 'shy' => '',
	 'priority' => '',
	 'module' => '',
	 'state' => 'alpha',
	 'internal' => '',
	 'uploadfolder' => 0,
	 'createDirs' => '',
	 'modify_tables' => '',
	 'clearCacheOnLoad' => 0,
	 'lockType' => '',
	 'version' => '0.0.1',
	 'constraints' => array(
		  'depends' => array(
				'cms' => '',
				'extbase' => '',
				'fluid' => '',
		  ),
		  'conflicts' => array(
		  ),
		  'suggests' => array(
		  ),
	 ),
	 '_md5_values_when_last_written' => 'a:20:{s:12:"ext_icon.gif";s:4:"5af7";s:17:"ext_localconf.php";s:4:"ba6a";s:14:"ext_tables.php";s:4:"4eca";s:14:"ext_tables.sql";s:4:"c839";s:21:"Classes/Exception.php";s:4:"b2c9";s:36:"Classes/Controller/TagController.php";s:4:"53aa";s:38:"Classes/Domain/Model/AbstractModel.php";s:4:"0728";s:28:"Classes/Domain/Model/Tag.php";s:4:"9544";s:43:"Classes/Domain/Repository/TagRepository.php";s:4:"26c1";s:33:"Classes/Hooks/SuggestReceiver.php";s:4:"f6c6";s:37:"Classes/Hooks/SuggestReceiverCall.php";s:4:"1d2e";s:37:"Classes/Service/FlexformSelection.php";s:4:"0464";s:38:"Classes/Service/IntegrationService.php";s:4:"7dcc";s:39:"Classes/UserFunction/ProcessDatamap.php";s:4:"450e";s:36:"Configuration/FlexForms/PiTagger.xml";s:4:"1d7c";s:25:"Configuration/TCA/Tag.php";s:4:"4eba";s:40:"Resources/Private/Language/locallang.xml";s:4:"ad0c";s:41:"Resources/Private/Templates/Tag/List.html";s:4:"643b";s:46:"Resources/Private/Templates/Tag/Textcloud.html";s:4:"8908";s:30:"Resources/Public/Icons/Tag.png";s:4:"0824";}',
);
?>