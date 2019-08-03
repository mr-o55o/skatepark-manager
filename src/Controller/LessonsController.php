<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Lessons Controller
 *
 * @property \App\Model\Table\LessonsTable $Lessons
 *
 * @method \App\Model\Entity\Lesson[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LessonsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $lessons = $this->paginate($this->Lessons);



        $this->set(compact('lessons'));
    }

    public function dashboard()
    {
        $query = $this->Lessons->find('all');
        $query->innerJoinWith('LessonEditions');
        $query->select([
            //'LessonEditions.LessonEditionStatuses.name',
            'Lessons.name',
            'editions_count' => $query->func()->count('LessonEditions.id')
            ])
        ->group(['Lessons.name']);
        
        $this->set('lessonsCount', $query);


        $query = $this->Lessons->find('all');
        $query->innerJoinWith('LessonEditions.LessonEditionStatuses');
        $query->innerJoinWith('LessonEditions');
        $bookedCase = $query->newExpr()
            ->addCase(
                $query->newExpr()->add(['LessonEditions.lesson_edition_status_id' => 3]),
                1,
                'integer'
            );
        $completedCase = $query->newExpr()    
            ->addCase(
                $query->newExpr()->add(['LessonEditions.lesson_edition_status_id' => 4]),
                1,
                'integer'
            );
        $query->group(['Lessons.name', 'LessonEditions.lesson_edition_status_id']);
        $query->select([
            $query->func()->distinct(['name' => 'Lessons.name',  'status' => 'LessonEditions.lesson_edition_status_id']),
            'number_booked' => $query->func()->count($bookedCase),
            'number_completed' => $query->func()->count($completedCase),

        ]);       
        $this->set('lessonsEditionsByStatus', $query);
    }

    /**
     * View method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lesson = $this->Lessons->get($id);

        $countLessonEditions = $this->loadModel('LessonEditions')->find('all')->where(['lesson_id' => $lesson->id])->count();

        $this->set('lesson', $lesson);
        $this->set('countLessonEditions', $countLessonEditions);
        $this->set('back_url', $this->referer());
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lesson = $this->Lessons->newEntity();
        if ($this->request->is('post')) {
            $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
            if ($this->Lessons->save($lesson)) {
                $this->Flash->success(__('The lesson has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
        }
        $this->set(compact('lesson'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lesson = $this->Lessons->get($id, [
            'contain' => ['LessonEditions']
        ]);

        //lessons can be edited if they are not already used
        if (count($lesson->lesson_editions) > 0) {
            $this->Flash->error(__('Cannot edit a lesson already used in lesson editions.'));
            $this->redirect($this->referer());            
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson = $this->Lessons->patchEntity($lesson, $this->request->getData());
            if ($this->Lessons->save($lesson)) {
                $this->Flash->success(__('The lesson has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
        }
        $this->set(compact('lesson'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lesson id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lesson = $this->Lessons->get($id);
        //lessons can be deleted if they are not already used
        if (count($lesson->lesson_editions) > 0) {
            $this->Flash->error(__('Cannot delete a lesson alredy used in lesson editions.'));
            $this->redirect($this->referer());            
        }
        if ($this->Lessons->delete($lesson)) {
            $this->Flash->success(__('The lesson has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
