<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

if (TYPO3_MODE === 'BE') {

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('easyvote_smartvote', 'Configuration/TypoScript', 'Easyvote Smartvote');

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
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_easyvotesmartvote_domain_model_photo');
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

		/** @var \TYPO3\CMS\Vidi\Module\ModuleLoader $moduleLoader */
		$moduleLoader = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Vidi\Module\ModuleLoader', $dataType);

		/** @var \TYPO3\CMS\Vidi\Module\ModuleLoader $moduleLoader */
		$moduleLoader->setIcon(sprintf('EXT:easyvote_smartvote/Resources/Public/Icons/%s.png', $dataType))
			->setMainModule('easyvote')
			->setModuleLanguageFile(sprintf('LLL:EXT:easyvote_smartvote/Resources/Private/Language/%s.xlf', $dataType))
			->addJavaScriptFiles(array(sprintf('EXT:easyvote_smartvote/Resources/Public/JavaScript/%s.js', $dataType)))
			->setDefaultPid(276) // hard-coded for now
			->register();
	}

}