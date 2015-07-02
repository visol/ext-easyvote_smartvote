<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (TYPO3_MODE === 'BE') {

	// Register plugins in the BE.
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		'easyvote_smartvote',
		'Pi1',
		'easyvote Smartvote: Questionnaire - voting advices'
	);
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
		'easyvote_smartvote',
		'Pi2',
		'easyvote Smartvote: Candidate directory'
	);

	// Flexform for pi1
	$TCA['tt_content']['types']['list']['subtypes_addlist']['easyvotesmartvote_pi1'] = 'pi_flexform';
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
		'easyvotesmartvote_pi1',
		'FILE:EXT:easyvote_smartvote/Configuration/FlexForm/question.xml'
	);

	// Flexform for pi2
	$TCA['tt_content']['types']['list']['subtypes_addlist']['easyvotesmartvote_pi2'] = 'pi_flexform';
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
		'easyvotesmartvote_pi2',
		'FILE:EXT:easyvote_smartvote/Configuration/FlexForm/candidate.xml'
	);

	// Register a few models on standard pages
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_candidate');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_party');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_district');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_election');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_education');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_civilstate');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_denomination');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_questioncategory');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_question');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_electionlist');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_link');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_answer');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_spidervalue');
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_coordinate');

	// @todo bug: Check order of loading. EXT:easyvote_smartvote has a dependency to easyvote but is loaded before nevertheless!?
	if (!isset($GLOBALS['TBE_MODULES']['easyvote'])) {
		$modules = array();
		foreach ($GLOBALS['TBE_MODULES'] as $key => $val) {
			if ($key == 'user') {
				$modules['easyvote'] = '';
			}
			$modules[$key] = $val;
		}
		$GLOBALS['TBE_MODULES'] = $modules;
		\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule(
			'easyvote',
			'',
			'',
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('easyvote') . 'mod/easyvote/');
	}

	$dataTypes = array(
		'tx_easyvotesmartvote_domain_model_election'
	);
	foreach ($dataTypes as $dataType) {

		/** @var \Fab\Vidi\Module\ModuleLoader $moduleLoader */
		$moduleLoader = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('Fab\Vidi\Module\ModuleLoader', $dataType);

		/** @var \Fab\Vidi\Module\ModuleLoader $moduleLoader */
		$moduleLoader->setIcon(sprintf('EXT:easyvote_smartvote/Resources/Public/Icons/%s.png', $dataType))
			->setMainModule('easyvote')
			->setModuleLanguageFile(sprintf('LLL:EXT:easyvote_smartvote/Resources/Private/Language/%s.xlf', $dataType))
			->addJavaScriptFile(sprintf('EXT:easyvote_smartvote/Resources/Public/JavaScript/%s.js', $dataType))
			->setDefaultPid(276) // hard-coded for now
			->register();
	}

	// Add new sprite icon.
	\TYPO3\CMS\Backend\Sprite\SpriteManager::addSingleIcons(
		array(
			'export' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('easyvote_smartvote') . 'Resources/Public/Icons/import.png',
		),
		'easyvote-smartvote'
	);

	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'easyvote_smartvote',
		'content', // Make media module a submodule of 'user'
		'm1',
		'bottom', // Position
		array(
			'Election' => 'import',
		),
		array(          // Additional configuration
			'access'    => 'user,group',
			'labels'    => 'LLL:EXT:easyvote_smartvote/Resources/Private/Language/locallang_mod.xlf',
		)
	);


	// Default User TSConfig to be added in any case.
	TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('

		# Hide the module in the BE.
		options.hideModules.content := addToList(EasyvoteSmartvoteM1)

	');
}


