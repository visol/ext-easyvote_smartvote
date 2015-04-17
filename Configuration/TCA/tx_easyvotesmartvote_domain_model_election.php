<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_election'] = [
	'ctrl' => [
		'title' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_election',
		'label' => 'smart_vote_identifier',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',

		],
		'searchFields' => 'smart_vote_identifier,type,year,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('easyvote_smartvote') . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_election.png'
	],
	'types' => [
		'1' => ['showitem' => 'hidden;;1, smart_vote_identifier'],
	],
	'palettes' => [
		'1' => ['showitem' => ''],
	],
	'columns' => [

		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check',
			],
		],

		'smart_vote_identifier' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_election.smart_vote_identifier',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			],
		],
		'type' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_election.type',
			'config' => [
				'type' => 'select',
				'items' => [
					['-- Label --', 0],
				],
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			],
		],
		'year' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_election.year',
			'config' => [
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			]
		],

		'district' => [
			'config' => [
				'type' => 'passthrough',
			],
		],
	],
	'grid' => [
		'columns' => array(
			'__checkbox' => array(
				'renderer' => new TYPO3\CMS\Vidi\Grid\CheckBoxComponent(),
			),
			'uid' => array(
				'visible' => FALSE,
				'label' => 'Id',
				'width' => '5px',
			),
			'smart_vote_identifier' => array(
				'visible' => TRUE,
				'editable' => TRUE,
			),
			'__import_wizard' => array(
				'renderer' => new Visol\EasyvoteSmartvote\Grid\ImportWizardColumn(),
			),
			'__buttons' => array(
				'renderer' => new TYPO3\CMS\Vidi\Grid\ButtonGroupComponent(),
			),
		),
	]
];
