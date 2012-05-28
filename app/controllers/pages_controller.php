<?php

class PagesController extends AppController {

    var $name = 'Pages';
    var $uses = array('User');
    var $layout = 'default';
    var $components = array('Auth', 'Session');
    
    function beforeFilter() {

        $this->Auth->allow('');
        $this->Auth->authError = 'please login to view that page';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'tasks', 'action' => 'index');
        $this->Auth->loginError = 'incorrect username/password';
    }

    function display() {
        $this->layout = null;
        // if not logged in then redirect to user login page
        if(!$this->Auth->user()){
            $this->redirect(array("controller"=>"users","action"=>"login"));
            exit();
        }
    }

}
