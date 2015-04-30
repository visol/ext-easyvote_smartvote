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


if (TYPO3_MODE === 'BE') {

	// Configure commands that can be run from the cli_dispatch.phpsh script.
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Visol\EasyvoteSmartvote\Command\SmartVoteCommandController';
}