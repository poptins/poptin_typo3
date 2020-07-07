<?php
defined('TYPO3_MODE') || die();

call_user_func(function()
{
    /**
     * Temporary variables
     */
    $extensionKey = 'poptin_smart_popups_and_forms';

    /**
     * Default PageTS for PoptinSmartPopupsAndContactForms
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/Page/All.tsconfig',
        'Poptin: Pop ups, Contact Forms & Exit Intent Popups'
    );
});
