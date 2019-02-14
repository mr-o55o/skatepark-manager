<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LessonEditionsBundles Controller
 *
 * @property \App\Model\Table\LessonEditionsBundlesTable $LessonEditionsBundles
 *
 * @method \App\Model\Entity\LessonEditionsBundle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LessonEditionsBundlesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $lessonEditionsBundles = $this->paginate($this->LessonEditionsBundles, ['contain' => 'Lessons']);

        $this->set(compact('lessonEditionsBundles'));
    }

    /**
     * View method
     *
     * @param string|null $id Lesson Editions Bundle id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lessonEditionsBundle = $this->LessonEditionsBundles->get($id, [
            'contain' => ['Lessons', 'PurchasedLessonEditionsBundles']
        ]);

        $this->set('lessonEditionsBundle', $lessonEditionsBundle);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lessonEditionsBundle = $this->LessonEditionsBundles->newEntity();
        if ($this->request->is('post')) {
            $lessonEditionsBundle = $this->LessonEditionsBundles->patchEntity($lessonEditionsBundle, $this->request->getData());
            if ($this->LessonEditionsBundles->save($lessonEditionsBundle)) {
                $this->Flash->success(__('The lesson editions bundle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson editions bundle could not be saved. Please, try again.'));
        }
        $lessons = $this->LessonEditionsBundles->Lessons->find('active')->find('list', ['limit' => 200]);
        $this->set('lessons', $lessons);        
        $this->set(compact('lessonEditionsBundle'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson Editions Bundle id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lessonEditionsBundle = $this->LessonEditionsBundles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lessonEditionsBundle = $this->LessonEditionsBundles->patchEntity($lessonEditionsBundle, $this->request->getData());
            if ($this->LessonEditionsBundles->save($lessonEditionsBundle)) {
                $this->Flash->success(__('The lesson editions bundle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson editions bundle could not be saved. Please, try again.'));
        }
        $this->set(compact('lessonEditionsBundle'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson Editions Bundle id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lessonEditionsBundle = $this->LessonEditionsBundles->get($id);
        if ($this->LessonEditionsBundles->delete($lessonEditionsBundle)) {
            $this->Flash->success(__('The lesson editions bundle has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson editions bundle could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
