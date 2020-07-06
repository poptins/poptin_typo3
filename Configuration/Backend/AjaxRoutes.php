<?php

/*
 * This file is part of the package t3g/blog.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

return [
    // Save images
    'login-user' => [
        'path' => '/ext/PoptinSmartPopupsAndContactForms/login',
        'target' => \PoptinLtd\PoptinSmartPopupsAndContactForms\Controller\PostController::class . '::loginAction'
    ],
    'register-user' => [
        'path' => '/ext/PoptinSmartPopupsAndContactForms/register',
        'target' => \PoptinLtd\PoptinSmartPopupsAndContactForms\Controller\PostController::class . '::registerAction'
    ],
    'update-token' => [
        'path' => '/ext/PoptinSmartPopupsAndContactForms/updateToken',
        'target' => \PoptinLtd\PoptinSmartPopupsAndContactForms\Controller\PostController::class . '::updateTokenAction'
    ],
    'logout-user' => [
        'path' => '/ext/PoptinSmartPopupsAndContactForms/logoutuser',
        'target' => \PoptinLtd\PoptinSmartPopupsAndContactForms\Controller\PostController::class . '::logoutAction'
    ],
];
