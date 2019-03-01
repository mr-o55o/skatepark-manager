<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchasedLessonEditionsBundles Controller
 *
 * @property \App\Model\Table\PurchasedLessonEditionsBundlesTable $PurchasedLessonEditionsBundles
 *
 * @method \App\Model\Entity\PurchasedLessonEditionsBundle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchasedLessonEditionsBundlesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Athletes', 'LessonEditionsBundles']
        ];
        //$purchasedLessonEditionsBundles = $this->paginate($this->PurchasedLessonEditionsBundles);
        $query = $this->PurchasedLessonEditionsBundles->find('search', ['search' => $this->request->getQueryParams()]);
        $this->set('purchasedLessonEditionsBundles', $this->paginate($query));
    }

    /**
     * buyFor method
     *
     * @param string|null $id Purchased Lesson Editions Bundle id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function buyFor($athlete_id = null)
    {
        $purchasedLessonEditionsBundle = $this->PurchasedLessonEditionsBundles->newEntity();
        $athlete = $this->PurchasedLessonEditionsBundles->Athletes->get($athlete_id);

        
        if ($this->request->is('post')) {
            $purchasedLessonEditionsBundle = $this->PurchasedLessonEditionsBundles->patchEntity($purchasedLessonEditionsBundle, $this->request->getData());
            $purchasedLessonEditionsBundle->athlete_id = $athlete->id;
            $purchasedLessonEditionsBundle->is_activated = false;
            $bundle = $this->PurchasedLessonEditionsBundles->LessonEditionsBundles->get($purchasedLessonEditionsBundle->lesson_editions_bundle_id);
            //set count with bundle type value
            $purchasedLessonEditionsBundle->count = $bundle->lesson_edition_count;
            //set status to 'purchaed'
            $purchasedLessonEditionsBundle->status = Configure::read('purchased_lesson_editions_bundle_statuses')['purchased'];
            if ($this->PurchasedLessonEditionsBundles->save($purchasedLessonEditionsBundle)) {
                $this->Flash->success('Lesson Edition Bundle assigned to athlete {0}', $athlete_id);
                $this->redirect(['action' => 'index']);
            } else {
                $this->set('errors', $purchasedLessonEditionsBundle->errors());
            }
            
        }
        $lessonEditionsBundles = $this->PurchasedLessonEditionsBundles->LessonEditionsBundles->find('list', ['limit' => 200]);
        $this->set('lessonEditionsBundles', $lessonEditionsBundles);
        $this->set('athlete', $athlete);
        $this->set('purchasedLessonEditionsBundle', $purchasedLessonEditionsBundle);
    }

    /**
     * View method
     *
     * @param string|null $id Purchased Lesson Editions Bundle id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchasedLessonEditionsBundle = $this->PurchasedLessonEditionsBundles->get($id, [
            'contain' => ['Athletes', 'LessonEditionsBundles']
        ]);

        $this->set('purchasedLessonEditionsBundle', $purchasedLessonEditionsBundle);
        $this->set('isValid', $purchasedLessonEditionsBundle->isValid());
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchasedLessonEditionsBundle = $this->PurchasedLessonEditionsBundles->newEntity();
        if ($this->request->is('post')) {
            $purchasedLessonEditionsBundle = $this->PurchasedLessonEditionsBundles->patchEntity($purchasedLessonEditionsBundle, $this->request->getData());
            if ($this->PurchasedLessonEditionsBundles->save($purchasedLessonEditionsBundle)) {
                $this->Flash->success(__('The purchased lesson editions bundle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchased lesson editions bundle could not be saved. Please, try again.'));
        }
        $athletes = $this->PurchasedLessonEditionsBundles->Athletes->find('list', ['limit' => 200]);
        $lessonEditionsBundles = $this->PurchasedLessonEditionsBundles->LessonEditionsBundles->find('list', ['limit' => 200]);
        $this->set(compact('purchasedLessonEditionsBundle', 'athletes', 'lessonEditionsBundles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchased Lesson Editions Bundle id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchasedLessonEditionsBundle = $this->PurchasedLessonEditionsBundles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchasedLessonEditionsBundle = $this->PurchasedLessonEditionsBundles->patchEntity($purchasedLessonEditionsBundle, $this->request->getData());
            if ($this->PurchasedLessonEditionsBundles->save($purchasedLessonEditionsBundle)) {
                $this->Flash->success(__('The purchased lesson editions bundle has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchased lesson editions bundle could not be saved. Please, try again.'));
        }
        $athletes = $this->PurchasedLessonEditionsBundles->Athletes->find('list', ['limit' => 200]);
        $lessonEditionsBundles = $this->PurchasedLessonEditionsBundles->LessonEditionsBundles->find('list', ['limit' => 200]);
        $this->set(compact('purchasedLessonEditionsBundle', 'athletes', 'lessonEditionsBundles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchased Lesson Editions Bundle id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchasedLessonEditionsBundle = $this->PurchasedLessonEditionsBundles->get($id);
        if ($this->PurchasedLessonEditionsBundles->delete($purchasedLessonEditionsBundle)) {
            $this->Flash->success(__('The purchased lesson editions bundle has been deleted.'));
        } else {
            $this->Flash->error(__('The purchased lesson editions bundle could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
