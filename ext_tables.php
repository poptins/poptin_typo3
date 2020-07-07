<?php
defined('TYPO3_MODE') || die();

(function(){
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
       'PoptinLtd.PoptinSmartPopupsAndContactForms', // Vendor dot Extension Name in CamelCase
       'web', // the main module
       'PoptinSmartPopupsAndContactForms', // Submodule key
       'bottom', // Position
       [
           'Post' => 'posts',
       ],
       [
           'access' => 'admin',
           'icon'   => 'EXT:poptin_smart_popups_and_forms/Resources/Public/Icons/favicon.png',
           'labels' => 'Poptin Popups and Forms',
            'navigationComponentId' => '', 
            'inheritNavigationComponentFromMainModule' => false
       ]
    );
    
})();
