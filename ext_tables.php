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
		'searchFields' => 'first_name,last_name,internal_identifier,gender,year_of_birth,language,city,incumbent,elected,party,district,election,',
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
		'searchFields' => 'name,internal_identifier,name_short,logo,number_of_candidates,number_of_answers,facebook_profile,website,candidates,election,',
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
