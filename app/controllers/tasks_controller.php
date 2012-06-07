 <?php

class TasksController extends AppController {

    var $name = 'Tasks';
    var $components = array('Auth', 'Session');
    var $user_id = 0;
    var $uses = array("User", "Task", "Taskassign", 'Comment');
    var $layout = "default";

    function beforeFilter() {   

        $this->Auth->allow('');
        $this->Auth->authError = 'please login to view that page';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'display');
        $this->Auth->loginError = 'incorrect username/password';

        $this->user_id = $this->Auth->user("id");
        $show_admin_links = false;

        if ($this->Auth->user("userrole") == "admin") {
            $show_admin_links = true;
        }
       
        
        $this->set("show_admin_links", $show_admin_links);
    }

    function chgstatus($id, $new_status) {

        $this->Task->id = $id;

        if ($this->Task->saveField('status', $new_status)) {

            $this->Session->setflash('status changed');

            $this->redirect(array('action' => 'view'));
        } else {
            $this->Session->setflash('error occuring while changing status');
        }
    }

    function index() {
        $tasks = $this->Taskassign->getUserTasks($this->Auth->user('id'));
        $this->set('tasks', $tasks);

//        $this->set('tasks', $this->Task->find('all'));
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid task', true));
            $this->redirect(array('action' => 'index'));
        }
        
        $this->set('task', $this->Task->read(null, $id));
        $this->set('comments', $this->Comment->getBytask($id));
        // menu to show .. to vary depending on user who has logged in
        
        $userrole = $this->User->getRole($this->Auth->user('id'));
        if ($userrole == "admin") {
            $this->set("menu_to_show","admin_menu");
        }else{
            $this->set("menu_to_show","menu");
        }
    }

    
    function admin_show_user_tasks($user_id){
        
        $userrole = $this->User->getRole($this->Auth->user('id'));
        
        if($userrole != "admin"){
           $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
        }else {
            $this->set('tasks', $this->Taskassign->getUserTasks($user_id));
        }
        
        
    }
    
    
    function add_my_task() {

        if (!empty($this->data)) {
            // user id of the logged in user who is creating the task
            $this->data["Task"]["user_id"] = $this->user_id;
            $this->data["Task"]["created_on"] = strtotime($this->data["Task"]["created_on"]);
            $this->data["Task"]["due_date"] = strtotime($this->data["Task"]["due_date"]);
            $this->data["Task"]["status"] = 0;
            $this->Task->create();  //ready to save
            if ($this->Task->save($this->data)) {  //just save in database
                $this->data["Taskassign"]["user_id"] = $this->user_id;
                $this->data['Taskassign']['task_id'] = $this->Task->id;
                $this->Taskassign->create();
                $this->Taskassign->save($this->data);

                $this->Session->setFlash(__('The task has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The task could not be saved. Please, try again.', true));
            }
        }
    }

    function add() {
        // check logged in user is admin. 
        
        $users_list = $this->User->getUsers(true);
        $this->set("users", $users_list);

        $userrole = $this->User->getRole($this->Auth->user('id'));

        if ($userrole == Configure::read('normaluser_id')) {   //defined in core.php 
            $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
            $this->Session->flash('not authorized');
            exit();
        }


        if (!empty($this->data)) {
            // user id of the logged in user who is creating the task
            $this->data["Task"]["user_id"] = $this->user_id;
            $this->data["Task"]["created_on"] = strtotime($this->data["Task"]["created_on"]);
            $this->data["Task"]["due_date"] = strtotime($this->data["Task"]["due_date"]);
            $this->data["Task"]["status"] = 0;
            $this->Task->create();  //ready to save
            if ($this->Task->save($this->data)) {  //just save in database
                // $this->data["Taskassign"]["user_id"] = $this->user_id;
                $this->data['Taskassign']['task_id'] = $this->Task->id;
                $this->Taskassign->create();
                $this->Taskassign->save($this->data);

                $this->Session->setFlash(__('The task has been saved', true));
                $this->redirect(array('controller'=>'users','action' => 'adminpage'));
            } else {
                $this->Session->setFlash(__('The task could not be saved. Please, try again.', true));
            }
        }
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid task', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {

          //  if (!$this->Task->checkAccess($this->data["Task"]["id"], $this->user_id)) {
            //    $this->Session->setFlash("Admin access only");
              //  $this->redirect(array("controller" => "Tasks", "action" => "index"));
                //exit();
           // } else {
                if ($this->Task->save($this->data)) {
                    $this->Session->setFlash(__('The task has been saved', true));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The task could not be saved. Please, try again.', true));
                }
           // }
        }
        if (empty($this->data)) {
            $this->data = $this->Task->read(null, $id);
        }
        $users = $this->Task->User->find('list');
        $this->set(compact('users'));
        
        $userrole = $this->User->getRole($this->Auth->user('id'));
        if ($userrole == "admin") {
            $this->set("menu_to_show","admin_menu");
        }else{
            $this->set("menu_to_show","menu");
        }
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for task', true));
            $this->redirect(array('action' => 'index'));
        }

         $userrole = $this->User->getRole($this->Auth->user('id'));

       if ($userrole != 'admin') {
           $this->Session->setFlash('admin access only');
           $this->redirect(array("controller" => "tasks", "action" => "index"));

           exit();
        } else {
        
        
            
            if ($this->Task->delete($id)) {
                $this->Session->setFlash(__('Task deleted', true));
                $this->redirect(array('controller'=>'users','action' => 'adminpage'));
            } else {
                $this->Session->setFlash(__('Task was not deleted', true));
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    function ajax_update_status($id, $new_status = 0) {
        $this->layout = null;
        $this->autoRender = false;

        $userrole = $this->User->getRole($this->Auth->user('id'));

        if ($userrole == "admin" || $this->Task->getUserId($id) == $this->Auth->user("id")) {

            $this->Task->id = $id;

            if ($this->Task->saveField('status', $new_status)) {

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}