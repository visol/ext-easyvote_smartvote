<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_party'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_party']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, internal_identifier, name_short, logo, number_of_candidates, number_of_answers, facebook_profile, website, candidates, election',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, internal_identifier, name_short, logo, number_of_candidates, number_of_answers, facebook_profile, website, candidates, election, '),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_easyvotesmartvote_domain_model_party',
				'foreign_table_where' => 'AND tx_easyvotesmartvote_domain_model_party.pid=###CURRENT_PID### AND tx_easyvotesmartvote_domain_model_party.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),

		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'internal_identifier' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party.internal_identifier',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'name_short' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party.name_short',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'logo' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party.logo',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'number_of_candidates' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party.number_of_candidates',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'number_of_answers' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party.number_of_answers',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			)
		),
		'facebook_profile' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party.facebook_profile',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'website' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party.website',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'candidates' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party.candidates',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => '',
				'foreign_field' => 'party',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),

		),
		'election' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_party.election',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_easyvotesmartvote_domain_model_election',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		
	),
);
