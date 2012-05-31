<?php

class UsersController extends AppController {

    var $name = 'Users';
    var $components = array('Auth', 'Session');
    var $uses = array('Task', 'Taskassign', 'User');

    function beforeFilter() {

        $this->Auth->allow('index', 'view', 'add');
        $this->Auth->authError = 'please login to view that page';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'display');
        $this->Auth->loginError = 'incorrect username/password';
        $this->Auth->autoRedirect = false;
    }

    function login() {
        $this->layout = null;
        if ($this->Auth->user()) {
            $userrole = $this->User->getRole($this->Auth->user('id'));

            if ($userrole == 'normaluser') {
                $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
                exit();
            } else if ($userrole == 'admin') {
                $this->redirect(array('controller' => 'users', 'action' => 'adminpage'));
                exit();
            } else {
                $this->redirect(array('controller' => 'users', 'action' => 'errorpage'));
            }
        }
    }

    function logout() {

        $this->redirect($this->Auth->logout());
    }

    function adminpage() {
        $userrole = $this->User->getRole($this->Auth->user('id'));
        if ($userrole != 'admin') {
            $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
        } else {
            $this->set('tasks', $this->Task->getTaskSorted());
        }
    }

    function index() {
        $userrole = $this->User->getRole($this->Auth->user('id'));

        if ($userrole != "admin") {

          $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
         
        } 
        else {
            $this->set('users', $this->User->find('all'));
        }
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    function add() {
        $userrole = $this->User->getRole($this->Auth->user('id'));
        
        if($userrole != 'admin') {
            
          $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
          exit();
        }
        
        if (!empty($this->data)) {
            $this->User->create();
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('The user has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->data['User']['password'] = '';
                $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
            }
        }
    } 

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('The user has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->User->read(null, $id);
        }
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for user', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('User deleted', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted', true));
        $this->redirect(array('action' => 'index'));
    }

}
