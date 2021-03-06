<?php
/**
 * CakePHP 3 port of Wizard component by jaredhoyt.
 *
 * Handles multi-step form navigation, data persistence, validation callbacks,
 * and plot-branching navigation.
 *
 * PHP versions 4 and 5
 *
 * Comments and bug reports welcome at jaredhoyt AT gmail DOT com
 *
 * Licensed under The MIT License
 *
 * @property SessionComponent $Session
 * @writtenby          sourjya
 * @license            http://www.opensource.org/licenses/mit-license.php The MIT License
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Log\Log;
use Cake\Utility\Inflector;

class WizardComponent extends Component {

    /**
     * Controller $controller variable.
     *
     * @var Controller
     * @access public
     */
    public $controller = null;

    /**
     * Component $session variable
     *
     * @var null
     */
    public $session = null;

    /**
     * The Component will redirect to the "expected step" after a step has been successfully
     * completed if autoAdvance is true. If false, the Component will redirect to
     * the next step in the $steps array. (This is helpful for returning a user to
     * the expected step after editing a previous step w/o them having to navigate through
     * each step in between.)
     *
     * @var bool
     * @access public
     */
    public $autoAdvance = true;

    /**
     * Option to automatically reset if the wizard does not follow "normal"
     * operation. (ie. manual url changing, navigation away and returning, etc.)
     * Set this to false if you want the Wizard to return to the "expected step"
     * after invalid navigation.
     *
     * @var bool
     * @access public
     */
    public $autoReset = false;

    /**
     * If no processCallback() exists for the current step, the component will automatically
     * validate the model data against the models included in the controller's uses array.
     *
     * @var bool
     * @access public
     */
    public $autoValidate = false;

    /**
     * List of steps, in order, that are to be included in the wizard.
     * Basic example:
     * <code>
     * $steps = [ 'contact', 'payment', 'confirm' ];
     * </code>
     *
     * The $steps array can also contain nested steps arrays of the same format but
     * must be wrapped by a branch group.
     * Plot-branched example:
     * <code>
     * $steps = [
     *     'job_application',
     *         [
     *             'degree' => [ 'college', 'degree_type' ],
     *             'nodegree' => 'experience'
     *         ],
     *         'confirm',
     *     ];
     * </code>
     *
     * The 'branchnames' (ie 'degree', 'nodegree') are arbitrary but used as selectors
     * for the branch() and unbranch() methods. Branches can point to either another
     * steps array or a single step. The first branch in a group that hasn't been
     * skipped (see branch()) is included by default (if $defaultBranch = true).
     *
     * @var array
     * @access public
     */
    public $steps = [];

    /**
     * Controller action that processes your step.
     *
     * @var string
     * @access public
     */
    public $action = 'wizard';

    /**
     * Url to be redirected to after the wizard has been completed.
     * Controller::afterComplete() is called directly before redirection.
     *
     * @var mixed
     * @access public
     */
    public $completeUrl = '/';

    /**
     * Url to be redirected to after 'Cancel' submit button has been pressed by user.
     *
     * @var mixed
     * @access public
     */
    public $cancelUrl = '/';

    /**
     * Url to be redirected to after 'Draft' submit button has been pressed by user.
     *
     * @var mixed
     * @access public
     */
    public $draftUrl = '/';
    /**
     * If `true` then URL parameters from the first step will be present in the URLs
     * of all other steps.
     *
     * @var bool
     */
    public $persistUrlParams = false;

    /**
     * If true, the first "non-skipped" branch in a group will be used if a branch has
     * not been included specifically.
     *
     * @var bool
     * @access public
     */
    public $defaultBranch = true;

    /**
     * If true, the user will not be allowed to edit previously completed steps. They will be
     * "locked down" to the current step. The opposite of $roaming.
     *
     * @var bool
     * @access public
     */
    public $lockdown = false;

    /**
     * If true, the user will be allowed navigate to any steps. The opposite of $lockdown.
     *
     * @var bool
     * @access public
     */
    public $roaming = false;

    /**
     * If true, the component will render views found in views/{wizardAction}/{step}.ctp rather
     *  than views/{step}.ctp.
     *
     * @var bool
     * @access public
     */
    public $nestedViews = false;

    /**
     * Holds the root of the session key for data storage.
     *
     * @var string
     */
    public $sessionRootKey = 'Wizard';

    /**
     * Other components used.
     *
     * @var array
     * @access public
     */
    public $components = [ 'Session' ];

    /**
     * Internal step tracking.
     *
     * @var string
     * @access protected
     */
    protected $_currentStep = null;

    /**
     * Holds the session key for data storage.
     *
     * @var string
     * @access protected
     */
    protected $_sessionKey = null;

    /**
     * Other session keys used.
     *
     * @var string
     * @access protected
     */
    protected $_configKey = null;
    protected $_branchKey = null;

    /**
     * Holds the array based url for redirecting.
     *
     * @var array
     * @access protected
     */
    protected $_wizardUrl = [];

    /**
     * Holds the array with steps and branches from the initial Wizard configuration.
     *
     * @var array
     */
    protected $_stepsAndBranches = [];

    /**
     * Controller Theme
     * @var null
     */
    protected $theme = null;

    /**
     * Initialize properties.
     * @param array $config
     */
    public function initialize( array $config = [] ) {
        parent::initialize( $config );

        $this->controller = $this->_registry->getController();
//        $this->eventManager( $this->controller->eventManager() );
        $this->request = &$this->controller->request;
        $this->response =& $this->controller->response;
        $this->session = $this->controller->request->session();
        $this->theme = $this->controller->viewBuilder()->getTheme();
        //
        $this->__setSessionKeys();
        $this->_stepsAndBranches = $this->steps;

    }

    /**
     * Sets session keys used by this component.
     *
     * @return void
     */
    private function __setSessionKeys() {
        if( $this->controller->request->session()->check( $this->sessionRootKey . '.complete' ) ) {
            $this->_sessionKey = $this->sessionRootKey . '.complete';
        } else {
            $this->_sessionKey = $this->sessionRootKey . '.' . $this->controller->name;
        }
        $this->_configKey = $this->sessionRootKey . '.config';
        $this->_branchKey = $this->sessionRootKey . '.branches.' . $this->controller->name;
    }

    /**
     * Callback for Controller.startup event.
     * Called after the Controller::beforeFilter() and before the controller action
     *
     * @param $event A reference to the Event object
     *
     * @access public
     * @return void
     */
    public function startup( Event $event ) {

        $this->__setSessionKeys();

        $this->config( 'action', $this->action );

        $this->_configSteps( $this->steps );
        if( !in_array( 'Wizard', $this->controller->helpers ) &&
            !array_key_exists( 'Wizard', $this->controller->helpers ) ) {
            $this->controller->helpers[ 'Wizard' ] = [
                'sessionRootKey' => $this->sessionRootKey,
            ];
        }
    }

    /**
     * Parses the steps array by stripping off nested arrays not included in the branches
     * and writes a simple array with the correct steps to session.
     *
     * @param array $steps Array to be parsed for nested arrays.
     * @return void
     */
    protected function _configSteps( $steps ) {
        $this->steps = $this->_parseSteps( $steps );
        $this->config( 'steps', $this->steps );
    }

    /**
     * Parses the steps array by stripping off nested arrays not included in the branches
     * and returns a simple array with the correct steps.
     *
     * @param array $steps Array to be parsed for nested arrays and returned as simple array.
     *
     * @return array
     * @access protected
     */
    protected function _parseSteps( $steps ) {

        $parsed = [];

        foreach( $steps as $key => $name ) {
            if( is_array( $name ) ) {
                foreach( $name as $branchName => $step ) {
                    $branchType = $this->_branchType( $branchName );
                    if( $branchType ) {
                        if( $branchType !== 'skip' ) {
                            $branch = $branchName;
                        }
                    } elseif( empty( $branch ) && $this->defaultBranch ) {
                        $branch = $branchName;
                    }
                }
                if( !empty( $branch ) ) {
                    if( is_array( $name[ $branch ] ) ) {
                        $parsed = array_merge( $parsed, $this->_parseSteps( $name[ $branch ] ) );
                    } else {
                        $parsed[] = $name[ $branch ];
                    }
                }
                unset( $branch );
            } else {
                $parsed[] = $name;
            }
        }

        return $parsed;
    }

    /**
     * Saves configuration details for use in WizardHelper.
     *
     * @param string $branch branch key.
     *
     * @return mixed
     * @access protected
     */
    protected function _branchType( $branch ) {
        if( $this->request->session()->check( "$this->_branchKey.$branch" ) ) {
            return $this->request->session->read( "$this->_branchKey.$branch" );
        }

        return false;
    }

    /**
     * Saves configuration details for use in WizardHelper or returns a config value.
     * This is method usually handled only by the component.
     *
     * @param string $key Name of configuration variable.
     * @param mixed $value Value to be stored.
     * @param bool $merge
     *
     * @return mixed
     * @access public
     */
    public function config( $key = NULL, $value = NULL, $merge = true ) {
        if( $value == null ) {
            return $this->request->session()->read( "$this->_configKey.$key" );
        }
        $this->request->session()->write( "$this->_configKey.$key", $value );

        return $value;
    }

    /**
     * Main Component method.
     *
     * @param string $step Name of step associated in $this->steps to be processed.
     *
     * @throws NotImplementedException
     * @return bool|\CakeResponse
     * @access public
     */
    public function process( $step ) {

        // Cancel pressed
        if( $this->request->getData( 'Cancel' ) != null ) {
            if( method_exists( $this->controller, 'beforeCancel' ) ) {
                $this->controller->beforeCancel( $this->_getExpectedStep() );
            }
            $this->reset();

            return $this->controller->redirect( $this->cancelUrl );
        }

        // Draft pressed
        if( $this->request->getData( 'Draft' ) != null ) {
            if( method_exists( $this->controller, 'saveDraft' ) ) {
                $draft = [
                    '_draft' => [
                        'current' => [
                            'step' => $step,
                            'data' => $this->controller->request->data
                        ]
                    ]
                ];
                $this->controller->saveDraft( array_merge_recursive( (array) $this->read(), $draft ) );
            }
            $this->reset();

            return $this->controller->redirect( $this->draftUrl );
        }

        // Complete?
        if( empty( $step ) ) {

            if( $this->request->session()->check( $this->sessionRootKey . '.complete' ) ) {

                // Call afterComplete callback - if it exists
                if( method_exists( $this->controller, 'afterComplete' ) ) {
                    $this->controller->afterComplete();
                }
                $this->reset();

                // Redirect to completion URL
                return $this->controller->redirect( $this->completeUrl );
            }
            $this->autoReset = false;
        } elseif( $step == 'reset' ) {

            // Reset
            if( !$this->lockdown ) {
                $this->reset();
            }

        } else {

            // Goto Step
            if( $this->_validStep( $step ) ) {
                $this->_setCurrentStep( $step );

                if( !empty( $this->request->getData() ) && $this->request->getData( 'Previous' ) == null ) {

                    // Call Process Callback
                    $processCallback = '_'.Inflector::variable( 'process_' . $this->_currentStep );

                    if( method_exists( $this->controller, $processCallback ) ) {
                        $proceed = $this->controller->$processCallback();
                        if( !is_bool( $proceed ) ) {
                            throw new NotImplementedException( sprintf( __( 'Process Callback Controller::%s should return boolean', $processCallback ) ) );
                        }
                    } elseif( $this->autoValidate ) {
                        $proceed = $this->_validateData();
                    } else {
                        throw new NotImplementedException( sprintf( __( 'Process Callback not found. Please create Controller::%s', $processCallback ) ) );
                    }

                    if( $proceed ) {
                        $this->save();
                        if( $this->request->getData( 'SaveAndBack' ) != null && prev( $this->steps ) ) {
                            return $this->redirect( current( $this->steps ) );
                        }

                        if( next( $this->steps ) ) {
                            if( $this->autoAdvance ) {
                                return $this->redirect();
                            }

                            return $this->redirect( current( $this->steps ) );
                        } else {
                            $this->request->session()->write( $this->sessionRootKey . '.complete', $this->read() );
                            $this->reset();

                            return $this->controller->redirect( [ 'action' => $this->action ] );
                        }
                    }
                } elseif( $this->request->getData( 'Previous' ) != null && prev( $this->steps ) ) {
                    return $this->redirect( current( $this->steps ) );
                } elseif( $this->request->session()->check( "$this->_sessionKey._draft.current" ) ) {
                    $this->request->data = $this->read( '_draft.current.data' );
                    $this->request->session()->delete( "$this->_sessionKey._draft.current" );
                } elseif( $this->request->session()->check( "$this->_sessionKey.$this->_currentStep" ) ) {
                    $this->request->data = $this->read( $this->_currentStep );
                }

                // Call Prepare Callback
                $prepareCallback = '_'.Inflector::variable( 'prepare_' . $this->_currentStep );

                if( method_exists( $this->controller, $prepareCallback ) ) {
                    $this->controller->$prepareCallback();
                }
                $this->config( 'activeStep', $this->_currentStep );
                if( $this->nestedViews ) {
                    // Has theme?
                    if( $this->theme )
                        $this->controller->viewBuilder()->setTheme( $this->theme );
                    $this->controller->viewBuilder()->setTemplatePath( '/' . $this->action );
                }
                if( $this->controller->autoRender ) {
                    return $this->controller->render( $this->_currentStep );
                }

                return true;
            } else {
                return $this->redirect();
            }
        }

        // Reset
        if( $step != 'reset' && $this->autoReset ) {
            $this->reset();
        }

        return $this->redirect();
    }

    /**
     * Finds the first incomplete step (i.e. step data not saved in Session).
     *
     * @return string $step or false if complete
     * @access protected
     */
    protected function _getExpectedStep() {
        foreach( $this->steps as $step ) {
            if( !$this->request->session()->check( "$this->_sessionKey.$step" ) ) {
                $this->config( 'expectedStep', $step );

                return $step;
            }
        }

        return false;
    }

    /**
     * Resets the wizard by deleting the wizard session.
     *
     * @access public
     * @return void
     */
    public function reset() {
        $this->request->session()->delete( $this->_branchKey );
        $this->request->session()->delete( $this->_sessionKey );
    }

    /**
     * Get the data from the Session that has been stored by the WizardComponent.
     *
     * @param string $key step key.
     *
     * @internal param mixed $name The name of the session variable (or a path as sent to Set.extract)
     *
     * @return mixed The value of the session variable
     * @access   public
     */
    public function read( $key = null ) {
        if( $key == null ) {
            return $this->request->session()->read( $this->_sessionKey );
        } else {
            $wizardData = $this->request->session()->read( "$this->_sessionKey.$key" );
            if( !empty( $wizardData ) ) {
                return $wizardData;
            }

            return null;
        }
    }

    /**
     * Validates the $step four ways:
     *   1. Explicitly only validate step that exists in $this->steps array.
     *   2. If $roaming option is true any steps within $this->steps is valid
     *   3. If $lockdown option is true only the next/current step is valid.
     *   4. If $roaming and $lockdown is false validate the step either before or exactly the expected step.
     *
     * @param string $step Step to validate.
     *
     * @return mixed
     * @access protected
     */
    protected function _validStep( $step ) {
        if( in_array( $step, $this->steps ) ) {
            if( $this->roaming ) {
                return true;
            } elseif( $this->lockdown ) {
                return ( array_search( $step, $this->steps ) == array_search( $this->_getExpectedStep(), $this->steps ) );
            }

            return ( array_search( $step, $this->steps ) <= array_search( $this->_getExpectedStep(), $this->steps ) );
        }

        return false;
    }

    /**
     * Moves internal array pointer of $this->steps to $step and sets $this->_currentStep.
     *
     * @param string $step Step to point to.
     *
     * @access protected
     * @return void
     */
    protected function _setCurrentStep( $step ) {
        if( !in_array( $step, $this->steps ) ) {
            return;
        }
        $this->_currentStep = reset( $this->steps );
        while( current( $this->steps ) != $step ) {
            $this->_currentStep = next( $this->steps );
        }
    }

    /**
     * Validates controller data with the correct model if the model is included in
     * the controller's uses array. This only occurs if $autoValidate = true and there
     * is no processCallback in the controller for the current step.
     *
     * @return bool
     * @access protected
     */
    protected function _validateData() {
        $controller =& $this->controller;
        foreach( $controller->request->data as $model => $data ) {
            if( in_array( $model, $controller->uses ) ) { // TODO:
                $controller->{$model}->set( $data );
                if( !$controller->{$model}->validates() ) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Saves the data from the current step into the Session.
     *
     * Please note: This is normally called automatically by the component after
     * a successful processCallback, but can be called directly for advanced navigation purposes.
     *
     * @param string $step step key.
     * @param array $data step details.
     * @access public
     * @return void
     */
    public function save( $step = null, $data = null ) {
        if( is_null( $step ) ) {
            $step = $this->_currentStep;
        }

        if( is_null( $data ) ) {
            $data = $this->request->data;
        }
        $this->request->session()->write( "$this->_sessionKey.$step", $data );
        $this->_getExpectedStep();
        $this->_setCurrentStep( $step );
    }

    /**
     * Handles Wizard redirection. A null url will redirect to the "expected" step.
     *
     * @param string $step Stepname to be redirected to.
     * @param int $status Optional HTTP status code (eg: 404)
     * @param bool $exit If true, exit() will be called after the redirect
     *
     * @see    Controller::redirect()
     * @access public
     * @return void
     */
    public function redirect( $step = null, $status = null, $exit = true ) {
        if( $step == null ) {
            $step = $this->_getExpectedStep();
        }
        if( $this->persistUrlParams ) {
            $url = Router::reverseToArray( $this->request );
            $url[ 'action' ] = $this->action;
            $url[ 0 ] = $step;
        } else {
            $url = [
                'controller' => Inflector::underscore( $this->controller->name ),
                'action'     => $this->action,
                $step,
            ];
        }

        return $this->controller->redirect( $url, $status, $exit );
    }

    /**
     * Selects a branch to be used in the steps array. The first branch in a group
     * is included by default.
     *
     * @param string $name Branch name to be included in steps.
     * @param bool $skip Branch will be skipped instead of included if true.
     *
     * @access public
     * @return void
     */
    public function branch( $name, $skip = false ) {
        $branches = [];
        if( $this->request->session()->check( $this->_branchKey ) ) {
            $branches = $this->request->session()->read( $this->_branchKey );
        }
        if( $skip ) {
            $value = 'skip';
        } else {
            $value = 'branch';
        }
        $branches[ $name ] = $value;
        $$this->request->session()->write( $this->_branchKey, $branches );
        $this->_configSteps( $this->_stepsAndBranches );
    }

    /**
     * Loads previous draft session.
     *
     * @param array $draft Session data of same format passed to Controller::saveDraft()
     *
     * @see    WizardComponent::process()
     * @access public
     * @return void
     */
    public function loadDraft( $draft = [] ) {
        if( !empty( $draft[ '_draft' ][ 'current' ][ 'step' ] ) ) {
            $this->restore( $draft );

            return $this->redirect( $draft[ '_draft' ][ 'current' ][ 'step' ] );
        }

        return $this->redirect();
    }

    /**
     * Sets data into controller's wizard session. Particularly useful if the data
     * originated from WizardComponent::read() as this will restore a previous session.
     *
     * @param array $data Data to be written to controller's wizard session.
     *
     * @access public
     * @return void
     */
    public function restore( $data = [] ) {
        $this->request->session()->write( $this->_sessionKey, $data );
    }

    /**
     * Resets the wizard by deleting the wizard session.
     *
     * @access public
     * @return void
     */
    public function resetWizard() {
        $this->reset();
    }

    /**
     * Resets the data from the Session that has been stored by the WizardComponent.
     *
     * @param string $key step key.
     *
     * @internal param mixed $name The name of the session variable (or a path as sent to Set.extract)
     *
     * @access   public
     * @return void
     */
    public function delete( $key = null ) {
        if( $key == null ) {
            return;
        } else {
            $this->request->session()->delete( "$this->_sessionKey.$key" );

            return;
        }
    }

    /**
     * Removes a branch from the steps array.
     *
     * @param string $branch Name of branch to be removed from steps array.
     *
     * @access public
     * @return void
     */
    public function unbranch( $branch ) {
        $this->request->session()->delete( "$this->_branchKey.$branch" );
        $this->_configSteps( $this->_stepsAndBranches );
    }

}