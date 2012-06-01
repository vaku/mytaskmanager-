<?php

class Task extends AppModel {

    var $name = 'Task';
    var $displayField = 'sub';
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
    var $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'task_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Taskassign' => array(
            'className' => 'Taskassign',
            'foreignKey' => 'task_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    // fetching role from the user table 1.e admin or normaluser.
    function getRole($id) {
        $conditions = array('User.id' => $id);
        return $this->field('role', $conditions);
    }

    function getUserId($id) {
        $conditions = array('Task.id' => $id);
        return $this->field('user_id', $conditions);
    }

//    function getUserTasks($user_id) {
//        
//        $recursive = -1;
//        $conditions = array('Task.user_id' => $user_id);   // where user_id in task table is = to current logged in user (id we have passed)
//        return $this->find('all',array('conditions' => $conditions, "recursive"=>$recursive)); //fetching tasks from tasks table with where clause 
//    }
    
    function getTaskSorted(){
        
        $recursive = 0;
        $order = 'Task.created_on DESC';
        $fields = array("");
        return $this->find('all', array('order'=> $order));
    }
    
    

}
