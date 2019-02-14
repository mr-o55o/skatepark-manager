<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LessonStatuses Controller
 *
 * @property \App\Model\Table\LessonStatusesTable $LessonStatuses
 *
 * @method \App\Model\Entity\LessonStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LessonEditionStatusesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $lessonEditionStatuses = $this->paginate($this->LessonEditionStatuses);

        $this->set(compact('lessonEditionStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Lesson Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lessonEditionStatus = $this->LessonEditionStatuses->get($id, [
            'contain' => ['LessonEditions']
        ]);

        $this->set('lessonEditionStatus', $lessonStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lessonEditionStatus = $this->LessonEditionStatuses->newEntity();
        if ($this->request->is('post')) {
            $lessonEditionStatus = $this->LessonEditionStatuses->patchEntity($lessonEditionStatus, $this->request->getData());
            if ($this->LessonStatuses->save($lessonStatus)) {
                $this->Flash->success(__('The lesson edition status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson edition status could not be saved. Please, try again.'));
        }
        $this->set(compact('lessonEditionStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lessonEditionStatus = $this->LessonEditionStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lessonEditionStatus = $this->LessonEditionStatuses->patchEntity($lessonEditionStatus, $this->request->getData());
            if ($this->LessonStatuses->save($lessonStatus)) {
                $this->Flash->success(__('The lesson edition status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson edition status could not be saved. Please, try again.'));
        }
        $this->set(compact('lessonEdition Status'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lessonEditionStatus = $this->LessonEditionStatuses->get($id);
        if ($this->LessonEditionStatuses->delete($lessonEditionStatus)) {
            $this->Flash->success(__('The lesson edition status has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson edition status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    */
}
