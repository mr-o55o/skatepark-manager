<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ResponsiblePersons Controller
 *
 * @property \App\Model\Table\ResponsiblePersonsTable $ResponsiblePersons
 *
 * @method \App\Model\Entity\ResponsiblePerson[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ResponsiblePersonsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public $paginate = [
        'limit' => 25,
        'order' => [ 'ResponsiblePersons.surname' => 'asc']
    ];

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index']
        ]);
    }

    public function index()
    {
        $query = $this->ResponsiblePersons->find('search', ['search' => $this->request->getQueryParams()]);
        $this->set('responsiblePersons', $this->paginate($query));
    }

    /**
     * View method
     *
     * @param string|null $id Responsible Person id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $responsiblePerson = $this->ResponsiblePersons->get($id, [
            'contain' => ['Athletes']
        ]);

        $this->set('responsiblePerson', $responsiblePerson);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $responsiblePerson = $this->ResponsiblePersons->newEntity();
        if ($this->request->is('post')) {
            $responsiblePerson = $this->ResponsiblePersons->patchEntity($responsiblePerson, $this->request->getData());
            if ($this->ResponsiblePersons->save($responsiblePerson)) {
                $this->Flash->success(__('The responsible person has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The responsible person could not be saved. Please, try again.'));
        }
        $this->set(compact('responsiblePerson'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Responsible Person id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $responsiblePerson = $this->ResponsiblePersons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $responsiblePerson = $this->ResponsiblePersons->patchEntity($responsiblePerson, $this->request->getData());
            if ($this->ResponsiblePersons->save($responsiblePerson)) {
                $this->Flash->success(__('The responsible person has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The responsible person could not be saved. Please, try again.'));
            $this->set('errors', $responsiblePerson->errors());
            
        }
        $this->set(compact('responsiblePerson'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Responsible Person id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $responsiblePerson = $this->ResponsiblePersons->get($id);
        if ($this->ResponsiblePersons->delete($responsiblePerson)) {
            $this->Flash->success(__('The responsible person has been deleted.'));
        } else {
            $this->Flash->error(__('The responsible person could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    */

    /**
     * AjaxSearch method
     *
     * @return \Cake\Http\Response|void
     */
    public function ajaxSearch()
    {

        $responsible_persons = $this->ResponsiblePersons->find('bySurname', ['search' => $this->request->getQuery('surname')]);

        $this->set(compact('responsible_persons')); // Pass $data to the view
        $this->set('_jsonOptions', JSON_FORCE_OBJECT);
        $this->set('_serialize', ['responsible_persons']);
    }
}
