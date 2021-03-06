<?php

/**
 * Extension Manager/Repository config file for ext "poptin_smart_popups_and_forms".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Poptin: Pop ups, Contact Forms & Exit Intent Popups',
    'description' => 'Use Poptin to create beautiful popups and inline forms for your website using our easy-to-use drag and drop editor (no coding skills required). With Poptin you can show your website\'s visitors the right message at the right time.Exit intent trigger is included in our free plan. You\'ll also get advanced triggers and targeting rules.',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'bootstrap_package' => '11.0.0-11.0.99',
             'typo3' => '9.5.0-10.4.99'
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'PoptinLtd\\PoptinSmartPopupsAndContactForms\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Gal Dubinski',
    'author_email' => 'contact@poptin.com',
    'author_company' => 'Poptin LTD',
    'version' => '1.0.2',
];
