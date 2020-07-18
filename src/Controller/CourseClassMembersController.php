<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CourseClassMembers Controller
 *
 * @property \App\Model\Table\CourseClassMembersTable $CourseClassMembers
 *
 * @method \App\Model\Entity\CourseClassMember[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CourseClassMembersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CourseSubscriptions', 'CourseClasses']
        ];
        $courseClassMembers = $this->paginate($this->CourseClassMembers);

        $this->set(compact('courseClassMembers'));
    }

    /**
     * View method
     *
     * @param string|null $id Course Class Member id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $courseClassMember = $this->CourseClassMembers->get($id, [
            'contain' => ['CourseSubscriptions', 'CourseClasses']
        ]);

        $this->set('courseClassMember', $courseClassMember);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() 
    {
        $this->request->allowMethod(['post']);
        $courseClassMember = $this->CourseClassMembers->patchEntity($this->request->getData());
        
    }
    /*
    public function add()
    {
        $courseClassMember = $this->CourseClassMembers->newEntity();
        if ($this->request->is('post')) {
            $courseClassMember = $this->CourseClassMembers->patchEntity($courseClassMember, $this->request->getData());
            if ($this->CourseClassMembers->save($courseClassMember)) {
                $this->Flash->success(__('The course class member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course class member could not be saved. Please, try again.'));
        }
        $courseSubscriptions = $this->CourseClassMembers->CourseSubscriptions->find('list', ['limit' => 200]);
        $courseClasses = $this->CourseClassMembers->CourseClasses->find('list', ['limit' => 200]);
        $this->set(compact('courseClassMember', 'courseSubscriptions', 'courseClasses'));
    }
    */

    /**
     * Edit method
     *
     * @param string|null $id Course Class Member id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $courseClassMember = $this->CourseClassMembers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $courseClassMember = $this->CourseClassMembers->patchEntity($courseClassMember, $this->request->getData());
            if ($this->CourseClassMembers->save($courseClassMember)) {
                $this->Flash->success(__('The course class member has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course class member could not be saved. Please, try again.'));
        }
        $courseSubscriptions = $this->CourseClassMembers->CourseSubscriptions->find('list', ['limit' => 200]);
        $courseClasses = $this->CourseClassMembers->CourseClasses->find('list', ['limit' => 200]);
        $this->set(compact('courseClassMember', 'courseSubscriptions', 'courseClasses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Course Class Member id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $courseClassMember = $this->CourseClassMembers->get($id);
        if ($this->CourseClassMembers->delete($courseClassMember)) {
            $this->Flash->success(__('The course class member has been deleted.'));
        } else {
            $this->Flash->error(__('The course class member could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
