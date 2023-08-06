<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Authorization.Authorization');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeFilter(EventInterface $event) {
        // Allow actions without authentication
        //$this->Authentication->allowUnauthenticated($this->_allowUnauthenticated);

        // Automically skip authorization on actions allowed without authentication
        //$this->_skipAuthorization = array_merge($this->_skipAuthorization, $this->_allowUnauthenticated);

        // Skip authorization on allowed actions
        //if (in_array($this->request->getParam('action'), $this->_skipAuthorization)) {
        //    $this->Authorization->skipAuthorization();
        //}

        // Refresh identity data on each request
        //$this->_refreshIdentity();
    }

    /*public function isAuthorized($user): bool
    {
        if ($user) {
            // Only admins can access admin menu
            if ($this->getRequest()->getParam('prefix') === 'Admin') {
                return $user->is_admin_user;
            }

            // Only active user accounts are allowed
            //if ($user->is_active) {
            //    return true;
            //}
            return true;
        }

        // Default deny
        return false;
    }*/
}
