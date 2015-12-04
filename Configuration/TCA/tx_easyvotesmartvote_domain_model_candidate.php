<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TCA']['tx_easyvotesmartvote_domain_model_candidate'] = [
    'ctrl' => [
        'title' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate',
        'label' => 'last_name',
        'label_alt' => 'first_name, city, election_list_name',
        'label_alt_force' => TRUE,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',

        ],
        'thumbnail' => 'photo',
        'searchFields' => 'first_name,last_name,year_of_birth,city,district_name,party_short',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('easyvote_smartvote') . 'Resources/Public/Icons/tx_easyvotesmartvote_domain_model_candidate.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, first_name, last_name, internal_identifier, gender, year_of_birth, city, language, district_name, party_short, incumbent, elected, deselected, easyvote_supporter, polittalk_participant, civil_state_name, denomination_name, education_name, employment_name, occupation, number_of_children, hobbies, favorite_books, favorite_music, favorite_movies, link_to_smart_spider, link_to_portrait, link_to_facebook, link_to_twitter, link_to_politnetz, link_to_youtube, link_to_vimeo, email, why_me, slogan, personal_website, election_list_name, photo, photo_cached_remote_filesize, photos, ch2055, motivation, persona, links, answers, spider_values, coordinate, serialized_photos, serialized_links, serialized_answers, serialized_answers_processed, serialized_spider_values, serialized_coordinate, serialized_list_places, party, national_party, district, election, election_list, civil_state, denomination, education, '],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [

        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_easyvotesmartvote_domain_model_candidate',
                'foreign_table_where' => 'AND tx_easyvotesmartvote_domain_model_candidate.pid=###CURRENT_PID### AND tx_easyvotesmartvote_domain_model_candidate.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],

        'first_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.first_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'last_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.last_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'internal_identifier' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.internal_identifier',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'gender' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.gender',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'year_of_birth' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.year_of_birth',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'city' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.city',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'language' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.language',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'district_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.district_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'party_short' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.party_short',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'incumbent' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.incumbent',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'elected' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.elected',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'deselected' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.deselected',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'easyvote_supporter' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.easyvote_supporter',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'polittalk_participant' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.polittalk_participant',
            'config' => [
                'type' => 'check',
                'default' => 0
            ]
        ],
        'civil_state_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.civil_state_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'denomination_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.denomination_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'education_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.education_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'employment_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.employment_name',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'occupation' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.occupation',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'number_of_children' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.number_of_children',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'hobbies' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.hobbies',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'favorite_books' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.favorite_books',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'favorite_music' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.favorite_music',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'favorite_movies' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.favorite_movies',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'link_to_smart_spider' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.link_to_smart_spider',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'link_to_portrait' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.link_to_portrait',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'link_to_facebook' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.link_to_facebook',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'link_to_twitter' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.link_to_twitter',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'link_to_politnetz' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.link_to_politnetz',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'link_to_youtube' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.link_to_youtube',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'link_to_vimeo' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.link_to_vimeo',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'email' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'why_me' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.why_me',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'slogan' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.slogan',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'personal_website' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.personal_website',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'election_list_name' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.election_list_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'photos' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.photos',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'ch2055' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.ch2055',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'motivation' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.motivation',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'persona' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.persona',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'photo' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.photo',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('photo', [
                'appearance' => [
                    'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
                ],
                'foreign_match_fields' => [
                    'fieldname' => 'photo',
                    'tablenames' => 'tx_easyvotesmartvote_domain_model_candidate',
                    'table_local' => 'sys_file',
                ],
                'minitems' => 0,
                'maxitems' => 1,
            ], $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']),
        ],
        'photo_cached_remote_filesize' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.photo_cached_remote_filesize',
            'config' => [
                'type' => 'input',
                'eval' => 'int'
            ]
        ],
        'links' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.links',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'answers' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.answers',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'spider_values' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.spider_values',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'coordinate' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.coordinate',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int'
            ]
        ],
        'serialized_photos' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.serialized_photos',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'serialized_links' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.serialized_links',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'serialized_answers' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.serialized_answers',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'serialized_answers_processed' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.serialized_answers_processed',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'serialized_spider_values' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.serialized_spider_values',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'serialized_coordinate' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.serialized_coordinate',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'serialized_list_places' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.serialized_list_places',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim'
            ]
        ],
        'party' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.party',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_easyvotesmartvote_domain_model_party',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'national_party' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.national_party',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_easyvote_domain_model_party',
                'foreign_table_where' => 'AND tx_easyvote_domain_model_party.sys_language_uid IN (-1,0)',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'district' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.district',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_easyvotesmartvote_domain_model_district',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'election' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.election',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_easyvotesmartvote_domain_model_election',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'election_list' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.election_list',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_easyvotesmartvote_domain_model_electionlist',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'civil_state' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.civil_state',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_easyvotesmartvote_domain_model_civilstate',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'denomination' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.denomination',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_easyvotesmartvote_domain_model_denomination',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'education' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_db.xlf:tx_easyvotesmartvote_domain_model_candidate.education',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_easyvotesmartvote_domain_model_education',
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],

    ],
];
