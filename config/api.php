<?php

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
                                'Jwt' => [
                                    'userModel' => 'CakeDC/Users.Users',
                                    'require_ssl' => false,
                                ],
                            ],
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
