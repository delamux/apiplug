<?php

return [
    [
        'role' => 'admin',
        'prefix' => '*',
        'extension' => '*',
        'plugin' => '*',
        'controller' => '*',
        'action' => '*',
    ],
    //specific actions allowed for the all roles in Users plugin
    [
        'role' => '*',
        'plugin' => 'CakeDC/Users',
        'controller' => 'Users',
        'action' => ['profile', 'logout', 'linkSocial', 'callbackLinkSocial'],
    ],
    //all roles allowed to Pages/display
    [
        'role' => '*',
        'controller' => 'Pages',
        'action' => 'display',
    ],
];
