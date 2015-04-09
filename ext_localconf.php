<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Configure commands that can be run from the cli_dispatch.phpsh script.
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] = 'Visol\EasyvoteSmartvote\Command\SmartVoteCommandController';