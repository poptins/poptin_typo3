<?php
defined('TYPO3_MODE') || die();

call_user_func(function()
{
    /**
     * Temporary variables
     */
    $extensionKey = 'poptin_smart_popups_and_contact_forms';

    /**
     * Default TypoScript for poptin_smart_popups_and_forms
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        $extensionKey,
        'Configuration/TypoScript',
        'Poptin: Pop ups, Contact Forms & Exit Intent Popups'
    );
});
