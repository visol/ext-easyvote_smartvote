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
	),
	// non-cacheable actions
	array(
		'CandidateApi' => 'list', // @todo check if it can be cached.
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
if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['frontend'])) {
	$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['frontend'] = 'TYPO3\CMS\Core\Cache\Frontend\StringFrontend';
}

// Override default Backend Cache to be File instead of Database
if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['backend'])) {
	$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['easyvote_smartvote']['backend'] = 'TYPO3\\CMS\\Core\\Cache\\Backend\\FileBackend';
}

// Register the cache table to be deleted when general caches is hit.
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearAllCache_additionalTables']['cf_easyvote_smartvote'] = 'cf_easyvote_smartvote';


if (TYPO3_MODE === 'BE') {

	// Configure commands that can be run from the cli_dispatch.phpsh script.
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Visol\EasyvoteSmartvote\Command\SmartVoteCommandController';
}