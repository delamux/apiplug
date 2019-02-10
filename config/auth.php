<?php

/**
 * Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
use Cake\Core\Configure;
use Cake\Routing\Router;

$config = [
    'Auth' => [
        'authorize' => [
            'CakeDC/Auth.SimpleRbac' => [
                // autoload permissions.php
                'autoload_config' => 'permissions',
                // role field in the Users table
                'role_field' => 'role',
                // default role, used in new users registered and also as role matcher when no role is available
                'default_role' => 'user',
                /*
                 * This is a quick roles-permissions implementation
                 * Rules are evaluated top-down, first matching rule will apply
                 * Each line define
                 *      [
                 *          'role' => 'admin',
                 *          'plugin', (optional, default = null)
                 *          'prefix', (optional, default = null)
                 *          'extension', (optional, default = null)
                 *          'controller',
                 *          'action',
                 *          'allowed' (optional, default = true)
                 *      ]
                 * You could use '*' to match anything
                 * Suggestion: put your rules into a specific config file
                 */
                'permissions' => [], // you could set an array of permissions or load them using a file 'autoload_config'
                // log will default to the 'debug' value, matched rbac rules will be logged in debug.log by default when debug enabled
                'log' => false
            ]
        ],
    ]
];

return $config;
