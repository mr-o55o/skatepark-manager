<?php 
namespace App\Controller\Component;

/***

LoggedUser Component
Set some view vars relative to currently logged user if any

***/

use Cake\Controller\Component;
use Cake\Core\Configure;



class LoggedUserComponent extends Component
{
    //public $components = ['Auth'];

    

    //sets logged user view variable
    public function setLoggedUser($user)
    {
        $controller = $this->_registry->getController();
        $loggedUser = [];

        if ($user != null)
        {
          $loggedUser['username'] = $user['username'];
          $loggedUser['name'] = $user['name'];
          $loggedUser['surname'] = $user['surname'];
          $loggedUser['role'] = $user['role']['name'];

          $controller->set('loggedUser', $loggedUser);
          return true;

        } else {
          $controller->set('loggedUser', null);
          return false;
        }
    }
}
?>