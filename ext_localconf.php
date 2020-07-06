<?php
defined('TYPO3_MODE') || die();

/***************
 * Add default RTE configuration
 */
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['poptin_smart_popups_and_forms'] = 'EXT:poptin_smart_popups_and_forms/Configuration/RTE/Default.yaml';



$signalSlotDispatcher = TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
$signalSlotDispatcher->connect(
        \TYPO3\CMS\Extensionmanager\Utility\InstallUtility::class,  // Signal class name   
        'afterExtensionUninstall',
        \PoptinLtd\PoptinSmartPopupsAndContactForms\Hooks\AppMethods::class,
        'removeApp'
);

$signalSlotDispatcher->connect(
        \TYPO3\CMS\Extensionmanager\Utility\InstallUtility::class,  // Signal class name   
        'afterExtensionInstall',
        \PoptinLtd\PoptinSmartPopupsAndContactForms\Hooks\AppMethods::class,
        'addApp'
);