<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_election'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_election',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'default_sortby' => 'ORDER BY election_date DESC',
        'searchFields' => 'smart_vote_identifier,title,',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('easyvote_smartvote') . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_election.png'
    ],
    'types' => [
        '1' => ['showitem' => 'hidden;;1, title, short_title, smart_vote_identifier, election_date, related_election, scope, import_log'],
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
        'title' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, required'
            ],
        ],
        'short_title' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:short_title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'election_date' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:election_date',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'date'
            ],
        ],
        'smart_vote_identifier' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:smart_vote_identifier',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'import_log' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:import_log',
            'config' => [
                'type' => 'text',
                'rows' => 10,
                'cols' => 5,
            ],
        ],
        'scope' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:scope',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:scope.1', \Visol\EasyvoteSmartvote\Domain\Model\Election::SCOPE_NATIONAL],
                    ['LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:scope.2', \Visol\EasyvoteSmartvote\Domain\Model\Election::SCOPE_EXECUTIVE_CANTONAL],
                    ['LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:scope.3', \Visol\EasyvoteSmartvote\Domain\Model\Election::SCOPE_LEGISLATIVE_CANTONAL],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => 'required'
            ],
        ],
        'total_cleavage1' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage1',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'total_cleavage2' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage2',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'total_cleavage3' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage3',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'total_cleavage4' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage4',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'total_cleavage5' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage5',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'total_cleavage6' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage6',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'total_cleavage7' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage7',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'total_cleavage8' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage8',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'total_cleavage_short1' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage_short1',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'total_cleavage_short2' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage_short2',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'total_cleavage_short3' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage_short3',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'total_cleavage_short4' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage_short4',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'total_cleavage_short5' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage_short5',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'total_cleavage_short6' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage_short6',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'total_cleavage_short7' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage_short7',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'total_cleavage_short8' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:total_cleavage_short8',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'int'
            ],
        ],
        'related_election' => [
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/tx_easyvotesmartvote_domain_model_election.xlf:related_election',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_easyvotesmartvote_domain_model_election',
                'items' => [
                    ['', 0],
                ],
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
    ],
    'grid' => [
        'columns' => [
            '__checkbox' => [
                'renderer' => new Fab\Vidi\Grid\CheckBoxComponent(),
            ],
            'uid' => [
                'visible' => FALSE,
                'label' => 'Id',
                'width' => '5px',
            ],
            'title' => [
                'editable' => true,
            ],
            'election_date' => [
                'editable' => FALSE,
                'format' => 'Fab\Vidi\Formatter\Date',
            ],
            'smart_vote_identifier' => [
                'editable' => true,
            ],
            'scope' => [
                'visible' => true,
            ],
            '__import_wizard' => [
                'renderer' => new Visol\EasyvoteSmartvote\Grid\ImportWizardColumn(),
            ],
            'import_log' => [
                'renderer' => new Visol\EasyvoteSmartvote\Grid\ImportLogColumn(),
            ],
            '__buttons' => [
                'renderer' => new Fab\Vidi\Grid\ButtonGroupComponent(),
            ],
        ],
    ]
];
