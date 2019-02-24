<?php
namespace App\Service\Action\Auth;

use Cake\Core\Configure;
use Cake\Utility\Security;
use CakeDC\Api\Service\Action\Auth\LoginAction as ApiLogin;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use CakeDC\Users\Exception\UserNotFoundException;
use Firebase\JWT\JWT;

class LoginAction extends ApiLogin
{
    /**
     * Login JWT action rewrite
     *
     * @return mixed|void
     */
    public function execute()
    {
        $socialLogin = false;
        $event = $this->dispatchEvent(UsersAuthComponent::EVENT_BEFORE_LOGIN);
        if (is_array($event->result)) {
            $user = $this->_afterIdentifyUser($event->result);
        } else {
            $user = $this->Auth->identify();
            $user = $this->_afterIdentifyUser($user, $socialLogin);
        }
        if (empty($user)) {
            throw new UserNotFoundException(__d('CakeDC/Api', 'User not found'), 401);
        }

        $result = [
            'success' => true,
            'data' => [
                'token' => JWT::encode(
                    [
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'name' => $user['first_name'],
                        'sub' => $user['id'],
                        'exp' => time() + Configure::read('Users.Token.expiration')
                    ],
                    Security::getSalt()
                )
            ],
            '_serialize' => ['success', 'data']
        ];

        return $result;
    }

}
