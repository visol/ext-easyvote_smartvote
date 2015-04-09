<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_candidate'] = array(
	'ctrl' => $GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_candidate']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, first_name, last_name, internal_identifier, gender, year_of_birth, language, city, incumbent, elected, party, district, election',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, first_name, last_name, internal_identifier, gender, year_of_birth, language, city, incumbent, elected, party, district, election, '),
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
				'foreign_table' => 'tx_easyvotesmartvote_domain_model_candidate',
				'foreign_table_where' => 'AND tx_easyvotesmartvote_domain_model_candidate.pid=###CURRENT_PID### AND tx_easyvotesmartvote_domain_model_candidate.sys_language_uid IN (-1,0)',
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

		'first_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.first_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'last_name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.last_name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'internal_identifier' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.internal_identifier',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'gender' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.gender',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'year_of_birth' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.year_of_birth',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'language' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.language',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'incumbent' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.incumbent',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'elected' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.elected',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'party' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.party',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_easyvotesmartvote_domain_model_party',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'district' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.district',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_easyvotesmartvote_domain_model_district',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'election' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.election',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_easyvotesmartvote_domain_model_election',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		
	),
);
