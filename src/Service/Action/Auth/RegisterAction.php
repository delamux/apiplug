<?php
namespace App\Service\Action\Auth;

use CakeDC\Api\Exception\ValidationException;
use CakeDC\Api\Service\Action\Auth\RegisterAction as ApiRegister;
use CakeDC\Users\Controller\Component\UsersAuthComponent;
use Cake\Core\Configure;
use Cake\Datasource\EntityInterface;
use Cake\Utility\Security;
use Firebase\JWT\JWT;

class RegisterAction extends ApiRegister
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $usersTable = $this->getUsersTable();
        $user = $usersTable->newEntity();
        $options = $this->_registerOptions();
        $requestData = $this->getData();
        $event = $this->dispatchEvent(UsersAuthComponent::EVENT_BEFORE_REGISTER, [
            'usersTable' => $usersTable,
            'options' => $options,
            'userEntity' => $user,
        ]);

        if ($event->result instanceof EntityInterface) {
            if ($userSaved = $usersTable->register($user, $event->result->toArray(), $options)) {
                return $this->_afterRegister($userSaved);
            }
        }
        if ($event->isStopped()) {
            return false;
        }
        $userSaved = $usersTable->register($user, $requestData, $options);
        if (!$userSaved) {
            throw new ValidationException(__d('CakeDC/Api', 'The user could not be saved'), 0, null, $user->getErrors());
        }

        return $this->_afterRegister($userSaved);
    }

    /**
     * Prepare flash messages after registration, and dispatch afterRegister event
     *
     * @param EntityInterface $userSaved User entity saved
     * @return EntityInterface
     */
    protected function _afterRegister(EntityInterface $userSaved)
    {
        $validateEmail = (bool)Configure::read('Users.Email.validate');
        $message = __d('CakeDC/Api', 'You have registered successfully, please log in');
        if ($validateEmail) {
            $message = __d('CakeDC/Api', 'Please validate your account before log in');
        }
        $event = $this->dispatchEvent(UsersAuthComponent::EVENT_AFTER_REGISTER, [
            'user' => $userSaved
        ]);
        if ($event->result instanceof EntityInterface) {
            $userSaved = $event->result;
        }

        $event = $this->dispatchEvent('Action.Auth.onRegisterFormat', ['user' => $userSaved]);
        if ($event->result) {
            $userSaved = $event->result;
        }

        $result = [
            'message' => $message,
            'success' => true,
            'data' => [
                'token' => JWT::encode(
                    [
                        'username' => $userSaved['username'],
                        'email' => $userSaved['email'],
                        'name' => $userSaved['first_name'],
                        'sub' => $userSaved['id'],
                        'exp' => time() + Configure::read('Users.Token.expiration')
                    ],
                    Security::getSalt()
                )
            ],
            '_serialize' => ['message', 'success', 'data']
        ];

        return $result;
    }
}
