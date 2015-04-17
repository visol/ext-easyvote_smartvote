<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Easyvote Smartvote');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_candidate', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_candidate.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_candidate');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_candidate'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate',
		'label' => 'first_name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'first_name,last_name,internal_identifier,gender,year_of_birth,city,language,district_name,party_short,incumbent,elected,civil_state_name,denomination_name,education_name,employment_name,occupation,number_of_children,hobbies,favorite_books,favorite_music,favorite_movies,link_to_smart_spider,link_to_portrait,link_to_facebook,link_to_twitter,link_to_politnetz,link_to_youtube,link_to_vimeo,email,why_me,slogan,personal_website,election_list_name,photos,links,answers,spider_values,coordinate,serialized_photos,serialized_links,serialized_answers,serialized_spider_values,serialized_coordinate,party,district,election,election_list,civil_state,denomination,education,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Candidate.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_candidate.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_party', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_party.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_party');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_party'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,internal_identifier,name_short,logo,number_of_candidates,number_of_answers,facebook_profile,website,districts,election_lists,answers,serialized_districts,serialized_election_lists,serialized_answers,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Party.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_party.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_district', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_district.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_district');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_district'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_district',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,seats,internal_identifier,candidates,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/District.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_district.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_election', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_election.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_election');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_election'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_election',
		'label' => 'smart_vote_identifier',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'smart_vote_identifier,type,year,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Election.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_election.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_education', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_education.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_education');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_education'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_education',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,internal_identifier,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Education.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_education.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_civilstate', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_civilstate.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_civilstate');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_civilstate'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_civilstate',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,internal_identifier,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/CivilState.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_civilstate.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_denomination', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_denomination.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_denomination');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_denomination'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_denomination',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,internal_identifier,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Denomination.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_denomination.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_questioncategory', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_questioncategory.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_questioncategory');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_questioncategory'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_questioncategory',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,internal_identifier,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/QuestionCategory.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_questioncategory.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_question', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_question.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_question');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_question'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_question',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,internal_identifier,groupping,type,rapide,education,cleavage1,cleavage2,cleavage3,cleavage4,cleavage5,cleavage6,cleavage7,cleavage8,info,pro,contra,election,category,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Question.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_question.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_electionlist', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_electionlist.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_electionlist');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_electionlist'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_electionlist',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'name,number_of_candidates,number_of_answers,internal_identifier,link_to_list,list_number,election,district,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/ElectionList.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_electionlist.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_photo', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_photo.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_photo');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_photo'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_photo',
		'label' => 'file_name_and_path',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'file_name_and_path,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Photo.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_photo.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_link', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_link.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_link');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_link'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_link',
		'label' => 'url',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'url,description,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Link.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_link.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_answer', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_answer.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_answer');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_answer'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_answer',
		'label' => 'question',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'question,internal_identifier,value,comment,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Answer.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_answer.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_spidervalue', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_spidervalue.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_spidervalue');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_spidervalue'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_spidervalue',
		'label' => 'cleavage',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'cleavage,internal_identifier,value,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/SpiderValue.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_spidervalue.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_easyvotesmartvote_domain_model_coordinate', 'EXT:easyvote_smartvote/Resources/Private/Language/locallang_csh_tx_easyvotesmartvote_domain_model_coordinate.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_coordinate');
$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_coordinate'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_coordinate',
		'label' => 'x',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',

		),
		'searchFields' => 'x,y,election,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Coordinate.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_coordinate.gif'
	),
);
