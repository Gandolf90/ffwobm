<?php

namespace App\Authentication\Event;

use Cake\Event\EventListenerInterface;
use Cake\I18n\FrozenTime;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\ORM\TableRegistry;
use Authentication\Authenticator\FormAuthenticator;

use Cake\Log\Log;

class LoginListener implements EventListenerInterface
{
    public function implementedEvents(): array
    {
        return [
            'User.login' => 'onAuthenticationSuccess'
        ];
    }

    public function onAuthenticationSuccess($event, $userId): ?EntityInterface
    {
        Log::debug('LoginListener onAuthenticationSuccess called.');

        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $user = $usersTable->get($userId);
        $user->last_login = new FrozenTime();

        try {
            $usersTable->save($user);
        } catch (RecordNotFoundException $exception) {
            // do nothing
        }

        return null;
    }
}