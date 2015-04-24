<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Visol.easyvote_smartvote',
	'Pi1',
	array(
		'Question' => 'index',
	),
	// non-cacheable actions
	array(
		'Question' => 'index',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Visol.easyvote_smartvote',
	'Pi2',
	array(
		'SpiderChart' => 'index',
	),
	// non-cacheable actions
	array(
		'SpiderChart' => 'index', // @todo check if it can be removed
	)
);


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Visol.easyvote_smartvote',
	'Question',
	array(
		'QuestionApi' => 'list, show',
	),
	// non-cacheable actions
	array(
		'QuestionApi' => 'list, show',
	)
);

// Register cache
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_question'])) {
	$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['easyvote_question'] = array();
}

// Register the cache table to be deleted when general caches is hit.
$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearAllCache_additionalTables']['cf_easyvote_question'] = 'cf_easyvote_question';

// Register global route
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['routing']['globalRoutes'][] = 'EXT:easyvote_smartvote/Configuration/GlobalRoutes.yaml';


if (TYPO3_MODE === 'BE') {

	// Configure commands that can be run from the cli_dispatch.phpsh script.
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Visol\EasyvoteSmartvote\Command\SmartVoteCommandController';
}