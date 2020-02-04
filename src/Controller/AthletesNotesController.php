<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AthletesNotes Controller
 *
 * @property \App\Model\Table\AthletesNotesTable $AthletesNotes
 *
 * @method \App\Model\Entity\AthletesNote[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AthletesNotesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Athletes', 'Users']
        ];
        $athletesNotes = $this->paginate($this->AthletesNotes);

        $this->set(compact('athletesNotes'));
    }

    /**
     * View method
     *
     * @param string|null $id Athletes Note id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $athletesNote = $this->AthletesNotes->get($id, [
            'contain' => ['Athletes', 'Users']
        ]);

        $this->set('athletesNote', $athletesNote);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $athletesNote = $this->AthletesNotes->newEntity();
        $athletesNote->user_id = $this->Auth->user('id');
        $athleteNotes = $this->AthletesNotes->find('all', ['contain' => ['Users', 'Athletes']])->where(['athlete_id' => $this->request->getQuery('athlete_id')])->order(['AthletesNotes.created' => 'DESC']);

        if ($this->request->getQuery('athlete_id')) {
            $athletesNote->athlete_id = $this->request->getQuery('athlete_id');
            $this->set('athlete_selected', true);
        }
        if ($this->request->is('post')) {
            $athletesNote = $this->AthletesNotes->patchEntity($athletesNote, $this->request->getData());
            if ($this->AthletesNotes->save($athletesNote)) {
                $this->Flash->success(__('Appunto per l\'atleta registrato.'));

                return $this->redirect(['controller' => 'Athletes', 'action' => 'view', $this->request->getQuery('athlete_id')]);
            }
            $this->Flash->error(__('Errore durante il salvataggio dell\'appunto.'));
        }
        $athletes = $this->AthletesNotes->Athletes->find('list', ['limit' => 200]);
        $users = $this->AthletesNotes->Users->find('list', ['limit' => 200]);
        $this->set(compact('athletesNote','athleteNotes', 'athletes', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Athletes Note id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $athletesNote = $this->AthletesNotes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $athletesNote = $this->AthletesNotes->patchEntity($athletesNote, $this->request->getData());
            if ($this->AthletesNotes->save($athletesNote)) {
                $this->Flash->success(__('The athletes note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The athletes note could not be saved. Please, try again.'));
        }
        $athletes = $this->AthletesNotes->Athletes->find('list', ['limit' => 200]);
        $users = $this->AthletesNotes->Users->find('list', ['limit' => 200]);
        $this->set(compact('athletesNote', 'athletes', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Athletes Note id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $athletesNote = $this->AthletesNotes->get($id);
        if ($this->AthletesNotes->delete($athletesNote)) {
            $this->Flash->success(__('Appunto cancellato.'));
        } else {
            $this->Flash->error(__('Errore durante la cancellazione dell\'appunto.'));
        }

        return $this->redirect(['controller' => 'Athletes' ,'action' => 'view', $athletesNote->athlete_id]);
    }
}
