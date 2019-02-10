<?php

namespace App\Service;

use App\Service\Action\Auth\LoginAction;
use CakeDC\Api\Service\Service;

/**
 * Class AuthService
 *
 * @package CakeDC\Api\Service
 */
class AuthService extends Service
{

    /**
     * @inheritdoc
     * @return void
     */
    public function initialize()
    {
        $methods = ['method' => ['POST'], 'mapCors' => true];
        $this->mapAction('login', LoginAction::class, $methods);

        parent::initialize();
    }
}
