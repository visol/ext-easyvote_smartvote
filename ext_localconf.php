<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.easyvote_smartvote',
    'Pi1',
    array(
        'Question' => 'index',
        'SpiderChart' => 'index',
    ),
    // non-cacheable actions
    array(
        'Question' => 'index',
        'SpiderChart' => 'index', // @todo check if it can be removed
    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.easyvote_smartvote',
    'Pi2',
    array(
        'Candidate' => 'index, filter',
    ),
    // non-cacheable actions
    array(
        'Candidate' => 'index, filter',
    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.easyvote_smartvote',
    'Pi3',
    array(
        'Party' => 'index,',
    ),
    // non-cacheable actions
    array(
        'Party' => 'index',
    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.easyvote_smartvote',
    'Question',
    array(
        'QuestionApi' => 'list',
    ),
    // non-cacheable actions
    array(
        'QuestionApi' => 'list',
    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.easyvote_smartvote',
    'Candidate',
    array(
        'CandidateApi' => 'list',
        'Candidate' => 'permalink',
    ),
    // non-cacheable actions
    array(
        'CandidateApi' => 'list', // @todo check if it can be cached.
        'Candidate' => 'permalink',
    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.easyvote_smartvote',
    'Party',
    array(
        'PartyApi' => 'list',
    ),
    // non-cacheable actions
    array(
        'PartyApi' => 'list', // @todo check if it can be cached.
    )
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Visol.easyvote_smartvote',
    'State',
    array(
        'StateApi' => 'save',
    ),
    // non-cacheable actions
    array(
        'StateApi' => 'save',
    )
);

// Register global route
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['routing']['globalRoutes'][] = 'EXT:easyvote_smartvote/Configuration/GlobalRoutes.yaml';

// Register cache
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_smartvote'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_smartvote'] = array();
}

// Override default Frontend Cache to be String instead of Variable
if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['frontend'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['frontend'] = 'TYPO3\CMS\Core\Cache\Frontend\StringFrontend';
}

// Override default Backend Cache to be File instead of Database
if (!isset($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['backend'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['backend'] = 'TYPO3\\CMS\\Core\\Cache\\Backend\\FileBackend';
}

// Register the cache table to be deleted when general caches is hit.
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearAllCache_additionalTables']['cf_easyvote_smartvote'] = 'cf_easyvote_smartvote';


if (TYPO3_MODE === 'BE') {

    // Register Tasks
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Visol\EasyvoteSmartvote\Task\PurgeTask'] = [
        'extension' => 'easyvote_smartvote',
        'title' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_task.xlf:purge.name',
        'description' => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_task.xlf:purge.description',
        'additionalFields' => \Visol\EasyvoteSmartvote\Task\AdditionalFieldProvider::class,
    ];

    // Configure commands that can be run from the cli_dispatch.phpsh script.
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Visol\EasyvoteSmartvote\Command\SmartVoteCommandController';
}

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['votable']['rankCacheWhereClause'][] = \Visol\EasyvoteSmartvote\Hook\RankCacheWhereClause::class;
