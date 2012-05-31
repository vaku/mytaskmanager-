<?php

class DprsController extends AppController {

    var $name = 'Dprs';
    var $components = array('Auth', 'Session');
    var $uses = array('User', 'Dpr');

    function beforeFilter() {

        $this->Auth->allow('');
        $this->Auth->authError = 'please login to view that page';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'display');
        $this->Auth->loginError = 'incorrect username/password';

        $this->user_id = $this->Auth->user("id");
    }

    function index() {


        $dprs = $this->Dpr->getUserDprs($this->Auth->user('id'));
        $this->set('dprs', $dprs);
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid dpr', true));
            $this->redirect(array('action' => 'index'));
        }
        $this->set('dpr', $this->Dpr->read(null, $id));
    }

    function admindpr() {
        $userrole = $this->User->getRole($this->Auth->user('id'));
        if ($userrole != 'admin') {
            $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
        } else {
            $user = $this->User->find('all');
            $this->set('users', $user);
        }
    }

    // show all dprs of the particular user
    function view_user_dprs($user_id = null) {
        $userrole = $this->User->getRole($this->Auth->user('id'));
        if ($userrole != 'admin') {
            $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
        } else{
            if (!$user_id) {
            $this->Session->setFlash(__('Invalid dpr', true));
            $this->redirect(array('action' => 'admindpr'));
        }
        $this->set('dprs', $this->Dpr->getUserDprs($user_id));
        }
        
    }

    function add() {
        if (!empty($this->data)) {
            $this->data["Dpr"]["user_id"] = $this->user_id;

            $currenttime = $this->data["Dpr"]["created_on"] = strtotime($this->data["Dpr"]["created_on"]);
            $comparedate = time($currenttime) - (172800);  // fetch 2 days before the current day 

            if ($currenttime < $comparedate) {    //compare if created on day is less than 2days before-  cannot add 
                $this->Session->setflash('cannot add dpr of previous date ');
            } else {

                $this->Dpr->create();

                $checkentry = $this->Dpr->checkRecordExists($this->Auth->user('id'), $currenttime);

                if ($checkentry == 0) {

                    if ($this->Dpr->save($this->data)) {

                        $this->Session->setFlash(__('the dpr has been saved', true));
                        $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('the Dpr could not be saved, please, fill again.', true));
                    }
                } else {
                    $this->redirect(array('action' => 'edit', $checkentry, $this->Session->setFlash('cannot make another dpr on same day, can edit todays dpr')));
                    ;
                }
            }

            $users = $this->Dpr->User->find('list');
            $this->set(compact('users'));
        }
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid dpr', true));
            $this->redirect(array('action' => 'index'));
        }

        if (empty($this->data)) {         // data check if empty it fill the data . 
            $this->data = $this->Dpr->read(null, $id);
            //  $this->data["Dpr"]["created_on"] = date("d-m-Y",$this->data["Dpr"]["created_on"]);
        } else {

            $currenttime = $this->data["Dpr"]["created_on"] = strtotime($this->data["Dpr"]["created_on"]);
            $comparedate = time($currenttime) - (172800);

            if ($currenttime < $comparedate) {    //compare if created on day is less than 2days before-  cannot add 
                $this->Session->setflash('cannot edit dpr of this date');
            } else {

                if ($this->Dpr->save($this->data)) {
                    $this->Session->setFlash(__('The dpr has been saved', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The dpr could not be saved. Please, try again.', true));
                }
            }
        }
    }

}
