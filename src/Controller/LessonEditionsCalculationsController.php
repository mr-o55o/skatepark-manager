<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * LessonEditionsCalculations Controller
 *
 * @property \App\Model\Table\LessonEditionsCalculationsTable $LessonEditionsCalculations
 *
 * @method \App\Model\Entity\LessonEditionsCalculation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LessonEditionsCalculationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $lessonEditionsCalculations = $this->paginate($this->LessonEditionsCalculations);

        $this->set(compact('lessonEditionsCalculations'));

        $lessonEditions = TableRegistry::getTableLocator()->get('LessonEditions');
        $editionsReadyForAccounting = $lessonEditions->find('Completed')->count();

        $this->set(compact('editionsReadyForAccounting'));


    }

    /**
     * View method
     *
     * @param string|null $id Lesson Editions Calculation id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lessonEditionsCalculation = $this->LessonEditionsCalculations->get($id, [
            'contain' => []
        ]);

        $this->set('lessonEditionsCalculation', $lessonEditionsCalculation);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lessonEditionsCalculation = $this->LessonEditionsCalculations->newEntity();
        if ($this->request->is('post')) {
            $lessonEditionsCalculation = $this->LessonEditionsCalculations->patchEntity($lessonEditionsCalculation, $this->request->getData());
            if ($this->LessonEditionsCalculations->save($lessonEditionsCalculation)) {
                $this->Flash->success(__('The lesson editions calculation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson editions calculation could not be saved. Please, try again.'));
        }
        $this->set(compact('lessonEditionsCalculation'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson Editions Calculation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lessonEditionsCalculation = $this->LessonEditionsCalculations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lessonEditionsCalculation = $this->LessonEditionsCalculations->patchEntity($lessonEditionsCalculation, $this->request->getData());
            if ($this->LessonEditionsCalculations->save($lessonEditionsCalculation)) {
                $this->Flash->success(__('The lesson editions calculation has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson editions calculation could not be saved. Please, try again.'));
        }
        $this->set(compact('lessonEditionsCalculation'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson Editions Calculation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lessonEditionsCalculation = $this->LessonEditionsCalculations->get($id);
        if ($this->LessonEditionsCalculations->delete($lessonEditionsCalculation)) {
            $this->Flash->success(__('The lesson editions calculation has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson editions calculation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
