<?php
/**
 * Copyright 2016 - 2017, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2016 - 2017, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

return [
    'Api' => [
        // if service class is not defined we use crud fallback service
        'ServiceFallback' => '\\CakeDC\\Api\\Service\\FallbackService',
        // response rendered as JSend
        'renderer' => 'CakeDC/Api.JSend',
        // Data parse from cakephp request object
        'parser' => 'CakeDC/Api.Form',

        //routes inflector: specify underscore, dasherize, or false for neither/no inflection
        'routesInflectorMethod' => false,

        // version is not used
        'useVersioning' => false,
        'versionPrefix' => 'v',

        // auth permission uses require auth strategy
        'Auth' => [
            'Crud' => [
                'default' => 'auth'
            ],
        ],

        'Service' => [
            'default' => [
                'options' => [],
                'Action' => [
                    'default' => [
                        //auth configuration
                        'Auth' => [
                            'storage' => 'Memory',
                            'authorize' => [
                                'CakeDC/Api.SimpleRbac'
                            ],
                            'authenticate' => [
                                'CakeDC/Api.Jwt' => [
                                    'userModel' => 'CakeDC/Users.Users',
                                    'fields' => [
                                        'username' => 'id'
                                    ],

                                    'parameter' => 'token',
                                    'queryDatasource' => true,
                                ],
                            ],
                            'unauthorizedRedirect' => false,
                            'checkAuthIn' => 'Controller.initialize',
                        ],
                        // default app extensions
                        'Extension' => [
                            // allow request from other domains
                            'CakeDC/Api.Cors',
                            // enable sort
                            'CakeDC/Api.Sort',
                            // load Hateoas
                            'CakeDC/Api.CrudHateoas',
                            // enable relations
                            'CakeDC/Api.CrudRelations',
                        ]
                    ],
                    // all index actions configuration
                    'Index' => [
                        'Extension' => [
                            // enable pagination for index actions
                            'CakeDC/Api.Paginate',
                        ],
                    ],
                ],
            ],
        ],
        'Log' => [
            'className' => 'File',
            'scopes' => ['api'],
            'levels' => ['error', 'info'],
            'file' => 'api.log',
        ]
    ]
];
