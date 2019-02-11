<?php

namespace App\Service;

use App\Service\Action\Auth\LoginAction;
use CakeDC\Api\Service\AuthService as ApiAuthService;

/**
 * Class AuthService
 *
 * @package CakeDC\Api\Service
 */
class AuthService extends ApiAuthService
{

    /**
     * @inheritdoc
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $methods = ['method' => ['POST'], 'mapCors' => true];
        $this->mapAction('login', LoginAction::class, $methods);
    }
}
