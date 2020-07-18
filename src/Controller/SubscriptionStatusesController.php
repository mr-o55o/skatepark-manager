<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SubscriptionStatuses Controller
 *
 * @property \App\Model\Table\SubscriptionStatusesTable $SubscriptionStatuses
 *
 * @method \App\Model\Entity\SubscriptionStatus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubscriptionStatusesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $subscriptionStatuses = $this->paginate($this->SubscriptionStatuses);

        $this->set(compact('subscriptionStatuses'));
    }

    /**
     * View method
     *
     * @param string|null $id Subscription Status id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subscriptionStatus = $this->SubscriptionStatuses->get($id, [
            'contain' => ['Subscriptions']
        ]);

        $this->set('subscriptionStatus', $subscriptionStatus);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subscriptionStatus = $this->SubscriptionStatuses->newEntity();
        if ($this->request->is('post')) {
            $subscriptionStatus = $this->SubscriptionStatuses->patchEntity($subscriptionStatus, $this->request->getData());
            if ($this->SubscriptionStatuses->save($subscriptionStatus)) {
                $this->Flash->success(__('The subscription status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subscription status could not be saved. Please, try again.'));
        }
        $this->set(compact('subscriptionStatus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subscription Status id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subscriptionStatus = $this->SubscriptionStatuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subscriptionStatus = $this->SubscriptionStatuses->patchEntity($subscriptionStatus, $this->request->getData());
            if ($this->SubscriptionStatuses->save($subscriptionStatus)) {
                $this->Flash->success(__('The subscription status has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subscription status could not be saved. Please, try again.'));
        }
        $this->set(compact('subscriptionStatus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subscription Status id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subscriptionStatus = $this->SubscriptionStatuses->get($id);
        if ($this->SubscriptionStatuses->delete($subscriptionStatus)) {
            $this->Flash->success(__('The subscription status has been deleted.'));
        } else {
            $this->Flash->error(__('The subscription status could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
