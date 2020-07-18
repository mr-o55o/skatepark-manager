<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CourseClasses Controller
 *
 * @property \App\Model\Table\CourseClassesTable $CourseClasses
 *
 * @method \App\Model\Entity\CourseClass[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CourseClassesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CoursePeriods', 'CourseEditions', 'CourseClassStatuses']
        ];
        $courseClasses = $this->paginate($this->CourseClasses);

        $this->set(compact('courseClasses'));
    }

    /**
     * View method
     *
     * @param string|null $id Course Class id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $courseClass = $this->CourseClasses->get($id, [
            'contain' => ['CoursePeriods', 'CourseEditions', 'CourseClassStatuses', 'CourseClassMembers']
        ]);

        $this->set('courseClass', $courseClass);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $courseClass = $this->CourseClasses->newEntity();
        if ($this->request->is('post')) {
            $courseClass = $this->CourseClasses->patchEntity($courseClass, $this->request->getData());
            if ($this->CourseClasses->save($courseClass)) {
                $this->Flash->success(__('The course class has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course class could not be saved. Please, try again.'));
        }
        $coursePeriods = $this->CourseClasses->CoursePeriods->find('list', ['limit' => 200]);
        $courseEditions = $this->CourseClasses->CourseEditions->find('list', ['limit' => 200]);
        $courseClassStatuses = $this->CourseClasses->CourseClassStatuses->find('list', ['limit' => 200]);
        $this->set(compact('courseClass', 'coursePeriods', 'courseEditions', 'courseClassStatuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Course Class id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $courseClass = $this->CourseClasses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $courseClass = $this->CourseClasses->patchEntity($courseClass, $this->request->getData());
            if ($this->CourseClasses->save($courseClass)) {
                $this->Flash->success(__('The course class has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course class could not be saved. Please, try again.'));
        }
        $coursePeriods = $this->CourseClasses->CoursePeriods->find('list', ['limit' => 200]);
        $courseEditions = $this->CourseClasses->CourseEditions->find('list', ['limit' => 200]);
        $courseClassStatuses = $this->CourseClasses->CourseClassStatuses->find('list', ['limit' => 200]);
        $this->set(compact('courseClass', 'coursePeriods', 'courseEditions', 'courseClassStatuses'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Course Class id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $courseClass = $this->CourseClasses->get($id);
        if ($this->CourseClasses->delete($courseClass)) {
            $this->Flash->success(__('The course class has been deleted.'));
        } else {
            $this->Flash->error(__('The course class could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function addClasses()
    {
        $activeCoursePeriod = $this->CourseClasses->CoursePeriods->find('all')->where(['is_active' => true])->first();
        //debug($activePeriod);

        $courseSubscriptions = $this->loadModel('CourseSubscriptions')->find('all')
        ->contain(['SelectedCourseEditions.CourseEditions'])
        ->where(['start_date <= ' => $activeCoursePeriod->start_date])
        ->where(['end_date >=' => $activeCoursePeriod->end_date])
        ->toArray();

        $classes = [];
        $is_present = false;


        foreach ($courseSubscriptions as $subscription) {
            //debug('Abbonamnento: '.$subscription->id);
            foreach ($subscription->selected_course_editions as $selectedCourseEdition) {
                //verifica esistenza di una classe per questa edizione: 
                // - se non esiste viene create e gli viene associata l'iscrizione
                // - se esiste gi viene associata l'iscrizione
                //debug('-- Edizione selezionata: '.$selectedCourseEdition->course_edition->id);
                //debug($courseEdition);
                if (empty($classes)) {
                    //debug('Lista Classi vuota -> Aggiungere Classe');
                    $class = [];
                    //attach course edition
                    $class['course_edition_id'] = $selectedCourseEdition->course_edition->id;
                    //attach active period
                    $class['course_period_id'] = $activeCoursePeriod->id;
                    //set status 
                    $class['course_class_status_id'] = 1;
                    //set class name
                    $class['name'] = 'Classe '.$activeCoursePeriod->name.' - '.$selectedCourseEdition->course_edition->name;
                    //attach class to class list
                    //debug($class);
                    $classes[] = $class;
                    //debug('-- Prima Classe aggiunta per periodo '.$class->course_period_id.' ed ediione '.$class->course_edition_id);                   
                } else {
                    //debug('Classi create fino ad ora: '. count($classes));
                    $i = 0;
                    foreach ($classes as $class) {
                        //debug('Elementi in Lista classi: '.count($classes));
                        //debug('ClassCourseEditionId: '.$class->course_edition_id);
                        //debug('SelectedCourseEditionId: '. $selectedCourseEdition->course_edition->id);
                        if ($class['course_edition_id'] == $selectedCourseEdition->course_edition->id) {
                            //debug('---- Presente!!!!');
                            $is_present = $i;
                            break;
                        } else {
                            $is_present = false;
                        }
                        $i++;
                    }

                    //debug($is_present);
                    if (!$is_present == false) {
                        //debug('-- Classe già presente per edizione '. $selectedCourseEdition->course_edition->id .' -> aggiungere iscrizione');
                        $classes[$is_present]['course_subscriptions'][]['course_subscription_id'] = $subscription->id; 
                    } else {
                        $class = [];
                        //attach course edition
                        $class['course_edition_id'] = $selectedCourseEdition->course_edition->id;
                        //attach active period
                        $class['course_period_id'] = $activeCoursePeriod->id;
                        //set status 
                        $class['course_class_status_id'] = 1;
                        //set class name
                        $class['name'] = 'Classe '.$activeCoursePeriod->name.' - '.$selectedCourseEdition->course_edition->name;
                        //attach class to class list
                        //debug($class);
                        $classes[] = $class;
                        //debug('-- Prima Classe aggiunta per periodo '.$class->course_period_id.' ed ediione '.$class->course_edition_id);                          
                    }
                }
            }
        }
        $classes = $this->CourseClasses->newEntities($classes);
        //$classEntities = $this->CourseClasses->patchEntities($classEntities, $classes);

        //debug($classEntities);

        if ($this->request->is(['post'])) {
            //save the entities
            if ($this->CourseClasses->saveMany($classes)) {
                $this->Flash->success('Classes succesfully added');
            } else {
                $this->Flash->error('Error Saving Classes');
            }
        }

        $this->set(compact('activeCoursePeriod', 'courseSubscriptions', 'classes'));


    }
}
