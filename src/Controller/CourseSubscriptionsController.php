<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Chronos\Chronos;
use Cake\Core\Configure;

/**
 * CourseSubscriptions Controller
 *
 */
class CourseSubscriptionsController extends AppController
{

	public function index($course_id = null) 
	{
        $this->paginate = [
            'contain' => ['Courses', 'Athletes']
        ];
        $query = $this->CourseSubscriptions->find('byCourse', ['course_id' => $course_id]);

        $this->set('courses', $this->paginate($query));
	}

	public function subscribeCourse($course_id = null)
	{
		$course = $this->CourseSubscriptions->Courses->get($course_id, ['contain' => ['CourseStatuses', 'CourseLevels']]);
		
		$course_subscription = $this->CourseSubscriptions->newEntity();
		$course_subscription->course_id = $course->id;

		if ($this->request->is('post')) {
            $course_subscription = $this->CourseSubscriptions->patchEntity($course_subscription, $this->request->getData());
            //debug($course_subscription);

            //debug($course_subscription->errors());
            
            if ($this->CourseSubscriptions->save($course_subscription)) {
            	$this->Flash->success('Subscription has been saved.');
            	return $this->redirect(['controller' => 'Courses', 'action' => 'view', $course->id]);
            }
            $this->Flash->error('Error saving subscription, try again.');
            
        }

		$this->set('course', $course);
		$this->set('course_subscription', $course_subscription);
	}

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $course_subscription = $this->CourseSubscriptions->get($id, ['contain' => ['Athletes', 'Courses']]);

        if ($course_subscription->course->course_status_id > 2) {
            $this->Flash->error(__('Non è possibile eliminare l\'iscrizione da questo corso'));
            $this->redirect(['controller' => 'Courses', 'action' => 'view', $course_subscription->course->id]);
        }

        if ($this->CourseSubscriptions->delete($course_subscription)) {
            $this->Flash->success(__('Iscrizione cancellata.'));
        } else {
            $this->Flash->error(__('Errore durante la cancellazione.'));
        }

        return $this->redirect(['controller' => 'Courses', 'action' => 'view', $course_subscription->course->id]);
    }
}