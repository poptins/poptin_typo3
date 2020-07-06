<?php

return [
    'frontend' => [
        'PoptinSmartPopupsAndContactForms-frontend' => [
            'target' => \PoptinLtd\PoptinSmartPopupsAndContactForms\Middleware\AwesomeMiddleware::class,
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
        ]
    ]
];