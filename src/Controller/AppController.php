<?php
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
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Database\Type;


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $components = [
        'Acl' => [
            'className' => 'Acl.Acl'
        ]
    ];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('LoggedUser');
        //$this->loadComponent( 'Wizard' );

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        $this->loadComponent('Security');

        // Auth Component
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'finder' => 'active',
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
             //use Acl authorization
            'authorize' => [
                'Acl.Actions' => ['actionPath' => 'controllers/']
            ],
             // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => $this->referer(),
        ]);

        // Allow the display action so our PagesController
        // continues to work. Also enable the read only actions.
        $this->Auth->allow(['display']);

        // Set Layout and user view var if a user is logged in
        if ($this->Auth->user('username'))
        {
            $this->layout = Configure::read('private-layout');
            $this->LoggedUser->setLoggedUser($this->Auth->user());

            //$this->set('MainNav', $this->mainNavAclControllerFilter($this->Auth->user('id')));
        } else {
            $this->layout = 'default';
            $this->set('loggedUser', null);
        }
        
        // Enable default locale format parsing.
        Type::build('datetime')->useLocaleParser();
        //Type::build('number')->useLocaleParser();



    }

    //filter the controller array read from config by role
    private function mainNavAclControllerFilter($userId) 
    {
        $controllers = Configure::read('main_nav')['topics'];
        debug($controllers);
        foreach ($controllers as $controller) {
            debug($controller);
            /*if (!$this->Acl->check($userId, $controller)) {
                
                //unset($controllers[$controller]);
            }*/
        }
        return $controllers;
    }

}
