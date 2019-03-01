<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchasedLessonEditionsBundlesStatuses Controller
 *
 * @property \App\Model\Table\PurchasedLessonEditionsBundlesStatusesTable $PurchasedLessonEditionsBundlesStatuses
 *
 * @method \App\Model\Entity\PurchasedLessonEditionsBundlesStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PurchasedLessonEditionsBundlesStatusesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $purchasedLessonEditionsBundlesStatuses = $this->paginate($this->PurchasedLessonEditionsBundlesStatuses);

        $this->set(compact('purchasedLessonEditionsBundlesStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Purchased Lesson Editions Bundles Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchasedLessonEditionsBundlesStatus = $this->PurchasedLessonEditionsBundlesStatuses->get($id, [
            'contain' => []
        ]);

        $this->set('purchasedLessonEditionsBundlesStatus', $purchasedLessonEditionsBundlesStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchasedLessonEditionsBundlesStatus = $this->PurchasedLessonEditionsBundlesStatuses->newEntity();
        if ($this->request->is('post')) {
            $purchasedLessonEditionsBundlesStatus = $this->PurchasedLessonEditionsBundlesStatuses->patchEntity($purchasedLessonEditionsBundlesStatus, $this->request->getData());
            if ($this->PurchasedLessonEditionsBundlesStatuses->save($purchasedLessonEditionsBundlesStatus)) {
                $this->Flash->success(__('The purchased lesson editions bundles status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchased lesson editions bundles status could not be saved. Please, try again.'));
        }
        $this->set(compact('purchasedLessonEditionsBundlesStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchased Lesson Editions Bundles Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchasedLessonEditionsBundlesStatus = $this->PurchasedLessonEditionsBundlesStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchasedLessonEditionsBundlesStatus = $this->PurchasedLessonEditionsBundlesStatuses->patchEntity($purchasedLessonEditionsBundlesStatus, $this->request->getData());
            if ($this->PurchasedLessonEditionsBundlesStatuses->save($purchasedLessonEditionsBundlesStatus)) {
                $this->Flash->success(__('The purchased lesson editions bundles status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchased lesson editions bundles status could not be saved. Please, try again.'));
        }
        $this->set(compact('purchasedLessonEditionsBundlesStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchased Lesson Editions Bundles Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchasedLessonEditionsBundlesStatus = $this->PurchasedLessonEditionsBundlesStatuses->get($id);
        if ($this->PurchasedLessonEditionsBundlesStatuses->delete($purchasedLessonEditionsBundlesStatus)) {
            $this->Flash->success(__('The purchased lesson editions bundles status has been deleted.'));
        } else {
            $this->Flash->error(__('The purchased lesson editions bundles status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
