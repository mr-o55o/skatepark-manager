<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public $mainMenuActions = [
            [
                'controller' => 'Users', 
                'action' => 'index'
            ],
            [
                'controller' => 'Users',
                'action' => 'add'
            ],
            [
                'controller' => 'Roles',
                'action' => 'index'
            ]
    ];

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['logout']);
        $this->loadComponent('RequestHandler');

        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index']
        ]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $query = $this->Users->find('search', ['search' => $this->request->getQueryParams()]);
        $this->set('users', $this->paginate($query));
    }

    /**
     * IndexMembers method
     *
     * @return \Cake\Http\Response|void
     */
    public function indexMembers()
    {
        $this->paginate = [
            'finder' => 'Members',
            //'contain' => ['Roles']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * IndexStaff method
     *
     * @return \Cake\Http\Response|void
     */
    public function indexStaff()
    {
        $this->paginate = [
            'finder' => 'Staff',
            //'contain' => ['Roles']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * IndexTrainers method
     *
     * @return \Cake\Http\Response|void
     */
    public function indexTrainers()
    {
        $this->paginate = [
            'finder' => 'Trainers',
            //'contain' => ['Roles']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * AjaxSearch method
     *
     * @return \Cake\Http\Response|void
     */
    public function ajaxSearch()
    {
        $role = $this->request->getQuery('role');
        $users = $this->Users->find($role)->find('byUsername', ['username' => $this->request->getQuery('username')]);

        $this->set(compact('users')); // Pass $data to the view
        $this->set('_jsonOptions', JSON_FORCE_OBJECT);
        $this->set('_serialize', ['users']);
        //$this->response->withStringBody(json_encode($jsonResponse));
    }


    /**
     * AjaxSearch method
     *
     * @return \Cake\Http\Response|void
     */
    public function ajaxSearchTrainer()
    {

        $users = $this->Users->find('trainers')->find('byUsername', ['username' => $this->request->getQuery('username')]);

        $this->set(compact('users')); // Pass $data to the view
        $this->set('_jsonOptions', JSON_FORCE_OBJECT);
        $this->set('_serialize', ['users']);
        //$this->response->withStringBody(json_encode($jsonResponse));
    }   

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [
                'Roles', 
                'BookedLessonEditions' => function ($q) {
                    return $q->order(['Events.start_date'=>'ASC']);
                }, 
                'BookedLessonEditions.Events', 
                'BookedLessonEditions.Lessons'
            ]
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles'));
    }

    /**
     * Activate method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function activate($id = null)
    {
        $this->request->allowMethod(['post']);
        $user = $this->Users->get($id);
        if (!$user->active) {
            $user->active = true;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('User has been activated.'));
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error('Error detected during user activation.'); 
        } else {
            $this->Flash->error('User is already active.');
        }
        return $this->redirect(['action' => 'view', $id]);
    }

    /**
     * Deactivate method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function deactivate($id = null)
    {
        $this->request->allowMethod(['post']);
        $user = $this->Users->get($id);
        if ($user->active) {
            $user->active = false;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('User has been deactivated.'));
                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error('Error detected during user activation.'); 
        } else {
            $this->Flash->error('User is already deactivated.');
        }
        return $this->redirect(['action' => 'view', $id]);
    }

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl(['controller' => 'Pages', 'action' => 'welcome']));
            }
            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout()
    {
    $this->Flash->success('You are now logged out.');
    $this->Auth->setUser(null);
    return $this->redirect($this->Auth->logout());
    }

    public function sendCredentials()
    {

    }
}
