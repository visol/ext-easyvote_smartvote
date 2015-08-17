<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_personalelectionlist'] = [
	'ctrl' => [
		'title'	=> 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_personalelectionlist.xlf:personal_election_list',
		'label' => 'community_user',
		'label_alt' => 'election, election_list',
		'label_alt_force' => TRUE,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'dividers2tabs' => TRUE,
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
		],
		'searchFields' => '',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('easyvote_smartvote') . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_personalelectionlist.gif'
	],
	'types' => [
		'1' => ['showitem' => 'community_user, election, election_list, candidates'],
	],
	'columns' => [

		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
			],
		],
		'election' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_election',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_easyvotesmartvote_domain_model_election',
				'minitems' => 1,
				'maxitems' => 1,
			],
		],
		'community_user' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote/Resources/Private/Language/locallang_db.xlf:tx_easyvote_domain_model_communityuser',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'minitems' => 1,
				'maxitems' => 1,
			],
		],
		'election_list' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_electionlist',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_easyvotesmartvote_domain_model_electionlist',
				'items' => [
					['', ''],
				],
				'minitems' => 0,
				'maxitems' => 1,
			],
		],
		'candidates' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_easyvotesmartvote_domain_model_candidate',
				'MM' => 'tx_easyvotesmartvote_personalelectionlist_candidate_mm',
				'size' => 10,
				'minitems'      => 0,
				'maxitems'      => 99,
				'autoSizeMax' => 30,
				'multiple' => 0,
			],
		],
	],
];
