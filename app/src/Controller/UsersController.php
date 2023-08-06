<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\Event;
use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{   
    public function beforeFilter(EventInterface $event)
    {
        $this->Authentication->allowUnauthenticated(['login', 'register']);

        parent::beforeFilter($event);
    }

    public function login()
    {
        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();

        // If the user is logged in send them away.
        if ($result->isValid()) {

            //send event to write last_login
           // $this->getEventManager()->dispatch(new Event('User.login', null, $this->Authentication->getIdentityData('id')));

            $target = $this->Authentication->getLoginRedirect() ?? '/';

            return $this->redirect($target);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Invalid username or password');
        }

        $this->render(null, 'login');
    }

    public function register()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Users->newEmptyEntity();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your registration was successful.'));

                return $this->redirect('/');
            }

            var_dump($this->Users->save($user));

            $this->Flash->error(__('Your registration failed.'));
        }

        $this->render(null, 'register');
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $this->Authentication->logout();
        return $this->redirect('/');
    }
}
